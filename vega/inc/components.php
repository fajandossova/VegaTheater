<?php
/**
 * HTML-компоненты сайта. Одни и те же карточки и кнопки используются
 * в блоках редактора, на главной и в шаблонах страниц — отсюда единый вид.
 *
 * @package Vega
 */

defined( 'ABSPATH' ) || exit;

/**
 * Кнопка-ссылка.
 *
 * @param string $url     Адрес.
 * @param string $label   Текст.
 * @param string $variant primary | ghost | whatsapp | light.
 * @param array  $opts    icon, external, class.
 */
function vega_button( $url, $label, $variant = 'primary', $opts = array() ) {
	if ( ! $url ) {
		return '';
	}
	$opts     = wp_parse_args(
		$opts,
		array(
			'icon'     => '',
			'external' => false,
			'class'    => '',
		)
	);
	$external = $opts['external'] || ( 0 !== strpos( $url, home_url() ) && preg_match( '#^https?://#', $url ) );
	$html     = '<a class="btn btn--' . esc_attr( $variant ) . ( $opts['class'] ? ' ' . esc_attr( $opts['class'] ) : '' ) . '" href="' . esc_url( $url ) . '"' . ( $external ? vega_external_attrs() : '' ) . '>';
	if ( $opts['icon'] ) {
		$html .= vega_icon( $opts['icon'] );
	}
	$html .= '<span>' . esc_html( $label ) . '</span>';
	if ( $external ) {
		$html .= vega_new_tab_hint();
	}
	return $html . '</a>';
}

/**
 * Кнопка формы записи и рядом «Написать в WhatsApp».
 * Если ссылка на форму не заполнена — кнопка формы не выводится.
 *
 * @param string $form     Ключ формы из vega_forms().
 * @param string $whatsapp enrol | director | none.
 * @param string $label    Своя подпись (необязательно).
 */
function vega_form_buttons( $form = 'kids', $whatsapp = 'enrol', $label = '' ) {
	$forms = vega_forms();
	$html  = '';
	$url   = vega_form_url( $form );
	if ( $url && isset( $forms[ $form ] ) ) {
		$html .= vega_button( $url, $label ? $label : vega_form_label( $form ), 'primary', array( 'external' => true ) );
	}
	if ( 'none' !== $whatsapp ) {
		$wa = vega_whatsapp_url( $whatsapp );
		if ( $wa ) {
			$html .= vega_button( $wa, __( 'Message us on WhatsApp', 'vega' ), 'ghost', array( 'icon' => 'whatsapp', 'external' => true ) );
		}
	}
	return $html ? '<div class="btn-row">' . $html . '</div>' : '';
}

/**
 * Рубрика (мелкая подпись прописными).
 *
 * @param string $text Текст.
 */
function vega_eyebrow( $text ) {
	return $text ? '<p class="eyebrow">' . esc_html( $text ) . '</p>' : '';
}

/* ---------- События ---------- */

/**
 * Данные события для вывода.
 *
 * @param WP_Post $post Событие.
 */
function vega_event_data( $post ) {
	$id       = $post->ID;
	$date     = get_post_meta( $id, '_vega_date', true );
	$end      = get_post_meta( $id, '_vega_end_date', true );
	$sections = vega_event_sections();
	$section  = get_post_meta( $id, '_vega_section', true );
	$tickets  = '';
	if ( ! get_post_meta( $id, '_vega_no_tickets', true ) ) {
		$tickets = get_post_meta( $id, '_vega_tickets', true );
		if ( ! $tickets ) {
			$tickets = vega_option( 'tickets_url' );
		}
	}
	return array(
		'id'      => $id,
		'title'   => get_the_title( $post ),
		'url'     => get_permalink( $post ),
		'date'    => $date,
		'end'     => $end,
		'time'    => get_post_meta( $id, '_vega_time', true ),
		'place'   => get_post_meta( $id, '_vega_place', true ),
		'price'   => get_post_meta( $id, '_vega_price', true ),
		'section' => isset( $sections[ $section ] ) ? $sections[ $section ] : '',
		'tickets' => $tickets,
		'past'    => get_post_meta( $id, '_vega_until', true ) < vega_today(),
	);
}

