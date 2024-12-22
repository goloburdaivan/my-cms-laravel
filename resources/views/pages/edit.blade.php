@extends('layouts.app')

@section('content')
    <form style="padding-top: 20px;" id="save-form" method="POST" action="{{ route('admin.pages.update', ['page' => $item->id]) }}">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label for="slug" class="form-label">Slug:</label>
            <input type="text" value="{{ old('slug', $item->slug) }}" id="slug" name="slug" required class="form-control @error('slug') is-invalid @enderror">
            @error('slug')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <label for="title" class="form-label">Title:</label>
            <input type="text" value="{{ old('slug', $item->title) }}" id="title" name="title" required class="form-control @error('title') is-invalid @enderror">
            @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <textarea id="page-content" name="html" hidden>{!! $item->html !!}</textarea>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
    <div class="editable" style="padding-top: 20px" data-editable data-name="main-content">
        {!! $item->html !!}
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
