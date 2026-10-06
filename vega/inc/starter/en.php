<?php
/**
 * Стартовое содержимое: английский язык.
 *
 * @package Vega
 */

defined( 'ABSPATH' ) || exit;

$hero_image = VEGA_URI . '/assets/img/hero-lyra.svg';

return array(
	'menu'             => array(
		'kids'       => 'Kids studio',
		'adults'     => 'Adults',
		'events'     => 'What’s on',
		'teachers'   => 'Teachers',
		'about'      => 'About',
		'actorre'    => 'Actorre',
		'shkhuna'    => 'Shkhuna',
		'donate'     => 'Support us',
		'festivals'  => 'Festivals',
		'fest_sky'   => 'Under the Sky of Spain',
		'fest_hilos' => 'Hilos Rojos',
		'contacts'   => 'Contact',
		'privacy'    => 'Privacy policy',
	),

	'show_placeholder' => 'Description coming soon. The story, photos and cast will appear here.',

	'people'           => array(
		'fatima'   => array(
			'name'       => 'Fatima Jandossova',
			'directions' => 'Artistic director, acting, stage direction',
			'bio'        => 'Founder and artistic director of Teatro Vega. Biography: text coming soon.',
		),
		'nadezhda' => array(
			'name'       => 'Nadezhda Makarchuk',
			'directions' => 'Choreography (hip-hop, K-pop, show dance), acting, stage speech',
			'bio'        => 'Biography: text coming soon.',
		),
		'dasha'    => array(
			'name'       => 'Dasha Nechiporenko',
			'directions' => 'Choreography, contemporary dance, costumes',
			'bio'        => 'Biography: text coming soon.',
		),
		'nikolai'  => array(
			'name'       => 'Nikolai Barabanov',
			'directions' => 'Stage speech, stage combat, English theatre',
			'bio'        => 'Biography: text coming soon.',
		),
		'pamela'   => array(
			'name'       => 'Pamela Kirillova',
			'directions' => 'Singing, choir',
			'bio'        => 'Biography: text coming soon.',
		),
	),

	'groups'           => array(
		'milkyway'     => array(
			'title'         => 'Milky Way',
			'direction'     => 'Drama games, movement, music',
			'excerpt'       => 'Our youngest: playing at theatre, moving to music and losing the fear of an audience.',
			'content'       => vsb_p( 'The youngest group in the studio. Everything here is a game: children turn into animals and fairy-tale heroes, move to music, learn to speak up and look at the audience. A class lasts one hour — just as long as a little one can stay focused without getting tired.' )
				. vsb_p( 'Come twice a week or on Sundays only — whatever suits your family.' ),
			'price_note'    => 'two classes a week; €40 a month for Sundays only',
			'teacher_notes' => array( '' ),
		),
		'orion'        => array(
			'title'         => 'Orion',
			'direction'     => 'Acting, singing, stage speech, stage combat',
			'excerpt'       => 'The first “real” theatre group: scenes, roles and first performances.',
			'content'       => vsb_p( 'In Orion children get their first role. We work out who the character is and what they want, learn to work with a partner, sing, speak clearly and “fight” on stage safely, following the rules of stage combat.' )
				. vsb_p( 'Four teachers work with the group, each in their own field. Two 90-minute classes a week.' ),
			'price_note'    => 'two 90-minute classes a week',
			'teacher_notes' => array( 'acting', 'singing', 'stage speech, stage combat', 'voice, object theatre' ),
		),
		'lyra'         => array(
			'title'         => 'Lyra',
			'direction'     => 'Acting, stage speech, singing, choreography',
			'excerpt'       => 'The senior acting group: full-length plays and more demanding roles.',
			'content'       => vsb_p( 'Lyra is the constellation where our Vega shines. A group for 10–12-year-olds who want to act for real: they rehearse full-length plays, try leading and character roles, and learn to hold the stage and the audience.' )
				. vsb_p( 'Two 90-minute classes a week with four teachers.' ),
			'price_note'    => 'two 90-minute classes a week',
			'teacher_notes' => array( 'stage speech', 'acting', 'singing', 'choreography' ),
		),
		'hiphop'       => array(
			'title'         => 'Hip-Hop',
			'direction'     => 'Hip-hop, K-pop, show dance',
			'excerpt'       => 'A high-energy dance group: rhythm, choreography and numbers for the stage.',
			'content'       => vsb_p( 'For kids who can’t sit still. We learn moves and full routines in hip-hop and K-pop style and build rhythm, coordination and stamina. Finished dances are performed at the studio’s concerts and shows.' ),
			'price_note'    => 'two one-hour classes a week',
			'teacher_notes' => array( '' ),
		),
		'contemporary' => array(
			'title'         => 'Contemporary',
			'direction'     => 'Contemporary dance',
			'excerpt'       => 'Contemporary dance: body awareness, improvisation, music.',
			'content'       => vsb_p( 'Contemporary dance teaches children to feel their body and the music. Lots of improvisation and work with space: children don’t just copy moves, they invent their own. A great match for acting classes.' ),
			'price_note'    => 'two one-hour classes a week',
			'teacher_notes' => array( '' ),
		),
		'bas'          => array(
			'title'         => 'Quick Acting Start',
			'direction'     => 'Original training: body, voice, improvisation',
			'excerpt'       => 'A course for adults trying theatre from scratch.',
			'content'       => vsb_p( 'Quick Acting Start (BAS) is Fatima Jandossova’s own training course for people who have always wanted to try theatre but didn’t know where to begin. No experience needed.' )
				. vsb_p( 'We work with body, voice and improvisation: moving freely, speaking so that people listen, reacting in the moment. Many come “just for themselves” and then notice that speaking in public at work has become easier.' ),
			'schedule_note' => 'next course dates: ask us on WhatsApp',
			'price_note'    => '',
			'teacher_notes' => array( '' ),
		),
		'coralola'     => array(
			'title'         => 'Coral OLA',
			'direction'     => 'Adult choir, songs in Spanish',
			'excerpt'       => 'A choir for adults aged 17 and over. No sheet music needed.',
			'content'       => vsb_p( 'A choir for adults aged 17 and over, led by Pamela Kirillova. We sing in Spanish, and you don’t need to read music: parts are learned by ear.' )
				. vsb_p( 'Fridays 11:30–13:00. €30 a month.' ),
			'price_note'    => '',
			'teacher_notes' => array( '' ),
		),
	),

	'shows'            => array(
		'prince'    => 'The Little Prince',
		'buratino'  => 'The Adventures of Buratino',
		'encanto'   => 'Encanto',
		'rabbit'    => 'The Moon Rabbit',
		'alice'     => 'Alice Through the Looking-Glass',
		'snowqueen' => 'The Snow Queen',
	),

	'events'           => array(
		'festival2026' => array(
			'title'   => 'Festival “Under the Sky of Spain”',
			'place'   => 'Alannia Guardamar, Guardamar del Segura',
			'excerpt' => 'Three days of singer-songwriter music by the sea: concerts, a contest, workshops.',
			'content' => vsb_p( 'A singer-songwriter festival at Alannia Guardamar campsite. Guest concerts, a performers’ contest, workshops, the quiz game “What? Where? When?” with Boris Burda, an evening of Alexander Galich songs, “guitar in a circle” and the BARDbecue party.' )
				. vsb_buttons( array( array( 'Programme and registration', '{{url:fest_sky}}' ) ) ),
		),
		'gopenko'      => array(
			'title'   => 'Ekaterina Gopenko in concert',
			'place'   => 'Calle Santander 10, Torrevieja',
			'excerpt' => 'A concert in the theatre’s art space.',
			'content' => vsb_p( 'Ekaterina Gopenko in concert at the Teatro Vega art space. Programme details coming soon.' ),
		),
	),

	'pages'            => array(
		'home'       => array(
			'title'   => 'Home',
			'slug'    => 'home',
			'content' =>
				vsb_section(
					vsb_columns(
						array(
							vsb_p( 'Theatre studio · Torrevieja · since 2019', 'eyebrow' )
							. vsb_h( 'We create stars and constellations', 1 )
							. vsb_p( 'Vega is a theatre studio for children and adults. Here you learn to speak so that people listen, to move freely and to stop being afraid of the stage. And at the end of the season, you go out in front of a real audience — with costumes, lights and applause.', 'lead' )
							. vsb_vega( 'form-button', array( 'form' => 'kids', 'whatsapp' => 'enrol' ) )
							. vsb_p( 'The first class is free.' ),
							vsb_image( $hero_image, 'The Lyra constellation with the bright star Vega', 'portrait' ),
						)
					),
					'stars'
				)
				. vsb_section(
					vsb_columns(
						array(
							vsb_h( 'Who we are' )
							. vsb_p( 'We are a team of working performers who teach: actors, choreographers and singers. We have our own art space at Calle Santander 10 in Torrevieja. Families from many countries come to the studio, and on stage that only helps: theatre teaches you to listen to your partner, and children quickly find common ground.' ),
							vsb_list(
								array(
									'<strong>Courage.</strong> Standing up in front of people and having your say stops being scary.',
									'<strong>Voice and speech.</strong> Speaking loudly, clearly and with feeling.',
									'<strong>Body.</strong> Coordination, movement, a sense of rhythm.',
									'<strong>Team.</strong> Nobody acts alone in theatre.',
								),
								false,
								'starlist'
							),
						)
					)
				)
				. vsb_section(
					vsb_p( 'Season 2026/27 · now enrolling', 'eyebrow' )
					. vsb_h( 'Kids studio groups' )
					. vsb_p( 'Our groups are named after constellations and galaxies. Choose by age — and if you’re not sure, come to a free trial class: the teacher will see your child and advise you.' )
					. vsb_vega( 'groups', array( 'audience' => 'kids', 'align' => 'wide' ) )
					. vsb_buttons( array( array( 'Timetable and prices', '{{url:kids}}', 'outline' ) ) )
				)
				. vsb_section(
					vsb_p( 'What’s on', 'eyebrow' )
					. vsb_h( 'Upcoming events' )
					. vsb_vega( 'events', array( 'limit' => 4, 'moreLink' => true, 'align' => 'wide' ) ),
					'light'
				)
				. vsb_section(
					vsb_p( 'Team', 'eyebrow' )
					. vsb_h( 'Teachers' )
					. vsb_p( 'The people who teach every week and stage the shows together with the children.' )
					. vsb_vega( 'people', array( 'role' => 'teacher', 'align' => 'wide' ) )
				)
				. vsb_section(
					vsb_h( 'Around the theatre' )
					. vsb_columns(
						array(
							vsb_section(
								vsb_vega( 'logo', array( 'which' => 'actorre' ) )
								. vsb_p( 'The cultural association behind Teatro Vega, the Shkhuna club, the Coral OLA choir and our festivals. Members pay less for classes and events.' )
								. vsb_buttons( array( array( 'About the association', '{{url:actorre}}', 'outline' ) ) ),
								'card',
								''
							),
							vsb_section(
								vsb_vega( 'logo', array( 'which' => 'shkhuna' ) )
								. vsb_p( 'A singer-songwriter club. Almost every Sunday: guests, songs and “guitar in a circle”, where anyone can sing.' )
								. vsb_buttons( array( array( 'About the club', '{{url:shkhuna}}', 'outline' ) ) ),
								'card',
								''
							),
							vsb_section(
								vsb_h( 'Festivals', 3 )
								. vsb_p( '“Under the Sky of Spain” is a singer-songwriter festival in October. Hilos Rojos is an international amateur theatre festival in spring.' )
								. vsb_buttons(
									array(
										array( 'Under the Sky of Spain', '{{url:fest_sky}}', 'outline' ),
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
					vsb_h( 'Support the theatre' )
					. vsb_p( 'Costumes, sets, lighting, venue hire for performances — it all costs money. Every donation to the Actorre association helps children get on stage.' )
					. vsb_buttons( array( array( 'How to help', '{{url:donate}}' ) ) ),
					'band'
				)
				. vsb_section(
					vsb_h( 'The first class is free' )
					. vsb_p( 'Come along with your child, see how we work and decide calmly. Sign up with the form or on WhatsApp.' )
					. vsb_vega( 'form-button', array( 'form' => 'kids', 'whatsapp' => 'enrol' ) ),
					'stars'
				),
		),

		'kids'       => array(
			'title'   => 'Kids studio',
			'slug'    => 'kids-studio',
			'excerpt' => 'Groups for children aged 4 to 14: acting, dance, singing and speech. The first class is free.',
			'content' =>
				vsb_p( 'Every group mixes acting, movement, voice and speech in the right proportions for its age. The little ones play more; the older ones rehearse real plays. During the season the groups perform for an audience.', 'lead' )
				. vsb_h( 'Groups' )
				. vsb_vega( 'groups', array( 'audience' => 'kids', 'align' => 'wide' ) )
				. vsb_section(
					vsb_h( 'Timetable' )
					. vsb_vega( 'schedule', array( 'audience' => 'kids', 'align' => 'wide' ) )
					. vsb_h( 'Prices' )
					. vsb_vega( 'prices', array( 'audience' => 'kids' ) )
					. vsb_list(
						array(
							'<strong>The first trial class is free.</strong>',
							'Acting groups Orion and Lyra: €80 a month for Actorre members, €100 without membership. Two 90-minute classes a week.',
							'Dance groups Hip-Hop and Contemporary: €50 a month for members, €70 without membership. Two one-hour classes a week.',
							'Milky Way: €70 a month for two classes a week, or €40 for Sundays only.',
							'Membership of the Actorre association is €10 a year, paid separately.',
						)
					),
					'light'
				)
				. vsb_h( 'How to sign up' )
				. vsb_list(
					array(
						'Fill in the short form or message us on WhatsApp.',
						'We’ll suggest a day and time for a free trial class.',
						'After the class the teacher tells you how it went, and you decide calmly whether to stay.',
					),
					true
				)
				. vsb_vega( 'form-button', array( 'form' => 'kids', 'whatsapp' => 'enrol' ) ),
		),

		'adults'     => array(
			'title'   => 'Adults',
			'slug'    => 'adults',
			'excerpt' => 'An acting course for complete beginners and a choir where you don’t need to read music.',
			'content' =>
				vsb_p( 'Theatre isn’t just for children. For adults and teenagers we have two programmes: an acting course for first-timers and a choir.', 'lead' )
				. vsb_vega( 'groups', array( 'audience' => 'adults', 'align' => 'wide' ) )
				. vsb_h( 'Quick Acting Start (BAS)' )
				. vsb_p( 'Fatima Jandossova’s own course for people who have always wanted to try theatre but didn’t know where to begin. No experience needed. Body, voice, improvisation — after a few sessions you’ll notice that speaking in public feels easier.' )
				. vsb_h( 'Coral OLA choir' )
				. vsb_p( 'A choir for adults aged 17 and over, led by Pamela Kirillova. We sing in Spanish, and you don’t need to read music: parts are learned by ear. Fridays 11:30–13:00, €30 a month.' )
				. vsb_vega( 'form-button', array( 'form' => 'adults', 'whatsapp' => 'enrol' ) ),
		),

		'events'     => array(
			'title'   => 'What’s on and tickets',
			'slug'    => 'whats-on',
			'excerpt' => 'Performances, concerts, festivals and Shkhuna club evenings.',
			'content' =>
				vsb_p( 'Tickets are sold online. Actorre members get reduced prices for many events.', 'lead' )
				. vsb_vega( 'events', array( 'limit' => 30, 'align' => 'wide' ) )
				. vsb_vega( 'tickets' )
				. vsb_section(
					vsb_h( 'Archive' )
					. vsb_p( 'What has already happened, by year.' )
					. vsb_vega( 'events-archive' ),
					'light'
				),
		),

		'teachers'   => array(
			'title'   => 'Teachers',
			'slug'    => 'teachers',
			'excerpt' => 'Each teaches their own subject, and the whole team works on the shows together.',
			'content' => vsb_vega( 'people', array( 'role' => 'teacher', 'align' => 'wide' ) ),
		),

		'about'      => array(
			'title'   => 'About the theatre',
			'slug'    => 'about',
			'excerpt' => 'A theatre studio in Torrevieja since 2019.',
			'content' =>
				vsb_p( 'Vega studio has been working in Torrevieja since 2019. Today that means five children’s groups, programmes for adults, our own art space at Calle Santander 10, a singer-songwriter club and two festivals. The theatre is a project of the Actorre cultural association.', 'lead' )
				. vsb_h( 'Why “Vega”?' )
				. vsb_p( 'Vega is one of the brightest stars in the night sky and the main star of the Lyra constellation. That’s why our groups are named after constellations and galaxies: Milky Way, Orion, Lyra.' )
				. vsb_h( 'What we believe' )
				. vsb_list(
					array(
						'<strong>Everyone can go on stage.</strong> Not necessarily in the lead role in the first year — but always with a role of their own.',
						'<strong>Trust first, technique second.</strong> A frightened child doesn’t act. So we never push anyone onto the stage.',
						'<strong>Theatre is a team.</strong> We learn to listen to our partners and support each other.',
						'<strong>The result is a show for a real audience.</strong> With costumes, lights and curtain calls.',
						'<strong>Many countries, one stage.</strong> Families from different countries come to the studio, and that makes us richer.',
					),
					false,
					'starlist'
				)
				. vsb_section(
					vsb_h( 'Questions and answers' )
					. vsb_faq( 'My child is shy. Is this for them?', 'Yes. We work with shy children all the time. First come games and exercises in a circle; a role comes when the child feels ready.' )
					. vsb_faq( 'Is experience or an audition needed?', 'No. All groups are open without auditions. Just come to a free trial class.' )
					. vsb_faq( 'Can we join mid-season?', 'Yes, if there’s a place in the group. Message us on WhatsApp and we’ll advise you.' )
					. vsb_faq( 'How much does it cost?', 'Prices are on the <a href="{{url:kids}}">Kids studio</a> page. The first class is free. Actorre membership is €10 a year and lowers the price of classes.' )
					. vsb_faq( 'What should we bring?', 'Comfortable clothes to move in, indoor shoes or socks, and a bottle of water.' )
					. vsb_faq( 'Where are the classes?', 'At the theatre’s art space: Calle Santander 10, Torrevieja. Directions are on the <a href="{{url:contacts}}">Contact</a> page.' ),
					'light'
				)
				. vsb_h( 'Repertoire' )
				. vsb_vega( 'shows', array( 'align' => 'wide' ) ),
		),

		'actorre'    => array(
			'title'   => 'Actorre',
			'slug'    => 'actorre-association',
			'excerpt' => 'The cultural association behind Teatro Vega, the Shkhuna club, the Coral OLA choir and our festivals.',
			'content' =>
				vsb_vega( 'logo', array( 'which' => 'actorre' ) )
				. vsb_p( 'Asociación Cultural Centro de Art «Actorre» is a non-profit cultural association in Torrevieja. Founded in 2023 and registered in 2025. President: Fatima Jandossova.', 'lead' )
				. vsb_h( 'Association projects' )
				. vsb_list(
					array(
						'<a href="{{url:home}}">Teatro Vega</a>: kids studio and programmes for adults.',
						'<a href="{{url:shkhuna}}">Shkhuna singer-songwriter club</a>.',
						'Coral OLA adult choir.',
						'The <a href="{{url:fest_sky}}">“Under the Sky of Spain”</a> and <a href="{{url:fest_hilos}}">Hilos Rojos</a> festivals.',
					),
					false,
					'starlist'
				)
				. vsb_section(
					vsb_h( 'Membership' )
					. vsb_p( 'Membership is €10 a year. Members get reduced prices for classes and events: for example, an acting group costs €80 a month instead of €100, and a Shkhuna evening €5 instead of €7.' )
					. vsb_h( 'How to join', 3 )
					. vsb_p( 'Fill in the form: there is one for adults and one for parents of participants under 18.' )
					. vsb_vega( 'form-button', array( 'form' => 'actorre_adult', 'whatsapp' => 'none' ) )
					. vsb_vega( 'form-button', array( 'form' => 'actorre_parent', 'whatsapp' => 'none' ) ),
					'light'
				)
				. vsb_p( 'Association email: <a href="mailto:actorre.centro@gmail.com">actorre.centro@gmail.com</a>' ),
		),

		'shkhuna'    => array(
			'title'   => 'Shkhuna',
			'slug'    => 'shkhuna-club',
			'excerpt' => 'A singer-songwriter club in Torrevieja. Meetings almost every Sunday.',
			'content' =>
				vsb_vega( 'logo', array( 'which' => 'shkhuna' ) )
				. vsb_p( 'The Shkhuna (“Schooner”) singer-songwriter club meets almost every Sunday at the theatre’s art space, Calle Santander 10.', 'lead' )
				. vsb_h( 'What an evening is like' )
				. vsb_p( 'First we listen to the guests and to each other. Then comes “guitar in a circle”: anyone can sing or read something of their own. You can also come just to listen — that’s how many people started.' )
				. vsb_h( 'Entry' )
				. vsb_list(
					array(
						'€7',
						'€5 for members of the <a href="{{url:actorre}}">Actorre</a> association',
					)
				)
				. vsb_section(
					vsb_h( 'Upcoming meetings' )
					. vsb_vega( 'events', array( 'section' => 'shkhuna', 'limit' => 6 ) ),
					'light'
				)
				. vsb_h( 'Follow us' )
				. vsb_vega( 'socials', array( 'set' => 'shkhuna' ) ),
		),

		'fest_sky'   => array(
			'title'   => 'Festival “Under the Sky of Spain”',
			'slug'    => 'under-the-sky-of-spain',
			'excerpt' => 'A singer-songwriter festival. 16–18 October 2026, Alannia Guardamar.',
			'content' =>
				vsb_section(
					vsb_p( 'Singer-songwriter festival · 2026', 'eyebrow' )
					. vsb_h( 'Under the Sky of Spain', 1 )
					. vsb_p( '16–18 October 2026 · Alannia Guardamar campsite, Guardamar del Segura, near Torrevieja', 'lead' )
					. vsb_vega( 'form-button', array( 'form' => 'festival', 'whatsapp' => 'director' ) ),
					'stars'
				)
				. vsb_p( 'Three days of songs by the sea under the open sky. Organised by Teatro Vega.', 'lead' )
				. vsb_h( 'Guests' )
				. vsb_list(
					array( 'Boris Burda', 'Vladimir Mishin', 'Ekaterina Gopenko', 'Philippe Bovier', 'Alexandra Yershova' ),
					false,
					'starlist'
				)
				. vsb_h( 'Programme' )
				. vsb_list(
					array(
						'Guest concerts',
						'Performers’ contest',
						'Workshops',
						'The quiz game “What? Where? When?” with Boris Burda',
						'An evening of Alexander Galich songs',
						'“Guitar in a circle”',
						'BARDbecue party',
					)
				)
				. vsb_section(
					vsb_h( 'Registration' )
					. vsb_p( 'Participants and guests register using the form. Questions — on WhatsApp.' )
					. vsb_vega( 'form-button', array( 'form' => 'festival', 'whatsapp' => 'director' ) ),
					'light'
				),
		),

		'fest_hilos' => array(
			'title'   => 'Hilos Rojos festival',
			'slug'    => 'hilos-rojos-festival',
			'excerpt' => 'International amateur theatre festival in Torrevieja.',
			'content' =>
				vsb_section(
					vsb_p( 'International amateur theatre festival · Torrevieja', 'eyebrow' )
					. vsb_h( 'Hilos Rojos', 1 )
					. vsb_p( '“Red Threads”. The latest festival took place on 1–3 May 2026.', 'lead' ),
					'stars'
				)
				. vsb_p( 'Red threads are the invisible ties between people, cultures and stories. There is no competition and nobody loses: theatre groups show their work, watch each other’s and talk.', 'lead' )
				. vsb_h( 'What’s in the programme' )
				. vsb_list( array( 'Performances', 'Études and scenes', 'Play readings', 'Performance art', 'Workshops' ), false, 'starlist' )
				. vsb_section(
					vsb_h( 'The next festival' )
					. vsb_p( 'Dates and conditions will be published here and on the theatre’s Instagram. Want to bring your show? Write to us.' )
					. vsb_vega( 'form-button', array( 'form' => 'none', 'whatsapp' => 'director' ) ),
					'light'
				),
		),

		'donate'     => array(
			'title'   => 'Support the theatre',
			'slug'    => 'support-the-theatre',
			'excerpt' => 'Voluntary donations to the Actorre association.',
			'content' =>
				vsb_p( 'Teatro Vega and the other projects of the Actorre association live on membership fees, class fees and help from friends. Donations go to the things no show can do without:', 'lead' )
				. vsb_list(
					array( 'costumes and props;', 'sets and lighting;', 'venue hire for performances and festivals.' ),
					false,
					'starlist'
				)
				. vsb_vega( 'donate' )
				. vsb_p( 'Donations are voluntary and have nothing to do with class fees. Thank you for being with us!' ),
		),

		'contacts'   => array(
			'title'   => 'Contact',
			'slug'    => 'contact',
			'excerpt' => 'WhatsApp is the fastest way to reach us.',
			'content' =>
				vsb_vega( 'contacts', array( 'align' => 'wide' ) )
				. vsb_vega( 'form-button', array( 'form' => 'kids', 'whatsapp' => 'enrol' ) ),
		),

		'privacy'    => array(
			'title'   => 'Privacy policy',
			'slug'    => 'privacy-policy-vega',
			'content' =>
				vsb_p( '<em>This is a template. Ask a lawyer to check the text before publishing.</em>' )
				. vsb_h( 'Data controller' )
				. vsb_p( 'Asociación Cultural Centro de Art «Actorre», Calle Santander 10, 03181 Torrevieja, Alicante. Email: <a href="mailto:actorre.centro@gmail.com">actorre.centro@gmail.com</a>.' )
				. vsb_h( 'What data we collect' )
				. vsb_list(
					array(
						'Data from sign-up and membership forms (name, phone, email, child’s age). The forms run on Google Forms and the data is stored in the association’s Google account.',
						'Messages you send us on WhatsApp or by email.',
						'Technical data about site visits (Jetpack statistics, no advertising cookies).',
						'Your chosen language, in a technical cookie, so the site opens in it next time.',
					)
				)
				. vsb_h( 'Why' )
				. vsb_p( 'To enrol you or your child in classes, answer your questions, manage association membership and tell you about events if you have agreed to that.' )
				. vsb_h( 'Map and external services' )
				. vsb_p( 'The Google map only loads after you click “Show map”. Social media buttons are ordinary links and send nothing until you click them.' )
				. vsb_h( 'Your rights' )
				. vsb_p( 'Under the EU General Data Protection Regulation (GDPR) you can ask to access, correct or delete your data, restrict its processing and withdraw your consent. Write to the association’s email. You can also contact the Spanish Data Protection Agency (aepd.es).' ),
		),
	),
);
