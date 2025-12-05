<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Cafe Cimara</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                    },
                    colors: {
                        coffee: {
                            50: '#fdf8f6',
                            100: '#f2e8e5',
                            600: '#8c6b5d',
                            800: '#4b3621',
                            900: '#2a1e13',
                        },
                        gold: {
                            500: '#d4af37',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        .fade-in-up {
            animation: fadeInUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
            opacity: 0;
            transform: translateY(20px);
        }
        @keyframes fadeInUp { to { opacity: 1; transform: translateY(0); } }
    </style>
</head>

<body class="bg-coffee-50 min-h-screen flex items-center justify-center p-0 m-0">

    <div class="w-full h-screen flex overflow-hidden bg-white shadow-2xl">
        
        <div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-8 md:p-12 bg-white relative overflow-y-auto">
            
            <div class="w-full max-w-md fade-in-up py-10">
                
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-coffee-100 text-coffee-800 mb-3">
                        <i class="text-2xl">☕</i>
                    </div>
                    <h1 class="text-3xl font-serif font-bold text-coffee-900">Bergabung Bersama Kami</h1>
                    <p class="text-gray-500 mt-2 text-sm">Nikmati kemudahan memesan kopi favoritmu.</p>
                </div>

                @if($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-700 p-4 text-sm rounded-r">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1 ml-1">Nama Lengkap</label>
                        <div class="relative">
                            <input type="text" name="name" required 
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-50 text-gray-900 focus:outline-none focus:ring-2 focus:ring-coffee-600 focus:bg-white transition-all pl-10"
                                placeholder="John Doe">
                            <span class="absolute left-3 top-3.5 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1 ml-1">Alamat Email</label>
                        <div class="relative">
                            <input type="email" name="email" required 
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-50 text-gray-900 focus:outline-none focus:ring-2 focus:ring-coffee-600 focus:bg-white transition-all pl-10"
                                placeholder="nama@email.com">
                            <span class="absolute left-3 top-3.5 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1 ml-1">Password</label>
                        <div class="relative">
                            <input type="password" name="password" required 
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-50 text-gray-900 focus:outline-none focus:ring-2 focus:ring-coffee-600 focus:bg-white transition-all pl-10"
                                placeholder="Minimal 6 karakter">
                            <span class="absolute left-3 top-3.5 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1 ml-1">Konfirmasi Password</label>
                        <div class="relative">
                            <input type="password" name="password_confirmation" required 
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-50 text-gray-900 focus:outline-none focus:ring-2 focus:ring-coffee-600 focus:bg-white transition-all pl-10"
                                placeholder="Ulangi password">
                            <span class="absolute left-3 top-3.5 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                        </div>
                    </div>

                    <button type="submit" 
                        class="w-full bg-coffee-800 text-white font-bold py-3.5 rounded-xl shadow-lg hover:bg-coffee-900 hover:shadow-xl transition transform hover:-translate-y-0.5 duration-200 mt-6">
                        Daftar Sekarang
                    </button>

                </form>

                <div class="mt-8 text-center">
                    <p class="text-sm text-gray-600">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-coffee-800 font-bold hover:underline hover:text-gold-500 transition">
                            Login disini
                        </a>
                    </p>
                </div>

            </div>
        </div>

        <div class="hidden lg:block w-1/2 relative">
            <img src="https://images.unsplash.com/photo-1497935586351-b67a49e012bf?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" 
                 alt="Latte Art" 
                 class="absolute inset-0 w-full h-full object-cover">
            
            <div class="absolute inset-0 bg-coffee-900/30 backdrop-grayscale-[20%]"></div>

            <div class="absolute top-0 right-0 p-12 text-white z-10 text-right">
                <h2 class="text-5xl font-serif font-bold mb-4 leading-tight">Crafted with <br>Passion.</h2>
                <p class="text-lg font-light opacity-90">Jadilah bagian dari komunitas pecinta kopi kami.</p>
            </div>
        </div>

    </div>

</body>
</html>