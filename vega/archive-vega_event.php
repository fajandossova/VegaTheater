<?php
/**
 * Список всех предстоящих событий (/events/).
 *
 * @package Vega
 */

defined( 'ABSPATH' ) || exit;

get_header();
get_template_part( 'template-parts/page-header', null, array( 'title' => __( 'What’s on', 'vega' ) ) );
?>
<div class="entry-content">
	<?php echo vega_render_events( array( 'limit' => 50 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</div>
<section class="section section--light">
	<div class="section__inner">
		<h2><?php esc_html_e( 'Archive', 'vega' ); ?></h2>
		<?php echo vega_render_events_archive(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</div>
</section>
<?php
get_footer();
