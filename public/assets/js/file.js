// upload file in send request from client to translation company
function handleFileUpload() {
  const fileInput = document.getElementById("upload_document");
  const file = fileInput.files[0];
  const imagePreview = document.getElementById("image_preview");
  const filePreview = document.getElementById("file_preview");
  const fileInfo = document.getElementById("file_info");
  const fileName = document.getElementById("file_name");
  const removeButton = document.getElementById("remove_file");
  const previewContainer = document.getElementById("upload_document_preview");

  if (file) {
    const reader = new FileReader();

    reader.onload = function (e) {
      if (file.type.startsWith("image/")) {
        imagePreview.src = e.target.result;
        imagePreview.style.display = "block";
        filePreview.style.display = "none";
      } else if (file.type === "application/pdf") {
        filePreview.src = e.target.result;
        filePreview.style.display = "none";
        imagePreview.style.display = "none";
      } else {
        filePreview.style.display = "none";
        imagePreview.style.display = "none";
      }

      fileName.textContent = file.name;
      previewContainer.style.display = "block";
      removeButton.style.display = "inline";
    };

    reader.readAsDataURL(file);
  }
}

function removeFile() {
  const fileInput = document.getElementById("upload_document");
  const imagePreview = document.getElementById("image_preview");
  const filePreview = document.getElementById("file_preview");
  const fileInfo = document.getElementById("file_info");
  const fileName = document.getElementById("file_name");
  const removeButton = document.getElementById("remove_file");
  const previewContainer = document.getElementById("upload_document_preview");

  fileInput.value = "";
  imagePreview.style.display = "none";
  filePreview.style.display = "none";
  fileName.textContent = "";
  previewContainer.style.display = "none";
  removeButton.style.display = "none";
}
