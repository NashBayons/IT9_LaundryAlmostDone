<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css')
</head>
 <style>
 
    .bg-blue-600 {
        --tw-bg-opacity: 1;
        background-color: rgb(39 49 71);
}</style>
<body class="bg-gray-100">
    <nav class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold">Admin Panel</a>
            <div>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="hover:text-blue-200">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="w-full">
        @yield('content')
    </div>
</body>
</html>