/**
 * «Календарный листок» с датой.
 *
 * @param array $e Данные события.
 */
function vega_event_datebox( $e ) {
	$s = vega_parse_date( $e['date'] );
	if ( ! $s ) {
		return '<div class="datebox" aria-hidden="true"><span class="datebox__day">—</span></div>';
	}
	$day = (string) $s[2];
	$x   = vega_parse_date( $e['end'] );
	if ( $x && $e['end'] > $e['date'] && $x[1] === $s[1] ) {
		$day .= '–' . $x[2];
	}
	$html  = '<div class="datebox" aria-hidden="true">';
	$html .= '<span class="datebox__day">' . esc_html( $day ) . '</span>';
	$html .= '<span class="datebox__month">' . esc_html( vega_month_short( $s[1] ) ) . ( (int) wp_date( 'Y' ) !== $s[0] ? ' ' . esc_html( (string) $s[0] ) : '' ) . '</span>';
	if ( ! $x || $e['end'] <= $e['date'] ) {
		$html .= '<span class="datebox__weekday">' . esc_html( vega_weekday_of( $e['date'] ) ) . '</span>';
	}
	return $html . '</div>';
}

/**
 * Строка афиши «дата — название — кнопка».
 *
 * @param WP_Post $post Событие.
 */
function vega_event_row( $post ) {
	$e    = vega_event_data( $post );
	$meta = array();
	if ( $e['time'] ) {
		$meta[] = esc_html( $e['time'] );
	}
	if ( $e['place'] ) {
		$meta[] = esc_html( $e['place'] );
	}
	if ( $e['price'] ) {
		$meta[] = esc_html( $e['price'] );
	}
	$html  = '<article class="event-row">';
	$html .= vega_event_datebox( $e );
	$html .= '<div class="event-row__body">';
	$html .= vega_eyebrow( $e['section'] );
	$html .= '<h3 class="event-row__title"><a href="' . esc_url( $e['url'] ) . '">' . esc_html( $e['title'] ) . '</a></h3>';
	$html .= '<p class="event-row__when">' . esc_html( vega_format_date_range( $e['date'], $e['end'] ) ) . '</p>';
	if ( $meta ) {
		$html .= '<p class="event-row__meta">' . implode( '<span aria-hidden="true"> · </span>', $meta ) . '</p>';
	}
	$html .= '</div><div class="event-row__actions">';
	if ( $e['tickets'] && ! $e['past'] ) {
		$html .= vega_button( $e['tickets'], __( 'Tickets', 'vega' ), 'primary', array( 'icon' => 'ticket', 'external' => true ) );
	} else {
		$html .= '<a class="btn btn--ghost" href="' . esc_url( $e['url'] ) . '"><span>' . esc_html__( 'Details', 'vega' ) . '</span><span class="screen-reader-text">: ' . esc_html( $e['title'] ) . '</span></a>';
	}
	$html .= '</div></article>';
	return $html;
}

/**
 * Карточка события с афишей.
 *
 * @param WP_Post $post Событие.
 */
function vega_event_card( $post ) {
	$e     = vega_event_data( $post );
	$html  = '<article class="card event-card">';
	$html .= '<a class="card__media card__media--poster" href="' . esc_url( $e['url'] ) . '" tabindex="-1" aria-hidden="true">';
	$html .= has_post_thumbnail( $post ) ? get_the_post_thumbnail( $post, 'vega-card', array( 'alt' => '' ) ) : '<span class="card__placeholder">' . vega_constellation_svg( $e['title'], 7 ) . '</span>';
	$html .= '</a><div class="card__body">';
	$html .= vega_eyebrow( trim( $e['section'] . ' · ' . vega_format_date_range( $e['date'], $e['end'] ), ' ·' ) );
	$html .= '<h3 class="card__title"><a href="' . esc_url( $e['url'] ) . '">' . esc_html( $e['title'] ) . '</a></h3>';
	if ( $e['place'] ) {
		$html .= '<p class="card__meta">' . vega_icon( 'pin' ) . esc_html( $e['place'] ) . '</p>';
	}
	$html .= '</div></article>';
	return $html;
}

/**
 * Список предстоящих событий.
 *
 * @param array $atts limit, section, layout (rows|cards), moreLink.
 */
