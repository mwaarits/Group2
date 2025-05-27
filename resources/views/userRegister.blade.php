<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>User Registration</title>
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
<body class="bg-pinky min-h-screen flex items-center justify-center font-sans">

  <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-md border border-pink-200">
    <h2 class="text-3xl font-bold text-center text-bubblegum mb-6">User Registration</h2>

    @if ($errors->any())
      <div class="mb-4 text-red-600 text-sm">
        <ul class="list-disc list-inside">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="/user/regist" class="space-y-4">
      @csrf

      <div>
        <label class="block mb-1 font-medium text-gray-700">Full Name</label>
        <input type="text" name="fullname" required 
          class="w-full px-4 py-2 border border-pink-300 rounded-md focus:outline-none focus:ring-2 focus:ring-bubblegum" 
          value="{{ old('fullname') }}" />
      </div>

      <div>
        <label class="block mb-1 font-medium text-gray-700">Email</label>
        <input type="email" name="email" required 
          class="w-full px-4 py-2 border border-pink-300 rounded-md focus:outline-none focus:ring-2 focus:ring-bubblegum" 
          value="{{ old('email') }}" />
      </div>

      <div>
        <label class="block mb-1 font-medium text-gray-700">Phone Number</label>
        <input type="text" name="phoneNumber" required 
          class="w-full px-4 py-2 border border-pink-300 rounded-md focus:outline-none focus:ring-2 focus:ring-bubblegum" 
          value="{{ old('phoneNumber') }}" />
      </div>

      <div>
        <label class="block mb-1 font-medium text-gray-700">Password</label>
        <input type="password" name="password" required 
          class="w-full px-4 py-2 border border-pink-300 rounded-md focus:outline-none focus:ring-2 focus:ring-bubblegum" />
      </div>

      <button type="submit" 
        class="w-full bg-bubblegum hover:bg-pink-500 text-white font-semibold py-2 px-4 rounded-md transition">
        Register
      </button>
    </form>

    <p class="text-center mt-4 text-sm text-gray-600">
      Already have an account? <a href="/" class="text-bubblegum hover:underline">Login here</a>
    </p>
  </div>

</body>
</html>
