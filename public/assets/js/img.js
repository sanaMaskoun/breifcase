// احصل على جميع الصور التي يمكن النقر عليها
const images = document.querySelectorAll(".clickable");

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

// وظيفة لفتح الـ modal عند النقر على الصورة
images.forEach((image) => {
  image.addEventListener("click", function () {
    modal.style.display = "block";
    modalContent.src = this.src;
  });
});

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

