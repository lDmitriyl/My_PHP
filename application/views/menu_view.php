<?php
$menu = [
    ['href' => '/home/index', 'anchor' => 'Домой'],
    ['href' => '/table/index', 'anchor' => 'Таблица'],
    ['href' => '/insta/index', 'anchor' => 'Инстаграмм'],
    ['href' => '/shop/index', 'anchor' => 'Товары'],
];
function drawMenu($menu, $vertical=false)
{
    $ulClass = 'navbar-nav mr-auto';
    $liClass = 'nav-item';
    $html = '';
    if($vertical){
        $ulClass = 'list-group';
        $liClass = 'list-group-item';
    }

    $html .= "<ul class=\"$ulClass\">";
    foreach ($menu as $menuItem) {
        $html .= "<li class=\"$liClass\">";
        $html .= "<a class=\"nav-link\" href=\"{$menuItem['href']}\">{$menuItem['anchor']}</a>";
        $html .= "</li>";
    }
    $html .= "</ul>";

    return $html;
}