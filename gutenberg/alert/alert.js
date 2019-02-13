const {__} = wp.i18n,
  el = wp.element.createElement,
  {registerBlockType} = wp.blocks,
  {Fragment} = wp.element,
  { InnerBlocks, InspectorControls } = wp.editor,
  { PanelBody, ToggleControl, SelectControl } = wp.components;

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

    var components = [
      el(
        InnerBlocks,
        null
      )
    ];

    // The close button only renders if "Show Close" is selected, and is printed before the InnerBlocks
    if (show_close == true) {
      components.unshift(
        el(
          'button',
          {
            className: 'close',
            type: 'button',
            'aria-label': 'Close'
          },
          el(
            'span',
            {
              'aria-hidden': 'true'
            },
            '×'
          )
        )
      )
    }

    return el(
      Fragment,
      {},
      el(
        'div',
        {
          className: 'alert alert-' + theme + ' ' + className,
        },
        components
      ),
      el(
        InspectorControls,
        {},
        el(
          PanelBody,
          {
            title: __('Standard')
          },
          el(
            ToggleControl,
            {
              label: __('Add Close Button'),
              checked: show_close,
              onChange: function() {
                setAttributes({show_close: !show_close});
              }
            }
          ),
          el(
            SelectControl,
            {
              label: __('Theme'),
              value: theme,
              options: [
                { label: __('Primary'), value: 'primary' },
                { label: __('Secondary'), value: 'secondary' },
                { label: __('Info'), value: 'info' },
                { label: __('Success'), value: 'success' },
                { label: __('Warning'), value: 'warning' },
                { label: __('Danger'), value: 'danger' },
                { label: __('Light'), value: 'light' },
                { label: __('Dark'), value: 'dark' },
              ],
              onChange: function(newTheme) {
                setAttributes({theme: newTheme});
              }
            }
          )
        )
      )
    );
  },

  save({ attributes, className }) {

    const { show_close, theme } = attributes;

    var components = [
      el(
        InnerBlocks.Content,
        {}
      )
    ];

    if (show_close) {
      components.unshift(
        el(
          'button',
          {
            className: 'close',
            type: 'button',
            'data-dismiss': 'alert',
            'aria-label': 'Close'
          },
          el(
            'span',
            {
              'aria-hidden': 'true'
            },
            '×'
          )
        )
      );
    }

    return el(
      'div',
      {
        className: 'alert alert-' + theme + ' '
        + (show_close ? 'alert-dismissable fade show ' : '')
        + className
      },
      components
    );
  },
} );
