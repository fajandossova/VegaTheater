<?php
/**
 * Шапка сайта: логотип, меню, переключатель языков, кнопка «Записаться».
 *
 * @package Vega
 */

defined( 'ABSPATH' ) || exit;

$vega_home = function_exists( 'pll_home_url' ) ? pll_home_url() : home_url( '/' );
$vega_cta  = vega_form_url( 'kids' );
if ( ! $vega_cta ) {
	$vega_cta = vega_page_url( 'kids' );
}
$vega_menu_args = array(
	'theme_location' => 'primary',
	'container'      => false,
	'menu_class'     => 'site-nav__menu',
	'depth'          => 2,
	'fallback_cb'    => 'vega_auto_menu',
	'echo'           => true,
);
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#main"><?php esc_html_e( 'Skip to content', 'vega' ); ?></a>

<header class="site-header" data-site-header>
	<div class="site-header__inner">
		<a class="site-brand" href="<?php echo esc_url( $vega_home ); ?>" rel="home">
			<?php echo vega_logo_html( 'vega', 'medium' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<span class="screen-reader-text"><?php esc_html_e( 'Home page', 'vega' ); ?></span>
		</a>

		<nav class="site-nav" id="site-nav" aria-label="<?php esc_attr_e( 'Main menu', 'vega' ); ?>" data-site-nav>
			<?php wp_nav_menu( $vega_menu_args ); ?>
			<?php echo vega_language_switcher( 'lang-switch--panel' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</nav>

		<div class="site-header__actions">
			<?php echo vega_language_switcher( 'lang-switch--header' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<?php if ( $vega_cta ) : ?>
				<a class="btn btn--primary btn--small site-header__cta" href="<?php echo esc_url( $vega_cta ); ?>"<?php echo 0 === strpos( $vega_cta, home_url() ) ? '' : vega_external_attrs(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
					<span><?php esc_html_e( 'Sign up', 'vega' ); ?></span>
					<?php echo 0 === strpos( $vega_cta, home_url() ) ? '' : vega_new_tab_hint(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</a>
			<?php endif; ?>
			<button class="nav-toggle" type="button" aria-expanded="false" aria-controls="site-nav" data-nav-toggle>
				<span class="nav-toggle__open"><?php echo vega_icon( 'menu' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<span class="nav-toggle__close"><?php echo vega_icon( 'close' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<span class="screen-reader-text" data-nav-toggle-label><?php esc_html_e( 'Open menu', 'vega' ); ?></span>
			</button>
		</div>
	</div>
</header>

<main id="main" class="site-main" tabindex="-1">
