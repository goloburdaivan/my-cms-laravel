document.addEventListener('DOMContentLoaded', () => {
    console.log('test');
    const uploadComponent = document.getElementById('photo-upload-component');
    const uploadInput = document.getElementById('photo-upload-input');
    const uploadButton = document.getElementById('photo-upload-btn');
    const previewContainer = document.getElementById('photo-preview-container');

    const uploadUrl = uploadComponent.dataset.uploadUrl;
    console.log(uploadUrl);
    const model = uploadComponent.dataset.model;
    const modelId = uploadComponent.dataset.modelId;

    uploadButton.addEventListener('click', async () => {
        const files = uploadInput.files;

        if (files.length === 0) {
            alert('Пожалуйста, выберите файлы для загрузки.');
            return;
        }

        const formData = new FormData();
        formData.append('model', model);
        formData.append('model_id', modelId);

        for (const file of files) {
            formData.append('image', file);
        }

        try {
            const response = await fetch(uploadUrl, {
                method: 'POST',
                body: formData,
                headers: {
                    "Accept": 'application/json',
                }
            });

            const data = await response.json();

            if (data.success) {
                alert('Фотографии успешно загружены.');
                renderPreview(data.image);
            } else {
                alert(`Ошибка загрузки: ${data.error}`);
            }
        } catch (error) {
            console.error('Ошибка загрузки:', error);
            alert('Произошла ошибка при загрузке. Попробуйте позже.');
        }
    });

    function renderPreview(imagePath) {
        const imageElement = document.createElement('div');
        imageElement.classList.add('photo-preview-item');
        imageElement.innerHTML = `
            <img src="/storage/${imagePath}" alt="Uploaded Photo" class="img-thumbnail" width="100">
        `;
        previewContainer.appendChild(imageElement);
    }
});
