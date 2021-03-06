<?php get_header('search'); 

 $product =wc_get_product();

$args =array(
    'post_type'=>'product',
);
$result = new wp_query($args);
?>

<div class="container-fluid">

    <div class="search_title" id="cart-title">
        <h2>Votre Recherche</h2>
        <span class="ligne"></span>
    </div>

    <div class="row">
        
    
 <!-- DEBUT de la boucle -->
 <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
 $id = get_the_id();
 $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->$id ));
 ?>

<div class="card-deck">
  <div class="card" style="width: 18rem;">
    <a href="<?php the_permalink();?>">
      <img src="<?php echo esc_url( $image[0] ); ?>" alt="View more info" />
    </a>
  <div class="card-body">
    <a href="<?php the_permalink();?>">
      <h5 class="card-title"><?php the_title();?></h5>
    </a>
    <p class="card-text card_price"><?php echo $product->get_price();?> € </p>
  <div class="btn_achat"><?php echo do_shortcode('[add_to_cart id="'.$id.'"]');?></div>
  </div>
</div>
</div>  

    
 <!-- FIN de la boucle -->
 <?php endwhile; else: ?>
 
 <p>
 <?php _e("Aucun résultat pour cette recherche"); ?>
 </p>
 <?php endif; ?>
 
    </div> <!-- FIN row -->
</div>  <!-- FIN container -->


<?php get_footer('search'); ?>