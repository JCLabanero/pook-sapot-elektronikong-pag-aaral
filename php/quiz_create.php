<?php

$xml = new DOMDocument();
$xmlPath = "../xml/quizzes.xml";
$xml->preserveWhiteSpace = false;
$xml->load($xmlPath);

$data = array(
    "question" => $_REQUEST["question"],
    "answer" => $_REQUEST["answer"],
);

$quiz = $xml->createElement("quiz");
$answers = $xml->createElement("answers");
$quiz->appendChild($xml->createElement("question", $data["question"]));
$quiz->appendChild($answers);

$answers->appendChild($xml->createElement("ra", $data["answer"][0]));
$index = 0;
foreach ($data["answer"] as $answers) {
    if ($index == 0) continue;
    $answers->appendChild($xml->createElement("wa"), $data["answer"]);
}
