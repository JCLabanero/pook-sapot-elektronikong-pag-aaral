<?php
session_start();
// Read the submitted form data
$data = array(
    "title" => $_REQUEST["title"],
    "content" => $_REQUEST["content"],
    "videoLink" => isset($_REQUEST["videoLink"]) ? $_REQUEST["videoLink"] : null,
);
if (empty($data["title"]) || empty($data["content"]))
    returnRequest(400, "Fields are required for lesson");
if (isset($_FILES["pdfSource"])) {
    // File handling
    $uploadedFile = $_FILES["pdfSource"]["tmp_name"];
    $targetDir = "../files/"; // Change this directory to your desired location

    if (!empty($uploadedFile)) {
        $targetFile = $targetDir . basename($_FILES["pdfSource"]["name"]);
        if (move_uploaded_file($uploadedFile, $targetFile)) {
            // File uploaded successfully, store the file path in the data array
            $data["pdfSource"] = $targetFile;
        } else {
            returnRequest(400, "Failed to upload PDF file");
        }
    }
}

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
if (!empty($data["videoLink"]))
    $newLessonNode->addChild("videoLink", $data["videoLink"]);
if (!empty($data["pdfSource"]))
    $newLessonNode->addChild("pdfSource", $data["pdfSource"]);
$newLessonNode->addChild("author", $_SESSION["id"]);

// Save the updated XML file
$xml->asXML($lessonsFile);

returnRequest(200, "Created {$data['title']} Lesson Successfully");

function returnRequest($code, $message)
{
    $response = [
        "status" => $code,
        "message" => $message,
    ];
    // header("Content-Type: application/json");
    echo json_encode($response);
    exit;
}
