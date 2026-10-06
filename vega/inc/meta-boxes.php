<?php
/**
 * Поля записей в админке: понятные русские названия и подсказки.
 * Обходимся без платных плагинов полей — всё на стандартных средствах WordPress.
 *
 * @package Vega
 */

defined( 'ABSPATH' ) || exit;

/**
 * Описание полей для каждого типа записи.
 */
function vega_meta_fields() {
	$sections = array(
		'show'     => 'Спектакль',
		'concert'  => 'Концерт',
		'festival' => 'Фестиваль',
		'workshop' => 'Мастер-класс',
		'shkhuna'  => '«Шхуна»',
	);
	return array(
		'vega_event'  => array(
			'title'  => 'Данные события',
			'intro'  => 'Афишу (картинку) добавьте в блоке «Фото / афиша» в правой колонке. Описание пишите в основном поле выше. Событие само появится в афише и на главной, а после даты окончания уйдёт в архив.',
			'fields' => array(
				'date'       => array( 'type' => 'date', 'label' => 'Дата начала', 'help' => 'Обязательно. По этой дате событие встаёт в афишу.' ),
				'time'       => array( 'type' => 'time', 'label' => 'Время начала', 'help' => 'Можно оставить пустым, если время не важно (например, у фестиваля).' ),
				'end_date'   => array( 'type' => 'date', 'label' => 'Дата окончания', 'help' => 'Только для событий на несколько дней, например фестиваля. Для однодневного события оставьте пустым.' ),
				'place'      => array( 'type' => 'text', 'label' => 'Место', 'help' => 'Например: Calle Santander 10, Torrevieja.' ),
				'price'      => array( 'type' => 'text', 'label' => 'Цена', 'help' => 'Как показывать на сайте, например: «15 €, для членов Actorre 10 €» или «Вход свободный». Пусто — цена не показывается.' ),
				'tickets'    => array( 'type' => 'url', 'label' => 'Ссылка на билеты', 'help' => 'Если пусто — кнопка «Билеты» ведёт на общую ссылку из настроек «Театр Вега».' ),
				'no_tickets' => array( 'type' => 'checkbox', 'label' => 'Без кнопки «Билеты»', 'help' => 'Отметьте, если билеты не продаются (вход свободный или по записи).' ),
				'section'    => array( 'type' => 'select', 'label' => 'Раздел', 'options' => $sections, 'help' => 'Нужен для подписи над названием и для фильтра в афише.' ),
			),
		),
		'vega_group'  => array(
			'title'  => 'Данные группы',
			'intro'  => 'Описание группы пишите в основном поле выше. Фото группы — в блоке «Фото / афиша» справа. Из дней и времени всех групп автоматически собирается таблица расписания. Порядок групп на сайте — поле «Порядок» в блоке «Атрибуты» справа.',
			'fields' => array(
				'audience'       => array( 'type' => 'select', 'label' => 'Для кого', 'options' => array( 'kids' => 'Детская студия', 'adults' => 'Взрослым (и подросткам)' ) ),
				'recruiting'     => array( 'type' => 'checkbox', 'label' => 'Идёт набор', 'help' => 'На карточке появится отметка «Идёт набор».' ),
				'age_min'        => array( 'type' => 'number', 'label' => 'Возраст от, лет', 'help' => 'Например, 4.' ),
				'age_max'        => array( 'type' => 'number', 'label' => 'Возраст до, лет', 'help' => 'Например, 6. Для взрослых оставьте пустым — будет «от 17 лет».' ),
				'direction'      => array( 'type' => 'text', 'label' => 'Направление', 'help' => 'Например: актёрское мастерство, вокал, сценическая речь.' ),
				'schedule'       => array( 'type' => 'schedule', 'label' => 'Дни и время занятий', 'help' => 'Одна строка — одно занятие в неделю. Пустые строки не сохраняются.' ),
				'schedule_note'  => array( 'type' => 'text', 'label' => 'Пояснение к расписанию', 'help' => 'Необязательно. Например: «расписание уточняется» или «занятия с сентября».' ),
				'teachers'       => array( 'type' => 'people', 'label' => 'Педагоги', 'help' => 'Отметьте педагогов. В поле справа от имени можно указать, что он ведёт в этой группе, например «вокал».' ),
				'price_member'   => array( 'type' => 'number', 'label' => 'Цена в месяц для членов Actorre, €', 'help' => 'Только число. Пусто — не показывать.' ),
				'price_regular'  => array( 'type' => 'number', 'label' => 'Цена в месяц без членства, €', 'help' => 'Только число. Если цена одна для всех — заполните только это поле.' ),
				'price_note'     => array( 'type' => 'text', 'label' => 'Пояснение к цене', 'help' => 'Например: «два занятия в неделю по полтора часа» или «40 € — только по воскресеньям».' ),
				'form'           => array( 'type' => 'select', 'label' => 'Кнопка записи ведёт на форму', 'options' => array( 'kids' => 'Детская студия и пробное занятие', 'adults' => 'Курсы для подростков и взрослых', 'none' => 'Без кнопки формы (только WhatsApp)' ) ),
			),
		),
		'vega_person' => array(
			'title'  => 'Данные человека',
			'intro'  => 'Фото добавьте в блоке «Фото / афиша» справа (лучше вертикальное, лицо в верхней части кадра). Биографию пишите в основном поле выше. Порядок на сайте — поле «Порядок» в блоке «Атрибуты».',
			'fields' => array(
				'role'       => array( 'type' => 'select', 'label' => 'Роль', 'options' => array( 'teacher' => 'Педагог', 'artist' => 'Артист', 'guest' => 'Приглашённый гость' ) ),
				'directions' => array( 'type' => 'text', 'label' => 'Направления', 'help' => 'Через запятую, например: вокал, хор.' ),
				'active'     => array( 'type' => 'checkbox', 'label' => 'Действующий', 'help' => 'Снимите отметку, если человек больше не работает в театре: он пропадёт со страницы «Педагоги», но его страница сохранится.', 'default' => '1' ),
			),
		),
		'vega_show'   => array(
			'title'  => 'Данные спектакля',
			'intro'  => 'Афишу добавьте в блоке «Фото / афиша» справа, описание — в основном поле выше.',
			'fields' => array(
				'year'    => array( 'type' => 'number', 'label' => 'Год премьеры' ),
				'gallery' => array( 'type' => 'gallery', 'label' => 'Галерея', 'help' => 'Фотографии со спектакля. Подписи к фото заполните в медиатеке — они станут подписями и на сайте.' ),
				'cast'    => array( 'type' => 'people', 'label' => 'Состав', 'help' => 'Отметьте участников. Справа от имени можно написать роль в спектакле.', 'any_role' => true ),
			),
		),
	);
}

/**
 * Регистрация блоков полей.
 */
function vega_add_meta_boxes() {
	foreach ( vega_meta_fields() as $type => $box ) {
		add_meta_box( 'vega-fields', $box['title'], 'vega_render_meta_box', $type, 'normal', 'high' );
	}
}
add_action( 'add_meta_boxes', 'vega_add_meta_boxes' );

/**
 * Вывод полей.
 *
 * @param WP_Post $post Запись.
 */
function vega_render_meta_box( $post ) {
	$all = vega_meta_fields();
	if ( empty( $all[ $post->post_type ] ) ) {
		return;
	}
	$box = $all[ $post->post_type ];
	wp_nonce_field( 'vega_save_meta', 'vega_meta_nonce' );
	echo '<div class="vega-fields">';
	if ( ! empty( $box['intro'] ) ) {
		echo '<p class="vega-fields__intro">' . esc_html( $box['intro'] ) . '</p>';
	}
	foreach ( $box['fields'] as $key => $field ) {
		$name  = 'vega_meta[' . $key . ']';
		$id    = 'vega-field-' . $key;
		$value = get_post_meta( $post->ID, '_vega_' . $key, true );
		$is_new = ( 'auto-draft' === $post->post_status );
		if ( $is_new && '' === $value && isset( $field['default'] ) ) {
			$value = $field['default'];
		}
		echo '<div class="vega-field vega-field--' . esc_attr( $field['type'] ) . '">';
		switch ( $field['type'] ) {
			case 'checkbox':
				echo '<label for="' . esc_attr( $id ) . '"><input type="checkbox" id="' . esc_attr( $id ) . '" name="' . esc_attr( $name ) . '" value="1" ' . checked( '1', (string) $value, false ) . '> <strong>' . esc_html( $field['label'] ) . '</strong></label>';
				break;

			case 'select':
				echo '<label for="' . esc_attr( $id ) . '"><strong>' . esc_html( $field['label'] ) . '</strong></label>';
				echo '<select id="' . esc_attr( $id ) . '" name="' . esc_attr( $name ) . '">';
				foreach ( $field['options'] as $opt => $label ) {
					echo '<option value="' . esc_attr( $opt ) . '" ' . selected( (string) $value, (string) $opt, false ) . '>' . esc_html( $label ) . '</option>';
				}
				echo '</select>';
				break;

			case 'schedule':
				echo '<strong class="vega-field__label">' . esc_html( $field['label'] ) . '</strong>';
				vega_render_schedule_field( is_array( $value ) ? $value : array() );
				break;

			case 'people':
				echo '<strong class="vega-field__label">' . esc_html( $field['label'] ) . '</strong>';
				vega_render_people_field( $key, is_array( $value ) ? $value : array(), ! empty( $field['any_role'] ) );
				break;

			case 'gallery':
				$ids = is_array( $value ) ? array_map( 'intval', $value ) : array();
				echo '<strong class="vega-field__label">' . esc_html( $field['label'] ) . '</strong>';
				echo '<div class="vega-gallery" data-vega-gallery>';
				echo '<input type="hidden" name="' . esc_attr( $name ) . '" value="' . esc_attr( implode( ',', $ids ) ) . '">';
				echo '<ul class="vega-gallery__list">';
				foreach ( $ids as $img ) {
					echo '<li>' . wp_get_attachment_image( $img, 'thumbnail' ) . '</li>';
				}
				echo '</ul>';
				echo '<button type="button" class="button" data-vega-gallery-pick>Выбрать фотографии</button> ';
				echo '<button type="button" class="button-link" data-vega-gallery-clear>Очистить галерею</button>';
				echo '</div>';
				break;

			default:
				$type = in_array( $field['type'], array( 'date', 'time', 'url', 'number' ), true ) ? $field['type'] : 'text';
				$extra = 'number' === $type ? ' min="0" step="1" inputmode="numeric"' : '';
				echo '<label for="' . esc_attr( $id ) . '"><strong>' . esc_html( $field['label'] ) . '</strong></label>';
				echo '<input type="' . esc_attr( $type ) . '" id="' . esc_attr( $id ) . '" name="' . esc_attr( $name ) . '" value="' . esc_attr( (string) $value ) . '" class="widefat"' . $extra . '>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		if ( ! empty( $field['help'] ) ) {
			echo '<p class="description">' . esc_html( $field['help'] ) . '</p>';
		}
		echo '</div>';
	}
	echo '</div>';
}

