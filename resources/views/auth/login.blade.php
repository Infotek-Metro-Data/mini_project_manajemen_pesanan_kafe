<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cafe Cimara</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">

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

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .delay-100 {
            animation-delay: 0.1s;
        }

        .delay-200 {
            animation-delay: 0.2s;
        }

        .delay-300 {
            animation-delay: 0.3s;
        }
    </style>
</head>

<body class="bg-coffee-50 min-h-screen flex items-center justify-center p-0 m-0">

    <div class="w-full h-screen flex overflow-hidden bg-white shadow-2xl">

        <div class="hidden lg:block w-1/2 relative">
            <img src="https://images.unsplash.com/photo-1509042239860-f550ce710b93?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80"
                alt="Cafe Atmosphere" class="absolute inset-0 w-full h-full object-cover">

            <div class="absolute inset-0 bg-coffee-900/40"></div>

            <div class="absolute bottom-0 left-0 p-12 text-white z-10">
                <h2 class="text-5xl font-serif font-bold mb-4">Start your day with perfect coffee.</h2>
                <p class="text-lg font-light opacity-90">Nikmati setiap tegukan, rasakan kehangatannya.</p>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-8 md:p-12 bg-white relative">

            <div class="absolute top-0 right-0 opacity-5 pointer-events-none">
                <svg width="200" height="200" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                    <path fill="#4B3621"
                        d="M45.7,-76.3C58.9,-69.3,69.1,-56.3,77.1,-42.4C85.1,-28.5,90.9,-13.7,89.3,0.5C87.7,14.7,78.7,28.3,68.9,40.8C59.1,53.3,48.5,64.7,35.7,71.2C22.9,77.7,7.9,79.3,-6.1,77.9C-20.1,76.5,-33.1,72.1,-45.3,64.7C-57.5,57.3,-68.9,46.9,-76.1,34.2C-83.3,21.5,-86.3,6.5,-83.7,-7.6C-81.1,-21.7,-72.9,-34.9,-62.3,-44.9C-51.7,-54.9,-38.7,-61.7,-25.9,-69.1C-13.1,-76.5,-0.5,-84.5,13.6,-82.8C27.7,-81.1,42.5,-70.8,45.7,-76.3Z"
                        transform="translate(100 100)" />
                </svg>
            </div>

            <div class="w-full max-w-md fade-in-up">

                <div class="text-center mb-8">
                    <div
                        class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-coffee-100 text-coffee-800 mb-4">
                        <i class="text-3xl">☕</i>
                    </div>
                    <h1 class="text-3xl font-serif font-bold text-coffee-900">Cafe Cimara</h1>
                    <p class="text-gray-500 mt-2">Silakan login untuk melanjutkan</p>
                </div>

                @if($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-700 p-4 text-sm rounded-r" role="alert">
                        <p class="font-bold">Oops!</p>
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-5">
                    @csrf

                    <div class="group">
                        <label class="block text-sm font-medium text-gray-700 mb-1 ml-1">Alamat Email</label>
                        <div class="relative">
                            <input type="email" name="email" required
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-50 text-gray-900 focus:outline-none focus:ring-2 focus:ring-coffee-600 focus:bg-white transition-all pl-10"
                                placeholder="nama@email.com">
                            <span class="absolute left-3 top-3.5 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1 ml-1">Password</label>
                        <div class="relative">
                            <input type="password" name="password" required
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-50 text-gray-900 focus:outline-none focus:ring-2 focus:ring-coffee-600 focus:bg-white transition-all pl-10"
                                placeholder="••••••••">
                            <span class="absolute left-3 top-3.5 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1 ml-1">Masuk Sebagai</label>
                        <div class="relative">
                            <select name="role" required
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-50 text-gray-900 focus:outline-none focus:ring-2 focus:ring-coffee-600 focus:bg-white transition-all pl-10 appearance-none cursor-pointer">
                                <option value="">-- Pilih Akses --</option>
                                <option value="admin">Admin</option>
                                <option value="kasir">Kasir</option>
                                <option value="pelanggan">Pelanggan</option>
                            </select>
                            <span class="absolute left-3 top-3.5 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </span>
                            <span class="absolute right-4 top-4 text-gray-400 pointer-events-none">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </span>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-coffee-800 text-white font-bold py-3.5 rounded-xl shadow-lg hover:bg-coffee-900 hover:shadow-xl transition transform hover:-translate-y-0.5 duration-200">
                        Masuk Sekarang
                    </button>

                </form>

                <div class="mt-8 text-center">
                    <p class="text-sm text-gray-600">
                        Belum menjadi member?
                        <a href="{{ route('register') }}"
                            class="text-coffee-800 font-bold hover:underline hover:text-gold-500 transition">
                            Daftar Akun
                        </a>
                    </p>
                </div>

            </div>
        </div>
    </div>

</body>

</html>