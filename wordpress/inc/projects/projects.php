<?php 

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
		"show_in_rest" => true,
		"rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"rewrite" => array( "slug" => "projet" ),
		"query_var" => true,
		"supports" => array( "title", "thumbnail" ),
	);

	register_post_type( "projet", $args );
}

add_action( 'init', 'cptui_register_my_cpts_projet' );



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