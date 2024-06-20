

const chatBox = document.getElementById("chat-box_1");
const messageInput = document.getElementById("message-input_1");
const mediaInput = document.getElementById("media-input");
const sendButton = document.getElementById("send-button");
const mediaButton = document.getElementById("media-button");

function addMessage(content, isImage = false) {
  const messageElement = document.createElement("div");
  messageElement.classList.add("message_1");
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
