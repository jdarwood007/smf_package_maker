<?php
/*
 * SMF Package Manager Generator
 * Author: SleePy (JeremyD)
 * Repository: https://github.com/jdarwood007/smf_package_maker
 * License: BSD 3 Clause; See license.txt
*/
if (!defined('PacManGen')) { exit('[' . basename(__FILE__) . '] Direct access restricted');}

/*
 * This is the mod section code.
*/
function mod_section()
{
	global $text, $pmg;

	echo '
			<fieldset id="basic_info" class="edits">
				<legend>
					', $text['basic_info_header'], '
					<a href="#" id="collapse_basic">[', $text['button_collapse'], ']</a>
					<a href="#" id="restore_basic" style="display: none;">[', $text['button_expand'], ']</a>
				</legend>
				<dl class="info">
					<dt>', $text['basic_your_name'], ':</dt>
					<dd><input id="basic_info_name" /></dd>

					<dt>', $text['basic_mod_name'], ':</dt>
					<dd><input id="basic_info_mod" /></dd>

					<dd>', $text['basic_mod_version'], ':</dt>
					<dd><input id="basic_info_version" /></dd>

				</dl>
			</fieldset>
			<fieldset id="details_info" class="edits">
				<legend>
					', $text['details_header'], '
					<a href="#" id="collapse_details">[', $text['button_collapse'], ']</a>
					<a href="#" id="restore_details" style="display: none;">[', $text['button_expand'], ']</a>
				</legend>
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
			<input type="button" id="download_file" value="', $text['button_download'], '" onclick="download_file_', ($pmg['use_php'] ? 'generate' : 'data'), '()" />
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
