<?php
/*
 * SMF Package Manager Generator
 * Author: SleePy (JeremyD)
 * Repository: https://github.com/jdarwood007/smf_package_maker
 * License: BSD 3 Clause; See license.txt
*/
require_once(dirname(__FILE__) . '/settings.php');
require_once(dirname(__FILE__) . '/language/' . $language . '.php');

// Default our action.
if (!isset($_GET['action']) || !in_array($_GET['action'], array('mod', 'info')))
	$action = 'index';
else
	$action = $_GET['action'];

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
				<h1><a href="index.php">', $text['script_name'], '</a></h1></div>
		</div>
		<div class="clear"></div>
	</div>
	<div id="container">
		<div id="wrap" class="action_', $action, '">';

if ($action == 'mod')
	mod_section();
elseif ($action == 'info')
	info_section();
else
	index_section();

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

if ($action == 'mod')
	mod_templates();
elseif ($action == 'info')
	info_templates();

echo '
</body>
</html>';

/*
 * This is the mod section code.
*/
function mod_section()
{
	global $text;

	echo '
			<fieldset id="basic_info">
				<legend>', $text['basic_info_header'], ' <span id="collapse_basic">^</span></legend>
				<dl class="info">
					<dt>', $text['basic_your_name'], ':</dt>
					<dd><input id="basic_info_name" /></dd>

					<dt>', $text['basic_mod_name'], ':</dt>
					<dd><input id="basic_info_mod" /></dd>

					<dd>', $text['basic_mod_version'], ':</dt>
					<dd><input id="basic_info_version" /></dd>

				</dl>
			</fieldset>
			<fieldset id="details_info">
				<legend>', $text['details_header'], ' <span id="collapse_basic">^</span></legend>
				<dl class="info">
					<dt>', $text['details_num_files'], ':</dt>
					<dd><input disabled="disabled" id="detail_files" /></dd>

					<dt>', $text['details_num_edits'], ':</dt>
					<dd><input disabled="disabled" id="detail_edits" /></dd>

					<dd>', $text['details_num_lines'], ':</dt>
					<dd><input disabled="disabled" id="detail_lines" /></dd>
				</dl>
			</fieldset>

			<br clear="all" />
			<hr />
			<form id="file_container"></form>
			<input type="button" id="add_file" value="', $text['button_add_file'], '" />
			<input type="button" id="show_preview" value="', $text['button_preview'], '" />
			<input type="button" id="download_file" value="', $text['button_download'], '" onclick="download_file_', ($use_php ? 'generate' : 'data'), '()" />
			<br />
			<fieldset id="preview_container" style="display: none;" class="edits" >
				<legend>', $text['preview_header'], '</legend>
				<textarea id="preview" cols="150" rows="25"></textarea>
			</fieldset>
				<br />';
}

