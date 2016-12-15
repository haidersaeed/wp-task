<?php
/**
 * Get ajax request for skills
 *
 *
 */
function query_skills_posts()
{
    check_ajax_referer( 'ajax_post_validation', 'security' );

    // Processing request
    $response_data = array();
    $response_data['skills_list'] = '';
    $total_skills = 0;
    $total_results = 0;
    $args = array(
        'post_type' => 'skill',
        'post_status' => 'publish',
        'posts_per_page' => -1
    );

    $skill_query = new WP_Query( $args );

    if( $skill_query->have_posts() ) : while ( $skill_query->have_posts() ) : $skill_query->the_post();


        
        $post_skill_name = get_post_meta(get_the_ID(), '_skill_name', true);
        $post_skill_result = get_post_meta(get_the_ID(), '_skill_result', true);

        $response_data['skills_list'] .= '
            <li>
                <p>'.$post_skill_name.'</p>
                <div class="progress-bar">
                    <div class="progress-bar-inner" style="width:'.(int)$post_skill_result.'%;">        
                    </div>
                </div>
                <span>'.$post_skill_result.'%</span>
            </li>
        ';

        // counting total average score
        $total_skills++; 
        $total_results += (int) $post_skill_result;

    endwhile; else :

        wp_send_json_error( array( 'error' => '<p>No skill found.</p>' ) );

    endif;
    wp_reset_postdata();


    $response_data['skills_total'] = ceil($total_results / ($total_skills)); 

    wp_send_json_success( $response_data );
    
}

add_action( 'wp_ajax_query_skills_posts', 'query_skills_posts' );
add_action( 'wp_ajax_nopriv_query_skills_posts', 'query_skills_posts' );