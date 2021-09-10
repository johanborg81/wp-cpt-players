<?php
if (!defined('ABSPATH')) {
    exit;
}
/**
 * Class RegisterTaxonomyTeam
 * 
 * @author Johan Borg <johanborg81@hotmail.com>
 * @package jaybeeplayers
 * @since 1.0.0
 */
class RegisterTaxonomyTeam
{
    /**
     * Constructor for this class
     */
    public function __construct()
    {
        add_action('init', [$this, 'jaybee_register_taxonomy_teams']);
    }

    /**
     * Function to register and defining labels and arguments
     * for the Team taxonomy
     * 
     * @author Johan Borg <johanborg81@hotmail.com>
     * @package jaybeeplayers
     * @access public
     * @since 1.0.0
     */
    public function jaybee_register_taxonomy_teams()
    {
        $labels = [
            'name'  => _x('Teams', 'taxonomy general name'),
            'singular_name' => __('Team'),
            'search_items'  => __('Search Teams'),
            'popular_items' => __('Popular Teams'),
            'all_items'     => __('All Teams'),
            'parent_item'   => null,
            'parent_item_colon' => null,
            'edit_item'     => __('Edit Team'),
            'update_item'   => __('Update Team'),
            'new_item_name' => __('New Team Name'),
            'seperate_items_with_commas' => __('Seperate teams with commas'),
            'add_or_remove_items'   => __('Add or remove topics'),
            'choose_from_most_used' => __('Choose from the most used topics'),
            'menu_name'     => __('Teams')
        ];

        $args = [
            'labels'    => $labels,
            'hierarchical'  => false,
            'show_ui'   => true,
            'show_in_rest'  => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite'   => ['slug' => 'team']
        ];

        register_taxonomy('teams', 'jaybee_players', $args);
    }
}

new RegisterTaxonomyTeam();

// EOF
