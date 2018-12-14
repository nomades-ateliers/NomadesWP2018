<?php 

function cptui_register_my_taxes_parcours() {

	/**
	 * Taxonomy: Parcours.
	 */

	$labels = array(
		"name" => __( "Parcours"),
		"singular_name" => __( "Parcour"),
	);

	$args = array(
		"label" => __( "Parcours"),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => true,
		"label" => "Parcours",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		// "rewrite" => array( 'slug' => 'workshops' ),
		"show_admin_column" => 0,
		"show_in_rest" => true,
		"rest_base" => "",
		"show_in_quick_edit" => true,
	);
	register_taxonomy( "parcours", array( "workshop" ), $args );
}

add_action( 'init', 'cptui_register_my_taxes_parcours' );

// A callback function to add a custom field to our "presenters" taxonomy  
function order_taxonomy_custom_fields($tag) {  
    // Check for existing taxonomy meta for the term you're editing  
     $t_id = $tag->term_id; // Get the ID of the term you're editing  
     $term_meta = get_option( "taxonomy_term_$t_id" ); // Do the check  
 ?>   
 <tr class="form-field">  
     <th scope="row" valign="top">  
         <label for="order"><?php _e('Ordre de tris'); ?></label>  
     </th>  
     <td>  
         <input type="text" name="term_meta[order]" id="term_meta[order]" size="25" style="width:60%;" value="<?php echo $term_meta['order'] ? $term_meta['order'] : ''; ?>"><br />  
         <span class="description"><?php _e('Ordre d affichage des catégories.'); ?></span>  
     </td>  
 </tr>  
 <?php  
 } 
 // A callback function to save our extra taxonomy field(s)  
function save_taxonomy_custom_fields( $term_id ) {  
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
add_action( 'parcours_edit_form_fields', 'order_taxonomy_custom_fields', 10, 2 );  
// Save the changes made on the "order" taxonomy, using our callback function  
add_action( 'edited_parcours', 'save_taxonomy_custom_fields', 10, 2 );  
