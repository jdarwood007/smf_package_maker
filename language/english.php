<?php
/*
 * SMF Package Manager Generator
 * Author: SleePy (JeremyD)
 * Repository: https://github.com/jdarwood007/smf_package_maker
 * License: BSD 3 Clause; See license.txt
*/

// The locale 
$locale = 'en-US';
$charset = 'UTF-8';

// The name of this script.
$text['script_name'] = 'SMF Package Generator';

// Basic information section.
$text['basic_info_header'] = 'Basic Modification Information';
$text['basic_your_name'] = 'Your Name';
$text['basic_mod_name'] = 'Modification Name';
$text['basic_mod_version'] = 'Modification Version';
$text['basic_mod_type'] = 'Modification Type';
$text['details_header'] = 'Details';

// Some basic buttons.
$text['button_preview'] = 'Preview Changes';
$text['button_download'] = 'Download File';
$text['button_delete'] = 'Delete';
$text['button_restore'] = 'Restore';
$text['button_collapse'] = 'Collapse';
$text['button_expand'] = 'Expand';

// The Mod Maker Part
	// Details section.
	$text['details_num_files'] = 'Number of Files';
	$text['details_num_edits'] = 'Number of Edits';
	$text['details_num_lines'] = 'Number of lines';

	// Buttons.
	$text['button_add_edit'] = 'Add another Edit';
	$text['button_add_file'] = 'Add another File';

	// Preview.
	$text['preview_header'] = 'Your .xml file';


	// File sections. Note that %1$s here represents the file number.
	$text['file_header'] = 'File #%1$s';

	$text['file_to_edit'] = 'File to edit';

	$text['file_not_found'] = 'If no file found';
	$text['file_not_found_fatal'] = 'Fail (SMF Default)';
	$text['file_not_found_ignore'] = 'Create file with changes';
	$text['file_not_found_skip'] = 'Skip entire file';


	// Edit sections. Note that %1$s here represents file number, while %2$s represents edit number.
	$text['edit_header'] = 'File #%1$s &mdash; Edit #%2$s';
	$text['edit_header_delete'] = 'Delete';
	$text['edit_header_restore'] = 'Restore';
	$text['edit_header_collapse'] = 'Collapse';
	$text['edit_header_expand'] = 'Expand';

	$text['edit_ignore_whitespace'] = 'Ignore Whitespace';
	$text['edit_search_for'] = 'Code to search for';
	$text['edit_replace_with'] = 'Code to replace with';

	$text['edit_action'] = 'Edit Action';
	$text['edit_action_replace'] = 'Replace the selection with the code';
	$text['edit_action_before'] = 'Add the code after the selection';
	$text['edit_action_after'] = 'Add the code before the selection';
	$text['edit_action_end'] = 'Add this to the end of the file';

	$text['edit_errors'] = 'Error Handling';
	$text['edit_errors_fail'] = 'Fail (Default)';
	$text['edit_errors_ignore'] = 'Create File with edits (ignore)';
	$text['edit_errors_required'] = 'Require the search to fail';


// The Package Info Section. Note that %1$s here represents the action number.
	$text['details_num_actions'] = 'Number of Actions';
	$text['details_num_instructions'] = 'Number of Instructions';

	$text['button_add_action'] = 'Add Action';
	$text['button_add_instruct'] = 'Add Instruction';

	$text['action_header'] = 'Action %1$s';

	// The Edit section
	$text['type_of_action'] = 'Type of Action';
	$text['type_of_action_install'] = 'Install';
	$text['type_of_action_uninstall'] = 'Uninstall';
	$text['type_of_action_upgrade'] = 'Upgrade';
	$text['action_smf_versions'] = 'SMF Versions';


	// Instruction stuff. Note that %1$s here represents action number, while %2$s represents instruction number.
	$text['instruct_header'] = 'Action #%1$s &mdash; Instruction #%2$s';

	$text['instruct_action'] = 'What to do';
	$text['instruct_action_modification'] = 'Modification (.xml or .mod)';
	$text['instruct_action_code'] = 'Execute code';
	$text['instruct_action_database'] = 'Execute Database';
	$text['instruct_action_create_dir'] = 'Create Directory';
	$text['instruct_action_create_file'] = 'Create File';
	$text['instruct_action_require_dir'] = 'Install files from Directory';
	$text['instruct_action_require_file'] = 'Install file from File';
	$text['instruct_action_move_dir'] = 'Move/Rename a Directory';
	$text['instruct_action_move_file'] = 'Move/Rename a File';
	$text['instruct_action_delete_dir'] = 'Remove a Directory';
	$text['instruct_action_delete_file'] = 'Remove a File';
	$text['instruct_action_readme'] = 'Readme Installer';

	$text['action_inline'] = 'Inline Edit';
	$text['action_reverse'] = 'Reverse Modification Edits';
	$text['action_destination'] = 'Destination';
	$text['action_source'] = 'File/Folder to Include';
	$text['action_code_block'] = 'Inline Code';
	

// The Index section
	$text['index_welcome'] = 'Welcome to the SMF Package Maker.  Below are the simple three steps to packaging your modification';
	$text['index_mod'] = 'Mod Maker';
	$text['index_info'] = 'Package-Info Maker';
	$text['index_compress'] = 'Compress as .zip or .tgz (.tar.gz)';