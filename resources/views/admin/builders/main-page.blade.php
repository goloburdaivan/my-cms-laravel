<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Редактор главной страницы</title>
    <link href="https://unpkg.com/grapesjs/dist/css/grapes.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
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
    @include('admin.editable.main-page')
</div>

<script src="https://unpkg.com/grapesjs"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    var editor = grapesjs.init({
        container: '#gjs',
        fromElement: true,
        height: '100%',
        storageManager: false,
        plugins: ['gjs-preset-webpage'],
        pluginsOpts: {
            'gjs-preset-webpage': {}
        },
        canvas: {
            styles: [
                'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css',
                'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css',
            ],
            scripts: [
                'https://code.jquery.com/jquery-3.5.1.slim.min.js',
                'https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js',
                'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js',
            ],
        },
    });

    editor.BlockManager.add('product-list', {
        label: 'Список продуктов',
        category: 'Компоненты',
        attributes: { class: 'fa fa-list' },
        content: {
            type: 'product-list',
        },
    });

    editor.BlockManager.add('category-list', {
        label: 'Список категорий',
        category: 'Компоненты',
        attributes: { class: 'fa fa-th-list' },
        content: {
            type: 'category-list',
        },
    });

    editor.DomComponents.addType('product-list', {
        model: {
            defaults: {
                tagName: 'div',
                content: `
                    <div class="product-list-component">
                        {PRODUCT_LIST_MARKER}
                </div>
`,
                attributes: { class: 'product-list-component' },
                editable: false,
                droppable: false,
                copyable: false,
                stylable: true,
                style: {
                    'padding': '20px',
                    'background-color': '#f8f9fa',
                },
                'custom-name': 'Список продуктов',
            },
        },
        view: {
            init() {
                this.listenTo(this.model, 'change:style', this.updateStyle);
                this.render();
            },
            render() {
                this.el.innerHTML = `
                    <div class="alert alert-info">Список продуктов (предварительный просмотр)</div>
                `;
                this.updateStyle();
                return this;
            },
            updateStyle() {
                const styles = this.model.get('style');
                for (let prop in styles) {
                    this.el.style[prop] = styles[prop];
                }
            },
        },
    });

    editor.DomComponents.addType('category-list', {
        model: {
            defaults: {
                tagName: 'div',
                content: `
                    <div class="category-list-component">
                        {CATEGORY_LIST_MARKER}
                </div>
`,
                attributes: { class: 'category-list-component' },
                editable: false,
                droppable: false,
                copyable: false,
                stylable: true,
                style: {
                    'padding': '20px',
                    'background-color': '#f0f0f0',
                },
                'custom-name': 'Список категорий',
            },
        },
        view: {
            init() {
                this.listenTo(this.model, 'change:style', this.updateStyle);
                this.render();
            },
            render() {
                this.el.innerHTML = `
                    <div class="alert alert-warning">Список категорий (предварительный просмотр)</div>
                `;
                this.updateStyle();
                return this;
            },
            updateStyle() {
                const styles = this.model.get('style');
                for (let prop in styles) {
                    this.el.style[prop] = styles[prop];
                }
            },
        },
    });

    document.getElementById('save-button').addEventListener('click', function() {
        var html = editor.getHtml();
        var css = editor.getCss();

        var tempDiv = document.createElement('div');
        tempDiv.innerHTML = html;

        var productList = tempDiv.querySelector('.product-list-component');
        if (productList) {
            productList.innerHTML = "{PRODUCT_LIST_MARKER}";
        }

        var categoryList = tempDiv.querySelector('.category-list-component');
        if (categoryList) {
            categoryList.innerHTML = "{CATEGORY_LIST_MARKER}";
        }

        html = tempDiv.innerHTML;

        $.ajax({
            url: '{{ route('admin.builders.main-page.store') }}',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: 'POST',
            data: {
                'html': html,
                'css': css
            },
            success: function(response) {
                alert('Страница успешно сохранена!');
            },
            error: function(xhr, status, error) {
                alert('Ошибка при сохранении страницы: ' + error);
            }
        });
    });
</script>
</body>
</html>
