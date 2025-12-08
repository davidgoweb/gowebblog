<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 *
 * @package Gowebblog
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header(); ?>

<?php if ( is_paged() ) : ?>
	<!-- Paginated Blog Posts Only -->
	<section id="blog" class="py-24">
		<div class="max-w-7xl mx-auto px-6">
			<div class="mb-16 text-center fade-in-section">
				<h2 class="text-secondary uppercase tracking-widest text-sm font-semibold"><?php esc_html_e( 'Journal', 'gowebblog' ); ?></h2>
				<p class="font-heading text-4xl md:text-5xl font-bold mt-2"><?php esc_html_e( 'Latest News', 'gowebblog' ); ?></p>
			</div>

			<?php if ( have_posts() ) : ?>
				<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
					<?php
					// Start the Loop.
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content-home' );
					endwhile;
					?>
				</div>

				<!-- Pagination -->
				<div class="mt-16 flex justify-center">
					<?php
					the_posts_pagination(
						array(
							'mid_size'           => 2,
							'prev_text'          => __( '<i class="fa-solid fa-chevron-left"></i>', 'gowebblog' ),
							'next_text'          => __( '<i class="fa-solid fa-chevron-right"></i>', 'gowebblog' ),
							'screen_reader_text' => __( 'Posts navigation', 'gowebblog' ),
							'class'              => 'gowebblog-pagination',
						)
					);
					?>
				</div>

			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			<?php endif; ?>
		</div>
	</section>

