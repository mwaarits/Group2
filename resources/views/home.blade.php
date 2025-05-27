<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Home</title>
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
<body class="bg-pinky min-h-screen font-sans">

  <!-- Navbar -->
  <nav class="bg-white shadow-md">
    <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
      <!-- Logo -->
      <div class="text-xl font-bold text-bubblegum flex items-center gap-2">
        <img src="{{ asset('/logo.png') }}" alt="Logo" class="w-10 h-10" />
        <span class="hover:text-pink-600 transition">PRESTIX</span>
      </div>

      <!-- Filter  -->
      <form action="/home" method="GET" class="flex flex-wrap gap-3 items-center relative z-20">
        <!-- Search -->
        <input type="text" name="search" placeholder="🔍 Search events..."
          class="border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300"
          value="{{ request('search') }}">

        <!-- Category -->
        <div class="relative" id="kategoriWrapper">
          <button type="button"
            class="bg-softpink text-white px-4 py-2 rounded-lg hover:bg-pink-500 focus:outline-none">
            Category ▼
          </button>
          <div id="categoryDropdown"
            class="absolute z-20 hidden bg-white border mt-2 rounded-lg shadow-lg min-w-[180px] max-h-60 overflow-y-auto">
            <label class="block px-4 py-2 text-gray-700 hover:bg-pinky cursor-pointer">
              <input type="radio" name="category" value="" class="mr-2" onchange="this.form.submit()"
                {{ request('category') == '' ? 'checked' : '' }}>
              All Categories
            </label>
            @foreach($categories as $category)
              <label class="block px-4 py-2 text-gray-700 hover:bg-pinky cursor-pointer">
                <input type="radio" name="category" value="{{ $category->id }}" class="mr-2"
                  onchange="this.form.submit()" {{ request('category') == $category->id ? 'checked' : '' }}>
                {{ $category->name }}
              </label>
            @endforeach
          </div>
        </div>

        <!-- Price -->
        <div class="relative" id="priceWrapper">
          <button type="button"
            class="bg-softpink text-white px-4 py-2 rounded-lg hover:bg-pink-500 focus:outline-none">
            Price ▼
          </button>
          <div id="priceDropdown"
            class="absolute z-20 hidden bg-white border mt-2 rounded-lg shadow-lg p-4 space-y-2 w-52">
            <input type="number" name="min_price" placeholder="Min Price"
              class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-pink-300"
              value="{{ request('min_price') }}">
            <input type="number" name="max_price" placeholder="Max Price"
              class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-pink-300"
              value="{{ request('max_price') }}">
            <button type="submit"
              class="w-full bg-softpink text-white py-2 rounded hover:bg-pink-500 mt-2">Apply</button>
          </div>
        </div>
      </form>

      <script>
        let hideTimers = {};

        function showDropdown(id) {
          clearTimeout(hideTimers[id]);
          document.getElementById(id).classList.remove('hidden');
        }

        function hideDropdown(id) {
          hideTimers[id] = setTimeout(() => {
            document.getElementById(id).classList.add('hidden');
          }, 200);
        }

        document.addEventListener('DOMContentLoaded', () => {
          const dropdowns = [
            { wrapperId: 'kategoriWrapper', dropdownId: 'categoryDropdown' },
            { wrapperId: 'priceWrapper', dropdownId: 'priceDropdown' },
          ];

          dropdowns.forEach(({ wrapperId, dropdownId }) => {
            const wrapper = document.getElementById(wrapperId);
            wrapper.addEventListener('mouseenter', () => showDropdown(dropdownId));
            wrapper.addEventListener('mouseleave', () => hideDropdown(dropdownId));
          });
        });
      </script>
      <!-- ----------------------------------------------------------------------------------- -->

      <!-- Nav Links -->
      <div class="space-x-4 text-sm">
        <a href="/detail/order" class="text-pink-600 hover:underline">Ordered Tickets</a>
        <a href="/logout" class="text-rose-600 hover:underline">Logout</a>
      </div>
    </div>
  </nav>

  <!-- Carousel -->
  @php
  use Illuminate\Support\Facades\File;
  $photoPaths = File::files(public_path('photos'));
  @endphp

  @if(count($photoPaths) > 0)
  <div class="relative w-full max-w-6xl mx-auto mt-6 overflow-hidden rounded-2xl shadow-lg group">
    <div id="carousel" class="flex transition-transform duration-700 ease-in-out">
      @foreach($photoPaths as $photo)
        <img 
          src="{{ asset('photos/' . $photo->getFilename()) }}" 
          alt="Carousel Image" 
          class="w-full flex-shrink-0 object-cover h-[225px]" />
      @endforeach
    </div>
    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex gap-2">
      @foreach($photoPaths as $i => $photo)
        <button class="w-3 h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-80 transition" onclick="goToSlide({{ $i }})"></button>
      @endforeach
    </div>
  </div>

  <script>
    let index = 0;
    const carousel = document.getElementById('carousel');
    const slides = carousel.children;
    const slideCount = slides.length;

    function goToSlide(i) {
      index = i;
      carousel.style.transform = `translateX(-${index * 100}%)`;
    }

    setInterval(() => {
      index = (index + 1) % slideCount;
      carousel.style.transform = `translateX(-${index * 100}%)`;
    }, 3000);
  </script>
  @endif

 

  <!-- ---------------------------------------------------------------------------------------------- -->




  <div class="max-w-6xl mx-auto px-4 py-8">
    <h1 class="text-4xl font-extrabold mb-6 text-center text-bubblegum">Available Events</h1>

    @if ($events->count())
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($events as $event)
        <div class="bg-white rounded-2xl shadow hover:shadow-xl transition overflow-hidden border-2 border-pink-200 flex flex-col h-full">
          <a href="{{ url('/event/' . $event->id) }}">
            @if ($event->image && file_exists(public_path('photos/' . $event->image)))
              <img src="{{ asset('photos/' . $event->image) }}" alt="Event Image" class="w-full h-48 object-cover rounded-t-2xl">
            @else
              <img src="https://via.placeholder.com/640x360?text=No+Image" alt="No Image" class="w-full h-48 object-cover rounded-t-2xl">
            @endif
          </a>
          <div class="p-4 flex flex-col justify-between flex-grow">
            <div>
              <h2 class="text-lg font-bold text-pink-700 mb-2">{{ $event->title ?? '-' }}</h2>
              <p class="text-sm text-gray-700 mb-1">
                📅 <strong>Date:</strong> {{ \Carbon\Carbon::parse($event->startDateTime)->format('d M Y H:i') }}
              </p>
              <p class="text-sm text-gray-700 mb-1">
                📍 <strong>Location:</strong> {{ $event->venue->name ?? 'Not yet specified' }}
              </p>
              @if($event->category)
                <span class="inline-block mt-2 text-xs bg-pink-100 text-pink-700 px-3 py-1 rounded-full">
                  🏷️ {{ $event->category->name }}
                </span>
              @endif
            </div>

            <!-- Button -->
            <a href="{{ url('/event/' . $event->id ) }}"
              class="mt-4 inline-block text-center bg-pink-400 hover:bg-pink-500 text-white font-semibold py-2 px-4 rounded-full shadow transition">
               Buy Ticket
            </a>
          </div>
        </div>
        @endforeach
      </div>
    @else
      <p class="text-center text-gray-500 mt-10">✨ No events are currently available. Stay tuned! ✨</p>
    @endif
  </div>

</body>








<!-- Footerrrrrr -->
<footer class="bg-white border-t mt-10">
  <div class="max-w-6xl mx-auto px-4 py-8 grid grid-cols-1 md:grid-cols-3 gap-8 text-sm text-gray-700">
    

    <div>
      <h2 class="text-xl font-bold text-bubblegum mb-2">GrabYourTicket</h2>
      <p class="text-gray-600">An easy and fast event ticket booking platform. Find your favorite event today!</p>
    </div>


    <div>
      <h3 class="font-semibold mb-2">Navigation</h3>
      <ul class="space-y-1">
        <li><a href="/home" class="hover:text-pink-500">Home</a></li>
        <li><a href="/detail/order" class="hover:text-pink-500">Ordered Tickets</a></li>
      </ul>
    </div>


    <div>
      <h3 class="font-semibold mb-2">Contact Us</h3>
      <p>Email: <a href="mailto:support@grabyourticket.com" class="text-pink-600 hover:underline">support@grabyourticket.com</a></p>
      <p>Instagram: <a href="https://instagram.com/grabyourticket" target="_blank" class="text-pink-600 hover:underline">@grabyourticket</a></p>
    </div>
  </div>

  <div class="bg-white text-center text-pink-600 py-4 text-xs">
    &copy; {{ date('Y') }} GrabYourTicket. All rights reserved.
  </div>
</footer>
</html>
