 //
 document
 .getElementById("licenseUpload")
 .addEventListener("change", function (event) {
   handleFiles(event.target.files, "licensePreviewContainer");
 });

document
 .getElementById("certificationsUpload")
 .addEventListener("change", function (event) {
   handleFiles(event.target.files, "certificationsPreviewContainer");
 });

function handleFiles(files, containerId) {
 const container = document.getElementById(containerId);
 for (const file of files) {
   const imgContainer = document.createElement("div");
   imgContainer.classList.add("uploaded-image-container");

   const img = document.createElement("img");
   img.classList.add("uploaded-image");
   img.file = file;

   const deleteBtn = document.createElement("button");
   deleteBtn.classList.add("delete-icon-1");
   deleteBtn.innerText = "X";
   deleteBtn.addEventListener("click", function () {
     imgContainer.remove();
   });

   imgContainer.appendChild(img);
   imgContainer.appendChild(deleteBtn);
   container.appendChild(imgContainer);

   const reader = new FileReader();
   reader.onload = (function (aImg) {
     return function (e) {
       aImg.src = e.target.result;
     };
   })(img);
   reader.readAsDataURL(file);
 }
}

//
function loadProfilePhoto(event) {
 const profilePhoto = document.getElementById("profilePhoto");
 const file = event.target.files[0];
 if (file) {
   const reader = new FileReader();
   reader.onload = function (e) {
     profilePhoto.style.backgroundImage = `url(${e.target.result})`;
     profilePhoto.querySelector("label").style.display = "none";
   };
   reader.readAsDataURL(file);
 }
}


function previewImage(input, previewContainerId) {
    const previewContainer = document.getElementById(previewContainerId);
    previewContainer.innerHTML = "";

    if (input.files && input.files[0]) {
      const reader = new FileReader();

      reader.onload = function (e) {
        const imagePreview = document.createElement("div");
        imagePreview.className = "image-preview";

        const img = document.createElement("img");
        img.src = e.target.result;
        imagePreview.appendChild(img);

        const deleteIcon = document.createElement("button");
        deleteIcon.className = "delete-icon";
        deleteIcon.innerHTML = "&times;";
        deleteIcon.onclick = function () {
          previewContainer.innerHTML = "";
          input.value = ""; // Clear the input value
        };
        imagePreview.appendChild(deleteIcon);

        previewContainer.appendChild(imagePreview);
      };

      reader.readAsDataURL(input.files[0]);
    }
  }

  document.getElementById("front").addEventListener("change", function () {
    previewImage(this, "front-1");
  });

  document.getElementById("back").addEventListener("change", function () {
    previewImage(this, "back-1");
  });


