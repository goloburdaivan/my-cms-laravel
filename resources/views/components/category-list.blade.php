<div class="categories-section">
    <div class="container">
        <h2 class="text-center my-5">Категории</h2>
        <ul class="list-group">
            @foreach($categories as $category)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        @if($category->image_url)
                            <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="img-thumbnail mr-3" style="width: 50px; height: 50px; object-fit: cover;">
                        @endif
                        <a href="{{ route('admin.categories.show', $category->id) }}">{{ $category->name }}</a>
                        <p class="mb-0">{{ $category->description }}</p>
                    </div>
                    <a href="{{ route('admin.categories.show', $category->id) }}" class="btn btn-primary btn-sm">Просмотреть</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
