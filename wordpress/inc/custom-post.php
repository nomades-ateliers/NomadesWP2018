<?php
function cptui_register_my_cpts() {

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
		"publicly_queryable" => false,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "formation", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title" ),
	);

	register_post_type( "formation", $args );

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
		"publicly_queryable" => false,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "workshop", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title" ),
	);

	register_post_type( "workshop", $args );

	/**
	 * Post Type: Projets.
	 */

	$labels = array(
		"name" => __( "Projets"),
		"singular_name" => __( "Projet"),
		"menu_name" => __( "Projets élèves"),
		"add_new" => __( "Ajouter nouveau"),
		"add_new_item" => __( "Ajouter Nouveau projet"),
		"edit" => __( "Modifier"),
		"edit_item" => __( "Modifier un projet"),
		"new_item" => __( "Nouveau Projet"),
		"view" => __( "Voir projet"),
		"view_item" => __( "Voir un projet"),
		"search_items" => __( "Rechercher un projet"),
	);

	$args = array(
		"label" => __( "Projets"),
		"labels" => $labels,
		"description" => "Type de contenu pour les projets en bas de page",
		"public" => true,
		"publicly_queryable" => false,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "projet", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "thumbnail" ),
	);

	register_post_type( "projet", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );

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
		"publicly_queryable" => false,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "formation", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title" ),
	);

	register_post_type( "formation", $args );
}

add_action( 'init', 'cptui_register_my_cpts_formation' );

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
		"publicly_queryable" => false,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "workshop", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title" ),
	);

	register_post_type( "workshop", $args );
}

add_action( 'init', 'cptui_register_my_cpts_workshop' );

function cptui_register_my_cpts_projet() {

	/**
	 * Post Type: Projets.
	 */

	$labels = array(
		"name" => __( "Projets"),
		"singular_name" => __( "Projet"),
		"menu_name" => __( "Projets élèves"),
		"add_new" => __( "Ajouter nouveau"),
		"add_new_item" => __( "Ajouter Nouveau projet"),
		"edit" => __( "Modifier"),
		"edit_item" => __( "Modifier un projet"),
		"new_item" => __( "Nouveau Projet"),
		"view" => __( "Voir projet"),
		"view_item" => __( "Voir un projet"),
		"search_items" => __( "Rechercher un projet"),
	);

	$args = array(
		"label" => __( "Projets"),
		"labels" => $labels,
		"description" => "Type de contenu pour les projets en bas de page",
		"public" => true,
		"publicly_queryable" => false,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "projet", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "thumbnail" ),
	);

	register_post_type( "projet", $args );
}

add_action( 'init', 'cptui_register_my_cpts_projet' );

function cptui_register_my_taxes() {

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
		"rewrite" => array( 'slug' => 'cursus', 'with_front' => false, ),
		"show_admin_column" => 0,
		"show_in_rest" => false,
		"rest_base" => "",
		"show_in_quick_edit" => true,
	);
	register_taxonomy( "cursus", array( "formation" ), $args );

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
		"hierarchical" => 1,
		"label" => "Parcours",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'parcours', 'with_front' => false, ),
		"show_admin_column" => 0,
		"show_in_rest" => false,
		"rest_base" => "",
		"show_in_quick_edit" => true,
	);
	register_taxonomy( "parcours", array( "workshop" ), $args );
}

add_action( 'init', 'cptui_register_my_taxes' );

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
		"rewrite" => array( 'slug' => 'cursus', 'with_front' => false, ),
		"show_admin_column" => 0,
		"show_in_rest" => false,
		"rest_base" => "",
		"show_in_quick_edit" => true,
	);
	register_taxonomy( "cursus", array( "formation" ), $args );
}

add_action( 'init', 'cptui_register_my_taxes_cursus' );

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
		"hierarchical" => 1,
		"label" => "Parcours",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'parcours', 'with_front' => false, ),
		"show_admin_column" => 0,
		"show_in_rest" => false,
		"rest_base" => "",
		"show_in_quick_edit" => true,
	);
	register_taxonomy( "parcours", array( "workshop" ), $args );
}

add_action( 'init', 'cptui_register_my_taxes_parcours' );

