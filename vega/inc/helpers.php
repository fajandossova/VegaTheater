<?php
/**
 * Настройки темы и мелкие помощники.
 *
 * @package Vega
 */

defined( 'ABSPATH' ) || exit;

/**
 * Значения настроек по умолчанию.
 * Реквизиты счёта здесь нарочно пустые: их вводят только в админке.
 */
function vega_defaults() {
	return array(
		// Логотипы (ID картинок из медиатеки).
		'logo_vega'           => 0,
		'logo_actorre'        => 0,
		'logo_shkhuna'        => 0,

		// Контакты.
		'address'             => 'Calle Santander 10, 03181 Torrevieja, Alicante',
		'phone_enrol'         => '+34 627 26 76 96',
		'whatsapp_enrol'      => '+34 627 26 76 96',
		'phone_director'      => '+34 652 617 534',
		'whatsapp_director'   => '+34 652 617 534',
		'email_studio'        => 'vega.torrevieja@gmail.com',
		'email_actorre'       => 'actorre.centro@gmail.com',

		// Соцсети.
		'instagram'           => 'https://www.instagram.com/vega.theater/',
		'facebook'            => 'https://www.facebook.com/vega.theater/',
		'youtube'             => 'https://www.youtube.com/@TeatroVega',
		'shkhuna_facebook'    => 'https://www.facebook.com/spainbards/',
		'shkhuna_instagram'   => 'https://www.instagram.com/bards.torrevieja/',

		// Билеты и формы.
		'tickets_url'         => 'https://tickets.arenasoldout.com/actorre',
		'form_kids'           => 'https://docs.google.com/forms/d/e/1FAIpQLSeJ6rpo3qQCng-RORxx9M0LIshfG2all9RnD8GXn_SpOv7Z4g/viewform',
		'form_adults'         => 'https://docs.google.com/forms/d/e/1FAIpQLSchRA5_O1rI77TFGhM42jRlw-nxmW8x-aZa_T0rzKQ0eJlzLA/viewform',
		'form_actorre_adult'  => 'https://docs.google.com/forms/d/e/1FAIpQLSd7cWFByhNTRYry2gdIduzz-5S1uUXuOWJYo3J0Vk7ORUkh4Q/viewform',
		'form_actorre_parent' => 'https://docs.google.com/forms/d/e/1FAIpQLSdm06aqJxqgekuiO0OCcnIkWSUReoIy70q5EacHzxGt6UB1HA/viewform',
		'form_festival'       => 'https://forms.gle/TrrKa5M7DpCbHNwh9',

		// Пожертвования (только ассоциация Actorre).
		'donate_recipient'    => 'Asociación Cultural Centro de Art «Actorre»',
		'donate_iban'         => '',
		'donate_bic'          => '',
		'donate_concept'      => 'Donación benéfica para la Asoc Cultural Actorre',
		'donate_patreon'      => '',
		'donate_card'         => '',

		// Служебные страницы (ID русских версий; переводы находятся через Polylang).
		'page_home'           => 0,
		'page_kids'           => 0,
		'page_adults'         => 0,
		'page_events'         => 0,
		'page_teachers'       => 0,
		'page_about'          => 0,
		'page_actorre'        => 0,
		'page_shkhuna'        => 0,
		'page_fest_sky'       => 0,
		'page_fest_hilos'     => 0,
		'page_donate'         => 0,
		'page_contacts'       => 0,
		'page_privacy'        => 0,
	);
}

/**
 * Значение настройки темы.
 *
 * @param string $key Ключ из vega_defaults().
 * @return mixed
 */
function vega_option( $key ) {
	$saved    = get_option( 'vega_options', array() );
	$options  = wp_parse_args( is_array( $saved ) ? $saved : array(), vega_defaults() );
	return isset( $options[ $key ] ) ? $options[ $key ] : '';
}

/**
 * Список форм записи. У каждой формы своя настройка и своя подпись кнопки.
 * Здесь только названия для админки; подписи кнопок на сайте — в vega_form_label().
 *
 * @return array<string, array{setting: string, admin: string}>
 */
