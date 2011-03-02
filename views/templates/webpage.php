<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<title><?php echo empty($title) ? 'Untitled' : $title; ?></title>

<?php foreach ($metas as $attributes) echo '<meta'.HTML::attributes($attributes).' />', "\n"; ?>
<?php foreach ($styles as $file => $attributes) echo HTML::style($file, $attributes), "\n"; ?>
<?php foreach ($scripts as $file => $attributes) echo HTML::script($file, $attributes), "\n"; ?>

</head>

<body class="<?php echo $layout_class; ?>">
	
<?php echo $pre_scripts; ?>

<?php echo $layout; ?>

<?php echo $post_scripts; ?>

</body>
</html>