<?php 

/* display all post_type in $WP_Query */
function add_custom_post_type_to_wp_query($query) {
  if(
      empty($query->query['post_type'])
      or $query->query['post_type'] === 'post'
  ){
      $query->set('post_type', array('post_type' => 'any'));
  }
}
add_action('pre_get_posts', 'add_custom_post_type_to_wp_query');


/// Bof - Remove Tags prefix in the_archive_title and more...
add_filter( 'get_the_archive_title', function ($title) {
  if ( is_category() ) {
      $title = single_cat_title( '', false );
  }
  elseif ( is_tag() ) {
      $title = single_tag_title( '', false );
  }
  elseif ( is_author() ) {
      $title = '<span class="vcard">' . get_the_author() . '</span>' ;
  }
  return $title;
});
/// Eof - Remove Tags prefix

// liaison feuille de style css avec BO
function admin_css() {
  $admin_handle = 'admin_css';
  $admin_stylesheet = get_template_directory_uri() . '/styles/admin.css';

  wp_enqueue_style( $admin_handle, $admin_stylesheet );
}

add_action('admin_print_styles', 'admin_css', 11 );
