<?php
// chat.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$apiKey = "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"; // Your Hugging Face API key
$apiUrl = "https://api-inference.huggingface.co/models/google/gemma-2-2b-it"; // The model endpoint

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $message = $_POST['message'] ?? '';
    if (empty($message)) {
        echo json_encode(["reply" => "Please provide a message."]);
        exit;
    }

    // Prepare the POST data
    $postData = [
        "inputs" => $message,
        "parameters" => [
            "max_tokens" => 500
        ]
    ];

    // Initialize cURL
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $apiKey",
        "Content-Type: application/json"
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));

    // Execute the cURL request
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo json_encode(["reply" => "Error: " . curl_error($ch)]);
        curl_close($ch);
        exit;
    }

    curl_close($ch);

    // Decode the response
    $responseData = json_decode($response, true);

    // Extract the AI's reply
    $aiReply = $responseData[0]['generated_text'] ?? "I'm sorry, I didn't understand that.";

    echo json_encode(["reply" => $aiReply]);
}
