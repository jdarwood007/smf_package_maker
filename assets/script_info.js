$(document).ready(function(){
	action_count = 1;
	instruct_count =new Array();
	instruct_count[action_count] = 1;

	create_new_action();

	$('#add_action').click(create_new_action);

	$('#show_preview').click(show_instruct_preview);
});

/* Handles adding actions */
function create_new_action()
{
	/* We have been through this before */
	$('#action_container').append($('#action_template').html().replace(/#ACTIONINDEX#/g, action_count));

	/* We need to bind the new create instruct button */
	$('.add_instruct').click(create_new_instruct);

	/* Now we pretend to click said element */
	$('#action-' + action_count).find('.add_instruct').click();

	/* Now add some actions to our buttons */
	$('#action-' + action_count + ' .collapse_action').click(collapse_action);
	$('#action-' + action_count + ' .expand_action').click(expand_action);
	$('#action-' + action_count + ' .delete_action').click(delete_action);
	$('#action-' + action_count + ' .restore_action').click(restore_action);

	/* Move the index and add defaults */
	action_count++;
	instruct_count[action_count] = 1;

	/* Update our counter */
	update_counter();
}

/* Handles adding of instructions */
function create_new_instruct()
{
	action_index = $(this).attr('data-action');

	$('#action-' + action_index + '-instruct_container').append($('#instruct_template').html().replace(/#ACTIONINDEX#/g, action_index).replace(/#INSTRUCTINDEX#/g, instruct_count[action_index]));

	$('#action-' + action_index + '-instruct_container .collapse_change').click(collapse_instruct);
	$('#action-' + action_index + '-instruct_container .expand_change').click(expand_instruct);
	$('#action-' + action_index + '-instruct_container .delete_change').click(delete_instruct);
	$('#action-' + action_index + '-instruct_container .restore_change').click(restore_instruct);

	$('#action-' + action_index + '-instruct_container .instruct_action').change(instruct_change);
	$('#action-' + action_index + '-instruct-' + instruct_count[action_index] + '-action').change();

	instruct_count[action_index]++;

	update_counter();
}

/* Handles a change in the instruction */
function instruct_change()
{
/*	action_index = $(selected).attr('data-action');
	instruct_index = $(selected).attr('data-instruct');
	this_act = $(selected).val();*/
	action_index = $(this).attr('data-action');
	instruct_index = $(this).attr('data-instruct');
	this_act = $(this).val();

	/* Then choose how to hide them */
	if (this_act == 'modification')
	{
		$('#action-' + action_index + '-instruct-' + instruct_index + ' .destination').hide();
		$('#action-' + action_index + '-instruct-' + instruct_index + ' .inline').hide();
		$('#action-' + action_index + '-instruct-' + instruct_index + ' .code_block').hide();

		$('#action-' + action_index + '-instruct-' + instruct_index + ' .reverse').show();
		$('#action-' + action_index + '-instruct-' + instruct_index + ' .source').show();
	}
	else if ($.inArray(this_act, ["create-dir", "create-file", "remove-dir", "remove-file"]) > -1)
	{
		$('#action-' + action_index + '-instruct-' + instruct_index + ' .reverse').hide();
		$('#action-' + action_index + '-instruct-' + instruct_index + ' .inline').hide();
		$('#action-' + action_index + '-instruct-' + instruct_index + ' .code_block').hide();
		$('#action-' + action_index + '-instruct-' + instruct_index + ' .source').hide();

		$('#action-' + action_index + '-instruct-' + instruct_index + ' .destination').show();
	}
	else if ($.inArray(this_act, ["require-dir", "require-file", "move-dir", "move-file"]) > -1)
	{
		$('#action-' + action_index + '-instruct-' + instruct_index + ' .reverse').hide();
		$('#action-' + action_index + '-instruct-' + instruct_index + ' .inline').hide();
		$('#action-' + action_index + '-instruct-' + instruct_index + ' .code_block').hide();

		$('#action-' + action_index + '-instruct-' + instruct_index + ' .source').show();
		$('#action-' + action_index + '-instruct-' + instruct_index + ' .destination').show();
	}
	else if ($.inArray(this_act, ["code", "database", "readme"]) > -1)
	{
		$('#action-' + action_index + '-instruct-' + instruct_index + ' .reverse').hide();
		$('#action-' + action_index + '-instruct-' + instruct_index + ' .destination').hide();

		$('#action-' + action_index + '-instruct-' + instruct_index + ' .source').show();
		$('#action-' + action_index + '-instruct-' + instruct_index + ' .inline').show();

		/* Set our inline option */
		instruct_inline($('#action-' + action_index + '-instruct-' + instruct_index + '-inline'));
	}
	else
	{
		/* We don't know what to do here! */
		console.log("Unknown instruction action selected" [this_act, action_index, instruct_index], this);
	}

}

/* Handles clicking the inline button */
function instruct_inline(selected)
{
	action_index = $(selected).attr('data-action');
	instruct_index = $(selected).attr('data-instruct');
	is_inline = $(selected).is(':checked');

	if (is_inline)
	{
		$('#action-' + action_index + '-instruct-' + instruct_index + ' .code_block').show();
	}
	else
	{
		$('#action-' + action_index + '-instruct-' + instruct_index + ' .code_block').hide();
	}
}

/* Handles collapsing of the instruct */
function collapse_instruct()
{
	action_index = $(this).attr('data-action');
	instruct_index = $(this).attr('data-instruct');

	/* Simply hide the instruct, and give a expand button */
	$('#action-' + action_index + '-instruct-' + instruct_index + ' .edits').hide();
	$('#action-' + action_index + '-instruct-' + instruct_index + ' .expand_change').show();
	$(this).hide();
}

/* Handles expanding of the instruct */
function expand_instruct()
{
	action_index = $(this).attr('data-action');
	instruct_index = $(this).attr('data-instruct');

	/* Simply show the instruct, and return to the original collapse button */
	$('#action-' + action_index + '-instruct-' + instruct_index + ' .edits').show();
	$('#action-' + action_index + '-instruct-' + instruct_index + ' .collapse_change').show();
	$(this).hide();
}

/* Handles deleting a instruct */
function delete_instruct()
{
	action_index = $(this).attr('data-action');
	instruct_index = $(this).attr('data-instruct');

	/* First we let the data know its deleted. */
	$('#action-' + action_index + '-instruct-' + instruct_index + '-delete').val('1');

	/* Then we hide this header, collapse the instruct and show the restore button */
	$('#action-' + action_index + '-instruct-' + instruct_index + ' .edits').hide();
	$('#action-' + action_index + '-instruct-' + instruct_index + ' .restore_change').show();
	$(this).hide();

	update_counter();
}

/* Handles restoring a instruct */
function restore_instruct()
{
	action_index = $(this).attr('data-action');
	instruct_index = $(this).attr('data-instruct');

	/* First we let the data know its deleted. */
	$('#action-' + action_index + '-instruct-' + instruct_index + '-delete').val('0');

	/* Then we hide this header, collapse the instruct and show the restore button */
	$('#action-' + action_index + '-instruct-' + instruct_index + ' .edits').show();
	$('#action-' + action_index + '-instruct-' + instruct_index + ' .delete_change').show();
	$(this).hide();

	update_counter();
}

/* Handles collapsing of the action */
function collapse_action()
{
	action_index = $(this).attr('data-action');

	/* Simply hide the action, and give a expand button */
	$('#action-' + action_index + '-instruct_container').hide();
	$('#action-' + action_index + ' .expand_action').show();
	$(this).hide();
}

/* Handles expanding of the action */
function expand_action()
{
	action_index = $(this).attr('data-action');

	/* Simply show the action, and return to the original collapse button */
	$('#action-' + action_index + '-instruct_container').show();
	$('#action-' + action_index + ' .collapse_action').show();
	$(this).hide();
}

/* Handles deleting a action */
function delete_action()
{
	action_index = $(this).attr('data-action');

	/* First we let the data know its deleted. */
	$('#action-' + action_index + '-delete').val('1');

	/* Then we hide this header, collapse the instruct and show the restore button */
	$('#action-' + action_index + '-instruct_container').hide();
	$('#action-' + action_index + ' .restore_action').show();
	$(this).hide();

	update_counter();
}

/* Handles restoring a action */
function restore_action()
{
	action_index = $(this).attr('data-action');

	/* First we let the data know its deleted. */
	$('#action-' + action_index + '-delete').val('0');

	/* Then we hide this header, collapse the instruct and show the restore button */
	$('#action-' + action_index + '-instruct-' + instruct_index + ' .instructs').show();
	$('#action-' + action_index + ' .delete_action').show();
	$(this).hide();

	update_counter();
}

/* This is the nasty guy */
function show_instruct_preview()
{
	$('#preview_container').show();

	author = $('#basic_info_name').val().replace(/ /g,'_');
	name = $('#basic_info_mod').val().replace(/ /g,'_');
	version = $('#basic_info_version').val().replace(/ /g,'_');
	type = $('#basic_info_type').val();

	preview = '<!DOCTYPE package-info SYSTEM "http://www.simplemachines.org/xml/package-info">' + "\n" + '\
<!-- This package was generated by SleePys Package Maker at http://sleepycode.com -->' + "\n" + '\
<package-info xmlns="http://www.simplemachines.org/xml/package-info" xmlns:smf="http://www.simplemachines.org/">' + "\n" + '\
	<id>' + author + ':' + name + '</id>' + "\n" + '\
	<name>' + name + '</name>' + "\n" + '\
	<version>' + version + '</version>' + "\n" + '\
	<type>' + type + '</type>' + "\n";

	i = 1;
	for (i = 1; i < action_count; i++)
	{
		/* Skip this instruct if we deleted it. */
		if ($('#action-' + i + '-delete').val() == '1')
		{
			continue;
		}

		/* Get the action info */
		action_type = $('#action-' + i + '-type').val();
		action_smf_versions = $('#action-' + i + '-smf_versions').val();

		/* We only want valid actions */
		if ($.inArray(action_type, ["install", "upgrade", "uninstall"]) > -1)
		{
			preview += "\n" + '\
	<' + action_type;
		}
		else
		{
			preview += "\n" + '\
	<install';
		}

		/* Maybe we are limiting this to specific SMF versions. */
		if (action_smf_versions != '')
		{
			preview += ' for="' + action_smf_versions + '"';
		}
		preview += '>';

		/* Now onto the individual instructions we made! */
		for (j = 1; j < instruct_count[i]; j++)
		{
			/* Skip this instruct if we deleted it. */
			if ($('#action-' + i + '-instruct-' + j + '-delete').val() == '1')
			{
				continue;
			}

			/* Get our instruction info */
			instruct_action		=	$('#action-' + i + '-instruct-' + j + '-action').val();
			instruct_reverse	=	$('#action-' + i + '-instruct-' + j + '-reverse').is(':checked');
			instruct_inline		=	$('#action-' + i + '-instruct-' + j + '-reverse').is(':checked');
			instruct_source		=	$('#action-' + i + '-instruct-' + j + '-source').val();
			instruct_destination=	$('#action-' + i + '-instruct-' + j + '-destination').val();
			instruct_block		=	$('#action-' + i + '-instruct-' + j + '-block').val().replace('<' + '?php', '').replace('?' + '>', '');

			/* Try to make it easier to handle these */
			if ($.inArray(instruct_action, ["modification", "code", "database", "readme"]) > -1)
			{
				preview += "\n" + '\
		<' + instruct_action;

				/* Technically only modification should use reverse.
					Code can just check $context['uninstall'] or use another file*/
				if (instruct_reverse && instruct_action == 'modification')
				{
					preview += ' reverse="true"'; 
				}

				if (instruct_inline && $.inArray(instruct_action, ["code", "database", "readme"]) > -1)
				{
					preview += ' inline="true"';
				}

				if (instruct_inline && $.inArray(instruct_action, ["code", "database", "readme"]) > -1)
				{
					preview += '>' + instruct_block + "\n" + '\
		</' + instruct_action + '>';
				}
				else
				{
					preview += " />\n";
				}
			}
			else if ($.inArray(instruct_action, ["create-dir", "create-file", "remove-dir", "remove-file"]) > -1)
			{
				/* It may seem confusing to use destination here as name while the others use source.
					Logic is just easier to follow from the GUI to think of destination as what happens to the SMF install,
					While source is where it is in the modification. */
				preview += "\n" + '\
		<' + instruct_action + ' name="' + instruct_destination + '" />';
			}
			else if ($.inArray(instruct_action, ["require-dir", "require-file", "move-dir", "move-file"]) > -1)
			{
				/* We use source and destination correctly here, see note above for those actions. */
				preview += "\n" + '\
		<' + instruct_action + ' name="' + instruct_source + '" destination="' + instruct_destination + '" />';
			}
			else
			{
				/* We don't know what to do here! */
				console.log("Unknown instruction action selected" [instruct_action, i, j], this);
			}

		}

		/* Close up the action instruct */
		if ($.inArray(action_type, ["install", "upgrade", "uninstall"]) > -1)
		{
			preview += "\n" + '\
	</' + action_type + '>';
		}
		else
		{
			preview += "\n" + '\
	</install>';
		}

	}

	$('#preview').text(preview);
}

function download_action_generate()
{
	show_instruct_preview();

	$.generateaction({
		actionname	: "install.xml",
		content		: $('#preview').text(),
		script		: "downloader.php?download"
	});
}

function download_action_data()
{
	show_instruct_preview();

	data = $.base64.encode($('#preview').text());

	/* No actionname can be specified by a data URI */
	window.location = "data:application/octet-stream;charset=utf-8;base64," + data;
}

/* Updates our details counters */
function update_counter()
{
	temp_action_count = 0;
	temp_instruct_count = 0;

	/* Because of deleted actions, we can't simply use length */
	for (i = 1; i < action_count; i++)
	{
		/* Skip this instruct if we deleted it. */
		if ($('#action-' + i + '-delete').val() == '1')
			continue;

		temp_action_count++;

		for (j = 1; j < instruct_count[i]; j++)
		{
			/* Skip this instruct if we deleted it. */
			if ($('#action-' + i + '-instruct-' + j + '-delete').val() == '1')
			{
				continue;
			}

			temp_instruct_count++;
		}
	}

	$('#detail_actions').val(temp_action_count);
	$('#detail_instructs').val(temp_instruct_count);
}