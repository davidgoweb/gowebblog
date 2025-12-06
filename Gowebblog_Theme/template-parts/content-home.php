<?php
/**
 * Template part for displaying posts in the blog grid
 *
 * Used in index.php and archive.php
 *
 * @package Gowebblog
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'group fade-in-section' ); ?>>
	<div class="relative overflow-hidden rounded-xl mb-6 aspect-[3/2]">
		<?php if ( has_post_thumbnail() ) : ?>
			<img src="<?php echo esc_url( get_the_post_thumbnail_url( null, 'medium_large' ) ); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
		<?php else : ?>
			<img src="https://imagezt.davidgo.web.id/600x400/222/fff?text=<?php echo urlencode( get_the_title() ); ?>&fontSize=24&textWrap=true&textWrapWidth=90" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
		<?php endif; ?>
		
		<?php
		$categories = get_the_category();
		if ( ! empty( $categories ) ) :
			?>
			<div class="absolute top-4 left-4 bg-white text-black text-xs font-bold px-3 py-1 uppercase rounded">
				<?php echo esc_html( $categories[0]->name ); ?>
			</div>
		<?php endif; ?>
	</div>
	
	<div class="flex items-center gap-4 text-xs text-secondary mb-3">
		<span><i class="fa-regular fa-user mr-1"></i> <?php the_author(); ?></span>
		<span><i class="fa-regular fa-calendar mr-1"></i> <?php echo esc_html( get_the_date() ); ?></span>
	</div>
	
	<h3 class="text-xl font-bold mb-3 group-hover:text-secondary transition-colors leading-tight">
		<a href="<?php the_permalink(); ?>" class="block">
			<?php the_title(); ?>
		</a>
	</h3>
	
	<div class="text-secondary text-sm leading-relaxed mb-4 line-clamp-3">
		<?php the_excerpt(); ?>
	</div>
	
	<a href="<?php the_permalink(); ?>" class="text-sm font-semibold border-b border-white/30 pb-0.5 hover:border-white transition-colors">
		<?php esc_html_e( 'Read Article', 'gowebblog' ); ?>
	</a>
</article><!-- #post-<?php the_ID(); ?> -->