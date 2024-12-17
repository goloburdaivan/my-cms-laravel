<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageBuilderRequest;
use App\Services\MainPageBuilderService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class MainPageBuilderController extends Controller
{
    public function __construct(
        private readonly MainPageBuilderService $builderService,
    ) {
    }

    public function index(): View
    {

        return view('admin.builders.main-page', $this->builderService->getBuildingData());
    }

    public function store(PageBuilderRequest $request): JsonResponse
    {
        $this->builderService->build($request);
        return response()->json(['success' => true]);
    }
}
