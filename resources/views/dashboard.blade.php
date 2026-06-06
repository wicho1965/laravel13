<x-app-layout>

   <div class="min-h-screen bg-gray-100 flex">

        <!-- SIDEBAR -->

        <aside class="w-64 bg-black text-white p-6 hidden md:block">

            <h2 class="text-3xl font-bold mb-10">
                Admin Panel
            </h2>

            <nav class="space-y-4">

                <a href="/dashboard" class="block hover:text-gray-300">
                    📊 Dashboard
                </a>

                <a href="/posts" class="block hover:text-gray-300">
                    📝 Posts
                </a>

                <a href="/users" class="block hover:text-gray-300">
                    👥 Usuarios
                </a>

                <a href="#" class="block hover:text-gray-300">
                    ⚙️ Configuración
                </a>

            </nav>

        </aside>

        <!-- CONTENT -->

        <main class="flex-1 p-8">

            <!-- HEADER -->

            <div class="mb-10">

                <h1 class="text-4xl font-bold text-gray-800">
                    Dashboard
                </h1>

                <p class="text-gray-500 mt-2">
                    Bienvenido al panel administrativo Laravel 13
                </p>

            </div>

            <!-- CARDS -->

            <div class="grid md:grid-cols-4 gap-6 mb-10">

                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-2xl transition duration-300">

                    <h3 class="text-gray-500 text-sm">
                        Total Posts
                    </h3>

                    <p class="text-5xl font-bold mt-3">
                        {{ \App\Models\Post::count() }}
                    </p>

                </div>

                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-2xl transition duration-300">

                    <h3 class="text-gray-500 text-sm">
                        Total Usuarios
                    </h3>

                    <p class="text-5xl font-bold mt-3">
                        {{ \App\Models\User::count() }}
                    </p>

                </div>

                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-2xl transition duration-300">

                    <h3 class="text-gray-500 text-sm">
                        Total Comentarios
                    </h3>

                    <p class="text-5xl font-bold mt-3">
                        {{ \App\Models\Comment::count() }}
                    </p>

                </div>

                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-2xl transition duration-300">

                    <h3 class="text-gray-500 text-sm">
                        Laravel Version
                    </h3>

                    <p class="text-3xl font-bold mt-3">
                        Laravel 13
                    </p>

                </div>

            </div>

            <!-- GRAFICO -->

            <div class="bg-white rounded-2xl shadow p-6 mb-10">

                <h2 class="text-2xl font-bold mb-6">
                    Estadísticas del Sistema
                </h2>

                <div class="h-80">

                    <canvas id="dashboardChart"></canvas>

                </div>

            </div>

            <!-- TABLA POSTS -->

            <div class="bg-white rounded-2xl shadow p-6 mb-10">

                <h2 class="text-2xl font-bold mb-6">
                    Últimos Posts
                </h2>

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead>

                            <tr class="border-b">

                                <th class="py-3 text-center">ID</th>
                                <th class="py-3 text-center">Título</th>
                                <th class="py-3 text-center">Fecha</th>
                                <th class="py-3 text-center">Acción</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach (\App\Models\Post::latest()->take(5)->get() as $post)

                                <tr class="border-b hover:bg-gray-50">

                                    <td class="py-4 text-center">
                                        {{ $post->id }}
                                    </td>

                                    <td class="py-4 font-semibold">
                                        {{ $post->title }}
                                    </td>

                                    <td class="py-4 text-gray-500">
                                        {{ $post->created_at }}
                                    </td>

                                    <td class="py-4">

                                        <div class="flex justify-center gap-2">

                                            <a
                                                href="/posts/{{ $post->id }}/edit"
                                                class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg"
                                            >
                                                Editar
                                            </a>

                                            <form action="/posts/{{ $post->id }}" method="POST">

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

            <!-- USUARIOS -->

            <div class="bg-white rounded-2xl shadow p-6">

                <h2 class="text-2xl font-bold mb-6">
                    Usuarios Recientes
                </h2>

                <div class="space-y-4">

                    @foreach (\App\Models\User::latest()->take(5)->get() as $user)

                        <div class="flex justify-between border rounded-xl p-4">

                            <div>

                                <p class="font-bold">
                                    {{ $user->name }}
                                </p>

                                <p class="text-gray-500 text-sm">
                                    {{ $user->email }}
                                </p>

                            </div>

                            <div class="text-sm text-gray-400">
                                {{ $user->created_at }}
                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        </main>

    </div>

</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const ctx = document.getElementById('dashboardChart');

    new Chart(ctx, {

        type: 'bar',

        data: {

            labels: [
                'Posts',
                'Usuarios',
                'Comentarios'
            ],

            datasets: [{

                label: 'Totales del Sistema',

                data: [

                    {{ \App\Models\Post::count() }},
                    {{ \App\Models\User::count() }},
                    {{ \App\Models\Comment::count() }}

                ],

                backgroundColor: [
                    '#3B82F6',
                    '#10B981',
                    '#EF4444'
                ],

                borderRadius: 10

            }]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            plugins: {

                legend: {
                    display: false
                }

            }

        }

    });

});

</script>