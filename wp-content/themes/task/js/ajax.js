/* 
 * @plugin SO Ajax Shortcode
 */
var jQuery2 = jQuery.noConflict(true);
(function($) {

    $(document).ready(function(){

        if(wp_ajax.ajaxnonce != ''){
            var data = {
                 action: 'query_skills_posts',
                 security: wp_ajax.ajaxnonce
            };

        
            $( '.breakdown > .skills-list' ).html( 'Loading ...' );
            $.post( 
                wp_ajax.ajaxurl, 
                data,                   
                function( response )
                {
                    // Error Handling
                    if( !response.success ){
                        // No data came back, maybe a security error
                        if( !response.data ){
                            $( '.breakdown >.skills-list' ).html( 'AJAX ERROR: no response' );
                        }else{
                            $( '.breakdown >.skills-list' ).html( response.data.error );
                        }
                    }else{
                        $( '.breakdown >.skills-list' ).html( response.data.skills_list );
                        var val = response.data.skills_total;
                        var $circle = $('#svg #bar');
                        var r = $circle.attr('r');
                        var c = Math.PI*(r*2);

                        if (val < 0) { val = 0;}
                        if (val > 100) { val = 100;}

                        var pct = ((100-val)/100)*c;

                        $circle.css({ strokeDashoffset: pct});

                        $('#cont').attr('data-pct',val);
                        
                    }
                }
            );
        }
    });
}(jQuery2));




// jQuery( document ).ready( function( $ ) 
// { 
//      var data = {
//          action: 'query_rand_post',
//          security: wp_ajax.ajaxnonce
//      };
//      var image = '<img src="' + wp_ajax.loading + '" alt="Loading ..." width="16" height="16" />';

    
//         $( '#randomposts' ).html( image );
//         $.post( 
//             wp_ajax.ajaxurl, 
//             data,                   
//             function( response )
//             {
//                 // ERROR HANDLING
//                 if( !response.success )
//                 {
//                     // No data came back, maybe a security error
//                     if( !response.data )
//                         $( '#randomposts' ).html( 'AJAX ERROR: no response' );
//                     else
//                         $( '#randomposts' ).html( response.data.error );
//                 }
//                 else
//                     $( '#randomposts' ).html( response.data );
//             }
//         ); 

// });