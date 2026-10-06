/**
 * Тема «Вега»: меню-«бургер», кнопки «Скопировать», карта по нажатию.
 * Обычный JavaScript, без библиотек.
 */
( function () {
	'use strict';

	var i18n = window.vegaSite || {};

	/* Меню-«бургер» ------------------------------------------------------- */
	var header = document.querySelector( '[data-site-header]' );
	var toggle = document.querySelector( '[data-nav-toggle]' );
	var nav = document.querySelector( '[data-site-nav]' );

	function setOpen( open ) {
		if ( ! header || ! toggle ) {
			return;
		}
		if ( open ) {
			// Панель открывается сразу под шапкой (учитываем панель админа).
			header.style.setProperty( '--nav-top', header.getBoundingClientRect().bottom + 'px' );
		}
		header.classList.toggle( 'is-nav-open', open );
		document.documentElement.style.overflow = open ? 'hidden' : '';
		toggle.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
		var label = toggle.querySelector( '[data-nav-toggle-label]' );
		if ( label ) {
			label.textContent = open ? i18n.menuClose || 'Close menu' : i18n.menuOpen || 'Open menu';
		}
	}

	if ( toggle && nav ) {
		toggle.addEventListener( 'click', function () {
			setOpen( toggle.getAttribute( 'aria-expanded' ) !== 'true' );
		} );
		document.addEventListener( 'keydown', function ( e ) {
			if ( e.key === 'Escape' && toggle.getAttribute( 'aria-expanded' ) === 'true' ) {
				setOpen( false );
				toggle.focus();
			}
		} );
		nav.addEventListener( 'click', function ( e ) {
			if ( e.target.closest( 'a' ) ) {
				setOpen( false );
			}
		} );
		window.addEventListener( 'resize', function () {
			if ( window.matchMedia( '(min-width: 1240px)' ).matches ) {
				setOpen( false );
			}
		} );
	}

	/* Кнопки «Скопировать» ------------------------------------------------ */
	function copyText( text ) {
		if ( navigator.clipboard && window.isSecureContext ) {
			return navigator.clipboard.writeText( text );
		}
		return new Promise( function ( resolve, reject ) {
			var area = document.createElement( 'textarea' );
			area.value = text;
			area.setAttribute( 'readonly', '' );
			area.style.position = 'fixed';
			area.style.opacity = '0';
			document.body.appendChild( area );
			area.select();
			try {
				document.execCommand( 'copy' ) ? resolve() : reject();
			} catch ( err ) {
				reject( err );
			}
			document.body.removeChild( area );
		} );
	}

	document.addEventListener( 'click', function ( e ) {
		var btn = e.target.closest( '[data-copy]' );
		if ( ! btn ) {
			return;
		}
		var box = btn.closest( '.donate__bank' );
		var status = box ? box.querySelector( '.copy-status' ) : null;
		var text = btn.querySelector( '.copy-btn__text' );
		var original = text ? text.textContent : '';
		copyText( btn.getAttribute( 'data-copy' ) ).then(
			function () {
				btn.classList.add( 'is-copied' );
				if ( text ) {
					text.textContent = i18n.copied || 'Copied';
				}
				if ( status ) {
					var label = btn.closest( '.copy-row' ).querySelector( 'dt' );
					status.textContent = ( label ? label.textContent + ': ' : '' ) + ( i18n.copied || 'Copied' );
				}
				setTimeout( function () {
					btn.classList.remove( 'is-copied' );
					if ( text ) {
						text.textContent = original;
					}
				}, 2200 );
			},
			function () {
				if ( status ) {
					status.textContent = i18n.copyError || '';
				}
			}
		);
	} );

	/* Карта: загружается только по нажатию (без лишних cookie) ------------- */
	document.addEventListener( 'click', function ( e ) {
		var btn = e.target.closest( '[data-map-load]' );
		if ( ! btn ) {
			return;
		}
		var map = btn.closest( '[data-map-src]' );
		if ( ! map ) {
			return;
		}
		var frame = document.createElement( 'iframe' );
		frame.src = map.getAttribute( 'data-map-src' );
		frame.title = map.getAttribute( 'data-map-title' ) || 'Map';
		frame.loading = 'lazy';
		frame.referrerPolicy = 'no-referrer-when-downgrade';
		frame.setAttribute( 'allowfullscreen', '' );
		map.innerHTML = '';
		map.appendChild( frame );
		frame.focus();
	} );
} )();
