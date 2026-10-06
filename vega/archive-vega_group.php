<?php
/**
 * Все группы (/groups/).
 *
 * @package Vega
 */

defined( 'ABSPATH' ) || exit;

get_header();
get_template_part( 'template-parts/page-header', null, array( 'title' => __( 'Groups', 'vega' ) ) );
?>
<div class="entry-content">
	<h2><?php esc_html_e( 'Kids studio', 'vega' ); ?></h2>
	<?php echo vega_render_groups( array( 'audience' => 'kids' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<h2><?php esc_html_e( 'For adults', 'vega' ); ?></h2>
	<?php echo vega_render_groups( array( 'audience' => 'adults' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</div>
<section class="section section--light">
	<div class="section__inner">
		<h2><?php esc_html_e( 'Timetable', 'vega' ); ?></h2>
		<?php echo vega_render_schedule( array( 'audience' => 'all' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</div>
</section>
<?php
get_footer();
