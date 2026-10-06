<?php
/**
 * Страница группы: возраст, расписание, педагоги, цены, запись.
 *
 * @package Vega
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	$vega_id        = get_the_ID();
	$vega_age       = vega_age_label( vega_meta( 'age_min' ), vega_meta( 'age_max' ) );
	$vega_schedule  = vega_get_schedule( $vega_id );
	$vega_teachers  = vega_get_linked_people( $vega_id, 'teachers' );
	$vega_prices    = vega_group_price_lines( $vega_id );
	$vega_form      = vega_meta( 'form' ) ? vega_meta( 'form' ) : 'kids';
	$vega_audience  = vega_meta( 'audience' );
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'page-article group-single' ); ?>>
		<header class="detail-hero detail-hero--group">
			<div class="detail-hero__inner">
				<div class="detail-hero__text">
					<div class="card__top">
						<?php echo vega_eyebrow( $vega_age ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<?php if ( vega_meta( 'recruiting' ) ) : ?>
							<span class="badge"><?php esc_html_e( 'Now enrolling', 'vega' ); ?></span>
						<?php endif; ?>
					</div>
					<h1 class="detail-hero__title"><?php the_title(); ?></h1>
					<?php if ( vega_meta( 'direction' ) ) : ?>
						<p class="detail-hero__lead"><?php echo esc_html( vega_meta( 'direction' ) ); ?></p>
					<?php endif; ?>
					<?php echo vega_form_buttons( 'none' === $vega_form ? 'none' : $vega_form, 'enrol' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>
				<figure class="detail-hero__media">
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'vega-card', array( 'loading' => 'eager' ) );
					} else {
						echo '<span class="card__placeholder card__placeholder--big">' . vega_constellation_svg( get_the_title(), 7 ) . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					}
					?>
				</figure>
			</div>
		</header>

		<div class="entry-content">
			<div class="info-grid alignwide">
				<section class="card card--flat info-card">
					<h2 class="info-card__title"><?php echo vega_icon( 'clock' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php esc_html_e( 'Classes', 'vega' ); ?></h2>
					<?php if ( $vega_schedule ) : ?>
						<ul class="info-card__list">
							<?php foreach ( $vega_schedule as $vega_row ) : ?>
								<li><span><?php echo esc_html( vega_weekday( $vega_row['day'] ) ); ?></span><strong><?php echo esc_html( vega_time_range( $vega_row ) ); ?></strong></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
					<?php if ( vega_meta( 'schedule_note' ) ) : ?>
						<p class="info-card__note"><?php echo esc_html( vega_meta( 'schedule_note' ) ); ?></p>
					<?php endif; ?>
				</section>

				<?php if ( $vega_prices || vega_meta( 'price_note' ) ) : ?>
					<section class="card card--flat info-card">
						<h2 class="info-card__title"><?php echo vega_icon( 'card' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php esc_html_e( 'Price', 'vega' ); ?></h2>
						<ul class="info-card__list info-card__list--plain">
							<?php foreach ( $vega_prices as $vega_line ) : ?>
								<li><?php echo esc_html( $vega_line ); ?></li>
							<?php endforeach; ?>
						</ul>
						<?php if ( vega_meta( 'price_note' ) ) : ?>
							<p class="info-card__note"><?php echo esc_html( vega_meta( 'price_note' ) ); ?></p>
						<?php endif; ?>
						<?php if ( 'kids' === $vega_audience ) : ?>
							<p class="info-card__note"><?php esc_html_e( 'The first trial class is free.', 'vega' ); ?></p>
						<?php endif; ?>
					</section>
				<?php endif; ?>
			</div>

			<?php the_content(); ?>

			<?php if ( $vega_teachers ) : ?>
				<h2><?php esc_html_e( 'Teachers', 'vega' ); ?></h2>
				<div class="card-grid card-grid--people alignwide">
					<?php
					foreach ( $vega_teachers as $vega_t ) {
						echo vega_person_card( $vega_t['post'], $vega_t['note'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					}
					?>
				</div>
			<?php endif; ?>
		</div>

		<section class="section section--light">
			<div class="section__inner">
				<h2><?php esc_html_e( 'Other groups', 'vega' ); ?></h2>
				<?php echo vega_render_groups( array( 'audience' => $vega_audience ? $vega_audience : 'all', 'exclude' => $vega_id ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>
		</section>
	</article>
	<?php
endwhile;

get_footer();
