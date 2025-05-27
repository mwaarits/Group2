<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Event List</title>
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
<body class="bg-pinky min-h-screen p-6">
  <div class="max-w-6xl mx-auto">
    <h1 class="text-4xl font-extrabold text-bubblegum text-center mb-8">🎉 Event List</h1>

    @if (session('success'))
      <div class="bg-green-100 text-green-800 border border-green-300 px-4 py-3 rounded mb-4">
        {{ session('success') }}
      </div>
    @endif
    @if (session('error'))
      <div class="bg-red-100 text-red-800 border border-red-300 px-4 py-3 rounded mb-4">
        {{ session('error') }}
      </div>
    @endif

    <div class="overflow-x-auto">
      <table class="w-full table-auto bg-white shadow-md rounded-lg">
        <thead class="bg-softpink text-pink-900">
          <tr>
            <th class="px-4 py-2 text-left">Title</th>
            <th class="px-4 py-2 text-left">Description</th>
            <th class="px-4 py-2 text-left">Start Date</th>
            <th class="px-4 py-2 text-left">End Date</th>
            <th class="px-4 py-2 text-left">Venue</th>
            <th class="px-4 py-2 text-left">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($events as $event)
            <tr class="border-t hover:bg-pinky/50">
              <td class="px-4 py-2">{{ $event->title }}</td>
              <td class="px-4 py-2 truncate max-w-xs">{{ $event->description }}</td>
              <td class="px-4 py-2">{{ \Carbon\Carbon::parse($event->startDateTime)->format('d M Y H:i') }}</td>
              <td class="px-4 py-2">{{ \Carbon\Carbon::parse($event->endDateTime)->format('d M Y H:i') }}</td>
              <td class="px-4 py-2">{{ $event->venue->name ?? '-' }}</td>
              <td class="px-4 py-2 space-x-2">
                <a href="/update/event/{{ $event->id }}" class="text-bubblegum hover:underline">✏️ Edit</a>
                <a href="/delete/event/{{ $event->id }}"
                   onclick="return confirm('Are you sure you want to delete this event?')"
                   class="text-red-600 hover:underline">🗑️ Delete</a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center text-gray-600 py-4">No events available.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-6 text-center">
      <a href="/admin" class="text-bubblegum hover:underline">← Back to Dashboard</a>
    </div>
  </div>
</body>
</html>
