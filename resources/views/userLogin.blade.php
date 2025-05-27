<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>User Login</title>
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
    <h2 class="text-3xl font-bold text-center text-bubblegum mb-6">User Login</h2>

    @if (!empty($error))
      <p class="text-red-500 text-sm mb-4">{{ $error }}</p>
    @endif

    <form method="post" action="/user/login" class="space-y-4">
      @csrf
      <div>
        <label class="block text-sm font-medium text-gray-700">Email</label>
        <input 
          type="email" 
          name="email" 
          required 
          class="w-full px-4 py-2 border border-pink-300 rounded-md focus:outline-none focus:ring-2 focus:ring-bubblegum focus:border-transparent" />
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Password</label>
        <input 
          type="password" 
          name="password" 
          required 
          class="w-full px-4 py-2 border border-pink-300 rounded-md focus:outline-none focus:ring-2 focus:ring-bubblegum focus:border-transparent" />
      </div>

      <button 
        type="submit" 
        class="w-full bg-bubblegum hover:bg-pink-500 text-white font-semibold py-2 px-4 rounded-md transition">
        Login
      </button>
    </form>

    <p class="text-center mt-4 text-sm text-gray-600">
      Don’t have an account? 
      <a href="/user/regist" class="text-bubblegum hover:underline">Register here</a>
    </p>
    <p class="text-center mt-2 text-sm text-gray-600">
      <a href="/admin/login" class="text-bubblegum hover:underline">Login as admin</a>
    </p>
  </div>
  
</body>
</html>
