<?php
/**
 * Class for the YBSelectedPosts.
 *
 * @package Yorickbrown\YBSelectedPosts\
 */

namespace YBSelectedPosts;

/**
 * Custom WP-CLI command for searching posts containing a specific Gutenberg block.
 */
class SelectedPostsQueryCommand extends \WP_CLI_Command {

	/**
	 * Search posts containing Selected Posts block between dates if provided.
	 *
	 * ## OPTIONS
	 *
	 * [--date-before=<date>]
	 * : Search for posts published before this date. (Default: 30 days ago)
	 *
	 * [--date-after=<date>]
	 * : Search for posts published after this date. (Default: none)
	 *
	 * ## EXAMPLES
	 *
	 * wp dmg-read-more search --date-before="2024-05-01" --date-after="2024-04-01"
	 *
	 * @param array $args       Command arguments.
	 * @param array $assoc_args Associative array of command options.
	 */
	public function search( $args, $assoc_args ) {

		// Parse date arguments
		$date_before = isset( $assoc_args['date-before'] ) ? $assoc_args['date-before'] : 'now';
		$date_after  = isset( $assoc_args['date-after'] ) ? $assoc_args['date-after'] : '-30 days';

		// Validate date format
		if ( ( isset( $assoc_args['date-before'] ) && ! $this->isValidDateFormat( $date_before ) ) || ( isset( $assoc_args['date-after'] ) && ! $this->isValidDateFormat( $date_after ) ) ) {
			\WP_CLI::error( 'Invalid date format. Please use YYYY-MM-DD format for date arguments.' );
			return;
		}

		// Create DateTime objects for the date range
		$date_before = new \DateTime( $date_before );
		$date_after  = new \DateTime( $date_after );

		// WP_Query arguments
		$query_args = array(
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'fields'         => 'ids',
			'posts_per_page' => 100,
			's'              => '<!-- wp:yb-selected-posts/selected-posts',
			'date_query'     => array(
				array(
					'after'     => $date_after->format( 'Y-m-d' ),
					'before'    => $date_before->format( 'Y-m-d' ),
					'inclusive' => true,
				),
			),
		);

		$paged       = 1;
		$total_pages = 1;

		// Initialize progress bar
		$progress = \WP_CLI\Utils\make_progress_bar( 'Processing', $total_pages );

		// Execute WP_Query for current batch
		$query = new \WP_Query( $query_args );

		if ( ! $query->have_posts() ) {
			// Only display the warning message if it's the first page
			\WP_CLI::warning( 'No posts found containing the specified Gutenberg block.' );
			return;
		}

		do {
			// Set current page
			$query_args['paged'] = $paged;

			// Process batch if posts found
			if ( $query->have_posts() ) {
				// Output matching Post IDs
				foreach ( $query->posts as $post_id ) {
					\WP_CLI::line( $post_id );
				}
			}
			// Increment page counter
			$paged++;
			$total_pages = $query->max_num_pages;

			// Update progress bar
			$progress->tick();

			// Reset post data
			wp_reset_postdata();
		} while ( $paged <= $total_pages );

		// Finish progress bar
		$progress->finish();
	}

	private function isValidDateFormat( $date ) {
		return \DateTime::createFromFormat( 'Y-m-d', $date ) !== false;
	}
}

// Register the WP-CLI command
\WP_CLI::add_command( 'dmg-read-more', 'YBSelectedPosts\SelectedPostsQueryCommand' );
