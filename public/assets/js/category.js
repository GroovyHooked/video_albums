const form = document.querySelector('.form-data');
const cross = document.querySelector('.cross');
const message = document.querySelector('.result-error');
const loading = document.querySelector('.wait');
const button = document.querySelector('.submit');
const input_video_display = document.querySelector('.uploaded-video');
const input_img_display = document.querySelector('.uploaded-img');

/* Loader display on upload */
button.addEventListener('click', () => {
    loading.style.display = 'flex';
})

/* Message displayed on first load and when errors occurs */
if(document.querySelector('.result-error')){
    message.style.display = 'flex';
    form.style.display = 'none';
    cross.style.display = 'block'
}

/* Closing Message */
cross.addEventListener('click', () => {
    message.style.display = 'none';
    form.style.display = 'flex';
    cross.style.display = 'none'
})

/* File display when selected function */
const processFile = (fileInput, display) => {
    let files = fileInput.files;
    for (let i = 0; i < files.length; i++) {
        display.textContent += `\nFichier: ${files[i].name}`;
    }
}
