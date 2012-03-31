/*
 * SMF Package Manager Generator
 * Author: SleePy (JeremyD)
 * Repository: https://github.com/jdarwood007/smf_package_maker
 * License: BSD 3 Clause; See license.txt
*/

/* This gets things going once the document has loaded, also makes sure JQuery is here. */
$(document).ready(function(){
	/* Start off some counting */
	file_count = 1;
	edit_count =new Array();
	edit_count[file_count] = 1;

	/* Bind some stuff to our files, using live so they auto update as new stuff is added. */
	$('.collapse_file').live('click', collapse_file);
	$('.expand_file').live('click', expand_file);
	$('.delete_file').live('click', delete_file);
	$('.restore_file').live('click', restore_file);

	/* Now we will bind to the actual edits, again using live. */
	$('.collapse_change').live('click', collapse_edit);
	$('.expand_change').live('click', expand_edit);
	$('.delete_change').live('click', delete_edit);
	$('.restore_change').live('click', restore_edit);

	/* Give our buttons some actions. */
	$('#add_file').click(create_new_file);
	$('.add_edit').live('click', create_new_edit);
	$('#show_preview').click(show_edit_preview);

	/* The details and basic buttons. */
	$('#collapse_basic').click(function(){$('#basic_info .info').hide(); $('#collapse_basic').hide(); $('#restore_basic').show();});
	$('#restore_basic').click(function(){$('#basic_info .info').show(); $('#restore_basic').hide(); $('#collapse_basic').show();});
	$('#collapse_details').click(function(){$('#details_info .info').hide(); $('#collapse_details').hide(); $('#restore_details').show();});
	$('#restore_details').click(function(){$('#details_info .info').show(); $('#restore_details').hide(); $('#collapse_details').show();});

	/* Kick things off by creating a file. */
	create_new_file();
});

