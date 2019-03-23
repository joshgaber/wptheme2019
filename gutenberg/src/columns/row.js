/**
 * BLOCK: bootstrap-columns
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */

//  Import CSS.
import './style.scss';
import './editor.scss';

const { __ } = wp.i18n; // Import __() from wp.i18n
const { registerBlockType } = wp.blocks; // Import registerBlockType() from wp.blocks
const { Fragment } = wp.element;
const { InnerBlocks, InspectorControls } = wp.editor;
const { PanelBody, RangeControl, SelectControl } = wp.components;
const { select, dispatch } = wp.data;

/**
 * Register: aa Gutenberg Block.
 *
 * Registers a new block provided a unique name and an object defining its
 * behavior. Once registered, the block is made editor as an option to any
 * editor interface where blocks are implemented.
 *
 * @link https://wordpress.org/gutenberg/handbook/block-api/
 * @param  {string}   name     Block name.
 * @param  {Object}   settings Block settings.
 * @return {?WPBlock}          The block, if it has been successfully
 *                             registered; otherwise `undefined`.
 */
registerBlockType( 'theme-gutenberg/fixed-row', {
	// Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
	title: __( 'Fixed Columns' ), // Block title.
	icon: 'schedule', // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
	category: 'layout', // Block category — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
	keywords: [
		__( 'fixed-row' ),
		__( 'Fixed Row' ),
		__( 'create-guten-block' ),
	],

  attributes: {
    columns: {
      type: 'number',
      default: 2
    },
    breakpoint: {
      type: 'string',
      default: 'lg-'
    }
  },

  supports: {
    align: [ 'wide', 'full' ],
    html: false
  },

	/**
	 * The edit function describes the structure of your block in the context of the editor.
	 * This represents what the editor will render when the block is used.
	 *
	 * The "edit" property must be a valid function.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/
	 */
	edit: function( { attributes, setAttributes, className, clientId } ) {

    const { columns, breakpoint } = attributes;

    function updateColumns(newColumns) {
      setAttributes({columns: newColumns});
      updateColumnAttributes();
    }

    function updateBreakpoint(newBreakpoint) {
      setAttributes({breakpoint: newBreakpoint});
      updateColumnAttributes();
    }

    function updateColumnAttributes() {
      var childBlocks = select('core/editor').getBlocksByClientId(clientId)[0].innerBlocks;

      childBlocks.forEach((c) => dispatch('core/editor').updateBlockAttributes(c.clientId, { width: columns, breakpoint: breakpoint }));
    }

    // Creates a <p class='wp-block-cgb-block-bootstrap-columns'></p>.
		return (
			<Fragment>
        <div className={className}>
        <InnerBlocks
          template={ Array(columns).fill([ 'theme-gutenberg/fixed-column', { width: (12/columns), breakpoint: breakpoint } ]) }
          templateLock={'all'}
          allowedBlocks={[ 'theme-gutenberg/fixed-column' ]}
        />
        </div>
        <InspectorControls>
          <PanelBody title={__('Standard')}>
            <RangeControl
              label={__('Columns')}
              value={columns}
              onChange={ updateColumns }
              min={2}
              max={4}
            />
            <SelectControl
              label={__('Break at')}
              value={breakpoint}
              options={[
                { label: __('Phone (portrait)'), value: '' },
                { label: __('Phone (landscape)'), value: 'sm-' },
                { label: __('Tablet (portrait)'), value: 'md-' },
                { label: __('Table (landscape)'), value: 'lg-' },
                { label: __('Desktop'), value: 'xl-' },
              ]}
              onChange={ updateBreakpoint }
            />
          </PanelBody>
        </InspectorControls>
      </Fragment>
		);
	},

	/**
	 * The save function defines the way in which the different attributes should be combined
	 * into the final markup, which is then serialized by Gutenberg into post_content.
	 *
	 * The "save" property must be specified and must be a valid function.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/
	 */
	save: function( { attributes, className } ) {
		return (
			<div className={'row ' + className}>
				<InnerBlocks.Content />
			</div>
		);
	},
} );
