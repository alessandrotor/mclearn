<?php
header('Content-Type: application/json');

if (isset($_POST['question']) && isset($_POST['answer'])) {
    $question = str_replace('"', '""', $_POST['question']);
    $answer = str_replace('"', '""', $_POST['answer']);
    
    $newLine = "\n\"$question\",\"$answer\"";
    
    if (file_put_contents("flashcards.csv", $newLine, FILE_APPEND) !== false) {
        echo json_encode(["success" => true]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to save to file"]);
    }
} else {
    http_response_code(400);
    echo json_encode(["error" => "Missing question or answer"]);
}
?>