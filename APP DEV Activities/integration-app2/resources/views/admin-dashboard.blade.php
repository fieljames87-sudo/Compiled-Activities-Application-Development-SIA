<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">

    <!-- Navbar -->
    <nav class="bg-gray-900 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <div>
                <h1 class="text-2xl font-bold">
                    Admin Dashboard
                </h1>

                <p class="text-sm text-gray-300">
                    Integration Application Management Panel
                </p>
            </div>

            <div class="flex items-center gap-4">

                <div class="text-right">
                    <p class="font-semibold">
                        {{ auth()->user()->name }}
                    </p>

                    <p class="text-sm text-gray-300 capitalize">
                        {{ auth()->user()->role }}
                    </p>
                </div>

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

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto p-6">

        <!-- Welcome Card -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-3xl shadow-lg p-8 text-white mb-8">

            <h2 class="text-4xl font-bold mb-3">
                Welcome Admin 👋
            </h2>

            <p class="text-lg text-gray-100">
                Manage users, monitor integrations, and oversee system activity.
            </p>

        </div>

        <!-- Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

            <!-- Total Users -->
            <div class="bg-white rounded-2xl shadow-md p-6">

                <p class="text-gray-500 mb-2">
                    Total Users
                </p>

                <h2 class="text-4xl font-bold text-indigo-600">
                    {{ $users->count() }}
                </h2>

            </div>

            <!-- Total Posts -->
            <div class="bg-white rounded-2xl shadow-md p-6">

                <p class="text-gray-500 mb-2">
                    Public API Posts
                </p>

                <h2 class="text-4xl font-bold text-purple-600">
                    {{ count($posts) }}
                </h2>

            </div>

            <!-- Role -->
            <div class="bg-white rounded-2xl shadow-md p-6">

                <p class="text-gray-500 mb-2">
                    Current Role
                </p>

                <h2 class="text-4xl font-bold text-red-500 capitalize">
                    {{ auth()->user()->role }}
                </h2>

            </div>

        </div>

        <!-- User Table -->
        <div class="bg-white rounded-2xl shadow-md p-6 mb-8 overflow-x-auto">

            <div class="flex justify-between items-center mb-5">

                <h2 class="text-2xl font-bold text-indigo-600">
                    Registered Users
                </h2>

                <form method="GET" action="/admin-dashboard">

                    <input
                        type="text"
                        name="search"
                        placeholder="Search users..."
                        class="border border-gray-300 rounded-lg px-4 py-2">

                </form>

            </div>

            <table class="w-full border-collapse">

                <thead>
                    <tr class="bg-gray-900 text-white">

                        <th class="p-3 text-left">
                            Name
                        </th>

                        <th class="p-3 text-left">
                            Email
                        </th>

                        <th class="p-3 text-left">
                            Role
                        </th>

                    </tr>
                </thead>

                <tbody>

                    @foreach($users as $user)

                    <tr class="border-b hover:bg-gray-100">

                        <td class="p-3">
                            {{ $user->name }}
                        </td>

                        <td class="p-3">
                            {{ $user->email }}
                        </td>

                        <td class="p-3 capitalize">
                            {{ $user->role }}
                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        <!-- API Cards -->
        <div class="bg-white rounded-2xl shadow-md p-6">

            <h2 class="text-2xl font-bold text-indigo-600 mb-6">
                External API Data
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach($posts as $post)

                <div class="bg-gray-100 rounded-2xl p-5 shadow hover:shadow-lg transition">

                    <h3 class="font-bold text-lg mb-3 text-indigo-700">
                        {{ $post['title'] }}
                    </h3>

                    <p class="text-gray-700 text-sm">
                        {{ $post['body'] }}
                    </p>

                </div>

                @endforeach

            </div>

        </div>

    </div>

</body>
</html>