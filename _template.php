<?php
if (!defined('PacManGen')) exit;

function template_header()
{
?>
<!DOCTYPE html><!-- HTML 5 -->
<html dir="ltr" lang="en-US">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title><?=PCG::getTitle()?></title>
	<link rel="stylesheet" id="<?=PCG::getStyle()?>-css" href="<?=PCG::getAssets()?>/<?=PCG::getTitle()?>.css" type="text/css" media="all">
	<script type="text/javascript" src="<?=PCG::getTitle()?>/jquery.min.js"></script>
	<meta name="viewport" content="width=device-width,initial-scale=1">
</head>

<body class="home blog">
<div id="wrapper">
	<div id="header">
		<div id="head">
			<div id="logo"><a href="<?=PCG::getURL('home')?>"><img src="<?=PCG::getAssets()?>/logo.png" alt="SleePyCode" class="alignleft"></a><h1>SMF Package Generator</h1></div>
		</div>
		<div class="clear"></div>
	</div>
	<div id="container">
		<div id="wrap" style="min-height: 41em;">
<?php
}


function template_footer()
{
?>
	</div>
</div>
<div id="footer">
	<div id="foot"> Test </div>
	<div class="clear"></div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('.add').click(function(){
		var id = $(this).attr('data-id');

		$.ajax({
			type: 'POST',
			url: '<?=basename(__FILE__)?>?update',
			data: 'id=' + id,
			success: function(data){
				if (data != 'FAIL')
				{
					$('#chapter_' + id).html(data);
					$('#change_' + id).hide();
				}
			}
		});
	});

	$('.change').click(function(){
		var id = $(this).attr('data-id');
		$('#change_' + id).show();
	});

	$('.ichange').keydown(function(e){
		if(e.keyCode != 13 && e.keyCode != 9){
			return;
		}
		var id = $(this).attr('data-id');
		var chap = $(this).val();

		$.ajax({
			type: 'POST',
			url: '<?=basename(__FILE__)?>?updatechap',
			data: 'id=' + id + '&chap=' + chap,
			success: function(data){
				if (data != 'FAIL')
				{
					$('#chapter_' + id).html(data);
					$('#change_' + id).hide();
				}
			}
		});	
	});

});
</script>
</body>
</html>
<?php
}