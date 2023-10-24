<!DOCTYPE html>
<html>
<head>
    <title>Form Login</title>
    <!-- Tambahkan link ke file CSS Tailwind -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <div class="flex items-center justify-center h-screen">
        <div class="bg-white p-8 rounded shadow-md max-w-sm w-full">
            <h1 class="text-2xl font-semibold mb-6">Login</h1>
            <form method="post" action="login_process.php">
                <div class="mb-4">
                    <label for="username" class="block text-gray-700 font-bold mb-2">Username:</label>
                    <input type="text" name="username" required class="w-full px-3 py-2 rounded border border-gray-400 focus:outline-none focus:border-indigo-500">
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-bold mb-2">Password:</label>
                    <input type="password" name="password" required class="w-full px-3 py-2 rounded border border-gray-400 focus:outline-none focus:border-indigo-500">
                </div>

                <input type="submit" value="Login" class="w-full bg-indigo-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline hover:bg-indigo-600">
            </form>
        </div>
    </div>

</body>
</html>
