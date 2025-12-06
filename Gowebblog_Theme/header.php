<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Gowebblog
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class( 'bg-darker text-primary font-sans antialiased selection:bg-white selection:text-black' ); ?>>
<?php wp_body_open(); ?>

<header class="fixed w-full top-0 z-50 bg-darker/80 backdrop-blur-md border-b border-white/5">
	<div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
		<!-- Logo -->
		<?php if ( has_custom_logo() ) : ?>
			<div class="logo">
				<?php the_custom_logo(); ?>
			</div>
		<?php else : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="font-heading text-3xl font-bold tracking-tighter">
				<?php bloginfo( 'name' ); ?>
			</a>
		<?php endif; ?>

		<!-- Desktop Menu -->
		<nav class="hidden md:flex gap-8 items-center text-sm font-medium uppercase tracking-wider text-secondary">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_class'     => 'flex gap-8 items-center',
					'container'      => false,
					'fallback_cb'    => false,
					'items_wrap'     => '%3$s',
					'walker'         => new Gowebblog_Nav_Walker(),
				)
			);
			?>
		</nav>

		<!-- CTA & Mobile Toggle -->
		<div class="flex items-center gap-4">
			<a href="<?php echo esc_url(get_theme_mod('gowebblog_cta_link', '#contact')); ?>" class="hidden sm:inline-block px-6 py-2.5 border border-white/20 rounded-full text-sm font-semibold hover:bg-white hover:text-black transition-all duration-300">
				<?php echo esc_html(get_theme_mod('gowebblog_cta_text', __("Let's Talk", 'gowebblog'))); ?>
			</a>
			<button id="mobile-menu-btn" class="md:hidden text-2xl p-2 focus:outline-none">
				<i class="fa-solid fa-bars"></i>
			</button>
		</div>
	</div>
</header>

<!-- Mobile Menu Overlay -->
<div id="mobile-menu" class="fixed inset-0 bg-darker z-40 transform translate-x-full transition-transform duration-300 flex flex-col items-center justify-center space-y-8 text-2xl font-heading font-bold md:hidden">
	<button id="close-menu-btn" class="absolute top-6 right-6 text-3xl text-secondary hover:text-white">
		<i class="fa-solid fa-xmark"></i>
	</button>
	<?php
	wp_nav_menu(
		array(
			'theme_location' => 'primary',
			'menu_class'     => 'flex flex-col items-center space-y-8',
			'container'      => false,
			'fallback_cb'    => false,
			'items_wrap'     => '%3$s',
			'walker'         => new Gowebblog_Mobile_Nav_Walker(),
		)
	);
	?>
</div>

<main class="pt-20">