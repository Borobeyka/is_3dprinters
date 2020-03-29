<?php
    require_once __DIR__."/config.php";
    require_once __DIR__."/core/db.php";

    $routes = require_once __DIR__."/core/routes.php";
    $requestURL = substr($_SERVER['REQUEST_URI'], 1);
    foreach($routes as $route) {
        if(preg_match($route["path"], $requestURL, $matches)) {
            $param = "";
            $pathInfo = pathinfo($requestURL);
            if(isset($pathInfo["dirname"]) && $pathInfo["dirname"] !== "." && $pathInfo["dirname"] !== $pathInfo["filename"]) {
                $pos = strpos($pathInfo["filename"], "?");
                if($pos !== false) $param = substr($pathInfo["filename"], 0, $pos);
                else $param = $pathInfo["filename"];
            } 
            renderPage($route["template"], $route["action"], $param, $route["title"]);
            break;
        }
    }
    if(empty($matches)) renderPage("_errors", "404", "", "404 | Страница не найдена");//echo "404"; // ТУТ РЕНДЕР 404 СТРАНИЦЫ
    exit;    
    
    function dump($params = []) {
        echo "<pre>";
        var_dump($params);
        echo "</pre>";
    }

    function renderPage($template, $action, $param, $title = "") {
        global $dbLink;
        $template = __DIR__."/templates/".$template."/".$action.".php";
        $title = strlen($title) == 0 ? "Unknown title" : $title;
        if(file_exists($template)) {
            ob_start();
            require_once $template;
            $content = ob_get_clean();
            $mainTemplate = __DIR__."/templates/.main/index.php";
            if(file_exists($mainTemplate)) require_once $mainTemplate;
            else die("Error: Main template not found");
        }
        else die("Error: Template or action not found");
    }

    function loadModule($module) {
        $dir = __DIR__."/modules/".$module."/index.php";
        if(file_exists($dir)) require_once $dir;
        else die("Error: Module \"".$module."\" on path \"".$dir."\" not found");
    }


?>