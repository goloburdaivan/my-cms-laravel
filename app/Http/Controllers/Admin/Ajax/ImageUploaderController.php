<?php

namespace App\Http\Controllers\Admin\Ajax;

use App\Exceptions\PhotoUploadException;
use App\Http\Requests\Common\UploadPhotoRequest;
use App\Services\ImageUploaderService;
use Illuminate\Http\JsonResponse;

readonly class ImageUploaderController
{
    public function __construct(
        private ImageUploaderService $service,
    ) {
    }

    public function upload(UploadPhotoRequest $request): JsonResponse
    {
        try {
            $result = $this->service->upload($request);

            return response()->json(array_merge($result, ['success' => true]));
        } catch (PhotoUploadException $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
