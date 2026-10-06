<?php
/**
 * Кнопка «Создать стартовое содержимое».
 *
 * Один раз создаёт страницы, меню, группы, педагогов, события и спектакли
 * на трёх языках. Существующие страницы и записи не трогает и не удаляет:
 * всё создаётся новыми записями.
 *
 * @package Vega
 */

defined( 'ABSPATH' ) || exit;

/**
 * Блок на странице настроек.
 */
function vega_starter_box() {
	$done = get_option( 'vega_starter_done' );
	echo '<div class="vega-starter card">';
	echo '<h2>Стартовое содержимое</h2>';

	if ( $done ) {
		echo '<p><strong>Стартовое содержимое уже создано</strong> ' . esc_html( isset( $done['time'] ) ? wp_date( 'd.m.Y H:i', (int) $done['time'] ) : '' ) . '.</p>';
		if ( ! empty( $done['summary'] ) ) {
			echo '<p>' . esc_html( $done['summary'] ) . '</p>';
		}
		echo '<p>Дальше всё меняется в разделах «Страницы», «События», «Группы», «Люди», «Спектакли» и «Внешний вид → Меню». Повторно кнопка не запускается, чтобы не появились дубли.</p>';
		echo '</div>';
		return;
	}

	$langs = vega_starter_languages();
	echo '<p>Одна кнопка создаст страницы сайта (главная, детская студия, взрослым, афиша, педагоги, о театре, Actorre, «Шхуна», два фестиваля, «Помочь театру», контакты, политика конфиденциальности), меню, группы, педагогов, ближайшие события и спектакли — с готовыми текстами.</p>';
	echo '<p><strong>Существующие страницы сайта не изменятся и не удалятся.</strong> Новые страницы появятся рядом с ними.</p>';

	if ( vega_has_polylang() ) {
		$missing = array_diff( array( 'ru', 'es', 'en' ), $langs );
		if ( $missing ) {
			echo '<p class="vega-warning">В Polylang не хватает языков: ' . esc_html( strtoupper( implode( ', ', $missing ) ) ) . '. Добавьте их в «Языки → Языки» (Русский, Español, English), иначе тексты на этих языках не будут созданы.</p>';
		} else {
			echo '<p>Polylang найден: тексты будут созданы на русском, испанском и английском и связаны между собой как переводы.</p>';
		}
	} else {
		echo '<p class="vega-warning">Плагин Polylang не включён — будет создана только русская версия. Чтобы получить сразу три языка, сначала установите Polylang и добавьте языки (см. README).</p>';
	}

	echo '<form method="post" action="' . esc_url( admin_url( 'admin-post.php' ) ) . '">';
	echo '<input type="hidden" name="action" value="vega_starter">';
	wp_nonce_field( 'vega_starter' );
	echo '<p><label><input type="checkbox" name="set_front" value="1" checked> Сделать новую «Главную» главной страницей сайта (Настройки → Чтение)</label></p>';
	echo '<p><label><input type="checkbox" name="set_menus" value="1" checked> Поставить новые меню в шапку и подвал</label></p>';
	submit_button( 'Создать стартовое содержимое', 'primary large', 'submit', false );
	echo '</form></div>';
}

/**
 * На каких языках создавать.
 *
 * @return string[]
 */
function vega_starter_languages() {
	if ( vega_has_polylang() && function_exists( 'pll_languages_list' ) ) {
		$list = (array) pll_languages_list( array( 'fields' => 'slug' ) );
		$ours = array_values( array_intersect( array( 'ru', 'es', 'en' ), $list ) );
		return $ours ? $ours : array( 'ru' );
	}
	return array( 'ru' );
}

/**
 * Обработчик кнопки.
 */
function vega_starter_handle() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'Недостаточно прав.' );
	}
	check_admin_referer( 'vega_starter' );
	if ( ! get_option( 'vega_starter_done' ) ) {
		$summary = vega_starter_run( ! empty( $_POST['set_front'] ), ! empty( $_POST['set_menus'] ) );
		update_option(
			'vega_starter_done',
			array(
				'time'    => time(),
				'summary' => $summary,
			),
			false
		);
	}
	wp_safe_redirect( admin_url( 'admin.php?page=vega-settings&vega-starter=1' ) );
	exit;
}
add_action( 'admin_post_vega_starter', 'vega_starter_handle' );

/**
 * Уведомление после создания.
 */
