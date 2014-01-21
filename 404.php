<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 */
get_header(); ?>
   <div class="container">

      
 <!-- Masthead
      ================================================== -->
      <header class="hero-unit" id="overview">
        <h1><?php _e( 'This is Embarrassing', 'webtecker' ); ?></h1>
        <p class="lead"><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching, or one of the links below, can help.', 'webtecker' ); ?></p>
      </header>
	  
        <div class="row content">
<div class="span8">
					

<div class="well">
					<?php webtecker_wpsearch(); ?>

</div><!--/.well -->
<div class="row">
<div class="span4">
					<h2>All Pages</h2>
					<?php wp_page_menu(); ?>
</div><!--/.span4 -->
<div class="span4">
					<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

					
						<h2><?php _e( 'Most Used Categories', 'webtecker' ); ?></h2>
						<ul>
						<?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
						</ul>
					
</div><!--/.span4 -->
</div><!--/.row -->
					</div><!--/.span8 -->
 <?php get_sidebar(); ?>

<?php get_footer(); ?>