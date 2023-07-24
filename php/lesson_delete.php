<?php
$lessonId = $_REQUEST['id'];

$xmlFilePath = "../xml/lessons.xml";

$doc = new DOMDocument();
$doc->load($xmlFilePath);

$lessons = $doc->getElementsByTagName("lesson");
foreach ($lessons as $lesson) {
    $title = $lesson->getElementsByTagName("title")->item(0)->nodeValue;
    $id = $lesson->getElementsByTagName("id")->item(0)->nodeValue;
    if (strcmp($lessonId, $id) == 0) {
        $lesson->parentNode->removeChild($lesson);
        $doc->save($xmlFilePath); // Save the changes to the XML file
        returnRequest(200, $title . " deleted successfully. ");
    }
}

returnRequest(404, $lessonId . " Lesson not found.");

function returnRequest($code, $message)
{
    $response = [
        "status" => $code,
        "message" => $message
    ];
    echo json_encode($response);
    exit;
}
