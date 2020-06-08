@extends('base')

@section('main')
    <!DOCTYPE html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/froala_editor.css">
    <link rel="stylesheet" href="/css/froala_style.css">
    <link rel="stylesheet" href="/css/plugins/code_view.css">
    <link rel="stylesheet" href="/css/plugins/image_manager.css">
    <link rel="stylesheet" href="/css/plugins/image.css">
    <link rel="stylesheet" href="/css/plugins/table.css">
    <link rel="stylesheet" href="/css/plugins/video.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
        }
    </style>

</head>
<body>
<script>
    $(function() {
        $('#edit').froalaEditor({

            imageUploadURL: './upload_image.php',
            imageUploadParams: {
                id: 'my_editor'
            },

            fileUploadURL: './upload_file.php',
            fileUploadParams: {
                id: 'my_editor'
            },

            imageManagerLoadURL: './load_images.php',
            imageManagerDeleteURL: "./delete_image.php",
            imageManagerDeleteMethod: "POST"
        })
            // Catch image removal from the editor.
            .on('froalaEditor.image.removed', function (e, editor, $img) {
                $.ajax({
                    // Request method.
                    method: "POST",

                    // Request URL.
                    url: "./delete_image.php",

                    // Request params.
                    data: {
                        src: $img.attr('src')
                    }
                })
                    .done (function (data) {
                        console.log ('image was deleted');
                    })
                    .fail (function (err) {
                        console.log ('image delete problem: ' + JSON.stringify(err));
                    })
            })

            // Catch image removal from the editor.
            .on('froalaEditor.file.unlink', function (e, editor, link) {

                $.ajax({
                    // Request method.
                    method: "POST",

                    // Request URL.
                    url: "./delete_file.php",

                    // Request params.
                    data: {
                        src: link.getAttribute('href')
                    }
                })
                    .done (function (data) {
                        console.log ('file was deleted');
                    })
                    .fail (function (err) {
                        console.log ('file delete problem: ' + JSON.stringify(err));
                    })
            })
    });
</script>
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Add a category</h1>
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                @endif
                <form method="post" action="{{ route('categories.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="first_name">Name:</label>
                        <input type="text" class="form-control" name="name"/>
                    </div>

                    <div class="form-group">
                        <label for="last_name">Description:</label>
                        <textarea id="edit-validation" name="content"></textarea>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" name="email"/>
                    </div>
                    <button type="submit" class="btn btn-primary">Add contact</button>
                </form>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js"></script>
<script type="text/javascript" src="/js/froala_editor.min.js"></script>
<script type="text/javascript" src="/js/plugins/align.min.js"></script>
<script type="text/javascript" src="/js/plugins/code_beautifier.min.js"></script>
<script type="text/javascript" src="/js/plugins/code_view.min.js"></script>
<script type="text/javascript" src="/js/plugins/draggable.min.js"></script>
<script type="text/javascript" src="/js/plugins/image.min.js"></script>
<script type="text/javascript" src="/js/plugins/image_manager.min.js"></script>
<script type="text/javascript" src="/js/plugins/link.min.js"></script>
<script type="text/javascript" src="/js/plugins/lists.min.js"></script>
<script type="text/javascript" src="/js/plugins/paragraph_format.min.js"></script>
<script type="text/javascript" src="/js/plugins/paragraph_style.min.js"></script>
<script type="text/javascript" src="/js/plugins/table.min.js"></script>
<script type="text/javascript" src="/js/plugins/video.min.js"></script>
<script type="text/javascript" src="/js/plugins/url.min.js"></script>
<script type="text/javascript" src="/js/plugins/entities.min.js"></script>

<script>
    function cl(){
        console.log(getElementById("edit"));
    }
    (function () {
        const editorInstance = new FroalaEditor('#edit', {
            enter: FroalaEditor.ENTER_P,
            placeholderText: null,
            events: {
                initialized: function () {
                    const editor = this
                    this.el.closest('form').addEventListener('submit', function (e) {
                    })
                }
            }
        })
    })()
</script>
</html>
@endsection
