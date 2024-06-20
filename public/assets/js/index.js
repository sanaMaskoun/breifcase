

// تغير اللغة
document.addEventListener("DOMContentLoaded", function () {
  function simulateApiCall() {
    return new Promise((resolve) => {
      setTimeout(() => {
        // هنا يمكن تغيير اللغة التي يتم تلقيها من API
        const newLanguage = "en"; // أو 'en' لتغيير اللغة الإنجليزية
        resolve(newLanguage);
      }, 1000); // محاكاة تأخير API
    });
  }

  // وظيفة لتحديث اتجاه الصفحة بناءً على اللغة
  function updateLanguageDirection(language) {
    if (language === "ar") {
      document.body.setAttribute("dir", "rtl");
      document.documentElement.setAttribute("lang", "ar");
    } else {
      document.body.setAttribute("dir", "ltr");
      document.documentElement.setAttribute("lang", "en");
    }
  }

  // استدعاء API وتحديث الاتجاه بناءً على اللغة المستلمة
  simulateApiCall().then((newLanguage) => {
    updateLanguageDirection(newLanguage);
  });
});
//

//chat
function openChat(contact) {
  document.getElementById("chat-with").innerText = "Chat with " + contact;
  document.getElementById("chat-body").innerHTML = ""; // Clear previous messages
  document.getElementById("chat-window").classList.remove("d-none");
}

function sendMessage() {
  const messageInput = document.getElementById("message-input");
  const message = messageInput.value.trim();

  if (message) {
    const chatBody = document.getElementById("chat-body");
    const messageElement = document.createElement("div");
    messageElement.classList.add("chat-message", "sent");
    messageElement.innerHTML = `<span>${message}</span>`;
    chatBody.appendChild(messageElement);
    messageInput.value = "";
    chatBody.scrollTop = chatBody.scrollHeight;
  }
}

document
  .getElementById("file-input")
  .addEventListener("change", function (event) {
    const file = event.target.files[0];
    if (file) {
      const chatBody = document.getElementById("chat-body");
      const messageElement = document.createElement("div");
      messageElement.classList.add("chat-message", "sent");
      messageElement.innerHTML = `<span>File: ${file.name}</span>`;
      chatBody.appendChild(messageElement);
      chatBody.scrollTop = chatBody.scrollHeight;
    }
  });

function recordAudio() {
  // This function should handle audio recording logic
  // For now, we'll just simulate an audio message
  const chatBody = document.getElementById("chat-body");
  const messageElement = document.createElement("div");
  messageElement.classList.add("chat-message", "sent");
  messageElement.innerHTML = `<span>Audio message (simulated)</span>`;
  chatBody.appendChild(messageElement);
  chatBody.scrollTop = chatBody.scrollHeight;
}
