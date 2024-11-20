<div class="mb-3">
    <label class="form-label">Загрузить фотографии</label>
    <div id="photo-upload-component" data-upload-url="{{ route('admin.images.upload') }}"
         data-model="{{ $model }}" data-model-id="{{ $item->id }}">
        <div class="file-upload-area">
            <input type="file" id="photo-upload-input" accept="image/*">
            <button type="button" id="photo-upload-btn" class="btn btn-primary mt-2">Загрузить</button>
        </div>
        <div class="photo-preview mt-3">
            <h5>Загруженные фотографии:</h5>
            <div id="photo-preview-container" class="d-flex flex-wrap gap-2">
                @foreach($item->images as $image)
                    <div class="photo-preview-item">
                        <img src="/storage/{{ $image->image }}" alt="Uploaded Photo" class="img-thumbnail" width="100">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="{{ asset('js/fileUploader.js') }}"></script>
@endpush
