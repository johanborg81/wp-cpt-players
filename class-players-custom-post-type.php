<?php

/**
 * Register custom post type players
 * 
 * @package jaybeeplayers
 * @since 1.0.0
 */
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class RegisterPlayers
 * 
 * @author Johan Borg <johanborg@hotmail.com>
 * @package jaybeeplayers
 * @since 1.0.0
 */
class RegisterPlayers
{
    /**
     * Construct function to initialize the custom post type
     * 
     * @package jaybeeplayers
     * @since 1.0.0
     */
    public function __construct()
    {
        add_action('init', [$this, 'create_cpt_players']);
        register_activation_hook(__FILE__, [$this, 'jaybee_players_post_type_install']);
    }

    /**
     * Create Custom post type players
     * 
     * @author Johan Borg <johanborg81@hotmail.com>
     * @package jaybeeplayers
     * @access public
     * @since 1.0.0
     */
    public function create_cpt_players()
    {
        $labels = [
            'name'  => _x('Players', 'jaybeeplayers'),
            'singular_name' => _x('Player', 'Singular name'),
            'add_new'   => __('New Player'),
            'add_new_item'  => __('Add New Player'),
            'edit_item' => __('Edit Player'),
            'new_item'  => __('New Player'),
            'view_item' => __('View Players'),
            'search_item'   => __('Search Players'),
            'not_found' => __('No Players Found'),
            'not_found_in_trash'    => __('No Players found in trash')
        ];

        $birthdate = new RegisterCustomFields();

        $args = [
            'labels'    => $labels,
            'has_archive'   => true,
            'public'    => true,
            'hierarchical'  => true,
            'supports'  => [
                'title',
                'editor',
                'excerpt',
                'custom-fields',
                'thumbnail',
                'page-attributes'
            ],
            'taxonomies'    => ['category', 'post-tag', 'sex', 'teams', 'position'],
            'register_meta_box_cb'  => [$birthdate, 'jaybee_add_playerinfo_metabox'],
            'rewrite'   => ['slug' => 'player'],
            'show_in_rest'  => true
        ];

        register_post_type('jaybee_players', $args);
    }

    /**
     * Install and register the post type
     * 
     * @author Johan Borg <johanborg81@hotmail.com>
     * @access public
     * @package jaybeeplayers
     * @since 1.0.0
     */
    public function jaybee_players_post_type_install()
    {
        $this->create_cpt_players();

        flush_rewrite_rules();
    }
}

new RegisterPlayers();

// EOF
