<?php
/**
 * Выборки записей.
 *
 * @package Vega
 */

defined( 'ABSPATH' ) || exit;

/**
 * Сегодняшняя дата в часовом поясе сайта, 'Y-m-d'.
 */
function vega_today() {
	return wp_date( 'Y-m-d' );
}

/**
 * Язык выборки. На сайте Polylang сам фильтрует записи по языку страницы.
 * В редакторе (предпросмотр блоков идёт через REST) фильтруем по языку
 * редактируемой страницы, иначе в предпросмотре были бы все три языка сразу.
 *
 * @param array $args Аргументы запроса.
 */
function vega_lang_args( $args ) {
	if ( defined( 'REST_REQUEST' ) && REST_REQUEST && function_exists( 'pll_get_post_language' ) ) {
		$post = get_post();
		$lang = $post ? pll_get_post_language( $post->ID, 'slug' ) : '';
		if ( $lang ) {
			$args['lang'] = $lang;
		}
	}
	return $args;
}

/**
 * События.
 *
 * @param array $args mode: upcoming | past; limit; section.
 * @return WP_Post[]
 */
function vega_get_events( $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'mode'    => 'upcoming',
			'limit'   => 6,
			'section' => '',
			'exclude' => array(),
		)
	);
	$past = 'past' === $args['mode'];

	$meta_query = array(
		array(
			'key'     => '_vega_until',
			'value'   => vega_today(),
			'compare' => $past ? '<' : '>=',
			'type'    => 'CHAR',
		),
	);
	if ( $args['section'] ) {
		$meta_query[] = array(
			'key'   => '_vega_section',
			'value' => $args['section'],
		);
	}

	$query = new WP_Query(
		vega_lang_args(
			array(
			'post_type'           => 'vega_event',
			'post_status'         => 'publish',
			'posts_per_page'      => (int) $args['limit'] > 0 ? (int) $args['limit'] : 200,
			'meta_key'            => '_vega_sort', // phpcs:ignore WordPress.DB.SlowDBQuery
			'orderby'             => 'meta_value',
			'order'               => $past ? 'DESC' : 'ASC',
			'meta_query'          => $meta_query, // phpcs:ignore WordPress.DB.SlowDBQuery
			'post__not_in'        => (array) $args['exclude'],
				'ignore_sticky_posts' => true,
				'no_found_rows'       => true,
			)
		)
	);
	return $query->posts;
}

/**
 * Группы.
 *
 * @param string $audience kids | adults | all.
 * @return WP_Post[]
 */
function vega_get_groups( $audience = 'all' ) {
	$args = array(
		'post_type'      => 'vega_group',
		'post_status'    => 'publish',
		'posts_per_page' => 100,
		'orderby'        => array(
			'menu_order' => 'ASC',
			'title'      => 'ASC',
		),
		'no_found_rows'  => true,
	);
	if ( in_array( $audience, array( 'kids', 'adults' ), true ) ) {
		$args['meta_query'] = array( // phpcs:ignore WordPress.DB.SlowDBQuery
			array(
				'key'   => '_vega_audience',
				'value' => $audience,
			),
		);
	}
	return get_posts( vega_lang_args( $args + array( 'suppress_filters' => false ) ) );
}

/**
 * Люди.
 *
 * @param string $role        teacher | artist | guest | all.
 * @param bool   $active_only Только действующие.
 * @param int    $limit       Сколько.
 * @return WP_Post[]
 */
function vega_get_people( $role = 'teacher', $active_only = true, $limit = 0 ) {
	$meta_query = array();
	if ( in_array( $role, array( 'teacher', 'artist', 'guest' ), true ) ) {
		$meta_query[] = array(
			'key'   => '_vega_role',
			'value' => $role,
		);
	}
	if ( $active_only ) {
		$meta_query[] = array(
			'key'   => '_vega_active',
			'value' => '1',
		);
	}
	return get_posts(
		vega_lang_args(
			array(
			'post_type'        => 'vega_person',
			'post_status'      => 'publish',
			'posts_per_page'   => $limit > 0 ? $limit : 100,
			'orderby'          => array(
				'menu_order' => 'ASC',
				'title'      => 'ASC',
			),
			'meta_query'       => $meta_query, // phpcs:ignore WordPress.DB.SlowDBQuery
			'suppress_filters' => false,
			)
		)
	);
}

/**
 * Спектакли.
 *
 * @param int $limit Сколько.
 * @return WP_Post[]
 */
function vega_get_shows( $limit = 0 ) {
	return get_posts(
		vega_lang_args(
			array(
			'post_type'        => 'vega_show',
			'post_status'      => 'publish',
			'posts_per_page'   => $limit > 0 ? $limit : 100,
			'orderby'          => array(
				'menu_order' => 'ASC',
				'title'      => 'ASC',
			),
			'suppress_filters' => false,
			)
		)
	);
}

/**
 * Связанные люди (педагоги группы, состав спектакля) в языке текущей страницы.
 *
 * @param int    $post_id ID записи.
 * @param string $key     teachers | cast.
 * @return array<int, array{post: WP_Post, note: string}>
 */
function vega_get_linked_people( $post_id, $key = 'teachers' ) {
	$rows = get_post_meta( $post_id, '_vega_' . $key, true );
	$out  = array();
	if ( ! is_array( $rows ) ) {
		return $out;
	}
	foreach ( $rows as $row ) {
		$id = vega_translated_id( isset( $row['id'] ) ? $row['id'] : 0 );
		$p  = $id ? get_post( $id ) : null;
		if ( $p && 'publish' === $p->post_status ) {
			$out[] = array(
				'post' => $p,
				'note' => isset( $row['note'] ) ? (string) $row['note'] : '',
			);
		}
	}
	return $out;
}

/**
 * Занятия группы, отсортированные по дням недели.
 *
 * @param int $post_id ID группы.
 * @return array<int, array{day:int,start:string,end:string}>
 */
function vega_get_schedule( $post_id ) {
	$rows = get_post_meta( $post_id, '_vega_schedule', true );
	if ( ! is_array( $rows ) ) {
		return array();
	}
	// Неделя начинается с понедельника, но воскресные занятия у студии — главные,
	// поэтому в карточке группы оставляем порядок, в котором их ввели.
	return array_values( $rows );
}

/**
 * Время «11:30–12:30».
 *
 * @param array $row Строка расписания.
 */
function vega_time_range( $row ) {
	return $row['start'] . ( ! empty( $row['end'] ) ? '–' . $row['end'] : '' );
}

/**
 * Краткое расписание группы: «вс 11:30–12:30 · чт 17:30–18:30».
 *
 * @param int $post_id ID группы.
 */
function vega_schedule_summary( $post_id ) {
	$parts = array();
	foreach ( vega_get_schedule( $post_id ) as $row ) {
		$parts[] = vega_weekday( $row['day'], true ) . ' ' . vega_time_range( $row );
	}
	if ( ! $parts ) {
		return (string) get_post_meta( $post_id, '_vega_schedule_note', true );
	}
	return implode( ' · ', $parts );
}
