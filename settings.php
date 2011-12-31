<?php
/*
 * SMF Package Manager Generator
 * Author: SleePy (JeremyD)
 * Repository: https://github.com/jdarwood007/smf_package_maker
 * License: BSD 3 Clause; See license.txt
*/
if (!defined('PacManGen')) { exit('[' . basename(__FILE__) . '] Direct access restricted');}

// Assets URL location.
$pmg['assets'] = 'http://sleepycode.com/PacManGen/assets';

// The name of this script (can also be the url).
$pmg['scriptname'] = 'index.php';

// The name of this script (can also be the url).
$pmg['downloadname'] = 'downloader.php';

// Style to use.
$pmg['style'] = 'default';

// Integration with another site.
$pmg['theme_integration'] = true;

// If we are integrating, what file to include.  Needs to have pacman_header and pacmanfooter
$pmg['theme_integration_file'] = '__integrate.php';

// How to handle downloads..
$pmg['use_php'] = true;

// The page title.
$pmg['page_title'] = 'SleePyCode Package Manager Generator';

// Commenting out logo will remove it.
$pmg['logo'] = $pmg['assets'] . '/logo.png';
$pmg['logo_url'] = 'http://sleepycode.com';

// Language we selected.
$pmg['language'] = 'english';