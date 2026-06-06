@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto p-8">

    <h1 class="text-4xl font-bold mb-8">
        Editar Usuario
    </h1>

    <div class="bg-white rounded-2xl shadow p-6">

        <form action="/users/{{ $user->id }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-4">

                <label class="block mb-2 font-semibold">
                    Nombre
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ $user->name }}"
                    class="w-full border rounded-lg p-3"
                >

            </div>

            <div class="mb-6">

                <label class="block mb-2 font-semibold">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ $user->email }}"
                    class="w-full border rounded-lg p-3"
                >

            </div>

            <div class="flex gap-3">

                <button
                    type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg"
                >
                    Guardar Cambios
                </button>

                <a
                    href="/users"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg"
                >
                    Cancelar
                </a>

            </div>

        </form>

    </div>

</div>

@endsection