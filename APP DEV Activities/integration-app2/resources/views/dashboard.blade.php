@php
use Illuminate\Support\Str;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Integration Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Navbar -->
    <nav class="bg-indigo-600 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">
                Integration Dashboard
            </h1>

            <div class="flex items-center gap-4">
                <span>
                    Welcome, {{ auth()->user()->name }}
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        type="submit"
                        class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto p-6">

        <!-- User Profile Card -->
        <div class="bg-white rounded-2xl shadow-md p-6 mb-8">
            <h2 class="text-2xl font-bold mb-4 text-indigo-600">
                User Profile
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <div class="bg-gray-100 p-4 rounded-xl">
                    <p class="text-gray-500">Full Name</p>
                    <h3 class="text-lg font-semibold">
                        {{ auth()->user()->name }}
                    </h3>
                </div>

                <div class="bg-gray-100 p-4 rounded-xl">
                    <p class="text-gray-500">Email</p>
                    <h3 class="text-lg font-semibold">
                        {{ auth()->user()->email }}
                    </h3>
                </div>

                <div class="bg-gray-100 p-4 rounded-xl">
                    <p class="text-gray-500">Role</p>
                    <h3 class="text-lg font-semibold capitalize">
                        {{ auth()->user()->role }}
                    </h3>
                </div>

            </div>
        </div>

        <!-- Search -->
        <div class="bg-white rounded-2xl shadow-md p-6 mb-8">
            <h2 class="text-2xl font-bold mb-4 text-indigo-600">
                Search Users
            </h2>

            <form method="GET" action="/dashboard" class="flex gap-4">
                <input
                    type="text"
                    name="search"
                    placeholder="Enter user name..."
                    class="border border-gray-300 rounded-lg px-4 py-2 w-full">

                <button
                    type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg">
                    Search
                </button>
            </form>
        </div>

        <!-- Users Table -->
        <div class="bg-white rounded-2xl shadow-md p-6 mb-8 overflow-x-auto">
            <h2 class="text-2xl font-bold mb-4 text-indigo-600">
                Registered Users
            </h2>

            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-indigo-600 text-white">
                        <th class="p-3 text-left">Name</th>
                        <th class="p-3 text-left">Email</th>
                        <th class="p-3 text-left">Role</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($users as $user)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="p-3">{{ $user->name }}</td>
                        <td class="p-3">{{ $user->email }}</td>
                        <td class="p-3 capitalize">{{ $user->role }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Anime API Section -->
        <div class="bg-white rounded-2xl shadow-md p-6">

            <h2 class="text-2xl font-bold mb-6 text-indigo-600">
                Top Anime Recommendations
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach($posts as $anime)

                <div class="bg-gray-100 rounded-2xl overflow-hidden shadow hover:shadow-xl transition">

                    <img
                        src="{{ $anime['images']['jpg']['image_url'] }}"
                        alt="Anime Image"
                        class="w-full h-72 object-cover">

                <div class="p-5">

                    <h3 class="font-bold text-lg mb-2 text-indigo-700">
                        {{ $anime['title'] }}
                    </h3>

                    <p class="text-sm text-gray-600 mb-3">
                        Episodes:
                        {{ $anime['episodes'] ?? 'Unknown' }}
                    </p>

                    <p class="text-sm text-gray-700 mb-4">
                        Score:
                        ⭐ {{ $anime['score'] ?? 'N/A' }}
                    </p>

                    <p class="text-gray-600 text-sm line-clamp-4">
                        {{ Str::limit($anime['synopsis'], 120) }}
                    </p>

                </div>

            </div>

        @endforeach

    </div>

</div>

</body>
</html>