/*
 * This is the mod templates near the end of the page
*/
function mod_templates()
{
	global $text;

	echo '
<!-- This is the container for a new file -->
<!-- Do not remove any id attribute.  This makes the magic work! -->
<div id="file_template" style="display: none;">
			<fieldset id="file-#FILEINDEX#" class="edits">
				<input type="hidden" id="file-#FILEINDEX#-delete" value="0" />
				<legend>
					<span class="alignright">
						<a href="#" class="delete_file" data-file="#FILEINDEX#">[', $text['button_delete'], ']</a>
						<a href="#" class="restore_file" data-file="#FILEINDEX#" style="display: none;">[', $text['button_restore'], ']</a>
						&nbsp;&mdash;&nbsp;
						<a href="#" class="collapse_file" data-file="#FILEINDEX#">[', $text['button_collapse'], ']</a>
						<a href="#" class="expand_file" data-file="#FILEINDEX#" style="display: none;">[', $text['button_expand'], ']</a>
						</span>
					', sprintf($text['file_header'], '#FILEINDEX#'), '
				</legend>

				', $text['file_to_edit'], ':
				<select id="file-#FILEINDEX#-file_type">
					<option value="$boarddir">$boarddir</option>
					<option value="$sourcedir">$sourcedir</option>
					<option value="$themedir">$themedir</option>
					<option value="$languagedir">$languagedir</option>
				</select>
				<input type="text" id="file-#FILEINDEX#-file_name" size="30" value="index.php" />

				<span class="pad">', $text['file_not_found'], ':
					<select id="file-#FILEINDEX#-file_fail">
						<option value="fatal">', $text['file_not_found_fatal'], '</option>
						<option value="ignore">', $text['file_not_found_ignore'], '</option>
						<option value="skip">', $text['file_not_found_skip'], '</option>
					</select>
				</span>

				<div id="file-#FILEINDEX#-edit_container">
				<hr />
				</div>
				<input type="button" class="add_edit" data-file="#FILEINDEX#" value="', $text['button_add_edit'], '" />
			</fieldset>
			<hr />
</div>

<!-- This is the container for a new edit -->
<!-- Do not remove any id attribute.  This makes the magic work! -->
<div id="edit_template" style="display: none;">
				<fieldset id="file-#FILEINDEX#-edit-#EDITINDEX#" class="edit">
					<input type="hidden" id="file-#FILEINDEX#-edit-#EDITINDEX#-delete" value="0" />
					<legend>
						<span class="alignright">
							<a href="#" class="delete_change" data-file="#FILEINDEX#" data-edit="#EDITINDEX#">[', $text['button_delete'], ']</a>
							<a href="#" class="restore_change" data-file="#FILEINDEX#" data-edit="#EDITINDEX#" style="display: none;">[', $text['button_restore'], ']</a>
							&nbsp;&mdash;&nbsp;
							<a href="#" class="collapse_change" data-file="#FILEINDEX#" data-edit="#EDITINDEX#">[', $text['button_collapse'], ']</a>
							<a href="#" class="expand_change" data-file="#FILEINDEX#" data-edit="#EDITINDEX#" style="display: none;">[', $text['button_expand'], ']</a>
						</span>
						', sprintf($text['edit_header'], '#FILEINDEX#', '#EDITINDEX#'), '
					</legend>

					<dl class="edits">
						<dt>', $text['edit_action'], ':</dt>
						<dd><select id="file-#FILEINDEX#-edit-#EDITINDEX#-action" onchange="update_counter()">
							<option value="replace">', $text['edit_action_replace'], '</option>
							<option value="before">', $text['edit_action_before'], '</option>
							<option value="after">', $text['edit_action_after'], '</option>
							<option value="end">', $text['edit_action_end'], '</option>
						<select></dd>

						<dt>', $text['edit_errors'], ':</dt>
						<dd><select id="file-#FILEINDEX#-edit-#EDITINDEX#-error">
							<option value="fatal">', $text['edit_errors_fail'], '</option>
							<option value="ignore">', $text['edit_errors_ignore'], '</option>
							<option value="required">', $text['edit_errors_required'], '</option>
						</select></dd>

						<dt>', $text['edit_ignore_whitespace'], '</dt>
						<dd><input id="file-#FILEINDEX#-edit-#EDITINDEX#-whitespace" type="checkbox" /></dd>

						<dt>', $text['edit_search_for'], ':</dt>
						<dd><textarea id="file-#FILEINDEX#-edit-#EDITINDEX#-search" class="search_for" cols="75" rows="7" onchange="update_counter()">// Locate</textarea></dd>

						<dt>', $text['edit_replace_with'], ':</dt>
						<dd><textarea id="file-#FILEINDEX#-edit-#EDITINDEX#-replace" class="replace_with" cols="75" rows="7" onchange="update_counter()">/* Replace */</textarea></dd>
					</dl>
				</fieldset>
				<br />
</div>';
}

