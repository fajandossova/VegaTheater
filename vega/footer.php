<?php
/**
 * Подвал: контакты, соцсети, меню, ссылка «Помочь театру».
 *
 * @package Vega
 */

defined( 'ABSPATH' ) || exit;

$vega_donate  = vega_page_url( 'donate' );
$vega_privacy = vega_page_url( 'privacy' );
if ( ! $vega_privacy ) {
	$vega_privacy = get_privacy_policy_url();
}
?>
</main>

<footer class="site-footer">
	<div class="site-footer__inner">
		<div class="site-footer__brand">
			<a class="site-brand" href="<?php echo esc_url( function_exists( 'pll_home_url' ) ? pll_home_url() : home_url( '/' ) ); ?>">
				<?php echo vega_logo_html( 'vega', 'medium' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</a>
			<p class="site-footer__tagline"><?php esc_html_e( 'Theatre studio for children and adults in Torrevieja. Since 2019.', 'vega' ); ?></p>
			<?php echo vega_render_socials(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</div>

		<div class="site-footer__col">
			<h2 class="site-footer__title"><?php esc_html_e( 'Contact', 'vega' ); ?></h2>
			<?php if ( vega_option( 'address' ) ) : ?>
				<p class="site-footer__address"><?php echo vega_icon( 'pin' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php echo esc_html( vega_option( 'address' ) ); ?></span></p>
			<?php endif; ?>
			<ul class="contacts__list">
				<?php
				// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped -- функции ниже экранируют сами.
				echo vega_phone_line( __( 'Enrolment', 'vega' ), vega_option( 'phone_enrol' ), 'enrol' );
				echo vega_phone_line( __( 'Artistic director', 'vega' ), vega_option( 'phone_director' ), 'director' );
				// phpcs:enable
				?>
				<?php if ( vega_option( 'email_studio' ) ) : ?>
					<li class="contact-line"><a href="mailto:<?php echo esc_attr( antispambot( vega_option( 'email_studio' ) ) ); ?>"><?php echo vega_icon( 'mail' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php echo esc_html( antispambot( vega_option( 'email_studio' ) ) ); ?></a></li>
				<?php endif; ?>
			</ul>
		</div>

		<div class="site-footer__col">
			<h2 class="site-footer__title"><?php esc_html_e( 'Theatre', 'vega' ); ?></h2>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer',
					'container'      => false,
					'menu_class'     => 'site-footer__menu',
					'depth'          => 1,
					'fallback_cb'    => 'vega_auto_menu',
				)
			);
			?>
		</div>

		<div class="site-footer__col site-footer__support">
			<h2 class="site-footer__title"><?php esc_html_e( 'Support the theatre', 'vega' ); ?></h2>
			<p><?php esc_html_e( 'Donations go to costumes, sets and stage lighting. They are received by the cultural association Actorre.', 'vega' ); ?></p>
			<?php
			if ( $vega_donate ) {
				echo vega_button( $vega_donate, __( 'How to help', 'vega' ), 'ghost', array( 'icon' => 'heart' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
			?>
		</div>
	</div>

	<div class="site-footer__bottom">
		<p>© <?php echo esc_html( wp_date( 'Y' ) ); ?> Teatro Vega · Asociación Cultural Centro de Art «Actorre»</p>
		<?php if ( $vega_privacy ) : ?>
			<p><a href="<?php echo esc_url( $vega_privacy ); ?>"><?php esc_html_e( 'Privacy policy', 'vega' ); ?></a></p>
		<?php endif; ?>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
