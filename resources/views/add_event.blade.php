<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Add Event</title>
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
<body class="bg-pinky min-h-screen flex justify-center items-center px-4 py-8">
  <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-xl border border-pink-200">
    <h2 class="text-3xl font-extrabold text-center text-bubblegum mb-6">➕ Add New Event</h2>

    <form method="POST" enctype="multipart/form-data" action="/add/event" class="space-y-5">
      @csrf
      @if (!empty($event?->id))
        <input type="hidden" name="id" value="{{ $event->id }}">
      @endif

      <div>
        <label class="block font-medium text-gray-700">Event Title</label>
        <input type="text" name="title" required class="w-full border border-pink-300 p-2 rounded focus:ring-2 focus:ring-bubblegum" value="{{ $event->title ?? old('title') }}">
      </div>

      <div>
        <label class="block font-medium text-gray-700">Description</label>
        <textarea name="description" required class="w-full border border-pink-300 p-2 rounded focus:ring-2 focus:ring-bubblegum">{{ $event->description ?? old('description') }}</textarea>
      </div>

      <div>
        <label class="block font-medium text-gray-700">Start Time</label>
        <input type="datetime-local" name="startDateTime" required class="w-full border border-pink-300 p-2 rounded focus:ring-2 focus:ring-bubblegum"
               value="{{ isset($event) ? \Carbon\Carbon::parse($event->startDateTime)->format('Y-m-d\TH:i') : old('startDateTime') }}">
      </div>

      <div>
        <label class="block font-medium text-gray-700">End Time</label>
        <input type="datetime-local" name="endDateTime" required class="w-full border border-pink-300 p-2 rounded focus:ring-2 focus:ring-bubblegum"
               value="{{ isset($event) ? \Carbon\Carbon::parse($event->endDateTime)->format('Y-m-d\TH:i') : old('endDateTime') }}">
      </div>

      <div>
        <label class="block font-medium text-gray-700">Venue</label>
        <select name="venue_id" required class="w-full border border-pink-300 p-2 rounded">
          <option value="">-- Select Venue --</option>
          @foreach ($venues as $v)
            <option value="{{ $v->id }}" {{ isset($event) && $event->venue_id == $v->id ? 'selected' : '' }}>
              {{ $v->name }}
            </option>
          @endforeach
        </select>
      </div>

      <div>
        <label class="block font-medium text-gray-700">Category</label>
        <select name="category_id" class="w-full border border-pink-300 p-2 rounded">
          <option value="">-- Select Category --</option>
          @foreach ($categories as $c)
            <option value="{{ $c->id }}" {{ isset($event) && $event->category_id == $c->id ? 'selected' : '' }}>
              {{ $c->name }}
            </option>
          @endforeach
        </select>
      </div>

      <div>
        <label class="block font-medium text-gray-700">Event Image</label>
        <input type="file" name="image" accept="image/*" class="w-full border border-pink-300 p-2 rounded">
      </div>

      <button type="submit" class="w-full bg-bubblegum text-white py-2 px-4 rounded hover:bg-pink-500 transition">
        Save Event
      </button>
    </form>

    <div class="mt-6 text-center">
      <a href="/admin" class="text-bubblegum hover:underline">← Back to Dashboard</a>
    </div>
  </div>
</body>
</html>
  