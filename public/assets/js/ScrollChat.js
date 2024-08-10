document.addEventListener("DOMContentLoaded", function () {
    const chatDiv = document.getElementById("chat_div");

    if (chatDiv) {
        chatDiv.scrollTop = chatDiv.scrollHeight;
    }
});
