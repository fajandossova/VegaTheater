/**
 * Блоки «Вега: …» в редакторе.
 * Обычный JavaScript без сборки: описание блоков приходит из PHP (inc/blocks.php),
 * а предпросмотр рисует сервер — так в редакторе видно ровно то, что будет на сайте.
 */
( function ( wp, blocks ) {
	'use strict';

	if ( ! wp || ! blocks ) {
		return;
	}

	var el = wp.element.createElement;
	var Fragment = wp.element.Fragment;
	var InspectorControls = wp.blockEditor.InspectorControls;
	var useBlockProps = wp.blockEditor.useBlockProps;
	var PanelBody = wp.components.PanelBody;
	var SelectControl = wp.components.SelectControl;
	var ToggleControl = wp.components.ToggleControl;
	var TextControl = wp.components.TextControl;
	var RangeControl = wp.components.RangeControl;
	var Disabled = wp.components.Disabled;
	var ServerSideRender = wp.serverSideRender;

	function control( key, def, attributes, setAttributes ) {
		var value = attributes[ key ];
		var set = function ( v ) {
			var next = {};
			next[ key ] = v;
			setAttributes( next );
		};

		if ( def.options ) {
			return el( SelectControl, {
				key: key,
				label: def.label,
				value: value,
				help: def.help,
				options: Object.keys( def.options ).map( function ( k ) {
					return { value: k, label: def.options[ k ] };
				} ),
				onChange: set,
			} );
		}
		if ( def.type === 'boolean' ) {
			return el( ToggleControl, {
				key: key,
				label: def.label,
				help: def.help,
				checked: !! value,
				onChange: set,
			} );
		}
		if ( def.type === 'number' ) {
			return el( RangeControl, {
				key: key,
				label: def.label,
				help: def.help,
				value: value,
				min: def.min || 0,
				max: def.max || 30,
				onChange: function ( v ) {
					set( parseInt( v, 10 ) || 0 );
				},
			} );
		}
		return el( TextControl, {
			key: key,
			label: def.label,
			help: def.help,
			value: value || '',
			onChange: set,
		} );
	}

	blocks.forEach( function ( def ) {
		var attributes = {};
		Object.keys( def.attributes ).forEach( function ( key ) {
			attributes[ key ] = {
				type: def.attributes[ key ].type,
				default: def.attributes[ key ].default,
			};
		} );

		wp.blocks.registerBlockType( def.name, {
			apiVersion: 2,
			title: def.title,
			description: def.description,
			icon: def.icon,
			category: 'vega',
			attributes: attributes,
			supports: { align: [ 'wide', 'full' ], html: false },
			edit: function ( props ) {
				var keys = Object.keys( def.attributes );
				var blockProps = useBlockProps( { className: 'vega-editor-preview' } );
				var panel = keys.length
					? el(
							InspectorControls,
							null,
							el(
								PanelBody,
								{ title: 'Настройки', initialOpen: true },
								keys.map( function ( key ) {
									return control( key, def.attributes[ key ], props.attributes, props.setAttributes );
								} )
							)
					  )
					: null;

				return el(
					Fragment,
					null,
					panel,
					el(
						'div',
						blockProps,
						el( 'div', { className: 'vega-editor-preview__label' }, def.title ),
						el(
							Disabled,
							null,
							el( ServerSideRender, {
								block: def.name,
								attributes: props.attributes,
								EmptyResponsePlaceholder: function () {
									return el(
										'p',
										{ className: 'vega-editor-preview__empty' },
										'Сейчас здесь пусто. Проверьте настройки «Театр Вега» или добавьте записи — блок заполнится сам.'
									);
								},
							} )
						)
					)
				);
			},
			save: function () {
				return null;
			},
		} );
	} );
} )( window.wp, window.vegaBlocks );