function vega_render_events( $atts ) {
	$atts   = wp_parse_args(
		$atts,
		array(
			'limit'    => 6,
			'section'  => '',
			'layout'   => 'rows',
			'moreLink' => false,
		)
	);
	$events = vega_get_events(
		array(
			'mode'    => 'upcoming',
			'limit'   => $atts['limit'],
			'section' => $atts['section'],
		)
	);
	if ( ! $events ) {
		$html = '<div class="empty-note"><p>' . esc_html__( 'New dates are coming soon. Follow us on Instagram so you don’t miss them.', 'vega' ) . '</p>';
		if ( vega_option( 'instagram' ) ) {
			$html .= vega_button( vega_option( 'instagram' ), 'Instagram', 'ghost', array( 'icon' => 'instagram', 'external' => true ) );
		}
		return $html . '</div>';
	}
	if ( 'cards' === $atts['layout'] ) {
		$html = '<div class="card-grid card-grid--3">';
		foreach ( $events as $event ) {
			$html .= vega_event_card( $event );
		}
		$html .= '</div>';
	} else {
		$html = '<div class="event-list">';
		foreach ( $events as $event ) {
			$html .= vega_event_row( $event );
		}
		$html .= '</div>';
	}
	if ( $atts['moreLink'] ) {
		$url = vega_page_url( 'events' );
		if ( $url ) {
			$html .= '<p class="more-link"><a href="' . esc_url( $url ) . '">' . esc_html__( 'All events and tickets', 'vega' ) . vega_icon( 'arrow' ) . '</a></p>';
		}
	}
	return $html;
}

/**
 * Архив прошедших событий по годам.
 */
function vega_render_events_archive() {
	$events = vega_get_events(
		array(
			'mode'  => 'past',
			'limit' => 0,
		)
	);
	if ( ! $events ) {
		return '<p class="empty-note">' . esc_html__( 'The archive is empty for now.', 'vega' ) . '</p>';
	}
	$years = array();
	foreach ( $events as $event ) {
		$year             = substr( (string) get_post_meta( $event->ID, '_vega_date', true ), 0, 4 );
		$years[ $year ][] = $event;
	}
	krsort( $years );
	$html  = '<div class="events-archive">';
	$first = true;
	foreach ( $years as $year => $list ) {
		$html .= '<details class="events-archive__year"' . ( $first ? ' open' : '' ) . '>';
		/* translators: 1: year, 2: number of events. */
		$html .= '<summary><span class="events-archive__label">' . esc_html( $year ) . '</span><span class="events-archive__count">' . esc_html( sprintf( _n( '%s event', '%s events', count( $list ), 'vega' ), number_format_i18n( count( $list ) ) ) ) . '</span></summary><ul>';
		foreach ( $list as $event ) {
			$e     = vega_event_data( $event );
			$html .= '<li><span class="events-archive__date">' . esc_html( vega_format_date_range( $e['date'], $e['end'], false ) ) . '</span> <a href="' . esc_url( $e['url'] ) . '">' . esc_html( $e['title'] ) . '</a>' . ( $e['section'] ? ' <span class="events-archive__section">' . esc_html( $e['section'] ) . '</span>' : '' ) . '</li>';
		}
		$html .= '</ul></details>';
		$first = false;
	}
	return $html . '</div>';
}

/**
 * Разметка Schema.org для события (помогает Google показывать афишу).
 *
 * @param WP_Post $post Событие.
 */
function vega_event_schema( $post ) {
	$e = vega_event_data( $post );
	if ( ! $e['date'] ) {
		return '';
	}
	$start = $e['date'] . ( $e['time'] ? 'T' . $e['time'] . ':00' : '' );
	$data  = array(
		'@context'            => 'https://schema.org',
		'@type'               => 'Event',
		'name'                => wp_strip_all_tags( $e['title'] ),
		'startDate'           => $start,
		'eventStatus'         => 'https://schema.org/EventScheduled',
		'eventAttendanceMode' => 'https://schema.org/OfflineEventAttendanceMode',
		'url'                 => $e['url'],
		'location'            => array(
			'@type'   => 'Place',
			'name'    => $e['place'] ? $e['place'] : vega_option( 'address' ),
			'address' => $e['place'] ? $e['place'] : vega_option( 'address' ),
		),
		'organizer'           => array(
			'@type' => 'Organization',
			'name'  => 'Teatro Vega',
			'url'   => home_url( '/' ),
		),
	);
	if ( $e['end'] ) {
		$data['endDate'] = $e['end'];
	}
	if ( has_post_thumbnail( $post ) ) {
		$data['image'] = get_the_post_thumbnail_url( $post, 'large' );
	}
	if ( $e['tickets'] ) {
		$data['offers'] = array(
			'@type' => 'Offer',
			'url'   => $e['tickets'],
		);
	}
	return '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>';
}

