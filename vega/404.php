<?php
/**
 * Страница не найдена.
 *
 * @package Vega
 */

defined( 'ABSPATH' ) || exit;

get_header();
get_template_part(
	'template-parts/page-header',
	null,
	array(
		'eyebrow' => '404',
		'title'   => __( 'This star has drifted away', 'vega' ),
		'lead'    => __( 'The page was not found. It may have moved — try the menu or the links below.', 'vega' ),
	)
);
?>
<div class="entry-content">
	<div class="btn-row">
		<?php
		// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
		echo vega_button( function_exists( 'pll_home_url' ) ? pll_home_url() : home_url( '/' ), __( 'Home page', 'vega' ), 'primary' );
		echo vega_button( vega_page_url( 'events' ), __( 'What’s on', 'vega' ), 'ghost' );
		echo vega_button( vega_page_url( 'kids' ), __( 'Kids studio', 'vega' ), 'ghost' );
		// phpcs:enable
		?>
	</div>
	<?php get_search_form(); ?>
</div>
<?php
get_footer();
