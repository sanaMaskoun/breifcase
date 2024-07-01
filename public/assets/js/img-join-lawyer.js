function previewImage(input, previewContainer) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        var img = document.createElement("img");
        img.src = e.target.result;
        previewContainer.innerHTML = "";
        previewContainer.appendChild(img);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }

  document.getElementById("front").addEventListener("change", function () {
    previewImage(this, document.getElementById("front-1"));
  });

  document.getElementById("back").addEventListener("change", function () {
    previewImage(this, document.getElementById("back-1"));
  });

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
      const img = document.createElement("img");
      img.classList.add("uploaded-image");
      img.file = file;

      const reader = new FileReader();
      reader.onload = (function (aImg) {
        return function (e) {
          aImg.src = e.target.result;
          container.appendChild(aImg); // أضف الصورة بعد تعيين src
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
