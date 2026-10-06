<?php
/**
 * Страница из секций: только содержимое редактора, без отдельного заголовка.
 *
 * @package Vega
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'page-article page-article--sections' ); ?>>
		<?php if ( ! preg_match( '/<h1[\s>]/', get_the_content() ) ) : ?>
			<h1 class="screen-reader-text"><?php the_title(); ?></h1>
		<?php endif; ?>
		<div class="entry-content entry-content--sections">
			<?php the_content(); ?>
		</div>
	</article>
	<?php
endwhile;

get_footer();
