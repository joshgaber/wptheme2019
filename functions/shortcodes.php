<?php

/**
	[row] - Creates a Twitter Bootstrap row tag
*/
function tb_row_shortcode ( $atts, $content ) {
	extract( shortcode_atts( array(
		'class' => ""
	), $atts ) );

	return "<div class=\"row {$class}\">" . do_shortcode( $content ) . "</div>";
}
add_shortcode( "row", "tb_row_shortcode" );

/**
	[col] - Creates a Twitter Bootstrap row tag
*/
function tb_col_shortcode ( $atts, $content ) {
	extract( shortcode_atts( array(
		'class' => "",
	), $atts ) );

	if ( empty($class)) :
		return '<div class="col">' . do_shortcode( $content ) . '</div>';
	else:
		return "<div class=\"{$class}\">" . do_shortcode( $content ) . "</div>";
	endif;
}
add_shortcode( "col", "tb_col_shortcode" );

/**
	[list-group] shortcode - creates a Twitter Bootstrap alert box
	*class - CSS classes to be added to the outer frame
*/
function list_group_shortcode ( $atts, $content ) {
	extract( shortcode_atts( array(
		'class' => ""
	), $atts ) );
	return "<div class='list-group {$class}'>" . do_shortcode($content) . "</div>";
}
add_shortcode ( "list-group", "list_group_shortcode" );

/**
	[list-item] shortcode - creates a Twitter Bootstrap alert box
	*class - CSS classes to be added to the outer frame
*/
function list_item_shortcode ( $atts, $content ) {
	extract( shortcode_atts( array(
		'url' => "#",
		'class' => ""
	), $atts ) );
	return "<a class='list-group-item {$class}' href='{$url}'>"
		. (isset($title) ? "<h4 class='list-group-item-heading'>{$title}</h4>" : "")
		. "<p class='list-group-item-text'>" . do_shortcode($content) . "</p>"
		. "</a>";
}
add_shortcode ( "list-item", "list_item_shortcode" );

/**
	[oi] shortcode - embeds an Iconic icon
	*__ - type of icon
*/
function oi_shortcode ( $atts, $content ) {

	$html = "<span class=\"oi oi-{$atts[0]}\" title=\"{$atts[0]}\" aria-hidden=\"true\"></span>";
	if (isset($atts['circle'])) {
		$html = "<span class=\"icon-circle icon-circle-{$atts['circle']}\">" . $html . "</span>";
	}
	return $html;
}
add_shortcode ( "oi", "oi_shortcode" );
add_shortcode ( "icon", "oi_shortcode" );

/**
	[socicon] shortcode - creates a Socicon icon
	*__ - type of icon
*/
function socicon_shortcode ( $atts, $content ) {

	$html = "<span class=\"socicon socicon-{$atts[0]}\" title=\"{$atts[0]}\" aria-hidden=\"true\"></span>";
	if (isset($atts['circle'])) {
		$html = "<span class=\"icon-circle icon-circle-{$atts['circle']}\">" . $html . "</span>";
	}
	return $html;
}
add_shortcode ( "socicon", "socicon_shortcode" );

/**
	[embed-responsive] shortcode - embeds a responsive iframe
	*url - type of icon
	*ratio - the width-by-height ratio of the map (default "4by3", others include "16by9", "21by9", "1by1")
*/
function embed_responsive_shortcode ( $atts, $content ) {
	extract( shortcode_atts( array(
		'url' => "#",
		'ratio' => "4by3"
	), $atts ) );

	return "<div class='embed-responsive embed-responsive-{$ratio}'><iframe class='embed-responsive-item' src='{$url}'>Sorry, this frame can't be displayed. <a href='{$url}' target='_blank'>Click here to view this item in a new tab.</a></iframe></div>";
}
add_shortcode ( "embed-responsive", "embed_responsive_shortcode" );

/**
	[img-tile] shortcode - create a 3:4 div tile with background, title and button
	*img - the image url to be used for the background
	*title - the text to be shown in the title area
	*button - the text to be shown in the button
	*url - the url for the tile to be linked to
*/
function img_tile_shortcode( $atts, $content ) {
	extract( shortcode_atts( array(
		'img' => "",
		'title' => NULL,
		'brightness' => 100,
		'url' => "#",
		'urltext' => "Learn more",
		'theme' => "primary",
		'texttheme' => "light",
	), $atts ) );

	$html = '<div class="card bg-' . $theme . ' text-' . $texttheme . '">';

	if( !empty( $title ) ) {
		$html .= '<div class="card-header"><h3 class="text-center mb-0">' . $title . '</h3></div>';
	}

	$html .= '<a href="' . $url . '"><img class="card-img-top" src="' . $img . '" style="filter: brightness(' . $brightness . '%);"></a><div class="card-body">' . $content . '<a class="card-link text-' . $texttheme . '" href="' . $url . '">' . $urltext . '</a></div></div>';

	return $html;

}
add_shortcode ( "img-tile", "img_tile_shortcode" );

/**
	Filter out <p> and <br> tags around shortcodes
*/
function shortcode_empty_paragraph_fix($content)
{
  $array = array (
      '<p>[' => '[',
      ']</p>' => ']',
      ']<br />' => ']'
  );

  $content = strtr($content, $array);

  return $content;
}
add_filter('the_content', 'shortcode_empty_paragraph_fix');
