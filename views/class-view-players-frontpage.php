<?php

/**
 * Add players post to archive, search and front page.
 * 
 * @package jaybeeplayers
 * @since 1.0.0
 */
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class ViewPlayersFrontPage
 * 
 * @author Johan Borg <johanborg81@hotmail.com>
 * @package jaybeeplayers
 * @since 1.0.0
 */
class ViewPlayersFrontPage
{
    /**
     * Function to add the action to display the players cpt.
     * 
     * @author Johan Borg <johanborg81@hotmail.com>
     * @package jaybeeplayers
     * @access public
     * @since 1.0.0
     */
    public function __construct()
    {
        add_action('pre_get_posts', [$this, 'add_players_to_query'], 1);
    }

    /**
     * Function to query the cpt players.
     * 
     * @author Johan Borg <johanborg81@hotmail.com>
     * @package jaybeeplayers
     * @access public
     * @since 1.0.0
     * @param WP_Query $query
     */
    public function add_players_to_query($query)
    {
        if (is_home() && $query->is_main_query()) {
            $query->set('post_type', ['post', 'jaybee_players']);
        }

        if (!is_admin() && $query->is_main_query()) {
            if ($query->is_search()) {
                $query->set('post_type', ['post', 'jaybee_players']);
            }

            if ($query->is_category()) {
                $query->set('post_type', ['post', 'jaybee_players']);
                $query->set('posts-per_page', 15);
            }

            if ($query->is_tag()) {
                $query->set('post_type', ['post', 'jaybee_players']);
            }
        }
    }
}

new ViewPlayersFrontPage();

// EOF
