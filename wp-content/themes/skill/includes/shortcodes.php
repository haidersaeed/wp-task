<?php
/**
 * Generate skills shortcode
 *
 *
 */
function skills_shortcode( $atts ) 
{
    // enqueue when shorcode is present
    wp_enqueue_script('jquery-2');
    wp_enqueue_script('ajax-skills');
    
    $output = '<ul class="skills-list"></ul>';
    return $output;
}
add_shortcode( 'skills', 'skills_shortcode' );










/**
 * Generate skills shortcode
 *
 *
 */
function skills_result_shortcode( $atts ) 
{
    // enqueue when shorcode is present
    wp_enqueue_script('jquery-2');
    wp_enqueue_script('ajax-skills');

    $output = '
            <!-- Main Div Starts Here
            ========================= -->    
            <div id="main">
                <!-- table -->
                <div class="skill-container table">
                    <!-- Tbale-cell -->
                    <div class="table-cell">
                        <!-- Container-->
                        <div class="container">

                            <!-- Result Portion Starts Here 
                            =============================== -->
                            <div class="result">
                                <h2>Result</h2>

                                <!-- Percentage Circle Bar -->
                                <div id="cont" data-pct="0">
                                    <div class="total-text">total</div>
                                    <svg id="svg" width="200" height="200" viewPort="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                      <circle r="70" cx="100" cy="80" fill="transparent" stroke-dasharray="439.82" stroke-dashoffset="0"></circle>
                                      <circle id="bar" r="70" cx="100" cy="80" fill="transparent" stroke-dasharray="439.82" stroke-dashoffset="0" transform="rotate(-90,100,80)"></circle>
                                    </svg>
                                </div>
                                <!-- Percentage Circle Bar -->

                                <!-- Percentage Bar Data -->
                                <div class="percentage-data">
                                    <div class="tp-text">
                                        <strong>status:</strong>
                                        <span>fail</span>
                                        <a href="#" title="">change</a>
                                    </div>
                                    
                                    <div class="bt-text">
                                        <p>Time: <span>2h 2min</span> </p>
                                    </div>
                                    
                                    <p>(of max 1h 50min)</p>    
                                </div>
                                <!-- Percentage Bar Data -->
                                
                            </div>
                            <!-- Result Portion ENds Here 
                            =============================== -->

                            <!-- BreakDown Portion Starts Here 
                            ================================== -->
                            <div class="breakdown">
                                <h2>Breakdown</h2>
                                <ul class="skills-list"></ul>
                            </div>
                            <!-- BreakDown Portion Ends Here 
                            ================================== -->

                            <!-- History Portion Starts Here 
                            ================================== -->
                            <div class="history-sec">
                                <h2>history</h2>
                                <p>Invitation email on aug 15</p>
                                <p>Candidate started the test on aug 15</p>
                                <p>Candidate completed the test on aug 15</p>

                            </div>
                            <!-- History Portion ENds Here 
                            ================================== -->  
                        </div>
                        <!-- Container -->
                    </div>
                    <!-- table-cell-->
                </div>
               <!--table-->
            </div>
            <!-- Main Div Ends Here
            ======================= -->

        ';
    return $output;
}
add_shortcode( 'skills-result', 'skills_result_shortcode' );