<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Ticket Type</title>
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
<body class="bg-pinky min-h-screen flex items-center justify-center px-4 py-8">

  <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md border border-pink-200">
    <h2 class="text-3xl font-extrabold text-center text-bubblegum mb-6">🎟️ Add Ticket Type</h2>

    @if (session('success'))
      <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
        {{ session('success') }}
      </div>
    @endif

    <form method="POST" action="/add/ticket" class="space-y-5">
      @csrf

      <div>
        <label class="block font-medium text-gray-700 mb-1">Event</label>
        <select name="event_id" required class="w-full border border-pink-300 p-2 rounded">
          <option value="">-- Select Event --</option>
          @foreach ($events as $item)
            <option value="{{ $item->id }}">{{ $item->title }}</option>
          @endforeach
        </select>
      </div>

      <div>
        <label class="block font-medium text-gray-700 mb-1">Ticket Type Name</label>
        <input type="text" name="name" required class="w-full border border-pink-300 p-2 rounded focus:ring-2 focus:ring-bubblegum">
      </div>

      <div>
        <label class="block font-medium text-gray-700 mb-1">Ticket Quota</label>
        <input type="number" name="quota" required min="1" class="w-full border border-pink-300 p-2 rounded focus:ring-2 focus:ring-bubblegum">
      </div>

      <div>
        <label class="block font-medium text-gray-700 mb-1">Price (IDR)</label>
        <input type="number" name="price" required class="w-full border border-pink-300 p-2 rounded focus:ring-2 focus:ring-bubblegum">
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
