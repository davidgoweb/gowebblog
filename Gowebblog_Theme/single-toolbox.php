<?php
/**
 * The template for displaying single toolbox items
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gowebblog
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header(); ?>

	<!-- Back to Toolbox -->
	<section class="py-8">
		<div class="max-w-7xl mx-auto px-6">
			<a href="<?php echo esc_url( get_post_type_archive_link( 'toolbox' ) ); ?>" class="inline-flex items-center text-secondary hover:text-white transition-colors">
				<i class="fa-solid fa-arrow-left mr-2"></i>
				<?php esc_html_e( 'Back to Toolbox', 'gowebblog' ); ?>
			</a>
		</div>
	</section>

	<!-- Toolbox Hero Section -->
	<section class="py-12">
		<div class="max-w-7xl mx-auto px-6">
			<!-- Category Badge -->
			<div class="mb-6 fade-in-section">
				<?php
				$categories = get_the_terms( get_the_ID(), 'toolbox-category' );
				if ( $categories && ! is_wp_error( $categories ) ) :
					?>
					<span class="bg-white text-black text-xs font-bold px-3 py-1 uppercase rounded">
						<?php echo esc_html( $categories[0]->name ); ?>
					</span>
				<?php endif; ?>
			</div>
			
			<!-- Toolbox Title -->
			<h1 class="font-heading text-4xl md:text-5xl lg:text-6xl font-bold mb-8 leading-tight fade-in-section">
				<?php the_title(); ?>
			</h1>
			
			<!-- Date & Categories -->
			<div class="flex flex-wrap items-center gap-6 mb-10 text-secondary fade-in-section">
				<div class="flex items-center gap-3">
					<div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center">
						<i class="fa-regular fa-calendar"></i>
					</div>
					<div>
						<p class="text-sm text-white/60"><?php esc_html_e( 'Published', 'gowebblog' ); ?></p>
						<p class="font-medium"><?php echo esc_html( get_the_date() ); ?></p>
					</div>
				</div>
				
				<?php
				// Display toolbox categories
				$categories = get_the_terms( get_the_ID(), 'toolbox-category' );
				if ( $categories && ! is_wp_error( $categories ) ) : ?>
					<div class="flex items-center gap-3">
						<div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center">
							<i class="far fa-folder"></i>
						</div>
						<div>
							<p class="text-sm text-white/60"><?php esc_html_e( 'Categories', 'gowebblog' ); ?></p>
							<div class="flex flex-wrap gap-2">
								<?php foreach ( $categories as $category ) : ?>
									<span class="text-sm"><?php echo esc_html( $category->name ); ?></span>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
				
				<?php
				// Display toolbox tags
				$tags = get_the_terms( get_the_ID(), 'toolbox-tag' );
				if ( $tags && ! is_wp_error( $tags ) ) : ?>
					<div class="flex items-center gap-3">
						<div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center">
							<i class="far fa-tags"></i>
						</div>
						<div>
							<p class="text-sm text-white/60"><?php esc_html_e( 'Tags', 'gowebblog' ); ?></p>
							<div class="flex flex-wrap gap-2">
								<?php foreach ( $tags as $tag ) : ?>
									<span class="text-sm">#<?php echo esc_html( $tag->name ); ?></span>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
			
			<!-- Featured Image -->
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="rounded-2xl overflow-hidden mb-12 fade-in-section">
					<?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-auto' ) ); ?>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<!-- Toolbox Content with Sidebar -->
	<section class="pb-24">
		<div class="max-w-7xl mx-auto px-6">
			<div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
				<!-- Main Content -->
				<div class="lg:col-span-2">
					<div class="toolbox-content fade-in-section">
						<?php
						while ( have_posts() ) :
							the_post();
							?>

							<div class="entry-content">
								<?php
								the_content();

								wp_link_pages(
									array(
										'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'gowebblog' ),
										'after'  => '</div>',
									)
								);
								?>
							</div>
							

							<!-- Tags and Share -->
							<div class="mt-16 pt-8 border-t border-white/10 fade-in-section">
								<?php
								$tags = get_the_terms( get_the_ID(), 'toolbox-tag' );
								if ( $tags && ! is_wp_error( $tags ) ) :
									?>
									<div class="flex flex-wrap gap-3 mb-8">
										<?php foreach ( $tags as $tag ) : ?>
											<span class="px-4 py-2 bg-card rounded-full text-sm text-secondary border border-white/5">
												#<?php echo esc_html( $tag->name ); ?>
											</span>
										<?php endforeach; ?>
									</div>
								<?php endif; ?>
								
								<!-- Share -->
								<div class="flex items-center gap-4 mb-8">
									<p class="text-secondary text-sm"><?php esc_html_e( 'Share this toolbox item:', 'gowebblog' ); ?></p>
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

						<?php endwhile; // End of the loop. ?>
					</div>
				</div>
				
				<!-- Sidebar -->
				<div class="lg:col-span-1">
					<div class="sticky top-24 space-y-8">
						<!-- GitHub Repository Button -->
						<?php
						$repo_url = get_post_meta( get_the_ID(), '_toolbox_repo_url', true );
						if ( $repo_url ) : ?>
							<div class="bg-card/50 backdrop-blur-sm rounded-2xl p-6 border border-white/5 fade-in-section">
								<a href="<?php echo esc_url( $repo_url ); ?>" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center gap-3 w-full py-4 bg-white text-black font-semibold rounded-lg hover:bg-white/90 transition-colors">
									<i class="fab fa-github text-xl"></i>
									<span><?php esc_html_e( 'View on GitHub', 'gowebblog' ); ?></span>
								</a>
							</div>
						<?php endif; ?>
						
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
						
						<!-- Toolbox Info -->
						<div class="bg-card/50 backdrop-blur-sm rounded-2xl p-6 border border-white/5 fade-in-section">
							<h3 class="font-heading text-xl font-bold mb-6 text-white flex items-center">
								<i class="fa-solid fa-info-circle mr-3 text-white/60"></i>
								<?php esc_html_e( 'Toolbox Info', 'gowebblog' ); ?>
							</h3>
							<div class="space-y-4">
								<?php
								// Display toolbox categories
								$categories = get_the_terms( get_the_ID(), 'toolbox-category' );
								if ( $categories && ! is_wp_error( $categories ) ) : ?>
									<div class="flex items-start gap-3">
										<i class="far fa-folder text-white/60 mt-1"></i>
										<div>
											<p class="text-sm text-white/60"><?php esc_html_e( 'Categories', 'gowebblog' ); ?></p>
											<div class="flex flex-wrap gap-2 mt-1">
												<?php foreach ( $categories as $category ) : ?>
													<a href="<?php echo esc_url( get_term_link( $category ) ); ?>" class="text-xs px-2 py-1 bg-white/10 rounded-full text-white/80 hover:bg-white/20 transition-colors">
														<?php echo esc_html( $category->name ); ?>
													</a>
												<?php endforeach; ?>
											</div>
										</div>
									</div>
								<?php endif; ?>
								
								<?php
								// Display toolbox tags
								$tags = get_the_terms( get_the_ID(), 'toolbox-tag' );
								if ( $tags && ! is_wp_error( $tags ) ) : ?>
									<div class="flex items-start gap-3">
										<i class="far fa-tags text-white/60 mt-1"></i>
										<div>
											<p class="text-sm text-white/60"><?php esc_html_e( 'Tags', 'gowebblog' ); ?></p>
											<div class="flex flex-wrap gap-2 mt-1">
												<?php foreach ( $tags as $tag ) : ?>
													<a href="<?php echo esc_url( get_term_link( $tag ) ); ?>" class="text-xs px-2 py-1 bg-white/10 rounded-full text-white/80 hover:bg-white/20 transition-colors">
														#<?php echo esc_html( $tag->name ); ?>
													</a>
												<?php endforeach; ?>
											</div>
										</div>
									</div>
								<?php endif; ?>
								
								<div class="flex items-start gap-3">
									<i class="far fa-calendar text-white/60 mt-1"></i>
									<div>
										<p class="text-sm text-white/60"><?php esc_html_e( 'Published', 'gowebblog' ); ?></p>
										<p class="text-sm"><?php echo esc_html( get_the_date() ); ?></p>
									</div>
								</div>
							</div>
						</div>
						
						<!-- Related Toolbox Items -->
						<?php
						$related_toolbox = gowebblog_get_related_toolbox_items( get_the_ID(), 3 );
						if ( $related_toolbox->have_posts() ) :
							?>
							<div class="bg-card/50 backdrop-blur-sm rounded-2xl p-6 border border-white/5 fade-in-section">
								<h3 class="font-heading text-xl font-bold mb-6 text-white flex items-center">
									<i class="fa-solid fa-tools mr-3 text-white/60"></i>
									<?php esc_html_e( 'Related Tools', 'gowebblog' ); ?>
								</h3>
								<div class="space-y-4">
									<?php
									while ( $related_toolbox->have_posts() ) :
										$related_toolbox->the_post();
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
													<p class="text-xs text-secondary"><?php echo esc_html( get_the_date() ); ?></p>
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

	<!-- Previous/next toolbox navigation -->
	<?php
	$prev_toolbox = get_previous_post();
	$next_toolbox = get_next_post();
	
	if ( $prev_toolbox || $next_toolbox ) : ?>
		<nav class="navigation toolbox-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Toolbox navigation', 'gowebblog' ); ?></h2>
			<div class="nav-links flex flex-col md:flex-row justify-between gap-8 mt-16 pt-8 border-t border-white/10">
				<?php if ( $prev_toolbox ) : ?>
					<div class="nav-previous flex-1">
						<a href="<?php echo esc_url( get_permalink( $prev_toolbox ) ); ?>" class="group block bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm rounded-2xl border border-white/10 hover:border-white/25 transition-all duration-300 overflow-hidden hover:shadow-xl hover:shadow-white/5">
							<div class="p-6">
								<div class="flex items-center gap-4">
									
									<!-- Content -->
									<div class="flex-1 min-w-0">
										<div class="flex items-center gap-2 mb-3">
											<i class="fa-solid fa-arrow-left text-pink-400 text-sm"></i>
											<span class="text-xs text-pink-400 font-semibold uppercase tracking-wider w-full"><?php esc_html_e( 'Previous', 'gowebblog' ); ?></span>
										</div>
										<p class="font-bold text-white text-base mb-2 leading-tight group-hover:text-pink-300 transition-colors line-clamp-2">
											<?php echo esc_html( $prev_toolbox->post_title ); ?>
										</p>
										<div class="flex items-center gap-3 text-xs text-secondary">
											<span class="flex items-center gap-1">
												<i class="far fa-calendar"></i>
												<?php echo esc_html( get_the_date( '', $prev_toolbox->ID ) ); ?>
											</span>
											<?php
											// Display toolbox categories
											$categories = get_the_terms( $prev_toolbox->ID, 'toolbox-category' );
											if ( $categories && ! is_wp_error( $categories ) ) : ?>
												<span class="flex items-center gap-1">
													<i class="far fa-folder"></i>
													<?php echo esc_html( $categories[0]->name ); ?>
												</span>
											<?php endif; ?>
										</div>
									</div>
								</div>
							</div>
						</a>
					</div>
				<?php endif; ?>
				
				<?php if ( $next_toolbox ) : ?>
					<div class="nav-next flex-1">
						<a href="<?php echo esc_url( get_permalink( $next_toolbox ) ); ?>" class="group block bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm rounded-2xl border border-white/10 hover:border-white/25 transition-all duration-300 overflow-hidden hover:shadow-xl hover:shadow-white/5">
							<div class="p-6">
								<div class="flex items-center gap-4 flex-row-reverse">
									
									<!-- Content -->
									<div class="flex-1 min-w-0 text-right">
										<div class="flex items-center justify-end gap-2 mb-3">
											<span class="text-xs text-pink-400 font-semibold uppercase tracking-wider w-full"><?php esc_html_e( 'Next', 'gowebblog' ); ?></span>
											<i class="fa-solid fa-arrow-right text-pink-400 text-sm"></i>
										</div>
										<p class="font-bold text-white text-base mb-2 leading-tight group-hover:text-pink-300 transition-colors line-clamp-2">
											<?php echo esc_html( $next_toolbox->post_title ); ?>
										</p>
										<div class="flex items-center justify-end gap-3 text-xs text-secondary">
											<span class="flex items-center gap-1">
												<i class="far fa-calendar"></i>
												<?php echo esc_html( get_the_date( '', $next_toolbox->ID ) ); ?>
											</span>
											<?php
											// Display toolbox categories
											$categories = get_the_terms( $next_toolbox->ID, 'toolbox-category' );
											if ( $categories && ! is_wp_error( $categories ) ) : ?>
												<span class="flex items-center gap-1">
													<i class="far fa-folder"></i>
													<?php echo esc_html( $categories[0]->name ); ?>
												</span>
											<?php endif; ?>
										</div>
									</div>
								</div>
							</div>
						</a>
					</div>
				<?php endif; ?>
			</div>
		</nav>
	<?php endif;
	?>

<?php
get_footer();