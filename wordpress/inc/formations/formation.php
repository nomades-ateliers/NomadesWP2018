<?php 
function cptui_register_my_cpts_formation() {

/**
 * Post Type: Formations.
 */

$labels = array(
    "name" => __( "Formations"),
    "singular_name" => __( "Formation"),
    "menu_name" => __( "Block Formations"),
    "add_new" => __( "Ajouter nouveau"),
    "add_new_item" => __( "Ajouter nouvelle formation"),
    "edit" => __( "Modifier"),
    "edit_item" => __( "Modifier la formation"),
    "new_item" => __( "Nouvelle formation"),
    "view" => __( "Voir la formation"),
    "view_item" => __( "Voir formation"),
    "search_items" => __( "Rechercher Formation"),
);

$args = array(
    "label" => __( "Formations"),
    "labels" => $labels,
    "description" => "Pour les blocks de formations uniquement, en haut de la page !",
    "public" => true,
    // "publicly_queryable" => false,
    "show_ui" => true,
    "show_in_rest" => true,
    "rest_base" => "",
    "has_archive" => true,
    "show_in_menu" => true,
    "exclude_from_search" => false,
    "capability_type" => "post",
    "map_meta_cap" => true,
    "hierarchical" => false,
    "rewrite" => array( "slug" => "formation", "with_front" => true ),
    "query_var" => true,
    "supports" => array( "title" , "post-formats"),
);

    register_post_type( "formation", $args );
}
add_action( 'init', 'cptui_register_my_cpts_formation' );