/* ---------- Группы ---------- */

/**
 * Цена «80 € в месяц».
 *
 * @param string $amount Сумма.
 */
function vega_per_month( $amount ) {
	/* translators: %s: price, e.g. 80 €. */
	return sprintf( __( '%s per month', 'vega' ), vega_money( $amount ) );
}

/**
 * Строки с ценами группы.
 *
 * @param int $post_id ID группы.
 * @return string[]
 */
function vega_group_price_lines( $post_id ) {
	$member  = get_post_meta( $post_id, '_vega_price_member', true );
	$regular = get_post_meta( $post_id, '_vega_price_regular', true );
	$lines   = array();
	if ( '' !== $member && '' !== $regular ) {
		/* translators: %s: price per month. */
		$lines[] = sprintf( __( 'Actorre members: %s', 'vega' ), vega_per_month( $member ) );
		/* translators: %s: price per month. */
		$lines[] = sprintf( __( 'Without membership: %s', 'vega' ), vega_per_month( $regular ) );
	} elseif ( '' !== $regular ) {
		$lines[] = vega_per_month( $regular );
	} elseif ( '' !== $member ) {
		/* translators: %s: price per month. */
		$lines[] = sprintf( __( 'Actorre members: %s', 'vega' ), vega_per_month( $member ) );
	}
	return $lines;
}

/**
 * Карточка группы.
 *
 * @param WP_Post $post Группа.
 */
function vega_group_card( $post ) {
	$id        = $post->ID;
	$url       = get_permalink( $post );
	$age       = vega_age_label( get_post_meta( $id, '_vega_age_min', true ), get_post_meta( $id, '_vega_age_max', true ) );
	$direction = get_post_meta( $id, '_vega_direction', true );
	$schedule  = vega_schedule_summary( $id );
	$prices    = array_filter( array( get_post_meta( $id, '_vega_price_member', true ), get_post_meta( $id, '_vega_price_regular', true ) ), 'strlen' );

	$html  = '<article class="card group-card">';
	$html .= '<a class="card__media" href="' . esc_url( $url ) . '" tabindex="-1" aria-hidden="true">';
	$html .= has_post_thumbnail( $post ) ? get_the_post_thumbnail( $post, 'vega-card', array( 'alt' => '' ) ) : '<span class="card__placeholder">' . vega_constellation_svg( $post->post_title ) . '</span>';
	$html .= '</a><div class="card__body">';
	$html .= '<div class="card__top">' . vega_eyebrow( $age );
	if ( get_post_meta( $id, '_vega_recruiting', true ) ) {
		$html .= '<span class="badge">' . esc_html__( 'Now enrolling', 'vega' ) . '</span>';
	}
	$html .= '</div>';
	$html .= '<h3 class="card__title"><a href="' . esc_url( $url ) . '">' . esc_html( get_the_title( $post ) ) . '</a></h3>';
	if ( $direction ) {
		$html .= '<p class="card__text">' . esc_html( $direction ) . '</p>';
	}
	$html .= '<ul class="card__facts">';
	if ( $schedule ) {
		$html .= '<li>' . vega_icon( 'clock' ) . '<span>' . esc_html( $schedule ) . '</span></li>';
	}
	if ( $prices ) {
		/* translators: %s: price per month. */
		$html .= '<li>' . vega_icon( 'card' ) . '<span>' . esc_html( sprintf( __( 'from %s', 'vega' ), vega_per_month( min( array_map( 'intval', $prices ) ) ) ) ) . '</span></li>';
	}
	$html .= '</ul>';
	$html .= '<a class="card__more" href="' . esc_url( $url ) . '">' . esc_html__( 'More about the group', 'vega' ) . '<span class="screen-reader-text">: ' . esc_html( get_the_title( $post ) ) . '</span>' . vega_icon( 'arrow' ) . '</a>';
	$html .= '</div></article>';
	return $html;
}

