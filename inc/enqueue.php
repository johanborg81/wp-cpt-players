<?php

/**
 * Enqueue scripts
 * @package jaybeeplayers
 * @since 1.0.0
 */
if (!defined('ABSPATH')) {
    exit;
}
/**
 * Class EnqueueScripts
 * 
 * @package jaybeeplayers
 * @since 1.0.0
 */
class EnqueueScripts
{
    /**
     * Construct function to initialize the custom fields and metaboxes.
     * 
     * @since 1.0.0
     */
    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'jaybee_players_script']);
    }

    public function jaybee_players_script()
    {
        wp_enqueue_style('jaybee_players_style', plugin_dir_url(__FILE__) . '../assets/css/style.css', [], '1.0.0', 'all');
    }
}

new EnqueueScripts();

// EOF
