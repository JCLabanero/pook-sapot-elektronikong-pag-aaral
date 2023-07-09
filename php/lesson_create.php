<?php
session_start();
// Read the submitted form data
$lessonTitle = $_POST["lessonTitle"];
$lessonContent = $_POST["lessonContent"];

// Generate a unique ID for the lesson
$lessonId = uniqid();

// Create a new lesson XML structure
$newLesson = new SimpleXMLElement("<lesson></lesson>");
$newLesson->addChild("id", $lessonId);
$newLesson->addChild("title", $lessonTitle);
$newLesson->addChild("content", $lessonContent);

// Load the existing lessons XML file
$lessonsFile = "../xml/lessons.xml";
$xml = simplexml_load_file($lessonsFile);

// Append the new lesson to the XML
$newLessonNode = $xml->addChild("lesson");
$newLessonNode->addChild("id", $lessonId);
$newLessonNode->addChild("title", $lessonTitle);
$newLessonNode->addChild("content", $lessonContent);

// Save the updated XML file
$xml->asXML($lessonsFile);
$_SESSION["alert_message"] = "Lesson created successfully.";

echo "Lesson created successfully.";
