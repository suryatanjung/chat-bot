// Function to send message to bot
function sendMessageToBot(message) {
    var chatBox = document.getElementById("chat-box");

    // Display user message
    var userMessage = document.createElement("div");
    userMessage.className = "chat-message user-message";
    userMessage.textContent = message;
    chatBox.appendChild(userMessage);

    // Display typing indicator after a short delay
    setTimeout(function() {
        var typingIndicator = document.createElement("div");
        typingIndicator.className = "chat-message bot-message bot-typing"; // Add bot-typing class here
        typingIndicator.textContent = "Typing..."; // Display typing indicator
        chatBox.appendChild(typingIndicator);

        // Scroll to bottom of chat box
        chatBox.scrollTop = chatBox.scrollHeight;
    }, 500); // Short delay before displaying typing indicator

    // Send user message to server for processing after a short delay
    setTimeout(function() {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "bot.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Remove typing indicator
                var typingIndicator = chatBox.querySelector(".bot-typing");
                if (typingIndicator) {
                    chatBox.removeChild(typingIndicator);
                }

                var botResponse = document.createElement("div");
                botResponse.className = "chat-message bot-message";
                botResponse.textContent = xhr.responseText; // Display bot response received from server
                chatBox.appendChild(botResponse);
                chatBox.scrollTop = chatBox.scrollHeight; // Scroll to bottom of chat box
            }
        };
        xhr.send("user_message=" + encodeURIComponent(message));
    }, 1000); // Short delay before sending message to simulate typing
}

// Function to send message
function sendMessage() {
    var userInput = document.getElementById("user-input").value.trim();
    if (userInput === "") return;
    sendMessageToBot(userInput);

    // Clear input form
    document.getElementById("user-input").value = "";

    // Adjust scroll position
    var chatBox = document.getElementById("chat-box");
    chatBox.scrollTop = chatBox.scrollHeight;
}

// Function to handle sending message when clicking the send button
document.getElementById("send-btn").addEventListener("click", function() {
    sendMessage(); // Send message
});

// Function to handle keyboard events in the input field
function handleKeyPress(event) {
    if (event.keyCode === 13 && !event.shiftKey) { // Enter key without Shift
        event.preventDefault(); // Prevent the default action (submitting the form)
        sendMessage(); // Send message
    }
}

// Add event listener to the input field for key press events
document.getElementById("user-input").addEventListener("keypress", handleKeyPress);
