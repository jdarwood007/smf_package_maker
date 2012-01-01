<?php
/*
 * SMF Package Manager Generator
 * Author: SleePy (JeremyD)
 * Repository: https://github.com/jdarwood007/smf_package_maker
 * License: BSD 3 Clause; See license.txt
*/
if (!defined('PacManGen')) { exit('[' . basename(__FILE__) . '] Direct access restricted');}

/* WordPress Integration
 * http://sleepycode.com/2011/11/wordpress-templates-on-non-wordpress-pages/
*/
require_once('../wp-ssi.php');

// Load the headers up.
function pacman_header($headers)
{
	if (!empty($headers['css']))
		foreach ($headers['css'] as $css)
			wp_enqueue_style($css['name'], $css['href']);
		
	if (!empty($headers['js']))
		foreach ($headers['js'] as $js)
				wp_enqueue_script($js['src'], $js['src']);
}

// We do nothing for the footer.
function pacman_footer()
{
}
