<?php
/**
 * Plugin Name:       YB Selected Posts
 * Description:       Block for adding a link to published posts.
 * Requires at least: 6.5
 * Requires PHP:      7.0
 * Version:           1.0.0
 * Author:            Yorick Brown
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       yb-selected-posts
 *
 * @package YBSelectedPosts
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function create_block_yb_selected_posts_block_init() {
	register_block_type( __DIR__ . '/build' );
}
add_action( 'init', 'create_block_yb_selected_posts_block_init' );
