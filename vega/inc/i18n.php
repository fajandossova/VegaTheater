<?php
/**
 * Языки: Polylang, даты, возраст, цены.
 *
 * Надписи темы написаны по-английски и переведены в languages/ru_RU.mo и es_ES.mo.
 * Названия месяцев и дней недели тоже переводит тема, поэтому даты выглядят
 * правильно даже без языковых пакетов WordPress.
 *
 * @package Vega
 */

defined( 'ABSPATH' ) || exit;

/**
 * Включён ли Polylang.
 */
function vega_has_polylang() {
	return function_exists( 'pll_current_language' ) && function_exists( 'pll_the_languages' );
}

/**
 * Текущий язык: ru, es или en.
 */
function vega_lang() {
	if ( vega_has_polylang() ) {
		$slug = pll_current_language( 'slug' );
		if ( $slug ) {
			return $slug;
		}
	}
	return substr( determine_locale(), 0, 2 );
}

/**
 * ID записи в текущем языке (если есть перевод), иначе исходный ID.
 *
 * @param int $id ID записи.
 */
function vega_translated_id( $id ) {
	$id = (int) $id;
	if ( $id && function_exists( 'pll_get_post' ) ) {
		$tr = pll_get_post( $id );
		if ( $tr ) {
			return (int) $tr;
		}
	}
	return $id;
}

/**
 * Переключатель языков RU · ES · EN. Без Polylang ничего не выводит.
 *
 * @param string $extra_class Дополнительный класс.
 */
function vega_language_switcher( $extra_class = '' ) {
	if ( ! vega_has_polylang() ) {
		return '';
	}
	$langs = pll_the_languages(
		array(
			'raw'                    => 1,
			'hide_if_empty'          => 0,
			'hide_if_no_translation' => 0,
		)
	);
	if ( empty( $langs ) || ! is_array( $langs ) || count( $langs ) < 2 ) {
		return '';
	}
	$items = array();
	foreach ( $langs as $lang ) {
		$code = strtoupper( $lang['slug'] );
		$name = isset( $lang['name'] ) ? $lang['name'] : $code;
		$attr = isset( $lang['locale'] ) ? ' hreflang="' . esc_attr( str_replace( '_', '-', $lang['locale'] ) ) . '" lang="' . esc_attr( str_replace( '_', '-', $lang['locale'] ) ) . '"' : '';
		if ( ! empty( $lang['current_lang'] ) ) {
			$items[] = '<li><span class="lang-switch__current" aria-current="true"><abbr title="' . esc_attr( $name ) . '">' . esc_html( $code ) . '</abbr></span></li>';
		} else {
			$items[] = '<li><a href="' . esc_url( $lang['url'] ) . '"' . $attr . '><abbr title="' . esc_attr( $name ) . '">' . esc_html( $code ) . '</abbr></a></li>';
		}
	}
	return '<nav class="lang-switch ' . esc_attr( $extra_class ) . '" aria-label="' . esc_attr__( 'Language', 'vega' ) . '"><ul>' . implode( '<li class="lang-switch__dot" aria-hidden="true">·</li>', $items ) . '</ul></nav>';
}

/**
 * Типы записей темы переводятся через Polylang (три связанные версии).
 */
add_filter(
	'pll_get_post_types',
	function ( $types, $is_settings ) {
		foreach ( array( 'vega_event', 'vega_group', 'vega_person', 'vega_show' ) as $type ) {
			$types[ $type ] = $type;
		}
		return $types;
	},
	10,
	2
);

/**
 * Какие поля копировать при создании перевода в Polylang.
 * При создании перевода копируются все поля, чтобы не вводить их заново.
 * При синхронизации (если она включена) — только не зависящие от языка:
 * даты, ссылки, цены-числа, связи.
 */
add_filter(
	'pll_copy_post_metas',
	function ( $metas, $sync ) {
		$neutral = array(
			'_vega_date',
			'_vega_time',
			'_vega_end_date',
			'_vega_sort',
			'_vega_until',
			'_vega_tickets',
			'_vega_section',
			'_vega_audience',
			'_vega_age_min',
			'_vega_age_max',
			'_vega_schedule',
			'_vega_price_member',
			'_vega_price_regular',
			'_vega_recruiting',
			'_vega_form',
			'_vega_role',
			'_vega_active',
			'_vega_year',
			'_vega_gallery',
		);
		$texts   = array(
			'_vega_place',
			'_vega_price',
			'_vega_direction',
			'_vega_schedule_note',
			'_vega_teachers',
			'_vega_price_note',
			'_vega_directions',
			'_vega_cast',
		);
		$metas   = array_merge( (array) $metas, $neutral );
		if ( ! $sync ) {
			$metas = array_merge( $metas, $texts );
		}
		return array_values( array_unique( $metas ) );
	},
	10,
	2
);

