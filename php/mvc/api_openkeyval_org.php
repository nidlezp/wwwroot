<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=UTF-8');

    $pathInfo=(isset($_SERVER['PATH_INFO']))?$_SERVER['PATH_INFO']: '';
    $pathInfo=str_replace('/','',$pathInfo);

    switch ($pathInfo){
        case "dogpage":
            $result = "Dogs are here!";
            break;
        case "catpage":
            $result = "cats are here!";
            break;
        default:
            $result = $pathInfo;
    }

    //echo '{"result":'.json_encode($temp).'}';
    echo '{"result":'.json_encode($result).'}';
?>