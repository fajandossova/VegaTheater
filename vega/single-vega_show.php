<?php
/**
 * Страница спектакля: афиша, год, описание, галерея, состав.
 *
 * @package Vega
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	$vega_gallery = vega_meta( 'gallery' );
	$vega_cast    = vega_get_linked_people( get_the_ID(), 'cast' );
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'page-article show-single' ); ?>>
		<header class="detail-hero">
			<div class="detail-hero__inner">
				<figure class="detail-hero__media detail-hero__media--poster">
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'vega-poster', array( 'loading' => 'eager' ) );
					} else {
						echo '<span class="card__placeholder">' . vega_constellation_svg( get_the_title(), 8 ) . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					}
					?>
				</figure>
				<div class="detail-hero__text">
					<?php echo vega_eyebrow( vega_meta( 'year' ) ? __( 'Performance', 'vega' ) . ' · ' . vega_meta( 'year' ) : __( 'Performance', 'vega' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<h1 class="detail-hero__title"><?php the_title(); ?></h1>
					<?php if ( has_excerpt() ) : ?>
						<p class="detail-hero__lead"><?php echo esc_html( get_the_excerpt() ); ?></p>
					<?php endif; ?>
				</div>
			</div>
		</header>

		<div class="entry-content">
			<?php the_content(); ?>

			<?php if ( is_array( $vega_gallery ) && $vega_gallery ) : ?>
				<h2><?php esc_html_e( 'Photos', 'vega' ); ?></h2>
				<div class="photo-grid alignwide">
					<?php foreach ( $vega_gallery as $vega_img ) : ?>
						<figure class="photo-grid__item">
							<a href="<?php echo esc_url( wp_get_attachment_image_url( $vega_img, 'large' ) ); ?>">
								<?php echo wp_get_attachment_image( $vega_img, 'vega-card' ); ?>
							</a>
							<?php if ( wp_get_attachment_caption( $vega_img ) ) : ?>
								<figcaption><?php echo esc_html( wp_get_attachment_caption( $vega_img ) ); ?></figcaption>
							<?php endif; ?>
						</figure>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<?php if ( $vega_cast ) : ?>
				<h2><?php esc_html_e( 'Cast', 'vega' ); ?></h2>
				<div class="card-grid card-grid--people alignwide">
					<?php
					foreach ( $vega_cast as $vega_c ) {
						echo vega_person_card( $vega_c['post'], $vega_c['note'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					}
					?>
				</div>
			<?php endif; ?>
		</div>
	</article>
	<?php
endwhile;

get_footer();
