<?php
if (!defined('ABSPATH')) {
    exit;
}
/**
 * Class RegisterTaxonomyPosition
 * 
 * @author Johan Borg
 * @package jaybeeplayers
 * @since 1.0.0
 */
class RegisterTaxonomyPosition
{
    /**
     * Constructor for this class.
     */
    public function __construct()
    {
        add_action('init', [$this, 'jaybee_register_taxonomy_position']);
    }

    /**
     * Function to register and defining labels and arguments
     * for the Position taxonomy.
     * 
     * @author Johan Borg 
     * @package jaybeeplayers
     * @access public
     * @since 1.0.0
     */
    public function jaybee_register_taxonomy_position()
    {
        $labels = [
            'name'  => _x('Positions', 'taxonomy general name'),
            'singular_name' => __('Position'),
            'search_items'  => __('Search Position'),
            'popular_items' => __('Popular Positions'),
            'all_items'     => __('All Positions'),
            'parent_item'   => __('Parent Position'),
            'parent_item_colon' => __('Parent Position'),
            'edit_item'     => __('Edit Position'),
            'update_item'   => __('Update Position'),
            'add_new_item'  => __('Add New Position'),
            'new_item_name' => __('New Position'),
            'menu_item'     => __('Positions')
        ];

        $args = [
            'hierarchical'  => true,
            'labels'    => $labels,
            'show_ui'   => true,
            'show_in_rest'  => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite'   => ['slug' => 'position']
        ];

        register_taxonomy('position', 'jaybee_players', $args);
    }
}

new RegisterTaxonomyPosition();

// EOF
