<?php get_header(); // appel du fichier header.php 


if ( is_product_category() ){ global $wp_query; $cat = $wp_query->get_queried_object();
	$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
	$image = wp_get_attachment_url( $thumbnail_id );
	// if ( $image ) {
	// 	echo '<img class="classtopright" src="' . $image . '" alt="" width="280"/>';
	// }
}
?>
<div class="container">
<!-- Example row of columns -->
	<div class="title_page" style="background: url(<?php echo $image;?>) no-repeat; 
	background-size: cover;
	background-position: center">

		<h2>
			<a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a>
		</h2>
						
	</div> <!-- fin div title_page-->

	<div class="row">
		<div class="col-md-3 col-sm-12 sidebar">
		<?php echo get_sidebar('entete');  ?>
		</div>

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				
		<div class="col-md-9 col-sm-12">
					
			<div class="contenu"><?php the_content(); ?></div>
		</div>

		<?php endwhile; else: ?>

		<div class="col-md-8 col-sm-12">

			<p><?php _e('Sorry, no posts matched your criteria.','DM_Store'); ?></p>

		</div>

		
	</div><!-- /row -->

		<?php endif; ?>
</div> <!-- /container -->
				 
<?php get_footer(); // appel du fichier footer.php ?>