<?php
/**
 * Страница настроек «Театр Вега» в админке.
 * Все ссылки, контакты, логотипы и реквизиты — здесь, в одном месте.
 *
 * @package Vega
 */

defined( 'ABSPATH' ) || exit;

/**
 * Описание полей настроек, разбитых на разделы.
 */
function vega_settings_sections() {
	$forms = array();
	foreach ( vega_forms() as $key => $form ) {
		$forms[ $form['setting'] ] = array(
			'type'  => 'url',
			'label' => $form['admin'],
			'help'  => 'Если оставить пустым, кнопка этой формы на сайте не показывается.',
		);
	}

	return array(
		'logos'    => array(
			'title'  => 'Логотипы',
			'intro'  => 'Пока логотип не загружен, на сайте показывается название текстом. Лучше всего подходят PNG или SVG с прозрачным фоном, светлые — фон сайта тёмный.',
			'fields' => array(
				'logo_vega'    => array( 'type' => 'media', 'label' => 'Логотип Teatro Vega (в шапке и подвале)' ),
				'logo_actorre' => array( 'type' => 'media', 'label' => 'Логотип ассоциации Actorre' ),
				'logo_shkhuna' => array( 'type' => 'media', 'label' => 'Логотип клуба «Шхуна»' ),
			),
		),
		'contacts' => array(
			'title'  => 'Контакты',
			'fields' => array(
				'address'           => array( 'type' => 'text', 'label' => 'Адрес', 'help' => 'По этому адресу строится карта на странице «Контакты».' ),
				'phone_enrol'       => array( 'type' => 'tel', 'label' => 'Телефон для записи' ),
				'whatsapp_enrol'    => array( 'type' => 'tel', 'label' => 'WhatsApp для записи', 'help' => 'На этот номер ведут кнопки «Написать в WhatsApp» рядом с формами. Пусто — кнопки не будет.' ),
				'phone_director'    => array( 'type' => 'tel', 'label' => 'Телефон руководителя' ),
				'whatsapp_director' => array( 'type' => 'tel', 'label' => 'WhatsApp руководителя' ),
				'email_studio'      => array( 'type' => 'email', 'label' => 'Почта студии' ),
				'email_actorre'     => array( 'type' => 'email', 'label' => 'Почта ассоциации Actorre' ),
			),
		),
		'social'   => array(
			'title'  => 'Соцсети',
			'intro'  => 'Пустая ссылка — значок соцсети не показывается.',
			'fields' => array(
				'instagram'         => array( 'type' => 'url', 'label' => 'Instagram театра' ),
				'facebook'          => array( 'type' => 'url', 'label' => 'Facebook театра' ),
				'youtube'           => array( 'type' => 'url', 'label' => 'YouTube театра' ),
				'shkhuna_instagram' => array( 'type' => 'url', 'label' => 'Instagram клуба «Шхуна»' ),
				'shkhuna_facebook'  => array( 'type' => 'url', 'label' => 'Facebook клуба «Шхуна»' ),
			),
		),
		'forms'    => array(
			'title'  => 'Билеты и формы записи',
			'intro'  => 'У каждой формы своя строка и своя кнопка на сайте, поэтому ссылки не перепутаются. Формы прошедших лагерей и прошлогодних фестивалей сюда не вносите.',
			'fields' => array_merge(
				array(
					'tickets_url' => array( 'type' => 'url', 'label' => 'Ссылка на билеты (общая)', 'help' => 'Кнопка «Билеты» у событий, если у самого события своя ссылка не указана.' ),
				),
				$forms
			),
		),
		'donate'   => array(
			'title'  => 'Пожертвования',
			'intro'  => 'Пожертвования принимает только ассоциация Actorre. Указывайте только счёт и ссылки ассоциации — личные счета и личные платёжные ссылки сюда не вносите. Реквизиты хранятся в базе сайта, а не в файлах темы.',
			'fields' => array(
				'donate_recipient' => array( 'type' => 'text', 'label' => 'Получатель' ),
				'donate_iban'      => array( 'type' => 'text', 'label' => 'IBAN', 'help' => 'Можно с пробелами или без. Пока поле пустое, блок «Банковский перевод» не показывается.' ),
				'donate_bic'       => array( 'type' => 'text', 'label' => 'BIC / SWIFT' ),
				'donate_concept'   => array( 'type' => 'text', 'label' => 'Назначение платежа' ),
				'donate_patreon'   => array( 'type' => 'url', 'label' => 'Ссылка на Patreon ассоциации (необязательно)', 'help' => 'Пусто — кнопки Patreon нет.' ),
				'donate_card'      => array( 'type' => 'url', 'label' => 'Ссылка на оплату картой (необязательно)', 'help' => 'Платёжная страница ассоциации. Пусто — кнопки нет.' ),
			),
		),
		'pages'    => array(
			'title'  => 'Служебные страницы',
			'intro'  => 'Тема ссылается на эти страницы: «Вся афиша», «Помочь театру» в подвале, автоматическое меню. Выбирайте русскую версию страницы — испанская и английская найдутся сами через Polylang. Кнопка «Создать стартовое содержимое» заполняет этот раздел сама.',
			'fields' => array(
				'page_home'       => array( 'type' => 'page', 'label' => 'Главная' ),
				'page_kids'       => array( 'type' => 'page', 'label' => 'Детская студия' ),
				'page_adults'     => array( 'type' => 'page', 'label' => 'Взрослым' ),
				'page_events'     => array( 'type' => 'page', 'label' => 'Афиша и билеты' ),
				'page_teachers'   => array( 'type' => 'page', 'label' => 'Педагоги' ),
				'page_about'      => array( 'type' => 'page', 'label' => 'О театре' ),
				'page_actorre'    => array( 'type' => 'page', 'label' => 'Actorre' ),
				'page_shkhuna'    => array( 'type' => 'page', 'label' => 'Шхуна' ),
				'page_fest_sky'   => array( 'type' => 'page', 'label' => 'Фестиваль «Под небом Испании»' ),
				'page_fest_hilos' => array( 'type' => 'page', 'label' => 'Фестиваль Hilos Rojos' ),
				'page_donate'     => array( 'type' => 'page', 'label' => 'Помочь театру' ),
				'page_contacts'   => array( 'type' => 'page', 'label' => 'Контакты' ),
				'page_privacy'    => array( 'type' => 'page', 'label' => 'Политика конфиденциальности' ),
			),
		),
	);
}

