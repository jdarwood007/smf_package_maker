<?php
/*
 * SMF Package Manager Generator
 * Author: SleePy (JeremyD)
 * Repository: https://github.com/jdarwood007/smf_package_maker
 * License: BSD 3 Clause; See license.txt
*/
if (!defined('PacManGen')) { exit('[' . basename(__FILE__) . '] Direct access restricted');}

/*
 * The package-info section
*/
function info_section()
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

					<dd>', $text['basic_mod_type'], ':</dt>
					<dd><select id="basic_info_type">
						<option value="modification">Modification</option>
						<option value="avatar">Avatars</option>
						<option value="smiley">Smileys</option>
						<option value="language">Language</option>
						<option value="other">Other</option>
					</select>
					</dd>

				</dl>
			</fieldset>
			<fieldset id="details_info" class="edits">
				<legend>
					', $text['details_header'], '
					<a href="#" id="collapse_details">[', $text['button_collapse'], ']</a>
					<a href="#" id="restore_details" style="display: none;">[', $text['button_expand'], ']</a>
				</legend>
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
			<input type="button" id="download_file" value="', $text['button_download'], '" onclick="download_action_', ($pmg['use_php'] ? 'generate' : 'data'), '()" />
			<br />
			<fieldset id="preview_container" style="display: none;" class="edits" >
				<legend>', $text['preview_header'], '</legend>
				<textarea id="preview" rows="25"></textarea>
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
					<span class="floatbuttons">
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
						<span class="floatbuttons">
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
							<option value="hook">', $text['instruct_action_hook'], '</option>
						<select></dd>

						<dt class="reverse">', $text['action_reverse'], ':</dt>
						<dd class="reverse"><input type="checkbox" id="action-#ACTIONINDEX#-instruct-#INSTRUCTINDEX#-reverse"></dd>

						<dt class="source">', $text['action_source'], '</dt>
						<dd class="source"><input id="action-#ACTIONINDEX#-instruct-#INSTRUCTINDEX#-source" type="text" /></dd>

						<dt class="destination">', $text['action_destination'], '</dt>
						<dd class="destination"><input id="action-#ACTIONINDEX#-instruct-#INSTRUCTINDEX#-destination" type="text" /></dd>

						<dt class="inline">', $text['action_inline'], ':</dt>
						<dd class="inline"><input type="checkbox" id="action-#ACTIONINDEX#-instruct-#INSTRUCTINDEX#-inline" data-action="#ACTIONINDEX#" data-instruct="#INSTRUCTINDEX#" class="inline_check"></dd>

						<dt class="code_block">', $text['action_code_block'], ':</dt>
						<dd class="code_block"><textarea id="action-#ACTIONINDEX#-instruct-#INSTRUCTINDEX#-block" cols="75" rows="7"></textarea></dd>

						<dt class="hook_name">', $text['action_hook_name'], ':</dt>
						<dd class="hook_name"><input id="action-#ACTIONINDEX#-instruct-#INSTRUCTINDEX#-hook_name" type="text" /></dd>
						<dt class="hook_function">', $text['action_hook_function'], ':</dt>
						<dd class="hook_function"><input id="action-#ACTIONINDEX#-instruct-#INSTRUCTINDEX#-hook_function" type="text" /></dd>
						<dt class="hook_file">', $text['action_hook_file'], ':</dt>
						<dd class="hook_file"><input id="action-#ACTIONINDEX#-instruct-#INSTRUCTINDEX#-hook_file" type="text" /></dd>
					</dl>
				</fieldset>
				<br />
</div>';
}
