<?php
/**
 * The Sidebar containing the main widget areas.
 *
 */
?>
<div class="span4">
	<div class="well sidebar-nav">
            <?php
    if ( function_exists('dynamic_sidebar')) dynamic_sidebar("sidebar-page");
?>
	</div><!--/.well .sidebar-nav -->
</div><!-- /.span4 -->