function vega_starter_notice() {
	if ( isset( $_GET['vega-starter'] ) && current_user_can( 'manage_options' ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		echo '<div class="notice notice-success is-dismissible"><p>Готово! Стартовое содержимое создано. Откройте сайт и посмотрите, как он выглядит, — тексты можно менять в разделе «Страницы».</p></div>';
	}
}
add_action( 'admin_notices', 'vega_starter_notice' );

/* =====================================================================
 * Сборка разметки блоков. Разметка совпадает с той, что сохраняет
 * редактор, поэтому страницы открываются в редакторе без предупреждений.
 * ===================================================================== */

/**
 * Комментарий-разделитель блока.
 *
 * @param string $name  Имя блока.
 * @param array  $attrs Атрибуты.
 */
function vsb_attrs( $attrs ) {
	return $attrs ? ' ' . wp_json_encode( $attrs, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) : '';
}

/**
 * Абзац.
 *
 * @param string $html  Текст (можно с <a>, <strong>).
 * @param string $class Стиль: lead, eyebrow.
 */
function vsb_p( $html, $class = '' ) {
	$attrs = $class ? array( 'className' => 'is-style-vega-' . $class ) : array();
	$cls   = $class ? ' class="is-style-vega-' . $class . '"' : '';
	return "<!-- wp:paragraph" . vsb_attrs( $attrs ) . " -->\n<p{$cls}>{$html}</p>\n<!-- /wp:paragraph -->\n\n";
}

/**
 * Заголовок.
 *
 * @param string $text  Текст.
 * @param int    $level Уровень.
 */
function vsb_h( $text, $level = 2 ) {
	$attrs = 2 === $level ? array() : array( 'level' => $level );
	return "<!-- wp:heading" . vsb_attrs( $attrs ) . " -->\n<h{$level} class=\"wp-block-heading\">{$text}</h{$level}>\n<!-- /wp:heading -->\n\n";
}

/**
 * Список.
 *
 * @param string[] $items   Пункты.
 * @param bool     $ordered Нумерованный.
 * @param string   $style   Стиль (stars).
 */
function vsb_list( $items, $ordered = false, $style = '' ) {
	$attrs = array();
	if ( $ordered ) {
		$attrs['ordered'] = true;
	}
	if ( $style ) {
		$attrs['className'] = 'is-style-vega-' . $style;
	}
	$tag   = $ordered ? 'ol' : 'ul';
	// Без класса wp-block-list: так список валиден и в WordPress 6.4,
	// а новые версии редактора сами переводят его в свой формат.
	$cls   = $style ? ' class="is-style-vega-' . $style . '"' : '';
	$inner = '';
	foreach ( $items as $item ) {
		$inner .= "<!-- wp:list-item -->\n<li>{$item}</li>\n<!-- /wp:list-item -->\n\n";
	}
	return "<!-- wp:list" . vsb_attrs( $attrs ) . " -->\n<{$tag}{$cls}>" . rtrim( $inner ) . "</{$tag}>\n<!-- /wp:list -->\n\n";
}

/**
 * Кнопки.
 *
 * @param array $buttons [ [текст, ссылка, 'outline'|''], … ].
 */
function vsb_buttons( $buttons ) {
	$inner = '';
	foreach ( $buttons as $b ) {
		$outline = ! empty( $b[2] );
		$attrs   = $outline ? array( 'className' => 'is-style-outline' ) : array();
		$cls     = 'wp-block-button' . ( $outline ? ' is-style-outline' : '' );
		$inner  .= "<!-- wp:button" . vsb_attrs( $attrs ) . " -->\n<div class=\"{$cls}\"><a class=\"wp-block-button__link wp-element-button\" href=\"" . esc_url( $b[1] ) . "\">{$b[0]}</a></div>\n<!-- /wp:button -->\n\n";
	}
	return "<!-- wp:buttons -->\n<div class=\"wp-block-buttons\">" . rtrim( $inner ) . "</div>\n<!-- /wp:buttons -->\n\n";
}

/**
 * Динамический блок темы.
 *
 * @param string $name  Имя без vega/.
 * @param array  $attrs Атрибуты.
 */
function vsb_vega( $name, $attrs = array() ) {
	return "<!-- wp:vega/{$name}" . vsb_attrs( $attrs ) . " /-->\n\n";
}

/**
 * Секция на всю ширину (блок «Группа»).
 *
 * @param string $inner Содержимое.
 * @param string $style light | band | stars | card | ''.
 * @param string $align full | wide | ''.
 */
function vsb_section( $inner, $style = '', $align = 'full' ) {
	$attrs = array();
	$cls   = 'wp-block-group';
	if ( $align ) {
		$attrs['align'] = $align;
		$cls           .= ' align' . $align;
	}
	if ( $style ) {
		$attrs['className'] = 'is-style-vega-' . $style;
		$cls               .= ' is-style-vega-' . $style;
	}
	$attrs['layout'] = array( 'type' => 'constrained' );
	return "<!-- wp:group" . vsb_attrs( $attrs ) . " -->\n<div class=\"{$cls}\">" . rtrim( $inner ) . "</div>\n<!-- /wp:group -->\n\n";
}

/**
 * Колонки.
 *
 * @param string[] $cols  Содержимое колонок.
 * @param string   $align wide | ''.
 */
function vsb_columns( $cols, $align = 'wide' ) {
	$attrs = $align ? array( 'align' => $align ) : array();
	$cls   = 'wp-block-columns' . ( $align ? ' align' . $align : '' );
	$inner = '';
	foreach ( $cols as $col ) {
		$inner .= "<!-- wp:column -->\n<div class=\"wp-block-column\">" . rtrim( $col ) . "</div>\n<!-- /wp:column -->\n\n";
	}
	return "<!-- wp:columns" . vsb_attrs( $attrs ) . " -->\n<div class=\"{$cls}\">" . rtrim( $inner ) . "</div>\n<!-- /wp:columns -->\n\n";
}

/**
 * Картинка.
 *
 * @param string $url   Адрес.
 * @param string $alt   Описание для незрячих.
 * @param string $style Стиль (portrait).
 */
function vsb_image( $url, $alt, $style = '' ) {
	$attrs = array( 'sizeSlug' => 'large' );
	$cls   = 'wp-block-image size-large';
	if ( $style ) {
		$attrs['className'] = 'is-style-vega-' . $style;
		$cls               .= ' is-style-vega-' . $style;
	}
	return "<!-- wp:image" . vsb_attrs( $attrs ) . " -->\n<figure class=\"{$cls}\"><img src=\"" . esc_url( $url ) . "\" alt=\"" . esc_attr( $alt ) . "\"/></figure>\n<!-- /wp:image -->\n\n";
}

/**
 * Вопрос-ответ (раскрывающийся блок).
 *
 * @param string $question Вопрос.
 * @param string $answer   Ответ.
 */
function vsb_faq( $question, $answer ) {
	return "<!-- wp:details -->\n<details class=\"wp-block-details\"><summary>{$question}</summary>" . rtrim( vsb_p( $answer ) ) . "</details>\n<!-- /wp:details -->\n\n";
}

/* =====================================================================
 * Создание содержимого.
 * ===================================================================== */

/**
 * Создаёт запись и сохраняет поля.
 *
 * @param array  $data   post_type, title, content, excerpt, slug, order, template.
 * @param array  $meta   Поля (ключи без _vega_).
 * @param string $lang   Язык.
 */
function vega_starter_insert( $data, $meta, $lang ) {
	$id = wp_insert_post(
		array(
			'post_type'    => $data['post_type'],
			'post_status'  => 'publish',
			'post_title'   => $data['title'],
			'post_content' => isset( $data['content'] ) ? $data['content'] : '',
			'post_excerpt' => isset( $data['excerpt'] ) ? $data['excerpt'] : '',
			'post_name'    => isset( $data['slug'] ) ? $data['slug'] : '',
			'menu_order'   => isset( $data['order'] ) ? (int) $data['order'] : 0,
			'comment_status' => 'closed',
			'ping_status'  => 'closed',
		),
		true
	);
	if ( is_wp_error( $id ) ) {
		return 0;
	}
	if ( function_exists( 'pll_set_post_language' ) ) {
		pll_set_post_language( $id, $lang );
	}
	if ( ! empty( $data['template'] ) ) {
		update_post_meta( $id, '_wp_page_template', $data['template'] );
	}
	if ( $meta ) {
		$fields = vega_meta_fields();
		$defs   = isset( $fields[ $data['post_type'] ] ) ? $fields[ $data['post_type'] ]['fields'] : array();
		foreach ( $meta as $key => $value ) {
			if ( isset( $defs[ $key ] ) ) {
				vega_update_field( $id, $key, $defs[ $key ], $value );
			}
		}
		if ( 'vega_event' === $data['post_type'] ) {
			vega_update_event_index( $id );
		}
	}
	return (int) $id;
}

/**
 * Связывает переводы в Polylang.
 *
 * @param array $ids [ 'ru' => 1, 'es' => 2, … ].
 */
function vega_starter_link( $ids ) {
	$ids = array_filter( $ids );
	if ( count( $ids ) > 1 && function_exists( 'pll_save_post_translations' ) ) {
		pll_save_post_translations( $ids );
	}
}

/**
 * Запуск.
 *
 * @param bool $set_front Сделать новую главную главной страницей.
 * @param bool $set_menus Поставить меню в шапку и подвал.
 * @return string Краткий итог.
 */
function vega_starter_run( $set_front = true, $set_menus = true ) {
	$langs  = vega_starter_languages();
	$common = require VEGA_DIR . '/inc/starter/common.php';
	$texts  = array();
	foreach ( $langs as $lang ) {
		$texts[ $lang ] = require VEGA_DIR . '/inc/starter/' . $lang . '.php';
	}
	$count = array(
		'pages'  => 0,
		'people' => 0,
		'groups' => 0,
		'events' => 0,
		'shows'  => 0,
	);

	// 1. Люди.
	$people = array();
	foreach ( $common['people'] as $key => $p ) {
		$ids = array();
		foreach ( $langs as $lang ) {
			$t           = $texts[ $lang ]['people'][ $key ];
			$ids[ $lang ] = vega_starter_insert(
				array(
					'post_type' => 'vega_person',
					'title'     => $t['name'],
					'content'   => vsb_p( $t['bio'] ),
					'excerpt'   => $t['directions'],
					'order'     => $p['order'],
				),
				array(
					'role'       => $p['role'],
					'active'     => '1',
					'directions' => $t['directions'],
				),
				$lang
			);
			++$count['people'];
		}
		vega_starter_link( $ids );
		$people[ $key ] = $ids;
	}

	// 2. Группы.
	foreach ( $common['groups'] as $key => $g ) {
		$ids = array();
		foreach ( $langs as $lang ) {
			$t        = $texts[ $lang ]['groups'][ $key ];
			$teachers = array();
			foreach ( $g['teachers'] as $i => $person_key ) {
				$teachers[] = array(
					'id'   => $people[ $person_key ][ $lang ],
					'note' => isset( $t['teacher_notes'][ $i ] ) ? $t['teacher_notes'][ $i ] : '',
				);
			}
			$ids[ $lang ] = vega_starter_insert(
				array(
					'post_type' => 'vega_group',
					'title'     => $t['title'],
					'content'   => $t['content'],
					'excerpt'   => $t['excerpt'],
					'order'     => $g['order'],
					'slug'      => sanitize_title( $t['title'] . ( 'ru' === $lang ? '' : '-' . $lang ) ),
				),
				array(
					'audience'      => $g['audience'],
					'recruiting'    => $g['recruiting'],
					'age_min'       => $g['age_min'],
					'age_max'       => $g['age_max'],
					'direction'     => $t['direction'],
					'schedule'      => $g['schedule'],
					'schedule_note' => isset( $t['schedule_note'] ) ? $t['schedule_note'] : '',
					'teachers'      => $teachers,
					'price_member'  => $g['price_member'],
					'price_regular' => $g['price_regular'],
					'price_note'    => $t['price_note'],
					'form'          => $g['form'],
				),
				$lang
			);
			++$count['groups'];
		}
		vega_starter_link( $ids );
	}

	// 3. Спектакли.
	foreach ( $common['shows'] as $key => $s ) {
		$ids = array();
		foreach ( $langs as $lang ) {
			$t            = $texts[ $lang ]['shows'][ $key ];
			$ids[ $lang ] = vega_starter_insert(
				array(
					'post_type' => 'vega_show',
					'title'     => $t,
					'content'   => vsb_p( $texts[ $lang ]['show_placeholder'] ),
					'order'     => $s['order'],
				),
				array(),
				$lang
			);
			++$count['shows'];
		}
		vega_starter_link( $ids );
	}

	// 4. Страницы (сначала создаём все, потом подставляем ссылки между ними).
	$pages = array();
	foreach ( $common['pages'] as $role => $page ) {
		$ids = array();
		foreach ( $langs as $lang ) {
			$t            = $texts[ $lang ]['pages'][ $role ];
			$ids[ $lang ] = vega_starter_insert(
				array(
					'post_type' => 'page',
					'title'     => $t['title'],
					'content'   => $t['content'],
					'excerpt'   => isset( $t['excerpt'] ) ? $t['excerpt'] : '',
					'slug'      => $t['slug'],
					'template'  => $page['template'],
					'order'     => $page['order'],
				),
				array(),
				$lang
			);
			++$count['pages'];
		}
		vega_starter_link( $ids );
		$pages[ $role ] = $ids;
	}
	foreach ( $pages as $role => $ids ) {
		foreach ( $ids as $lang => $id ) {
			$content = get_post_field( 'post_content', $id );
			$new     = preg_replace_callback(
				'/\{\{url:([a-z_]+)\}\}/',
				function ( $m ) use ( $pages, $lang ) {
					return isset( $pages[ $m[1] ][ $lang ] ) ? get_permalink( $pages[ $m[1] ][ $lang ] ) : home_url( '/' );
				},
				$content
			);
			if ( $new !== $content ) {
				wp_update_post(
					array(
						'ID'           => $id,
						'post_content' => wp_slash( $new ),
					)
				);
			}
		}
	}

	// 5. События (после страниц — в описании фестиваля ссылка на его страницу).
	foreach ( $common['events'] as $key => $e ) {
		$ids = array();
		foreach ( $langs as $lang ) {
			$t       = $texts[ $lang ]['events'][ $key ];
			$content = preg_replace_callback(
				'/\{\{url:([a-z_]+)\}\}/',
				function ( $m ) use ( $pages, $lang ) {
					return isset( $pages[ $m[1] ][ $lang ] ) ? get_permalink( $pages[ $m[1] ][ $lang ] ) : home_url( '/' );
				},
				$t['content']
			);
			$ids[ $lang ] = vega_starter_insert(
				array(
					'post_type' => 'vega_event',
					'title'     => $t['title'],
					'content'   => $content,
					'excerpt'   => $t['excerpt'],
				),
				array(
					'date'       => $e['date'],
					'time'       => $e['time'],
					'end_date'   => $e['end_date'],
					'place'      => $t['place'],
					'section'    => $e['section'],
					'no_tickets' => $e['no_tickets'],
				),
				$lang
			);
			++$count['events'];
		}
		vega_starter_link( $ids );
	}

	// 6. Служебные страницы в настройках темы (берём версию основного языка).
	$main    = in_array( 'ru', $langs, true ) ? 'ru' : $langs[0];
	$options = get_option( 'vega_options', array() );
	$options = is_array( $options ) ? $options : array();
	foreach ( $pages as $role => $ids ) {
		if ( empty( $options[ 'page_' . $role ] ) || 'publish' !== get_post_status( (int) $options[ 'page_' . $role ] ) ) {
			$options[ 'page_' . $role ] = $ids[ $main ];
		}
	}
	update_option( 'vega_options', $options );

	// 7. Главная страница и политика конфиденциальности.
	if ( $set_front ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $pages['home'][ $main ] );
	}
	$privacy = (int) get_option( 'wp_page_for_privacy_policy' );
	if ( ! $privacy || 'publish' !== get_post_status( $privacy ) ) {
		update_option( 'wp_page_for_privacy_policy', $pages['privacy'][ $main ] );
	}

	// 8. Меню.
	$menus = 0;
	foreach ( $langs as $lang ) {
		$menus += vega_starter_menus( $lang, $pages, $texts[ $lang ]['menu'], $set_menus );
	}

	flush_rewrite_rules();

	return sprintf(
		'Языки: %1$s. Создано: страниц — %2$d, групп — %3$d, людей — %4$d, событий — %5$d, спектаклей — %6$d, меню — %7$d.',
		strtoupper( implode( ', ', $langs ) ),
		$count['pages'],
		$count['groups'],
		$count['people'],
		$count['events'],
		$count['shows'],
		$menus
	);
}

