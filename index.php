<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Bot</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="chat-container">
        <div class="chat-header">
            <div class="avatar-container">
                <img src="https://e7.pngegg.com/pngimages/498/917/png-clipart-computer-icons-desktop-chatbot-icon-blue-angle-thumbnail.png" class="avatar" alt="Avatar">
            </div>
            <div class="bot-info">
                <div class="bot-name">Chat Bot</div>
            </div>
            <div class="dropdown">
                <button class="dropbtn">☰</button>
                <div class="dropdown-content">
                    <a href="#">Option 1</a>
                    <a href="#">Option 2</a>
                    <a href="#">Option 3</a>
                </div>
            </div>
        </div>
        <div class="chat-box" id="chat-box">
            <!-- Chat messages will be displayed here -->
        </div>
        <div class="input-container">
            <input type="text" id="user-input" placeholder="Type a message...">
            <button id="send-btn">Send</button>
            <div class="typing-indicator" id="typing-indicator" style="display: none;">Typing...</div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>