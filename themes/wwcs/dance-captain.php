<?php 
get_header();     
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
$author_id = get_the_author_meta('ID');

echo do_shortcode ('[panache_dc]');