/**
 * Сетка карточек групп.
 *
 * @param array $atts audience.
 */
function vega_render_groups( $atts ) {
	$atts   = wp_parse_args(
		$atts,
		array(
			'audience' => 'kids',
			'exclude'  => 0,
		)
	);
	$groups = vega_get_groups( $atts['audience'] );
	if ( ! $groups ) {
		return '<p class="empty-note">' . esc_html__( 'Groups will appear here soon.', 'vega' ) . '</p>';
	}
	$html = '<div class="card-grid card-grid--3">';
	foreach ( $groups as $group ) {
		if ( (int) $atts['exclude'] === $group->ID ) {
			continue;
		}
		$html .= vega_group_card( $group );
	}
	return $html . '</div>';
}

/**
 * Расписание по дням недели, собранное из групп.
 *
 * @param array $atts audience.
 */
function vega_render_schedule( $atts ) {
	$atts   = wp_parse_args( $atts, array( 'audience' => 'kids' ) );
	$groups = vega_get_groups( $atts['audience'] );
	$days   = array();
	foreach ( $groups as $group ) {
		foreach ( vega_get_schedule( $group->ID ) as $row ) {
			$days[ (int) $row['day'] ][] = array(
				'row'   => $row,
				'group' => $group,
			);
		}
	}
	if ( ! $days ) {
		return '<p class="empty-note">' . esc_html__( 'The timetable will appear here soon.', 'vega' ) . '</p>';
	}
	ksort( $days );
	$html = '<div class="timetable">';
	foreach ( $days as $day => $items ) {
		usort(
			$items,
			function ( $a, $b ) {
				return strcmp( $a['row']['start'], $b['row']['start'] );
			}
		);
		$html .= '<section class="timetable__day" aria-label="' . esc_attr( vega_weekday( $day ) ) . '"><h3 class="timetable__name">' . esc_html( vega_weekday( $day ) ) . '</h3><ul>';
		foreach ( $items as $item ) {
			$g     = $item['group'];
			$age   = vega_age_label( get_post_meta( $g->ID, '_vega_age_min', true ), get_post_meta( $g->ID, '_vega_age_max', true ) );
			$html .= '<li><span class="timetable__time">' . esc_html( vega_time_range( $item['row'] ) ) . '</span><a class="timetable__group" href="' . esc_url( get_permalink( $g ) ) . '">' . esc_html( get_the_title( $g ) ) . '</a>' . ( $age ? '<span class="timetable__age">' . esc_html( $age ) . '</span>' : '' ) . '</li>';
		}
		$html .= '</ul></section>';
	}
	return $html . '</div>';
}

/**
 * Таблица цен, собранная из групп.
 *
 * @param array $atts audience.
 */
function vega_render_prices( $atts ) {
	$atts   = wp_parse_args( $atts, array( 'audience' => 'kids' ) );
	$groups = vega_get_groups( $atts['audience'] );
	$rows   = '';
	foreach ( $groups as $g ) {
		$member  = get_post_meta( $g->ID, '_vega_price_member', true );
		$regular = get_post_meta( $g->ID, '_vega_price_regular', true );
		$note    = get_post_meta( $g->ID, '_vega_price_note', true );
		if ( '' === $member && '' === $regular && ! $note ) {
			continue;
		}
		$rows .= '<tr><th scope="row"><a href="' . esc_url( get_permalink( $g ) ) . '">' . esc_html( get_the_title( $g ) ) . '</a>' . ( $note ? '<span class="price-table__note">' . esc_html( $note ) . '</span>' : '' ) . '</th>';
		$rows .= '<td data-label="' . esc_attr__( 'Actorre members', 'vega' ) . '">' . ( '' !== $member ? esc_html( vega_money( $member ) ) : '—' ) . '</td>';
		$rows .= '<td data-label="' . esc_attr__( 'Without membership', 'vega' ) . '">' . ( '' !== $regular ? esc_html( vega_money( $regular ) ) : '—' ) . '</td></tr>';
	}
	if ( ! $rows ) {
		return '';
	}
	$html  = '<div class="price-table-wrap"><table class="price-table"><caption class="screen-reader-text">' . esc_html__( 'Prices per month', 'vega' ) . '</caption>';
	$html .= '<thead><tr><th scope="col">' . esc_html__( 'Group', 'vega' ) . '</th><th scope="col">' . esc_html__( 'Actorre members', 'vega' ) . '</th><th scope="col">' . esc_html__( 'Without membership', 'vega' ) . '</th></tr></thead>';
	return $html . '<tbody>' . $rows . '</tbody></table><p class="price-table__unit">' . esc_html__( 'Prices are per month.', 'vega' ) . '</p></div>';
}

