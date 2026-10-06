<?php
/**
 * Отдельная запись (новость).
 *
 * @package Vega
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'page-article' ); ?>>
		<?php
		get_template_part(
			'template-parts/page-header',
			null,
			array(
				'eyebrow' => vega_format_date( get_the_date( 'Y-m-d' ) ),
				'image'   => true,
			)
		);
		?>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
	</article>
	<?php
endwhile;

get_footer();
