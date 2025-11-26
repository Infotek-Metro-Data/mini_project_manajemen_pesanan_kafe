<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Cafe Cimara</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Poppins:wght@300;400;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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
        .animate-fade-up {
            animation: fadeUp 1s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        .delay-100 {
            animation-delay: 0.2s;
        }

        .delay-200 {
            animation-delay: 0.4s;
        }

        .delay-300 {
            animation-delay: 0.6s;
        }

        @keyframes fadeUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .floating {
            animation: float 4s ease-in-out infinite;
        }
    </style>
</head>

<body class="antialiased text-white font-sans overflow-hidden">

    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1509042239860-f550ce710b93?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80"
            alt="Cafe Background" class="w-full h-full object-cover object-center scale-105">
        <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/50 to-transparent"></div>
    </div>

    <nav class="relative z-20 w-full py-6 px-6 md:px-12 flex justify-between items-center">
        <div class="flex items-center gap-3 animate-fade-up">
            <div class="bg-white/10 p-2 rounded-lg backdrop-blur-sm border border-white/20">
                <i class="fas fa-mug-hot text-2xl text-gold-500"></i>
            </div>
            <span class="text-2xl font-serif font-bold tracking-wide">Cafe<span
                    class="text-gold-500">Cimara</span></span>
        </div>

        <div class="animate-fade-up delay-100 hidden md:block">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm font-semibold hover:text-gold-500 transition">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold hover:text-gold-500 transition mr-6">Masuk</a>
                    <a href="{{ route('register') }}"
                        class="px-5 py-2.5 rounded-full bg-gold-500 text-black font-bold text-sm hover:bg-white transition shadow-lg hover:shadow-gold-500/50">
                        Daftar Sekarang
                    </a>
                @endauth
            @endif
        </div>
    </nav>

    <main class="relative z-10 h-screen flex flex-col justify-center px-6 md:px-12 max-w-4xl">

        <div class="space-y-6">
            <div class="inline-block animate-fade-up">
                <span
                    class="py-1 px-3 rounded-full bg-white/10 border border-white/20 backdrop-blur-md text-xs font-bold tracking-widest uppercase text-gold-500">
                    Premium Coffee & Dining
                </span>
            </div>

            <h1 class="text-5xl md:text-7xl font-serif font-black leading-tight animate-fade-up delay-100">
                Rasakan Hangatnya <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-gold-500 to-amber-200">Cita Rasa
                    Sejati.</span>
            </h1>

            <p class="text-lg md:text-xl text-gray-300 max-w-xl font-light leading-relaxed animate-fade-up delay-200">
                Nikmati perpaduan biji kopi pilihan dan suasana nyaman.
                Cafe Cimara menghadirkan pengalaman kuliner yang tak terlupakan.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 pt-4 animate-fade-up delay-300">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="px-8 py-4 rounded-full bg-gold-500 text-black font-bold text-lg hover:bg-white transition transform hover:scale-105 shadow-xl shadow-gold-500/20 flex items-center justify-center gap-2">
                        <span>Masuk Dashboard</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="px-8 py-4 rounded-full bg-gold-500 text-black font-bold text-lg hover:bg-white transition transform hover:scale-105 shadow-xl shadow-gold-500/20 flex items-center justify-center gap-2">
                        <span>Pesan Sekarang</span>
                        <i class="fas fa-mug-hot"></i>
                    </a>
                    <a href="{{ route('register') }}"
                        class="px-8 py-4 rounded-full bg-transparent border border-white/30 text-white font-bold text-lg hover:bg-white/10 backdrop-blur-sm transition flex items-center justify-center">
                        Buat Akun
                    </a>
                @endauth
            </div>
        </div>

        <div class="absolute bottom-10 right-10 hidden lg:block floating">
            <div
                class="bg-black/40 backdrop-blur-md p-6 rounded-2xl border border-white/10 flex items-center gap-4 max-w-xs">
                <div class="bg-green-500/20 p-3 rounded-full text-green-400">
                    <i class="fas fa-star text-xl"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold">4.9/5</p>
                    <p class="text-xs text-gray-400">Rating Kepuasan Pelanggan</p>
                </div>
            </div>
        </div>

    </main>

    <div class="absolute bottom-6 left-0 w-full text-center z-20 opacity-50 text-xs font-light">
        &copy; {{ date('Y') }} Cafe Cimara. Crafted with Passion.
    </div>

</body>

</html>