/* ---------- Люди и спектакли ---------- */

/**
 * Карточка человека.
 *
 * @param WP_Post $post Человек.
 * @param string  $note Пояснение (что ведёт в группе, роль в спектакле).
 */
function vega_person_card( $post, $note = '' ) {
	$url        = get_permalink( $post );
	$directions = $note ? $note : get_post_meta( $post->ID, '_vega_directions', true );
	$html       = '<article class="card person-card">';
	$html      .= '<a class="card__media card__media--portrait" href="' . esc_url( $url ) . '" tabindex="-1" aria-hidden="true">';
	$html      .= has_post_thumbnail( $post ) ? get_the_post_thumbnail( $post, 'vega-portrait', array( 'alt' => '' ) ) : '<span class="card__placeholder card__placeholder--person"><span class="card__initials">' . esc_html( vega_initials( get_the_title( $post ) ) ) . '</span></span>';
	$html      .= '</a><div class="card__body">';
	$html      .= '<h3 class="card__title"><a href="' . esc_url( $url ) . '">' . esc_html( get_the_title( $post ) ) . '</a></h3>';
	if ( $directions ) {
		$html .= '<p class="card__text">' . esc_html( $directions ) . '</p>';
	}
	return $html . '</div></article>';
}

/**
 * Инициалы для карточки без фото.
 *
 * @param string $name Имя.
 */
function vega_initials( $name ) {
	$parts = preg_split( '/\s+/u', trim( wp_strip_all_tags( $name ) ) );
	$out   = '';
	foreach ( array_slice( $parts, 0, 2 ) as $part ) {
		$out .= mb_substr( $part, 0, 1 );
	}
	return mb_strtoupper( $out );
}

/**
 * Сетка людей.
 *
 * @param array $atts role, limit, activeOnly.
 */
function vega_render_people( $atts ) {
	$atts   = wp_parse_args(
		$atts,
		array(
			'role'       => 'teacher',
			'limit'      => 0,
			'activeOnly' => true,
		)
	);
	$people = vega_get_people( $atts['role'], (bool) $atts['activeOnly'], (int) $atts['limit'] );
	if ( ! $people ) {
		return '<p class="empty-note">' . esc_html__( 'This list will be filled in soon.', 'vega' ) . '</p>';
	}
	$html = '<div class="card-grid card-grid--people">';
	foreach ( $people as $person ) {
		$html .= vega_person_card( $person );
	}
	return $html . '</div>';
}

/**
 * Карточка спектакля.
 *
 * @param WP_Post $post Спектакль.
 */
function vega_show_card( $post ) {
	$url   = get_permalink( $post );
	$year  = get_post_meta( $post->ID, '_vega_year', true );
	$html  = '<article class="card show-card">';
	$html .= '<a class="card__media card__media--poster" href="' . esc_url( $url ) . '" tabindex="-1" aria-hidden="true">';
	$html .= has_post_thumbnail( $post ) ? get_the_post_thumbnail( $post, 'vega-poster', array( 'alt' => '' ) ) : '<span class="card__placeholder">' . vega_constellation_svg( $post->post_title, 7 ) . '</span>';
	$html .= '</a><div class="card__body">';
	$html .= vega_eyebrow( $year );
	$html .= '<h3 class="card__title"><a href="' . esc_url( $url ) . '">' . esc_html( get_the_title( $post ) ) . '</a></h3>';
	return $html . '</div></article>';
}

/**
 * Сетка спектаклей.
 *
 * @param array $atts limit.
 */
