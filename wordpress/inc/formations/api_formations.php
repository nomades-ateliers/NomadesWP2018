<?php
/**
* Add REST API support to an already registered post type
* http://v2.wp-api.org/extending/custom-content-types/
* Access this post type at yoursite.com/wp-json/wp/v2/post_type_name
*/


add_action( 'init', 'appp_post_type_rest_support', 999 );

function appp_post_type_rest_support() {

  global $wp_post_types;

  //be sure to set this to the name of your post type!
  $post_type_name = 'workshop';
  if( isset( $wp_post_types[ $post_type_name ] ) ) {
    $wp_post_types[$post_type_name]->show_in_rest = true;
    $wp_post_types[$post_type_name]->rest_base = $post_type_name;
    $wp_post_types[$post_type_name]->rest_controller_class = 'WP_REST_Posts_Controller';
  }
  $post_type_name = 'formation';
  if( isset( $wp_post_types[ $post_type_name ] ) ) {
    $wp_post_types[$post_type_name]->show_in_rest = true;
    $wp_post_types[$post_type_name]->rest_base = $post_type_name;
    $wp_post_types[$post_type_name]->rest_controller_class = 'WP_REST_Posts_Controller';
  }

  $post_type_name = 'projet';
  if( isset( $wp_post_types[ $post_type_name ] ) ) {
    $wp_post_types[$post_type_name]->show_in_rest = true;
    $wp_post_types[$post_type_name]->rest_base = $post_type_name;
    $wp_post_types[$post_type_name]->rest_controller_class = 'WP_REST_Posts_Controller';
  }
}