function vega_forms() {
	return array(
		'kids'           => array(
			'setting' => 'form_kids',
			'admin'   => 'Детская студия и пробное занятие',
		),
		'adults'         => array(
			'setting' => 'form_adults',
			'admin'   => 'Курсы для подростков и взрослых',
		),
		'actorre_adult'  => array(
			'setting' => 'form_actorre_adult',
			'admin'   => 'Вступление в Actorre — взрослые',
		),
		'actorre_parent' => array(
			'setting' => 'form_actorre_parent',
			'admin'   => 'Вступление в Actorre — родители несовершеннолетних',
		),
		'festival'       => array(
			'setting' => 'form_festival',
			'admin'   => 'Регистрация на фестиваль «Под небом Испании»',
		),
	);
}

/**
 * Подпись кнопки формы на языке страницы.
 *
 * @param string $form Ключ формы.
 */
function vega_form_label( $form ) {
	switch ( $form ) {
		case 'kids':
			return __( 'Book a free trial class', 'vega' );
		case 'adults':
			return __( 'Sign up: teens and adults', 'vega' );
		case 'actorre_adult':
			return __( 'Join Actorre (adults)', 'vega' );
		case 'actorre_parent':
			return __( 'Join Actorre (parents of minors)', 'vega' );
		case 'festival':
			return __( 'Register for the festival', 'vega' );
	}
	return '';
}

/**
 * Ссылка на форму или пустая строка.
 *
 * @param string $form Ключ формы.
 */
function vega_form_url( $form ) {
	$forms = vega_forms();
	if ( ! isset( $forms[ $form ] ) ) {
		return '';
	}
	return (string) vega_option( $forms[ $form ]['setting'] );
}

/**
 * Только цифры номера телефона.
 *
 * @param string $phone Телефон в любом виде.
 */
function vega_phone_digits( $phone ) {
	return preg_replace( '/\D+/', '', (string) $phone );
}

/**
 * Ссылка tel:.
 *
 * @param string $phone Телефон.
 */
function vega_tel_href( $phone ) {
	$digits = vega_phone_digits( $phone );
	return $digits ? 'tel:+' . $digits : '';
}

/**
 * Ссылка «Написать в WhatsApp».
 *
 * @param string $which enrol — запись в студию, director — руководитель.
 */
function vega_whatsapp_url( $which = 'enrol' ) {
	$digits = vega_phone_digits( vega_option( 'director' === $which ? 'whatsapp_director' : 'whatsapp_enrol' ) );
	if ( ! $digits ) {
		return '';
	}
	$text = __( 'Hello! I am writing from the Teatro Vega website.', 'vega' );
	return 'https://wa.me/' . $digits . '?text=' . rawurlencode( $text );
}

/**
 * Ссылка на служебную страницу в текущем языке.
 *
 * @param string $role Ключ без префикса page_ (kids, events, donate…).
 */
function vega_page_id( $role ) {
	$id = (int) vega_option( 'page_' . $role );
	if ( ! $id || 'publish' !== get_post_status( $id ) ) {
		return 0;
	}
	return vega_translated_id( $id );
}

/**
 * Адрес служебной страницы в текущем языке.
 *
 * @param string $role Ключ без префикса page_.
 */
function vega_page_url( $role ) {
	$id = vega_page_id( $role );
	return $id ? get_permalink( $id ) : '';
}

/**
 * HTML логотипа: картинка из настроек или текстовое название.
 *
 * @param string $which vega | actorre | shkhuna.
 * @param string $size  Размер картинки.
 */
function vega_logo_html( $which = 'vega', $size = 'medium' ) {
	$names = array(
		'vega'    => 'Teatro Vega',
		'actorre' => 'Actorre',
		'shkhuna' => __( 'Shkhuna', 'vega' ),
	);
	$name  = isset( $names[ $which ] ) ? $names[ $which ] : $names['vega'];
	$id    = (int) vega_option( 'logo_' . $which );
	if ( $id && wp_attachment_is_image( $id ) ) {
		return wp_get_attachment_image(
			$id,
			$size,
			false,
			array(
				'class'   => 'vega-logo__img',
				'alt'     => $name,
				'loading' => 'eager',
			)
		);
	}
	return '<span class="vega-logo__text">' . vega_icon( 'star' ) . '<span>' . esc_html( $name ) . '</span></span>';
}

