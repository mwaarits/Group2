<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Purchased Tickets - Ticket Web</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            pinky: '#FCE7F3',
            softpink: '#F9A8D4',
            bubblegum: '#F472B6',
          }
        }
      }
    }
  </script>
</head>
<body class="bg-pinky min-h-screen">
  <div class="max-w-4xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-center text-bubblegum">Purchased Tickets</h1>
    
    <!-- Tickets Table -->
    <div class="overflow-x-auto">
      <table class="min-w-full bg-white border border-pink-200 rounded-lg shadow">
        <thead>
          <tr class="bg-softpink text-white">
            <th class="py-3 px-4 text-left text-sm font-semibold">Event Name</th>
            <th class="py-3 px-4 text-left text-sm font-semibold">Event Date</th>
            <th class="py-3 px-4 text-left text-sm font-semibold">Venue</th>
            <th class="py-3 px-4 text-left text-sm font-semibold">Ticket ID</th>
            <th class="py-3 px-4 text-left text-sm font-semibold">Ticket Type</th>
            <th class="py-3 px-4 text-left text-sm font-semibold">Quantity</th>
            <th class="py-3 px-4 text-left text-sm font-semibold">Price</th>
          </tr>
        </thead>
        <tbody>
          @forelse($orders as $item)
            <tr class="border-b hover:bg-pinky">
              <td class="py-3 px-4 text-sm text-gray-700">{{ $item->event->title }}</td>
              <td class="py-3 px-4 text-sm text-gray-700">{{ $item->event->startDateTime }}</td>
              <td class="py-3 px-4 text-sm text-gray-700">{{ $item->event->venue->name }}</td>
              <td class="py-3 px-4 text-sm text-gray-700">{{ $item->id }}</td>
              <td class="py-3 px-4 text-sm text-gray-700">{{ $item->ticket->name }}</td>
              <td class="py-3 px-4 text-sm text-gray-700">{{ $item->quantity }}</td>
              <td class="py-3 px-4 text-sm text-gray-700">{{ $item->unitPrice }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center py-6 text-gray-500">
                You haven't purchased any tickets yet.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Back to Home Button -->
    <div class="mt-6 text-center">
      <a href="/home" class="inline-block bg-bubblegum text-white font-medium py-2 px-4 rounded hover:bg-pink-600 transition">
        ← Back to Home
      </a>
    </div>
  </div>
</body>
</html>