/**
 * Пункт меню «Театр Вега».
 */
function vega_settings_menu() {
	add_menu_page( 'Настройки театра «Вега»', 'Театр Вега', 'manage_options', 'vega-settings', 'vega_settings_page', 'dashicons-star-filled', 3 );
}
add_action( 'admin_menu', 'vega_settings_menu' );

/**
 * Регистрация настройки.
 */
function vega_settings_register() {
	register_setting(
		'vega_settings',
		'vega_options',
		array(
			'type'              => 'array',
			'sanitize_callback' => 'vega_settings_sanitize',
			'default'           => array(),
		)
	);
}
add_action( 'admin_init', 'vega_settings_register' );

/**
 * Очистка введённых значений.
 *
 * @param array $input Данные формы.
 */
function vega_settings_sanitize( $input ) {
	$input = is_array( $input ) ? $input : array();
	$saved = get_option( 'vega_options', array() );
	$out   = is_array( $saved ) ? $saved : array();
	foreach ( vega_settings_sections() as $section ) {
		foreach ( $section['fields'] as $key => $field ) {
			if ( ! array_key_exists( $key, $input ) ) {
				continue;
			}
			$raw = is_string( $input[ $key ] ) ? trim( $input[ $key ] ) : $input[ $key ];
			switch ( $field['type'] ) {
				case 'url':
					$out[ $key ] = esc_url_raw( $raw );
					break;
				case 'email':
					$out[ $key ] = sanitize_email( $raw );
					break;
				case 'media':
				case 'page':
					$out[ $key ] = absint( $raw );
					break;
				case 'tel':
					$out[ $key ] = preg_replace( '/[^\d+\s()-]/', '', (string) $raw );
					break;
				default:
					$out[ $key ] = sanitize_text_field( (string) $raw );
			}
		}
	}
	if ( isset( $out['donate_iban'] ) ) {
		$out['donate_iban'] = vega_format_iban( $out['donate_iban'] );
	}
	return $out;
}