/*
 * The package-info section
*/
function info_section()
{
	global $text;

	echo '
			<fieldset id="basic_info">
				<legend>', $text['basic_info_header'], ' <span id="collapse_basic">^</span></legend>
				<dl class="info">
					<dt>', $text['basic_your_name'], ':</dt>
					<dd><input id="basic_info_name" /></dd>

					<dt>', $text['basic_mod_name'], ':</dt>
					<dd><input id="basic_info_mod" /></dd>

					<dd>', $text['basic_mod_version'], ':</dt>
					<dd><input id="basic_info_version" /></dd>

					<dd>', $text['basic_mod_type'], ':</dt>
					<dd><select name="basic_info_type">
						<option value="modification">Modification</option>
						<option value="avatar">Avatars</option>
						<option value="smiley">Smileys</option>
						<option value="language">Language</option>
						<option value="other">Other</option>
					</select>
					</dd>

				</dl>
			</fieldset>
			<fieldset id="details_info">
				<legend>', $text['details_header'], ' <span id="collapse_basic">^</span></legend>
				<dl class="info">
					<dt>', $text['details_num_actions'], ':</dt>
					<dd><input disabled="disabled" id="detail_actions" /></dd>

					<dt>', $text['details_num_instructions'], ':&nbsp;&nbsp;</dt>
					<dd><input disabled="disabled" id="detail_instructs" /></dd>
				</dl>
			</fieldset>

			<br clear="all" />
			<hr />
			<form id="action_container">
			</form>
			<input type="button" id="add_action" value="', $text['button_add_action'], '" />
			<input type="button" id="show_preview" value="', $text['button_preview'], '" />
			<input type="button" id="download_file" value="', $text['button_download'], '" onclick="download_file_', ($use_php ? 'generate' : 'data'), '()" />
			<br />
			<fieldset id="preview_container" style="display: none;" class="edits" >
				<legend>', $text['preview_header'], '</legend>
				<textarea id="preview" cols="150" rows="25"></textarea>
			</fieldset>
				<br />';

}

