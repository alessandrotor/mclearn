<?php
header('Content-Type: application/json');

$cards = [];
if (($handle = fopen("flashcards.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle)) !== FALSE) {
        if (count($data) >= 2) {
            $cards[] = [
                "question" => $data[0],
                "answer" => $data[1]
            ];
        }
    }
    fclose($handle);
}

echo json_encode($cards);
?>