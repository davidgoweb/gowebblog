<?php
/**
 * Custom Post Types for Gowebblog Theme
 *
 * @package Gowebblog
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Project Post Type
 */
function gowebblog_register_project_post_type() {
	$labels = array(
		'name'                  => _x( 'Projects', 'Post type general name', 'gowebblog' ),
		'singular_name'         => _x( 'Project', 'Post type singular name', 'gowebblog' ),
		'menu_name'             => _x( 'Projects', 'Admin Menu text', 'gowebblog' ),
		'name_admin_bar'        => _x( 'Project', 'Add New on Toolbar', 'gowebblog' ),
		'add_new'               => __( 'Add New', 'gowebblog' ),
		'add_new_item'          => __( 'Add New Project', 'gowebblog' ),
		'new_item'              => __( 'New Project', 'gowebblog' ),
		'edit_item'             => __( 'Edit Project', 'gowebblog' ),
		'view_item'             => __( 'View Project', 'gowebblog' ),
		'all_items'             => __( 'All Projects', 'gowebblog' ),
		'search_items'          => __( 'Search Projects', 'gowebblog' ),
		'parent_item_colon'     => __( 'Parent Projects:', 'gowebblog' ),
		'not_found'             => __( 'No projects found.', 'gowebblog' ),
		'not_found_in_trash'    => __( 'No projects found in Trash.', 'gowebblog' ),
		'featured_image'        => _x( 'Project Cover Image', 'Overrides the "Featured Image" phrase for this post type.', 'gowebblog' ),
		'set_featured_image'    => _x( 'Set cover image', 'Overrides the "Set featured image" phrase for this post type.', 'gowebblog' ),
		'remove_featured_image' => _x( 'Remove cover image', 'Overrides the "Remove featured image" phrase for this post type.', 'gowebblog' ),
		'use_featured_image'    => _x( 'Use as cover image', 'Overrides the "Use as featured image" phrase for this post type.', 'gowebblog' ),
		'archives'              => _x( 'Project archives', 'The post type archive label used in nav menus.', 'gowebblog' ),
		'insert_into_item'      => _x( 'Insert into project', 'Overrides the "Insert into post"/"Insert into page" phrase (used when inserting media).', 'gowebblog' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this project', 'Overrides the "Uploaded to this post"/"Uploaded to this page" phrase (used when viewing media attached to a post).', 'gowebblog' ),
		'filter_items_list'     => _x( 'Filter projects list', 'Screen reader text for the filter links heading on the post type listing screen.', 'gowebblog' ),
		'items_list_navigation' => _x( 'Projects list navigation', 'Screen reader text for the pagination heading on the post type listing screen.', 'gowebblog' ),
		'items_list'            => _x( 'Projects list', 'Screen reader text for the items list heading on the post type listing screen.', 'gowebblog' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'project' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 20,
		'menu_icon'          => 'dashicons-portfolio',
		'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'project', $args );
}
add_action( 'init', 'gowebblog_register_project_post_type' );

/**
 * Register Project Taxonomies
 */
function gowebblog_register_project_taxonomies() {
	// Project Categories
	$labels = array(
		'name'              => _x( 'Project Categories', 'taxonomy general name', 'gowebblog' ),
		'singular_name'     => _x( 'Project Category', 'taxonomy singular name', 'gowebblog' ),
		'search_items'      => __( 'Search Project Categories', 'gowebblog' ),
		'all_items'         => __( 'All Project Categories', 'gowebblog' ),
		'parent_item'       => __( 'Parent Project Category', 'gowebblog' ),
		'parent_item_colon' => __( 'Parent Project Category:', 'gowebblog' ),
		'edit_item'         => __( 'Edit Project Category', 'gowebblog' ),
		'update_item'       => __( 'Update Project Category', 'gowebblog' ),
		'add_new_item'      => __( 'Add New Project Category', 'gowebblog' ),
		'new_item_name'     => __( 'New Project Category Name', 'gowebblog' ),
		'menu_name'         => __( 'Project Categories', 'gowebblog' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'project-category' ),
		'show_in_rest'      => true,
	);

	register_taxonomy( 'project-category', array( 'project' ), $args );

	// Project Tags
	$labels = array(
		'name'              => _x( 'Project Tags', 'taxonomy general name', 'gowebblog' ),
		'singular_name'     => _x( 'Project Tag', 'taxonomy singular name', 'gowebblog' ),
		'search_items'      => __( 'Search Project Tags', 'gowebblog' ),
		'all_items'         => __( 'All Project Tags', 'gowebblog' ),
		'parent_item'       => null,
		'parent_item_colon' => null,
		'edit_item'         => __( 'Edit Project Tag', 'gowebblog' ),
		'update_item'       => __( 'Update Project Tag', 'gowebblog' ),
		'add_new_item'      => __( 'Add New Project Tag', 'gowebblog' ),
		'new_item_name'     => __( 'New Project Tag Name', 'gowebblog' ),
		'menu_name'         => __( 'Project Tags', 'gowebblog' ),
	);

	$args = array(
		'hierarchical'      => false,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'project-tag' ),
		'show_in_rest'      => true,
	);

	register_taxonomy( 'project-tag', array( 'project' ), $args );
}
add_action( 'init', 'gowebblog_register_project_taxonomies' );

/**
 * Add meta boxes for project custom fields
 */
function gowebblog_add_project_meta_boxes() {
	add_meta_box(
		'project_urls',
		__( 'Project URLs', 'gowebblog' ),
		'gowebblog_project_urls_callback',
		'project',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'gowebblog_add_project_meta_boxes' );

/**
 * Meta box callback function
 */
function gowebblog_project_urls_callback( $post ) {
	wp_nonce_field( 'gowebblog_save_project_urls', 'gowebblog_project_urls_nonce' );
	
	$repo_url = get_post_meta( $post->ID, '_project_repo_url', true );
	$demo_url = get_post_meta( $post->ID, '_project_demo_url', true );
	
	?>
	<table class="form-table">
		<tr>
			<th scope="row">
				<label for="project_repo_url"><?php esc_html_e( 'Repository URL', 'gowebblog' ); ?></label>
			</th>
			<td>
				<input type="url" id="project_repo_url" name="project_repo_url" value="<?php echo esc_attr( $repo_url ); ?>" class="regular-text" />
				<p class="description"><?php esc_html_e( 'Enter the URL to the project repository (e.g., GitHub, GitLab)', 'gowebblog' ); ?></p>
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="project_demo_url"><?php esc_html_e( 'Demo URL', 'gowebblog' ); ?></label>
			</th>
			<td>
				<input type="url" id="project_demo_url" name="project_demo_url" value="<?php echo esc_attr( $demo_url ); ?>" class="regular-text" />
				<p class="description"><?php esc_html_e( 'Enter the URL to the live demo (optional)', 'gowebblog' ); ?></p>
			</td>
		</tr>
	</table>
	<?php
}

/**
 * Save project meta fields
 */
function gowebblog_save_project_urls( $post_id ) {
	if ( ! isset( $_POST['gowebblog_project_urls_nonce'] ) || ! wp_verify_nonce( $_POST['gowebblog_project_urls_nonce'], 'gowebblog_save_project_urls' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['project_repo_url'] ) ) {
		update_post_meta( $post_id, '_project_repo_url', esc_url_raw( $_POST['project_repo_url'] ) );
	}

	if ( isset( $_POST['project_demo_url'] ) ) {
		update_post_meta( $post_id, '_project_demo_url', esc_url_raw( $_POST['project_demo_url'] ) );
	}
}
add_action( 'save_post', 'gowebblog_save_project_urls' );

/**
 * Flush rewrite rules on theme activation to ensure project post type works
 */
function gowebblog_flush_rewrite_rules() {
	gowebblog_register_project_post_type();
	gowebblog_register_project_taxonomies();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'gowebblog_flush_rewrite_rules' );