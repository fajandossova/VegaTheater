<?php
/**
 * Тема «Вега» — подключение всех частей.
 *
 * Код разложен по файлам в папке inc/:
 *  - helpers.php      — настройки темы, ссылки, иконки;
 *  - i18n.php         — языки, даты, Polylang;
 *  - setup.php        — поддержка возможностей WordPress, стили, скрипты, меню;
 *  - post-types.php   — типы записей: события, группы, люди, спектакли;
 *  - meta-boxes.php   — поля этих записей в админке;
 *  - queries.php      — выборки (предстоящие события, действующие педагоги и т. д.);
 *  - components.php   — HTML-кусочки: карточки, афиша, кнопки, реквизиты;
 *  - blocks.php       — блоки «Вега: …» для редактора;
 *  - settings.php     — страница «Театр Вега» в админке;
 *  - starter.php      — кнопка «Создать стартовое содержимое».
 *
 * @package Vega
 */

defined( 'ABSPATH' ) || exit;

define( 'VEGA_VERSION', '1.0.0' );
define( 'VEGA_DIR', get_template_directory() );
define( 'VEGA_URI', get_template_directory_uri() );

require VEGA_DIR . '/inc/helpers.php';
require VEGA_DIR . '/inc/i18n.php';
require VEGA_DIR . '/inc/setup.php';
require VEGA_DIR . '/inc/post-types.php';
require VEGA_DIR . '/inc/meta-boxes.php';
require VEGA_DIR . '/inc/queries.php';
require VEGA_DIR . '/inc/components.php';
require VEGA_DIR . '/inc/blocks.php';

if ( is_admin() ) {
	require VEGA_DIR . '/inc/settings.php';
	require VEGA_DIR . '/inc/starter.php';
}
