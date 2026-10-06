<?php
/**
 * Блоки «Вега: …» для редактора страниц.
 * Блоки «живые»: содержимое (афиша, группы, педагоги) берётся из записей,
 * поэтому на странице его не нужно обновлять вручную.
 *
 * @package Vega
 */

defined( 'ABSPATH' ) || exit;

/**
 * Описание блоков: название, подсказка, настройки и функция вывода.
 */
function vega_blocks_config() {
	$audience = array(
		'kids'   => 'Детская студия',
		'adults' => 'Взрослым',
		'all'    => 'Все группы',
	);
	$forms    = array();
	foreach ( vega_forms() as $key => $form ) {
		$forms[ $key ] = $form['admin'];
	}
	$forms['none'] = 'Без формы — только кнопка WhatsApp';
	$sections = array( '' => 'Все разделы' );
	foreach ( vega_meta_fields()['vega_event']['fields']['section']['options'] as $key => $label ) {
		$sections[ $key ] = $label;
	}

	return array(
		'events'         => array(
			'title'       => 'Вега: афиша',
			'description' => 'Предстоящие события по дате. Прошедшие исчезают сами.',
			'icon'        => 'tickets-alt',
			'render'      => 'vega_render_events',
			'attributes'  => array(
				'limit'    => array( 'type' => 'number', 'default' => 6, 'label' => 'Сколько событий показать', 'min' => 1, 'max' => 30 ),
				'section'  => array( 'type' => 'string', 'default' => '', 'label' => 'Раздел', 'options' => $sections ),
				'layout'   => array( 'type' => 'string', 'default' => 'rows', 'label' => 'Вид', 'options' => array( 'rows' => 'Строки: дата — название — кнопка', 'cards' => 'Карточки с афишами' ) ),
				'moreLink' => array( 'type' => 'boolean', 'default' => false, 'label' => 'Ссылка «Вся афиша» внизу' ),
			),
		),
		'events-archive' => array(
			'title'       => 'Вега: архив событий',
			'description' => 'Прошедшие события, разложенные по годам.',
			'icon'        => 'archive',
			'render'      => 'vega_render_events_archive',
			'attributes'  => array(),
		),
		'groups'         => array(
			'title'       => 'Вега: группы',
			'description' => 'Карточки групп: возраст, дни занятий, цена, отметка «Идёт набор».',
			'icon'        => 'groups',
			'render'      => 'vega_render_groups',
			'attributes'  => array(
				'audience' => array( 'type' => 'string', 'default' => 'kids', 'label' => 'Какие группы', 'options' => $audience ),
			),
		),
		'schedule'       => array(
			'title'       => 'Вега: расписание',
			'description' => 'Расписание по дням недели. Собирается автоматически из групп.',
			'icon'        => 'calendar-alt',
			'render'      => 'vega_render_schedule',
			'attributes'  => array(
				'audience' => array( 'type' => 'string', 'default' => 'kids', 'label' => 'Какие группы', 'options' => $audience ),
			),
		),
		'prices'         => array(
			'title'       => 'Вега: цены',
			'description' => 'Таблица цен из карточек групп.',
			'icon'        => 'money-alt',
			'render'      => 'vega_render_prices',
			'attributes'  => array(
				'audience' => array( 'type' => 'string', 'default' => 'kids', 'label' => 'Какие группы', 'options' => $audience ),
			),
		),
		'people'         => array(
			'title'       => 'Вега: люди',
			'description' => 'Педагоги, артисты или гости — карточки с фото.',
			'icon'        => 'admin-users',
			'render'      => 'vega_render_people',
			'attributes'  => array(
				'role'       => array( 'type' => 'string', 'default' => 'teacher', 'label' => 'Кого показать', 'options' => array( 'teacher' => 'Педагогов', 'artist' => 'Артистов', 'guest' => 'Приглашённых гостей', 'all' => 'Всех' ) ),
				'limit'      => array( 'type' => 'number', 'default' => 0, 'label' => 'Сколько показать (0 — всех)', 'min' => 0, 'max' => 50 ),
				'activeOnly' => array( 'type' => 'boolean', 'default' => true, 'label' => 'Только действующих' ),
			),
		),
		'shows'          => array(
			'title'       => 'Вега: спектакли',
			'description' => 'Репертуар: карточки спектаклей с афишами.',
			'icon'        => 'format-video',
			'render'      => 'vega_render_shows',
			'attributes'  => array(
				'limit' => array( 'type' => 'number', 'default' => 0, 'label' => 'Сколько показать (0 — все)', 'min' => 0, 'max' => 50 ),
			),
		),
		'form-button'    => array(
			'title'       => 'Вега: кнопка записи',
			'description' => 'Кнопка Google-формы и рядом «Написать в WhatsApp». Ссылки — в настройках «Театр Вега». Если ссылка пустая, кнопка не показывается.',
			'icon'        => 'forms',
			'render'      => 'vega_render_form_block',
			'attributes'  => array(
				'form'     => array( 'type' => 'string', 'default' => 'kids', 'label' => 'Какая форма', 'options' => $forms ),
				'whatsapp' => array( 'type' => 'string', 'default' => 'enrol', 'label' => 'Кнопка WhatsApp', 'options' => array( 'enrol' => 'WhatsApp для записи', 'director' => 'WhatsApp руководителя', 'none' => 'Без WhatsApp' ) ),
				'label'    => array( 'type' => 'string', 'default' => '', 'label' => 'Своя надпись на кнопке (необязательно)', 'help' => 'Если пусто — стандартная надпись, переведённая на язык страницы.' ),
			),
		),
		'tickets'        => array(
			'title'       => 'Вега: кнопка «Билеты»',
			'description' => 'Ведёт на общую ссылку на билеты из настроек.',
			'icon'        => 'tickets',
			'render'      => 'vega_render_tickets_block',
			'attributes'  => array(),
		),
		'donate'         => array(
			'title'       => 'Вега: реквизиты для пожертвований',
			'description' => 'Получатель, IBAN, BIC, назначение платежа с кнопками «Скопировать», а также Patreon и оплата картой. Всё заполняется в настройках «Театр Вега».',
			'icon'        => 'heart',
			'render'      => 'vega_render_donate',
			'attributes'  => array(),
		),
		'contacts'       => array(
			'title'       => 'Вега: контакты',
			'description' => 'Адрес, телефоны с WhatsApp, почта, соцсети и карта.',
			'icon'        => 'location',
			'render'      => 'vega_render_contacts',
			'attributes'  => array(
				'map' => array( 'type' => 'boolean', 'default' => true, 'label' => 'Показывать карту' ),
			),
		),
		'socials'        => array(
			'title'       => 'Вега: соцсети',
			'description' => 'Ссылки на Instagram, Facebook, YouTube.',
			'icon'        => 'share',
			'render'      => 'vega_render_socials_block',
			'attributes'  => array(
				'set' => array( 'type' => 'string', 'default' => 'vega', 'label' => 'Чьи соцсети', 'options' => array( 'vega' => 'Театр «Вега»', 'shkhuna' => 'Клуб «Шхуна»' ) ),
			),
		),
		'logo'           => array(
			'title'       => 'Вега: логотип',
			'description' => 'Логотип из настроек темы. Пока он не загружен, показывается название.',
			'icon'        => 'star-filled',
			'render'      => 'vega_render_logo_block',
			'attributes'  => array(
				'which' => array( 'type' => 'string', 'default' => 'vega', 'label' => 'Какой логотип', 'options' => array( 'vega' => 'Teatro Vega', 'actorre' => 'Actorre', 'shkhuna' => '«Шхуна»' ) ),
			),
		),
	);
}

