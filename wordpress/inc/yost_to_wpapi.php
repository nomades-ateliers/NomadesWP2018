<?php
/**
 * Plugin Name: JSON REST API Yoast routes 
 * Description: Adds Yoast fields to page and post metadata 
 */
function wp_api_encode_yoast($post) {
    $yoastMeta = array(
        'yoast_wpseo_focuskw' => get_post_meta($post['id'], '_yoast_wpseo_focuskw', true),
        'yoast_wpseo_title' => get_post_meta($post['id'], '_yoast_wpseo_title', true),
        'yoast_wpseo_metadesc' => get_post_meta($post['id'], '_yoast_wpseo_metadesc', true),
        'yoast_wpseo_linkdex' => get_post_meta($post['id'], '_yoast_wpseo_linkdex', true),
        'yoast_wpseo_metakeywords' => get_post_meta($post['id'], '_yoast_wpseo_metakeywords', true),
        'yoast_wpseo_meta-robots-noindex' => get_post_meta($post['id'], '_yoast_wpseo_meta-robots-noindex', true),
        'yoast_wpseo_meta-robots-nofollow' => get_post_meta($post['id'], '_yoast_wpseo_meta-robots-nofollow', true),
        'yoast_wpseo_meta-robots-adv' => get_post_meta($post['id'], '_yoast_wpseo_meta-robots-adv', true),
        'yoast_wpseo_canonical' => get_post_meta($post['id'], '_yoast_wpseo_canonical', true),
        'yoast_wpseo_redirect' => get_post_meta($post['id'], '_yoast_wpseo_redirect', true),
        'yoast_wpseo_opengraph-title' => get_post_meta($post['id'], '_yoast_wpseo_opengraph-title', true),
        'yoast_wpseo_opengraph-description' => get_post_meta($post['id'], '_yoast_wpseo_opengraph-description', true),
        'yoast_wpseo_opengraph-image' => get_post_meta($post['id'], '_yoast_wpseo_opengraph-image', true),
        'yoast_wpseo_twitter-title' => get_post_meta($post['id'], '_yoast_wpseo_twitter-title', true),
        'yoast_wpseo_twitter-description' => get_post_meta($post['id'], '_yoast_wpseo_twitter-description', true),
        'yoast_wpseo_twitter-image' => get_post_meta($post['id'], '_yoast_wpseo_twitter-image', true)
    );
    // $data->data['yoast_meta'] = (array) $yoastMeta;
    // return $data;
    return $yoastMeta;
}
// add_filter('rest_prepare_post', 'wp_api_encode_yoast', 10, 3);
// add_filter('rest_prepare_page', 'wp_api_encode_yoast', 10, 3);
register_rest_field( array( 'post', 'page', 'workshop' ), 'yost_seo', array(
    'schema'       => array(
        'type'        => 'array',
        'description' => 'Get SEO datas from Yost SEO Plugin',
        'context'     => array( 'view' ),
    ),
    'get_callback' => 'wp_api_encode_yoast',
) );