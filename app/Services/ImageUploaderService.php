<?php

namespace App\Services;

use App\Exceptions\PhotoUploadException;
use App\Http\Requests\Common\UploadPhotoRequest;
use Illuminate\Database\Eloquent\Model;

class ImageUploaderService
{
    public function __construct(
        private readonly ImageStorageService $service,
    ) {
    }

    /**
     * @throws PhotoUploadException
     */
    public function upload(UploadPhotoRequest $request): array
    {
        $data = $this->validateRequest($request);

        $modelClass = $data['model'];

        /** @var Model $model */
        $model = new $modelClass();
        $idAttribute = $this->getImagableId($model->getTable());
        $path = $this->service->upload('public', $this->getFolder($model->getTable()), $request->file('image'));

        $model->fill([
            'image' => $path,
            $idAttribute => $data['model_id'],
        ]);

        if (!$model->save()) {
            throw new PhotoUploadException("Failed to save photo to database");
        }

        return [
            'image' => $path,
        ];
    }

    /**
     * @throws PhotoUploadException
     */
    private function validateRequest(UploadPhotoRequest $request): array
    {
        if (!$request->hasFile('image')) {
            throw new PhotoUploadException("Request has not image in it");
        }

        $data = $request->validated();

        $modelClass = $data['model'];

        if (!class_exists($modelClass)) {
            throw new PhotoUploadException("Model class {$modelClass} does not exist");
        }

        return $request->validated();
    }

    private function getImagableId(string $tableName): string
    {
        return explode('_', $tableName)[0] . '_id';
    }

    private function getFolder(string $tableName): string
    {
        return explode('_', $tableName)[0];
    }
}
