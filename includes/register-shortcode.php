<?php
/**
 * Register a Hej Glossar shortcode.
 *
 * @package     hej-glossar
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

/**
 * Register the shortcode.
 *
 * @param array $atts User definited attributes.
 */
// Shortcode [hej_glossar_directory]
function hej_glossar_direct() {
	$html = '<section id="hej-glossar-shortcode-directory">';
	$args = array( 'post_type' => 'hej_glossar',  'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => '-1');
	$loop = new WP_Query( $args );

	$current_initialletter = null;
	$current_initialletter2 = null;

    if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post();
        $title = get_the_title();

        if($title):
            $entry_initialletter = strtoupper(mb_substr($title, 0, 1));
            $isFirstCharLetter = ctype_alpha($entry_initialletter);
            $permalink = get_permalink();

            if($isFirstCharLetter == True) {
                if (is_null($current_initialletter) || $current_initialletter != $entry_initialletter) {

                    $html .= '<h2 id="'.$entry_initialletter.'"><span>'.$entry_initialletter.'</span> </h2>';
                    $current_initialletter = $entry_initialletter;
                }
                $html .= '<p><a href="'.$permalink.'">'.$title.'</a></p>';
            } else {
                $headline = true;
                $nhtml .= '<p><a href="'.$permalink.'">'.$title.'</a></p>';
            }
        endif;
    endwhile;
    endif;
    if ($headline) {
        $html .= '<a name="all"></a><h2><span>#</span> </h2>';
    }
    $html .= $nhtml;
    $html .= '</section>';
    return $html;

}
add_shortcode('hej_glossar_directory', 'hej_glossar_direct'); 

// Shortcode [hej_glossar_navigation]
function hej_glossar_nav() {
	$html = '<nav id="hej-glossar-shortcode-navigation">';
	$args = array( 'post_type' => 'hej_glossar',  'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => '-1'  );
	$loop = new WP_Query( $args );
	$array = array();
	if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post();
		$str = get_the_title();
		$array[] = strtoupper(substr($str, 0, 1));
	endwhile;
	endif;

    $html .= '<ul class="hej-glossar-navigation">';
    $clean_array = array_unique($array);
    for($i = 65; $i < 91; $i++) {

        if(in_array(chr($i), $clean_array)) {
            $html .= '<li class="hej-glossar-has-item"><a href="#'.chr($i).'">'.chr($i).'</a></li>';

        } else {
            $html .= '<li class="hej-glossar-no-item">'.chr($i).'</li>';
        }
    }

    if(!preg_match("/^[A-Z]$/", $clean_array[0]) OR !preg_match("/^[A-Z]$/", end($clean_array))) {
        $html .= '<span><a href="#all">#</a></span>';
    } else {
        $html .= '<span>#</span>';
    }
    $html .= '</ul>';
    $html .='<div style="clear:left;"></div></nav>';
    return $html;
    
};
add_shortcode('hej_glossar_navigation', 'hej_glossar_nav'); 