/**
 * Название месяца.
 *
 * @param int  $month    1–12.
 * @param bool $genitive Родительный падеж («16 октября»).
 */
function vega_month_name( $month, $genitive = true ) {
	$month = (int) $month;
	if ( $genitive ) {
		$names = array(
			1  => _x( 'January', 'month name in a date (genitive)', 'vega' ),
			2  => _x( 'February', 'month name in a date (genitive)', 'vega' ),
			3  => _x( 'March', 'month name in a date (genitive)', 'vega' ),
			4  => _x( 'April', 'month name in a date (genitive)', 'vega' ),
			5  => _x( 'May', 'month name in a date (genitive)', 'vega' ),
			6  => _x( 'June', 'month name in a date (genitive)', 'vega' ),
			7  => _x( 'July', 'month name in a date (genitive)', 'vega' ),
			8  => _x( 'August', 'month name in a date (genitive)', 'vega' ),
			9  => _x( 'September', 'month name in a date (genitive)', 'vega' ),
			10 => _x( 'October', 'month name in a date (genitive)', 'vega' ),
			11 => _x( 'November', 'month name in a date (genitive)', 'vega' ),
			12 => _x( 'December', 'month name in a date (genitive)', 'vega' ),
		);
	} else {
		$names = array(
			1  => _x( 'January', 'month name on its own', 'vega' ),
			2  => _x( 'February', 'month name on its own', 'vega' ),
			3  => _x( 'March', 'month name on its own', 'vega' ),
			4  => _x( 'April', 'month name on its own', 'vega' ),
			5  => _x( 'May', 'month name on its own', 'vega' ),
			6  => _x( 'June', 'month name on its own', 'vega' ),
			7  => _x( 'July', 'month name on its own', 'vega' ),
			8  => _x( 'August', 'month name on its own', 'vega' ),
			9  => _x( 'September', 'month name on its own', 'vega' ),
			10 => _x( 'October', 'month name on its own', 'vega' ),
			11 => _x( 'November', 'month name on its own', 'vega' ),
			12 => _x( 'December', 'month name on its own', 'vega' ),
		);
	}
	return isset( $names[ $month ] ) ? $names[ $month ] : '';
}

/**
 * Короткое название месяца для «календарного листка» в афише.
 *
 * @param int $month 1–12.
 */
function vega_month_short( $month ) {
	$names = array(
		1  => _x( 'Jan', 'short month', 'vega' ),
		2  => _x( 'Feb', 'short month', 'vega' ),
		3  => _x( 'Mar', 'short month', 'vega' ),
		4  => _x( 'Apr', 'short month', 'vega' ),
		5  => _x( 'May', 'short month', 'vega' ),
		6  => _x( 'Jun', 'short month', 'vega' ),
		7  => _x( 'Jul', 'short month', 'vega' ),
		8  => _x( 'Aug', 'short month', 'vega' ),
		9  => _x( 'Sep', 'short month', 'vega' ),
		10 => _x( 'Oct', 'short month', 'vega' ),
		11 => _x( 'Nov', 'short month', 'vega' ),
		12 => _x( 'Dec', 'short month', 'vega' ),
	);
	$month = (int) $month;
	return isset( $names[ $month ] ) ? $names[ $month ] : '';
}

/**
 * День недели. 1 — понедельник … 7 — воскресенье.
 *
 * @param int  $day   1–7.
 * @param bool $short Короткая форма.
 */
function vega_weekday( $day, $short = false ) {
	$day = (int) $day;
	if ( $short ) {
		$names = array(
			1 => _x( 'Mon', 'short weekday', 'vega' ),
			2 => _x( 'Tue', 'short weekday', 'vega' ),
			3 => _x( 'Wed', 'short weekday', 'vega' ),
			4 => _x( 'Thu', 'short weekday', 'vega' ),
			5 => _x( 'Fri', 'short weekday', 'vega' ),
			6 => _x( 'Sat', 'short weekday', 'vega' ),
			7 => _x( 'Sun', 'short weekday', 'vega' ),
		);
	} else {
		$names = array(
			1 => __( 'Monday', 'vega' ),
			2 => __( 'Tuesday', 'vega' ),
			3 => __( 'Wednesday', 'vega' ),
			4 => __( 'Thursday', 'vega' ),
			5 => __( 'Friday', 'vega' ),
			6 => __( 'Saturday', 'vega' ),
			7 => __( 'Sunday', 'vega' ),
		);
	}
	return isset( $names[ $day ] ) ? $names[ $day ] : '';
}

/**
 * Разбирает дату 'Y-m-d' на части.
 *
 * @param string $ymd Дата.
 * @return array{0:int,1:int,2:int}|null [год, месяц, день]
 */
