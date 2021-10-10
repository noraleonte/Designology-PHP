document.querySelectorAll(".drop-zone__input").forEach(inputElement => { //selects all the elements with the provided selector
    const dropZoneElement = inputElement.closest(".drop-zone"); //closest parent that matches the provided selector

    dropZoneElement.addEventListener("click", e => {
        console.log(inputElement);
        inputElement.click();
    });

    inputElement.addEventListener("change", e => {
        if (inputElement.files.length) {
            console.log(inputElement.files[0]);
            updateThumbnail(dropZoneElement, inputElement.files[0]);
            if (dropZoneElement.classList.contains('cover')) {
                const CoverSubmit = document.querySelector(".cover_submit");
                CoverSubmit.click();
            }
        }

    });

    dropZoneElement.addEventListener("dragover", e => {
        e.preventDefault();
        dropZoneElement.classList.add("drop-zone--over");
    });

    let event = ["dragleave", "dragend"];
    event.forEach(type => {
        dropZoneElement.addEventListener(type, e => {
            dropZoneElement.classList.remove("drop-zone--over");
        });
    });

    dropZoneElement.addEventListener("drop", e => {
        e.preventDefault();

        if (e.dataTransfer.files.length) {
            inputElement.files = e.dataTransfer.files;
            updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
        }
        dropZoneElement.classList.remove("drop-zone--over");
    });
});

function updateThumbnail(dropZoneElement, file) {
    let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");
    if (dropZoneElement.querySelector(".prompt")) {
        dropZoneElement.querySelector(".prompt").remove();
    }

    if (!thumbnailElement) {
        thumbnailElement = document.createElement("div");
        thumbnailElement.classList.add("drop-zone__thumb");
        dropZoneElement.appendChild(thumbnailElement);
    }

    thumbnailElement.dataset.label = file.name;

    if (file.type.startsWith("image/")) {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => {
            thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
        }
    } else {
        thumbnailElement.style.backgroundImage = null;
    }


}