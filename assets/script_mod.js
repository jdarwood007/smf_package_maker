/*
 * SMF Package Manager Generator
 * Author: SleePy (JeremyD)
 * Repository: https://github.com/jdarwood007/smf_package_maker
 * License: BSD 3 Clause; See license.txt
*/
window.$j = jQuery.noConflict();

/* This gets things going once the document has loaded, also makes sure JQuery is here. */
jQuery(document).ready(function(){
	/* Start off some counting */
	window.file_count = 1;
	window.edit_count = new Array();
	edit_count[file_count] = 1;

	/* Bind some stuff to our files, using live so they auto update as new stuff is added. */
	$j(document).on('click', '.collapse_file', collapse_file);
	$j(document).on('click', '.expand_file', expand_file);
	$j(document).on('click', '.delete_file', delete_file);
	$j(document).on('click', '.restore_file', restore_file);

	/* Now we will bind to the actual edits, again using live. */
	$j(document).on('click', '.collapse_change', collapse_edit);
	$j(document).on('click', '.expand_change', expand_edit);
	$j(document).on('click', '.delete_change', delete_edit);
	$j(document).on('click', '.restore_change', restore_edit);

	/* Give our buttons some actions. */
	$j('#add_file').click(create_new_file);
	$j(document).on('click', '.add_edit', create_new_edit);
	$j('#show_preview').click(show_edit_preview);

	/* The details and basic buttons. */
	$j('#collapse_basic').click(function(){$j('#basic_info .info').hide(); $j('#collapse_basic').hide(); $j('#restore_basic').show();});
	$j('#restore_basic').click(function(){$j('#basic_info .info').show(); $j('#restore_basic').hide(); $j('#collapse_basic').show();});
	$j('#collapse_details').click(function(){$j('#details_info .info').hide(); $j('#collapse_details').hide(); $j('#restore_details').show();});
	$j('#restore_details').click(function(){$j('#details_info .info').show(); $j('#restore_details').hide(); $j('#collapse_details').show();});

	/* Kick things off by creating a file. */
	create_new_file();
});