/**
 * Вывод одного поля.
 *
 * @param string $key   Ключ.
 * @param array  $field Описание.
 */
function vega_settings_field( $key, $field ) {
	$name  = 'vega_options[' . $key . ']';
	$id    = 'vega-opt-' . $key;
	$value = vega_option( $key );
	switch ( $field['type'] ) {
		case 'media':
			$img = $value ? wp_get_attachment_image( (int) $value, 'medium', false, array( 'alt' => '' ) ) : '';
			echo '<div class="vega-media" data-vega-media>';
			echo '<input type="hidden" id="' . esc_attr( $id ) . '" name="' . esc_attr( $name ) . '" value="' . esc_attr( (string) $value ) . '">';
			echo '<div class="vega-media__preview">' . $img . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- HTML из wp_get_attachment_image.
			echo '<button type="button" class="button" data-vega-media-pick>Выбрать картинку</button> ';
			echo '<button type="button" class="button-link vega-media__remove" data-vega-media-remove' . ( $value ? '' : ' hidden' ) . '>Убрать</button>';
			echo '</div>';
			break;
		case 'page':
			wp_dropdown_pages(
				array(
					'name'              => esc_attr( $name ),
					'id'                => esc_attr( $id ),
					'selected'          => (int) $value,
					'show_option_none'  => '— не выбрана —',
					'option_none_value' => '0',
					'post_status'       => array( 'publish', 'draft', 'private' ),
					'lang'              => function_exists( 'pll_default_language' ) ? pll_default_language() : '',
				)
			);
			break;
		default:
			$type = in_array( $field['type'], array( 'url', 'email', 'tel' ), true ) ? $field['type'] : 'text';
			echo '<input type="' . esc_attr( $type ) . '" id="' . esc_attr( $id ) . '" name="' . esc_attr( $name ) . '" value="' . esc_attr( (string) $value ) . '" class="regular-text vega-wide-input">';
	}
	if ( ! empty( $field['help'] ) ) {
		echo '<p class="description">' . esc_html( $field['help'] ) . '</p>';
	}
}

/**
 * Страница настроек.
 */
function vega_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$sections = vega_settings_sections();
	echo '<div class="wrap vega-settings">';
	echo '<h1>Настройки театра «Вега»</h1>';
	echo '<p class="vega-settings__lead">Здесь всё, что тема показывает на каждой странице: логотипы, контакты, соцсети, ссылки на билеты и формы, реквизиты для пожертвований. Тексты страниц меняются в разделе «Страницы».</p>';

	settings_errors();
	vega_starter_box();

	echo '<nav class="vega-settings__toc" aria-label="Разделы настроек"><ul>';
	foreach ( $sections as $slug => $section ) {
		echo '<li><a href="#vega-section-' . esc_attr( $slug ) . '">' . esc_html( $section['title'] ) . '</a></li>';
	}
	echo '</ul></nav>';

	echo '<form method="post" action="options.php">';
	settings_fields( 'vega_settings' );
	foreach ( $sections as $slug => $section ) {
		echo '<section class="vega-settings__section" id="vega-section-' . esc_attr( $slug ) . '">';
		echo '<h2>' . esc_html( $section['title'] ) . '</h2>';
		if ( ! empty( $section['intro'] ) ) {
			echo '<p>' . esc_html( $section['intro'] ) . '</p>';
		}
		echo '<table class="form-table" role="presentation"><tbody>';
		foreach ( $section['fields'] as $key => $field ) {
			echo '<tr><th scope="row"><label for="vega-opt-' . esc_attr( $key ) . '">' . esc_html( $field['label'] ) . '</label></th><td>';
			vega_settings_field( $key, $field );
			echo '</td></tr>';
		}
		echo '</tbody></table>';
		submit_button( 'Сохранить настройки' );
		echo '</section>';
	}
	echo '</form></div>';
}
