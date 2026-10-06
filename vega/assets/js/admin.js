/**
 * Админка темы «Вега»: выбор логотипов и фотографий галереи из медиатеки.
 */
( function ( $ ) {
	'use strict';

	if ( ! window.wp || ! wp.media ) {
		return;
	}

	// Одна картинка (логотипы в настройках).
	$( document ).on( 'click', '[data-vega-media-pick]', function ( e ) {
		e.preventDefault();
		var box = $( this ).closest( '[data-vega-media]' );
		var frame = wp.media( {
			title: 'Выберите картинку',
			button: { text: 'Использовать' },
			library: { type: 'image' },
			multiple: false,
		} );
		frame.on( 'select', function () {
			var img = frame.state().get( 'selection' ).first().toJSON();
			var url = img.sizes && img.sizes.medium ? img.sizes.medium.url : img.url;
			box.find( 'input[type=hidden]' ).val( img.id );
			box.find( '.vega-media__preview' ).html( $( '<img>', { src: url, alt: '' } ) );
			box.find( '[data-vega-media-remove]' ).prop( 'hidden', false );
		} );
		frame.open();
	} );

	$( document ).on( 'click', '[data-vega-media-remove]', function ( e ) {
		e.preventDefault();
		var box = $( this ).closest( '[data-vega-media]' );
		box.find( 'input[type=hidden]' ).val( '' );
		box.find( '.vega-media__preview' ).empty();
		$( this ).prop( 'hidden', true );
	} );

	// Галерея спектакля.
	$( document ).on( 'click', '[data-vega-gallery-pick]', function ( e ) {
		e.preventDefault();
		var box = $( this ).closest( '[data-vega-gallery]' );
		var input = box.find( 'input[type=hidden]' );
		var frame = wp.media( {
			title: 'Фотографии спектакля',
			button: { text: 'Сохранить выбор' },
			library: { type: 'image' },
			multiple: 'add',
		} );
		frame.on( 'open', function () {
			var selection = frame.state().get( 'selection' );
			( input.val() || '' ).split( ',' ).forEach( function ( id ) {
				if ( id ) {
					var att = wp.media.attachment( id );
					att.fetch();
					selection.add( att );
				}
			} );
		} );
		frame.on( 'select', function () {
			var ids = [];
			var list = box.find( '.vega-gallery__list' ).empty();
			frame.state().get( 'selection' ).each( function ( att ) {
				var img = att.toJSON();
				ids.push( img.id );
				var url = img.sizes && img.sizes.thumbnail ? img.sizes.thumbnail.url : img.url;
				list.append( $( '<li>' ).append( $( '<img>', { src: url, alt: '' } ) ) );
			} );
			input.val( ids.join( ',' ) );
		} );
		frame.open();
	} );

	$( document ).on( 'click', '[data-vega-gallery-clear]', function ( e ) {
		e.preventDefault();
		var box = $( this ).closest( '[data-vega-gallery]' );
		box.find( 'input[type=hidden]' ).val( '' );
		box.find( '.vega-gallery__list' ).empty();
	} );
} )( jQuery );
