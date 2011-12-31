<?php
/*
 * SMF Package Manager Generator
 * Author: SleePy (JeremyD)
 * Repository: https://github.com/jdarwood007/smf_package_maker
 * License: BSD 3 Clause; See license.txt
*/
define('PacManGen', true);

require_once(dirname(__FILE__) . '/settings.php');

// Only invoke the download when it is enabled and we are going to try to do it.
if (!$use_php || !isset($_GET['download']))
	exit ('Invalid Download content');

// Give them a download.
header('Cache-Control: ');
header('Content-type: text/plain');
header ('Content-Disposition: attachment; filename="install.xml"');
exit($_POST['content']);