/**
 * Небольшие SVG-иконки (рисуем сами, без внешних библиотек).
 *
 * @param string $name Имя иконки.
 */
function vega_icon( $name ) {
	$paths = array(
		'star'      => '<path d="M12 2.5l1.9 7.6 7.6 1.9-7.6 1.9L12 21.5l-1.9-7.6L2.5 12l7.6-1.9z" fill="currentColor" stroke="none"/>',
		'arrow'     => '<path d="M4 12h15M13 6l6 6-6 6"/>',
		'external'  => '<path d="M14 4h6v6M20 4l-9 9M18 14v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h5"/>',
		'copy'      => '<rect x="8" y="8" width="12" height="12" rx="1"/><path d="M16 8V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h3"/>',
		'check'     => '<path d="M5 12.5l4.5 4.5L19 7.5"/>',
		'phone'     => '<path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a1 1 0 0 1-1 1A16 16 0 0 1 4 5a1 1 0 0 1 1-1z"/>',
		'mail'      => '<rect x="3" y="5" width="18" height="14" rx="1"/><path d="M3 7l9 6 9-6"/>',
		'pin'       => '<path d="M12 21s-7-6.2-7-11.5a7 7 0 0 1 14 0C19 14.8 12 21 12 21z"/><circle cx="12" cy="9.5" r="2.5"/>',
		'clock'     => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
		'ticket'    => '<path d="M3 8a2 2 0 0 0 0 4v0a2 2 0 0 1 0 4v2h18v-2a2 2 0 0 1 0-4 2 2 0 0 0 0-4V6H3z" transform="translate(0 -1)"/><path d="M14 5v14" stroke-dasharray="2 2"/>',
		'menu'      => '<path d="M4 7h16M4 12h16M4 17h16"/>',
		'close'     => '<path d="M6 6l12 12M18 6L6 18"/>',
		'whatsapp'  => '<path d="M12 3a9 9 0 0 0-7.8 13.5L3 21l4.6-1.2A9 9 0 1 0 12 3z"/><path d="M8.8 8.3c.2-.5.5-.5.8-.5h.5c.2 0 .4 0 .6.5l.7 1.7c.1.2 0 .4-.1.6l-.5.6c-.1.2-.2.3 0 .6a6.6 6.6 0 0 0 3 2.6c.3.1.4.1.6-.1l.7-.8c.2-.2.4-.2.6-.1l1.7.8c.2.1.4.2.4.4 0 .5-.2 1.2-.7 1.6-.5.4-1.4.7-2.5.4a9.6 9.6 0 0 1-5.3-4.6c-.6-1.1-.7-2.4.1-3.5z" fill="currentColor" stroke="none"/>',
		'instagram' => '<rect x="3.5" y="3.5" width="17" height="17" rx="4.5"/><circle cx="12" cy="12" r="4"/><circle cx="17.2" cy="6.8" r="1" fill="currentColor" stroke="none"/>',
		'facebook'  => '<path d="M14 8h3V4h-3a4 4 0 0 0-4 4v2H7v4h3v8h4v-8h3l1-4h-4V8.5a.5.5 0 0 1 .5-.5z"/>',
		'youtube'   => '<rect x="2.5" y="5.5" width="19" height="13" rx="3.5"/><path d="M10 9v6l5-3z" fill="currentColor" stroke="none"/>',
		'heart'     => '<path d="M12 20s-7.5-4.6-9-9.3C2 7.4 4.2 4.5 7.2 4.5c2 0 3.6 1.2 4.8 3 1.2-1.8 2.8-3 4.8-3 3 0 5.2 2.9 4.2 6.2-1.5 4.7-9 9.3-9 9.3z"/>',
		'card'      => '<rect x="3" y="5.5" width="18" height="13" rx="1.5"/><path d="M3 10h18M7 15h4"/>',
		'map'       => '<path d="M9 4L3 6.5v13.5l6-2.5 6 2.5 6-2.5V4l-6 2.5z"/><path d="M9 4v13.5M15 6.5V20"/>',
	);
	if ( ! isset( $paths[ $name ] ) ) {
		return '';
	}
	return '<svg class="vega-icon vega-icon--' . esc_attr( $name ) . '" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">' . $paths[ $name ] . '</svg>';
}

