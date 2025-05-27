<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Organizer Dashboard</title>
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
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="bg-pinky min-h-screen p-8 font-sans">

  <div class="max-w-5xl mx-auto">
    <header class="mb-10">
      <h1 class="text-4xl font-extrabold text-center text-bubblegum">Organizer Dashboard</h1>
      <p class="text-center text-gray-700 mt-2">Manage all your events, tickets, and venues in one place</p>
    </header>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @php
        $cards = [
          ['url' => '/event', 'emoji' => '➕', 'title' => 'Add Event', 'desc' => 'Create a new event to sell.'],
          ['url' => '/ticket', 'emoji' => '🎟️', 'title' => 'Add Ticket', 'desc' => 'Add tickets to an existing event.'],
          ['url' => '/venue', 'emoji' => '📍', 'title' => 'Add Venue', 'desc' => 'Add a venue for your events.'],
          ['url' => '/list', 'emoji' => '📋', 'title' => 'View Event List', 'desc' => 'See the list of your created events.'],
          ['url' => '/categories', 'emoji' => '📂', 'title' => 'Add Category', 'desc' => 'Add a new category for your events.'],
        ];
      @endphp

      @foreach ($cards as $card)
        <a href="{{ $card['url'] }}" class="bg-white rounded-2xl border-2 border-pink-200 shadow-md p-6 hover:shadow-lg transition-transform transform hover:-translate-y-1 hover:bg-softpink">
          <div class="text-4xl mb-2">{{ $card['emoji'] }}</div>
          <h2 class="text-xl font-semibold text-bubblegum mb-1">{{ $card['title'] }}</h2>
          <p class="text-sm text-gray-700">{{ $card['desc'] }}</p>
        </a>
      @endforeach
    </div>

    <div class="text-center mt-10">
      <a href="/logout" class="inline-block text-sm text-rose-500 font-medium hover:underline hover:text-rose-700 transition-colors">
        🚪 Logout
      </a>
    </div>
  </div>

</body>
</html>