/**
 * Регистрация блоков.
 */
function vega_register_blocks() {
	wp_register_script(
		'vega-blocks',
		VEGA_URI . '/assets/js/blocks.js',
		array( 'wp-blocks', 'wp-element', 'wp-components', 'wp-block-editor', 'wp-server-side-render' ),
		VEGA_VERSION,
		true
	);

	$client = array();
	foreach ( vega_blocks_config() as $slug => $block ) {
		$attributes = array();
		foreach ( $block['attributes'] as $key => $attr ) {
			$attributes[ $key ] = array(
				'type'    => $attr['type'],
				'default' => $attr['default'],
			);
		}
		$render = $block['render'];
		register_block_type(
			'vega/' . $slug,
			array(
				'api_version'     => 2,
				'title'           => $block['title'],
				'category'        => 'vega',
				'editor_script'   => 'vega-blocks',
				'attributes'      => $attributes,
				'supports'        => array(
					'align' => array( 'wide', 'full' ),
					'html'  => false,
				),
				'render_callback' => function ( $atts ) use ( $render, $slug ) {
					$inner = call_user_func( $render, $atts );
					if ( '' === $inner ) {
						return '';
					}
					return '<div ' . get_block_wrapper_attributes( array( 'class' => 'vega-block vega-block--' . $slug ) ) . '>' . $inner . '</div>';
				},
			)
		);
		$client[] = array(
			'name'        => 'vega/' . $slug,
			'title'       => $block['title'],
			'description' => $block['description'],
			'icon'        => $block['icon'],
			'attributes'  => $block['attributes'],
		);
	}
	wp_add_inline_script( 'vega-blocks', 'window.vegaBlocks = ' . wp_json_encode( $client ) . ';', 'before' );
}
add_action( 'init', 'vega_register_blocks' );

/**
 * Своя группа блоков «Театр Вега» в списке блоков.
 *
 * @param array $categories Группы.
 */
function vega_block_category( $categories ) {
	array_unshift(
		$categories,
		array(
			'slug'  => 'vega',
			'title' => 'Театр Вега',
			'icon'  => null,
		)
	);
	return $categories;
}
add_filter( 'block_categories_all', 'vega_block_category' );

/**
 * Вывод блока «Кнопка записи».
 *
 * @param array $atts Настройки.
 */
function vega_render_form_block( $atts ) {
	return vega_form_buttons(
		isset( $atts['form'] ) ? $atts['form'] : 'kids',
		isset( $atts['whatsapp'] ) ? $atts['whatsapp'] : 'enrol',
		isset( $atts['label'] ) ? $atts['label'] : ''
	);
}

/**
 * Вывод блока «Билеты».
 */
function vega_render_tickets_block() {
	$url = vega_option( 'tickets_url' );
	return $url ? '<div class="btn-row">' . vega_button( $url, __( 'Buy tickets', 'vega' ), 'primary', array( 'icon' => 'ticket', 'external' => true ) ) . '</div>' : '';
}

/**
 * Вывод блока «Соцсети».
 *
 * @param array $atts Настройки.
 */
function vega_render_socials_block( $atts ) {
	return vega_render_socials( isset( $atts['set'] ) ? $atts['set'] : 'vega' );
}

/**
 * Вывод блока «Логотип».
 *
 * @param array $atts Настройки.
 */
function vega_render_logo_block( $atts ) {
	$which = isset( $atts['which'] ) ? $atts['which'] : 'vega';
	return '<div class="vega-logo vega-logo--' . esc_attr( $which ) . '">' . vega_logo_html( $which, 'medium' ) . '</div>';
}