add_action( 'rest_api_init', 'appp_register_post_meta' );
function appp_register_post_meta() {
    register_rest_field( 'formation', // any post type registered with API
        'formation_position', // this needs to match meta key
        array(
            'get_callback'    => 'appp_get_meta',
            'update_callback' => null,
            'schema'          => null,
        )
    );
    register_rest_field( 'formation', // any post type registered with API
        'content_block_formation_1', // this needs to match meta key
        array(
            'get_callback'    => 'appp_get_meta',
            'update_callback' => null,
            'schema'          => null,
        )
    );
    register_rest_field( 'formation', // any post type registered with API
        'content_block_formation_2', // this needs to match meta key
        array(
            'get_callback'    => 'appp_get_meta',
            'update_callback' => null,
            'schema'          => null,
        )
    );
    register_rest_field( 'formation', // any post type registered with API
        'content_block_formation_3', // this needs to match meta key
        array(
            'get_callback'    => 'appp_get_meta',
            'update_callback' => null,
            'schema'          => null,
        )
    );
    register_rest_field( 'formation', // any post type registered with API
        'content_block_formation_4', // this needs to match meta key
        array(
            'get_callback'    => 'appp_get_meta',
            'update_callback' => null,
            'schema'          => null,
        )
    );
    register_rest_field( 'formation', // any post type registered with API
        'formation_position', // this needs to match meta key
        array(
            'get_callback'    => 'appp_get_meta',
            'update_callback' => null,
            'schema'          => null,
        )
    );

    register_rest_field( 'formation', // any post type registered with API
        'date_formation_du', // this needs to match meta key
        array(
            'get_callback'    => 'appp_get_meta',
            'update_callback' => null,
            'schema'          => null,
        )
    );
    register_rest_field( 'formation', // any post type registered with API
        'date_formation_au', // this needs to match meta key
        array(
            'get_callback'    => 'appp_get_meta',
            'update_callback' => null,
            'schema'          => null,
        )
    );
    register_rest_field( 'formation', // any post type registered with API
        't_formation_b1', // this needs to match meta key
        array(
            'get_callback'    => 'appp_get_meta',
            'update_callback' => null,
            'schema'          => null,
        )
    );
    register_rest_field( 'formation', // any post type registered with API
        'formation_priorite', // this needs to match meta key
        array(
            'get_callback'    => 'appp_get_meta',
            'update_callback' => null,
            'schema'          => null,
        )
    );
    register_rest_field( 'formation', // any post type registered with API
        'wp_custom_attachment', // this needs to match meta key
        array(
            'get_callback'    => 'appp_get_meta',
            'update_callback' => null,
            'schema'          => null,
        )
    );
    register_rest_field( 'formation', // any post type registered with API
        'formation_dates', // this needs to match meta key
        array(
            'get_callback'    => 'appp_get_meta',
            'update_callback' => null,
            'schema'          => null,
        )
    );

    // workshop fields
    register_rest_field( 'workshop', // any post type registered with API
        'wk_position', // this needs to match meta key
        array(
            'get_callback'    => 'appp_get_meta',
            'update_callback' => null,
            'schema'          => null,
        )
    );
    register_rest_field( 'workshop', // any post type registered with API
        'priorite', // this needs to match meta key
        array(
            'get_callback'    => 'appp_get_meta',
            'update_callback' => null,
            'schema'          => null,
        )
    );
    register_rest_field( 'workshop', // any post type registered with API
        'complet', // this needs to match meta key
        array(
            'get_callback'    => 'appp_get_meta',
            'update_callback' => null,
            'schema'          => null,
        )
    );
    register_rest_field( 'workshop', // any post type registered with API
        'date_session_1_du', // this needs to match meta key
        array(
            'get_callback'    => 'appp_get_meta',
            'update_callback' => null,
            'schema'          => null,
        )
    );
    register_rest_field( 'workshop', // any post type registered with API
        'date_session_1_au', // this needs to match meta key
        array(
            'get_callback'    => 'appp_get_meta',
            'update_callback' => null,
            'schema'          => null,
        )
    );
    register_rest_field( 'workshop', // any post type registered with API
        'desc_resume_workshop', // this needs to match meta key
        array(
            'get_callback'    => 'appp_get_meta',
            'update_callback' => null,
            'schema'          => null,
        )
    );
    // register_rest_field( 'workshop', // any post type registered with API
    //     'parcours', // this needs to match meta key
    //     array(
    //         'get_callback'    => 'appp_get_meta',
    //         'update_callback' => null,
    //         'schema'          => null,
    //     )
    // );
    register_rest_field( 'workshop', // any post type registered with API
        'ecolage_wk', // this needs to match meta key
        array(
            'get_callback'    => 'appp_get_meta',
            'update_callback' => null,
            'schema'          => null,
        )
    );
    register_rest_field( 'workshop', // any post type registered with API
        'programme_workshop', // this needs to match meta key
        array(
            'get_callback'    => 'appp_get_meta',
            'update_callback' => null,
            'schema'          => null,
        )
    );
    register_rest_field( 'workshop', // any post type registered with API
        'titre_deux_ligne', // this needs to match meta key
        array(
            'get_callback'    => 'appp_get_meta',
            'update_callback' => null,
            'schema'          => null,
        )
    );
    register_rest_field( 'workshop', // any post type registered with API
        'public_workshop', // this needs to match meta key
        array(
            'get_callback'    => 'appp_get_meta',
            'update_callback' => null,
            'schema'          => null,
        )
    );
    register_rest_field( 'workshop', // any post type registered with API
        'contenu_workshop', // this needs to match meta key
        array(
            'get_callback'    => 'appp_get_meta',
            'update_callback' => null,
            'schema'          => null,
        )
    );
    register_rest_field( 'workshop', // any post type registered with API
        'titre_workshop_cour', // this needs to match meta key
        array(
            'get_callback'    => 'appp_get_meta',
            'update_callback' => null,
            'schema'          => null,
        )
    );

    
    register_rest_field( 'parcours', // any post type registered with API
        'order', // this needs to match meta key
        array(
            'get_callback'    => 'app_get_taxMeta',
            'update_callback' => null,
            'schema'          => null,
        )
    );

    register_rest_field( 'cursus', // any post type registered with API
        'choco_block1', // this needs to match meta key
        array(
            'get_callback' => 'app_get_choco_block1',
            'update_callback' => null,
            'schema'          => null,
        )
    );
    register_rest_field( 'cursus', // any post type registered with API
        'choco_block1_title', // this needs to match meta key
        array(
            'get_callback' => 'app_get_choco_block1_title',
            'update_callback' => null,
            'schema'          => null,
        )
    );
    register_rest_field( 'cursus', // any post type registered with API
        'choco_block1_title_short', // this needs to match meta key
        array(
            'get_callback' => 'app_get_choco_block1_title_short',
            'update_callback' => null,
            'schema'          => null,
        )
    );

    register_rest_field( 'cursus', // any post type registered with API
        'choco_block2', // this needs to match meta key
        array(
            'get_callback'    => 'app_get_choco_block2',
            'update_callback' => null,
            'schema'          => null,
        )
    );
    register_rest_field( 'cursus', // any post type registered with API
        'choco_block2_title', // this needs to match meta key
        array(
            'get_callback' => 'app_get_choco_block2_title',
            'update_callback' => null,
            'schema'          => null,
        )
    );
    register_rest_field( 'cursus', // any post type registered with API
        'choco_block2_title_short', // this needs to match meta key
        array(
            'get_callback' => 'app_get_choco_block2_title_short',
            'update_callback' => null,
            'schema'          => null,
        )
    );

    register_rest_field( 'cursus', // any post type registered with API
        'choco_block3', // this needs to match meta key
        array(
            'get_callback'    => 'app_get_choco_block3',
            'update_callback' => null,
            'schema'          => null,
        )
    );
    register_rest_field( 'cursus', // any post type registered with API
        'choco_block3_title', // this needs to match meta key
        array(
            'get_callback' => 'app_get_choco_block3_title',
            'update_callback' => null,
            'schema'          => null,
        )
    );
    register_rest_field( 'cursus', // any post type registered with API
        'choco_block3_title_short', // this needs to match meta key
        array(
            'get_callback' => 'app_get_choco_block3_title_short',
            'update_callback' => null,
            'schema'          => null,
        )
    );

    register_rest_field( 'cursus', // any post type registered with API
        'choco_block4', // this needs to match meta key
        array(
            'get_callback'    => 'app_get_choco_block4',
            'update_callback' => null,
            'schema'          => null,
        )
    );
    register_rest_field( 'cursus', // any post type registered with API
        'choco_block4_title', // this needs to match meta key
        array(
            'get_callback' => 'app_get_choco_block4_title',
            'update_callback' => null,
            'schema'          => null,
        )
    );
    register_rest_field( 'cursus', // any post type registered with API
        'choco_block4_title_short', // this needs to match meta key
        array(
            'get_callback' => 'app_get_choco_block4_title_short',
            'update_callback' => null,
            'schema'          => null,
        )
    );
}
function app_get_taxMeta($tax){
    $id = $tax[ 'id' ];
    $term_meta = get_option( "taxonomy_term_$id" );
    // $terms = get_field("order", $tax );

    // return $data;
    return ($term_meta) ? intval($term_meta['order']) : 0;
    
}

