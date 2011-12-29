<?php
// Assets URL location.
$assets = '/PacManGen/assets';

// Style to use.
$style = 'default';

// How to handle downloads..
$use_php = true;

$page_title = 'SleePyCode Package Manager Generator';

// Commenting out logo will remove it.
$logo = $assets . '/logo.png';
$logo_url = 'http://sleepycode.com';

$language = 'english';

/**********************************************************
********** END OF SETTINGS *******************************/
include(dirname(__FILE__) . '/language/' . $language . '.php');

// Only invoke the download when it is enabled and we are going to try to do it.
if ($use_php && isset($_GET['download']))
{
	/* We should at least try to verify the referrer */
	if (!isset($_SERVER['HTTP_REFERER']) || strpos($_SERVER['HTTP_REFERER'], $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME']) === false)
		exit('Invalid Request Detected');

		header('Cache-Control: ');
		header('Content-type: text/plain');
		header ('Content-Disposition: attachment; filename="install.xml"');
		exit($_POST['content']);
}

echo '
<!DOCTYPE html><!-- HTML 5 -->
<html dir="ltr" lang="en-US">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>', $page_title, '</title>
	<link rel="stylesheet" id="', $style, '-css" href="', $assets, '/', $style, '.css" type="text/css" media="all">
	<script type="text/javascript" src="', $assets, '/jquery.min.js"></script>
	<script type="text/javascript" src="', $assets, '/', $use_php ? 'jquery.generateFile.js' : 'jquery.base64.js', '"></script>
	<script type="text/javascript" src="', $assets, '/script.js"></script>
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
				<h1>', $text['script_name'], '</h1></div>
		</div>
		<div class="clear"></div>
	</div>
	<div id="container">
		<div id="wrap">
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
				<br />
		</div>
	</div>
</div>
<div id="footer">
	<!-- Please give credit where credit is due -->
	<div id="foot"><span class="alignright"><a href="http://sleepycode.com">SMF Package Manager Generator by JeremyD (SleePy)</a></span></div>
	<div class="clear"></div>
	</div>
</div>

<!-- This is the container for a new file -->
<!-- Do not remove any id attribute.  This makes the magic work! -->
<div id="file_template" style="display: none;">
			<fieldset id="file-#FILEINDEX#" class="edits">
				<input type="hidden" id="file-#FILEINDEX#-delete" value="0" />
				<legend>
					<span class="alignright">
						<a href="#" class="delete_file" data-file="#FILEINDEX#">[', $text['file_header_delete'], ']</a>
						<a href="#" class="restore_file" data-file="#FILEINDEX#" style="display: none;">[', $text['file_header_restore'], ']</a>
						&nbsp;&mdash;&nbsp;
						<a href="#" class="collapse_file" data-file="#FILEINDEX#">[', $text['file_header_collapse'], ']</a>
						<a href="#" class="expand_file" data-file="#FILEINDEX#" style="display: none;">[', $text['file_header_expand'], ']</a>
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
							<a href="#" class="delete_change" data-file="#FILEINDEX#" data-edit="#EDITINDEX#">[', $text['edit_header_delete'], ']</a>
							<a href="#" class="restore_change" data-file="#FILEINDEX#" data-edit="#EDITINDEX#" style="display: none;">[', $text['edit_header_restore'], ']</a>
							&nbsp;&mdash;&nbsp;
							<a href="#" class="collapse_change" data-file="#FILEINDEX#" data-edit="#EDITINDEX#">[', $text['edit_header_collapse'], ']</a>
							<a href="#" class="expand_change" data-file="#FILEINDEX#" data-edit="#EDITINDEX#" style="display: none;">[', $text['edit_header_expand'], ']</a>
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
</div>
</body>
</html>';