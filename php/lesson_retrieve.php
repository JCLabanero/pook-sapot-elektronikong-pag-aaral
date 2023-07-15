<?php
$xml = new DOMDocument();
$xml->load("../xml/lessons.xml");

$lessons = $xml->getElementsByTagName("lesson");
