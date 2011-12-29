<?php

// The locale 
$locale = 'en-US';

// The name of this script.
$text['script_name'] = 'SMF Package Generator';


// Basic information section.
$text['basic_info_header'] = 'Basic Modification Information';
$text['basic_your_name'] = 'Your Name';
$text['basic_mod_name'] = 'Modification Name';
$text['basic_mod_version'] = 'Modification Version';


// Details section.
$text['details_header'] = 'Details';
$text['details_num_files'] = 'Number of Files';
$text['details_num_edits'] = 'Number of Edits';
$text['details_num_lines'] = 'Number of lines';

// Buttons.
$text['button_add_file'] = 'Add another File';
$text['button_preview'] = 'Preview Changes';
$text['button_download'] = 'Download File';
$text['button_add_edit'] = 'Add another Edit';


// Preview.
$text['preview_header'] = 'Your .xml file';


// File sections. Note that %1$s here represents the file number.
$text['file_header'] = 'File #%1$s';
$text['file_header_delete'] = 'Delete';
$text['file_header_restore'] = 'Restore';
$text['file_header_collapse'] = 'Collapse';
$text['file_header_expand'] = 'Expand';

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