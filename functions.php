<?php

/**
 * Bring in all files.
 * 
 * @package jaybeeplayers
 * @since 1.0.0
 */
if (!defined('ABSPATH')) {
    exit;
}

require_once plugin_dir_path(__FILE__) . 'class-players-custom-post-type.php';
require_once plugin_dir_path(__FILE__) . '/custom-fields/class-jaybee-custom-fields.php';
require_once plugin_dir_path(__FILE__) . '/taxonomies/class-position-players-taxonomy.php';
require_once plugin_dir_path(__FILE__) . '/taxonomies/class-sex-players-taxonomy.php';
require_once plugin_dir_path(__FILE__) . '/taxonomies/class-teams-players-taxonomy.php';
require_once plugin_dir_path(__FILE__) . '/views/class-view-players-frontpage.php';
require_once plugin_dir_path(__FILE__) . '/views/templates/archive-jaybee_players.php';
require_once plugin_dir_path(__FILE__) . '/views/templates/single-player.php';
require_once plugin_dir_path(__FILE__) . '/inc/enqueue.php';
require_once plugin_dir_path(__FILE__) . 'uninstall.php';

// EOF