function vega_render_shows( $atts ) {
	$atts  = wp_parse_args( $atts, array( 'limit' => 0 ) );
	$shows = vega_get_shows( (int) $atts['limit'] );
	if ( ! $shows ) {
		return '<p class="empty-note">' . esc_html__( 'This list will be filled in soon.', 'vega' ) . '</p>';
	}
	$html = '<div class="card-grid card-grid--4">';
	foreach ( $shows as $show ) {
		$html .= vega_show_card( $show );
	}
	return $html . '</div>';
}

/* ---------- Пожертвования ---------- */

/**
 * Строка реквизита с кнопкой «Скопировать».
 *
 * @param string $label Название.
 * @param string $shown Как показать.
 * @param string $copy  Что копировать.
 */
function vega_copy_row( $label, $shown, $copy = null ) {
	$copy = null === $copy ? $shown : $copy;
	$html = '<div class="copy-row"><dt>' . esc_html( $label ) . '</dt><dd><span class="copy-row__value">' . esc_html( $shown ) . '</span>';
	/* translators: %s: field name, e.g. IBAN. */
	$html .= '<button type="button" class="copy-btn" data-copy="' . esc_attr( $copy ) . '" aria-label="' . esc_attr( sprintf( __( 'Copy: %s', 'vega' ), $label ) ) . '">' . vega_icon( 'copy' ) . '<span class="copy-btn__text">' . esc_html__( 'Copy', 'vega' ) . '</span></button>';
	return $html . '</dd></div>';
}

/**
 * Блок «Банковский перевод» и кнопки Patreon / оплата картой.
 * Реквизиты берутся только из настроек темы.
 */
function vega_render_donate() {
	$iban      = vega_option( 'donate_iban' );
	$recipient = vega_option( 'donate_recipient' );
	$bic       = vega_option( 'donate_bic' );
	$concept   = vega_option( 'donate_concept' );
	$html      = '<div class="donate">';

	if ( $iban ) {
		$html .= '<section class="donate__bank card card--flat"><h3 class="donate__title">' . esc_html__( 'Bank transfer', 'vega' ) . '</h3><dl class="copy-list">';
		if ( $recipient ) {
			$html .= vega_copy_row( __( 'Recipient', 'vega' ), $recipient );
		}
		$html .= vega_copy_row( 'IBAN', vega_format_iban( $iban ), strtoupper( preg_replace( '/\s+/', '', $iban ) ) );
		if ( $bic ) {
			$html .= vega_copy_row( 'BIC / SWIFT', strtoupper( trim( $bic ) ) );
		}
		if ( $concept ) {
			$html .= vega_copy_row( __( 'Payment reference', 'vega' ), $concept );
		}
		$html .= '</dl><p class="copy-status" role="status" aria-live="polite"></p></section>';
	} elseif ( current_user_can( 'manage_options' ) ) {
		$html .= '<p class="admin-hint">Реквизиты не заполнены. Введите их в админке: «Театр Вега» → «Пожертвования». Эту подсказку видят только администраторы.</p>';
	}

	$links = '';
	if ( vega_option( 'donate_card' ) ) {
		$links .= vega_button( vega_option( 'donate_card' ), __( 'Donate by card', 'vega' ), 'primary', array( 'icon' => 'card', 'external' => true ) );
	}
	if ( vega_option( 'donate_patreon' ) ) {
		$links .= vega_button( vega_option( 'donate_patreon' ), __( 'Support us on Patreon', 'vega' ), 'ghost', array( 'icon' => 'heart', 'external' => true ) );
	}
	if ( $links ) {
		$html .= '<div class="btn-row donate__links">' . $links . '</div>';
	}
	$html .= '<p class="donate__note">' . esc_html__( 'Donations are received only by the cultural association Actorre, which runs Teatro Vega.', 'vega' ) . '</p>';
	return $html . '</div>';
}

/* ---------- Контакты ---------- */

/**
 * Ссылки на соцсети.
 *
 * @param string $set vega | shkhuna.
 */
