<?php require('logic/logic.php');?>
<html>
<head>
	<script src="js/jquery.min.js"></script>
	<script src="js/horizontal_scroll.js"></script>
	<link rel="stylesheet" type="text/css" href="styles/style.css"/> 
	<title>Site Title | <?php get_current_gallery_name() ?></title>
</head>
<body>
	<div id="wrap">
		<div id="left_content">
			<div id="header">
				<div id="logo">
					this is where your branding goes
				</div>
			</div>
			<div id="left_nav">
				<?php get_directories();?>
			</div>
		</div>
		<div id="images">
			<?php get_images();?>
		</div>
	</div>
</body>

</html>
