<?php
/**
 * Заголовок страницы: рубрика, название, вводный текст.
 *
 * Аргументы ($args): title, eyebrow, lead, image (bool — показывать фото записи).
 *
 * @package Vega
 */

defined( 'ABSPATH' ) || exit;

$vega_args = wp_parse_args(
	isset( $args ) ? $args : array(),
	array(
		'title'   => get_the_title(),
		'eyebrow' => '',
		'lead'    => '',
		'image'   => false,
	)
);
?>
<header class="page-header<?php echo $vega_args['image'] && has_post_thumbnail() ? ' page-header--with-image' : ''; ?>">
	<div class="page-header__inner">
		<div class="page-header__text">
			<?php echo vega_eyebrow( $vega_args['eyebrow'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<h1 class="page-header__title"><?php echo esc_html( wp_strip_all_tags( $vega_args['title'] ) ); ?></h1>
			<?php if ( $vega_args['lead'] ) : ?>
				<p class="page-header__lead"><?php echo esc_html( $vega_args['lead'] ); ?></p>
			<?php endif; ?>
		</div>
		<?php if ( $vega_args['image'] && has_post_thumbnail() ) : ?>
			<figure class="page-header__media">
				<?php the_post_thumbnail( 'vega-wide', array( 'loading' => 'eager', 'fetchpriority' => 'high' ) ); ?>
				<?php if ( get_the_post_thumbnail_caption() ) : ?>
					<figcaption><?php the_post_thumbnail_caption(); ?></figcaption>
				<?php endif; ?>
			</figure>
		<?php endif; ?>
	</div>
</header>
