<?php
/**
 * Типы записей: события, группы, люди, спектакли.
 * Названия в админке — по-русски, адреса страниц — латиницей, одинаковые для всех языков.
 *
 * @package Vega
 */

defined( 'ABSPATH' ) || exit;

/**
 * Подписи типа записи.
 *
 * @param string $many   Во множественном числе.
 * @param string $one    В единственном.
 * @param string $add    «Добавить …».
 * @param string $all    «Все …».
 */
function vega_cpt_labels( $many, $one, $add, $all ) {
	return array(
		'name'               => $many,
		'singular_name'      => $one,
		'menu_name'          => $many,
		'add_new'            => $add,
		'add_new_item'       => $add,
		'edit_item'          => 'Редактировать: ' . mb_strtolower( $one ),
		'new_item'           => $add,
		'view_item'          => 'Открыть на сайте',
		'view_items'         => 'Открыть на сайте',
		'search_items'       => 'Искать',
		'not_found'          => 'Ничего не найдено',
		'not_found_in_trash' => 'В корзине пусто',
		'all_items'          => $all,
		'featured_image'     => 'Фото / афиша',
		'set_featured_image' => 'Выбрать фото',
		'remove_featured_image' => 'Убрать фото',
		'use_featured_image' => 'Использовать как фото',
		'item_published'     => 'Опубликовано.',
		'item_updated'       => 'Сохранено.',
	);
}

/**
 * Регистрация типов записей.
 */
function vega_register_post_types() {
	$common = array(
		'public'       => true,
		'show_in_rest' => true,
		'has_archive'  => true,
		'menu_position' => 21,
	);

	register_post_type(
		'vega_event',
		array_merge(
			$common,
			array(
				'labels'      => vega_cpt_labels( 'События', 'Событие', 'Добавить событие', 'Все события' ),
				'description' => 'Спектакли, концерты, фестивали, мастер-классы и встречи «Шхуны».',
				'menu_icon'   => 'dashicons-tickets-alt',
				'supports'    => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' ),
				'rewrite'     => array( 'slug' => 'events', 'with_front' => false ),
			)
		)
	);

	register_post_type(
		'vega_group',
		array_merge(
			$common,
			array(
				'labels'      => vega_cpt_labels( 'Группы', 'Группа', 'Добавить группу', 'Все группы' ),
				'description' => 'Группы детской студии и программы для взрослых.',
				'menu_icon'   => 'dashicons-groups',
				'supports'    => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes', 'revisions' ),
				'rewrite'     => array( 'slug' => 'groups', 'with_front' => false ),
			)
		)
	);

	register_post_type(
		'vega_person',
		array_merge(
			$common,
			array(
				'labels'      => vega_cpt_labels( 'Люди', 'Человек', 'Добавить человека', 'Все люди' ),
				'description' => 'Педагоги, артисты и приглашённые гости.',
				'menu_icon'   => 'dashicons-admin-users',
				'supports'    => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes', 'revisions' ),
				'rewrite'     => array( 'slug' => 'people', 'with_front' => false ),
			)
		)
	);

	register_post_type(
		'vega_show',
		array_merge(
			$common,
			array(
				'labels'      => vega_cpt_labels( 'Спектакли', 'Спектакль', 'Добавить спектакль', 'Все спектакли' ),
				'description' => 'Репертуар театра.',
				'menu_icon'   => 'dashicons-format-video',
				'supports'    => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes', 'revisions' ),
				'rewrite'     => array( 'slug' => 'shows', 'with_front' => false ),
			)
		)
	);
}
add_action( 'init', 'vega_register_post_types' );

/**
 * Подсказка в поле заголовка.
 *
 * @param string  $text Текст.
 * @param WP_Post $post Запись.
 */
function vega_title_placeholder( $text, $post ) {
	$map = array(
		'vega_event'  => 'Название события',
		'vega_group'  => 'Название группы (например, Orion)',
		'vega_person' => 'Имя и фамилия',
		'vega_show'   => 'Название спектакля',
	);
	return isset( $map[ $post->post_type ] ) ? $map[ $post->post_type ] : $text;
}
add_filter( 'enter_title_here', 'vega_title_placeholder', 10, 2 );

/**
 * После смены темы обновляем адреса страниц, чтобы /events/ и др. сразу открывались.
 */
function vega_flush_rewrites_on_switch() {
	vega_register_post_types();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'vega_flush_rewrites_on_switch' );

/**
 * Архив людей показывает всех действующих по порядку, без деления на страницы;
 * архив событий — только предстоящие (прошедшие — в блоке «Архив» на странице «Афиша»).
 *
 * @param WP_Query $query Запрос.
 */
function vega_adjust_archives( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}
	if ( $query->is_post_type_archive( array( 'vega_person', 'vega_group', 'vega_show' ) ) ) {
		$query->set( 'posts_per_page', 60 );
		$query->set( 'orderby', array( 'menu_order' => 'ASC', 'title' => 'ASC' ) );
	}
	if ( $query->is_post_type_archive( 'vega_person' ) ) {
		$query->set(
			'meta_query',
			array(
				array(
					'key'   => '_vega_active',
					'value' => '1',
				),
			)
		);
	}
	if ( $query->is_post_type_archive( 'vega_event' ) ) {
		$query->set( 'posts_per_page', 30 );
		$query->set( 'meta_key', '_vega_sort' );
		$query->set( 'orderby', 'meta_value' );
		$query->set( 'order', 'ASC' );
		$query->set(
			'meta_query',
			array(
				array(
					'key'     => '_vega_until',
					'value'   => vega_today(),
					'compare' => '>=',
					'type'    => 'CHAR',
				),
			)
		);
	}
}
add_action( 'pre_get_posts', 'vega_adjust_archives' );
