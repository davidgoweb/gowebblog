<?php
/**
 * The template for displaying single posts
 *
 * @package Gowebblog
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header(); ?>

	<!-- Back to Blog -->
	<section class="py-8">
		<div class="max-w-7xl mx-auto px-6">
			<a href="/" class="inline-flex items-center text-secondary hover:text-white transition-colors">
				<i class="fa-solid fa-arrow-left mr-2"></i>
				<?php esc_html_e( 'Back', 'gowebblog' ); ?>
			</a>
		</div>
	</section>

	<!-- Blog Hero Section -->
	<section class="py-12">
		<div class="max-w-7xl mx-auto px-6">
			<!-- Category Badge -->
			<div class="mb-6 fade-in-section">
				<?php
				$categories = get_the_category();
				if ( ! empty( $categories ) ) :
					?>
					<span class="bg-white text-black text-xs font-bold px-3 py-1 uppercase rounded">
						<?php echo esc_html( $categories[0]->name ); ?>
					</span>
				<?php endif; ?>
			</div>
			
			<!-- Blog Title -->
			<h1 class="font-heading text-4xl md:text-5xl lg:text-6xl font-bold mb-8 leading-tight fade-in-section">
				<?php the_title(); ?>
			</h1>
			
			<!-- Author & Date -->
			<div class="flex flex-wrap items-center gap-6 mb-10 text-secondary fade-in-section">
				<div class="flex items-center gap-3">
					<div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center">
						<i class="fa-solid fa-user"></i>
					</div>
					<div>
						<p class="text-sm text-white/60"><?php esc_html_e( 'Author', 'gowebblog' ); ?></p>
						<p class="font-medium"><?php the_author(); ?></p>
					</div>
				</div>
				<div class="flex items-center gap-3">
					<div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center">
						<i class="fa-regular fa-calendar"></i>
					</div>
					<div>
						<p class="text-sm text-white/60"><?php esc_html_e( 'Published', 'gowebblog' ); ?></p>
						<p class="font-medium"><?php echo esc_html( get_the_date() ); ?></p>
					</div>
				</div>
				<div class="flex items-center gap-3">
					<div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center">
						<i class="fa-regular fa-clock"></i>
					</div>
					<div>
						<p class="text-sm text-white/60"><?php esc_html_e( 'Reading Time', 'gowebblog' ); ?></p>
						<p class="font-medium"><?php echo esc_html( gowebblog_estimated_reading_time() ); ?> <?php esc_html_e( 'min', 'gowebblog' ); ?></p>
					</div>
				</div>
			</div>
			
			<!-- Featured Image -->
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="rounded-2xl overflow-hidden mb-12 fade-in-section">
					<?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-auto' ) ); ?>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<!-- Blog Content with Sidebar -->
	<section class="pb-24">
		<div class="max-w-7xl mx-auto px-6">
			<div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
				<!-- Main Content -->
				<div class="lg:col-span-2">
					<div class="blog-content fade-in-section">
						<?php
						while ( have_posts() ) :
							the_post();
							get_template_part( 'template-parts/content-single' );
						endwhile;
						?>

						<!-- Tags and Share -->
						<div class="mt-16 pt-8 border-t border-white/10 fade-in-section">
							<?php
							$tags = get_the_tags();
							if ( $tags ) :
								?>
								<div class="flex flex-wrap gap-3 mb-8">
									<?php foreach ( $tags as $tag ) : ?>
										<span class="px-4 py-2 bg-card rounded-full text-sm text-secondary border border-white/5">
											<?php echo esc_html( $tag->name ); ?>
										</span>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
							
							<!-- Share -->
							<div class="flex items-center gap-4 mb-8">
								<p class="text-secondary text-sm"><?php esc_html_e( 'Share this article:', 'gowebblog' ); ?></p>
								<div class="flex gap-3">
									<a href="https://twitter.com/intent/tweet?text=<?php echo urlencode( get_the_title() ); ?>&url=<?php echo urlencode( get_permalink() ); ?>" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition-colors" target="_blank" rel="noopener noreferrer">
										<i class="fa-brands fa-twitter"></i>
									</a>
									<a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode( get_permalink() ); ?>" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition-colors" target="_blank" rel="noopener noreferrer">
										<i class="fa-brands fa-linkedin"></i>
									</a>
									<a href="#" onclick="navigator.clipboard.writeText('<?php echo urlencode( get_permalink() ); ?>'); return false;" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition-colors">
										<i class="fa-solid fa-link"></i>
									</a>
								</div>
							</div>
						</div>

						<!-- Comments -->
						<?php if ( comments_open() || get_comments_number() ) : ?>
							<div class="mt-16 pt-8 border-t border-white/10">
								<?php comments_template(); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
				
				<!-- Sidebar -->
				<div class="lg:col-span-1">
					<div class="sticky top-24 space-y-8">
						<!-- Table of Contents -->
						<?php if ( gowebblog_has_headings() ) : ?>
							<div class="bg-card/50 backdrop-blur-sm rounded-2xl p-6 border border-white/5 fade-in-section">
								<div class="toc-container">
									<h3 class="font-heading text-xl font-bold mb-6 text-white flex items-center">
										<i class="fa-solid fa-list-ul mr-3 text-white/60"></i>
										<?php esc_html_e( 'Table of Contents', 'gowebblog' ); ?>
									</h3>
									<?php echo gowebblog_get_table_of_contents(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</div>
							</div>
						<?php endif; ?>
						
						<!-- Author Info - REMOVED -->
						<!--
						<div class="bg-card/50 backdrop-blur-sm rounded-2xl p-6 border border-white/5 fade-in-section">
							<h3 class="font-heading text-xl font-bold mb-6 text-white flex items-center">
								<i class="fa-solid fa-user-pen mr-3 text-white/60"></i>
								<?php esc_html_e( 'About Author', 'gowebblog' ); ?>
							</h3>
							<div class="flex items-center gap-4 mb-4">
								<div class="w-16 h-16 rounded-full bg-white/10 flex items-center justify-center">
									<?php echo get_avatar( get_the_author_meta( 'ID' ), 64, '', '', array( 'class' => 'w-full h-full object-cover rounded-full' ) ); ?>
								</div>
								<div>
									<h4 class="font-semibold text-white"><?php the_author(); ?></h4>
									<p class="text-sm text-secondary"><?php esc_html_e( 'Design Enthusiast', 'gowebblog' ); ?></p>
								</div>
							</div>
							<p class="text-sm text-secondary leading-relaxed mb-4">
								<?php echo wp_kses_post( get_the_author_meta( 'description' ) ); ?>
							</p>
							<div class="flex gap-3">
								<?php
								$author_links = array(
									'twitter'  => get_the_author_meta( 'twitter' ),
									'linkedin' => get_the_author_meta( 'linkedin' ),
									'github'   => get_the_author_meta( 'github' ),
								);

								foreach ( $author_links as $network => $url ) :
									if ( ! empty( $url ) ) :
										?>
										<a href="<?php echo esc_url( $url ); ?>" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition-colors text-sm" target="_blank" rel="noopener noreferrer">
											<i class="fa-brands fa-<?php echo esc_attr( $network ); ?>"></i>
										</a>
										<?php
									endif;
								endforeach;
								?>
							</div>
						</div>
						-->
						
						<!-- Related Posts -->
						<?php
						$related_posts = gowebblog_get_related_posts( get_the_ID(), 3 );
						if ( $related_posts->have_posts() ) :
							?>
							<div class="bg-card/50 backdrop-blur-sm rounded-2xl p-6 border border-white/5 fade-in-section">
								<h3 class="font-heading text-xl font-bold mb-6 text-white flex items-center">
									<i class="fa-solid fa-bookmark mr-3 text-white/60"></i>
									<?php esc_html_e( 'Related Posts', 'gowebblog' ); ?>
								</h3>
								<div class="space-y-4">
									<?php
									while ( $related_posts->have_posts() ) :
										$related_posts->the_post();
										?>
										<a href="<?php the_permalink(); ?>" class="group block">
											<div class="flex gap-3">
												<div class="w-20 h-20 rounded-lg overflow-hidden flex-shrink-0">
													<?php if ( has_post_thumbnail() ) : ?>
														<?php the_post_thumbnail( 'thumbnail', array( 'class' => 'w-full h-full object-cover group-hover:scale-110 transition-transform duration-300' ) ); ?>
													<?php else : ?>
														<img src="https://imagezt.davidgo.web.id/80x80/333333/ffffff?text=<?php echo esc_attr( get_the_title() ); ?>&fontSize=18&textWrap=true&textWrapWidth=90" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
													<?php endif; ?>
												</div>
												<div>
													<p class="font-medium text-white text-sm mb-1 group-hover:text-pink-300 transition-colors line-clamp-2">
														<?php the_title(); ?>
													</p>
													<p class="text-xs text-secondary"><?php echo esc_html( gowebblog_estimated_reading_time() ); ?> <?php esc_html_e( 'min read', 'gowebblog' ); ?></p>
												</div>
											</div>
										</a>
									<?php endwhile; ?>
								</div>
							</div>
							<?php
							wp_reset_postdata();
						endif;
						?>
						
					</div>
				</div>
			</div>
		</div>
	</section>

<?php
get_footer();