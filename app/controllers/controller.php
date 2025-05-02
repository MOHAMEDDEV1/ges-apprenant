<?php
// controller.php
namespace App\Controllers\BaseControllers;

require_once __DIR__ . '/../services/session.service.php';
require_once __DIR__ .'/../services/validator.service.php';
require_once __DIR__ .'/error.controller.php';
require_once __DIR__ .'/../controllers/promotion/promotion.controller.php';



function runder_view(string $layout, string $view, array $data = []):void {
    extract($data);
    require_once __DIR__ . "/../views/layout/$layout";
    require_once __DIR__ . "/../views/$view";
}

function runder_single_views(string $view, array $data = []):void {
    extract($data);
    require_once __DIR__ . "/../views/$view";
}


function redirect_to(string $url) {
    header("Location: $url");
    exit;
}

function paginate(array $items, int $page_actuelle = 1, int $par_page = 10, array $params = []): array {
    $total_items = count($items);
    $total_pages = max(1, ceil($total_items / $par_page));
    
    $page_actuelle = max(1, min($total_pages, $page_actuelle));
    $start_index = ($page_actuelle - 1) * $par_page;
    
    $url_params = '';
    foreach ($params as $key => $value) {
        if (!empty($value) && $key !== 'page') {
            $url_params .= '&' . urlencode($key) . '=' . urlencode($value);
        }
    }

    $pagination = [
        'page_actuelle' => $page_actuelle,
        'total_pages' => $total_pages,
        'precedente' => $page_actuelle > 1 ? $page_actuelle - 1 : null,
        'suivante' => $page_actuelle < $total_pages ? $page_actuelle + 1 : null,
        'pages' => range(1, $total_pages),
        'start' => $start_index + 1,
        'end' => min($start_index + $par_page, $total_items),
        'total' => $total_items,
        'par_page' => $par_page,
        'url_params' => $url_params 
    ];

    return [
        'pagination' => $pagination,
        'data' => array_slice($items, $start_index, $par_page),
    ];
}