/* Handles adding files */
function create_new_file()
{
	/* We have been through this before */
	$j('#file_container').append($j('#file_template').html().replace(/#FILEINDEX#/g, file_count));

	/* Now we pretend to click said element */
	$j('#file-' + file_count).find('.add_edit').click();

	/* Move the index and add defaults */
	file_count++;
	edit_count[file_count] = 1;

	update_counter();
}

/* Handles adding of edits */
function create_new_edit()
{
	var file_index = $j(this).attr('data-file');

	$j('#file-' + file_index + '-edit_container').append($j('#edit_template').html().replace(/#FILEINDEX#/g, file_index).replace(/#EDITINDEX#/g, edit_count[file_index]));
	edit_count[file_index]++;

	update_counter();
}

/* Handles collapsing of the edit */
function collapse_edit()
{
	var file_index = $j(this).attr('data-file');
	var edit_index = $j(this).attr('data-edit');

	/* Simply hide the edit, and give a expand button */
	$j('#file-' + file_index + '-edit-' + edit_index + ' .edits').hide();
	$j('#file-' + file_index + '-edit-' + edit_index + ' .expand_change').show();
	$j(this).hide();

	return false;
}

/* Handles expanding of the edit */
function expand_edit()
{
	var file_index = $j(this).attr('data-file');
	var edit_index = $j(this).attr('data-edit');

	/* Simply show the edit, and return to the original collapse button */
	$j('#file-' + file_index + '-edit-' + edit_index + ' .edits').show();
	$j('#file-' + file_index + '-edit-' + edit_index + ' .collapse_change').show();
	$j(this).hide();

	return false;
}

/* Handles deleting a edit */
function delete_edit()
{
	var file_index = $j(this).attr('data-file');
	var edit_index = $j(this).attr('data-edit');

	/* First we let the data know its deleted. */
	$j('#file-' + file_index + '-edit-' + edit_index + '-delete').val('1');

	/* Then we hide this header, collapse the edit and show the restore button */
	$j('#file-' + file_index + '-edit-' + edit_index + ' .edits').hide();
	$j('#file-' + file_index + '-edit-' + edit_index + ' .restore_change').show();
	$j(this).hide();

	update_counter();
	return false;
}

/* Handles restoring a edit */
function restore_edit()
{
	var file_index = $j(this).attr('data-file');
	var edit_index = $j(this).attr('data-edit');

	/* First we let the data know its deleted. */
	$j('#file-' + file_index + '-edit-' + edit_index + '-delete').val('0');

	/* Then we hide this header, collapse the edit and show the restore button */
	$j('#file-' + file_index + '-edit-' + edit_index + ' .edits').show();
	$j('#file-' + file_index + '-edit-' + edit_index + ' .delete_change').show();
	$j(this).hide();

	update_counter();
	return false;
}

/* Handles collapsing of the file */
function collapse_file()
{
	var file_index = $j(this).attr('data-file');

	/* Simply hide the file, and give a expand button */
	$j('#file-' + file_index + '-edit_container').hide();
	$j('#file-' + file_index + ' .expand_file').show();
	$j(this).hide();

	return false;
}

/* Handles expanding of the file */
function expand_file()
{
	var file_index = $j(this).attr('data-file');

	/* Simply show the file, and return to the original collapse button */
	$j('#file-' + file_index + '-edit_container').show();
	$j('#file-' + file_index + ' .collapse_file').show();
	$j(this).hide();

	return false;
}

/* Handles deleting a file */
function delete_file()
{
	var file_index = $j(this).attr('data-file');

	/* First we let the data know its deleted. */
	$j('#file-' + file_index + '-delete').val('1');

	/* Then we hide this header, collapse the edit and show the restore button */
	$j('#file-' + file_index + '-edit_container').hide();
	$j('#file-' + file_index + ' .restore_file').show();
	$j(this).hide();

	update_counter();
	return false;
}

/* Handles restoring a file */
function restore_file()
{
	var file_index = $j(this).attr('data-file');

	/* First we let the data know its deleted. */
	$j('#file-' + file_index + '-delete').val('0');

	/* Then we hide this header, collapse the edit and show the restore button */
	$j('#file-' + file_index + '-edit_container').show();
	$j('#file-' + file_index + ' .delete_file').show();
	$j(this).hide();

	update_counter();
	return false;
}

/* This is the nasty guy */
function show_edit_preview()
{
	$j('#preview_container').show();

	var author = $j('#basic_info_name').val().replace(/ /g,'_');
	var name = $j('#basic_info_mod').val().replace(/ /g,'_');
	var version = $j('#basic_info_version').val().replace(/ /g,'_');

	var preview = '<' + '?xml version="1.0"?' + '>' + "\n" + '\
<!DOCTYPE modification SYSTEM "http://www.simplemachines.org/xml/modification">' + "\n" + '\
<!-- This package was generated by SleePys Modification Maker at https://sleepycode.com -->' + "\n" + '\
<modification xmlns="http://www.simplemachines.org/xml/modification" xmlns:smf="http://www.simplemachines.org/">' + "\n" + '\
	<id>' + author + ':' + name + '</id>' + "\n" + '\
	<version>' + version + '</version>' + "\n";

	i = 1;
	for (i = 1; i < file_count; i++)
	{
		/* Skip this edit if we deleted it. */
		if ($j('#file-' + i + '-delete').val() == '1')
		{
			continue;
		}

		/* Find our edit count */
		var ecount = edit_count[i];

		/* Get the file info */
		var file_type = $j('#file-' + i + '-file_type').val();
		var file_name = $j('#file-' + i + '-file_name').val();
		var file_fail = $j('#file-' + i + '-file_fail').val();

		/* Start off with the file attribute */
		preview += "\n" + '\
	<file name="' + file_type + '/' + file_name + '"';

		/* We don't need to define the default error type. */
		if ($j.inArray(file_fail, ["ignore", "skip"]) > -1)
		{
			preview += ' error="' + file_fail + '"';
		}
		preview += '>';

		/* Now onto the individual edits we made! */
		for (j = 1; j < ecount; j++)
		{
			/* Skip this edit if we deleted it. */
			if ($j('#file-' + i + '-edit-' + j + '-delete').val() == '1')
			{
				continue;
			}

			/* Get our edit info */
			var edit_action		=	$j('#file-' + i + '-edit-' + j + '-action').val();
			var edit_error		=	$j('#file-' + i + '-edit-' + j + '-error').val();
			var edit_whitespace	=	$j('#file-' + i + '-edit-' + j + '-action').is(':checked');
			var edit_search		=	$j('#file-' + i + '-edit-' + j + '-search').val();
			var edit_replace	=	$j('#file-' + i + '-edit-' + j + '-replace').val();

			/* Start off our editing */
			preview += "\n\
		<operation";

			/* We only need to add error handling for non default */
			if ($j.inArray(edit_error, ["ignore", "required"]) > -1)
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

	$j('#preview').text(preview);
}

function download_file_generate()
{
	show_edit_preview();

	$j.generateFile({
		filename	: 'install.xml',
		content		: $j('#preview').text(),
		script		: $j('#downloadername').val() + '?download'
	});
}

function download_file_data()
{
	show_edit_preview();

	data = $j.base64.encode($j('#preview').text());

	/* No filename can be specified by a data URI */
	window.location = 'data:application/octet-stream;charset=utf-8;base64,' + data;
}

/* Updates our details counters */
function update_counter()
{
	var temp_file_count = 0;
	var temp_edit_count = 0;
	var temp_line_count = 0;

	/* Because of deleted actions, we can't simply use length */
	for (i = 1; i < file_count; i++)
	{
		/* Skip this edit if we deleted it. */
		if ($j('#file-' + i + '-delete').val() == '1')
			continue;

		temp_file_count++;

		for (j = 1; j < edit_count[i]; j++)
		{
			/* Skip this edit if we deleted it. */
			if ($j('#file-' + i + '-edit-' + j + '-delete').val() == '1')
			{
				continue;
			}

			temp_edit_count++;

			/* Find out what action we have */
			if ($j('#file-' + i + '-edit-' + j + '-action').val() == 'replace')
			{
				var search = $j('#file-' + i + '-edit-' + j + '-search').val().split("\n").length;
				var replace = $j('#file-' + i + '-edit-' + j + '-replace').val().split("\n").length;

				if (replace > search)
					temp_line_count += (replace - search);
			}
			else
			{
				temp_line_count += $j('#file-' + i + '-edit-' + j + '-replace').val().split("\n").length;
			}
		}
	}

	$j('#detail_files').val(temp_file_count);
	$j('#detail_edits').val(temp_edit_count);
	$j('#detail_lines').val(temp_line_count);
}