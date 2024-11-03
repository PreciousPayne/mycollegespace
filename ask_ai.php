<!-- ask_ai.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Chat</title>
    <link rel="stylesheet" href="css/ask_ai.css">
</head>
<body>
    <div id="chatBox" class="chat-box">
        <div class="ai-message">Hello! Ask me anything.</div>
    </div>
    <input type="text" id="userInput" placeholder="Type your message here...">
    <button id="sendBtn">Send</button>
    <button id="back-home" onclick="location.href='welcome.php'">Back to Home Page</button>
    <script>
        const chatBox = document.getElementById("chatBox");
        const userInput = document.getElementById("userInput");
        const sendBtn = document.getElementById("sendBtn");

        sendBtn.addEventListener("click", async () => {
            const userMessage = userInput.value.trim();
            if (!userMessage) return;

            chatBox.innerHTML += `<div class="user-message">${userMessage}</div>`;
            userInput.value = ""; 
            chatBox.scrollTop = chatBox.scrollHeight;

            try {
                const response = await fetch("chat.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: `message=${encodeURIComponent(userMessage)}`
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                const data = await response.json();
                chatBox.innerHTML += `<div class="ai-message">${data.reply}</div>`;
                chatBox.scrollTop = chatBox.scrollHeight;
            } catch (error) {
                console.error("Error fetching AI response:", error);
                chatBox.innerHTML += `<div class="ai-message">Sorry, something went wrong! (${error.message})</div>`;
            }
        });
    </script>
</body>
</html>
