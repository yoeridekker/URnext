<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Custom walker class.
 */

class MegaDrop_Walker_Nav_Menu extends Walker_Nav_Menu {
 
    public $top_level_loops = array();
    public $menu_rows       = array();
    public $max_items       = 4;
    public $width_result    = 100;

    private function set_list_item_row( $id ){
        $row = ceil( count( $this->top_level_loops[$id] ) / $this->max_items );
        $this->menu_rows[$row][$id][] = $this->set_list_item_width($row, $id );
        return $row;
    }

    private function set_list_item_width( $row, $id ){
        return (float) isset( $this->menu_rows[$row][$id] ) ? ( 100 / ( count( $this->menu_rows[$row][$id]) + 1 ) ) : 100 ;
    }

    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $classes = array(
            'transition06 sub-menu menu-text-color',
            ( $depth === 0 ? 'top-border bg-menu-color' : '' ),
        );
        $class_names = esc_attr( implode(' ', apply_filters( 'nav_menu_css_class', $classes ) ) );
        $output.= '<div class="' . $class_names . '"><div class="container no-padding"><ul class="row no-margin">';
    }

    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= '<li class="clear"></li></ul></div></div>';
    }

    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $classes        = empty( $item->classes ) ? array() : (array) $item->classes;
        $active         = array_intersect( array('current-menu-item','current-menu-ancestor'), $classes );
        $depth_classes  = array(
            'transition06',
            ( $depth === 0 && !empty($active) ? 'border-primary-color' : '' ),
            ( $depth > 1 ? 'subitems' : '' ),
            ( $depth === 1 ? 'megadrop-item padded-top-bottom border-menu-color bold menu-border' : '' )
        );
        
        $all_classes    = array_merge( $classes, $depth_classes );
        $class_names    = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $all_classes ), $item ) ) );
        
        if( $depth === 1 ){
            $this->top_level_loops[$item->menu_item_parent][] = $item->ID;
            $row = $this->set_list_item_row( $item->menu_item_parent );
            $output.= sprintf(
                '<li data-row="%s" data-parent="%s" style="width:%s%s" id="nav-menu-item-%s" class="%s">',
                $row,
                $item->menu_item_parent, 
                end($this->menu_rows[$row][$item->menu_item_parent]), 
                '%', 
                $item->ID,
                $class_names
            );
        }else{
            $output.= sprintf('<li id="nav-menu-item-%s" class="%s"><div class="positioner"></div>', $item->ID, $class_names );
        }
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $attributes .= ' class="font-size menu-text-color"';
        $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
            $args->before,
            $attributes,
            $args->link_before,
            apply_filters( 'the_title', $item->title, $item->ID ),
            $args->link_after,
            $args->after
        );
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

    public function end_el( &$output, $item, $depth = 0, $args = array() ) {
        if( $depth === 1 ){
            foreach( $this->menu_rows as $row => $parents ){
                foreach( $parents as $parent => $widths ){
                    $this->width_result = end($this->menu_rows[$row][$parent]);
                    foreach( $widths as $width ){
                        $output = str_replace( 
                            'data-row="'.$row.'" data-parent="'.$parent.'" style="width:'.$width.'%"', 
                            'data-row="'.$row.'" data-parent="'.$parent.'" style="width:'.$this->width_result.'%"', 
                            $output
                        );
                    }
                }
            }
        }
        $output .= '</li>';
    }
}