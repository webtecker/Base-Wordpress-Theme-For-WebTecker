<?php
/**
 * The template for displaying Author Archive pages.
 */

get_header(); ?>

<?php if ( have_posts() ) : ?>

	<?php
	/* Queue the first post, that way we know
	 * what author we're dealing with (if that is the case).
	 *
	 * We reset this later so we can run the loop
	 * properly with a call to rewind_posts().
	 */
	the_post();
	?>
	<div class="container">
		<header class="hero-unit" id="overview">
			<h1 class="page-title author"><?php printf( __( 'Author Archives: %s', 'webtecker' ), '<span class="vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
		</header>
		<?php
					/* Since we called the_post() above, we need to
					 * rewind the loop back to the beginning that way
					 * we can run the loop properly, in full.
					 */
					rewind_posts();
					?>
					<div class="row content">
						<div class="span8">
							<?php /* Start the Loop */ ?>
							<?php while ( have_posts() ) : the_post(); ?>
							<div <?php post_class(); ?>>
								<a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><h3><?php the_title();?></h3></a>
								<p class="meta"><?php echo webtecker_posted_on();?></p>
								<div class="row">
									        <div class="span2">
									        	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
          										<?php echo webtecker_autoset_featured_img(); ?></a>
									        </div><!-- /.span2 -->
									        <div class="span6">
									        	<?php the_excerpt();?>
									        </div><!-- /.span6 -->
									    </div><!-- /.row -->
									    <hr />
									</div><!-- /.post_class -->
								<?php endwhile; ?>
							<?php endif; ?>
						</div><!-- /.span8 -->
						<?php get_sidebar(); ?>

		<?php get_footer(); ?>