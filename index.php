<?php
/*
 * SMF Package Manager Generator
 * Author: SleePy (JeremyD)
 * Repository: https://github.com/jdarwood007/smf_package_maker
 * License: BSD 3 Clause; See license.txt
*/
define('PacManGen', true);

// Default our action.
$pmg_action = 'index';
if (isset($_GET['action']) && in_array($_GET['action'], array('mod', 'info')))
	$pmg_action = $_GET['action'];

// Load up some files.
require_once(dirname(__FILE__) . '/settings.php');
require_once(dirname(__FILE__) . '/_' . $pmg_action . 'maker.php');
require_once(dirname(__FILE__) . '/language/' . $pmg['language'] . '.php');

if (!empty($pmg['theme_integration']) && isset($pmg['theme_integration_file']) && file_exists($pmg['theme_integration_file']))
	require_once($pmg['theme_integration_file']);

$headers['css'][] = array('name' => $pmg['style'] . '-css', 'href' => $pmg['assets'] . '/' . $pmg['style'] . '.css', 'media' => 'all');

// We don't need these on the index.
if ($pmg_action != 'index')
{
	$headers['js'][] = array('name' => 'jquery', 'src' => $pmg['assets'] . '/jquery.min.js');
	$headers['js'][] = array('name' => 'generatefile', 'src' => $pmg['assets'] . '/' . ($pmg['use_php'] ? 'jquery.generateFile.js' : 'jquery.base64.js'));
	$headers['js'][] = array('name' => 'script', 'src' => $pmg['assets'] . '/script_' . $pmg_action . '.js');
}

if (!empty($pmg['theme_integration']) && function_exists('pacman_header'))
	pacman_header($headers);
else
{
	default_pacman_header($headers);
	default_pacman_body_upper();
}

	echo '
		<div id="pacmangen" class="action_', $pmg_action, '">';

// If we are using the PHP downloader, we need this.
if (!empty($pmg['use_php']))
	echo '
			<input type="hidden" id="downloadername" value="', $pmg['downloadname'], '" />';

// Call up the right section.
$function = $pmg_action . '_section';
$function();

echo '
		</div>';

// Bring in the correct templates.
$function = $pmg_action . '_templates';
$function();

if (!empty($pmg['theme_integration']) && function_exists('pacman_footer'))
	pacman_footer();
else
{
	default_pacman_body_lower();
	default_pacman_footer();
}

function default_pacman_header($headers)
{
	global $pmg, $locale, $charset, $text;

	echo '
<!DOCTYPE html><!-- HTML 5 -->
<html dir="ltr" lang="', $locale, '">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=', $charset, '">
	<title>', $pmg['page_title'], '</title>';

	if (!empty($headers['css']))
		default_pacman_header_css($headers['css']);

	if (!empty($headers['js']))
		default_pacman_header_js($headers['js']);

	if (!empty($headers['others']) && is_array($headers['others']))
		echo explode('
		', $headers['others']);

	echo '
	<meta name="viewport" content="width=device-width,initial-scale=1">
</head>';
}

function default_pacman_header_css($headers)
{
	foreach ($headers as $css)
		echo '
		<link rel="stylesheet" id="', $css['name'], '" href="', $css['href'], '" type="text/css" media="', !empty($css['media']) ? $css['media'] : 'all', '">';
}

function default_pacman_header_js($headers)
{
	foreach ($headers as $js)
		echo '
		<script type="text/javascript" src="', $js['src'], '"></script>';
}

function default_pacman_body_upper()
{
	global $pmg, $text;

	echo '
<body class="home blog">
<div id="wrapper">
	<div id="header">
		<div id="head">
			<div id="logo">';

	if (!empty($pmg['logo']))
		echo '
				<a href="', $pmg['logo_url'], '"><img src="', $pmg['logo'], '" alt="', $pmg['page_title'], '" class="alignleft"></a>';

	echo '
				<h1><a href="', $pmg['scriptname'], '">', $text['script_name'], '</a></h1></div>
		</div>
		<div class="clear"></div>
	</div>
	<div id="container">';
}

function default_pacman_body_lower()
{
	echo '
	</div>
</div>
<div id="footer">
	<!-- Please give credit where credit is due -->
	<div id="foot"><span class="alignright"><a href="https://sleepycode.com">SMF Package Manager Generator by JeremyD (SleePy)</a></span></div>
	<div class="clear"></div>
	</div>
</div>';
}

function default_pacman_footer()
{
	echo '
</body>
</html>';
}