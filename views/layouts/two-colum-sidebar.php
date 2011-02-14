<header id="header" class="body">
	<?php echo empty($header) ? '' : $header; ?>
</header>

<div id="content" class="body">
	<div class="column left">
		<?php echo empty($left_column) ? '' : $left_column; ?>
	</div>
	
	<div class="column right">
		<?php echo empty($right_column) ? '' : $right_column; ?>
	</div>
	
	<aside>
		<?php echo empty($sidebar) ? '' : $sidebar; ?>
	</aside>
</div>

<footer id="footer" class="body">
	<?php echo empty($footer) ? '' : $footer; ?>
</footer>