<?php
/**
 * Template Name: Search Page
 */
global $wp_query;

get_header();
if(isset($_GET['choreographer']) && isset($_GET['n'])) {
   // $s = filter_input(INPUT_GET, 'cs', FILTER_SANITIZE_STRING);
    //$the_choreographer = trim(filter_input(INPUT_GET, 'choreographer', FILTER_SANITIZE_STRING));
    $the_choreographer = $_GET['choreographer'];
    //$results_name = $_GET['n'];
    $results_name = trim(filter_input(INPUT_GET, 'n', FILTER_SANITIZE_STRING));
}

$search_query = array(
    'post_type' => 'product',
    'post_status' => 'publish',
    'numberposts' => 50,
    'meta_query' => array(
       // 'relation' => 'AND',
        array(
            'meta_key' => '_choreographer',
            'meta_value'    => $the_choreographer,
            'compare' =>'IN',
        ),

    ),
);
$product_search_results = get_posts($search_query);
?>
<div class="container-fluid text-center">
    <h1 class="woocommerce-products-header__title page-title" style="color:#fff!important;padding-top:15px;padding-bottom:15px;">Choreography Store</h1>
    <hr style="border-top: 1px solid rgba(255,255,255,0.1);" >
</div>
<div class="container-fluid" style="min-height:80vh;">
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

    <div class="row">
<?php
foreach($product_search_results as $product)  {
    $product_id = $product->ID;
    $meta = get_post_meta($product_id);
   // var_dump($meta);
    $tags = get_field('artist', $product_id);
    $choreographers = array();
    $choreographers = get_field('choreographer', $product_id);
    if($choreographers) {
        foreach ($choreographers as $choreographer) {
            //$choreographer_id = $meta["choreographer"][0];
            $choreographer_id = $choreographer["ID"];
           $choreographer_name =  $choreographer["display_name"].'&nbsp;&nbsp;';
        }

    }
    //$choreographer_name = trim($choreographer_name);
    $choreographer_id = intval($choreographer_id);
    $the_choreographer = intval($the_choreographer);
    //echo $choreographer_name;


    //var_dump($choreographers);
    $fitness_track = get_field('fitness_track',$product_id);
    $price = get_field('price', $product_id);
    $link = get_the_permalink($product_id);
    $title = get_the_title($product_id);
    //echo $the_choreographer;
   // echo $choreographer_name;
    if(($the_choreographer === $choreographer_id) && ($the_choreographer != null)) {

        ?>
        <div style="margin-bottom: 10px;padding-left:2.5%!important;" class="col-md-3 text-center" id="<?php echo $product_id ?>">

            <div class="inner-prod" style="width:90%!important;padding-bottom:35px;position:relative;min-height:23em;">

                <div class="w-100" style="min-height: 40px;">
                    <?php
                    if($fitness_track == true) { ?>
                        <p class="float-left" style="color:#fff!important;font-size:12px;padding:3px;background-color: #000000;"><i class="fas fa-burn" style="color: #ffa600;font-size:16px!important;"></i>&nbsp;fitness track</p>
                        <?php
                    }
                    if (current_user_can('administrator') || current_user_can('site_owner') )  {
                        echo '<a title="Edit '.$title.'?" style="font-size:15px;padding:2px;float:left;margin-left:5px;" href="/edit-panache-video-product/?id=' . $product_id . '" class="edit-prod"><i style="color:#000000;" class="fas fa-edit"></i></a>';
                    }
                    echo '<span class="wishlist-title float-right">' . esc_attr__("Add $title to wishlist", "text-domain") . '</span><a class="wishlist-toggle" style="float: right!important;padding:5px!important" data-product="' . esc_attr($product_id) . '" href="#" title="' . esc_attr__("Add to wishlist", "text-domain") . '"><i style="font-size:20px;color:#4b4b4b;opacity: 0.8;" class="far fa-heart"></i></a>';
                    ?>

                </div>
                <h3 style="color:#000000!important;font-weight: 700!important;min-height:2em;">
                    <?php
                    if($title) {

                        echo $title.'<br />';

                    }

                    ?>
                </h3>
                <hr style="border-top: 1px solid purple;"/>
                <?php
                if($tags) { ?>
                    <div class="prod-fields text-left">
                        <div style="min-height:9em">
                            <?php
                            foreach ($tags as $tag) {
                                echo '<p style="font-size: 16px!important;color: #000;font-family: PT Sans!important;font-weight: 700!important;">'.$tag->name.'</p>';

                            }
                            ?>

                        </div>
                    </div>
                    <div class="w-100" style="padding-left: 15px;padding-bottom:25px;">
                        <p title="choreographer" style="float:left!important;font-family: PT Sans!important;display: inline-block!important;font-size:18px!important;font-weight: 700!important;">
                            <img src="https://panachedancefitness.com/wp-content/uploads/2021/10/dancer-2-e1622667179728-1-e1637930243563.png" style="width:30px!important;float: left!important;" alt="dancer icon">

                            <?php
                            if($choreographers) {
                                foreach ($choreographers as $choreographer) {
                                    echo $choreographer["display_name"].'&nbsp;&nbsp;';
                                }
                            }
                            ?>
                        </p>

                    </div>
                    <hr style=" border-top: 1px solid purple!important;" >
                    <div class="row">

                        <div class="col-md-12 text-center" style="padding-right:35px;position:absolute;bottom:0;">
                            <h2 class="woocommerce-loop-product__title float-right" style="width:20%;color: #000000;">£<?php echo $price ?></h2>
                            <a href="<?php echo $link ?>" class="button product_type_simple text-center" style="margin-left:3px;background-color: #480082!important;width:33%!important;float:left;font-size:12px;" ><i class="fas fa-play "></i>
                            </a>
                            <?php echo '<a class="button btn btn-success text-center product_type_simple" style="width:33%!important;float:left;margin-left: 3px;font-size:12px;background-color: #00824d" href="?add-to-cart=' . $product_id .'"><i class="fas fa-shopping-basket"></i>
                                        </a>';
                            ?>
                        </div>
                    </div>

                    <?php
                }


                ?>
            </div>

        </div>
    <?php
   }
}
 ?>
</div>
</div>
<?php
get_footer();
