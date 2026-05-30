<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Post</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="max-w-3xl mx-auto py-10">

        <div class="bg-white rounded-2xl shadow p-8">

            <h1 class="text-3xl font-bold mb-6">
                Editar Post
            </h1>

            <form action="/posts/{{ $post->id }}" method="POST">

                @csrf
                @method('PUT')

                <input
                    type="text"
                    name="title"
                    value="{{ $post->title }}"
                    class="w-full border rounded-lg p-3 mb-4"
                >

                <textarea
                    name="content"
                    rows="6"
                    class="w-full border rounded-lg p-3 mb-4"
                >{{ $post->content }}</textarea>

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl"
                >
                    Actualizar Post
                </button>

            </form>

        </div>

    </div>

</body>
</html>