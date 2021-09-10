<?php
if (!defined('ABSPATH')) {
    exit;
}
/**
 * Class RegisterTaxonomySex
 * 
 * @author Johan Borg <johanborg81@hotmail.com>
 * @package jaybeeplayers
 * @since 1.0.0
 */
class RegisterTaxonomySex
{
    /**
     * Constructor for this class
     */
    public function __construct()
    {
        add_action('init', [$this, 'jaybee_register_taxonomy_sex']);
    }

    /**
     * Function to register and defining labels and arguments
     * for the Sex taxonomy
     * 
     * @author Johan Borg <johanborg81@hotmail.com>
     * @package jaybeeplayers
     * @access public
     * @since 1.0.0
     */
    public function jaybee_register_taxonomy_sex()
    {
        $labels = [
            'name'  => _x('Sex', 'taxonomy general name'),
            'singular_name' => __('Sex'),
            'search_items'  => __('Search Sex'),
            'popular_items' => __('Popular Sex'),
            'all_items'     => __('All Sex'),
            'parent_item'   => __('Parent Sex'),
            'parent_item_colon' => __('Parent Sex'),
            'edit_item' => __('Edit Sex'),
            'update_item'   => __('Update Sex'),
            'add_new_item'  => __('Add New Sex'),
            'new_item_name' => __('New Sex'),
            'menu_name' => __('Sex')
        ];

        $args = [
            'herarchical' => true,
            'labels'    => $labels,
            'show_ui'   => true,
            'show_in_rest'  => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite'   => ['slug' => 'sex']
        ];

        register_taxonomy('sex', 'jaybee_players', $args);
    }
}

new RegisterTaxonomySex();

// EOF
