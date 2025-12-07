<?php
/**
 * The footer for our theme
 *
 * Displays everything after the main content area
 *
 * @package Gowebblog
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
	</main>

	<footer class="py-16 border-t border-white/5 bg-darker">
		<div class="max-w-7xl mx-auto px-6">
			<div class="grid md:grid-cols-3 gap-12 mb-12">
				<!-- Brand -->
				<div>
					<?php if ( has_custom_logo() ) : ?>
						<div class="logo mb-6">
							<?php the_custom_logo(); ?>
						</div>
					<?php else : ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="font-heading text-3xl font-bold tracking-tighter mb-6 block">
							<?php bloginfo( 'name' ); ?>
						</a>
					<?php endif; ?>
					
					<?php
					$show_footer_description = get_theme_mod( 'gowebblog_show_footer_description', true );
					if ( $show_footer_description || is_customize_preview() ) :
					?>
						<p class="text-secondary text-sm leading-relaxed footer-brand-description">
							<?php
							$footer_description = get_theme_mod( 'gowebblog_footer_description', __( 'A modern WordPress blog theme for developers and designers', 'gowebblog' ) );
							echo esc_html( $footer_description );
							?>
						</p>
					<?php endif; ?>
				</div>

				<!-- Quick Links -->
				<div>
					<h5 class="text-lg font-bold mb-6"><?php esc_html_e( 'Quick Links', 'gowebblog' ); ?></h5>
					<?php
					$footer_menu_id = get_theme_mod( 'gowebblog_footer_menu', 0 );
					
					if ( $footer_menu_id && has_nav_menu( 'footer' ) ) {
						// Display the selected footer menu
						wp_nav_menu(
							array(
								'menu'            => $footer_menu_id,
								'theme_location'  => 'footer',
								'container'       => false,
								'menu_class'      => 'space-y-3',
								'fallback_cb'     => false,
								'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
								'walker'          => new Footer_Menu_Walker(),
							)
						);
					} else {
						// Fallback to default quick links
						?>
						<ul class="space-y-3">
							<li><a href="<?php echo esc_url( home_url( '/#about' ) ); ?>" class="text-secondary hover:text-white transition-colors text-sm"><?php esc_html_e( 'About', 'gowebblog' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/#services' ) ); ?>" class="text-secondary hover:text-white transition-colors text-sm"><?php esc_html_e( 'Services', 'gowebblog' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/#portfolio' ) ); ?>" class="text-secondary hover:text-white transition-colors text-sm"><?php esc_html_e( 'Portfolio', 'gowebblog' ); ?></a></li>
							<li><a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="text-secondary hover:text-white transition-colors text-sm"><?php esc_html_e( 'Blog', 'gowebblog' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="text-secondary hover:text-white transition-colors text-sm"><?php esc_html_e( 'Contact', 'gowebblog' ); ?></a></li>
						</ul>
						<?php
					}
					?>
				</div>

				<!-- Social Links -->
				<div>
					<h5 class="text-lg font-bold mb-6"><?php esc_html_e( 'Connect', 'gowebblog' ); ?></h5>
					<div class="space-y-6">
						<div class="flex items-start gap-4">
							<div class="w-12 h-12 rounded-full bg-white/5 flex items-center justify-center text-xl shrink-0">
								<i class="fa-regular fa-envelope"></i>
							</div>
							<div>
								<h5 class="text-lg font-bold mb-1"><?php esc_html_e( 'Email Me', 'gowebblog' ); ?></h5>
								<p class="text-secondary">
									<a href="mailto:<?php echo esc_attr( get_theme_mod( 'contact_email', 'davidgoweb@gmail.com' ) ); ?>">
										<?php echo esc_html( get_theme_mod( 'contact_email', 'davidgoweb@gmail.com' ) ); ?>
									</a>
								</p>
							</div>
						</div>
						
						<div class="flex items-start gap-4">
							<div class="w-12 h-12 rounded-full bg-white/5 flex items-center justify-center text-xl shrink-0">
								<i class="fa-brands fa-linkedin"></i>
							</div>
							<div>
								<h5 class="text-lg font-bold mb-1"><?php esc_html_e( 'LinkedIn', 'gowebblog' ); ?></h5>
								<p class="text-secondary">
									<a href="<?php echo esc_url( get_theme_mod( 'linkedin_url', 'https://www.linkedin.com/in/maykhel-david/' ) ); ?>" target="_blank" rel="noopener noreferrer">
										<?php esc_html_e( 'Maykhel David', 'gowebblog' ); ?>
									</a>
								</p>
							</div>
						</div>
						
						<div class="flex items-start gap-4">
							<div class="w-12 h-12 rounded-full bg-white/5 flex items-center justify-center text-xl shrink-0">
								<i class="fa-brands fa-github"></i>
							</div>
							<div>
								<h5 class="text-lg font-bold mb-1"><?php esc_html_e( 'Github', 'gowebblog' ); ?></h5>
								<p class="text-secondary">
									<a href="<?php echo esc_url( get_theme_mod( 'github_url', 'https://github.com/davidgoweb' ) ); ?>" target="_blank" rel="noopener noreferrer">
										<?php esc_html_e( 'Davidgoweb', 'gowebblog' ); ?>
									</a>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Footer Widgets -->
			<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
				<div class="border-t border-white/5 pt-12 mb-12">
					<div class="grid md:grid-cols-3 gap-8">
						<?php dynamic_sidebar( 'footer-1' ); ?>
					</div>
				</div>
			<?php endif; ?>

			<!-- Bottom Bar -->
			<div class="pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center">
				<p class="text-secondary text-sm mb-4 md:mb-0">
					&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All Rights Reserved.', 'gowebblog' ); ?>
				</p>
				<p class="text-secondary text-sm">
					<?php
					printf(
						/* translators: %s: Theme author */
						esc_html__( 'Designed with %1$s by %2$s', 'gowebblog' ),
						'<span class="text-red-500">❤️</span>',
						'<a href="' . esc_url( 'https://davidgoweb.com' ) . '" target="_blank" rel="noopener noreferrer">Davidgoweb</a>'
					);
					?>
				</p>
			</div>
		</div>
	</footer>

	<?php wp_footer(); ?>
</body>
</html>