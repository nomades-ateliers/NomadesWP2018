<?php 

function cptui_register_my_cpts_workshop() {

	/**
	 * Post Type: Workshops.
	 */

	$labels = array(
		"name" => __( "Workshops"),
		"singular_name" => __( "Workshop"),
		"add_new" => __( "Ajouter nouveau"),
		"add_new_item" => __( "Ajouter Nouveau workshop"),
		"edit" => __( "Modifier"),
		"edit_item" => __( "Modifier un workshop"),
		"new_item" => __( "Nouveau Workshop"),
		"view" => __( "Voir le workshop"),
		"view_item" => __( "Voir le workshop"),
	);

	$args = array(
		"label" => __( "Workshops"),
		"labels" => $labels,
		"description" => "Custom post type pour les worksops",
		"public" => true,
		// "publicly_queryable" => false,
		"show_ui" => true,
		"show_in_rest" => true,
		// "rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
        "hierarchical" => true,
		"rewrite" => array( "slug" => "workshops"),
		"query_var" => true,
		"supports" => array( "title" ),
	);

	register_post_type( "workshop", $args );
}

add_action( 'init', 'cptui_register_my_cpts_workshop' );



// sous-titre de la formation
function workshop_subtitle() {
    add_meta_box( 'workshop_subtitle', 'Sous-titre de la formation', 'metbox_workshop_subtitle', 'workshop', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'workshop_subtitle' );

// nombre de seance de la formation
function workshop_seances() {
    add_meta_box( 'workshop_seances', 'Nombre de séances de la formation', 'metbox_workshop_seances', 'workshop', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'workshop_seances' );


// general workshop // special workshop
function workshop_globale() {
    add_meta_box( 'workshop_globale', 'Globales', 'metbox_workshop_globale', 'workshop', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'workshop_globale' );


function workshop_resume() {
    add_meta_box( 'workshop_resume', 'Programme et résumé', 'metbox_workshop_resume', 'workshop', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'workshop_resume' );


function wk_position() {
    add_meta_box( 'wk_position', 'Position du workshop dans la colonne', 'metbox_wk_position', 'workshop', 'normal', 'high' );

    
    // + Titre sur deux lignes
    add_meta_box( 'wk_titre_deux_ligne', 'Titre sur deux lignes (mettre la balise br)', 'metbox_wk_deux_lignes', 'workshop', 'normal', 'high' );

      // + Titre en noir 
      add_meta_box( 'wk_titre_en_noir', 'Mettre le titre en noir', 'metbox_titre_noir', 'workshop', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'wk_position' );

function wk_priorite() {
    // add_meta_box( 'wk_priorite', 'Priorite du workshop', 'metbox_wk_priorite', 'workshop', 'normal', 'high' );
    add_meta_box( 'wk_complet', 'Workshop complet', 'metbox_wk_complet', 'workshop', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'wk_priorite' );

function wk_nav() {
    add_meta_box( 'wk_nav', 'Workshop dans la barre de navigation', 'metbox_wk_nav', 'workshop', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'wk_nav' );

// special workshop
function metbox_workshop_resume( $post ) {

  wp_nonce_field( 'my_nonce_resume_workshop', 'nonce_resume_workshop' ); ?>

       <div class="admin_font">

              <div class="block_admin_pm voir_resume">
                  <h3> RESUME</h3>

                  <span class="precision_admin">Mettre &lsaquo;br/&rsaquo; à la fin d'une ligne pour faire un retour</span></p>


                 <p> <label for="desc_resume_workshop">Description résumé (3 lignes)</label><br />
                 <textarea name="desc_resume_workshop" id="desc_resume_workshop" ><?php echo wpshed_get_custom_field('desc_resume_workshop'); ?></textarea>


          </div>
          <hr/>
          <div class="">
                  <h3> PROGRAMME</h3>

                  <?php
                      $settings = array( 'media_buttons' => false,'tinymce' => array( 'width' => 'auto' ) );
                      wp_editor(wpshed_get_custom_field('programme_workshop'), 'programme_workshop', $settings );
                  ?>

                 <span class="precision_admin">Mettre Possibilité de Mettre des listes ou des titres</span></p>

          </div>
          <hr/>
          <div class="">
                  <h3> CONTENU</h3>

                  <?php
                      $settings = array( 'media_buttons' => false,'tinymce' => array( 'width' => 'auto' ) );
                      wp_editor(wpshed_get_custom_field('contenu_workshop'), 'contenu_workshop', $settings );
                  ?>
          </div>
          <hr/>
          <div class="">
                  <h3> PUBLIC CIBLE</h3>

                  <?php
                      $settings = array( 'media_buttons' => false,'tinymce' => array( 'width' => 'auto' ) );
                      wp_editor(wpshed_get_custom_field('public_workshop'), 'public_workshop', $settings );
                  ?>
          </div>
          
       </div>

<?php }



function metbox_wk_priorite( $post ) {

  wp_nonce_field( 'my_nonce_wk_priorite', 'nonce_wk_priorite' ); ?>
  <p><em>La date est mise en valeur</em></p>
  <p class="block_admin_pm grand titre_niveau">
     <label for="wk_priorite"> Workshop mis en valeur ? </label>

        <select name="wk_priorite" id="wk_priorite">
            <option value="NON">NON</option>
            <option <?php if (wpshed_get_custom_field('wk_priorite') == 'priorite') echo 'selected="selected"'; ?> value="priorite">OUI</option>
        </select>
 </p>


 <?php
}

function metbox_workshop_globale( $post ) {

       wp_nonce_field( 'my_nonce_global_workshop', 'nonce_global_workshop' ); ?>


      <div class="admin_font">

          <div class="block_admin_pm">

                       <h3>Date Session 1</h3>
                        <p><label for="date_session_1_du">DU : </label> <input type="text" id="date_session_1_du" name="date_session_1_du" class="datepicker" size="20" value="<?php echo wpshed_get_custom_field( 'date_session_1_du' ); ?>" /><br />
                        <label for="date_session_1_au">AU :</label> <input type="text" id="date_session_1_au" name="date_session_1_au" class="datepicker" size="20" value="<?php echo wpshed_get_custom_field( 'date_session_1_au' ); ?>" /></p>

          </div>

           <div class="block_admin_pm">
                   <h3>Date Session 2</h3>
                     <p><label for="date_session_2_du">DU :</label> <input type="text" id="date_session_2_du" name="date_session_2_du" class="datepicker" size="20" value="<?php echo wpshed_get_custom_field( 'date_session_2_du' ); ?>" /><br />
                    <label for="date_session_2_au">AU :</label> <input type="text" id="date_session_2_au" name="date_session_2_au" class="datepicker" size="20" value="<?php echo wpshed_get_custom_field( 'date_session_2_au' ); ?>" /></p>
          </div>

          <div class="block_admin_pm">
                      <h3>Titre Programme</h3>
                    <p> <label for="titre_workshop_cour">Titre cours</label><br />
                  <input type="text" id="titre_workshop_cour" name="titre_workshop_cour" value="<?php echo wpshed_get_custom_field( 'titre_workshop_cour' ); ?>"/></p>
          </div>




           <div class="block_admin_pm">
               <h3>Prix</h3>
                          <p><label for="ecolage_wk">ECOLAGE :</label> <input type="text" id="ecolage_wk" name="ecolage_wk" size="10" value="<?php echo wpshed_get_custom_field( 'ecolage_wk' ); ?>" /></p>
           </div>








      </div>



  <?php
}



function metbox_wk_nav( $post ) {

    wp_nonce_field( 'my_nonce_wk_nav', 'nonce_wk_nav' ); ?>
  
    <p class="block_admin_pm grand titre_niveau">
       <label for="wk_nav"> Workshop visible dans la barre de navigation des workshop sur la page detaillé de chaque workshop: </label>
       <select name="wk_nav" id="wk_nav">
            <option value="NON">NON</option>
            <option <?php if (wpshed_get_custom_field('wk_nav') == 'oui') echo 'selected="selected"'; ?> value="oui">OUI</option>
        </select>
   </p>
  
  
   <?php
  }

function metbox_wk_complet( $post ) {

  wp_nonce_field( 'my_nonce_wk_complet', 'nonce_wk_complet' ); ?>

  <p class="block_admin_pm grand titre_niveau">
     <label for="wk_priorite"> Workshop indiqué comme complet ? </label>

        <select name="wk_complet" id="wk_complet">
            <option value="NON">NON</option>
            <option <?php if (wpshed_get_custom_field('wk_complet') == 'complet') echo 'selected="selected"'; ?> value="complet">OUI</option>
        </select>
 </p>


 <?php
}

function metbox_wk_deux_lignes( $post ) {

  wp_nonce_field( 'my_nonce_deux_lignes', 'nonce_deux_lignes' ); ?>
<!--  
  <p><em>Si ce champ est rempli, il devient le titre du workshop, sinon, c'est le titre global</em></p>
  <p class="block_admin_pm grand titre_niveau">
     <label for="titre_deux_ligne"> Titre sur deux lignes (mettre la balise br) :</label>
       <input type="text" id="titre_deux_ligne" style="width:100%;" name="titre_deux_ligne" value="<?php echo wpshed_get_custom_field( 'titre_deux_ligne' ); ?>" />
 </p> -->


 <?php
}


function metbox_wk_position( $post ) {

  wp_nonce_field( 'my_nonce_wk_position', 'nonce_wk_position' ); ?>

  <p class="block_admin_pm grand titre_niveau">
     <label for="wk_position"> Position du workshop :</label>

        <select name="wk_position" id="wk_position">
            <option <?php if (wpshed_get_custom_field('wk_position') == 1) echo 'selected="selected"'; ?> value="1">Ligne 1</option>
            <option <?php if (wpshed_get_custom_field('wk_position') == 2) echo 'selected="selected"'; ?>  value="2">Ligne 2</option>
            <option <?php if (wpshed_get_custom_field('wk_position') == 3) echo 'selected="selected"'; ?>  value="3">Ligne 3</option>
            <option <?php if (wpshed_get_custom_field('wk_position') == 4) echo 'selected="selected"'; ?>  value="4">Ligne 4</option>
         <option <?php if (wpshed_get_custom_field('wk_position') == 5) echo 'selected="selected"'; ?>  value="4">Ligne 5</option>
        </select>
 </p>


 <?php
}


function metbox_workshop_subtitle( $post ) {

 wp_nonce_field( 'my_nonce_workshop_subtitle', 'nonce_workshop_subtitle' ); ?>

 <p class="block_admin_pm grand titre_niveau">
    <label for="workshop_subtitle">Sous-titre</label> <input type="text" id="workshop_subtitle" name="workshop_subtitle"   value="<?php echo wpshed_get_custom_field( 'workshop_subtitle' ); ?>" />
 </p>


<?php
}


function metbox_workshop_seances( $post ) {
    wp_nonce_field( 'my_nonce_workshop_seances', 'nonce_workshop_seances' ); ?>
    <p class="block_admin_pm grand titre_niveau">
       <label for="workshop_seances">Nombre de seances</label> <input type="text" id="workshop_seances" name="workshop_seances" value="<?php echo wpshed_get_custom_field( 'workshop_seances' ); ?>" />
    </p>
   <?php
}