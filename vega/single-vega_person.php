<?php
/**
 * Страница человека: фото, роль, направления, биография, его группы и спектакли.
 *
 * @package Vega
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	$vega_roles = vega_person_roles();
	$vega_role  = vega_meta( 'role' );
	$vega_ids   = array( get_the_ID() );
	if ( function_exists( 'pll_get_post_translations' ) ) {
		$vega_ids = array_map( 'intval', array_values( pll_get_post_translations( get_the_ID() ) ) );
	}

	// Группы и спектакли, где упомянут этот человек (в любой языковой версии).
	$vega_find = function ( $type, $key ) use ( $vega_ids ) {
		$found = array();
		foreach ( get_posts(
			array(
				'post_type'        => $type,
				'posts_per_page'   => 100,
				'suppress_filters' => false,
			)
		) as $item ) {
			foreach ( (array) get_post_meta( $item->ID, '_vega_' . $key, true ) as $row ) {
				if ( isset( $row['id'] ) && in_array( (int) $row['id'], $vega_ids, true ) ) {
					$found[] = array(
						'post' => $item,
						'note' => isset( $row['note'] ) ? $row['note'] : '',
					);
					break;
				}
			}
		}
		return $found;
	};
	$vega_groups = $vega_find( 'vega_group', 'teachers' );
	$vega_shows  = $vega_find( 'vega_show', 'cast' );
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'page-article person-single' ); ?>>
		<header class="detail-hero">
			<div class="detail-hero__inner">
				<figure class="detail-hero__media detail-hero__media--portrait">
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'vega-portrait', array( 'loading' => 'eager' ) );
					} else {
						echo '<span class="card__placeholder card__placeholder--person"><span class="card__initials">' . esc_html( vega_initials( get_the_title() ) ) . '</span></span>';
					}
					?>
				</figure>
				<div class="detail-hero__text">
					<?php echo vega_eyebrow( isset( $vega_roles[ $vega_role ] ) ? $vega_roles[ $vega_role ] : '' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<h1 class="detail-hero__title"><?php the_title(); ?></h1>
					<?php if ( vega_meta( 'directions' ) ) : ?>
						<p class="detail-hero__lead"><?php echo esc_html( vega_meta( 'directions' ) ); ?></p>
					<?php endif; ?>
					<?php if ( $vega_groups ) : ?>
						<p class="detail-hero__groups"><span class="eyebrow"><?php esc_html_e( 'Groups', 'vega' ); ?></span>
							<?php
							$vega_links = array();
							foreach ( $vega_groups as $vega_g ) {
								$vega_links[] = '<a href="' . esc_url( get_permalink( $vega_g['post'] ) ) . '">' . esc_html( get_the_title( $vega_g['post'] ) ) . '</a>' . ( $vega_g['note'] ? ' <span class="muted">(' . esc_html( $vega_g['note'] ) . ')</span>' : '' );
							}
							echo implode( ', ', $vega_links ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							?>
						</p>
					<?php endif; ?>
				</div>
			</div>
		</header>

		<div class="entry-content">
			<?php the_content(); ?>

			<?php if ( $vega_shows ) : ?>
				<h2><?php esc_html_e( 'Performances', 'vega' ); ?></h2>
				<div class="card-grid card-grid--4 alignwide">
					<?php
					foreach ( $vega_shows as $vega_s ) {
						echo vega_show_card( $vega_s['post'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					}
					?>
				</div>
			<?php endif; ?>
		</div>
	</article>
	<?php
endwhile;

get_footer();