// -------------------------------
// -------------------------------
// -------------------------------
// -------------------------------
// -------------------------------
// -------------------------------
// -------------------------------



     // Ajouter block pour 0-10jours | 10-20 jours | 30 jours | 40 jours

    // lien : http://wpshed.com/create-custom-meta-box-easy-way/
    // Little function to return a custom field value
	function wpshed_get_custom_field( $value ) {
        global $post;

            $custom_field = get_post_meta( $post->ID, $value, true );
            if ( !empty( $custom_field ) )
            return is_array( $custom_field ) ? stripslashes_deep( $custom_field ) : stripslashes( wp_kses_decode_entities( $custom_field ) );

            return false;
        }

    /** 1. Meta Box Parameters */

   // Register the Metabox
    function wpshed_add_custom_meta_box() {
        add_meta_box( 'wpshed-meta-box', 'Informations globales', 'metbox_formation_block1', 'formation', 'normal', 'high' );
    }
        add_action( 'add_meta_boxes', 'wpshed_add_custom_meta_box' );

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


     function projet_global() {
        add_meta_box( 'projet_globale', 'Infos globales', 'metbox_projet_globale', 'projet', 'normal', 'high' );
    }
        add_action( 'add_meta_boxes', 'projet_global' );

    // special projet
    function metbox_projet_globale($post){

            wp_nonce_field( 'my_nonce_globale_projet', 'nonce_globale_projet' ); ?>

            <div class="admin_font">

                <div class="block_admin_pm voir_resume">
                        <h3> Infos : </h3>

                        <p>
                            <label>Lien vers le projet en ligne</label>
                            <input type="text" placeholder="http://www..." size="100" name="lien_projet" value="<?php echo wpshed_get_custom_field('lien_projet'); ?>">
                        </p>

                         <p>
                            <label for="annee_projet">Année de la réalisation du projet</label>
                            <select id="annee_projet" name="annee_projet">
                                <option value="2012" <?php if (wpshed_get_custom_field('annee_projet') == 2012) echo 'selected="selected"'; ?>>2012</option>
                                <option value="2013" <?php if (wpshed_get_custom_field('annee_projet') == 2013) echo 'selected="selected"'; ?>>2013</option>
                                <option value="2014" <?php if (wpshed_get_custom_field('annee_projet') == 2014) echo 'selected="selected"'; ?>>2014</option>
                                <option value="2015" <?php if (wpshed_get_custom_field('annee_projet') == 2015) echo 'selected="selected"'; ?>>2015</option>
                                <option value="2016" <?php if (wpshed_get_custom_field('annee_projet') == 2016) echo 'selected="selected"'; ?>>2016</option>
                                <option value="2017" <?php if (wpshed_get_custom_field('annee_projet') == 2017) echo 'selected="selected"'; ?>>2017</option>
                                <option value="2018" <?php if (wpshed_get_custom_field('annee_projet') == 2018) echo 'selected="selected"'; ?>>2018</option>
                                <option value="2019" <?php if (wpshed_get_custom_field('annee_projet') == 2019) echo 'selected="selected"'; ?>>2019</option>
                                <option value="2020" <?php if (wpshed_get_custom_field('annee_projet') == 2020) echo 'selected="selected"'; ?>>2020</option>
                            </select>
                        </p>

                        <p class="precision_admin">Image : Mettre une image au format suivant : 226px de large par 120px de haut</p>

                </div>


            </div>

   <?php }


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

                <div class="block_admin_pm">
                        <h3> PROGRAMME</h3>

                        <?php
                            $settings = array( 'media_buttons' => false,'tinymce' => array( 'width' => 200 ) );
                            wp_editor(wpshed_get_custom_field('programme_workshop'), 'programme_workshop', $settings );
                        ?>

                       <span class="precision_admin">Mettre Possibilité de Mettre des listes ou des titres</span></p>

                </div>

             </div>

     <?php }



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
        
         <p><em>Si ce champ est rempli, il devient le titre du workshop, sinon, c'est le titre global</em></p>
         <p class="block_admin_pm grand titre_niveau">
            <label for="titre_deux_ligne"> Titre sur deux lignes (mettre la balise br) :</label>

              <input type="text" id="titre_deux_ligne" style="width:100%;" name="titre_deux_ligne" value="<?php echo wpshed_get_custom_field( 'titre_deux_ligne' ); ?>" />
        </p>


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

