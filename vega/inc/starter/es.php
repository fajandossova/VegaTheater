<?php
/**
 * Стартовое содержимое: испанский язык.
 *
 * @package Vega
 */

defined( 'ABSPATH' ) || exit;

$hero_image = VEGA_URI . '/assets/img/hero-lyra.svg';

return array(
	'menu'             => array(
		'kids'       => 'Estudio infantil',
		'adults'     => 'Adultos',
		'events'     => 'Agenda',
		'teachers'   => 'Profesores',
		'about'      => 'El teatro',
		'actorre'    => 'Actorre',
		'shkhuna'    => 'Shkhuna',
		'donate'     => 'Apoya al teatro',
		'festivals'  => 'Festivales',
		'fest_sky'   => 'Bajo el cielo de España',
		'fest_hilos' => 'Hilos Rojos',
		'contacts'   => 'Contacto',
		'privacy'    => 'Política de privacidad',
	),

	'show_placeholder' => 'Descripción del espectáculo en preparación. Aquí aparecerán el argumento, las fotos y el reparto.',

	'people'           => array(
		'fatima'   => array(
			'name'       => 'Fatima Jandossova',
			'directions' => 'Directora artística, interpretación, dirección escénica',
			'bio'        => 'Fundadora y directora artística del Teatro Vega. Biografía: texto en preparación.',
		),
		'nadezhda' => array(
			'name'       => 'Nadezhda Makarchuk',
			'directions' => 'Coreografía (hip-hop, K-pop, danza de espectáculo), interpretación, dicción escénica',
			'bio'        => 'Biografía: texto en preparación.',
		),
		'dasha'    => array(
			'name'       => 'Dasha Nechiporenko',
			'directions' => 'Coreografía, danza contemporánea, vestuario',
			'bio'        => 'Biografía: texto en preparación.',
		),
		'nikolai'  => array(
			'name'       => 'Nikolai Barabanov',
			'directions' => 'Dicción escénica, combate escénico, English theater',
			'bio'        => 'Biografía: texto en preparación.',
		),
		'pamela'   => array(
			'name'       => 'Pamela Kirillova',
			'directions' => 'Canto, coro',
			'bio'        => 'Biografía: texto en preparación.',
		),
	),

	'groups'           => array(
		'milkyway'     => array(
			'title'         => 'Milky Way',
			'direction'     => 'Juego teatral, movimiento, música',
			'excerpt'       => 'Los más pequeños: jugamos al teatro, nos movemos con música y perdemos el miedo al público.',
			'content'       => vsb_p( 'El grupo más pequeño del estudio. Aquí todo es juego: los niños se convierten en animales y personajes de cuento, se mueven con la música, aprenden a hablar alto y a mirar al público. La clase dura una hora, justo lo que un peque puede estar atento sin cansarse.' )
				. vsb_p( 'Se puede venir dos veces por semana o solo los domingos, como le vaya mejor a la familia.' ),
			'price_note'    => 'dos clases por semana; 40 € al mes solo los domingos',
			'teacher_notes' => array( '' ),
		),
		'orion'        => array(
			'title'         => 'Orion',
			'direction'     => 'Interpretación, canto, dicción escénica, combate escénico',
			'excerpt'       => 'El primer grupo de teatro «de verdad»: escenas, papeles y primeras obras.',
			'content'       => vsb_p( 'En Orion los niños reciben su primer papel. Descubrimos quién es el personaje y qué quiere, aprendemos a trabajar en pareja, a cantar, a hablar con claridad y a «pelear» en escena de forma segura, con las reglas del combate escénico.' )
				. vsb_p( 'Cuatro profesores trabajan con el grupo, cada uno en su especialidad. Dos clases por semana de hora y media.' ),
			'price_note'    => 'dos clases por semana de hora y media',
			'teacher_notes' => array( 'interpretación', 'canto', 'dicción y combate escénico', 'voz y teatro de objetos' ),
		),
		'lyra'         => array(
			'title'         => 'Lyra',
			'direction'     => 'Interpretación, dicción escénica, canto, coreografía',
			'excerpt'       => 'El grupo de teatro de los mayores: obras completas y papeles más exigentes.',
			'content'       => vsb_p( 'Lyra es la constelación donde brilla nuestra Vega. Un grupo para chicos y chicas de 10 a 12 años que quieren actuar en serio: ensayan obras completas, prueban papeles protagonistas y de carácter, y aprenden a sostener la escena y al público.' )
				. vsb_p( 'Dos clases por semana de hora y media, con cuatro profesores.' ),
			'price_note'    => 'dos clases por semana de hora y media',
			'teacher_notes' => array( 'dicción escénica', 'interpretación', 'canto', 'coreografía' ),
		),
		'hiphop'       => array(
			'title'         => 'Hip-Hop',
			'direction'     => 'Hip-hop, K-pop, danza de espectáculo',
			'excerpt'       => 'Un grupo de baile con mucha energía: ritmo, coreografías y números para actuar.',
			'content'       => vsb_p( 'Para los que no pueden estarse quietos. Aprendemos pasos y coreografías completas de hip-hop y K-pop, trabajamos el ritmo, la coordinación y la resistencia. Los bailes terminados se presentan en los conciertos y espectáculos del estudio.' ),
			'price_note'    => 'dos clases por semana de una hora',
			'teacher_notes' => array( '' ),
		),
		'contemporary' => array(
			'title'         => 'Contemporary',
			'direction'     => 'Danza contemporánea',
			'excerpt'       => 'Danza contemporánea: expresión corporal, improvisación y música.',
			'content'       => vsb_p( 'La danza contemporánea enseña a sentir el propio cuerpo y la música. Mucha improvisación y trabajo con el espacio: los niños no solo repiten movimientos, también inventan los suyos. Combina muy bien con las clases de interpretación.' ),
			'price_note'    => 'dos clases por semana de una hora',
			'teacher_notes' => array( '' ),
		),
		'bas'          => array(
			'title'         => 'Arranque actoral rápido',
			'direction'     => 'Taller de autor: cuerpo, voz, improvisación',
			'excerpt'       => 'Un taller para adultos que se acercan al teatro desde cero.',
			'content'       => vsb_p( '«Arranque actoral rápido» (BAS) es el taller de autor de Fatima Jandossova para quienes siempre quisieron probar el teatro y no sabían por dónde empezar. No hace falta experiencia.' )
				. vsb_p( 'Trabajamos el cuerpo, la voz y la improvisación: aprendemos a movernos con libertad, a hablar para que nos escuchen y a reaccionar aquí y ahora. Muchos vienen «por gusto» y luego notan que les cuesta menos hablar en público en el trabajo.' ),
			'schedule_note' => 'horario del próximo grupo: pregúntanos por WhatsApp',
			'price_note'    => '',
			'teacher_notes' => array( '' ),
		),
		'coralola'     => array(
			'title'         => 'Coral OLA',
			'direction'     => 'Coro para adultos, canciones en español',
			'excerpt'       => 'Coro para adultos a partir de 17 años. No hace falta leer partituras.',
			'content'       => vsb_p( 'Coro para adultos a partir de 17 años, dirigido por Pamela Kirillova. Cantamos en español y no hace falta saber solfeo: las voces se aprenden de oído.' )
				. vsb_p( 'Viernes de 11:30 a 13:00. 30 € al mes.' ),
			'price_note'    => '',
			'teacher_notes' => array( '' ),
		),
	),

	'shows'            => array(
		'prince'    => 'El Principito',
		'buratino'  => 'Las aventuras de Buratino',
		'encanto'   => 'Encanto',
		'rabbit'    => 'El conejo de la luna',
		'alice'     => 'Alicia a través del espejo',
		'snowqueen' => 'La reina de las nieves',
	),

	'events'           => array(
		'festival2026' => array(
			'title'   => 'Festival «Bajo el cielo de España»',
			'place'   => 'Alannia Guardamar, Guardamar del Segura',
			'excerpt' => 'Tres días de canción de autor junto al mar: conciertos, concurso y talleres.',
			'content' => vsb_p( 'Festival de canción de autor en el camping Alannia Guardamar. Conciertos de los invitados, concurso de intérpretes, talleres, el juego «¿Qué? ¿Dónde? ¿Cuándo?» con Borís Burda, una velada con canciones de Alexander Gálich, la «guitarra en círculo» y la fiesta BARDbecue.' )
				. vsb_buttons( array( array( 'Programa e inscripción', '{{url:fest_sky}}' ) ) ),
		),
		'gopenko'      => array(
			'title'   => 'Concierto de Ekaterina Gopenko',
			'place'   => 'Calle Santander 10, Torrevieja',
			'excerpt' => 'Concierto en el espacio de arte del teatro.',
			'content' => vsb_p( 'Concierto de Ekaterina Gopenko en el espacio de arte del Teatro Vega. Pronto publicaremos el programa.' ),
		),
	),

	'pages'            => array(
		'home'       => array(
			'title'   => 'Inicio',
			'slug'    => 'inicio',
			'content' =>
				vsb_section(
					vsb_columns(
						array(
							vsb_p( 'Estudio de teatro · Torrevieja · desde 2019', 'eyebrow' )
							. vsb_h( 'Creamos estrellas y constelaciones', 1 )
							. vsb_p( 'Vega es un estudio de teatro para niños y adultos. Aquí se aprende a hablar para que te escuchen, a moverse con libertad y a perder el miedo al escenario. Y al final de la temporada, a salir ante público de verdad: con vestuario, luces y aplausos.', 'lead' )
							. vsb_vega( 'form-button', array( 'form' => 'kids', 'whatsapp' => 'enrol' ) )
							. vsb_p( 'La primera clase es gratis.' ),
							vsb_image( $hero_image, 'Constelación de Lira con la brillante estrella Vega', 'portrait' ),
						)
					),
					'stars'
				)
				. vsb_section(
					vsb_columns(
						array(
							vsb_h( 'Quiénes somos' )
							. vsb_p( 'Somos un equipo de profesores que también están en escena: actores, coreógrafos y cantantes. Trabajamos en nuestro propio espacio de arte en la Calle Santander 10 de Torrevieja. Al estudio vienen familias de muchos países, y en el escenario eso suma: el teatro enseña a escuchar al compañero y los niños se entienden enseguida.' ),
							vsb_list(
								array(
									'<strong>Valentía.</strong> Salir delante de la gente y decir lo tuyo deja de dar miedo.',
									'<strong>Voz y dicción.</strong> Hablar alto, claro y con intención.',
									'<strong>Cuerpo.</strong> Coordinación, expresión corporal, sentido del ritmo.',
									'<strong>Equipo.</strong> En el teatro nadie actúa solo.',
								),
								false,
								'starlist'
							),
						)
					)
				)
				. vsb_section(
					vsb_p( 'Temporada 2026/27 · inscripciones abiertas', 'eyebrow' )
					. vsb_h( 'Grupos del estudio infantil' )
					. vsb_p( 'Los grupos llevan nombres de constelaciones y galaxias. Elige por edad y, si dudas, ven a una clase de prueba gratuita: el profesor verá a tu hijo y te aconsejará.' )
					. vsb_vega( 'groups', array( 'audience' => 'kids', 'align' => 'wide' ) )
					. vsb_buttons( array( array( 'Horarios y precios', '{{url:kids}}', 'outline' ) ) )
				)
				. vsb_section(
					vsb_p( 'Agenda', 'eyebrow' )
					. vsb_h( 'Próximos eventos' )
					. vsb_vega( 'events', array( 'limit' => 4, 'moreLink' => true, 'align' => 'wide' ) ),
					'light'
				)
				. vsb_section(
					vsb_p( 'Equipo', 'eyebrow' )
					. vsb_h( 'Profesores' )
					. vsb_p( 'Quienes dan las clases cada semana y montan los espectáculos con los niños.' )
					. vsb_vega( 'people', array( 'role' => 'teacher', 'align' => 'wide' ) )
				)
				. vsb_section(
					vsb_h( 'Alrededor del teatro' )
					. vsb_columns(
						array(
							vsb_section(
								vsb_vega( 'logo', array( 'which' => 'actorre' ) )
								. vsb_p( 'La asociación cultural que reúne el Teatro Vega, el club Shkhuna, el coro Coral OLA y los festivales. Los socios pagan menos por las clases y los eventos.' )
								. vsb_buttons( array( array( 'La asociación', '{{url:actorre}}', 'outline' ) ) ),
								'card',
								''
							),
							vsb_section(
								vsb_vega( 'logo', array( 'which' => 'shkhuna' ) )
								. vsb_p( 'Club de canción de autor. Casi todos los domingos: invitados, canciones y la «guitarra en círculo», donde cualquiera puede cantar.' )
								. vsb_buttons( array( array( 'El club', '{{url:shkhuna}}', 'outline' ) ) ),
								'card',
								''
							),
							vsb_section(
								vsb_h( 'Festivales', 3 )
								. vsb_p( '«Bajo el cielo de España», festival de canción de autor en octubre. Hilos Rojos, festival internacional de teatro aficionado en primavera.' )
								. vsb_buttons(
									array(
										array( 'Bajo el cielo de España', '{{url:fest_sky}}', 'outline' ),
										array( 'Hilos Rojos', '{{url:fest_hilos}}', 'outline' ),
									)
								),
								'card',
								''
							),
						)
					)
				)
				. vsb_section(
					vsb_h( 'Apoya al teatro' )
					. vsb_p( 'Vestuario, decorados, luces, alquiler de salas para los espectáculos: todo cuesta dinero. Cada donativo a la asociación Actorre ayuda a que los niños suban al escenario.' )
					. vsb_buttons( array( array( 'Cómo ayudar', '{{url:donate}}' ) ) ),
					'band'
				)
				. vsb_section(
					vsb_h( 'La primera clase es gratis' )
					. vsb_p( 'Ven con tu hijo, mira cómo trabajamos y decide con calma. Puedes apuntarte con el formulario o por WhatsApp.' )
					. vsb_vega( 'form-button', array( 'form' => 'kids', 'whatsapp' => 'enrol' ) ),
					'stars'
				),
		),

		'kids'       => array(
			'title'   => 'Estudio infantil',
			'slug'    => 'estudio-infantil',
			'excerpt' => 'Grupos para niños de 4 a 14 años: interpretación, danza, canto y dicción. La primera clase es gratis.',
			'content' =>
				vsb_p( 'Cada grupo combina interpretación, movimiento, voz y dicción en la medida justa para su edad. Los pequeños juegan más; los mayores ensayan obras de verdad. A lo largo de la temporada, los grupos actúan ante el público.', 'lead' )
				. vsb_h( 'Grupos' )
				. vsb_vega( 'groups', array( 'audience' => 'kids', 'align' => 'wide' ) )
				. vsb_section(
					vsb_h( 'Horario' )
					. vsb_vega( 'schedule', array( 'audience' => 'kids', 'align' => 'wide' ) )
					. vsb_h( 'Precios' )
					. vsb_vega( 'prices', array( 'audience' => 'kids' ) )
					. vsb_list(
						array(
							'<strong>La primera clase de prueba es gratis.</strong>',
							'Grupos de interpretación Orion y Lyra: 80 € al mes para socios de Actorre, 100 € sin ser socio. Dos clases por semana de hora y media.',
							'Grupos de danza Hip-Hop y Contemporary: 50 € al mes para socios, 70 € sin ser socio. Dos clases por semana de una hora.',
							'Milky Way: 70 € al mes por dos clases semanales o 40 € solo los domingos.',
							'La cuota de socio de la asociación Actorre es de 10 € al año y se paga aparte.',
						)
					),
					'light'
				)
				. vsb_h( 'Cómo inscribirse' )
				. vsb_list(
					array(
						'Rellena el formulario breve o escríbenos por WhatsApp.',
						'Te proponemos día y hora para la clase de prueba gratuita.',
						'Después de la clase, el profesor te cuenta cómo ha ido y decides con calma si os quedáis.',
					),
					true
				)
				. vsb_vega( 'form-button', array( 'form' => 'kids', 'whatsapp' => 'enrol' ) ),
		),

		'adults'     => array(
			'title'   => 'Adultos',
			'slug'    => 'adultos',
			'excerpt' => 'Un taller de interpretación para empezar desde cero y un coro donde no hace falta saber solfeo.',
			'content' =>
				vsb_p( 'El teatro no es solo para niños. Para adultos y adolescentes tenemos dos programas: un taller de interpretación para quienes se estrenan y un coro.', 'lead' )
				. vsb_vega( 'groups', array( 'audience' => 'adults', 'align' => 'wide' ) )
				. vsb_h( 'Arranque actoral rápido (BAS)' )
				. vsb_p( 'El taller de autor de Fatima Jandossova para quienes siempre quisieron probar el teatro y no sabían por dónde empezar. No hace falta experiencia. Cuerpo, voz e improvisación: en pocas clases notarás que hablar en público cuesta menos.' )
				. vsb_h( 'Coro Coral OLA' )
				. vsb_p( 'Coro para adultos a partir de 17 años, dirigido por Pamela Kirillova. Cantamos en español y no hace falta saber solfeo: las voces se aprenden de oído. Viernes de 11:30 a 13:00, 30 € al mes.' )
				. vsb_vega( 'form-button', array( 'form' => 'adults', 'whatsapp' => 'enrol' ) ),
		),

		'events'     => array(
			'title'   => 'Agenda y entradas',
			'slug'    => 'agenda',
			'excerpt' => 'Espectáculos, conciertos, festivales y encuentros del club Shkhuna.',
			'content' =>
				vsb_p( 'Las entradas se venden online. Los socios de Actorre tienen precio reducido en muchos eventos.', 'lead' )
				. vsb_vega( 'events', array( 'limit' => 30, 'align' => 'wide' ) )
				. vsb_vega( 'tickets' )
				. vsb_section(
					vsb_h( 'Archivo' )
					. vsb_p( 'Lo que ya pasó, por años.' )
					. vsb_vega( 'events-archive' ),
					'light'
				),
		),

		'teachers'   => array(
			'title'   => 'Profesores',
			'slug'    => 'profesores',
			'excerpt' => 'Cada uno lleva su especialidad, y los espectáculos los montamos entre todos.',
			'content' => vsb_vega( 'people', array( 'role' => 'teacher', 'align' => 'wide' ) ),
		),

		'about'      => array(
			'title'   => 'El teatro',
			'slug'    => 'el-teatro',
			'excerpt' => 'Estudio de teatro en Torrevieja desde 2019.',
			'content' =>
				vsb_p( 'El estudio Vega trabaja en Torrevieja desde 2019. Hoy son cinco grupos infantiles, programas para adultos, un espacio de arte propio en la Calle Santander 10, un club de canción de autor y dos festivales. El teatro es un proyecto de la asociación cultural Actorre.', 'lead' )
				. vsb_h( '¿Por qué Vega?' )
				. vsb_p( 'Vega es una de las estrellas más brillantes del cielo nocturno y la principal de la constelación de Lira. Por eso nuestros grupos llevan nombres de constelaciones y galaxias: Milky Way, Orion, Lyra.' )
				. vsb_h( 'En qué creemos' )
				. vsb_list(
					array(
						'<strong>Todos pueden subir al escenario.</strong> No siempre como protagonista el primer año, pero siempre con un papel propio.',
						'<strong>Primero la confianza, luego la técnica.</strong> Un niño con miedo no actúa. Por eso no empujamos a nadie al escenario.',
						'<strong>El teatro es un equipo.</strong> Aprendemos a escuchar al compañero y a apoyarnos.',
						'<strong>El resultado es un espectáculo ante público de verdad.</strong> Con vestuario, luces y saludos finales.',
						'<strong>Muchos países, un escenario.</strong> Al estudio vienen familias de distintos países, y eso nos enriquece.',
					),
					false,
					'starlist'
				)
				. vsb_section(
					vsb_h( 'Preguntas frecuentes' )
					. vsb_faq( 'Mi hijo es tímido. ¿Es para él?', 'Sí. Trabajamos con niños tímidos constantemente. Primero juegos y ejercicios en círculo; el papel llega cuando el niño se siente preparado.' )
					. vsb_faq( '¿Hace falta experiencia o audición?', 'No. Todos los grupos son sin audición. Basta con venir a una clase de prueba gratuita.' )
					. vsb_faq( '¿Se puede empezar a mitad de temporada?', 'Sí, si hay plaza en el grupo. Escríbenos por WhatsApp y te orientamos.' )
					. vsb_faq( '¿Cuánto cuesta?', 'Los precios están en la página <a href="{{url:kids}}">Estudio infantil</a>. La primera clase es gratis. Ser socio de Actorre cuesta 10 € al año y reduce el precio de las clases.' )
					. vsb_faq( '¿Qué hay que traer?', 'Ropa cómoda para moverse, calzado de cambio o calcetines y una botella de agua.' )
					. vsb_faq( '¿Dónde son las clases?', 'En el espacio de arte del teatro: Calle Santander 10, Torrevieja. Cómo llegar, en <a href="{{url:contacts}}">Contacto</a>.' ),
					'light'
				)
				. vsb_h( 'Repertorio' )
				. vsb_vega( 'shows', array( 'align' => 'wide' ) ),
		),

		'actorre'    => array(
			'title'   => 'Actorre',
			'slug'    => 'asociacion-actorre',
			'excerpt' => 'La asociación cultural que reúne el Teatro Vega, el club Shkhuna, el coro Coral OLA y los festivales.',
			'content' =>
				vsb_vega( 'logo', array( 'which' => 'actorre' ) )
				. vsb_p( 'La Asociación Cultural Centro de Art «Actorre» es una asociación cultural sin ánimo de lucro de Torrevieja. Fundada en 2023 y registrada en 2025. Presidenta: Fatima Jandossova.', 'lead' )
				. vsb_h( 'Proyectos de la asociación' )
				. vsb_list(
					array(
						'<a href="{{url:home}}">Teatro Vega</a>: estudio infantil y programas para adultos.',
						'<a href="{{url:shkhuna}}">Club de canción de autor Shkhuna</a>.',
						'Coro para adultos Coral OLA.',
						'Los festivales <a href="{{url:fest_sky}}">«Bajo el cielo de España»</a> y <a href="{{url:fest_hilos}}">Hilos Rojos</a>.',
					),
					false,
					'starlist'
				)
				. vsb_section(
					vsb_h( 'Hazte socio' )
					. vsb_p( 'La cuota es de 10 € al año. Los socios tienen precios reducidos en clases y eventos: por ejemplo, un grupo de interpretación cuesta 80 € al mes en lugar de 100 €, y una velada de Shkhuna, 5 € en lugar de 7 €.' )
					. vsb_h( 'Cómo asociarse', 3 )
					. vsb_p( 'Rellena el formulario: hay uno para adultos y otro para madres y padres de participantes menores de edad.' )
					. vsb_vega( 'form-button', array( 'form' => 'actorre_adult', 'whatsapp' => 'none' ) )
					. vsb_vega( 'form-button', array( 'form' => 'actorre_parent', 'whatsapp' => 'none' ) ),
					'light'
				)
				. vsb_p( 'Correo de la asociación: <a href="mailto:actorre.centro@gmail.com">actorre.centro@gmail.com</a>' ),
		),

		'shkhuna'    => array(
			'title'   => 'Shkhuna',
			'slug'    => 'club-shkhuna',
			'excerpt' => 'Club de canción de autor en Torrevieja. Encuentros casi todos los domingos.',
			'content' =>
				vsb_vega( 'logo', array( 'which' => 'shkhuna' ) )
				. vsb_p( 'El club de canción de autor Shkhuna («La goleta») se reúne casi todos los domingos en el espacio de arte del teatro, en la Calle Santander 10.', 'lead' )
				. vsb_h( 'Cómo es una velada' )
				. vsb_p( 'Primero escuchamos a los invitados y a los compañeros. Después llega la «guitarra en círculo»: cualquiera puede cantar o recitar algo suyo. También se puede venir solo a escuchar; así empezaron muchos.' )
				. vsb_h( 'Entrada' )
				. vsb_list(
					array(
						'7 €',
						'5 € para socios de la asociación <a href="{{url:actorre}}">Actorre</a>',
					)
				)
				. vsb_section(
					vsb_h( 'Próximos encuentros' )
					. vsb_vega( 'events', array( 'section' => 'shkhuna', 'limit' => 6 ) ),
					'light'
				)
				. vsb_h( 'En redes sociales' )
				. vsb_vega( 'socials', array( 'set' => 'shkhuna' ) ),
		),

		'fest_sky'   => array(
			'title'   => 'Festival «Bajo el cielo de España»',
			'slug'    => 'bajo-el-cielo-de-espana',
			'excerpt' => 'Festival de canción de autor. Del 16 al 18 de octubre de 2026, Alannia Guardamar.',
			'content' =>
				vsb_section(
					vsb_p( 'Festival de canción de autor · 2026', 'eyebrow' )
					. vsb_h( 'Bajo el cielo de España', 1 )
					. vsb_p( '16–18 de octubre de 2026 · camping Alannia Guardamar, Guardamar del Segura, cerca de Torrevieja', 'lead' )
					. vsb_vega( 'form-button', array( 'form' => 'festival', 'whatsapp' => 'director' ) ),
					'stars'
				)
				. vsb_p( 'Tres días de canciones junto al mar y bajo las estrellas. Organiza el Teatro Vega.', 'lead' )
				. vsb_h( 'Invitados' )
				. vsb_list(
					array( 'Borís Burda', 'Vladímir Mishin', 'Ekaterina Gopenko', 'Philippe Bovier', 'Alexandra Yershova' ),
					false,
					'starlist'
				)
				. vsb_h( 'Programa' )
				. vsb_list(
					array(
						'Conciertos de los invitados',
						'Concurso de intérpretes',
						'Talleres',
						'El juego «¿Qué? ¿Dónde? ¿Cuándo?» con Borís Burda',
						'Velada con canciones de Alexander Gálich',
						'«Guitarra en círculo»',
						'Fiesta BARDbecue',
					)
				)
				. vsb_section(
					vsb_h( 'Inscripción' )
					. vsb_p( 'Participantes e invitados se inscriben con el formulario. Dudas, por WhatsApp.' )
					. vsb_vega( 'form-button', array( 'form' => 'festival', 'whatsapp' => 'director' ) ),
					'light'
				),
		),

		'fest_hilos' => array(
			'title'   => 'Festival Hilos Rojos',
			'slug'    => 'festival-hilos-rojos',
			'excerpt' => 'Festival internacional de teatro aficionado en Torrevieja.',
			'content' =>
				vsb_section(
					vsb_p( 'Festival internacional de teatro aficionado · Torrevieja', 'eyebrow' )
					. vsb_h( 'Hilos Rojos', 1 )
					. vsb_p( 'La última edición se celebró del 1 al 3 de mayo de 2026.', 'lead' ),
					'stars'
				)
				. vsb_p( 'Los hilos rojos son los lazos invisibles entre personas, culturas e historias. En el festival no hay competición ni perdedores: los grupos muestran su trabajo, ven el de los demás y conversan.', 'lead' )
				. vsb_h( 'Qué hay en el programa' )
				. vsb_list( array( 'Espectáculos', 'Escenas y estudios', 'Lecturas dramatizadas', 'Performances', 'Talleres' ), false, 'starlist' )
				. vsb_section(
					vsb_h( 'La próxima edición' )
					. vsb_p( 'Publicaremos fechas y condiciones aquí y en el Instagram del teatro. ¿Quieres traer tu espectáculo? Escríbenos.' )
					. vsb_vega( 'form-button', array( 'form' => 'none', 'whatsapp' => 'director' ) ),
					'light'
				),
		),

		'donate'     => array(
			'title'   => 'Apoya al teatro',
			'slug'    => 'apoya-al-teatro',
			'excerpt' => 'Donativos voluntarios a la asociación Actorre.',
			'content' =>
				vsb_p( 'El Teatro Vega y los demás proyectos de la asociación Actorre viven de las cuotas de los socios, de las clases y de la ayuda de los amigos. Los donativos se destinan a aquello sin lo que no hay espectáculo:', 'lead' )
				. vsb_list(
					array( 'vestuario y atrezo;', 'decorados e iluminación;', 'alquiler de espacios para espectáculos y festivales.' ),
					false,
					'starlist'
				)
				. vsb_vega( 'donate' )
				. vsb_p( 'El donativo es voluntario y no está relacionado con el pago de las clases. ¡Gracias por estar con nosotros!' ),
		),

		'contacts'   => array(
			'title'   => 'Contacto',
			'slug'    => 'contacto',
			'excerpt' => 'Por WhatsApp respondemos antes.',
			'content' =>
				vsb_vega( 'contacts', array( 'align' => 'wide' ) )
				. vsb_vega( 'form-button', array( 'form' => 'kids', 'whatsapp' => 'enrol' ) ),
		),

		'privacy'    => array(
			'title'   => 'Política de privacidad',
			'slug'    => 'politica-de-privacidad',
			'content' =>
				vsb_p( '<em>Esto es una plantilla. Antes de publicarla, pide a un abogado que revise el texto.</em>' )
				. vsb_h( 'Responsable del tratamiento' )
				. vsb_p( 'Asociación Cultural Centro de Art «Actorre», Calle Santander 10, 03181 Torrevieja, Alicante. Correo: <a href="mailto:actorre.centro@gmail.com">actorre.centro@gmail.com</a>.' )
				. vsb_h( 'Qué datos recogemos' )
				. vsb_list(
					array(
						'Los datos de los formularios de inscripción y de alta como socio (nombre, teléfono, correo, edad del menor). Los formularios funcionan con Google Forms y los datos se guardan en la cuenta de Google de la asociación.',
						'Los mensajes que nos envías por WhatsApp o por correo.',
						'Datos técnicos de las visitas al sitio (estadísticas de Jetpack, sin cookies publicitarias).',
						'El idioma elegido, en una cookie técnica, para abrir el sitio en ese idioma la próxima vez.',
					)
				)
				. vsb_h( 'Para qué' )
				. vsb_p( 'Para inscribirte a ti o a tu hijo en las clases, responder a tus preguntas, gestionar la condición de socio e informarte de los eventos si lo has aceptado.' )
				. vsb_h( 'Mapa y servicios externos' )
				. vsb_p( 'El mapa de Google solo se carga después de pulsar «Mostrar mapa». Los botones de redes sociales son enlaces normales y no envían nada hasta que haces clic.' )
				. vsb_h( 'Tus derechos' )
				. vsb_p( 'Según el Reglamento General de Protección de Datos (RGPD) puedes solicitar el acceso, la rectificación o la supresión de tus datos, limitar su tratamiento y retirar tu consentimiento. Escríbenos al correo de la asociación. También puedes acudir a la Agencia Española de Protección de Datos (aepd.es).' ),
		),
	),
);
