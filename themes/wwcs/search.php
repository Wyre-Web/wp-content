<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package wwcs
 */

if(isset($_GET['price'])){
    $search = esc_attr($_GET['price']);
}
if(isset($_GET['s'])){
$s_query = esc_attr($_GET['s']);
}

$args = array(

        'post_type' => 'product',
         'posts_per_page' => -1,
         'meta_query' => array (
         'relation' => 'AND',
                 array(
         'key' => 'price',
         'value' => $search,
         'compare' => 'IN',

                 ),
             'relation' => 'OR',
             array(
         'key' => 'post_title',
         'value' => $s_query,
         'compare' => 'IN',
             )
         )

);

$query = new WP_Query($args);
//var_dump($query);
get_header();
?>

	<main id="primary" class="container-fluid">

		<?php if ($query->have_posts() ) : ?>

			<header class="container-fluid text-center">
				<h1 class="page-title" style="padding-top:15px;padding-bottom:15px;">
                    Choreography Store

				</h1>
                <hr>
			</header><!-- .page-header -->
        <div class="container-fluid">
        <div class="w-100 row" style="padding-left:5%!important;padding-top:8px;!important;padding-bottom:2px!important;margin-bottom: 10px!important;">

            <div class="col-md-2" style="margin-right:10px!important;">
                <div class="dropdown">
                    <button style="width:95%;" type="button" id="price_filter" class="btn btn-price-filter dropdown-toggle" data-toggle="dropdown">
                        Filter by price
                    </button>
                    <div class="dropdown-menu">
                        <?php
                        echo do_shortcode('[price_list_filter]')
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dropdown">
                    <button type="button" style="width:95%!important;" id="chor_filter" class="btn btn-price-filter dropdown-toggle" data-toggle="dropdown">
                        Filter by choreographer:
                    </button>
                    <div class="dropdown-menu">
                        <?php echo do_shortcode('[choreographer_list_filter]') ?>
                    </div>
                </div>
            </div>
            <div class="col-md-5">


                <?php echo do_shortcode('[pan_product_search_filter]') ?>
            </div>


        </div>
        <hr>

            <div class="col-md-12">
            <div class="row">
			<?php
			/* Start the Loop */
			while ( $query->have_posts() ) :
				$query->the_post();

				get_template_part( 'template-parts/content', 'search' );

			endwhile;
            wp_reset_postdata();
		endif;

		?>
            </div>
            </div>

            </div>

        <div class="row">
            <div class="col-12">
                <?php echo do_shortcode('[tag_cloud]') ?>
            </div>
        </div>
	</main><!-- #main -->



<?php
/*//get_sidebar();*/
get_footer();