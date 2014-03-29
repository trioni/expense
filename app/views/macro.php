<?php

HTML::macro('menu_active', function($route, $text) {
    if( Request::path() == $route ) {
        $active = "class = 'active'";
    }
    else {
        $active = '';
    }

    return '<li ' . $active . '>' . link_to($route, $text) . '</li>';
});

HTML::macro('filter_active', function($route, $text, $key = null, $value = '') {
    $is_active = false;

    if($key != null) {
        $qv = Request::query($key);
        if($qv == $value) {
            $is_active = true;
        }
    } else {
        $query = Request::query();
        $is_active = empty($query);
    }
    $attr = array(
        'class'=> 'btn btn-default'
    );
    if($is_active) {
        $attr['class'] .= ' active';
    }
    return link_to($route, $text, $attr);
});

HTML::macro('color_by_option', function($option) {
    $class = '';
    switch($option)
    {
        case 'mat':
            $class = ' label-primary';
            break;
        case 'restaurang':
            $class = ' label-success';
            break;
        case 'bar':
            $class = ' label-info';
            break;
        case 'hem':
            $class = ' label-warning';
            break;
        case 'resa':
            $class = ' label-danger';
            break;
        case 'övrigt':
            $class = ' label-default';
            break;
    }

    return $class;
});

HTML::macro('summary_col_size', function( $numUsers ) {
    $size;
    switch( $numUsers )
    {
        case 2:
            $size = 6;
            break;
        case 3:
            $size = 4;
            break;
        default:
            $size = 3;
    }
    return $size;
});
