<?php
session_start();
// Read the submitted form data
$data = array(
    "title" => $_POST["title"],
    "content" => $_POST["content"],
);

if (empty($data["title"]) || empty($data["content"]))
    returnRequest(400, "Create lesson failed");

// Generate a unique ID for the lesson
$lessonId = uniqid();

// Load the existing lessons XML file
$lessonsFile = "../xml/lessons.xml";
$xml = simplexml_load_file($lessonsFile);

// Append the new lesson to the XML
$newLessonNode = $xml->addChild("lesson");
$newLessonNode->addChild("id", $lessonId);
$newLessonNode->addChild("title", $data["title"]);
$newLessonNode->addChild("content", $data["content"]);
$newLessonNode->addChild("author", $_SESSION["id"]);
// Save the updated XML file
$xml->asXML($lessonsFile);
// Format the XML output
$dom = new DOMDocument('1.0');
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->load($lessonsFile);
$dom->save($lessonsFile);

returnRequest(200, "Created {$data['title']} Lesson Successfully");

function returnRequest($code, $message)
{
    $response = [
        "status" => $code,
        "message" => $message,
    ];
    echo json_encode($response);
    exit;
}
