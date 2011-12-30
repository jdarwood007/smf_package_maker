<?php
/*
 * SMF Package Manager Generator
 * Author: SleePy (JeremyD)
 * Repository: https://github.com/jdarwood007/smf_package_maker
 * License: BSD 3 Clause; See license.txt
*/
if (!defined('PacManGen')) { exit('[' . basename(__FILE__) . '] Direct access restricted');}

/*
 * The index section
*/
function index_section()
{
	global $text;

	echo '
		<br clear="all" />
		<p id="welcome">', $text['index_welcome'], '.</p>
		<ol id="steps">
			<li><a href="index.php?action=mod">', $text['index_mod'], '</a></li>
			<li><a href="index.php?action=info">', $text['index_info'], '</a></li>
			<li>', $text['index_compress'], '</li>
		</ol>';
}

/*
 * The index template
 * Just a voodoo function.
*/
function index_templates() {}
