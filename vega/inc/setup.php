<?php
/**
 * Возможности темы, стили, скрипты, меню.
 *
 * @package Vega
 */

defined( 'ABSPATH' ) || exit;

/**
 * Базовая настройка темы.
 */
function vega_setup() {
	load_theme_textdomain( 'vega', VEGA_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' )
	);
	// Короткое описание страницы показывается под заголовком.
	add_post_type_support( 'page', 'excerpt' );

	// Свой шаблон блоков не нужен: страницы собираются из обычных блоков.
	remove_theme_support( 'core-block-patterns' );

	// Стили редактора: те же шрифты и тот же вид, что на сайте.
	add_editor_style( array( 'assets/css/fonts.css', 'assets/css/theme.css', 'assets/css/editor.css' ) );

	register_nav_menus(
		array(
			'primary' => 'Главное меню (шапка)',
			'footer'  => 'Меню в подвале',
		)
	);

	// Кадрирование по верхней части снимка, чтобы не отрезать головы.
	add_image_size( 'vega-portrait', 640, 800, array( 'center', 'top' ) );
	add_image_size( 'vega-card', 800, 600, array( 'center', 'top' ) );
	add_image_size( 'vega-poster', 900, 1200, false );
	add_image_size( 'vega-wide', 1600, 1000, array( 'center', 'top' ) );
}
add_action( 'after_setup_theme', 'vega_setup' );

/**
 * Ширина содержимого для встраиваемых видео.
 */
function vega_content_width() {
	$GLOBALS['content_width'] = 760;
}
add_action( 'after_setup_theme', 'vega_content_width', 0 );

/**
 * Названия размеров картинок в выборе размера.
 *
 * @param array $sizes Размеры.
 */
function vega_image_size_names( $sizes ) {
	$sizes['vega-portrait'] = 'Портрет (обрезка сверху)';
	$sizes['vega-card']     = 'Карточка (обрезка сверху)';
	$sizes['vega-wide']     = 'Широкое фото';
	return $sizes;
}
add_filter( 'image_size_names_choose', 'vega_image_size_names' );

/**
 * Стили и скрипты сайта.
 */
