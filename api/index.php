<?php

function serveStaticFile($resourcePath)
{
    if (file_exists($resourcePath)) {
        http_response_code("200");
        $extension = pathinfo($resourcePath, PATHINFO_EXTENSION);
        if ($extension === "svg") {
            // Text based
            header("Content-type: image/svg+xml");
            echo file_get_contents($resourcePath);
        } else {
            // Binary based
            $mimeContentType = mime_content_type($resourcePath);
            if ($mimeContentType !== false) {
                header("Content-type: $mimeContentType");
            }
            $fp = fopen($resourcePath, 'rb');
            fpassthru($fp);
        }
        exit;
    } else {
        http_response_code("404");
        echo "This file does not exist";
    }
}

$scriptFileName = $_SERVER["SCRIPT_NAME"];

$firstDirectory = "";
$fileParts = explode('/', $scriptFileName);
/** The first element should be blank */
if (sizeof($fileParts) >= 2) {
    $firstDirectory = $fileParts[1];
}
switch ($firstDirectory) {
    case "resources":
        $resourcePath = __DIR__ . "/../" . $scriptFileName;
        serveStaticFile($resourcePath);
        break;
    case "favicon.ico":
        $resourcePath = __DIR__ . "/../resources/favicon.ico";
        serveStaticFile($resourcePath);
        break;
    default:
        http_response_code("503");
        echo file_get_contents(__DIR__ . "/../html/service-unavailable.html");
}


