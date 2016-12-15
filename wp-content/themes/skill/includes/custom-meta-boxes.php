<?php
/**
 * Add skill meta box
 *
 * @param post $post The post object
 */
function skill_add_meta_boxes( $post ){
    add_meta_box( 'skill_meta_box', __( 'Skill Details', 'html5blank' ), 'skill_build_meta_box', 'skill' );
}
add_action( 'add_meta_boxes', 'skill_add_meta_boxes' );








/**
 * Build skill meta box
 *
 * @param post $post The post object
 */
function skill_build_meta_box( $post ){
    // make sure the form request comes from WordPress
    wp_nonce_field( basename( __FILE__ ), 'skill_meta_box_nonce' );

    // get skill name current value
    $skill_name = get_post_meta( $post->ID, '_skill_name', true );

    // get skill result current value
    $skill_result = get_post_meta( $post->ID, '_skill_result', true );
    
    ?>
    <div class='inside'>

        <h3><?php _e( 'Skill Name', 'html5blank' ); ?></h3>
        <p>
            <input class="regular-text" type="text" name="skill_name" value="<?php echo $skill_name; ?>" required> 
        </p>

        <h3><?php _e( 'Skill Result', 'html5blank' ); ?></h3>
        <p>
            <input class="regular-text" type="number" min="0" max="100" step="1" name="skill_result" value="<?php echo $skill_result; ?>" required> %
        </p>
        
    </div>
    <?php
}










/**
 * Store skill custom field meta box data
 *
 * @param int $post_id The post ID.
 */
function skill_save_meta_box_data( $post_id ){
    // verify taxonomies meta box nonce
    if ( !isset( $_POST['skill_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['skill_meta_box_nonce'], basename( __FILE__ ) ) ){
        return;
    }
    // return if autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
        return;
    }
    // Check the user's permissions.
    if ( ! current_user_can( 'edit_post', $post_id ) ){
        return;
    }

    // store skill name
    if ( isset( $_REQUEST['skill_name'] ) ) {
        update_post_meta( $post_id, '_skill_name', sanitize_text_field( $_POST['skill_name'] ) );
    }
    
    // store skill result
    if ( isset( $_REQUEST['skill_result'] ) ) {
        update_post_meta( $post_id, '_skill_result', sanitize_text_field( $_POST['skill_result'] ) );
    }
    
}
add_action( 'save_post_skill', 'skill_save_meta_box_data' );