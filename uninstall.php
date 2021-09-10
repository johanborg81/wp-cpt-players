<?php

/**
 * Uninstall the plugin
 * 
 * @package jaybeeplayers
 * @since 1.0.0
 */
if (!defined('ABSPATH')) {
    exit;
}
/**
 * UninstallPlayerPlugin class
 * 
 * @package jaybeeplayers
 * @since 1.0.0
 */
class UninstallPlayerPlugin
{
    public function __construct()
    {
        register_deactivation_hook(__FILE__, [$this, 'jaybee_players_post_type_deactivate']);
        register_uninstall_hook(__FILE__, [$this, 'jaybee_players_post_type_uninstall']);
    }

    /**
     * Deactivate the plugin
     *
     * @author Johan Borg <johanborg81@hotmail.com>
     * @access public
     * @package jaybeeplayers
     * @since 1.0.0
     * @return void
     */
    public function jaybee_players_post_type_deactivate()
    {
        unregister_post_type('jaybee_players');
        flush_rewrite_rules();
    }

    /**
     * Uninstall posts from the database
     *
     * @author Johan Borg <johanborg81@hotmail.com>
     * @access public
     * @package jaybeeplayers
     * @since 1.0.0
     * @param mixed $wpdb
     * @return void
     */
    public function jaybee_players_post_type_uninstall()
    {
        if (!defined('WP_UNINSTALL_PLUGIN')) {
            die;
        }

        global $wpdb;
        $wpdb->query("DELETE FROM wp_posts WHERE post_type = jaybee_players");
        $wpdb->query("DELETE FROM wp+postmeta WHERE post_id NOT IN(SELECT id FROM wp_posts)");
        $wpdb->query("DELETE FROM wp_term_relationship WHERE object_id NOT IN (SELECT id FROM wp_posts)");
    }
}

new UninstallPlayerPlugin();

// EOF
