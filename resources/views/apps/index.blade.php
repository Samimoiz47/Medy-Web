<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Apps & Games Downloader</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <header class="text-center mb-8">
            <h1 class="text-4xl font-bold text-blue-600 mb-2">Free Apps & Games Downloader</h1>
            <p class="text-gray-600">Download your favorite apps and games for free!</p>
        </header>

        <div class="mb-6">
            <input type="text" id="searchInput" placeholder="Search apps and games..." 
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="appsContainer">
            <!-- Sample apps will be loaded here -->
            <div class="bg-white rounded-lg shadow-md p-4">
                <div class="h-32 bg-gray-200 rounded mb-4 flex items-center justify-center">
                    <span class="text-gray-500">App Icon</span>
                </div>
                <h3 class="text-xl font-semibold mb-2">Sample App</h3>
                <p class="text-gray-600 text-sm mb-2">This is a sample app description</p>
                <div class="flex justify-between items-center">
                    <span class="text-green-600 font-bold">FREE</span>
                    <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Download</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Simple search functionality
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            // Add search logic here
        });
    </script>
</body>
</html>