function vega_render_socials( $set = 'vega' ) {
	$keys = 'shkhuna' === $set
		? array(
			'shkhuna_instagram' => array( 'instagram', 'Instagram' ),
			'shkhuna_facebook'  => array( 'facebook', 'Facebook' ),
		)
		: array(
			'instagram' => array( 'instagram', 'Instagram' ),
			'facebook'  => array( 'facebook', 'Facebook' ),
			'youtube'   => array( 'youtube', 'YouTube' ),
		);
	$html = '';
	foreach ( $keys as $key => $info ) {
		$url = vega_option( $key );
		if ( $url ) {
			$html .= '<li><a href="' . esc_url( $url ) . '"' . vega_external_attrs() . '>' . vega_icon( $info[0] ) . '<span>' . esc_html( $info[1] ) . '</span>' . vega_new_tab_hint() . '</a></li>';
		}
	}
	return $html ? '<ul class="socials">' . $html . '</ul>' : '';
}

/**
 * Телефон с подписью и ссылкой на WhatsApp.
 *
 * @param string $label  Подпись.
 * @param string $phone  Телефон.
 * @param string $wa_key enrol | director.
 */
function vega_phone_line( $label, $phone, $wa_key ) {
	if ( ! $phone ) {
		return '';
	}
	$html = '<li class="contact-line"><span class="contact-line__label">' . esc_html( $label ) . '</span><a href="' . esc_url( vega_tel_href( $phone ) ) . '">' . vega_icon( 'phone' ) . esc_html( $phone ) . '</a>';
	$wa   = vega_whatsapp_url( $wa_key );
	if ( $wa ) {
		$html .= ' <a class="contact-line__wa" href="' . esc_url( $wa ) . '"' . vega_external_attrs() . '>' . vega_icon( 'whatsapp' ) . 'WhatsApp' . vega_new_tab_hint() . '</a>';
	}
	return $html . '</li>';
}

/**
 * Блок контактов: адрес, телефоны, почта, соцсети, карта.
 *
 * @param array $atts map (bool).
 */
function vega_render_contacts( $atts = array() ) {
	$atts    = wp_parse_args( $atts, array( 'map' => true ) );
	$address = vega_option( 'address' );
	$html    = '<div class="contacts' . ( $atts['map'] && $address ? ' contacts--with-map' : '' ) . '"><div class="contacts__info">';
	if ( $address ) {
		$html .= '<p class="contacts__address">' . vega_icon( 'pin' ) . '<span>' . esc_html( $address ) . '</span></p>';
	}
	$html .= '<ul class="contacts__list">';
	$html .= vega_phone_line( __( 'Enrolment', 'vega' ), vega_option( 'phone_enrol' ), 'enrol' );
	$html .= vega_phone_line( __( 'Artistic director', 'vega' ), vega_option( 'phone_director' ), 'director' );
	foreach ( array(
		'email_studio'  => __( 'Studio email', 'vega' ),
		'email_actorre' => __( 'Actorre association', 'vega' ),
	) as $key => $label ) {
		$email = vega_option( $key );
		if ( $email ) {
			$html .= '<li class="contact-line"><span class="contact-line__label">' . esc_html( $label ) . '</span><a href="mailto:' . esc_attr( antispambot( $email ) ) . '">' . vega_icon( 'mail' ) . esc_html( antispambot( $email ) ) . '</a></li>';
		}
	}
	$html .= '</ul>' . vega_render_socials() . '</div>';
	if ( $atts['map'] && $address ) {
		$q     = rawurlencode( $address );
		$html .= '<div class="map" data-map-src="' . esc_url( 'https://www.google.com/maps?q=' . $q . '&output=embed' ) . '" data-map-title="' . esc_attr__( 'Map: how to find us', 'vega' ) . '">';
		$html .= '<div class="map__placeholder">' . vega_icon( 'map' ) . '<p>' . esc_html__( 'The map is loaded from Google Maps only after you click.', 'vega' ) . '</p>';
		$html .= '<button type="button" class="btn btn--ghost" data-map-load>' . esc_html__( 'Show map', 'vega' ) . '</button>';
		$html .= '<a class="map__link" href="' . esc_url( 'https://www.google.com/maps/search/?api=1&query=' . $q ) . '"' . vega_external_attrs() . '>' . esc_html__( 'Open in Google Maps', 'vega' ) . vega_new_tab_hint() . '</a></div></div>';
	}
	return $html . '</div>';
}
