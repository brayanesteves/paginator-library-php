<?php
    require_once 'application/Config.php';
    require_once 'application/Database.php';
    require_once 'application/Paginator.php';

    $paginator = new Paginator();
    if(isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = false;
    }
    $users = $paginator->paginate("SELECT * FROM `0_Usrs`", $page);
    $params = $paginator->getPagination();

    require_once 'views/index/index.phtml';

    
?>
