@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto">

    <h1 class="text-4xl font-bold mb-8 text-center">
        Laravel 13 - Posts
    </h1>

    <form action="/posts" method="POST" class="bg-white p-6 rounded-2xl shadow mb-8">

        @csrf

        <h2 class="text-2xl font-bold mb-4">
            Crear Post
        </h2>

        <input
            type="text"
            name="title"
            placeholder="Título"
            class="w-full border rounded-lg p-3 mb-4"
        >

        <textarea
            name="content"
            placeholder="Contenido"
            class="w-full border rounded-lg p-3 mb-4"
            rows="5"
        ></textarea>

        <button
            type="submit"
            class="bg-black text-white px-6 py-3 rounded-xl"
        >
            Guardar Post
        </button>

    </form>

    <div class="grid gap-6">

        @foreach ($posts as $post)

            <div class="bg-white rounded-2xl shadow p-6">

                <h2 class="text-2xl font-bold mb-2">
                    {{ $post->title }}
                </h2>

                <p class="text-gray-700 mb-4">
                    {{ $post->content }}
                </p>

                <div class="text-sm text-gray-500">
                    Autor:
                    <span class="font-semibold">
                        {{ $post->user->name }}
                    </span>
                </div>

                <div class="text-sm text-gray-400 mt-2">
                    {{ $post->created_at }}
                </div>

                <div class="flex gap-3 mt-4">

                    <form action="/posts/{{ $post->id }}" method="POST">

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg"
                        >
                            Eliminar
                        </button>

                    </form>

                    <a
                        href="/posts/{{ $post->id }}/edit"
                        class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg"
                    >
                        Editar
                    </a>

                </div>

            </div>

        @endforeach

    </div>

</div>

@endsection
