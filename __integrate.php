<?php
/*
 * SMF Package Manager Generator
 * Author: SleePy (JeremyD)
 * Repository: https://github.com/jdarwood007/smf_package_maker
 * License: BSD 3 Clause; See license.txt
*/
if (!defined('PacManGen')) { exit('[' . basename(__FILE__) . '] Direct access restricted');}

/*
 * WordPress Integration
 * http://sleepycode.com/2011/11/wordpress-templates-on-non-wordpress-pages
*/
$specialPage['headerTitle'] = 'SMF PacMan';
$specialPage['pageTitlePrefix'] = 'SMF PacMan';
require_once('../wp-ssi.php');

// Our sauce link.
$specialPage['source'] = 'See the source code: [<a href="http://git.sleepycode.com/?a=summary&p=SMF%20Package%20Manager%20Generator">Local</a>] [<a href="https://github.com/jdarwood007/smf_package_maker">GitHub</a>]';

// Load the headers up.
function pacman_header($headers)
{
	// Using Wordpress, we simply just add the hook and go.
	add_action('wp_head', 'pacman_wp_int');
}

// We do nothing for the footer.
function pacman_footer()
{
}

// An integrationn function for WordPress.
function pacman_wp_int()
{
	global $headers;

	if (!empty($headers['css']))
		foreach ($headers['css'] as $css)
			echo '
		<link rel="stylesheet" id="', $css['name'], '"  href="', $css['href'], '" type="text/css" media="all" />';

	if (!empty($headers['js']))
		foreach ($headers['js'] as $js)
			if ($js['name'] != 'jquery')
				echo '
		<script type="text/javascript" src="', $js['src'], '"></script>';

	// Pretty source code. I care about that.
	if (!empty($headers['css']) && !empty($headers['js']))
		echo '
';

}
