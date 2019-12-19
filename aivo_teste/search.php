<?php
define("MAX_RESULTS", 10);

if (isset($_GET['keyword']) )
{
    $keyword = $_GET['keyword'];
    $apikey = 'AIzaSyDR5jWbNxESBZNHmvJfrHl5WUN0ympNh0g'; 
    $googleApiUrl = 'https://www.googleapis.com/youtube/v3/search?part=snippet&q=' . $keyword . '&maxResults=' . MAX_RESULTS . '&key=' . $apikey;

    $videos = json_decode(file_get_contents($googleApiUrl));
    $result = Array();

    foreach ($videos->items as $video) {
        array_push($result, $video->snippet);
    }

    http_response_code(200);
    echo json_encode($result);
    //echo json_decode($result);
}
else
{
    http_response_code(404);
    // tell the user no products found
    echo json_encode(array("type" => "error","message" => "Please enter the keyword."));
} 

?>