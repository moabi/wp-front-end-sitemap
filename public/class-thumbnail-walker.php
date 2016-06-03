<?php

/**
 * Created by PhpStorm.
 * User: LYRA NETWORK
 * Date: 23/03/2016
 * Time: 12:11
 */
class Thumbnail_walker extends Walker_page {

    public function start_el(&$output, $page, $depth = 0, $args = array(), $current_page = 0) {
        if ( $depth )
            $indent = str_repeat("\t", $depth);
        else
            $indent = '';

        extract($args, EXTR_SKIP);
        $css_class = array('fes-page_item', 'p-'.$page->ID);
        if ( !empty($current_page) ) {
            $_current_page = get_post( $current_page );
            get_post_ancestors($current_page);
            if ( isset($_current_page->ancestors) && in_array($page->ID, (array) $_current_page->ancestors) )
                $css_class[] = 'current_page_ancestor';
            if ( $page->ID == $current_page )
                $css_class[] = 'current_page_item';
            elseif ( $_current_page && $page->ID == $_current_page->post_parent )
                $css_class[] = 'current_page_parent';
        } elseif ( $page->ID == get_option('page_for_posts') ) {
            $css_class[] = 'current_page_parent';
        }
        $args_child = array(
            'post_parent' => $page->ID,
            'numberposts' => 1,
            'post_status' => 'publish'
        );
        //var_dump(get_children($args_child));
        //$childClass = ( !empty(get_children($args_child)) )? 'menu-item-has-children':'';
        $childClass = '';
        //$css_class = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );

        $pages_to_exclude = get_option('excluded_pages');
        $pages_to_exclude_arr = explode(',', $pages_to_exclude);


        //check content emptyness
        $page_fields = get_fields($page->ID);

        $is_empty_content = ($page->post_content == "" || isset($page_fields) || get_page_template_slug( $page->ID ) )? 'empty-post':'';
        // Modify Entry
        if(!in_array($page->ID,$pages_to_exclude_arr)){
            $output .= $indent . '<li class="'.$is_empty_content.' '.$childClass.' p-'.$page->ID.'"><a href="' . get_permalink($page->ID) . '">';
            $output .= get_the_title($page->ID);
            if(!empty($page->post_excerpt)){
                $output .= '<div class="fes-excerpt">'.$page->post_excerpt.'</div>';
            }
        }


        //var_dump($page);
        //$output .= get_the_post_thumbnail($page->ID, array(80,80));
        $output .= '</a>';
        //Need to display date ?
        if ( !empty($show_date) ) {
            if ( 'modified' == $show_date )
                $time = $page->post_modified;
            else
                $time = $page->post_date;

            //$output .= " " . mysql2date($date_format, $time);
        }
    }
}