<?php
/**
 * Запасной шаблон: новости, архивы, поиск.
 *
 * @package Vega
 */

defined( 'ABSPATH' ) || exit;

get_header();

if ( is_search() ) {
	/* translators: %s: search query. */
	$vega_title = sprintf( __( 'Search: %s', 'vega' ), get_search_query() );
} elseif ( is_home() && ! is_front_page() ) {
	$vega_title = single_post_title( '', false );
} elseif ( is_archive() ) {
	$vega_title = wp_strip_all_tags( get_the_archive_title() );
} else {
	$vega_title = __( 'News', 'vega' );
}

get_template_part( 'template-parts/page-header', null, array( 'title' => $vega_title ) );
?>
<div class="entry-content">
	<?php if ( have_posts() ) : ?>
		<div class="card-grid card-grid--3 alignwide">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/card-post' );
			endwhile;
			?>
		</div>
		<?php
		the_posts_pagination(
			array(
				'prev_text' => __( 'Previous', 'vega' ),
				'next_text' => __( 'Next', 'vega' ),
			)
		);
		?>
	<?php else : ?>
		<p class="empty-note"><?php esc_html_e( 'Nothing found.', 'vega' ); ?></p>
		<?php get_search_form(); ?>
	<?php endif; ?>
</div>
<?php
get_footer();
