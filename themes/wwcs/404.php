<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package wwcs
 */

get_header();
?>
<div class="container-fluid">
    <div class="row justify-content-center">
       
        <div class="col-12 text-center wsf wsfront" style="min-height:75vh;padding-bottom:200px;">
            
            	<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'wwcs' ); ?></h1><br><br>
            		<h2>Go back to the <a id="ho" href="/">home page.</a>
				    </h2>
        </div>
    </div>
  
   </div>
<?php
get_footer();
