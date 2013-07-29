<?php
/**
 * Implements hello-dolly command.
 *
 * @package wp-cli
 */

class Hello_Dolly_Command extends WP_CLI_Command {

	public $sheep;

	/**
	 * creating an instance of hello dolly
	 */
	function __construct() {
		$this->sheep = new Sheep;
	}

	/**
	 * Prints a lyrics
	 *
	 * @synopsis
	 *
	 * @alias lyrics
	 */
	function lyrics( $args, $assoc_args ) {

		$lyrics = html_entity_decode($this->sheep->hello_dolly(true));
		// Print a success message
		WP_CLI::success( $lyrics );

	}
}

WP_CLI::add_command( 'hello-dolly', 'Hello_Dolly_Command' );