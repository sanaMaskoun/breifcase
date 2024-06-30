// إنشاء عنصر الـ modal
const modal = document.createElement("div");
modal.classList.add("modal");
document.body.appendChild(modal);

// إنشاء محتوى الـ modal
const modalContent = document.createElement("img");
modalContent.classList.add("modal-content");
modal.appendChild(modalContent);

// إنشاء زر الإغلاق
const closeBtn = document.createElement("span");
closeBtn.classList.add("close");
closeBtn.innerHTML = "&times;";
modal.appendChild(closeBtn);

// وظيفة لإغلاق الـ modal عند النقر على زر الإغلاق
closeBtn.addEventListener("click", function () {
  modal.style.display = "none";
});

// وظيفة لإغلاق الـ modal عند النقر في أي مكان خارج الصورة
modal.addEventListener("click", function (event) {
  if (event.target === modal) {
    modal.style.display = "none";
  }
});

// وظيفة لفتح الـ modal عند النقر على الصورة
function addModalFunctionality(image) {
  image.addEventListener("click", function () {
    modal.style.display = "block";
    modalContent.src = this.src;
  });
}

// احصل على جميع الصور التي يمكن النقر عليها في البداية
const images = document.querySelectorAll(".clickable");
images.forEach(addModalFunctionality);



// img input
document.querySelectorAll(".custom-file-input").forEach((inputElement) => {
    inputElement.addEventListener("change", function (event) {
      const previewId = this.id === "front_emirates_id" ? "upload_front_preview" : "upload_back_preview";
      const imagePreview = document.getElementById(previewId);
      imagePreview.innerHTML = ""; // Clear any existing images

      Array.from(event.target.files).forEach((file) => {
        if (file) {
          const reader = new FileReader();
          reader.onload = function (e) {
            const img = document.createElement("img");
            img.src = e.target.result;
            img.style.maxWidth = "100%";
            img.style.height = "auto";
            img.style.marginTop = "10px";
            imagePreview.appendChild(img);
          };
          reader.readAsDataURL(file);
        }
      });
    });
  });

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
  container.innerHTML = ""; // Clear previous images

  Array.from(files).forEach((file) => {
    if (file.type.startsWith("image/")) {
      const img = document.createElement("img");
      img.src = URL.createObjectURL(file);
      container.appendChild(img);
    }
  });
}

//

document
  .getElementById("licenseUpload")
  .addEventListener("change", function () {
    previewImages(this, "licensePreviewContainer");
  });

document
  .getElementById("certificationsUpload")
  .addEventListener("change", function () {
    previewImages(this, "certificationsPreviewContainer");
  });

function previewImage(input, previewContainer) {
  const files = input.files;
  if (files && files[0]) {
    const reader = new FileReader();
    reader.onload = function (e) {
      const img = document.createElement("img");
      img.src = e.target.result;
      previewContainer.innerHTML = "";
      previewContainer.appendChild(img);
    };
    reader.readAsDataURL(files[0]);
  }
}

document
  .getElementById("licenseUploadFront")
  .addEventListener("change", function () {
    previewImage(this, document.getElementById("licensePreviewContainerFront"));
  });

document
  .getElementById("licenseUploadBack")
  .addEventListener("change", function () {
    previewImage(this, document.getElementById("licensePreviewContainerBack"));
  });