/**
 * Поле расписания: до 4 занятий в неделю.
 *
 * @param array $rows Сохранённые строки.
 */
function vega_render_schedule_field( $rows ) {
	$days = array(
		''  => '—',
		'1' => 'Понедельник',
		'2' => 'Вторник',
		'3' => 'Среда',
		'4' => 'Четверг',
		'5' => 'Пятница',
		'6' => 'Суббота',
		'7' => 'Воскресенье',
	);
	echo '<table class="vega-schedule-field"><thead><tr><th>День</th><th>Начало</th><th>Конец</th></tr></thead><tbody>';
	for ( $i = 0; $i < 4; $i++ ) {
		$row = isset( $rows[ $i ] ) ? $rows[ $i ] : array( 'day' => '', 'start' => '', 'end' => '' );
		echo '<tr><td><select name="vega_meta[schedule][' . (int) $i . '][day]" aria-label="День недели, строка ' . (int) ( $i + 1 ) . '">';
		foreach ( $days as $val => $label ) {
			echo '<option value="' . esc_attr( $val ) . '" ' . selected( (string) $row['day'], (string) $val, false ) . '>' . esc_html( $label ) . '</option>';
		}
		echo '</select></td>';
		echo '<td><input type="time" name="vega_meta[schedule][' . (int) $i . '][start]" value="' . esc_attr( $row['start'] ) . '" aria-label="Начало, строка ' . (int) ( $i + 1 ) . '"></td>';
		echo '<td><input type="time" name="vega_meta[schedule][' . (int) $i . '][end]" value="' . esc_attr( $row['end'] ) . '" aria-label="Конец, строка ' . (int) ( $i + 1 ) . '"></td></tr>';
	}
	echo '</tbody></table>';
}

