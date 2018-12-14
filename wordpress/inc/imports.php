<?php 

// lien : http://wpshed.com/create-custom-meta-box-easy-way/
// Little function to return a custom field value
function wpshed_get_custom_field( $value ) {
    global $post;

        $custom_field = get_post_meta( $post->ID, $value, true );
        if ( !empty( $custom_field ) )
        return is_array( $custom_field ) ? stripslashes_deep( $custom_field ) : stripslashes( wp_kses_decode_entities( $custom_field ) );

        return false;
}


function metbox_titre_noir( $post ) {

    wp_nonce_field( 'my_nonce_metbox_titre_noir', 'nonce_metbox_titre_noir' ); ?>
   <p><em>Le titre devient noir et la date n'est pas mise en valeur.</em></p>
    <p class="block_admin_pm grand titre_niveau">
       <label for="title_black"> Mettre le titre en noir ? </label>
  
          <select name="title_black" id="title_black">
              <option value="title_normal">NON</option>
              <option <?php if (wpshed_get_custom_field('title_black') == 'title_noir') echo 'selected="selected"'; ?> value="title_noir">OUI</option>
          </select>
   </p>
  
  
   <?php
  }


// import all custom posts

require get_template_directory() . '/inc/formations/api_formations.php';

require get_template_directory() . '/inc/formations/cursus.php';
require get_template_directory() . '/inc/formations/formation.php';
require get_template_directory() . '/inc/projects/projects.php';

require get_template_directory() . '/inc/workshops/parcours.php';
require get_template_directory() . '/inc/workshops/workshops.php';

