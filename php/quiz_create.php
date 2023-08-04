<?php

$xml = new DOMDocument();
$xmlPath = "../xml/quizzes.xml";
$xml->preserveWhiteSpace = false;
$xml->load($xmlPath);

if (!file_exists($xmlPath) || !$xml->load($xmlPath)) {
    returnRequest(500, "Failed to load XML file.");
    exit; // Terminate the script execution
}

$data = array(
    "lid" => $_REQUEST["lid"],
    "question" => $_REQUEST["question"],
    "answers" => $_REQUEST["answers"],
);


$quiz = $xml->createElement("quiz");
$answers = $xml->createElement("answers");
$quiz->appendChild($xml->createElement("id", uniqid()));
$quiz->appendChild($xml->createElement("lid", $data["lid"]));
$quiz->appendChild($xml->createElement("question", $data["question"]));
$quiz->appendChild($answers);
// echo $data["answers"][0];
foreach ($data["answers"] as $index => $answer) {
    if ($index == 0) {
        $answers->appendChild($xml->createElement("ra", $answer));
        continue;
    }
    $answers->appendChild($xml->createElement("wa", $answer));
}
$xml->documentElement->appendChild($quiz);
$xml->formatOutput = true;
if (!$xml->save($xmlPath)) {
    returnRequest(500, "Failed to save XML file.");
    exit; // Terminate the script execution
}
returnRequest(200, "Success");

function returnRequest($code, $message)
{
    $response = [
        "status" => $code,
        "message" => $message,
    ];
    echo json_encode($response);
}
