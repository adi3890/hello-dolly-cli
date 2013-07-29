<?php
/**
 * @package Hello_Dolly
 * @version 1.6
 */
/*
Plugin Name: Hello Dolly
Plugin URI: http://wordpress.org/extend/plugins/hello-dolly/
Description: This is not just a plugin, it symbolizes the hope and enthusiasm of an entire generation summed up in two words sung most famously by Louis Armstrong: Hello, Dolly. When activated you will randomly see a lyric from <cite>Hello, Dolly</cite> in the upper right of your admin screen on every page.
Author: Matt Mullenweg
Version: 1.6
Author URI: http://ma.tt/
*/

if ( defined('WP_CLI') && WP_CLI ) {
	include __DIR__ . '/cli-command.php';
}

class Sheep {

	function __construct(){
		// Now we set that function up to execute when the admin_notices action is called
		add_action( 'admin_notices', array($this, 'hello_dolly' ));
		add_action( 'admin_head', array($this, 'dolly_css' ));
	}

	function hello_dolly_get_lyric() {
		/** These are the lyrics to Hello Dolly */
		$lyrics = "Hello, Dolly
		Well, hello, Dolly
		It's so nice to have you back where you belong
		You're lookin' swell, Dolly
		I can tell, Dolly
		You're still glowin', you're still crowin'
		You're still goin' strong
		We feel the room swayin'
		While the band's playin'
		One of your old favourite songs from way back when
		So, take her wrap, fellas
		Find her an empty lap, fellas
		Dolly'll never go away again
		Hello, Dolly
		Well, hello, Dolly
		It's so nice to have you back where you belong
		You're lookin' swell, Dolly
		I can tell, Dolly
		You're still glowin', you're still crowin'
		You're still goin' strong
		We feel the room swayin'
		While the band's playin'
		One of your old favourite songs from way back when
		Golly, gee, fellas
		Find her a vacant knee, fellas
		Dolly'll never go away
		Dolly'll never go away
		Dolly'll never go away again";

		// Here we split it into lines
		$lyrics = explode( "\n", $lyrics );

		// And then randomly choose a line
		return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
	}

	// This just echoes the chosen line, we'll position it later
	function hello_dolly($cli = false) {
		$chosen = $this->hello_dolly_get_lyric();
		if($cli) {
			return $chosen;
		} else {
			echo "<p id='dolly'>$chosen</p>";
		}
		
	}



	// We need some CSS to position the paragraph
	function dolly_css() {
		// This makes sure that the positioning is also good for right-to-left languages
		$x = is_rtl() ? 'left' : 'right';

		echo "
		<style type='text/css'>
		#dolly {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;		
		margin: 0;
		font-size: 11px;
		}
		</style>
		";
	}

}

$sheep = new Sheep;

?>