<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Category</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex justify-center items-center">
  <div class="bg-white p-8 rounded shadow-md w-full max-w-xl">
    <h2 class="text-2xl font-bold mb-6 text-center text-pink-700">Add Category</h2>

    <form method="POST" action="/add/category" class="space-y-4">
      @csrf

      <div>
        <label class="block font-semibold text-pink-700">Category Name</label>
        <input type="text" name="name" required class="w-full border border-pink-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-pink-200" placeholder="e.g., Music Concert">
      </div>

      <button type="submit" class="w-full bg-pink-500 hover:bg-pink-600 text-white py-2 px-4 rounded">
        Save Category
      </button>

      @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
      @endif
    </form>

    <div class="mt-4 text-center">
      <a href="/admin" class="text-pink-600 hover:underline">← Back to Dashboard</a>
    </div>
  </div>
</body>
</html>
