<?php
header('Content-Type: application/json');
$cards = [];

// Ensure flashcards.csv exists and is readable
$filename = "flashcards.csv";
if (!file_exists($filename)) {
    die(json_encode(['error' => 'Flashcards file not found']));
}

if (($handle = fopen($filename, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        // Create a question by combining columns 0-6 
        $question = $data[0] . " - " . $data[1] . " - " . $data[2] . " - " . $data[3];
        // Create answer by combining time value and unit
        $answer = "";
        if (!empty($data[4])) {
            $answer = $data[4] . " " . $data[5];
        }
        if (!empty($data[6])) {
            $answer .= (!empty($answer) ? ", " : "") . $data[6] . " " . $data[7] . " " . $data[8];
        }
        
        if (!empty($question) && !empty($answer)) {
            $cards[] = ['question' => $question, 'answer' => $answer];
        }
    }
    fclose($handle);
} else {
    die(json_encode(['error' => 'Could not open flashcards file']));
}

echo json_encode($cards);
?>