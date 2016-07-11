<?php
require_once 'paths.php';
include 'zoumi.php';
$tfile = 'app.txt';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Dir Structure</title>
	<link rel="stylesheet" href="icomoon/style.css">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<header class="pa">
		<a href="index.php" class="icon-home"></a>
		<a href="#" class="icon-options"></a>
		<a href="#" class="icon-panel"></a>
		<a href="#" class="icon-sort"></a>
		<a href="#" class="icon-apply-sort"></a>
		<a href="#" class="icon-save"></a>
	</header>
	<aside class="pa">
		<form action="save.php" method="POST">
			<textarea name="content" data-saved="true" spellcheck="false"><?php echo file_get_contents('dirs/'.$tfile); ?></textarea>
			<input name="file" type="hidden" value="<?php echo $tfile; ?>">
			<input id="save" type="submit" class="dn">
		</form>
	</aside>
	<section class="pa">
		<?php
		// getDirs('sample.txt');
		getDirs($tfile);
		// include 'sort.php';
		?>
	</section>
	<!-- Scripts -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="tinysort.min.js"></script>
	<script src="scripts.js"></script>
</body>
</html>