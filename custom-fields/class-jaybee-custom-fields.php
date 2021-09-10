<?php

/**
 * Custom fields
 * 
 * @package jaybeeplayers
 * @since 1.0.0
 */
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class RegisterCustomFields
 * 
 * @package jaybeeplayers
 * @since 1.0.0
 * 
 */
class RegisterCustomFields
{
    /**
     * Construct function to initialize the custom fields and metaboxes
     * 
     * @since 1.0.0
     */
    public function __construct()
    {
        add_action('add_meta_boxes', [$this, 'jaybee_add_playerinfo_metabox']);
        add_action('save_post', [$this, 'jaybee_save_playerinfo']);
    }

    /**
     * Add the metabox
     * 
     * @author Johan Borg
     * @package jaybeeplayers
     * @access public
     * @since 1.0.0
     */
    public function jaybee_add_playerinfo_metabox()
    {
        add_meta_box('jaybee_playerinfo', __('Player Details', 'jaybeeplayers'), [$this, 'jaybee_playerinfo_metabox_callback'], 'jaybee_players', 'normal', 'high');
    }

    /**
     * Save the birthdate when the post is saved
     * 
     * @author Johan Borg
     * @package jaybeeplayers
     * @access public
     * @param int $post_id
     * @since 1.0.0
     */
    public function jaybee_save_playerinfo($post_id)
    {
        // Check nonce
        if (
            !isset($_POST['jaybee_birthdate_nonce']) ||
            !isset($_POST['jaybee_birthplace_nonce']) ||
            !isset($_POST['jaybee_nationality_nonce']) ||
            !isset($_POST['jaybee_height_nonce']) ||
            !isset($_POST['jaybee_shoot_nonce']) ||
            !isset($_POST['jaybee_nicknames_nonce'])
        ) {
            return $post_id;
        }

        $nonce = $_POST['jaybee_birthdate_nonce'];
        $birthplace_nonce = $_POST['jaybee_birthplace_nonce'];
        $nationality_nonce = $_POST['jaybee_nationality_nonce'];
        $height_nonce = $_POST['jaybee_height_nonce'];
        $shoot_nonce = $_POST['jaybee_shoot_nonce'];
        $nicknames_nonce = $_POST['jaybee_nicknames_nonce'];

        // Verify nonce
        if (
            !wp_verify_nonce($nonce, 'jaybee_birthdate_field') ||
            !wp_verify_nonce($birthplace_nonce, 'jaybee_birthplace_field') ||
            !wp_verify_nonce($nationality_nonce, 'jaybee_nationality_field') ||
            !wp_verify_nonce($height_nonce, 'jaybee_height_field') ||
            !wp_verify_nonce($shoot_nonce, 'jaybee_shoot_field') ||
            !wp_verify_nonce($nicknames_nonce, 'jaybee_nicknames_field')
        ) {
            return $post_id;
        }

        // Autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }

        // Check permissions
        if ('page' == $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id)) {
                return $post_id;
            }
        } else {
            if (!current_user_can('edit_post', $post_id)) {
                return $post_id;
            }
        }

        // Sanitize the data
        $birthdate = sanitize_text_field($_POST['jaybee_birthdate_field_data']);
        $birthplace = sanitize_text_field($_POST['jaybee_birthplace_field_data']);
        $nationality = sanitize_text_field($_POST['jaybee_nationality_field_data']);
        $height = sanitize_text_field($_POST['jaybee_height_field_data']);
        $shoot = sanitize_text_field($_POST['jaybee_shoot_field_data']);
        $nicknames = sanitize_text_field($_POST['jaybee_nicknames_field_data']);

        // Update the data
        update_post_meta($post_id, '_jaybee_birthdate_data', $birthdate);
        update_post_meta($post_id, '_jaybee_birthplace_data', $birthplace);
        update_post_meta($post_id, '_jaybee_nationality_data', $nationality);
        update_post_meta($post_id, '_jaybee_height_data', $height);
        update_post_meta($post_id, '_jaybee_shoot_data', $shoot);
        update_post_meta($post_id, '_jaybee_nicknames_data', $nicknames);
    }

    /**
     * Callback function to display the metabox fields
     * 
     * @author Johan Borg
     * @package jaybeeplayers
     * @access public
     * @since 1.0.0
     * @param WP_Post $post
     */
    public function jaybee_playerinfo_metabox_callback($post)
    {
        // Add nonce field
        wp_nonce_field('jaybee_birthdate_field', 'jaybee_birthdate_nonce');
        wp_nonce_field('jaybee_birthplace_field', 'jaybee_birthplace_nonce');
        wp_nonce_field('jaybee_nationality_field', 'jaybee_nationality_nonce');
        wp_nonce_field('jaybee_height_field', 'jaybee_height_nonce');
        wp_nonce_field('jaybee_shoot_field', 'jaybee_shoot_nonce');
        wp_nonce_field('jaybee_nicknames_field', 'jaybee_nicknames_nonce');

        // Retrieve data
        $birthdate_value = get_post_meta($post->ID, '_jaybee_birthdate_data', true);
        $birthplace_value = get_post_meta($post->ID, '_jaybee_birthplace_data', true);
        $nationality_value = get_post_meta($post->ID, '_jaybee_nationality_data', true);
        $height_value = get_post_meta($post->ID, '_jaybee_height_data', true);
        $shoot_value = get_post_meta($post->ID, '_jaybee_shoot_data', true);
        $nicknames_value = get_post_meta($post->ID, '_jaybee_nicknames_data', true);

        // Display the field
?>
        <div>
            <label for="jaybee_birthdate_field_data">
                <?php _e('Fill in the birthdate: YYYY-MM-DD', 'jaybeeplayers'); ?>
            </label>
            <input type="text" id="jaybee_birthdate_field_data" name="jaybee_birthdate_field_data" value="<?php echo esc_attr($birthdate_value); ?>" size="25">
        </div>
        <div>
            <label for="jaybee_birthplace_field_data">
                <?php _e('Birthplace: City, Country', 'jaybeeplayers'); ?>
            </label>
            <input type="text" id="jaybee_birthplace_field_data" name="jaybee_birthplace_field_data" value="<?php echo esc_attr($birthplace_value); ?>" size="25">
        </div>
        <div>
            <label for="jaybee_nationality_field_data">
                <?php _e('Nationality', 'jaybeeplayers'); ?>
            </label>
            <input type="text" id="jaybee_nationality_field_data" name="jaybee_nationality_field_data" value="<?php echo esc_attr($nationality_value); ?>" size="25">
        </div>
        <div>
            <label for="jaybee_height_field_data">
                <?php _e('Height in centimeters, ex: 180', 'jaybeeplayers'); ?>
            </label>
            <input type="text" id="jaybee_height_field_data" name="jaybee_height_field_data" value="<?php echo esc_attr($height_value); ?>" size="25">
        </div>
        <div>
            <label for="jaybee_shoot_field_data">
                <?php _e('Preferred foot, ex: Right', 'jaybeeplayers'); ?>
            </label>
            <input type="text" id="jaybee_shoot_field_data" name="jaybee_shoot_field_data" value="<?php echo esc_attr($shoot_value); ?>" size="25">
        </div>
        <div>
            <label for="jaybee_nicknames_field_data">
                <?php _e('Nicknames (separate with commas', 'jaybeeplayers'); ?>
            </label>
            <input type="text" id="jaybee_nicknames_field_data" name="jaybee_nicknames_field_data" value="<?php echo esc_attr($nicknames_value); ?>" size="25">
        </div>
<?php
    }
}

new RegisterCustomFields();

// EOF
