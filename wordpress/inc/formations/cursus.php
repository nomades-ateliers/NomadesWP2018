<?php 

function cptui_register_my_taxes_cursus() {

	/**
	 * Taxonomy: Cursus.
	 */

	$labels = array(
		"name" => __( "Cursus"),
		"singular_name" => __( "Cursus"),
	);

	$args = array(
		"label" => __( "Cursus"),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => 1,
		"label" => "Cursus",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
        "rewrite" => array( 'slug' => 'cursus' ),
		"show_admin_column" => 0,
		"show_in_rest" => true,
		"rest_base" => "",
		"show_in_quick_edit" => true,
	);
	register_taxonomy( "cursus", array( "formation" ), $args );
}

add_action( 'init', 'cptui_register_my_taxes_cursus' );



add_filter( 'wp_default_editor', create_function('', 'return "tinymce";') );

// A callback function to add a custom field to our "presenters" taxonomy  
function chocolat_taxonomy_custom_fields($tag) {  
  // Check for existing taxonomy meta for the term you're editing  
  $t_id = $tag->term_id; // Get the ID of the term you're editing  
  $term_meta = get_option( "taxonomy_term_$t_id" ); // Do the check  
 ?>   

  <!-- Block 1 -->
  <tr class="form-field">  
    <th scope="row" valign="top">  
        <label for="choco_block1"><?php _e('Block 1'); ?></label>  
    </th>  
    <td>  
      <div class="title">
        <label for="choco_block1_title"><?php _e('Titre Block 1'); ?></label>  <br /> 
		    <input type="text" name="term_meta[choco_block1_title]" id="term_meta[choco_block1_title]" size="25" value="<?php echo $term_meta['choco_block1_title'] ? $term_meta['choco_block1_title'] : ''; ?>"> 
      </div>  
      <div class="title">
        <label for="choco_block1_title_short"><?php _e('Titre Block 1 pour mobile'); ?></label>  <br /> 
		    <input type="text" name="term_meta[choco_block1_title_short]" id="term_meta[choco_block1_title_short]" size="25" value="<?php echo $term_meta['choco_block1_title_short'] ? $term_meta['choco_block1_title_short'] : ''; ?>"> 
      </div>
      <div>
      <label for="choco_block1"><?php _e('Contenu Block 1'); ?></label> 
        <?php
          $settings = array(
            'media_buttons' => false,
            'textarea_name' => 'term_meta[choco_block1]',
            'tinymce' => array( 'width' => 'auto' )
          );
          $content = $term_meta['choco_block1'] ? $term_meta['choco_block1'] : '';
          wp_editor($content, 'term_meta_choco_block1', $settings );
        ?>
      </div>
    </td>  
  </tr>
  <!-- Block 2 -->
  <tr class="form-field">  
    <th scope="row" valign="top">  
        <label for="choco_block2"><?php _e('Block 2'); ?></label>  
    </th>  
    <td>  
      <div class="title">
        <label for="choco_block2_title"><?php _e('Titre Block 2'); ?></label>  <br /> 
		    <input type="text" name="term_meta[choco_block2_title]" id="term_meta[choco_block2_title]" size="25" value="<?php echo $term_meta['choco_block2_title'] ? $term_meta['choco_block2_title'] : ''; ?>"> 
      </div>  
      <div class="title">
        <label for="choco_block2_title_short"><?php _e('Titre Block 2 pour mobile'); ?></label>  <br /> 
		    <input type="text" name="term_meta[choco_block2_title_short]" id="term_meta[choco_block2_title_short]" size="25" value="<?php echo $term_meta['choco_block2_title_short'] ? $term_meta['choco_block2_title_short'] : ''; ?>"> 
      </div>
      <div>
      <label for="choco_block2"><?php _e('Contenu Block 2'); ?></label> 
        <?php
          $settings = array(
            'media_buttons' => false,
            'textarea_name' => 'term_meta[choco_block2]',
            'tinymce' => array( 'width' => 'auto' )
          );
          $content = $term_meta['choco_block2'] ? $term_meta['choco_block2'] : '';
          wp_editor($content, 'term_meta_choco_block2', $settings );
        ?>
      </div>
    </td>  
  </tr>
  <!-- Block 3 -->
  <tr class="form-field">  
    <th scope="row" valign="top">  
        <label for="choco_block3"><?php _e('Block 3'); ?></label>  
    </th>  
    <td>  
      <div class="title">
        <label for="choco_block3_title"><?php _e('Titre Block 3'); ?></label>  <br /> 
		    <input type="text" name="term_meta[choco_block3_title]" id="term_meta[choco_block3_title]" size="25" value="<?php echo $term_meta['choco_block3_title'] ? $term_meta['choco_block3_title'] : ''; ?>"> 
      </div>  
      <div class="title">
        <label for="choco_block3_title_short"><?php _e('Titre Block 3 pour mobile'); ?></label>  <br /> 
		    <input type="text" name="term_meta[choco_block3_title_short]" id="term_meta[choco_block3_title_short]" size="25" value="<?php echo $term_meta['choco_block3_title_short'] ? $term_meta['choco_block3_title_short'] : ''; ?>"> 
      </div>
      <div>
      <label for="choco_block3"><?php _e('Contenu Block 3'); ?></label> 
        <?php
          $settings = array(
            'media_buttons' => false,
            'textarea_name' => 'term_meta[choco_block3]',
            'tinymce' => array( 'width' => 'auto' )
          );
          $content = $term_meta['choco_block3'] ? $term_meta['choco_block3'] : '';
          wp_editor($content, 'term_meta_choco_block3', $settings  );
        ?>
      </div>
    </td>  
  </tr>
  <!-- Block 4 -->
  <tr class="form-field">  
    <th scope="row" valign="top">  
        <label for="choco_block4"><?php _e('Block 4'); ?></label>  
    </th>  
    <td>  
      <div class="title">
        <label for="choco_block4_title"><?php _e('Titre Block 4'); ?></label>  <br /> 
		    <input type="text" name="term_meta[choco_block4_title]" id="term_meta[choco_block4_title]" size="25" value="<?php echo $term_meta['choco_block4_title'] ? $term_meta['choco_block4_title'] : ''; ?>"> 
      </div>  
      <div class="title">
        <label for="choco_block4_title_short"><?php _e('Titre Block 4 pour mobile'); ?></label>  <br /> 
		    <input type="text" name="term_meta[choco_block4_title_short]" id="term_meta[choco_block4_title_short]" size="25" value="<?php echo $term_meta['choco_block4_title_short'] ? $term_meta['choco_block4_title_short'] : ''; ?>"> 
      </div>
      <div>
      <label for="choco_block4"><?php _e('Contenu Block 4'); ?></label> 
        <?php
          $settings = array(
            'media_buttons' => false,
            'textarea_name' => 'term_meta[choco_block4]',
            'tinymce' => array( 'width' => 'auto' )
          );
          $content = $term_meta['choco_block4'] ? $term_meta['choco_block4'] : '';
          wp_editor($content, 'term_meta_choco_block4', $settings );
        ?>
      </div>
    </td>  
  </tr>
 <?php  
 } 
 // A callback function to save our extra taxonomy field(s)  
function save_taxonomy_chocolat_fields( $term_id ) {  
    if ( isset( $_POST['term_meta'] ) ) {  
        $t_id = $term_id;  
        $term_meta = get_option( "taxonomy_term_$t_id" );  
        $cat_keys = array_keys( $_POST['term_meta'] );  
            foreach ( $cat_keys as $key ){  
            if ( isset( $_POST['term_meta'][$key] ) ){  
                $term_meta[$key] = $_POST['term_meta'][$key];  
            }  
        }  
        //save the option array  
        update_option( "taxonomy_term_$t_id", $term_meta );  
    }  
}
// Add the fields to the "order" taxonomy, using our callback function  
add_action( 'cursus_edit_form_fields', 'chocolat_taxonomy_custom_fields', 10, 2 );  
// Save the changes made on the "order" taxonomy, using our callback function  
add_action( 'edited_cursus', 'save_taxonomy_chocolat_fields', 10, 2 );  