/**
 * Поле выбора людей (педагоги группы, состав спектакля).
 *
 * @param string $key      Ключ поля.
 * @param array  $selected Сохранённые [ ['id'=>, 'note'=>], … ].
 * @param bool   $any_role Показывать всех, а не только педагогов.
 */
function vega_render_people_field( $key, $selected, $any_role ) {
	$args = array(
		'post_type'        => 'vega_person',
		'posts_per_page'   => 200,
		'post_status'      => array( 'publish', 'draft', 'pending', 'private' ),
		'orderby'          => array( 'menu_order' => 'ASC', 'title' => 'ASC' ),
		'suppress_filters' => false,
		'lang'             => '', // Polylang: показываем людей всех языков.
	);
	$people = get_posts( $args );
	if ( ! $people ) {
		echo '<p class="description">Пока нет ни одного человека. Добавьте их в разделе «Люди».</p>';
		return;
	}
	$notes = array();
	foreach ( $selected as $row ) {
		if ( ! empty( $row['id'] ) ) {
			$notes[ (int) $row['id'] ] = isset( $row['note'] ) ? $row['note'] : '';
		}
	}
	echo '<ul class="vega-people-field">';
	foreach ( $people as $person ) {
		$checked = array_key_exists( $person->ID, $notes );
		$lang    = function_exists( 'pll_get_post_language' ) ? pll_get_post_language( $person->ID, 'slug' ) : '';
		$role    = get_post_meta( $person->ID, '_vega_role', true );
		if ( ! $any_role && $role && 'teacher' !== $role && ! $checked ) {
			continue;
		}
		$fid = 'vega-' . $key . '-' . $person->ID;
		echo '<li><label for="' . esc_attr( $fid ) . '"><input type="checkbox" id="' . esc_attr( $fid ) . '" name="vega_meta[' . esc_attr( $key ) . '][' . (int) $person->ID . '][id]" value="' . (int) $person->ID . '" ' . checked( $checked, true, false ) . '> ' . esc_html( get_the_title( $person ) );
		if ( $lang ) {
			echo ' <span class="vega-lang-tag">' . esc_html( strtoupper( $lang ) ) . '</span>';
		}
		echo '</label>';
		echo '<input type="text" name="vega_meta[' . esc_attr( $key ) . '][' . (int) $person->ID . '][note]" value="' . esc_attr( $checked ? $notes[ $person->ID ] : '' ) . '" placeholder="что ведёт / роль (необязательно)" aria-label="Пояснение для ' . esc_attr( get_the_title( $person ) ) . '"></li>';
	}
	echo '</ul>';
	if ( function_exists( 'pll_get_post_language' ) ) {
		echo '<p class="description">Можно отмечать людей на любом языке: на сайте автоматически покажется версия на языке страницы.</p>';
	}
}

/**
 * Сохранение полей.
 *
 * @param int     $post_id ID записи.
 * @param WP_Post $post    Запись.
 */
