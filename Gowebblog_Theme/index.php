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
							'prev_text'          => __( '<i class="fa-solid fa-arrow-left"></i> Previous', 'gowebblog' ),
							'next_text'          => __( 'Next <i class="fa-solid fa-arrow-right"></i>', 'gowebblog' ),
							'screen_reader_text' => __( 'Posts navigation', 'gowebblog' ),
							'class'              => 'flex gap-2 text-sm font-medium',
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
				<h4 class="text-secondary text-lg mb-4 font-medium tracking-wide"><?php esc_html_e( 'Hello, I\'m', 'gowebblog' ); ?></h4>
				<h1 class="font-heading text-6xl md:text-6xl font-bold mb-6 leading-none">
					<?php bloginfo( 'name' ); ?> <br> <span class="text-secondary"><?php esc_html_e( 'Portal', 'gowebblog' ); ?></span>
				</h1>
				<p class="text-secondary text-lg md:text-xl leading-relaxed mb-8 max-w-lg">
					<?php
					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) :
						echo esc_html( $description );
					else :
						esc_html_e( 'Tech enthusiast and architecture-minded builder based in Jakarta. I blend market insight with solid technical structure to help brands turn ideas into high-quality, scalable products.', 'gowebblog' );
					endif;
					?>
				</p>

				<!-- Skills Tags -->
				<div class="flex flex-wrap gap-3 mb-10">
					<span class="px-4 py-2 bg-card rounded-full text-sm text-secondary border border-white/5"><?php esc_html_e( 'Web Development', 'gowebblog' ); ?></span>
					<span class="px-4 py-2 bg-card rounded-full text-sm text-secondary border border-white/5"><?php esc_html_e( 'Open Source', 'gowebblog' ); ?></span>
					<span class="px-4 py-2 bg-card rounded-full text-sm text-secondary border border-white/5"><?php esc_html_e( 'Tech Architecture', 'gowebblog' ); ?></span>
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
	<section id="toolbox" class="py-24">
		<div class="max-w-7xl mx-auto px-6">
			<div class="flex flex-col md:flex-row md:items-end justify-between mb-16 fade-in-section">
				<div>
					<h2 class="text-secondary uppercase tracking-widest text-sm font-semibold"><?php esc_html_e( 'Toolbox', 'gowebblog' ); ?></h2>
					<span class="font-heading text-4xl md:text-5xl font-bold mt-2"><?php esc_html_e( 'Discoveries', 'gowebblog' ); ?></span>
				</div>
			</div>

			<div class="grid md:grid-cols-2 gap-8">
				<?php
				// Display portfolio projects from toolbox post type
				$portfolio_args = array(
					'post_type'      => 'toolbox',
					'posts_per_page' => 4,
					'orderby'        => 'date',
					'order'          => 'DESC',
				);

				$portfolio_query = new WP_Query( $portfolio_args );

				if ( $portfolio_query->have_posts() ) :
					$project_count = 0;
					while ( $portfolio_query->have_posts() ) :
						$portfolio_query->the_post();
						$project_count++;
						?>
						<a href="<?php the_permalink(); ?>" class="group block fade-in-section <?php echo ( $project_count % 2 === 0 ) ? 'mt-0 md:mt-16' : ''; ?>">
							<div class="img-zoom-container rounded-2xl overflow-hidden mb-6 aspect-[4/3]">
								<?php if ( has_post_thumbnail() ) : ?>
									<img src="<?php echo esc_url( get_the_post_thumbnail_url( null, 'large' ) ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" class="img-zoom w-full h-full object-cover">
								<?php else : ?>
									<img src="https://dummyimage.com/800x600/ffffff/ccc?text=<?php echo esc_attr( get_the_title() ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" class="img-zoom w-full h-full object-cover">
								<?php endif; ?>
							</div>
							<div class="flex justify-between items-start">
								<div>
									<h3 class="text-2xl font-bold mb-1 group-hover:text-white/80 transition-colors"><?php the_title(); ?></h3>
									<p class="text-secondary text-sm"><?php echo esc_html( get_the_excerpt() ); ?></p>
								</div>
								<span class="h-10 w-10 rounded-full border border-white/20 flex items-center justify-center group-hover:bg-white group-hover:text-black transition-all">
									<i class="fa-solid fa-arrow-right"></i>
								</span>
							</div>
						</a>
						<?php
					endwhile;
					wp_reset_postdata();
				else :
					// Fallback to static toolbox items
					for ( $i = 1; $i <= 4; $i++ ) :
						?>
						<a href="#" class="group block fade-in-section <?php echo ( $i % 2 === 0 ) ? 'mt-0 md:mt-16' : ''; ?>">
							<div class="img-zoom-container rounded-2xl overflow-hidden mb-6 aspect-[4/3]">
								<img src="https://dummyimage.com/800x600/ffffff/ccc?text=Project+<?php echo esc_attr( $i ); ?>" alt="<?php esc_attr_e( 'Project', 'gowebblog' ); ?>" class="img-zoom w-full h-full object-cover">
							</div>
							<div class="flex justify-between items-start">
								<div>
									<h3 class="text-2xl font-bold mb-1 group-hover:text-white/80 transition-colors"><?php printf( esc_html__( 'Project %d', 'gowebblog' ), $i ); ?></h3>
									<p class="text-secondary text-sm"><?php esc_html_e( 'Project description goes here', 'gowebblog' ); ?></p>
								</div>
								<span class="h-10 w-10 rounded-full border border-white/20 flex items-center justify-center group-hover:bg-white group-hover:text-black transition-all">
									<i class="fa-solid fa-arrow-right"></i>
								</span>
							</div>
						</a>
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
							'prev_text'          => __( '<i class="fa-solid fa-arrow-left"></i> Previous', 'gowebblog' ),
							'next_text'          => __( 'Next <i class="fa-solid fa-arrow-right"></i>', 'gowebblog' ),
							'screen_reader_text' => __( 'Posts navigation', 'gowebblog' ),
							'class'              => 'flex gap-2 text-sm font-medium',
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