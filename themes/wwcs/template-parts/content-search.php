<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wwcs
 */
$product_id = get_the_id();
$tags = get_field('artist', $product_id);
$choreographers = get_field('choreographer', $product_id );
$fitness_track = get_field('fitness_track',$product_id);
$price = get_field('price', $product_id);
$link = get_the_permalink($product_id);
$title = get_the_title();

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
