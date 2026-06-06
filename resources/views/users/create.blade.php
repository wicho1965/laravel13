@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto p-8">

    <h1 class="text-4xl font-bold mb-8">
        Crear Usuario
    </h1>

    @if ($errors->any())

    <div style="background:#fee2e2;color:#991b1b;padding:15px;border-radius:10px;margin-bottom:20px;">

        <ul>

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif

<div class="bg-white rounded-2xl shadow p-6">

        <form action="/users" method="POST">

            @csrf

            <div class="mb-4">

                <label class="block mb-2 font-semibold">
                    Nombre
                </label>

                <input
                    type="text"
                    name="name"
                    class="w-full border rounded-lg p-3"
                >

            </div>

            <div class="mb-4">

                <label class="block mb-2 font-semibold">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    class="w-full border rounded-lg p-3"
                >

            </div>

            <div class="mb-6">

                <label class="block mb-2 font-semibold">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    class="w-full border rounded-lg p-3"
                >

            </div>

            <button
            type="submit"
            style="background:#16a34a;color:white;padding:15px 25px;border-radius:10px;"
            >
            CREAR USUARIO
            </button>

        </form>

    </div>

</div>

@endsection