// prix de la formation
function formation_price() {
    add_meta_box( 'formation_price', 'Prix de la formation', 'metbox_formation_price', 'formation', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'formation_price' );


// position de la formation
function formation_position() {
    add_meta_box( 'formation_position', 'Position de la formation', 'metbox_formation_position', 'formation', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'formation_position' );

// priorité de la formation
function formation_priorite() {
    add_meta_box( 'formation_priorite', 'Priorité de la formation', 'metbox_formation_priorite', 'formation', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'formation_priorite' );

// date de la formation
function formation_dates() {
    add_meta_box( 'formation_dates', 'Dates de la prochaine formation', 'metbox_formation_dates', 'formation', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'formation_dates' );


function metbox_formation_dates( $post ) {

  wp_nonce_field( 'my_nonce_formation_dates', 'nonce_formation_dates' ); ?>

  <p class="block_admin_pm grand titre_niveau">
     <label for="date_formation_du">du</label> <input type="text" id="date_formation_du" name="date_formation_du" class="datepicker" size="20" value="<?php echo wpshed_get_custom_field( 'date_formation_du' ); ?>" />
     <label for="date_formation_au">au</label> <input type="text" id="date_formation_au" name="date_formation_au" class="datepicker" size="20" value="<?php echo wpshed_get_custom_field( 'date_formation_au' ); ?>" />
  </p>


<?php
}


function metbox_formation_priorite( $post ) {

wp_nonce_field( 'my_nonce_formation_priorite', 'nonce_formation_priorite' ); ?>

<p class="block_admin_pm grand titre_niveau">
 <label for="formation_priorite"> Formation mise en valeur ? </label>

    <select name="formation_priorite" id="formation_priorite">
         <option value="non">NON</option>
        <option <?php if (wpshed_get_custom_field('formation_priorite') == 'priorite') echo 'selected="selected"'; ?> value="priorite">OUI</option>
    </select>
</p>


<?php
}

function metbox_formation_price( $post ) {

  wp_nonce_field( 'my_nonce_formation_price', 'nonce_formation_price' ); ?>


<p class="block_admin_pm grand titre_niveau">
    <label for="formation_price"> Prix de la formation :</label>
    <input id="formation_price" name="formation_price" type="number" value="<?php echo wpshed_get_custom_field( 'formation_price' );?>">
</p>


<?php
}

function metbox_formation_position( $post ) {

wp_nonce_field( 'my_nonce_formation_position', 'nonce_formation_position' ); ?>

<p class="block_admin_pm grand titre_niveau">
 <label for="formation_position"> Position de la formation :</label>

    <select name="formation_position" id="formation_position">
        <option <?php if (wpshed_get_custom_field('formation_position') == 1) echo 'selected="selected"'; ?> value="1">Ligne 1</option>
        <option <?php if (wpshed_get_custom_field('formation_position') == 2) echo 'selected="selected"'; ?>  value="2">Ligne 2</option>
        <option <?php if (wpshed_get_custom_field('formation_position') == 3) echo 'selected="selected"'; ?>  value="3">Ligne 3</option>
        <option <?php if (wpshed_get_custom_field('formation_position') == 4) echo 'selected="selected"'; ?>  value="4">Ligne 4</option>
    </select>
</p>


<?php
}

// Output the Metabox
function metbox_formation_block1( $post ) {
// create a nonce field
wp_nonce_field( 'my_nonce_formation_block1', 'nonce_formation_block1' ); ?>



<p class="block_admin_pm grand titre_niveau">
<label for="t_formation_b1"> Niveau (Base,Fondements,...) :</label>
<input type="text" name="t_formation_b1" id="t_formation_b1" value="<?php echo wpshed_get_custom_field( 't_formation_b1' ); ?>" size="50" />
</p>

<p class="block_admin_pm grand titre_niveau no_marge_bottom">
<label for="wp_custom_attachment"> Fichier PDF de la formation :</label>
<input type="file" id="wp_custom_attachment" name="wp_custom_attachment" value="" size="25" />
</p>

<?php
$img = get_post_meta(get_the_ID(), 'wp_custom_attachment', true);

if (isset($img['url'])){
 $img = get_post_meta(get_the_ID(), 'wp_custom_attachment', true);
    echo '<p class="infos_nomades-admin no_marge_top"><strong>Fichier PDF déjà présent</strong> : <a href="'.$img['url'].'">
         Voir le PDF ICI
     </a></p>';
}else{
  echo '<p class="infos_nomades-admin no_marge_top"><strong>Aucun fichier en téléchargement</strong>
     </a></p>';
}
?>

<div class="admin_font tab_formation_complete">

<div class="block_admin_pm">
     <label for="content_block_formation_1">Block 1 : 0-10 jours</label><br />
     <textarea name="content_block_formation_1" id="content_block_formation_1" rows="4"><?php echo wpshed_get_custom_field( 'content_block_formation_1' ); ?></textarea>
</div>

<div class="block_admin_pm">

     <label for="content_block_formation_2">Block 2 : 10-20 jours</label><br />
     <textarea name="content_block_formation_2" id="content_block_formation_2" rows="4"><?php echo wpshed_get_custom_field( 'content_block_formation_2' ); ?></textarea>
</div>

<div class="block_admin_pm">

     <label for="content_block_formation_3">Block 3 : 20-30 jours</label><br />
     <textarea name="content_block_formation_3" id="content_block_formation_3" rows="4"><?php echo wpshed_get_custom_field( 'content_block_formation_3' ); ?></textarea>
</div>

<div class="block_admin_pm">
     <label for="content_block_formation_4">Block 4 : 30-40 jours</label><br />
     <textarea name="content_block_formation_4" id="content_block_formation_4" rows="4"><?php echo wpshed_get_custom_field( 'content_block_formation_4' ); ?></textarea>
</div>

</div>



<?php
}
   // Register the Metabox
function wpshed_add_custom_meta_box() {
    add_meta_box( 'wpshed-meta-box', 'Informations globales', 'metbox_formation_block1', 'formation', 'normal', 'high' );
}   
add_action( 'add_meta_boxes', 'wpshed_add_custom_meta_box' );


// Save the Metabox values
function save_meta_box( $post_id ) {
// Stop the script when doing autosave
if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

// Stop the script if the user does not have edit permissions
if( !current_user_can( 'edit_post' ) ) return;

// Verify the nonce. If insn't there, stop the script
if(isset( $_POST['nonce_formation_block1'] ) || wp_verify_nonce( $_POST['nonce_formation_block1'], 'my_nonce_formation_block1' ) ){


// Save the textfield
if( isset( $_POST['t_formation_b1'] ) )
update_post_meta( $post_id, 't_formation_b1', esc_attr( $_POST['t_formation_b1'] ) );

// Save the textarea
if( isset( $_POST['content_block_formation_1'] ) )
update_post_meta( $post_id, 'content_block_formation_1', esc_attr( $_POST['content_block_formation_1'] ) );


if( isset( $_POST['content_block_formation_2'] ) )
update_post_meta( $post_id, 'content_block_formation_2', esc_attr( $_POST['content_block_formation_2'] ) );

if( isset( $_POST['content_block_formation_3'] ) )
 update_post_meta( $post_id, 'content_block_formation_3', esc_attr( $_POST['content_block_formation_3'] ) );

if( isset( $_POST['content_block_formation_4'] ) )
 update_post_meta( $post_id, 'content_block_formation_4', esc_attr( $_POST['content_block_formation_4'] ) );

// SAVE PDF FILE // Make sure the file array isn't empty
if(!empty($_FILES['wp_custom_attachment']['name'])) {

 // Setup the array of supported file types. In this case, it's just PDF.
 $supported_types = array('application/pdf');

 // Get the file type of the upload
 $arr_file_type = wp_check_filetype(basename($_FILES['wp_custom_attachment']['name']));
 $uploaded_type = $arr_file_type['type'];



 // Check if the type is supported. If not, throw an error.
 if(in_array($uploaded_type, $supported_types)) {

     // Use the WordPress API to upload the file
     $upload = wp_upload_bits($_FILES['wp_custom_attachment']['name'], null, file_get_contents($_FILES['wp_custom_attachment']['tmp_name']));

     if(isset($upload['error']) && $upload['error'] != 0) {
         wp_die('There was an error uploading your file. The error is: ' . $upload['error']);
     } else {

         add_post_meta($post_id, 'wp_custom_attachment', $upload);
         update_post_meta($post_id, 'wp_custom_attachment', $upload);

     } // end if/else

 } else {
     wp_die("The file type that you've uploaded is not a PDF.");
 } // end if/else

} // end if


} // FIN OK pour le none nonce_formation_block1

if(isset( $_POST['nonce_formation_position'] ) || wp_verify_nonce( $_POST['nonce_formation_position'], 'my_nonce_formation_position' ) ){

  if( isset( $_POST['formation_position'] ) )
 update_post_meta( $post_id, 'formation_position', esc_attr( $_POST['formation_position'] ) );

} // FIN OK pour le nonce my_nonce_formation_position

if(isset( $_POST['nonce_formation_price'] ) || wp_verify_nonce( $_POST['nonce_formation_price'], 'my_nonce_formation_price' ) ){

    if( isset( $_POST['formation_price'] ) )
    update_post_meta( $post_id, 'formation_price', esc_attr( $_POST['formation_price'] ) );
  
} // FIN OK pour le nonce my_nonce_formation_price

  
if(isset( $_POST['nonce_formation_priorite'] ) || wp_verify_nonce( $_POST['nonce_formation_priorite'], 'my_nonce_formation_priorite' ) ){

  if( isset( $_POST['formation_priorite'] ) )
 update_post_meta( $post_id, 'formation_priorite', esc_attr( $_POST['formation_priorite'] ) );

} //



if(isset( $_POST['nonce_formation_dates'] ) || wp_verify_nonce( $_POST['nonce_formation_dates'], 'my_nonce_formation_dates' ) ){

  if( isset( $_POST['date_formation_du'] ) )
 update_post_meta( $post_id, 'date_formation_du', esc_attr( $_POST['date_formation_du'] ) );

  if( isset( $_POST['date_formation_au'] ) )
 update_post_meta( $post_id, 'date_formation_au', esc_attr( $_POST['date_formation_au'] ) );

} // FIN OK pour le nonce date


if(isset( $_POST['nonce_global_workshop'] ) || wp_verify_nonce( $_POST['nonce_global_workshop'], 'my_nonce_global_workshop' ) ){

  // DATES
  if( isset( $_POST['date_session_1_du'] ) )
 update_post_meta( $post_id, 'date_session_1_du', esc_attr( $_POST['date_session_1_du'] ) );

  if( isset( $_POST['date_session_1_au'] ) )
 update_post_meta( $post_id, 'date_session_1_au', esc_attr( $_POST['date_session_1_au'] ) );


 if( isset( $_POST['date_session_2_du'] ) )
 update_post_meta( $post_id, 'date_session_2_du', esc_attr( $_POST['date_session_2_du'] ) );


 if( isset( $_POST['date_session_2_au'] ) )
 update_post_meta( $post_id, 'date_session_2_au', esc_attr( $_POST['date_session_2_au'] ) );

 // PRIX //
 if( isset( $_POST['ecolage_wk'] ) )
 update_post_meta( $post_id, 'ecolage_wk', esc_attr( $_POST['ecolage_wk'] ) );

 // RESUME //

  if( isset( $_POST['titre_workshop_cour'] ) )
 update_post_meta( $post_id, 'titre_workshop_cour', esc_attr( $_POST['titre_workshop_cour'] ) );

 if( isset( $_POST['desc_resume_workshop'] ) )
 update_post_meta( $post_id, 'desc_resume_workshop', $_POST['desc_resume_workshop']);

 // PROGRAMME //

  if( isset( $_POST['programme_workshop'] ) )
 update_post_meta( $post_id, 'programme_workshop', $_POST['programme_workshop']);

 if( isset( $_POST['contenu_workshop'] ) )
     update_post_meta( $post_id, 'contenu_workshop', $_POST['contenu_workshop']);
 if( isset( $_POST['public_workshop'] ) )
     update_post_meta( $post_id, 'public_workshop', $_POST['public_workshop']);
 if( isset( $_POST['workshop_subtitle'] ) )
     update_post_meta( $post_id, 'workshop_subtitle', $_POST['workshop_subtitle']);
                     

} // OK pour le nonce workshop

if(isset( $_POST['nonce_wk_position'] ) || wp_verify_nonce( $_POST['nonce_wk_position'], 'my_nonce_wk_position' ) ){

  if( isset( $_POST['wk_position'] ) )
 update_post_meta( $post_id, 'wk_position', $_POST['wk_position']);

} // OK non position workshop

if(isset( $_POST['nonce_metbox_titre_noir'] ) || wp_verify_nonce( $_POST['nonce_metbox_titre_noir'], 'my_nonce_metbox_titre_noir' ) ){

  if( isset( $_POST['title_black'] ) )
 update_post_meta( $post_id, 'title_black', $_POST['title_black']);

} // OK titre noir

if(isset( $_POST['nonce_deux_lignes'] ) || wp_verify_nonce( $_POST['nonce_deux_lignes'], 'my_nonce_deux_lignes' ) ){

  if( isset( $_POST['titre_deux_ligne'] ) )
 update_post_meta( $post_id, 'titre_deux_ligne', $_POST['titre_deux_ligne']);

} // OK titre noir







if(isset( $_POST['nonce_wk_priorite'] ) || wp_verify_nonce( $_POST['nonce_wk_priorite'], 'my_nonce_wk_priorite' ) ){

  if( isset( $_POST['wk_priorite'] ) )
 update_post_meta( $post_id, 'wk_priorite', $_POST['wk_priorite']);

} // OK non position workshop


if(isset( $_POST['nonce_wk_complet'] ) || wp_verify_nonce( $_POST['nonce_wk_complet'], 'my_nonce_wk_complet' ) ){

  if( isset( $_POST['wk_complet'] ) )
 update_post_meta( $post_id, 'wk_complet', $_POST['wk_complet']);

} // OK non position workshop



if(isset( $_POST['nonce_globale_projet'] ) || wp_verify_nonce( $_POST['nonce_globale_projet'], 'my_nonce_globale_projet' ) ){

  if( isset( $_POST['lien_projet'] ) )
 update_post_meta( $post_id, 'lien_projet', $_POST['lien_projet']);

   if( isset( $_POST['annee_projet'] ) )
 update_post_meta( $post_id, 'annee_projet', $_POST['annee_projet']);

} // OK pour informations de projets


}

add_action( 'save_post', 'save_meta_box' );

// possibilité upload fichiers !
function update_edit_form() {
echo ' enctype="multipart/form-data"';
} // end update_edit_form
add_action('post_edit_form_tag', 'update_edit_form');