/* Handles adding files */
function create_new_file()
{
	/* We have been through this before */
	$('#file_container').append($('#file_template').html().replace(/#FILEINDEX#/g, file_count));

	/* Now we pretend to click said element */
	$('#file-' + file_count).find('.add_edit').click();

	/* Move the index and add defaults */
	file_count++;
	edit_count[file_count] = 1;

	update_counter();
}

/* Handles adding of edits */
function create_new_edit()
{
	file_index = $(this).attr('data-file');

	$('#file-' + file_index + '-edit_container').append($('#edit_template').html().replace(/#FILEINDEX#/g, file_index).replace(/#EDITINDEX#/g, edit_count[file_index]));
	edit_count[file_index]++;

	update_counter();
}

/* Handles collapsing of the edit */
function collapse_edit()
{
	file_index = $(this).attr('data-file');
	edit_index = $(this).attr('data-edit');

	/* Simply hide the edit, and give a expand button */
	$('#file-' + file_index + '-edit-' + edit_index + ' .edits').hide();
	$('#file-' + file_index + '-edit-' + edit_index + ' .expand_change').show();
	$(this).hide();

	return false;
}

/* Handles expanding of the edit */
function expand_edit()
{
	file_index = $(this).attr('data-file');
	edit_index = $(this).attr('data-edit');

	/* Simply show the edit, and return to the original collapse button */
	$('#file-' + file_index + '-edit-' + edit_index + ' .edits').show();
	$('#file-' + file_index + '-edit-' + edit_index + ' .collapse_change').show();
	$(this).hide();

	return false;
}

/* Handles deleting a edit */
function delete_edit()
{
	file_index = $(this).attr('data-file');
	edit_index = $(this).attr('data-edit');

	/* First we let the data know its deleted. */
	$('#file-' + file_index + '-edit-' + edit_index + '-delete').val('1');

	/* Then we hide this header, collapse the edit and show the restore button */
	$('#file-' + file_index + '-edit-' + edit_index + ' .edits').hide();
	$('#file-' + file_index + '-edit-' + edit_index + ' .restore_change').show();
	$(this).hide();

	update_counter();
	return false;
}

/* Handles restoring a edit */
function restore_edit()
{
	file_index = $(this).attr('data-file');
	edit_index = $(this).attr('data-edit');

	/* First we let the data know its deleted. */
	$('#file-' + file_index + '-edit-' + edit_index + '-delete').val('0');

	/* Then we hide this header, collapse the edit and show the restore button */
	$('#file-' + file_index + '-edit-' + edit_index + ' .edits').show();
	$('#file-' + file_index + '-edit-' + edit_index + ' .delete_change').show();
	$(this).hide();

	update_counter();
	return false;
}

/* Handles collapsing of the file */
function collapse_file()
{
	file_index = $(this).attr('data-file');

	/* Simply hide the file, and give a expand button */
	$('#file-' + file_index + '-edit_container').hide();
	$('#file-' + file_index + ' .expand_file').show();
	$(this).hide();

	return false;
}

/* Handles expanding of the file */
function expand_file()
{
	file_index = $(this).attr('data-file');

	/* Simply show the file, and return to the original collapse button */
	$('#file-' + file_index + '-edit_container').show();
	$('#file-' + file_index + ' .collapse_file').show();
	$(this).hide();

	return false;
}

/* Handles deleting a file */
function delete_file()
{
	file_index = $(this).attr('data-file');

	/* First we let the data know its deleted. */
	$('#file-' + file_index + '-delete').val('1');

	/* Then we hide this header, collapse the edit and show the restore button */
	$('#file-' + file_index + '-edit_container').hide();
	$('#file-' + file_index + ' .restore_file').show();
	$(this).hide();

	update_counter();
	return false;
}

/* Handles restoring a file */
function restore_file()
{
	file_index = $(this).attr('data-file');

	/* First we let the data know its deleted. */
	$('#file-' + file_index + '-delete').val('0');

	/* Then we hide this header, collapse the edit and show the restore button */
	$('#file-' + file_index + '-edit_container').show();
	$('#file-' + file_index + ' .delete_file').show();
	$(this).hide();

	update_counter();
	return false;
}

/* This is the nasty guy */
function show_edit_preview()
{
	$('#preview_container').show();

	author = $('#basic_info_name').val().replace(/ /g,'_');
	name = $('#basic_info_mod').val().replace(/ /g,'_');
	version = $('#basic_info_version').val().replace(/ /g,'_');

	preview = '<' + '?xml version="1.0"?' + '>' + "\n" + '\
<!DOCTYPE modification SYSTEM "http://www.simplemachines.org/xml/modification">' + "\n" + '\
<!-- This package was generated by SleePys Modification Maker at http://sleepycode.com -->' + "\n" + '\
<modification xmlns="http://www.simplemachines.org/xml/modification" xmlns:smf="http://www.simplemachines.org/">' + "\n" + '\
	<id>' + author + ':' + name + '</id>' + "\n" + '\
	<version>' + version + '</version>' + "\n";

	i = 1;
	for (i = 1; i < file_count; i++)
	{
		/* Skip this edit if we deleted it. */
		if ($('#file-' + i + '-delete').val() == '1')
		{
			continue;
		}

		/* Find our edit count */
		ecount = edit_count[i];

		/* Get the file info */
		file_type = $('#file-' + i + '-file_type').val();
		file_name = $('#file-' + i + '-file_name').val();
		file_fail = $('#file-' + i + '-file_fail').val();

		/* Start off with the file attribute */
		preview += "\n" + '\
	<file name="' + file_type + '/' + file_name + '"';

		/* We don't need to define the default error type. */
		if ($.inArray(file_fail, ["ignore", "skip"]) > -1)
		{
			preview += ' error="' + file_fail + '"';
		}
		preview += '>';

		/* Now onto the individual edits we made! */
		for (j = 1; j < ecount; j++)
		{
			/* Skip this edit if we deleted it. */
			if ($('#file-' + i + '-edit-' + j + '-delete').val() == '1')
			{
				continue;
			}

			/* Get our edit info */
			edit_action		=	$('#file-' + i + '-edit-' + j + '-action').val();
			edit_error		=	$('#file-' + i + '-edit-' + j + '-error').val();
			edit_whitespace	=	$('#file-' + i + '-edit-' + j + '-action').is(':checked');
			edit_search		=	$('#file-' + i + '-edit-' + j + '-search').val();
			edit_replace	=	$('#file-' + i + '-edit-' + j + '-replace').val();

			/* Start off our editing */
			preview += "\n\
		<operation";

			/* We only need to add error handling for non default */
			if ($.inArray(edit_error, ["ignore", "required"]) > -1)
			{
				preview += ' error="' + file_fail + '"';
			}
			preview += '>';

			/* Handle our search action */
			if (edit_action == 'end')
			{
				preview += "\n" + '\
			<search position="end"/>';
			}
			else
			{
				preview += "\n" + '\
			<search position="' + edit_action + '"';

				/* Ignore whitespace issues */
				if (edit_whitespace)
				{
					preview += ' whitespace="loose"';
				}

				/* Finally our code. */
				preview += '><![CDATA[' + edit_search + ']]></search>';
			}

			/* Now our replace/add operation */
			preview += "\n" + '\
			<add><![CDATA[' + edit_replace + ']]></add>' + "\n" + '\
		</operation>';

		}

		/* Close up the file edit */
		preview += "\n\
	</file>";

	}

	preview += "\n" + '\
</modification>';

	$('#preview').text(preview);
}

function download_file_generate()
{
	show_edit_preview();

	$.generateFile({
		filename	: 'install.xml',
		content		: $('#preview').text(),
		script		: $('#downloadername').val() + '?download'
	});
}

function download_file_data()
{
	show_edit_preview();

	data = $.base64.encode($('#preview').text());

	/* No filename can be specified by a data URI */
	window.location = 'data:application/octet-stream;charset=utf-8;base64,' + data;
}

/* Updates our details counters */
function update_counter()
{
	temp_file_count = 0;
	temp_edit_count = 0;
	temp_line_count = 0;

	/* Because of deleted actions, we can't simply use length */
	for (i = 1; i < file_count; i++)
	{
		/* Skip this edit if we deleted it. */
		if ($('#file-' + i + '-delete').val() == '1')
			continue;

		temp_file_count++;

		for (j = 1; j < edit_count[i]; j++)
		{
			/* Skip this edit if we deleted it. */
			if ($('#file-' + i + '-edit-' + j + '-delete').val() == '1')
			{
				continue;
			}

			temp_edit_count++;

			/* Find out what action we have */
			if ($('#file-' + i + '-edit-' + j + '-action').val() == 'replace')
			{
				search = $('#file-' + i + '-edit-' + j + '-search').val().split("\n").length;
				replace = $('#file-' + i + '-edit-' + j + '-replace').val().split("\n").length;

				if (replace > search)
					temp_line_count += (replace - search);
			}
			else
			{
				temp_line_count += $('#file-' + i + '-edit-' + j + '-replace').val().split("\n").length;
			}
		}
	}

	$('#detail_files').val(temp_file_count);
	$('#detail_edits').val(temp_edit_count);
	$('#detail_lines').val(temp_line_count);
}