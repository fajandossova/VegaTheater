<?php
/**
 * Главная страница. Если в «Настройки → Чтение» выбрана статическая главная —
 * показываем её как страницу из секций (без отдельного заголовка),
 * иначе — обычный список записей.
 *
 * @package Vega
 */

defined( 'ABSPATH' ) || exit;

if ( 'page' === get_option( 'show_on_front' ) && is_page() ) {
	get_template_part( 'template-parts/sections' );
	return;
}

require get_index_template();
