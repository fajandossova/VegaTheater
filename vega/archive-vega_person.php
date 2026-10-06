<?php
/**
 * Все действующие люди театра (/people/): педагоги, артисты, гости.
 *
 * @package Vega
 */

defined( 'ABSPATH' ) || exit;

get_header();
get_template_part( 'template-parts/page-header', null, array( 'title' => __( 'People of the theatre', 'vega' ) ) );
?>
<div class="entry-content">
	<?php
	$vega_titles = array(
		'teacher' => __( 'Teachers', 'vega' ),
		'artist'  => __( 'Artists', 'vega' ),
		'guest'   => __( 'Guests', 'vega' ),
	);
	foreach ( $vega_titles as $vega_role => $vega_title ) {
		if ( ! vega_get_people( $vega_role, true, 1 ) ) {
			continue;
		}
		echo '<h2>' . esc_html( $vega_title ) . '</h2>';
		echo vega_render_people( array( 'role' => $vega_role ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
	?>
</div>
<?php
get_footer();
