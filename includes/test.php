<?php



	echo "<br>============================================================================<br>";


$content = '[[dd-owl-carousel id="35" title="Carousel Title"]привет ведмед[/dd-owl-carousel]]';

preg_match_all( '@\[([^<>&/\[\]\x00-\x20=]++)@', $content, $matches );

sa($matches);

sa($shortcode_tags);

$ignore_html = false;

$tagnames = array_intersect( array_keys( $shortcode_tags ), $matches[1] );

$content = do_shortcodes_in_html_tags( $content, $ignore_html, $tagnames );

sa($content);

$pattern = get_shortcode_regex( $tagnames );

preg_match_all( "/$pattern/", $content, $matches );
sa($matches);

sa($pattern);

// $content = preg_replace_callback( "/$pattern/", 'do_shortcode_tag', $content );

sa($content);

$content = unescape_invalid_shortcodes( $content );

sa($content);

$atts = shortcode_parse_atts('id="35" title="Carousel Title"');

sa($atts);

// sa($shortcode_tags['dd-owl-carousel']);
// echo $shortcode_tags['dd-owl-carousel']([ 'id' => 35, 'title' => 'Hallo carousel!' ]);


	echo "<br>============================================================================<br>";