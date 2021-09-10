<?php

/**
 * Custom template for the player archive page.
 * 
 * @package jaybeeplayers
 * @since
 */
if (!defined('ABSPATH')) {
    exit;
}

/**
 * class ArchivePlayer
 * 
 * @author Johan Borg <johanborg81@hotmail.com>
 * @package jaybeeplayers
 * @since 1.0.0
 */
class ArchivePlayer
{
    public function __construct()
    {
        add_shortcode('players_list_shortcode', [$this, 'archive_players_page']);
    }

    /**
     * Display all players on the archive page for players.
     * 
     * @author Johan Borg <johanborg81@hotmail.com>
     * @since 1.0.0
     * @package jaybeeplayers
     * @return void
     */
    public function archive_players_page()
    {
        $args = [
            'posts_per_page' => 10,
            'post_type' => 'jaybee_players'
        ];
        global $post;

        $string = '';
        $loop = new WP_Query($args);

        if ($loop->have_posts()) :

            while ($loop->have_posts()) : $loop->the_post($post->ID);
                $nationality = get_post_meta(get_the_ID(), '_jaybee_nationality_data', true);
                $foot = get_post_meta(get_the_ID(), '_jaybee_shoot_data', true);
                $birthdate = get_post_meta(get_the_ID(), '_jaybee_birthdate_data', true);
?>
                <ul class="jaybee_players-list">
                    <li>
                        <a href=" <?php echo the_permalink(); ?>">
                            <?php the_post_thumbnail(); ?>
                            <h2><?php echo the_title(); ?></h2>
                            <p>Birthdate: <?php echo $birthdate; ?></p>
                            <p>Nationality: <?php echo $nationality; ?></p>
                            <p>Shoots: <?php echo $foot; ?></p>
                            <p>
                                <?php
                                foreach (get_the_terms(get_the_ID(), 'position') as $position) {
                                    echo 'Position: ' . $position->name;
                                }
                                ?>
                            </p>
                            <p><?php echo the_excerpt(); ?></p>
                        </a>
                    </li>
                </ul>
<?php
            endwhile;

        endif;
        wp_reset_postdata();
        return $string;
    }
}

new ArchivePlayer();

// EOF
