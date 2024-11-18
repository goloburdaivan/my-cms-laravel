<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeCmsResourceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:cms-resource';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a custom CRUD controller, views, and FormRequest';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $name = $this->ask('Name of the model?');
        $controllerName = "{$name}Controller";
        $requestName = "{$name}Request";
        $modelName = $name;
        $viewFolder = Str::snake(Str::pluralStudly($name));

        $stubPath = __DIR__ .  '/stubs';

        $controllerStub = File::get("{$stubPath}/admin-controller.stub");
        $controllerContent = $this->replacePlaceholders($controllerStub, [
            'controller' => $controllerName,
            'request' => $requestName,
            'model' => $modelName,
            'viewFolder' => $viewFolder,
        ]);

        $controllerPath = app_path("Http/Controllers/Admin/{$controllerName}.php");
        $this->createFile($controllerPath, $controllerContent, 'Контроллер');

        $requestStub = File::get("{$stubPath}/admin-request.stub");
        $rules = $this->getRulesFromFillable($name);

        $requestContent = $this->replacePlaceholders($requestStub, [
            'request' => $requestName,
            'rules' => $rules,
        ]);

        $requestPath = app_path("Http/Requests/Admin/{$requestName}.php");
        $this->createFile($requestPath, $requestContent, 'FormRequest');

        $views = ['index', 'edit', 'store', 'show'];
        $viewPath = resource_path("views/{$viewFolder}");
        if (!File::exists($viewPath)) {
            File::makeDirectory($viewPath, 0755, true);
            $this->info("Папка представлений создана: {$viewPath}");
        }

        $viewStub = File::get("{$stubPath}/view.stub");

        foreach ($views as $view) {
            $viewContent = $this->replacePlaceholders($viewStub, [
                'view' => $view,
                'name' => $name,
            ]);

            $viewFilePath = "{$viewPath}/{$view}.blade.php";
            $this->createFile($viewFilePath, $viewContent, 'Представление');
        }

        $this->info("Генерация Custom CRUD завершена.");
    }

    protected function createFile($path, $content, $type)
    {
        if (!File::exists($path)) {
            File::put($path, $content);
            $this->info("{$type} создан: {$path}");
        } else {
            $this->error("{$type} уже существует: {$path}");
        }
    }

    protected function replacePlaceholders($template, $replacements)
    {
        foreach ($replacements as $placeholder => $value) {
            $template = str_replace('{{ ' . $placeholder . ' }}', $value, $template);
        }
        return $template;
    }

    private function getRulesFromFillable(string $name): string
    {
        $reflectionClass = new \ReflectionClass("\\App\\Models\\$name");
        $fields = $reflectionClass->getProperty('fillable')->getDefaultValue();
        $rules = "";

        foreach ($fields as $field) {
            $rules .= "'$field' => []," . PHP_EOL;
        }


        return $rules;
    }
}