/**
 * Меню шапки и подвала для одного языка.
 *
 * @param string $lang      Язык.
 * @param array  $pages     ID страниц по ролям и языкам.
 * @param array  $labels    Подписи пунктов меню.
 * @param bool   $set_menus Назначить меню в шапку и подвал.
 * @return int Сколько меню создано.
 */
function vega_starter_menus( $lang, $pages, $labels, $set_menus ) {
	$structure = array(
		'primary' => array(
			array( 'kids' ),
			array( 'adults' ),
			array( 'events' ),
			array( 'teachers' ),
			array( 'about', array( 'actorre', 'shkhuna', 'donate' ) ),
			array( 'festivals', array( 'fest_sky', 'fest_hilos' ) ),
			array( 'contacts' ),
		),
		'footer'  => array(
			array( 'about' ),
			array( 'actorre' ),
			array( 'shkhuna' ),
			array( 'donate' ),
			array( 'contacts' ),
			array( 'privacy' ),
		),
	);
	$created = 0;
	foreach ( $structure as $location => $items ) {
		$name    = ( 'primary' === $location ? 'Шапка' : 'Подвал' ) . ' (' . strtoupper( $lang ) . ')';
		$menu_id = wp_create_nav_menu( $name );
		if ( is_wp_error( $menu_id ) ) {
			// Меню с таким названием уже есть — создаём с пометкой, старое не трогаем.
			$menu_id = wp_create_nav_menu( $name . ' — Вега ' . wp_date( 'Y-m-d H:i' ) );
			if ( is_wp_error( $menu_id ) ) {
				continue;
			}
		}
		++$created;
		foreach ( $items as $item ) {
			$role  = $item[0];
			$label = isset( $labels[ $role ] ) ? $labels[ $role ] : '';
			if ( 'festivals' === $role ) {
				$parent = wp_update_nav_menu_item(
					$menu_id,
					0,
					array(
						'menu-item-title'     => $label,
						'menu-item-object'    => 'page',
						'menu-item-object-id' => $pages['fest_sky'][ $lang ],
						'menu-item-type'      => 'post_type',
						'menu-item-status'    => 'publish',
					)
				);
			} else {
				$parent = wp_update_nav_menu_item(
					$menu_id,
					0,
					array(
						'menu-item-title'     => $label,
						'menu-item-object'    => 'page',
						'menu-item-object-id' => $pages[ $role ][ $lang ],
						'menu-item-type'      => 'post_type',
						'menu-item-status'    => 'publish',
					)
				);
			}
			if ( ! empty( $item[1] ) && ! is_wp_error( $parent ) ) {
				foreach ( $item[1] as $child ) {
					wp_update_nav_menu_item(
						$menu_id,
						0,
						array(
							'menu-item-title'     => isset( $labels[ $child ] ) ? $labels[ $child ] : '',
							'menu-item-object'    => 'page',
							'menu-item-object-id' => $pages[ $child ][ $lang ],
							'menu-item-type'      => 'post_type',
							'menu-item-parent-id' => $parent,
							'menu-item-status'    => 'publish',
						)
					);
				}
			}
		}
		if ( $set_menus ) {
			vega_starter_assign_menu( $location, $menu_id, $lang );
		}
	}
	return $created;
}

