<?php
/*
Plugin Name: Personalize Recommendations
Description: Provides personalized recommendations using Amazon Personalize and Azure Personalize.
Version: 1.0
Author: Your Name
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Include necessary files and initialize plugin.
include_once plugin_dir_path(__FILE__) . 'includes/settings.php';
include_once plugin_dir_path(__FILE__) . 'includes/amazon-personalize.php';
include_once plugin_dir_path(__FILE__) . 'includes/azure-personalize.php';

// Activation and Deactivation Hooks
register_activation_hook(__FILE__, 'personalize_recommendations_activate');
register_deactivation_hook(__FILE__, 'personalize_recommendations_deactivate');

function personalize_recommendations_activate() {
    // Actions to perform on plugin activation.
}

function personalize_recommendations_deactivate() {
    // Actions to perform on plugin deactivation.
}

// Shortcode to display recommendations
function display_recommendations($atts) {
    $user_id = get_current_user_id(); // You can customize this to get user ID from $atts or other sources
    $amazon_recommendations = get_amazon_personalize_recommendations($user_id);
    $azure_recommendations = get_azure_personalize_recommendations($user_id);

    ob_start();
    echo '<h2>Amazon Personalize Recommendations</h2>';
    foreach ($amazon_recommendations as $item) {
        echo '<p>' . esc_html($item['itemId']) . '</p>';
    }

    echo '<h2>Azure Personalize Recommendations</h2>';
    foreach ($azure_recommendations as $item) {
        echo '<p>' . esc_html($item['id']) . '</p>';
    }

    return ob_get_clean();
}

add_shortcode('display_recommendations', 'display_recommendations');
?>
