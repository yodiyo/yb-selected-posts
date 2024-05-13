<?php
/**
 * Primary class file for the YBSelectedPosts.
 *
 * @package Yorickbrown\YBSelectedPosts\
 */

namespace YBSelectedPosts;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use YBSelectedPosts\SelectedPostsQueryCommand;

/**
 * Class Plugin
 */
class Plugin {

	/**
	 * WPCLI Cmmand.
	 *
	 * @var WpcliSelectedPostsQuery;
	 */
	public $wpcli_command;

	/**
	 * Constructor.
	 */
	public function __construct() {
		// Register Admin.
		$this->wpcli_command = new SelectedPostsQueryCommand();
	}
}