/**
 * Ставит меню в место темы. С Polylang у каждого языка своё меню.
 *
 * @param string $location primary | footer.
 * @param int    $menu_id  ID меню.
 * @param string $lang     Язык.
 */
function vega_starter_assign_menu( $location, $menu_id, $lang ) {
	$default = function_exists( 'pll_default_language' ) ? pll_default_language() : 'ru';
	if ( $lang === $default || ! vega_has_polylang() ) {
		$locations              = get_theme_mod( 'nav_menu_locations', array() );
		$locations              = is_array( $locations ) ? $locations : array();
		$locations[ $location ] = $menu_id;
		set_theme_mod( 'nav_menu_locations', $locations );
	}
	if ( ! vega_has_polylang() || ! function_exists( 'PLL' ) ) {
		return;
	}
	// Polylang хранит меню для каждого языка в своих настройках.
	$pll = PLL();
	if ( ! isset( $pll->options ) ) {
		return;
	}
	$theme = get_stylesheet();
	$nav   = isset( $pll->options['nav_menus'] ) ? (array) $pll->options['nav_menus'] : array();
	$nav[ $theme ][ $location ][ $lang ] = $menu_id;
	if ( is_array( $pll->options ) ) {
		$pll->options['nav_menus'] = $nav;
		update_option( 'polylang', $pll->options );
	} else {
		// Polylang 3.7+: настройки — объект, сохраняется сам.
		$pll->options['nav_menus'] = $nav;
		if ( method_exists( $pll->options, 'save' ) ) {
			$pll->options->save();
		}
	}
}
