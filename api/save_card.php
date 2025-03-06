<?php
$question = $_POST['question'];
$answer = $_POST['answer'];
$file = fopen('flashcards.csv', 'a');
fputcsv($file, array($question, $answer));
fclose($file);
?>