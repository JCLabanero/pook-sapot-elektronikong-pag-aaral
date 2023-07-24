<?php
session_start();
$data = array(
    "id" => $_REQUEST["id"],
    "title" => $_REQUEST["title"],
    "content" => $_REQUEST["content"],
);
$fields = [];

$xmlFilePath = "../xml/lessons.xml";
$xml = new DOMDocument();
$xml->preserveWhiteSpace = false;
$xml->load($xmlFilePath);

$lessons = $xml->getElementsByTagName("lesson");
foreach ($lessons as $lesson) {
    $lessonId = $lesson->getElementsByTagName("id")->item(0)->nodeValue;
    if ($lessonId == $data["id"]) {
        if (!empty($data["title"])) {
            $lessonTitle = $lesson->getElementsByTagName("title")->item(0);
            $lessonTitle->nodeValue = $data["title"];
            $fields[] = "title";
        }
        if (!empty($data["content"])) {
            $lessonContent = $lesson->getElementsByTagName("content")->item(0);
            $lessonContent->nodeValue = $data["content"];
            $fields[] = "content";
        }
        if (empty($data["title"]) && empty($data["content"]))
            returnRequest(400, "Field(s) are missing");
        $xml->formatOutput = true;
        $xml->save($xmlFilePath);
        returnRequest(200, "Lesson updated successfully.", $fields);
    }
}
returnRequest(400, "Error not {$data["id"]} found");

function returnRequest($code, $message, $fields = [])
{
    $response = [
        "status" => $code,
        "message" => $message,
        "fields" => $fields,
    ];
    echo json_encode($response);
    exit;
}
