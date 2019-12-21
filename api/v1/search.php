<?php

define("MAX_RESULTS", 10);
//API google Client 
$DEVELOPER_KEY = "AIzaSyDR5jWbNxESBZNHmvJfrHl5WUN0ympNh0g";

    if (isset($_GET['keyword']) )
    {
        $keyword = $_GET['keyword'];
        $apikey = $DEVELOPER_KEY; 
        $googleApiUrl = 'https://www.googleapis.com/youtube/v3/search?part=snippet&q=' . $keyword . '&maxResults=' . MAX_RESULTS . '&key=' . $apikey;
        $videos = json_decode(file_get_contents($googleApiUrl));
        $result = Array();
        
        foreach ($videos->items as $video) {
            array_push($result, $video->snippet);
        }
        http_response_code(200);
        header("Content-type:application-json");
        echo json_encode($result);
}
    else if(isset($_GET['keyword'])==NULL)
    {   
        header("Content-type:application-json");
        http_response_code(404);
        // tell the user no products found
        echo json_encode(array("type" => "error","message" => "Please enter the keyword."));
    }
    else
    {
        header("Content-type:application-json");
        http_response_code(502);
        // tell the user no products found
        echo json_encode(array("type" => "error","message" => "Bad."));
    }
?>