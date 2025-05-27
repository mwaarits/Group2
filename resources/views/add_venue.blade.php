<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Venue</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            pinky: '#FCE7F3',
            bubblegum: '#F472B6',
            softpink: '#F9A8D4',
          }
        }
      }
    }
  </script>
</head>
<body class="bg-pinky min-h-screen flex items-center justify-center px-4 py-10">

  <div class="w-full max-w-xl bg-white rounded-2xl shadow-lg p-8 border border-pink-200">
    <h2 class="text-3xl font-extrabold text-center text-bubblegum mb-6">📍 Add Venue</h2>

    @if (session('success'))
      <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
        {{ session('success') }}
      </div>
    @endif

    <form method="POST" enctype="multipart/form-data" action="/add/venue" class="space-y-5">
      @csrf

      <div>
        <label class="block font-medium text-gray-700 mb-1">Venue Name</label>
        <input type="text" name="name" required class="w-full border border-pink-300 p-2 rounded focus:ring-2 focus:ring-bubblegum">
      </div>

      <div>
        <label class="block font-medium text-gray-700 mb-1">Location</label>
        <input type="text" name="location" required class="w-full border border-pink-300 p-2 rounded focus:ring-2 focus:ring-bubblegum">
      </div>

      <div>
        <label class="block font-medium text-gray-700 mb-1">Capacity</label>
        <input type="number" name="capacity" required min="1" class="w-full border border-pink-300 p-2 rounded focus:ring-2 focus:ring-bubblegum">
      </div>

      <div class="flex items-center justify-between">
        <button type="submit" class="bg-bubblegum text-white px-4 py-2 rounded hover:bg-pink-500 transition">
          Save
        </button>
        <a href="/admin" class="text-bubblegum hover:underline">← Back to Dashboard</a>
      </div>
    </form>
  </div>

</body>
</html>