function vega_parse_date( $ymd ) {
	if ( ! is_string( $ymd ) || ! preg_match( '/^(\d{4})-(\d{2})-(\d{2})$/', $ymd, $m ) ) {
		return null;
	}
	return array( (int) $m[1], (int) $m[2], (int) $m[3] );
}

/**
 * «16 октября 2026», «16 de octubre de 2026», «16 October 2026».
 *
 * @param string $ymd       Дата 'Y-m-d'.
 * @param bool   $with_year Показывать год.
 */
function vega_format_date( $ymd, $with_year = true ) {
	$d = vega_parse_date( $ymd );
	if ( ! $d ) {
		return '';
	}
	if ( $with_year ) {
		/* translators: 1: day number, 2: month name, 3: year. */
		return sprintf( _x( '%1$s %2$s %3$s', 'date with year', 'vega' ), $d[2], vega_month_name( $d[1] ), $d[0] );
	}
	/* translators: 1: day number, 2: month name. */
	return sprintf( _x( '%1$s %2$s', 'date without year', 'vega' ), $d[2], vega_month_name( $d[1] ) );
}

/**
 * Даты события: один день или промежуток («16–18 октября 2026»).
 *
 * @param string $start     Начало 'Y-m-d'.
 * @param string $end       Конец 'Y-m-d' или пусто.
 * @param bool   $with_year Показывать год.
 */
function vega_format_date_range( $start, $end = '', $with_year = true ) {
	$s = vega_parse_date( $start );
	$e = vega_parse_date( $end );
	if ( ! $s ) {
		return '';
	}
	if ( ! $e || $end <= $start ) {
		return vega_format_date( $start, $with_year );
	}
	if ( $s[0] === $e[0] && $s[1] === $e[1] ) {
		if ( $with_year ) {
			/* translators: 1: first day, 2: last day, 3: month name, 4: year. Example: 16–18 October 2026. */
			return sprintf( _x( '%1$s–%2$s %3$s %4$s', 'date range within one month', 'vega' ), $s[2], $e[2], vega_month_name( $s[1] ), $s[0] );
		}
		/* translators: 1: first day, 2: last day, 3: month name. */
		return sprintf( _x( '%1$s–%2$s %3$s', 'date range within one month, no year', 'vega' ), $s[2], $e[2], vega_month_name( $s[1] ) );
	}
	return vega_format_date( $start, $with_year && $s[0] !== $e[0] ) . ' – ' . vega_format_date( $end, $with_year );
}

/**
 * День недели для даты.
 *
 * @param string $ymd  Дата 'Y-m-d'.
 * @param bool   $short Короткая форма.
 */
function vega_weekday_of( $ymd, $short = true ) {
	$d = vega_parse_date( $ymd );
	if ( ! $d ) {
		return '';
	}
	$n = (int) gmdate( 'N', gmmktime( 12, 0, 0, $d[1], $d[2], $d[0] ) );
	return vega_weekday( $n, $short );
}

/**
 * Возраст: «4–6 лет», «от 17 лет».
 *
 * @param int|string $min От.
 * @param int|string $max До.
 */
function vega_age_label( $min, $max ) {
	$min = '' === $min ? 0 : (int) $min;
	$max = '' === $max ? 0 : (int) $max;
	if ( $min && $max ) {
		/* translators: 1: minimum age, 2: maximum age. */
		return sprintf( _n( '%1$s–%2$s year', '%1$s–%2$s years', $max, 'vega' ), $min, $max );
	}
	if ( $min ) {
		/* translators: %s: minimum age. */
		return sprintf( _n( 'from %s year', 'from %s years', $min, 'vega' ), $min );
	}
	if ( $max ) {
		/* translators: %s: maximum age. */
		return sprintf( _n( 'up to %s year', 'up to %s years', $max, 'vega' ), $max );
	}
	return '';
}

/**
 * Цена: «80 €».
 *
 * @param string|int $amount Сумма.
 */
function vega_money( $amount ) {
	$amount = trim( (string) $amount );
	if ( '' === $amount ) {
		return '';
	}
	if ( is_numeric( str_replace( ',', '.', $amount ) ) ) {
		return $amount . "\u{00A0}€";
	}
	return $amount;
}

/**
 * Названия разделов афиши.
 */
function vega_event_sections() {
	return array(
		'show'     => __( 'Performance', 'vega' ),
		'concert'  => __( 'Concert', 'vega' ),
		'festival' => __( 'Festival', 'vega' ),
		'workshop' => __( 'Workshop', 'vega' ),
		'shkhuna'  => __( 'Shkhuna', 'vega' ),
	);
}

/**
 * Названия ролей людей.
 */
function vega_person_roles() {
	return array(
		'teacher' => __( 'Teacher', 'vega' ),
		'artist'  => __( 'Artist', 'vega' ),
		'guest'   => __( 'Guest', 'vega' ),
	);
}
