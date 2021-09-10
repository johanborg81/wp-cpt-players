<?php

/**
 * class SinglePlayer
 * 
 * @author Johan Borg <johanborg81@hotmail.com>
 * @package jaybeeplayers
 * @since 1.0.0
 */
class SinglePlayer
{

    /**
     * Display a specific player
     * 
     * @author Johan Borg <johanborg81@hotmail.com>
     * @package jaybeeplayers
     * @access public
     * @since 1.0.0
     */
    public function single_player_page()
    {

        add_action(
            'pre_get_posts',
            function (WP_Query $q) {
                if (!is_admin() && $q->is_main_query() && $q->is_search()) {

                    if (have_posts()) :
?>
                    <div>
                        <?php
                        while (have_posts()) : the_post();
                            echo '<h2>' . the_title() . '</h2>';
                        endwhile;
                        ?>
                    </div>
<?php
                    endif;
                }
            }
        );
    }
}
$single_player = new SinglePlayer();
$single_player->single_player_page();

// EOF
