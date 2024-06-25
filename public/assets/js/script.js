document.getElementById("fullscreen-button").addEventListener("click", function () {
        var chatArea = document.getElementById("chat-area");
        chatArea.classList.add("fullscreen");
        document.getElementById("fullscreen-button").style.display = "none";
        document.getElementById("exit-fullscreen-button").style.display = "block";
        chatArea.style.top = "17rem"; // Adjust the top position for fullscreen
    });

document.getElementById("exit-fullscreen-button").addEventListener("click", function () {
        var chatArea = document.getElementById("chat-area");
        chatArea.classList.remove("fullscreen");
        document.getElementById("fullscreen-button").style.display = "block";
        document.getElementById("exit-fullscreen-button").style.display = "none";
        chatArea.style.top = "0"; // Reset the top position when exiting fullscreen
    });















const chatBox = document.getElementById("chat-box_1");
const messageInput = document.getElementById("message-input_1");
const mediaInput = document.getElementById("media-input");
const sendButton = document.getElementById("send-button");
const mediaButton = document.getElementById("media-button");

function addMessage(content, isImage = false) {
    const messageElement = document.createElement("div");
    messageElement.classList.add("sender");
    if (isImage) {
        const img = document.createElement("img");
        img.src = content;
        messageElement.appendChild(img);
    } else {
        messageElement.textContent = content;
    }
    chatBox.appendChild(messageElement);
    chatBox.scrollTop = chatBox.scrollHeight;
}

sendButton.addEventListener("click", () => {
    const message = messageInput.value.trim();
    if (message !== "") {
        addMessage(message);
        messageInput.value = "";
    }
});

messageInput.addEventListener("keydown", (event) => {
    if (event.key === "Enter") {
        sendButton.click();
    }
});

mediaButton.addEventListener("click", () => {
    mediaInput.click();
});

mediaInput.addEventListener("change", () => {
    const file = mediaInput.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            addMessage(e.target.result, true);
        };
        reader.readAsDataURL(file);
    }
});
document.getElementById("send-button").addEventListener("click", function () {
    sendMessage();
});

document
    .getElementById("message-input_1")
    .addEventListener("keypress", function (e) {
        if (e.key === "Enter") {
            sendMessage();
        }
    });

function sendMessage() {
    const messageInput = document.getElementById("message-input_1");
    const message = messageInput.value.trim();

    if (message !== "") {
        addMessageToChat("sender", message);
        messageInput.value = "";

        // Simulate receiving a response after 1 second
        setTimeout(() => {
            addMessageToChat("receiver", "This is a reply from the future.");
        }, 1000);
    }
}