function vega_enqueue_assets() {
	wp_enqueue_style( 'vega-fonts', VEGA_URI . '/assets/css/fonts.css', array(), VEGA_VERSION );
	wp_enqueue_style( 'vega-theme', VEGA_URI . '/assets/css/theme.css', array( 'vega-fonts' ), VEGA_VERSION );

	wp_enqueue_script( 'vega-site', VEGA_URI . '/assets/js/site.js', array(), VEGA_VERSION, true );
	wp_localize_script(
		'vega-site',
		'vegaSite',
		array(
			'copied'    => __( 'Copied', 'vega' ),
			'copyError' => __( 'Select the text and copy it manually', 'vega' ),
			'menuOpen'  => __( 'Open menu', 'vega' ),
			'menuClose' => __( 'Close menu', 'vega' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'vega_enqueue_assets' );

/**
 * Предзагрузка основных шрифтов, чтобы заголовки не «прыгали».
 */
function vega_preload_fonts() {
	$fonts = array( 'jost-cyrillic-wght-normal.woff2', 'golos-text-cyrillic-wght-normal.woff2' );
	if ( 'ru' !== vega_lang() ) {
		$fonts = array( 'jost-latin-wght-normal.woff2', 'golos-text-latin-wght-normal.woff2' );
	}
	foreach ( $fonts as $font ) {
		echo '<link rel="preload" href="' . esc_url( VEGA_URI . '/assets/fonts/' . $font ) . '" as="font" type="font/woff2" crossorigin>' . "\n";
	}
}
add_action( 'wp_head', 'vega_preload_fonts', 2 );

/**
 * Цвет панели браузера на телефоне.
 */
function vega_theme_color() {
	$color = vega_is_festival_page() ? '#0F1524' : '#121211';
	echo '<meta name="theme-color" content="' . esc_attr( $color ) . '">' . "\n";
}
add_action( 'wp_head', 'vega_theme_color', 3 );

/**
 * Является ли текущая страница страницей фестиваля «Под небом Испании»
 * (своя палитра и шрифты).
 */
function vega_is_festival_page() {
	if ( ! is_singular( 'page' ) ) {
		return false;
	}
	return 'page-templates/festival-sky.php' === get_page_template_slug( get_queried_object_id() );
}

/**
 * Классы body.
 *
 * @param array $classes Классы.
 */
function vega_body_class( $classes ) {
	if ( vega_is_festival_page() ) {
		$classes[] = 'palette-sky';
	}
	$classes[] = 'lang-' . sanitize_html_class( vega_lang() );
	return $classes;
}
add_filter( 'body_class', 'vega_body_class' );

/**
 * Стили оформления для блоков «Группа», «Кнопка» и др.
 */
function vega_register_block_styles() {
	register_block_style(
		'core/group',
		array(
			'name'  => 'vega-light',
			'label' => 'Светлая секция',
		)
	);
	register_block_style(
		'core/group',
		array(
			'name'  => 'vega-card',
			'label' => 'Карточка с рамкой',
		)
	);
	register_block_style(
		'core/group',
		array(
			'name'  => 'vega-band',
			'label' => 'Оранжевая полоса',
		)
	);
	register_block_style(
		'core/group',
		array(
			'name'  => 'vega-stars',
			'label' => 'Тёмная секция со звёздами',
		)
	);
	register_block_style(
		'core/image',
		array(
			'name'  => 'vega-portrait',
			'label' => 'Портрет 4:5 (обрезка сверху)',
		)
	);
	register_block_style(
		'core/paragraph',
		array(
			'name'  => 'vega-eyebrow',
			'label' => 'Рубрика (мелко, прописными)',
		)
	);
	register_block_style(
		'core/paragraph',
		array(
			'name'  => 'vega-lead',
			'label' => 'Вводный абзац (крупнее)',
		)
	);
	register_block_style(
		'core/list',
		array(
			'name'  => 'vega-starlist',
			'label' => 'Список со звёздочками',
		)
	);
}
add_action( 'init', 'vega_register_block_styles' );

/**
 * Если меню в шапке ещё не назначено — показываем автоматическое меню
 * из служебных страниц (в текущем языке).
 *
 * @param array $args Аргументы wp_nav_menu.
 */
function vega_auto_menu( $args = array() ) {
	$location = isset( $args['theme_location'] ) ? $args['theme_location'] : 'primary';
	$roles    = 'footer' === $location
		? array( 'about', 'actorre', 'donate', 'contacts', 'privacy' )
		: array( 'kids', 'adults', 'events', 'teachers', 'about', 'actorre', 'shkhuna', 'fest_sky', 'contacts' );

	$items = '';
	foreach ( $roles as $role ) {
		$id = vega_page_id( $role );
		if ( ! $id ) {
			continue;
		}
		$current = ( is_page( $id ) ) ? ' current-menu-item' : '';
		$aria    = $current ? ' aria-current="page"' : '';
		$items  .= '<li class="menu-item' . $current . '"><a href="' . esc_url( get_permalink( $id ) ) . '"' . $aria . '>' . esc_html( get_the_title( $id ) ) . '</a></li>';
	}
	if ( ! $items ) {
		return '';
	}
	$class = isset( $args['menu_class'] ) ? $args['menu_class'] : 'menu';
	$html  = '<ul class="' . esc_attr( $class ) . '">' . $items . '</ul>';
	if ( ! empty( $args['echo'] ) ) {
		echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- собрано выше с экранированием.
	}
	return $html;
}

/**
 * Короткий отрывок.
 */
add_filter(
	'excerpt_length',
	function () {
		return 26;
	}
);
add_filter(
	'excerpt_more',
	function () {
		return '…';
	}
);

/**
 * Иконка сайта по умолчанию — звезда, пока не загружена своя.
 */
function vega_default_favicon() {
	if ( has_site_icon() ) {
		return;
	}
	echo '<link rel="icon" href="' . esc_url( VEGA_URI . '/assets/img/favicon.svg' ) . '" type="image/svg+xml">' . "\n";
}
add_action( 'wp_head', 'vega_default_favicon', 4 );
