<?php

$scriptFileName = $_SERVER["SCRIPT_NAME"];

$firstDirectory = "";
$fileParts = explode('/', $scriptFileName);
/** The first element should be blank */
if(sizeof($fileParts)>=2){
    $firstDirectory = $fileParts[1];
}
switch ($firstDirectory) {
    case "resources":
        $resourcePath = __DIR__ . "/../".$scriptFileName;
        if(file_exists($resourcePath)){
            http_response_code("200");
            header("Content-type: image/svg+xml");
            $fp = fopen($resourcePath, 'rb');
            fpassthru($fp);
            exit;
        } else {
            http_response_code("404");
            echo "This file does not exist";
        }
        break;
    default:
        http_response_code("503");
        echo file_get_contents(__DIR__ . "/../html/service-unavailable.html");
}


