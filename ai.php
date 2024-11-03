<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Your Hugging Face API key
    $apiKey = "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"; 

    // Get user input from POST request
    $userMessage = $_POST['message'];

    // Prepare the data for the API request
    $data = [
        "messages" => [
            ["role" => "user", "content" => $userMessage]
        ],
        "model" => "google/gemma-2-2b-it",
        "max_tokens" => 500
    ];

    // Initialize cURL session
    $ch = curl_init();

    // Set the API URL and the data to be sent
    curl_setopt($ch, CURLOPT_URL, "https://api-inference.huggingface.co/models/microsoft/DialoGPT-medium");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $apiKey",
        "Content-Type: application/json"
    ]);

    // Set cURL options
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    // Execute cURL request
    $response = curl_exec($ch);
    curl_close($ch);

    // Decode the JSON response
    $responseData = json_decode($response, true);

    // Check if response is valid and contains the reply
    $reply = isset($responseData['choices'][0]['message']['content']) ? $responseData['choices'][0]['message']['content'] : 'Sorry, I could not understand that.';

    // Return the AI response
    header('Content-Type: application/json');
    echo json_encode(["reply" => $reply]);
    exit;
}
?>
