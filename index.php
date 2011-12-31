<?php
/*
 * SMF Package Manager Generator
 * Author: SleePy (JeremyD)
 * Repository: https://github.com/jdarwood007/smf_package_maker
 * License: BSD 3 Clause; See license.txt
*/
define('PacManGen', true);

// Default our action.
if (!isset($_GET['action']) || !in_array($_GET['action'], array('mod', 'info')))
	$action = 'index';
else
	$action = $_GET['action'];

// Load up some files.
require_once(dirname(__FILE__) . '/settings.php');
require_once(dirname(__FILE__) . '/_' . $action . 'maker.php');
require_once(dirname(__FILE__) . '/language/' . $language . '.php');

echo '
<!DOCTYPE html><!-- HTML 5 -->
<html dir="ltr" lang="', $locale, '">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=', $charset, '">
	<title>', $page_title, '</title>
	<link rel="stylesheet" id="', $style, '-css" href="', $assets, '/', $style, '.css" type="text/css" media="all">';

// We don't need these on the index.
if ($action != 'index')
	echo '
	<script type="text/javascript" src="', $assets, '/jquery.min.js"></script>
	<script type="text/javascript" src="', $assets, '/', $use_php ? 'jquery.generateFile.js' : 'jquery.base64.js', '"></script>
	<script type="text/javascript" src="', $assets, '/script_', $action, '.js"></script>';

echo '
	<meta name="viewport" content="width=device-width,initial-scale=1">
</head>

<body class="home blog">
<div id="wrapper">
	<div id="header">
		<div id="head">
			<div id="logo">';

if (!empty($logo))
	echo '
				<a href="', $logo_url, '"><img src="', $logo, '" alt="', $page_title, '" class="alignleft"></a>';

echo '
				<h1><a href="', $scriptname, '">', $text['script_name'], '</a></h1></div>
		</div>
		<div class="clear"></div>
	</div>
	<div id="container">
		<div id="wrap" class="action_', $action, '">';

// If we are using the PHP downloader, we need this.
if ($use_php)
	echo '
			<input type="hidden" id="downloadername" value="', $downloadname, '" />';

// Call up the right section.
$function = $action . '_section';
$function();

echo '
		</div>
	</div>
</div>
<div id="footer">
	<!-- Please give credit where credit is due -->
	<div id="foot"><span class="alignright"><a href="http://sleepycode.com">SMF Package Manager Generator by JeremyD (SleePy)</a></span></div>
	<div class="clear"></div>
	</div>
</div>';

// Bring in the correct templates.
$function = $action . '_templates';
$function();

echo '
</body>
</html>';
