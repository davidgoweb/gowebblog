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
 * Register Toolbox Post Type
 */
function gowebblog_register_toolbox_post_type() {
	$labels = array(
		'name'                  => _x( 'Toolbox Items', 'Post type general name', 'gowebblog' ),
		'singular_name'         => _x( 'Toolbox Item', 'Post type singular name', 'gowebblog' ),
		'menu_name'             => _x( 'Toolbox', 'Admin Menu text', 'gowebblog' ),
		'name_admin_bar'        => _x( 'Toolbox Item', 'Add New on Toolbar', 'gowebblog' ),
		'add_new'               => __( 'Add New', 'gowebblog' ),
		'add_new_item'          => __( 'Add New Toolbox Item', 'gowebblog' ),
		'new_item'              => __( 'New Toolbox Item', 'gowebblog' ),
		'edit_item'             => __( 'Edit Toolbox Item', 'gowebblog' ),
		'view_item'             => __( 'View Toolbox Item', 'gowebblog' ),
		'all_items'             => __( 'All Toolbox Items', 'gowebblog' ),
		'search_items'          => __( 'Search Toolbox Items', 'gowebblog' ),
		'parent_item_colon'     => __( 'Parent Toolbox Items:', 'gowebblog' ),
		'not_found'             => __( 'No toolbox items found.', 'gowebblog' ),
		'not_found_in_trash'    => __( 'No toolbox items found in Trash.', 'gowebblog' ),
		'featured_image'        => _x( 'Toolbox Cover Image', 'Overrides the "Featured Image" phrase for this post type.', 'gowebblog' ),
		'set_featured_image'    => _x( 'Set cover image', 'Overrides the "Set featured image" phrase for this post type.', 'gowebblog' ),
		'remove_featured_image' => _x( 'Remove cover image', 'Overrides the "Remove featured image" phrase for this post type.', 'gowebblog' ),
		'use_featured_image'    => _x( 'Use as cover image', 'Overrides the "Use as featured image" phrase for this post type.', 'gowebblog' ),
		'archives'              => _x( 'Toolbox archives', 'The post type archive label used in nav menus.', 'gowebblog' ),
		'insert_into_item'      => _x( 'Insert into toolbox item', 'Overrides the "Insert into post"/"Insert into page" phrase (used when inserting media).', 'gowebblog' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this toolbox item', 'Overrides the "Uploaded to this post"/"Uploaded to this page" phrase (used when viewing media attached to a post).', 'gowebblog' ),
		'filter_items_list'     => _x( 'Filter toolbox items list', 'Screen reader text for the filter links heading on the post type listing screen.', 'gowebblog' ),
		'items_list_navigation' => _x( 'Toolbox items list navigation', 'Screen reader text for the pagination heading on the post type listing screen.', 'gowebblog' ),
		'items_list'            => _x( 'Toolbox items list', 'Screen reader text for the items list heading on the post type listing screen.', 'gowebblog' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'toolbox' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 20,
		'menu_icon'          => 'dashicons-portfolio',
		'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'toolbox', $args );
}
add_action( 'init', 'gowebblog_register_toolbox_post_type' );

/**
 * Register Toolbox Taxonomies
 */
function gowebblog_register_toolbox_taxonomies() {
	// Toolbox Categories
	$labels = array(
		'name'              => _x( 'Toolbox Categories', 'taxonomy general name', 'gowebblog' ),
		'singular_name'     => _x( 'Toolbox Category', 'taxonomy singular name', 'gowebblog' ),
		'search_items'      => __( 'Search Toolbox Categories', 'gowebblog' ),
		'all_items'         => __( 'All Toolbox Categories', 'gowebblog' ),
		'parent_item'       => __( 'Parent Toolbox Category', 'gowebblog' ),
		'parent_item_colon' => __( 'Parent Toolbox Category:', 'gowebblog' ),
		'edit_item'         => __( 'Edit Toolbox Category', 'gowebblog' ),
		'update_item'       => __( 'Update Toolbox Category', 'gowebblog' ),
		'add_new_item'      => __( 'Add New Toolbox Category', 'gowebblog' ),
		'new_item_name'     => __( 'New Toolbox Category Name', 'gowebblog' ),
		'menu_name'         => __( 'Toolbox Categories', 'gowebblog' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'toolbox-category' ),
		'show_in_rest'      => true,
	);

	register_taxonomy( 'toolbox-category', array( 'toolbox' ), $args );

	// Toolbox Tags
	$labels = array(
		'name'              => _x( 'Toolbox Tags', 'taxonomy general name', 'gowebblog' ),
		'singular_name'     => _x( 'Toolbox Tag', 'taxonomy singular name', 'gowebblog' ),
		'search_items'      => __( 'Search Toolbox Tags', 'gowebblog' ),
		'all_items'         => __( 'All Toolbox Tags', 'gowebblog' ),
		'parent_item'       => null,
		'parent_item_colon' => null,
		'edit_item'         => __( 'Edit Toolbox Tag', 'gowebblog' ),
		'update_item'       => __( 'Update Toolbox Tag', 'gowebblog' ),
		'add_new_item'      => __( 'Add New Toolbox Tag', 'gowebblog' ),
		'new_item_name'     => __( 'New Toolbox Tag Name', 'gowebblog' ),
		'menu_name'         => __( 'Toolbox Tags', 'gowebblog' ),
	);

	$args = array(
		'hierarchical'      => false,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'toolbox-tag' ),
		'show_in_rest'      => true,
	);

	register_taxonomy( 'toolbox-tag', array( 'toolbox' ), $args );
}
add_action( 'init', 'gowebblog_register_toolbox_taxonomies' );

/**
 * Add meta boxes for toolbox custom fields
 */
function gowebblog_add_toolbox_meta_boxes() {
	add_meta_box(
		'toolbox_urls',
		__( 'Toolbox URLs', 'gowebblog' ),
		'gowebblog_toolbox_urls_callback',
		'toolbox',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'gowebblog_add_toolbox_meta_boxes' );

/**
 * Meta box callback function
 */
function gowebblog_toolbox_urls_callback( $post ) {
	wp_nonce_field( 'gowebblog_save_toolbox_urls', 'gowebblog_toolbox_urls_nonce' );
	
	$repo_url = get_post_meta( $post->ID, '_toolbox_repo_url', true );
	$demo_url = get_post_meta( $post->ID, '_toolbox_demo_url', true );
	$how_i_use = get_post_meta( $post->ID, '_toolbox_how_i_use', true );
	
	?>
	<table class="form-table">
		<tr>
			<th scope="row">
				<label for="toolbox_repo_url"><?php esc_html_e( 'Repository URL', 'gowebblog' ); ?></label>
			</th>
			<td>
				<input type="url" id="toolbox_repo_url" name="toolbox_repo_url" value="<?php echo esc_attr( $repo_url ); ?>" class="regular-text" />
				<p class="description"><?php esc_html_e( 'Enter the URL to the repository (e.g., GitHub, GitLab)', 'gowebblog' ); ?></p>
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="toolbox_demo_url"><?php esc_html_e( 'Demo URL', 'gowebblog' ); ?></label>
			</th>
			<td>
				<input type="url" id="toolbox_demo_url" name="toolbox_demo_url" value="<?php echo esc_attr( $demo_url ); ?>" class="regular-text" />
				<p class="description"><?php esc_html_e( 'Enter the URL to the live demo (optional)', 'gowebblog' ); ?></p>
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="toolbox_how_i_use"><?php esc_html_e( 'How I Use This Tool', 'gowebblog' ); ?></label>
			</th>
			<td>
				<textarea id="toolbox_how_i_use" name="toolbox_how_i_use" rows="6" class="large-text"><?php echo esc_textarea( $how_i_use ); ?></textarea>
				<p class="description"><?php esc_html_e( 'Describe how you use this tool in your personal discoveries and workflows', 'gowebblog' ); ?></p>
			</td>
		</tr>
	</table>
	<?php
}

/**
 * Save toolbox meta fields
 */
function gowebblog_save_toolbox_urls( $post_id ) {
	if ( ! isset( $_POST['gowebblog_toolbox_urls_nonce'] ) || ! wp_verify_nonce( $_POST['gowebblog_toolbox_urls_nonce'], 'gowebblog_save_toolbox_urls' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['toolbox_repo_url'] ) ) {
		update_post_meta( $post_id, '_toolbox_repo_url', esc_url_raw( $_POST['toolbox_repo_url'] ) );
	}

	if ( isset( $_POST['toolbox_demo_url'] ) ) {
		update_post_meta( $post_id, '_toolbox_demo_url', esc_url_raw( $_POST['toolbox_demo_url'] ) );
	}

	if ( isset( $_POST['toolbox_how_i_use'] ) ) {
		update_post_meta( $post_id, '_toolbox_how_i_use', wp_kses_post( $_POST['toolbox_how_i_use'] ) );
	}
}
add_action( 'save_post', 'gowebblog_save_toolbox_urls' );

/**
 * Flush rewrite rules on theme activation to ensure toolbox post type works
 */
function gowebblog_flush_rewrite_rules() {
	gowebblog_register_toolbox_post_type();
	gowebblog_register_toolbox_taxonomies();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'gowebblog_flush_rewrite_rules' );