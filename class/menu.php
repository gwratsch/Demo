<?php

/**
 * Description of menu
 *
 * @author Gerd
 */
class menu {
    function menu_blok(){
        $menuPosts = array(
                    'Home'      => '/',
                    'Post'     => '/post',
                    'Author'      => '/author'
            );
        $menu_body = '';
        foreach ($menuPosts as $name => $url){
            $menu_body .= '<a href="'.$url.'">'.$name.'</a>  ';
        }
        return $menu_body;
    }
}
