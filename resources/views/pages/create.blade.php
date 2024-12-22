@extends('layouts.app')

@section('content')
    <form style="padding-top: 20px;" id="save-form" method="POST" action="{{ route('admin.pages.store') }}">
        @csrf
        <div class="mb-3">
            <label for="slug" class="form-label">Slug:</label>
            <input type="text" id="slug" name="slug" value="{{ old('slug') }}" required class="form-control @error('slug') is-invalid @enderror">
            @error('slug')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <label for="title" class="form-label">Title:</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required class="form-control @error('title') is-invalid @enderror">
            @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <textarea id="page-content" name="html" hidden></textarea>
        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
    <div class="editable" style="padding-top: 20px" data-editable data-name="main-content">
    </div>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ContentTools/1.6.10/content-tools.min.js"></script>
    <script>
        const editor = ContentTools.EditorApp.get();
        editor.init('*[data-editable]', 'data-name');

        editor.addEventListener('saved', function (ev) {
            const regions = ev.detail().regions;
            if (Object.keys(regions).length === 0) {
                return;
            }

            const content = regions['main-content'];
            document.getElementById('page-content').value = content;
        });
    </script>
@endpush
