<?php

namespace App\Services;

use App\Http\Requests\PageBuilderRequest;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Illuminate\Support\Facades\File;

class MainPageBuilderService
{
    public function __construct(
        private readonly ProductRepository $productRepository,
        private readonly CategoryRepository $categoryRepository,
    ) {
    }

    public function build(PageBuilderRequest $request): void
    {
        $data = $request->validated();
        $html = $data['html'];
        $css = $data['css'];

        // Widgets
        $html = str_replace('{PRODUCT_LIST_MARKER}', "@include('components.product-list')", $html);
        $html = str_replace('{CATEGORY_LIST_MARKER}', "@include('components.category-list')", $html);

        $content = view('admin.editable.layout.main-page', array_merge([
            'html' => $html,
            'css' => $css,
        ], $this->getBuildingData()))->render();

        File::put(base_path('resources/views/admin/editable/main-page.blade.php'), $content);
    }

    public function getBuildingData(): array
    {
        return [
            'products' => $this
                ->productRepository
                ->query()
                ->limit(4)
                ->get(),
            'categories' => $this->categoryRepository->query()->get(),
        ];
    }
}
