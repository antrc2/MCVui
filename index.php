<?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    session_start();
    ob_start();
    require_once "commons/function.php";

    require_once "controllers/accountController.php";
    require_once "controllers/errorController.php";
    require_once "controllers/homeController.php";
    require_once "controllers/donateController.php";
    require_once "controllers/dashboardController.php";
    require_once "controllers/exchangeController.php";

    require_once "models/accountModel.php";
    require_once "models/errorModel.php";
    require_once "models/homeModel.php";
    require_once "models/donateModel.php";
    require_once "models/dashboardModel.php";
    require_once "models/exchangeModel.php";

    $home = new homeController;
    $error = new errorController;
    $acc = new accountController;
    $donate = new donateController;
    $dashboard = new dashboardController;
    $exchange = new exchangeController;

    // Lấy uri và kiểm tra xem khóa 'path' có tồn tại không
    $parsedUrl = parse_url($_SERVER['REQUEST_URI']);
    $uri = isset($parsedUrl['path']) ? trim($parsedUrl['path'], "/") : "/";
    $uri = $uri === "" ? "/" : $uri; 

    if ($uri === "/") {
        $home->home();
    } elseif ($uri === "login") {
        $acc->login();
    } elseif ($uri === "register") {
        $acc->register();
    } elseif ($uri === "logout") {
        $acc->logout();
    } elseif ($uri === "donate") {
        $donate->donate();
    } elseif ($uri === "dashboard") {
        $dashboard->dashboard();
    } elseif ($uri === "donate-history") {
        $donate->donateHistory();
    } elseif ($uri === "account") {
        $acc->account();
    } elseif ($uri === "update-account") {
        $acc->updateAccount($_GET['username']);
    } elseif ($uri === "delete-account") {
        $acc->deleteAccount($_GET['username']);
    } elseif ($uri === "exchange-history") {
        $exchange->exchangeHistory();
    } elseif ($uri === "profile") {
        $acc->profile();
    } elseif ($uri === "list-event") {
        $donate->listEvent();
    } elseif ($uri === "add-event") {
        $donate->addEvent();
    } elseif ($uri === "update-event") {
        $donate->updateEvent($_GET['id']);
    } elseif ($uri === "delete-event") {
        $donate->deleteEvent($_GET['id']);
    } elseif ($uri === "chuyenxu") {
        $exchange->exchange();
    } elseif ($uri === "change-password") {
        $acc->changePassword();
    } elseif ($uri === "add-donate-history") {
        $donate->addDonateHistory();
    } elseif ($uri === "servers") {
        $exchange->listServer();
    } elseif ($uri === "add-server") {
        $exchange->addServer();
    } elseif ($uri === "update-server") {
        $exchange->updateServer($_GET['id']);
    } elseif ($uri === "delete-server") {
        $exchange->deleteServer($_GET['id']);
    } elseif ($uri === "discord"){
        $home->discord();
    }
    elseif ($uri === 'forbidden') {
        $error->forbidden();
    } else {
        $error->notFound();
    }
?>