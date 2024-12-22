<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактор страницы</title>
    <link rel="stylesheet" href="https://unpkg.com/grapesjs/dist/css/grapes.min.css">
    <style>
        body, html { height: 100%; margin: 0; }
        .save-btn {
            position: fixed;
            top: 50px;
            left: 10px;
            z-index: 999;
        }
    </style>
</head>
<body>
<button id="save-button" class="btn btn-success save-btn">Сохранить</button>

<div id="gjs">
</div>

<script src="https://unpkg.com/grapesjs"></script>
<script src="https://unpkg.com/grapesjs-preset-webpage"></script>
<script src="https://unpkg.com/grapesjs-blocks-basic"></script>
<script src="https://unpkg.com/grapesjs-plugin-forms"></script>
<script src="https://unpkg.com/grapesjs-plugin-navbar"></script>
<script src="https://unpkg.com/grapesjs-tabs"></script>
<script src="https://unpkg.com/grapesjs-custom-code"></script>
<script src="https://unpkg.com/grapesjs-style-bg"></script>
<script src="https://unpkg.com/grapesjs-tooltip"></script>
<script src="https://unpkg.com/grapesjs-lory-slider"></script>
<script>
    // Инициализация редактора GrapesJS
    var editor = grapesjs.init({
        container: '#gjs',
        height: '100%',
        storageManager: false,
        plugins: [
            'gjs-preset-webpage',
            'grapesjs-blocks-basic',
            'grapesjs-plugin-forms',
            'grapesjs-plugin-navbar',
            'grapesjs-tabs',
            'grapesjs-custom-code',
            'grapesjs-style-bg',
            'grapesjs-tooltip',
            'grapesjs-lory-slider',
        ],
        pluginsOpts: {
            'gjs-preset-webpage': {},
            'grapesjs-blocks-basic': {},
            'grapesjs-plugin-forms': {},
            'grapesjs-plugin-navbar': {},
            'grapesjs-tabs': {},
            'grapesjs-custom-code': {},
            'grapesjs-style-bg': {},
            'grapesjs-tooltip': {},
            'grapesjs-lory-slider': {},
        },
    });

    // Кнопка "Сохранить"
    document.getElementById('save-button').addEventListener('click', function () {
        var html = editor.getHtml();
        var css = editor.getCss();

        // Пример отправки данных на сервер
        fetch('{{ route('admin.builders.main-page.store') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ html, css }),
        })
            .then(response => {
                if (response.ok) {
                    alert('Страница успешно сохранена!');
                } else {
                    alert('Ошибка при сохранении страницы.');
                }
            })
            .catch(error => {
                console.error('Ошибка:', error);
            });
    });
</script>
</body>
</html>
