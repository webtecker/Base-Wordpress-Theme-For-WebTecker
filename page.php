<?php
/**
 * The template for displaying all pages.
 */

get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
   <div class="container">
    <header class="page-header">
        	<h1><?php the_title();?></h1>
      </header>
        <div class="row content">
			<div class="span8">
            <?php the_content();?>
<?php endwhile; // end of the loop. ?>
          </div><!-- /.span8 -->
          <?php get_sidebar(); ?>
<?php get_footer(); ?>
