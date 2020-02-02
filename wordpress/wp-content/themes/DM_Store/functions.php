<?php	
	
	// require du fichier custom navwalker necessaire au bon affichage du menu bootstrap4 sur WP
	require_once('bs4navwalker.php');
	

	
	// --- REGION/WIDGET
	add_action( 'widgets_init', 'nouveau_theme_init_sidebar' ); // j'exécute la fonction nommé "nouveau_theme_init_sidebar".
	function nouveau_theme_init_sidebar() // fonction qui contient la déclaration de mes régions.
	{
		if(function_exists('register_sidebar')) // si la fonction register_sidebar existe (c'est une fonction interne à wordpress), alors je déclare des régions.
		{
			register_sidebar( array(
				'name'          => __( 'region-entete', 'nouveau_theme' ),
				'id'            => 'region-entete',
				'description'   => __( 'Add widgets here to appear in your entete region.', 'nouveau_theme' )
			) );
			register_sidebar( array(
				'name'          => __( 'colonne de droite', 'nouveau_theme' ),
				'id'            => 'colonne-droite',
				'description'   => __( 'Add widgets here to appear in your colonne droite region.', 'nouveau_theme' )
			) );
			register_sidebar( array(
				'name'          => __( 'region-footer', 'nouveau_theme' ),
				'id'            => 'region-footer',
				'description'   => __( 'Add widgets here to appear in your region.', 'nouveau_theme' )
			) );
		}
	}


	
	$defaults = array(
    'default-color'          => '',
    'default-image'          => '',
    'default-repeat'         => '',
    'default-position-x'     => '',
    'default-attachment'     => '',
    'wp-head-callback'       => '_custom_background_cb',
    'admin-head-callback'    => '',
    'admin-preview-callback' => ''
);
add_theme_support( 'custom-background', $defaults );
	
	

	add_theme_support( 'custom-logo' );
	add_theme_support('custom-background');
	add_theme_support( 'customize-selective-refresh-widgets' );
	

	function domostore_custom_header_setup() {
		$args = array(
			'default-image' => get_stylesheet_directory_uri() . '/assets/img/house.jpg', 
			'header-selector' => '.main-image',
			'default-text-color' => '000',
			'width'              => 1000,
			'height'             => 250,
			'flex-width'         => true,
			'flex-height'        => true,
		);
		add_theme_support( 'custom-header', $args );
	}
	add_action( 'after_setup_theme', 'domostore_custom_header_setup' );

	function register_my_menus() {
		register_nav_menus(
		array(
		'primary' => __( 'Header Navigation Menu' ),
		'secondary' => __( 'Menu Secondaire' ),
		'footer-menu' => __( 'Menu Footer' ),
		)
		);
	   }
	   add_action( 'init', 'register_my_menus' );

// Change le texte 'Ajouter au panier' sur la page de produit unique

add_filter( 'woocommerce_product_single_add_to_cart_text', 'bryce_add_to_cart_text' );

function bryce_add_to_cart_text() {

        return __( 'Acheter maintenant', 'woocommerce' );

}

// Change le texte 'Ajouter au panier' sur la page archive des produits

add_filter( 'woocommerce_product_add_to_cart_text', 'bryce_archive_add_to_cart_text' );

function bryce_archive_add_to_cart_text() {

        return __( 'Acheter', 'your-slug' );

}

//feuille de style personnalisée pour la page login WordPress
function login_stylesheet() {
	wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/login.css' );
}
add_action( 'login_enqueue_scripts', 'login_stylesheet' );

// récupérer image article 
function catch_that_image() {
	global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	$first_img = $matches [1] [0];
	
	if(empty($first_img)){ //Defines a default image
	$first_img = "/images/default.jpg";
	}
	return $first_img;
	}

	add_theme_support( 'post-thumbnails' );

	// Définir la taille des images mises en avant
	set_post_thumbnail_size( 320, 240, true );
	
	// Définir d'autres tailles d'images
	add_image_size( 'products', 800, 600, false );
	add_image_size( 'square', 256, 256, false );


	//WOOCOMMERCE

	// Gérer les blocs de description produits

add_filter( 'woocommerce_product_tabs', 'wpm_remove_product_tabs', 98 );

function wpm_remove_product_tabs( $tabs ) {

    unset( $tabs['description'] );      	// Supprime le bloc "Description"
    unset( $tabs['reviews'] ); 			// Supprime le bloc "Avis"
    unset( $tabs['additional_information'] );  	// Supprime le bloc "Information complémentaires"

    return $tabs;

}

function woocommerce_related_products( $args = array() ) {
    global $product;

    if ( ! $product ) {
      return;
    }

    $defaults = array(
      'posts_per_page' => 2,
      'columns'        => 2,
      'orderby'        => 'rand', // @codingStandardsIgnoreLine.
      'order'          => 'desc',
    );

    $args = wp_parse_args( $args, $defaults );

    // Get visible related products then sort them at random.
    $args['related_products'] = array_filter( array_map( 'wc_get_product', wc_get_related_products( $product->get_id(), $args['posts_per_page'], $product->get_upsell_ids() ) ), 'wc_products_array_filter_visible' );

    // Handle orderby.
    $args['related_products'] = wc_products_array_orderby( $args['related_products'], $args['orderby'], $args['order'] );

    // Set global loop values.
    wc_set_loop_prop( 'name', 'related' );
    wc_set_loop_prop( 'columns', apply_filters( 'woocommerce_related_products_columns', $args['columns'] ) );

    wc_get_template( 'single-product/related.php', $args );
  }
  
/**
 * Change number of related products output
 */ 
function woo_related_products_limit() {
	global $product;
	  
	  $args['posts_per_page'] = 6;
	  return $args;
  }
  add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args', 20 );
	function jk_related_products_args( $args ) {
	  $args['posts_per_page'] = 3; // 4 related products
	  $args['columns'] = 3; // arranged in 2 columns
	  return $args;
  }

?>