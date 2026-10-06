<?php
/**
 * Репертуар (/shows/).
 *
 * @package Vega
 */

defined( 'ABSPATH' ) || exit;

get_header();
get_template_part( 'template-parts/page-header', null, array( 'title' => __( 'Repertoire', 'vega' ) ) );
?>
<div class="entry-content">
	<?php echo vega_render_shows( array() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</div>
<?php
get_footer();
