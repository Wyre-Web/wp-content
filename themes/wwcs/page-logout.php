<?php

$logout = $_REQUEST['action'];
$nonce = $_REQUEST['_wpnonce'];

$user_id = wp_get_current_user()->ID;
if(wp_verify_nonce( $nonce, 'logout-'. $user_id )){
   // echo 'Security check passed';
    wp_logout();
    header("Location: https://panache.nic-edesign.com/");
    exit();

} else {
    echo 'nonce invalid';
   // die( __( 'Security check', 'textdomain' ) );
}


/*if ( ! wp_verify_nonce( $nonce, 'logout' ) ) {
    die( __( 'Security check', 'textdomain' ) );
} else {
    echo 'Security check passed';
}*/
//if($nonce && $logout == "logout") {
    //wp_logout();
    //header("Location: https://panache.nic-edesign.com/");
    //exit();
//}