function app_get_choco_block1($tax){
    $id = $tax[ 'id' ];
    $term_meta = get_option( "taxonomy_term_$id" );
    return ($term_meta) ? $term_meta['choco_block1'] : null; 
}
function app_get_choco_block1_title($tax){
    $id = $tax[ 'id' ];
    $term_meta = get_option( "taxonomy_term_$id" );
    return ($term_meta) ? $term_meta['choco_block1_title'] : null; 
}
function app_get_choco_block1_title_short($tax){
    $id = $tax[ 'id' ];
    $term_meta = get_option( "taxonomy_term_$id" );
    return ($term_meta) ? $term_meta['choco_block1_title_short'] : null; 
}

function app_get_choco_block2($tax){
    $id = $tax[ 'id' ];
    $term_meta = get_option( "taxonomy_term_$id" );
    return ($term_meta) ? $term_meta['choco_block2'] : null; 
}
function app_get_choco_block2_title($tax){
    $id = $tax[ 'id' ];
    $term_meta = get_option( "taxonomy_term_$id" );
    return ($term_meta) ? $term_meta['choco_block2_title'] : null; 
}
function app_get_choco_block2_title_short($tax){
    $id = $tax[ 'id' ];
    $term_meta = get_option( "taxonomy_term_$id" );
    return ($term_meta) ? $term_meta['choco_block2_title_short'] : null; 
}

function app_get_choco_block3($tax){
    $id = $tax[ 'id' ];
    $term_meta = get_option( "taxonomy_term_$id" );
    return ($term_meta) ? $term_meta['choco_block3'] : null; 
}
function app_get_choco_block3_title($tax){
    $id = $tax[ 'id' ];
    $term_meta = get_option( "taxonomy_term_$id" );
    return ($term_meta) ? $term_meta['choco_block3_title'] : null; 
}
function app_get_choco_block3_title_short($tax){
    $id = $tax[ 'id' ];
    $term_meta = get_option( "taxonomy_term_$id" );
    return ($term_meta) ? $term_meta['choco_block3_title_short'] : null; 
}

function app_get_choco_block4($tax){
    $id = $tax[ 'id' ];
    $term_meta = get_option( "taxonomy_term_$id" );
    return ($term_meta) ? $term_meta['choco_block4'] : null; 
}
function app_get_choco_block4_title($tax){
    $id = $tax[ 'id' ];
    $term_meta = get_option( "taxonomy_term_$id" );
    return ($term_meta) ? $term_meta['choco_block4_title'] : null; 
}
function app_get_choco_block4_title_short($tax){
    $id = $tax[ 'id' ];
    $term_meta = get_option( "taxonomy_term_$id" );
    return ($term_meta) ? $term_meta['choco_block4_title_short'] : null; 
}

function appp_get_meta( $object, $field_name, $request ) {
    return get_post_meta( $object[ 'id' ], $field_name, true );
}
function my_add_meta_vars ($current_vars) {
    $current_vars = array_merge ($current_vars, array ('meta_key', 'meta_value'));
    return $current_vars;
}
add_action( 'init', 'my_custom_taxonomy_rest_support', 25 );

function my_custom_taxonomy_rest_support() {
  global $wp_taxonomies;

  //TODO: be sure to set this to the name of your taxonomy!
  $taxonomy_name = 'cursus';

  if ( isset( $wp_taxonomies[ $taxonomy_name ] ) ) {
    $wp_taxonomies[ $taxonomy_name ]->show_in_rest = true;

    // Optionally customize the rest_base or controller class
    $wp_taxonomies[ $taxonomy_name ]->rest_base = $taxonomy_name;
    $wp_taxonomies[ $taxonomy_name ]->rest_controller_class = 'WP_REST_Terms_Controller';
  }
  $taxonomy_name = 'parcours';

  if ( isset( $wp_taxonomies[ $taxonomy_name ] ) ) {
    $wp_taxonomies[ $taxonomy_name ]->show_in_rest = true;

    // Optionally customize the rest_base or controller class
    $wp_taxonomies[ $taxonomy_name ]->rest_base = $taxonomy_name;
    $wp_taxonomies[ $taxonomy_name ]->rest_controller_class = 'WP_REST_Terms_Controller';
  }
}

add_filter ('rest_query_vars', 'my_add_meta_vars');