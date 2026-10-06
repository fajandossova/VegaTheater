<?php
/**
 * Стартовое содержимое: данные, не зависящие от языка
 * (расписание, возраст, цены, даты). Тексты — в ru.php, es.php, en.php.
 *
 * День недели: 1 — понедельник … 7 — воскресенье.
 *
 * @package Vega
 */

defined( 'ABSPATH' ) || exit;

return array(
	'people' => array(
		'fatima'    => array( 'role' => 'teacher', 'order' => 1 ),
		'nadezhda'  => array( 'role' => 'teacher', 'order' => 2 ),
		'dasha'     => array( 'role' => 'teacher', 'order' => 3 ),
		'nikolai'   => array( 'role' => 'teacher', 'order' => 4 ),
		'pamela'    => array( 'role' => 'teacher', 'order' => 5 ),
	),

	'groups' => array(
		'milkyway'     => array(
			'audience'      => 'kids',
			'recruiting'    => '1',
			'age_min'       => 4,
			'age_max'       => 6,
			'schedule'      => array(
				array( 'day' => 7, 'start' => '11:30', 'end' => '12:30' ),
				array( 'day' => 4, 'start' => '17:30', 'end' => '18:30' ),
			),
			'teachers'      => array( 'nadezhda' ),
			'price_member'  => '',
			'price_regular' => 70,
			'form'          => 'kids',
			'order'         => 1,
		),
		'orion'        => array(
			'audience'      => 'kids',
			'recruiting'    => '1',
			'age_min'       => 6,
			'age_max'       => 8,
			'schedule'      => array(
				array( 'day' => 7, 'start' => '15:30', 'end' => '17:00' ),
				array( 'day' => 3, 'start' => '17:00', 'end' => '18:30' ),
			),
			'teachers'      => array( 'nadezhda', 'pamela', 'nikolai', 'fatima' ),
			'price_member'  => 80,
			'price_regular' => 100,
			'form'          => 'kids',
			'order'         => 2,
		),
		'lyra'         => array(
			'audience'      => 'kids',
			'recruiting'    => '1',
			'age_min'       => 10,
			'age_max'       => 12,
			'schedule'      => array(
				array( 'day' => 7, 'start' => '13:45', 'end' => '15:15' ),
				array( 'day' => 3, 'start' => '18:30', 'end' => '20:00' ),
			),
			'teachers'      => array( 'nikolai', 'nadezhda', 'pamela', 'dasha' ),
			'price_member'  => 80,
			'price_regular' => 100,
			'form'          => 'kids',
			'order'         => 3,
		),
		'hiphop'       => array(
			'audience'      => 'kids',
			'recruiting'    => '1',
			'age_min'       => 8,
			'age_max'       => 14,
			'schedule'      => array(
				array( 'day' => 7, 'start' => '12:30', 'end' => '13:30' ),
				array( 'day' => 1, 'start' => '16:30', 'end' => '17:30' ),
			),
			'teachers'      => array( 'nadezhda' ),
			'price_member'  => 50,
			'price_regular' => 70,
			'form'          => 'kids',
			'order'         => 4,
		),
		'contemporary' => array(
			'audience'      => 'kids',
			'recruiting'    => '1',
			'age_min'       => 7,
			'age_max'       => 10,
			'schedule'      => array(
				array( 'day' => 2, 'start' => '18:30', 'end' => '19:30' ),
				array( 'day' => 4, 'start' => '18:30', 'end' => '19:30' ),
			),
			'teachers'      => array( 'dasha' ),
			'price_member'  => 50,
			'price_regular' => 70,
			'form'          => 'kids',
			'order'         => 5,
		),
		'bas'          => array(
			'audience'      => 'adults',
			'recruiting'    => '',
			'age_min'       => '',
			'age_max'       => '',
			'schedule'      => array(),
			'teachers'      => array( 'fatima' ),
			'price_member'  => '',
			'price_regular' => '',
			'form'          => 'adults',
			'order'         => 10,
		),
		'coralola'     => array(
			'audience'      => 'adults',
			'recruiting'    => '1',
			'age_min'       => 17,
			'age_max'       => '',
			'schedule'      => array(
				array( 'day' => 5, 'start' => '11:30', 'end' => '13:00' ),
			),
			'teachers'      => array( 'pamela' ),
			'price_member'  => '',
			'price_regular' => 30,
			'form'          => 'adults',
			'order'         => 11,
		),
	),

	'shows'  => array(
		'prince'    => array( 'order' => 1 ),
		'buratino'  => array( 'order' => 2 ),
		'encanto'   => array( 'order' => 3 ),
		'rabbit'    => array( 'order' => 4 ),
		'alice'     => array( 'order' => 5 ),
		'snowqueen' => array( 'order' => 6 ),
	),

	'events' => array(
		'festival2026' => array(
			'date'       => '2026-10-16',
			'time'       => '',
			'end_date'   => '2026-10-18',
			'section'    => 'festival',
			'no_tickets' => '1',
		),
		'gopenko'      => array(
			'date'       => '2026-10-25',
			'time'       => '20:00',
			'end_date'   => '',
			'section'    => 'concert',
			'no_tickets' => '',
		),
	),

	// Шаблон страницы: '' — обычная (с заголовком), sections — из секций, festival-sky — палитра фестиваля.
	'pages'  => array(
		'home'       => array( 'template' => 'page-templates/sections.php', 'order' => 0 ),
		'kids'       => array( 'template' => '', 'order' => 1 ),
		'adults'     => array( 'template' => '', 'order' => 2 ),
		'events'     => array( 'template' => '', 'order' => 3 ),
		'teachers'   => array( 'template' => '', 'order' => 4 ),
		'about'      => array( 'template' => '', 'order' => 5 ),
		'actorre'    => array( 'template' => '', 'order' => 6 ),
		'shkhuna'    => array( 'template' => '', 'order' => 7 ),
		'fest_sky'   => array( 'template' => 'page-templates/festival-sky.php', 'order' => 8 ),
		'fest_hilos' => array( 'template' => 'page-templates/sections.php', 'order' => 9 ),
		'donate'     => array( 'template' => '', 'order' => 10 ),
		'contacts'   => array( 'template' => '', 'order' => 11 ),
		'privacy'    => array( 'template' => '', 'order' => 12 ),
	),
);
