<?php
/**
 * Template part for displaying the content of single posts
 *
 * Used in single.php
 *
 * @package Gowebblog
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="entry-content">
	<?php
	the_content(
		sprintf(
			wp_kses(
				/* translators: %s: Name of current post */
				__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'gowebblog' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		)
	);

	wp_link_pages(
		array(
			'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'gowebblog' ),
			'after'       => '</div>',
			'link_before' => '<span class="page-number">',
			'link_after'  => '</span>',
		)
	);
	?>
</div><!-- .entry-content -->

<?php if ( get_edit_post_link() ) : ?>
	<footer class="entry-footer mt-12 pt-8 border-t border-white/10">
		<?php
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'gowebblog' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link text-sm text-secondary hover:text-white transition-colors">',
			'</span>'
		);
		?>
	</footer><!-- .entry-footer -->
<?php endif; ?>

<!-- Author Bio 
<div class="author-bio mt-16 pt-8 border-t border-white/10">
	<div class="flex items-start gap-6">
		<div class="w-20 h-20 rounded-full bg-white/10 flex items-center justify-center flex-shrink-0">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 80, '', '', array( 'class' => 'w-full h-full object-cover rounded-full' ) ); ?>
		</div>
		<div class="flex-1">
			<h4 class="text-xl font-bold mb-2 text-white">
				<?php esc_html_e( 'About', 'gowebblog' ); ?> <?php the_author(); ?>
			</h4>
			<div class="text-secondary leading-relaxed">
				<?php echo wp_kses_post( get_the_author_meta( 'description' ) ); ?>
			</div>
			<div class="flex gap-4 mt-4">
				<?php
				$author_links = array(
					'twitter'  => get_the_author_meta( 'twitter' ),
					'linkedin' => get_the_author_meta( 'linkedin' ),
					'github'   => get_the_author_meta( 'github' ),
				);

				foreach ( $author_links as $network => $url ) :
					if ( ! empty( $url ) ) :
						?>
						<a href="<?php echo esc_url( $url ); ?>" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition-colors" target="_blank" rel="noopener noreferrer">
							<i class="fa-brands fa-<?php echo esc_attr( $network ); ?>"></i>
						</a>
						<?php
					endif;
				endforeach;
				?>
			</div>
		</div>
	</div>
</div>
-->

<!-- Post Navigation -->
<nav class="navigation post-navigation" role="navigation">
	<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'gowebblog' ); ?></h2>
	<div class="nav-links flex flex-col md:flex-row justify-between gap-8 mt-16 pt-8 border-t border-white/10">
		<?php
		$prev_post = get_previous_post();
		$next_post = get_next_post();

		if ( $prev_post ) :
			?>
			<div class="nav-previous flex-1">
				<a href="<?php echo esc_url( get_permalink( $prev_post ) ); ?>" class="group block bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm rounded-2xl border border-white/10 hover:border-white/25 transition-all duration-300 overflow-hidden hover:shadow-xl hover:shadow-white/5">
					<div class="p-6">
						<div class="flex items-start gap-4">
							<!-- Thumbnail -->
							<div class="flex-shrink-0 w-24 h-24 rounded-xl overflow-hidden bg-white/5">
								<?php if ( has_post_thumbnail( $prev_post->ID ) ) : ?>
									<?php echo get_the_post_thumbnail( $prev_post->ID, 'thumbnail', array( 'class' => 'w-full h-full object-cover group-hover:scale-110 transition-transform duration-500' ) ); ?>
								<?php else : ?>
									<img src="https://imagezt.davidgo.web.id/96x96/333333/ffffff?text=<?php echo esc_attr( $prev_post->post_title ); ?>&fontSize=14&textWrap=true&textWrapWidth=90" alt="<?php echo esc_attr( $prev_post->post_title ); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
								<?php endif; ?>
							</div>
							
							<!-- Content -->
							<div class="flex-1 min-w-0">
								<div class="flex items-center gap-2 mb-3">
									<i class="fa-solid fa-arrow-left text-pink-400 text-sm"></i>
									<span class="text-xs text-pink-400 font-semibold uppercase tracking-wider"><?php esc_html_e( 'Previous', 'gowebblog' ); ?></span>
								</div>
								<h4 class="font-bold text-white text-base mb-2 leading-tight group-hover:text-pink-300 transition-colors line-clamp-2">
									<?php echo esc_html( $prev_post->post_title ); ?>
								</h4>
								<div class="flex items-center gap-3 text-xs text-secondary">
									<span class="flex items-center gap-1">
										<i class="far fa-calendar"></i>
										<?php echo esc_html( get_the_date( '', $prev_post->ID ) ); ?>
									</span>
									<span class="flex items-center gap-1">
										<i class="far fa-clock"></i>
										<?php echo esc_html( gowebblog_estimated_reading_time( $prev_post->ID ) ); ?> min
									</span>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			<?php
		endif;

		if ( $next_post ) :
			?>
			<div class="nav-next flex-1">
				<a href="<?php echo esc_url( get_permalink( $next_post ) ); ?>" class="group block bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm rounded-2xl border border-white/10 hover:border-white/25 transition-all duration-300 overflow-hidden hover:shadow-xl hover:shadow-white/5">
					<div class="p-6">
						<div class="flex items-start gap-4 flex-row-reverse">
							<!-- Thumbnail -->
							<div class="flex-shrink-0 w-24 h-24 rounded-xl overflow-hidden bg-white/5">
								<?php if ( has_post_thumbnail( $next_post->ID ) ) : ?>
									<?php echo get_the_post_thumbnail( $next_post->ID, 'thumbnail', array( 'class' => 'w-full h-full object-cover group-hover:scale-110 transition-transform duration-500' ) ); ?>
								<?php else : ?>
									<img src="https://imagezt.davidgo.web.id/96x96/333333/ffffff?text=<?php echo esc_attr( $next_post->post_title ); ?>&fontSize=14&textWrap=true&textWrapWidth=90" alt="<?php echo esc_attr( $next_post->post_title ); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
								<?php endif; ?>
							</div>
							
							<!-- Content -->
							<div class="flex-1 min-w-0 text-right">
								<div class="flex items-center justify-end gap-2 mb-3">
									<span class="text-xs text-pink-400 font-semibold uppercase tracking-wider"><?php esc_html_e( 'Next', 'gowebblog' ); ?></span>
									<i class="fa-solid fa-arrow-right text-pink-400 text-sm"></i>
								</div>
								<h4 class="font-bold text-white text-base mb-2 leading-tight group-hover:text-pink-300 transition-colors line-clamp-2">
									<?php echo esc_html( $next_post->post_title ); ?>
								</h4>
								<div class="flex items-center justify-end gap-3 text-xs text-secondary">
									<span class="flex items-center gap-1">
										<i class="far fa-calendar"></i>
										<?php echo esc_html( get_the_date( '', $next_post->ID ) ); ?>
									</span>
									<span class="flex items-center gap-1">
										<i class="far fa-clock"></i>
										<?php echo esc_html( gowebblog_estimated_reading_time( $next_post->ID ) ); ?> min
									</span>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			<?php
		endif;
		?>
	</div>
</nav>