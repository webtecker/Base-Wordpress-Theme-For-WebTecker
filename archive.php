<?php
/**
 * The template for displaying Archive pages.
 */

get_header();
if (have_posts() ) ;?>
<div class="container">
	<header class="hero-unit" id="overview">
		<h1><?php
		if ( is_day() ) {
			printf( __( 'Daily Archives: %s', 'webtecker' ), '<span>' . get_the_date() . '</span>' );
		} elseif ( is_month() ) {
			printf( __( 'Monthly Archives: %s', 'webtecker' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'webtecker' ) ) . '</span>' );
		} elseif ( is_year() ) {
			printf( __( 'Yearly Archives: %s', 'webtecker' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'webtecker' ) ) . '</span>' );
		} elseif ( is_tag() ) {
			printf( __( 'Tag Archives: %s', 'webtecker' ), '<span>' . single_tag_title( '', false ) . '</span>' );
					// Show an optional tag description
			$tag_description = tag_description();
			if ( $tag_description )
				echo apply_filters( 'tag_archive_meta', '<div class="tag-archive-meta">' . $tag_description . '</div>' );
		} elseif ( is_category() ) {
			printf( __( 'Category Archives: %s', 'webtecker' ), '<span>' . single_cat_title( '', false ) . '</span>' );
					// Show an optional category description
			$category_description = category_description();
			if ( $category_description )
				echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
		} else {
			_e( 'Blog Archives', 'webtecker' );
		}
		?></h1>
	</h1>
</header>

<div class="row content">
	<div class="span8">
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
			<?php webtecker_pagination();?>

		</div><!-- /.span8 -->
		<?php get_sidebar(); ?>

<?php get_footer(); ?>