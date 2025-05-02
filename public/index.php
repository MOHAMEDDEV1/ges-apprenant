<?php
session_start();
require_once __DIR__ ."/../app/route/route.web.php";
// require_once __DIR__ ."/../app/views/apprenant/detail.absence.apprenant.php";
use function App\Route\render_menu;


render_menu();