/**
 * Тонкий рисунок «созвездия» для карточки. Рисунок зависит от названия,
 * поэтому у каждой группы он свой и не меняется между загрузками страницы.
 *
 * @param string $seed  Строка, от которой зависит рисунок.
 * @param int    $count Количество звёзд.
 */
function vega_constellation_svg( $seed, $count = 6 ) {
	$hash   = md5( (string) $seed );
	$points = array();
	for ( $i = 0; $i < $count; $i++ ) {
		$x        = 12 + ( hexdec( substr( $hash, $i * 2, 2 ) ) / 255 ) * 96;
		$y        = 10 + ( hexdec( substr( $hash, 16 + $i * 2, 2 ) ) / 255 ) * 50;
		$points[] = array( round( $x, 1 ), round( $y, 1 ) );
	}
	usort(
		$points,
		function ( $a, $b ) {
			return $a[0] <=> $b[0];
		}
	);
	$line = array();
	foreach ( $points as $p ) {
		$line[] = $p[0] . ',' . $p[1];
	}
	$svg  = '<svg class="vega-constellation" viewBox="0 0 120 70" aria-hidden="true" focusable="false">';
	$svg .= '<polyline points="' . esc_attr( implode( ' ', $line ) ) . '" fill="none" stroke="currentColor" stroke-width="0.6" stroke-opacity="0.55"/>';
	foreach ( $points as $i => $p ) {
		$r    = ( 0 === $i % 3 ) ? 2.1 : 1.3;
		$svg .= '<circle cx="' . $p[0] . '" cy="' . $p[1] . '" r="' . $r . '" fill="currentColor"/>';
	}
	return $svg . '</svg>';
}

/**
 * Красивое отображение IBAN группами по четыре знака.
 *
 * @param string $iban IBAN.
 */
function vega_format_iban( $iban ) {
	$clean = strtoupper( preg_replace( '/\s+/', '', (string) $iban ) );
	return trim( chunk_split( $clean, 4, ' ' ) );
}

/**
 * Значение поля записи.
 *
 * @param string   $key     Ключ без префикса _vega_.
 * @param int|null $post_id ID записи.
 */
function vega_meta( $key, $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	return get_post_meta( $post_id, '_vega_' . $key, true );
}

/**
 * Атрибуты для внешней ссылки (новая вкладка + подсказка для экранных дикторов).
 */
function vega_external_attrs() {
	return ' target="_blank" rel="noopener"';
}

/**
 * Текст «(откроется в новой вкладке)» для экранных дикторов.
 */
function vega_new_tab_hint() {
	return '<span class="screen-reader-text"> ' . esc_html__( '(opens in a new tab)', 'vega' ) . '</span>';
}

/**
 * Адреса страниц латиницей: «Детская студия» → detskaya-studiya.
 * Работает только при сохранении новых записей, старые адреса не меняются.
 *
 * @param string $title     Очищенный заголовок.
 * @param string $raw_title Исходный заголовок.
 * @param string $context   Контекст.
 */
function vega_translit_slug( $title, $raw_title = '', $context = 'display' ) {
	if ( 'save' !== $context || ! preg_match( '/\p{Cyrillic}/u', (string) $raw_title ) ) {
		return $title;
	}
	$map = array(
		'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
		'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
		'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'kh', 'ц' => 'ts',
		'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shch', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
		'я' => 'ya', 'і' => 'i', 'ї' => 'yi', 'є' => 'ye', 'ґ' => 'g',
	);
	return strtr( mb_strtolower( (string) $raw_title, 'UTF-8' ), $map );
}
add_filter( 'sanitize_title', 'vega_translit_slug', 9, 3 );
