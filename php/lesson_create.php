<?php
session_start();
// Read the submitted form data
$lessonTitle = $_POST["lessonTitle"];
$lessonContent = $_POST["lessonContent"];

// Generate a unique ID for the lesson
$lessonId = uniqid();

// Load the existing lessons XML file
$lessonsFile = "../xml/lessons.xml";
$xml = simplexml_load_file($lessonsFile);

// Append the new lesson to the XML
$newLessonNode = $xml->addChild("lesson");
$newLessonNode->addChild("id", $lessonId);
$newLessonNode->addChild("title", $lessonTitle);
$newLessonNode->addChild("content", $lessonContent);
$newLessonNode->addChild("author", $_SESSION["id"]);
// Save the updated XML file
$xml->asXML($lessonsFile);
// Format the XML output
$dom = new DOMDocument('1.0');
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->load($lessonsFile);
$dom->save($lessonsFile);

echo "Lesson created successfully.";
$_SESSION["alert_message"] = "Lesson created successfully.";
