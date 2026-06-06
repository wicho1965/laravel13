@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto p-8">

    <h1 class="text-4xl font-bold mb-8">
        Usuarios
    </h1>
    @if(session('success'))

        <div style="background:#dcfce7;color:#166534;padding:15px;border-radius:12px;margin-bottom:20px;">
            {{ session('success') }}
        </div>

    @endif
    
    <a
    href="/users/create"
    style="background:#16a34a;color:white;padding:12px 20px;border-radius:12px;display:inline-block;margin-bottom:20px;"
>
    + Nuevo Usuario
</a>

    <div class="bg-white rounded-2xl shadow p-6">

        <table class="w-full">

            <thead>

                <tr class="border-b">

                    <th class="py-3 text-left">ID</th>
                    <th class="py-3 text-left">Nombre</th>
                    <th class="py-3 text-left">Email</th>
                    <th class="py-3 text-left">Fecha</th>
                    <th class="py-3 text-center">Acciones</th>

                </tr>

            </thead>

            <tbody>

                @foreach($users as $user)

                    <tr class="border-b">

                        <td class="py-4">
                            {{ $user->id }}
                        </td>

                        <td class="py-4">
                            {{ $user->name }}
                        </td>

                        <td class="py-4">
                            {{ $user->email }}
                        </td>

                        <td class="py-4">
                            {{ $user->created_at }}
                        </td>

                        <td class="py-4 text-center">

                            <div class="flex justify-center gap-2">

                                <a
                                    href="/users/{{ $user->id }}/edit"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg"
                                >
                                    Editar
                                </a>

                                <form action="/users/{{ $user->id }}" method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg"
                                    >
                                        Eliminar
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection