<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Event Details</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
<body class="bg-pinky min-h-screen p-6 font-sans">

  <div class="max-w-3xl mx-auto bg-white shadow-md rounded-2xl p-6 border border-pink-200">
    <h1 class="text-3xl font-bold text-bubblegum mb-4">{{ $events->title }}</h1>

    {{-- Category --}}
    @if ($events->category)
      <p class="text-sm text-gray-600 mb-2">
        <span class="font-medium">Category:</span>
        <span class="text-bubblegum font-semibold">{{ $events->category->name }}</span>
      </p>
    @endif

    {{-- Description --}}
    <div class="mb-4">
      <h2 class="text-lg font-semibold text-gray-700">Event Description:</h2>
      <p class="text-gray-800 mt-1">{{ $events->description }}</p>
    </div>

    {{-- Time --}}
    <div class="mb-4 text-gray-700">
      <p><strong>Start:</strong> {{ \Carbon\Carbon::parse($events->startDateTime)->format('d M Y H:i') }}</p>
      <p><strong>End:</strong> {{ \Carbon\Carbon::parse($events->endDateTime)->format('d M Y H:i') }}</p>
    </div>

    {{-- Alert Messages --}}
    @if (session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
      <span class="block sm:inline">{{ session('error') }}</span>
    </div>
    @endif

    {{-- Ticket Form --}}
    <h3 class="text-lg font-bold text-bubblegum mt-6 mb-2">Book Tickets</h3>
    <form action="/order" method="POST" class="space-y-4">
      @csrf
      <input type="hidden" name="event_id" value="{{ $events->id }}">

      <div>
        <label class="block font-medium mb-1">Ticket Type</label>
        <select name="ticket_type" id="ticket_type" required onchange="updateTicketInfo()" class="w-full border border-pink-300 rounded p-2">
          <option value="">-- Choose --</option>
          @foreach ($ticket as $item)
            <option value="{{ $item->id }}" 
                    data-price="{{ $item->price }}"
                    data-quota="{{ $item->getAvailableQuota() }}">
              {{ $item->name }} ({{ $item->getAvailableQuota() }} tickets left)
            </option>
          @endforeach
        </select>
      </div>

      <div>
        <label class="block font-medium">Price</label>
        <p class="text-gray-700" id="ticketPrice">-</p>
      </div>

      <div>
        <label class="block font-medium">Available Quota</label>
        <p class="text-gray-700" id="availableQuota">-</p>
      </div>

      <div>
        <label class="block font-medium" for="quantity">Ticket Quantity</label>
        <input type="number" name="quantity" id="quantity" min="1" required class="w-full border border-pink-300 p-2 rounded" />
        <p class="text-red-500 hidden" id="quotaError">The requested quantity exceeds available quota.</p>
      </div>

      <div>
        <label class="block font-medium">Total Price</label>
        <p class="text-bubblegum font-semibold" id="totalPrice">-</p>
      </div>

      <button type="submit" id="bookButton" class="bg-bubblegum hover:bg-pink-500 text-white px-4 py-2 rounded w-full transition">
        Book Now
      </button>
    </form>
  </div>

  <script>
    function updateTicketInfo() {
      const select = document.getElementById("ticket_type");
      const quantity = parseInt(document.getElementById("quantity").value) || 0;
      const price = parseFloat(select.options[select.selectedIndex]?.getAttribute("data-price")) || 0;
      const availableQuota = parseInt(select.options[select.selectedIndex]?.getAttribute("data-quota")) || 0;

      const hargaFormatted = price > 0 ? "Rp " + price.toLocaleString('id-ID') : "-";
      const total = price * quantity;
      const totalFormatted = total > 0 ? "Rp " + total.toLocaleString('id-ID') : "-";

      document.getElementById("ticketPrice").innerText = hargaFormatted;
      document.getElementById("totalPrice").innerText = totalFormatted;
      document.getElementById("availableQuota").innerText = availableQuota > 0 ? availableQuota + " tickets" : "Sold Out";

      // Validate quota
      validateQuota(quantity, availableQuota);
    }

    function validateQuota(quantity, availableQuota) {
      const errorElement = document.getElementById("quotaError");
      const bookButton = document.getElementById("bookButton");
      
      if (quantity > availableQuota) {
        errorElement.classList.remove("hidden");
        bookButton.disabled = true;
        bookButton.classList.add("opacity-50", "cursor-not-allowed");
      } else {
        errorElement.classList.add("hidden");
        bookButton.disabled = false;
        bookButton.classList.remove("opacity-50", "cursor-not-allowed");
      }
    }

    document.getElementById("quantity").addEventListener("input", function() {
      updateTicketInfo();
    });

    // Initialize the form
    document.addEventListener("DOMContentLoaded", function() {
      const select = document.getElementById("ticket_type");
      if (select.value) {
        updateTicketInfo();
      }
    });
  </script>
</body>
</html>