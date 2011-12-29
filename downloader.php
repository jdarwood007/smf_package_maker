<?php
/*
 * SMF Package Manager Generator
 * Author: SleePy (JeremyD)
 * Repository: https://github.com/jdarwood007/smf_package_maker
 * License: BSD 3 Clause; See license.txt
*/
require_once(dirname(__FILE__) . '/settings.php');

// Only invoke the download when it is enabled and we are going to try to do it.
if (!$use_php || !isset($_GET['download']))
	exit ('Invalid Download content');

// We should at least try to verify the referrer
if (!isset($_SERVER['HTTP_REFERER']) || strpos($_SERVER['HTTP_REFERER'], $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME']) === false)
	exit('Invalid Request Detected');

// Give them a download.
header('Cache-Control: ');
header('Content-type: text/plain');
header ('Content-Disposition: attachment; filename="install.xml"');
exit($_POST['content']);