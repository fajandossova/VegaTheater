<?php
/**
 * Страница события: афиша, дата, место, цена, кнопка «Билеты».
 *
 * @package Vega
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	$vega_e = vega_event_data( get_post() );
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'page-article event-single' ); ?>>
		<header class="detail-hero">
			<div class="detail-hero__inner">
				<figure class="detail-hero__media detail-hero__media--poster">
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail(
							'vega-poster',
							array(
								'loading'       => 'eager',
								'fetchpriority' => 'high',
							)
						);
					} else {
						echo '<span class="card__placeholder">' . vega_constellation_svg( get_the_title(), 8 ) . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					}
					?>
				</figure>
				<div class="detail-hero__text">
					<?php echo vega_eyebrow( $vega_e['section'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<h1 class="detail-hero__title"><?php the_title(); ?></h1>
					<?php if ( $vega_e['past'] ) : ?>
						<p class="badge badge--muted"><?php esc_html_e( 'This event has already taken place', 'vega' ); ?></p>
					<?php endif; ?>
					<dl class="facts">
						<?php if ( $vega_e['date'] ) : ?>
							<div><dt><?php esc_html_e( 'Date', 'vega' ); ?></dt><dd>
								<?php
								echo esc_html( vega_format_date_range( $vega_e['date'], $vega_e['end'] ) );
								if ( ! $vega_e['end'] || $vega_e['end'] <= $vega_e['date'] ) {
									echo ', ' . esc_html( mb_strtolower( vega_weekday_of( $vega_e['date'], false ) ) );
								}
								?>
							</dd></div>
						<?php endif; ?>
						<?php if ( $vega_e['time'] ) : ?>
							<div><dt><?php esc_html_e( 'Time', 'vega' ); ?></dt><dd><?php echo esc_html( $vega_e['time'] ); ?></dd></div>
						<?php endif; ?>
						<?php if ( $vega_e['place'] ) : ?>
							<div><dt><?php esc_html_e( 'Place', 'vega' ); ?></dt><dd><?php echo esc_html( $vega_e['place'] ); ?></dd></div>
						<?php endif; ?>
						<?php if ( $vega_e['price'] ) : ?>
							<div><dt><?php esc_html_e( 'Price', 'vega' ); ?></dt><dd><?php echo esc_html( $vega_e['price'] ); ?></dd></div>
						<?php endif; ?>
					</dl>
					<div class="btn-row">
						<?php
						if ( $vega_e['tickets'] && ! $vega_e['past'] ) {
							echo vega_button( $vega_e['tickets'], __( 'Buy tickets', 'vega' ), 'primary', array( 'icon' => 'ticket', 'external' => true ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						}
						$vega_wa = vega_whatsapp_url( 'enrol' );
						if ( $vega_wa ) {
							echo vega_button( $vega_wa, __( 'Ask on WhatsApp', 'vega' ), 'ghost', array( 'icon' => 'whatsapp', 'external' => true ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						}
						?>
					</div>
				</div>
			</div>
		</header>

		<div class="entry-content">
			<?php the_content(); ?>
		</div>

		<?php
		$vega_more = vega_get_events(
			array(
				'limit'   => 3,
				'exclude' => array( get_the_ID() ),
			)
		);
		if ( $vega_more ) :
			?>
			<section class="section section--light">
				<div class="section__inner">
					<h2><?php esc_html_e( 'More events', 'vega' ); ?></h2>
					<div class="event-list">
						<?php
						foreach ( $vega_more as $vega_event ) {
							echo vega_event_row( $vega_event ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						}
						?>
					</div>
					<?php if ( vega_page_url( 'events' ) ) : ?>
						<p class="more-link"><a href="<?php echo esc_url( vega_page_url( 'events' ) ); ?>"><?php esc_html_e( 'All events and tickets', 'vega' ); ?><?php echo vega_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a></p>
					<?php endif; ?>
				</div>
			</section>
		<?php endif; ?>
		<?php echo vega_event_schema( get_post() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</article>
	<?php
endwhile;

get_footer();
