/**
 * BLOCK: bootstrap-columns
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */

//  Import CSS.
import './style.scss';
import './editor.scss';

const { __ } = wp.i18n,
  { registerBlockType } = wp.blocks,
  { Fragment } = wp.element,
  { InnerBlocks, InspectorControls } = wp.editor,
  { PanelBody, ToggleControl, SelectControl } = wp.components;

const themeOptions = [
  { label: __('Primary'), value: 'primary' },
  { label: __('Secondary'), value: 'secondary' },
  { label: __('Info'), value: 'info' },
  { label: __('Success'), value: 'success' },
  { label: __('Warning'), value: 'warning' },
  { label: __('Danger'), value: 'danger' },
  { label: __('Light'), value: 'light' },
  { label: __('Dark'), value: 'dark' }
];

registerBlockType( 'theme-gutenberg/alert', {
  title: 'Bootstrap Alert',

  icon: 'warning',

  description: __('Displays content in a Bootstrap alert module'),

  category: 'layout',

  attributes: {
    show_close: {
      type: 'boolean',
      default: false
    },
    theme: {
      type: 'string',
      default: 'primary'
    }
  },

  edit({ attributes, className, setAttributes }) {

    const { show_close, theme } = attributes;

    return (
      <Fragment>
        <div className={'alert alert-' + theme + ' ' + className} role={'alert'}>
          {show_close == true ? <button className={'close'} type={'button'} aria-label={'Close'}><span aria-hidden={'true'}>×</span></button> : ''}
          <InnerBlocks />
        </div>
        <InspectorControls>
          <PanelBody title={__('Standard')}>
            <ToggleControl label={__('Add Close Button')} checked={show_close} onChange={() => setAttributes({show_close: !show_close})} />
            <SelectControl label={__('Theme')} value={theme} onChange={(newTheme) => setAttributes({theme: newTheme})} options={themeOptions} />
          </PanelBody>
        </InspectorControls>
      </Fragment>
    );
  },

  save({ attributes, className }) {

    const { show_close, theme } = attributes;

    return (
      <div className={'alert alert-' + theme + ' ' + (show_close ? 'alert-dismissable fade show ' : '') + className} role={'alert'}>
        {show_close == true ? <button className={'close'} type={'button'} aria-label={'Close'}><span aria-hidden={'true'}>×</span></button> : ''}
        <InnerBlocks />
      </div>
    );
  },
} );
