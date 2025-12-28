const addMediaBtn = document.getElementById('addMediaBtn');
const mediaPreview = document.getElementById('mediaPreview');
const imagePlaceholder = document.getElementById('image_placeholder');
const inputPath = document.querySelector("#fileInput");

let file;

function toggleBrowse() {
    inputPath.click();
}

function removeMedia() {
    // Remove existing preview
    mediaPreview.innerHTML = `
        <div class="empty-state">
            <i>🖼️</i>
            <p>No media added yet</p>
        </div>
    `;
}

inputPath.addEventListener("change", function() {
    file = this.files[0];
    previewMedia();
});

function previewMedia() {
    let fileType = file.type;
    let validExtensions = ["image/jpeg", "image/jpg", "image/png", "image/gif", "video/mp4", "video/mov", "video/quicktime"];

    if (!validExtensions.includes(fileType)) {
        alert("Invalid file type. Please select an image or video file.");
        return;
    }

    let reader = new FileReader();
    reader.onload = () => {
        let fileURL = reader.result;
        
        // Clear previous preview
        mediaPreview.innerHTML = '';

        if (fileType.startsWith('image/')) {
            // Create image preview
            const img = document.createElement('img');
            img.src = fileURL;
            img.className = 'media-item';
            mediaPreview.appendChild(img);
        } else if (fileType.startsWith('video/')) {
            // Create video preview
            const video = document.createElement('video');
            video.src = fileURL;
            video.className = 'media-item';
            video.controls = true;
            video.autoplay = false;
            mediaPreview.appendChild(video);
        }
    };
    reader.readAsDataURL(file);
}

// Add drag and drop functionality
const dropZone = document.getElementById('dropZone');

dropZone.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropZone.classList.add('active');
});

dropZone.addEventListener('dragleave', () => {
    dropZone.classList.remove('active');
});

dropZone.addEventListener('drop', (e) => {
    e.preventDefault();
    dropZone.classList.remove('active');
    
    file = e.dataTransfer.files[0];
    previewMedia();
});