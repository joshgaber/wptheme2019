/**
 * BLOCK: bootstrap-columns
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */

//  Import CSS.
import './style.scss';
import './editor.scss';

const {__} = wp.i18n,
  el = wp.element.createElement,
  {registerBlockType} = wp.blocks,
  {Fragment} = wp.element,
  { InnerBlocks, InspectorControls, MediaUpload } = wp.editor,
  { PanelBody, TextControl, SelectControl } = wp.components;



const themeOptions = [
  { label: __('None'), value: '' },
  { label: __('Primary'), value: 'primary' },
  { label: __('Secondary'), value: 'secondary' },
  { label: __('Info'), value: 'info' },
  { label: __('Success'), value: 'success' },
  { label: __('Warning'), value: 'warning' },
  { label: __('Danger'), value: 'danger' },
  { label: __('Light'), value: 'light' },
  { label: __('Dark'), value: 'dark' }
];

const layoutOptions = [
  { label: __('Header at Top'), value: 'header' },
  { label: __('Image at Top'), value: 'image' },
  { label: __('None'), value: 'none' }
];



registerBlockType( 'theme-gutenberg/card', {
  title: 'Bootstrap Card',

  icon: 'analytics',

  description: __('Displays content in a Bootstrap card module'),

  category: 'layout',

  attributes: {
    layout: {
      type: 'string',
      default: 'none'
    },
    theme: {
      type: 'string',
      default: ''
    },
    header: {
      type: "string",
      default: ''
    },
    footer: {
      type: "string",
      default: ''
    },
    image: {
      type: "array",
      default: []
    }
  },

  edit({ attributes, className, setAttributes }) {

    const { layout, theme, header, footer, image } = attributes;

    return (
      <Fragment>
        <div className={'card '
          + (theme.length == 0 ? '' : 'bg-' + theme + ' ')
          + (theme.length == 0 || theme == "light" ? '' : 'text-white ')
          + className}>
          {layout == "header" ? <h5 className={'card-header'}>{header}</h5> : ''}
          {layout == "image" && image != [] ? <img className={'card-img-top'} src={image.url} /> : ''}
          <div className={'card-body'}>
            <InnerBlocks />
          </div>
          {footer != "" ? <div className={'card-footer'}><small className={'text-' + (theme.length == 0 || theme == "light" ? 'muted' : 'white ')}>{footer}</small></div> : ''}
        </div>
        <InspectorControls>
          <PanelBody title={__('Standard')}>
            <SelectControl label={__('Layout')} value={layout} onChange={(newLayout) => setAttributes({layout: newLayout})} options={layoutOptions} />
            {layout == "header" ? <TextControl label={__('Header Text')} value={header} onChange={(newHeader) => setAttributes({header: newHeader})}/> : ''}
            {layout == "image" ? <MediaUpload title={__('Choose Head Image')}
              value={image.id} onSelect={(media) => setAttributes({image: media})}
              render={ ({open}) => <button onClick={open}>Choose an Image</button> } /> : ''}
            <TextControl label={__('Footer Text')} value={footer} onChange={(newFooter) => setAttributes({footer: newFooter})}/>
            <SelectControl label={__('Theme')} value={theme} onChange={(newTheme) => setAttributes({theme: newTheme})} options={themeOptions} />
          </PanelBody>
        </InspectorControls>
      </Fragment>
    );
  },

  save({ attributes, className }) {

    const { layout, theme, header, footer, image } = attributes;

    return (
      <div className={'card '
        + (theme.length == 0 ? '' : 'bg-' + theme + ' ')
        + (theme.length == 0 || theme == "light" ? '' : 'text-white ')
        + className}>
        {layout == "header" ? <h5 className={'card-header'}>{header}</h5> : ''}
        {layout == "image" && image != [] ? <img className={'card-img-top'} src={image.url} /> : ''}
        <div className={'card-body'}>
          <InnerBlocks.Content />
        </div>
        {footer != "" ? <div className={'card-footer'}><small className={'text-' + (theme.length == 0 || theme == "light" ? 'muted' : 'white ')}>{footer}</small></div> : ''}
      </div>
    );
  },
} );