function vega_save_meta( $post_id, $post ) {
	if ( ! isset( $_POST['vega_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['vega_meta_nonce'] ) ), 'vega_save_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	$all = vega_meta_fields();
	if ( empty( $all[ $post->post_type ] ) ) {
		return;
	}
	// phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- каждое поле очищается ниже.
	$input = isset( $_POST['vega_meta'] ) && is_array( $_POST['vega_meta'] ) ? wp_unslash( $_POST['vega_meta'] ) : array();
	foreach ( $all[ $post->post_type ]['fields'] as $key => $field ) {
		$raw = isset( $input[ $key ] ) ? $input[ $key ] : '';
		vega_update_field( $post_id, $key, $field, $raw );
	}
	if ( 'vega_event' === $post->post_type ) {
		vega_update_event_index( $post_id );
	}
}
add_action( 'save_post', 'vega_save_meta', 10, 2 );

/**
 * Очистка и сохранение одного поля (используется и стартовым содержимым).
 *
 * @param int    $post_id ID записи.
 * @param string $key     Ключ поля.
 * @param array  $field   Описание поля.
 * @param mixed  $raw     Значение.
 */
function vega_update_field( $post_id, $key, $field, $raw ) {
	$meta_key = '_vega_' . $key;
	switch ( $field['type'] ) {
		case 'checkbox':
			$value = ! empty( $raw ) ? '1' : '';
			break;
		case 'select':
			$value = array_key_exists( (string) $raw, $field['options'] ) ? (string) $raw : (string) key( $field['options'] );
			break;
		case 'date':
			$value = preg_match( '/^\d{4}-\d{2}-\d{2}$/', (string) $raw ) ? (string) $raw : '';
			break;
		case 'time':
			$value = preg_match( '/^\d{2}:\d{2}$/', substr( (string) $raw, 0, 5 ) ) ? substr( (string) $raw, 0, 5 ) : '';
			break;
		case 'url':
			$value = esc_url_raw( trim( (string) $raw ) );
			break;
		case 'number':
			$value = '' === trim( (string) $raw ) ? '' : (string) absint( $raw );
			break;
		case 'schedule':
			$value = array();
			foreach ( (array) $raw as $row ) {
				$day   = isset( $row['day'] ) ? absint( $row['day'] ) : 0;
				$start = isset( $row['start'] ) ? substr( sanitize_text_field( $row['start'] ), 0, 5 ) : '';
				$end   = isset( $row['end'] ) ? substr( sanitize_text_field( $row['end'] ), 0, 5 ) : '';
				if ( $day >= 1 && $day <= 7 && preg_match( '/^\d{2}:\d{2}$/', $start ) ) {
					$value[] = array(
						'day'   => $day,
						'start' => $start,
						'end'   => preg_match( '/^\d{2}:\d{2}$/', $end ) ? $end : '',
					);
				}
			}
			break;
		case 'people':
			$value = array();
			foreach ( (array) $raw as $row ) {
				if ( ! empty( $row['id'] ) ) {
					$value[] = array(
						'id'   => absint( $row['id'] ),
						'note' => isset( $row['note'] ) ? sanitize_text_field( $row['note'] ) : '',
					);
				}
			}
			break;
		case 'gallery':
			$value = is_array( $raw ) ? $raw : explode( ',', (string) $raw );
			$value = array_values( array_filter( array_map( 'absint', $value ) ) );
			break;
		default:
			$value = sanitize_text_field( (string) $raw );
	}
	if ( '' === $value || array() === $value ) {
		delete_post_meta( $post_id, $meta_key );
	} else {
		update_post_meta( $post_id, $meta_key, $value );
	}
}

/**
 * Служебные поля события для сортировки и разделения на «предстоящие» и «архив».
 *
 * @param int $post_id ID события.
 */
function vega_update_event_index( $post_id ) {
	$date = get_post_meta( $post_id, '_vega_date', true );
	if ( ! $date ) {
		delete_post_meta( $post_id, '_vega_sort' );
		delete_post_meta( $post_id, '_vega_until' );
		return;
	}
	$time = get_post_meta( $post_id, '_vega_time', true );
	$end  = get_post_meta( $post_id, '_vega_end_date', true );
	update_post_meta( $post_id, '_vega_sort', $date . ' ' . ( $time ? $time : '00:00' ) );
	update_post_meta( $post_id, '_vega_until', ( $end && $end > $date ) ? $end : $date );
}

/**
 * Если Polylang синхронизирует поля между переводами — пересчитываем служебные поля.
 *
 * @param int    $meta_id    ID поля.
 * @param int    $post_id    ID записи.
 * @param string $meta_key   Ключ.
 */
function vega_reindex_on_meta_change( $meta_id, $post_id, $meta_key ) {
	if ( in_array( $meta_key, array( '_vega_date', '_vega_time', '_vega_end_date' ), true ) && 'vega_event' === get_post_type( $post_id ) ) {
		vega_update_event_index( $post_id );
	}
}
add_action( 'added_post_meta', 'vega_reindex_on_meta_change', 10, 3 );
add_action( 'updated_post_meta', 'vega_reindex_on_meta_change', 10, 3 );

/**
 * Скрипты и стили админки (выбор картинок, оформление полей).
 *
 * @param string $hook Страница админки.
 */
function vega_admin_assets( $hook ) {
	$screen = get_current_screen();
	$ours   = $screen && ( in_array( $screen->post_type, array( 'vega_event', 'vega_group', 'vega_person', 'vega_show' ), true ) || false !== strpos( $hook, 'vega' ) );
	if ( ! $ours ) {
		return;
	}
	wp_enqueue_media();
	wp_enqueue_style( 'vega-admin', VEGA_URI . '/assets/css/admin.css', array(), VEGA_VERSION );
	wp_enqueue_script( 'vega-admin', VEGA_URI . '/assets/js/admin.js', array( 'jquery' ), VEGA_VERSION, true );
}
add_action( 'admin_enqueue_scripts', 'vega_admin_assets' );

/* ---------- Колонки в списках записей ---------- */

add_filter(
	'manage_vega_event_posts_columns',
	function ( $cols ) {
		$new = array();
		foreach ( $cols as $k => $v ) {
			$new[ $k ] = $v;
			if ( 'title' === $k ) {
				$new['vega_date']    = 'Дата';
				$new['vega_section'] = 'Раздел';
			}
		}
		unset( $new['date'] );
		return $new;
	}
);
add_action(
	'manage_vega_event_posts_custom_column',
	function ( $col, $post_id ) {
		if ( 'vega_date' === $col ) {
			$date = get_post_meta( $post_id, '_vega_date', true );
			$end  = get_post_meta( $post_id, '_vega_end_date', true );
			$time = get_post_meta( $post_id, '_vega_time', true );
			echo esc_html( $date ? $date . ( $end ? ' — ' . $end : '' ) . ( $time ? ', ' . $time : '' ) : '— нет даты —' );
			$until = get_post_meta( $post_id, '_vega_until', true );
			if ( $until && $until < vega_today() ) {
				echo '<br><span class="description">в архиве</span>';
			}
		}
		if ( 'vega_section' === $col ) {
			$fields   = vega_meta_fields();
			$sections = $fields['vega_event']['fields']['section']['options'];
			$value    = get_post_meta( $post_id, '_vega_section', true );
			echo esc_html( isset( $sections[ $value ] ) ? $sections[ $value ] : '' );
		}
	},
	10,
	2
);
add_filter(
	'manage_edit-vega_event_sortable_columns',
	function ( $cols ) {
		$cols['vega_date'] = 'vega_date';
		return $cols;
	}
);
add_action(
	'pre_get_posts',
	function ( $query ) {
		if ( ! is_admin() || ! $query->is_main_query() || 'vega_event' !== $query->get( 'post_type' ) ) {
			return;
		}
		$orderby = $query->get( 'orderby' );
		if ( ! $orderby || 'vega_date' === $orderby ) {
			$query->set( 'meta_key', '_vega_sort' );
			$query->set( 'orderby', 'meta_value' );
			if ( ! $query->get( 'order' ) || ! isset( $_GET['order'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
				$query->set( 'order', 'DESC' );
			}
		}
	}
);

add_filter(
	'manage_vega_group_posts_columns',
	function ( $cols ) {
		$date = isset( $cols['date'] ) ? $cols['date'] : '';
		unset( $cols['date'] );
		$cols['vega_age']        = 'Возраст';
		$cols['vega_schedule']   = 'Занятия';
		$cols['vega_recruiting'] = 'Набор';
		return $cols;
	}
);
add_action(
	'manage_vega_group_posts_custom_column',
	function ( $col, $post_id ) {
		if ( 'vega_age' === $col ) {
			$min = get_post_meta( $post_id, '_vega_age_min', true );
			$max = get_post_meta( $post_id, '_vega_age_max', true );
			echo esc_html( $min || $max ? trim( $min . '–' . $max, '–' ) : '' );
		}
		if ( 'vega_schedule' === $col ) {
			echo esc_html( vega_schedule_summary( $post_id ) );
		}
		if ( 'vega_recruiting' === $col ) {
			echo get_post_meta( $post_id, '_vega_recruiting', true ) ? '✓' : '—';
		}
	},
	10,
	2
);

add_filter(
	'manage_vega_person_posts_columns',
	function ( $cols ) {
		unset( $cols['date'] );
		$cols['vega_role']   = 'Роль';
		$cols['vega_active'] = 'Действующий';
		return $cols;
	}
);
add_action(
	'manage_vega_person_posts_custom_column',
	function ( $col, $post_id ) {
		if ( 'vega_role' === $col ) {
			$labels = array( 'teacher' => 'Педагог', 'artist' => 'Артист', 'guest' => 'Гость' );
			$role   = get_post_meta( $post_id, '_vega_role', true );
			echo esc_html( isset( $labels[ $role ] ) ? $labels[ $role ] : '' );
		}
		if ( 'vega_active' === $col ) {
			echo get_post_meta( $post_id, '_vega_active', true ) ? '✓' : '—';
		}
	},
	10,
	2
);
