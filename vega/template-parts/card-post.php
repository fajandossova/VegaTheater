<?php
/**
 * Карточка записи в списке (новости, поиск).
 *
 * @package Vega
 */

defined( 'ABSPATH' ) || exit;
?>
<article <?php post_class( 'card' ); ?>>
	<a class="card__media" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
		<?php
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'vega-card', array( 'alt' => '' ) );
		} else {
			echo '<span class="card__placeholder">' . vega_constellation_svg( get_the_title() ) . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		?>
	</a>
	<div class="card__body">
		<?php if ( 'post' === get_post_type() ) : ?>
			<p class="eyebrow"><?php echo esc_html( vega_format_date( get_the_date( 'Y-m-d' ) ) ); ?></p>
		<?php endif; ?>
		<h2 class="card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<p class="card__text"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 24 ) ); ?></p>
	</div>
</article>