/*
 * This is the mod templates near the end of the page
*/
function info_templates()
{
	global $text;

	echo '
<!-- This is the container for a new action -->
<!-- Do not remove any id attribute.  This makes the magic work! -->
<div id="action_template" style="display: none;">
			<fieldset id="action-#ACTIONINDEX#" class="edits">
				<input type="hidden" id="action-#ACTIONINDEX#-delete" value="0" />
				<legend>
					<span class="alignright">
						<a href="#" class="delete_action" data-action="#ACTIONINDEX#">[', $text['button_delete'], ']</a>
						<a href="#" class="restore_action" data-action="#ACTIONINDEX#" style="display: none;">[', $text['button_restore'], ']</a>
						&nbsp;&mdash;&nbsp;
						<a href="#" class="collapse_action" data-action="#ACTIONINDEX#">[', $text['button_collapse'], ']</a>
						<a href="#" class="expand_action" data-action="#ACTIONINDEX#" style="display: none;">[', $text['button_expand'], ']</a>
						</span>
					', sprintf($text['action_header'], '#ACTIONINDEX#'), '
				</legend>

				', $text['type_of_action'], ':
				<select id="action-#ACTIONINDEX#-type">
					<option value="install">', $text['type_of_action_install'], '</option>
					<option value="uninstall">', $text['type_of_action_uninstall'], '</option>
					<option value="upgrade">', $text['type_of_action_upgrade'], '</option>
				</select>

				<span class="pad">', $text['action_smf_versions'], ':
					<input type="text" id="action-#ACTIONINDEX#-smf_versions" size="60" value="SMF 2.0 RC5, SMF 2.0-2.0.99" />
				</span>

				<div id="action-#ACTIONINDEX#-instruct_container">
				<hr />
				</div>
				<input type="button" class="add_instruct" data-action="#ACTIONINDEX#" value="', $text['button_add_instruct'], '" />
			</fieldset>
			<hr />
</div>

<!-- This is the container for a new edit -->
<!-- Do not remove any id attribute.  This makes the magic work! -->
<div id="instruct_template" style="display: none;">
				<fieldset id="action-#ACTIONINDEX#-instruct-#INSTRUCTINDEX#" class="edit">
					<input type="hidden" id="action-#ACTIONINDEX#-instruct-#INSTRUCTINDEX#-delete" value="0" />
					<legend>
						<span class="alignright">
							<a href="#" class="delete_change" data-action="#ACTIONINDEX#" data-instruct="#INSTRUCTINDEX#">[', $text['button_delete'], ']</a>
							<a href="#" class="restore_change" data-action="#ACTIONINDEX#" data-instruct="#INSTRUCTINDEX#" style="display: none;">[', $text['button_restore'], ']</a>
							&nbsp;&mdash;&nbsp;
							<a href="#" class="collapse_change" data-action="#ACTIONINDEX#" data-instruct="#INSTRUCTINDEX#">[', $text['button_collapse'], ']</a>
							<a href="#" class="expand_change" data-action="#ACTIONINDEX#" data-instruct="#INSTRUCTINDEX#" style="display: none;">[', $text['button_expand'], ']</a>
						</span>
						', sprintf($text['instruct_header'], '#ACTIONINDEX#', '#INSTRUCTINDEX#'), '
					</legend>

					<dl class="edits">
						<dt>', $text['instruct_action'], ':</dt>
						<dd><select class="instruct_action" id="action-#ACTIONINDEX#-instruct-#INSTRUCTINDEX#-action" data-action="#ACTIONINDEX#" data-instruct="#INSTRUCTINDEX#">
							<option value="modification">', $text['instruct_action_modification'], '</option>
							<option value="code">', $text['instruct_action_code'], '</option>
							<option value="database">', $text['instruct_action_database'], '</option>
							<option value="create-dir">', $text['instruct_action_create_dir'], '</option>
							<option value="create-file">', $text['instruct_action_create_file'], '</option>
							<option value="require-dir">', $text['instruct_action_require_dir'], '</option>
							<option value="require-file">', $text['instruct_action_require_file'], '</option>
							<option value="move-dir">', $text['instruct_action_move_dir'], '</option>
							<option value="move-file">', $text['instruct_action_move_file'], '</option>
							<option value="remove-dir">', $text['instruct_action_delete_dir'], '</option>
							<option value="remove-file">', $text['instruct_action_delete_file'] , '</option>
							<option value="readme">', $text['instruct_action_readme'], '</option>
						<select></dd>

						<dt class="reverse">', $text['action_reverse'], ':</dt>
						<dd class="reverse"><input type="checkbox" id="action-#ACTIONINDEX#-instruct-#INSTRUCTINDEX#-reverse"></dd>

						<dt class="source">', $text['action_source'], '</dt>
						<dd class="source"><input id="action-#ACTIONINDEX#-instruct-#INSTRUCTINDEX#-source" type="text" /></dd>

						<dt class="destination">', $text['action_destination'], '</dt>
						<dd class="destination"><input id="action-#ACTIONINDEX#-instruct-#INSTRUCTINDEX#-destination" type="text" /></dd>

						<dt class="inline">', $text['action_inline'], ':</dt>
						<dd class="inline"><input type="checkbox" id="action-#ACTIONINDEX#-instruct-#INSTRUCTINDEX#-inline" onchange="instruct_inline(this)" data-action="#ACTIONINDEX#" data-instruct="#INSTRUCTINDEX#"></dd>

						<dt class="code_block">', $text['action_code_block'], ':</dt>
						<dd class="code_block"><textarea id="action-#ACTIONINDEX#-instruct-#INSTRUCTINDEX#-block" cols="75" rows="7"></textarea></dd>
					</dl>
				</fieldset>
				<br />
</div>';
}

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