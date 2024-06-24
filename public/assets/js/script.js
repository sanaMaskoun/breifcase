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

function addMessageToChat(senderType, message) {
  const chatBox = document.getElementById("chat-box_1");
  const messageDiv = document.createElement("div");
  messageDiv.classList.add("message", senderType);
  messageDiv.textContent = message;
  chatBox.appendChild(messageDiv);
  chatBox.scrollTop = chatBox.scrollHeight; // Scroll to the bottom
}

// Optionally, add some initial messages to the chat
addMessageToChat("sender", "This is a message from the sender.");
addMessageToChat("receiver", "This is a message from the receiver.");