<?php else : ?>
	<!-- Full Home Page (only on page 1) -->
	<!-- Hero Section -->
	<section id="about" class="min-h-screen flex items-center py-20 relative overflow-hidden">
		<div class="absolute top-0 right-0 w-1/3 h-full bg-gradient-to-l from-white/5 to-transparent pointer-events-none"></div>
		
		<div class="max-w-7xl mx-auto px-6 w-full grid lg:grid-cols-2 gap-12 items-center">
			<!-- Text Content -->
			<div class="order-2 lg:order-1 fade-in-section">
				<p class="text-secondary text-lg mb-4 font-medium tracking-wide">
					<?php
					$hero_heading = get_theme_mod( 'gowebblog_hero_heading', __( 'Hello, this is', 'gowebblog' ) );
					echo esc_html( $hero_heading );
					?>
				</p>
				<h1 class="font-heading text-3xl md:text-6xl font-bold mb-6 leading-none">
					<?php bloginfo( 'name' ); ?> <br> <span class="text-secondary">
						<?php
						$hero_subtitle = get_theme_mod( 'gowebblog_hero_subtitle', __( 'Portal', 'gowebblog' ) );
						echo esc_html( $hero_subtitle );
						?>
					</span>
				</h1>
				<p class="text-secondary text-lg md:text-xl leading-relaxed mb-8 max-w-lg">
					<?php
					$hero_description = get_theme_mod( 'gowebblog_hero_description' );
					if ( $hero_description || is_customize_preview() ) :
						echo esc_html( $hero_description );
					else :
						$description = get_bloginfo( 'description', 'display' );
						if ( $description ) :
							echo esc_html( $description );
						else :
							esc_html_e( 'Tech enthusiast and architecture-minded builder based in Jakarta. I blend market insight with solid technical structure to help brands turn ideas into high-quality, scalable products.', 'gowebblog' );
						endif;
					endif;
					?>
				</p>

				<!-- Skills Tags -->
				<div class="flex flex-wrap gap-3 mb-10">
					<span class="px-4 py-2 bg-card rounded-full text-sm text-secondary border border-white/5">
						<?php
						$hero_skill_1 = get_theme_mod( 'gowebblog_hero_skill_1', __( 'Web Development', 'gowebblog' ) );
						echo esc_html( $hero_skill_1 );
						?>
					</span>
					<span class="px-4 py-2 bg-card rounded-full text-sm text-secondary border border-white/5">
						<?php
						$hero_skill_2 = get_theme_mod( 'gowebblog_hero_skill_2', __( 'Open Source', 'gowebblog' ) );
						echo esc_html( $hero_skill_2 );
						?>
					</span>
					<span class="px-4 py-2 bg-card rounded-full text-sm text-secondary border border-white/5">
						<?php
						$hero_skill_3 = get_theme_mod( 'gowebblog_hero_skill_3', __( 'Tech Architecture', 'gowebblog' ) );
						echo esc_html( $hero_skill_3 );
						?>
					</span>
				</div>

				<!-- Socials -->
				<div class="mt-8 flex gap-6 text-xl text-secondary">
					<?php if ( get_theme_mod( 'linkedin_url' ) ) : ?>
						<a href="<?php echo esc_url( get_theme_mod( 'linkedin_url' ) ); ?>" class="hover:text-white transition-transform hover:-translate-y-1" target="_blank" rel="noopener noreferrer">
							<i class="fa-brands fa-linkedin"></i>
						</a>
					<?php endif; ?>
					<?php if ( get_theme_mod( 'github_url' ) ) : ?>
						<a href="<?php echo esc_url( get_theme_mod( 'github_url' ) ); ?>" class="hover:text-white transition-transform hover:-translate-y-1" target="_blank" rel="noopener noreferrer">
							<i class="fa-brands fa-github"></i>
						</a>
					<?php endif; ?>
				</div>
			</div>
			
			<!-- Hero Image -->
			<div class="order-1 lg:order-2 fade-in-section">
				<div class="relative">
					<?php
					$hero_image = get_theme_mod( 'gowebblog_hero_image' );
					if ( $hero_image ) :
						$image_url = wp_get_attachment_image_url( $hero_image, 'large' );
					else :
						$image_url = get_template_directory_uri() . '/assets/img/cover.png';
					endif;
					?>
					<img src="<?php echo esc_url( $image_url ); ?>" data-default="<?php echo esc_url( get_template_directory_uri() . '/assets/img/cover.png' ); ?>" alt="<?php esc_attr_e( 'Hero Image', 'gowebblog' ); ?>" class="w-full rounded-2xl shadow-2xl">
					<div class="absolute inset-0 bg-gradient-to-t from-darker/20 to-transparent rounded-2xl"></div>
				</div>
			</div>
		</div>
	</section>

	<!-- Services Section -->
	<section id="services" class="py-24 bg-card/30">
		<div class="max-w-7xl mx-auto px-6">
			<div class="mb-16 fade-in-section">
				<h2 class="text-secondary uppercase tracking-widest text-sm font-semibold"><?php esc_html_e( 'Services', 'gowebblog' ); ?></h2>
				<p class="font-heading text-4xl md:text-5xl font-bold mt-2"><?php esc_html_e( 'What I Do', 'gowebblog' ); ?></p>
			</div>

			<div class="grid md:grid-cols-3 gap-8">
				<!-- Service 1 -->
				<div class="group p-8 bg-card border border-white/5 rounded-2xl hover:border-white/20 transition-all duration-300 fade-in-section">
					<span class="text-4xl text-white/20 font-heading font-bold mb-6 block group-hover:text-white transition-colors">01/</span>
					<h3 class="text-2xl font-bold mb-4"><?php esc_html_e( 'Technology Consulting', 'gowebblog' ); ?></h3>
					<p class="text-secondary leading-relaxed mb-6"><?php esc_html_e( 'Deliver contemporary, streamlined, and user-focused solutions that foster interaction and business expansion.', 'gowebblog' ); ?></p>
				</div>

				<!-- Service 2 -->
				<div class="group p-8 bg-card border border-white/5 rounded-2xl hover:border-white/20 transition-all duration-300 fade-in-section">
					<span class="text-4xl text-white/20 font-heading font-bold mb-6 block group-hover:text-white transition-colors">02/</span>
					<h3 class="text-2xl font-bold mb-4"><?php esc_html_e( 'Web Development', 'gowebblog' ); ?></h3>
					<p class="text-secondary leading-relaxed mb-6"><?php esc_html_e( 'Building fast, responsive, and accessible websites using modern technologies.', 'gowebblog' ); ?></p>
				</div>

				<!-- Service 3 -->
				<div class="group p-8 bg-card border border-white/5 rounded-2xl hover:border-white/20 transition-all duration-300 fade-in-section">
					<span class="text-4xl text-white/20 font-heading font-bold mb-6 block group-hover:text-white transition-colors">03/</span>
					<h3 class="text-2xl font-bold mb-4"><?php esc_html_e( 'Digital Strategy', 'gowebblog' ); ?></h3>
					<p class="text-secondary leading-relaxed mb-6"><?php esc_html_e( 'Strategic digital marketing campaigns to increase your reach and brand visibility.', 'gowebblog' ); ?></p>
				</div>
			</div>
		</div>
	</section>

	<!-- Toolbox Section -->
	<section id="toolbox" class="py-24 relative">
		<!-- Background decoration -->
		<div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-primary/5 to-transparent pointer-events-none"></div>
		
		<div class="max-w-7xl mx-auto px-6 relative z-10">
			<div class="flex flex-col md:flex-row md:items-end justify-between mb-16 fade-in-section">
				<div>
					<h2 class="text-secondary uppercase tracking-widest text-sm font-semibold"><?php esc_html_e( 'Toolbox', 'gowebblog' ); ?></h2>
					<span class="font-heading text-4xl md:text-5xl font-bold mt-2"><?php esc_html_e( 'Discoveries', 'gowebblog' ); ?></span>
				</div>
				<a href="<?php echo esc_url( get_post_type_archive_link( 'toolbox' ) ); ?>" class="mt-6 md:mt-0 inline-flex items-center text-secondary hover:text-white transition-colors">
					<span><?php esc_html_e( 'View All', 'gowebblog' ); ?></span>
					<i class="fa-solid fa-arrow-right ml-2"></i>
				</a>
			</div>

			<div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
				<?php
				// Display portfolio projects from toolbox post type
				$portfolio_args = array(
					'post_type'      => 'toolbox',
					'posts_per_page' => 8,
					'orderby'        => 'date',
					'order'          => 'DESC',
				);

				$portfolio_query = new WP_Query( $portfolio_args );

				if ( $portfolio_query->have_posts() ) :
					while ( $portfolio_query->have_posts() ) :
						$portfolio_query->the_post();
						?>
						<div class="group relative bg-card/50 backdrop-blur-sm rounded-2xl overflow-hidden border border-white/10 hover:border-white/20 transition-all duration-300 fade-in-section hover:shadow-xl hover:shadow-primary/10">
							<!-- Card Image -->
							<div class="aspect-[4/3] overflow-hidden">
								<?php if ( has_post_thumbnail() ) : ?>
									<a href="<?php the_permalink(); ?>" class="block w-full h-full">
										<img src="<?php echo esc_url( get_the_post_thumbnail_url( null, 'medium_large' ) ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
									</a>
								<?php else : ?>
									<?php
									// Try to get GitHub image directly if no featured image
									$github_url = gowebblog_get_toolbox_repo_url( get_the_ID() );
									if ( $github_url && strpos( $github_url, 'github.com' ) !== false ) :
										// Check if we have a cached GitHub image
										$image_url = get_transient( 'github_image_url_' . get_the_ID() );
										if ( ! $image_url ) :
											// Try to get the GitHub image directly
											$response = wp_remote_get( $github_url );
											if ( ! is_wp_error( $response ) && 200 === wp_remote_retrieve_response_code( $response ) ) :
												$html = wp_remote_retrieve_body( $response );
												if ( preg_match( '/<meta property="og:image" content="([^"]+)"/', $html, $matches ) ) :
													$image_url = $matches[1];
													// Cache the image URL for 1 hour
													set_transient( 'github_image_url_' . get_the_ID(), $image_url, HOUR_IN_SECONDS );
												endif;
											endif;
										endif;
										
										if ( $image_url ) : ?>
											<a href="<?php the_permalink(); ?>" class="block w-full h-full">
												<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?> - GitHub Repository Image" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
											</a>
										<?php else : ?>
											<a href="<?php the_permalink(); ?>" class="block w-full h-full">
												<img src="https://imagezt.davidgo.web.id/800x600/ffffff/cccccc?text=<?php echo esc_attr( get_the_title() ); ?>&fontSize=38&textWrap=true&textWrapWidth=90" alt="<?php echo esc_attr( get_the_title() ); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
											</a>
										<?php endif; ?>
									<?php else : ?>
										<a href="<?php the_permalink(); ?>" class="block w-full h-full">
											<img src="https://imagezt.davidgo.web.id/800x600/ffffff/cccccc?text=<?php echo esc_attr( get_the_title() ); ?>&fontSize=38&textWrap=true&textWrapWidth=90" alt="<?php echo esc_attr( get_the_title() ); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
										</a>
									<?php endif; ?>
								<?php endif; ?>
							</div>
							
							<!-- Card Content -->
							<div class="p-6">
								<!-- Category Badge -->
								<?php
								$categories = get_the_terms( get_the_ID(), 'toolbox-category' );
								if ( $categories && ! is_wp_error( $categories ) ) : ?>
									<div class="mb-3">
										<span class="text-xs px-2 py-1 bg-white/10 rounded-full text-white/80">
											<?php echo esc_html( $categories[0]->name ); ?>
										</span>
									</div>
								<?php endif; ?>
								
								<!-- Title -->
								<h3 class="font-heading text-lg font-bold mb-2 line-clamp-2">
									<a href="<?php the_permalink(); ?>" class="text-white hover:text-primary transition-colors">
										<?php the_title(); ?>
									</a>
								</h3>
								
								<!-- Excerpt -->
								<p class="text-secondary text-sm leading-relaxed mb-4 line-clamp-3">
									<?php echo esc_html( wp_trim_words( get_the_excerpt(), 15, '...' ) ); ?>
								</p>
								
								<!-- Links -->
								<div class="flex gap-3">
									<?php
									$repo_url = gowebblog_get_toolbox_repo_url( get_the_ID() );
									$demo_url = gowebblog_get_toolbox_demo_url( get_the_ID() );
									
									if ( $repo_url ) : ?>
										<a href="<?php echo esc_url( $repo_url ); ?>" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition-colors" title="<?php esc_attr_e( 'GitHub Repository', 'gowebblog' ); ?>">
											<i class="fab fa-github text-sm"></i>
										</a>
									<?php endif; ?>
									
									<?php if ( $demo_url ) : ?>
										<a href="<?php echo esc_url( $demo_url ); ?>" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-full bg-primary/20 flex items-center justify-center hover:bg-primary/30 transition-colors" title="<?php esc_attr_e( 'Live Demo', 'gowebblog' ); ?>">
											<i class="fas fa-external-link-alt text-sm"></i>
										</a>
									<?php endif; ?>
									
									<a href="<?php the_permalink(); ?>" class="w-8 h-8 rounded-full border border-white/20 flex items-center justify-center hover:bg-white hover:text-black transition-all ml-auto" title="<?php esc_attr_e( 'View Details', 'gowebblog' ); ?>">
										<i class="fa-solid fa-arrow-right text-xs"></i>
									</a>
								</div>
							</div>
						</div>
						<?php
					endwhile;
					wp_reset_postdata();
				else :
					// Fallback to static toolbox items
					for ( $i = 1; $i <= 8; $i++ ) :
						?>
						<div class="group relative bg-card/50 backdrop-blur-sm rounded-2xl overflow-hidden border border-white/10 hover:border-white/20 transition-all duration-300 fade-in-section hover:shadow-xl hover:shadow-primary/10">
							<div class="aspect-[4/3] overflow-hidden">
								<img src="https://imagezt.davidgo.web.id/800x600/ffffff/cccccc?text=Project+<?php echo esc_attr( $i ); ?>&fontSize=38&textWrap=true&textWrapWidth=90" alt="<?php esc_attr_e( 'Project', 'gowebblog' ); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
							</div>
							<div class="p-6">
								<h3 class="font-heading text-lg font-bold mb-2">
									<a href="#" class="text-white hover:text-primary transition-colors">
										<?php printf( esc_html__( 'Project %d', 'gowebblog' ), $i ); ?>
									</a>
								</h3>
								<p class="text-secondary text-sm leading-relaxed mb-4">
									<?php esc_html_e( 'Project description goes here', 'gowebblog' ); ?>
								</p>
								<a href="#" class="inline-flex items-center gap-2 text-sm text-primary hover:underline">
									<span><?php esc_html_e( 'Learn More', 'gowebblog' ); ?></span>
									<i class="fa-solid fa-arrow-right text-xs"></i>
								</a>
							</div>
						</div>
						<?php
					endfor;
				endif;
				?>
			</div>
		</div>
	</section>

	<!-- Blog Section -->
	<section id="blog" class="py-24">
		<div class="max-w-7xl mx-auto px-6">
			<div class="mb-16 text-center fade-in-section">
				<h2 class="text-secondary uppercase tracking-widest text-sm font-semibold"><?php esc_html_e( 'Journal', 'gowebblog' ); ?></h2>
				<p class="font-heading text-4xl md:text-5xl font-bold mt-2"><?php esc_html_e( 'Latest News', 'gowebblog' ); ?></p>
			</div>

			<?php if ( have_posts() ) : ?>
				<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
					<?php
					// Start the Loop.
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content-home' );
					endwhile;
					?>
				</div>

				<!-- Pagination -->
				<div class="mt-16 flex justify-center">
					<?php
					the_posts_pagination(
						array(
							'mid_size'           => 2,
							'prev_text'          => __( '<i class="fa-solid fa-chevron-left"></i>', 'gowebblog' ),
							'next_text'          => __( '<i class="fa-solid fa-chevron-right"></i>', 'gowebblog' ),
							'screen_reader_text' => __( 'Posts navigation', 'gowebblog' ),
							'class'              => 'gowebblog-pagination',
						)
					);
					?>
				</div>

			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			<?php endif; ?>
		</div>
	</section>
<?php endif; ?>

<?php
get_footer();