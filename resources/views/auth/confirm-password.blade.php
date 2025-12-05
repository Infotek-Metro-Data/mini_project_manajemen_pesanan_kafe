<x-guest-layout>
    <div class="min-h-screen w-full flex items-center justify-center bg-cover bg-center relative"
        style="background-image: url('https://images.unsplash.com/photo-1511920170033-f8396924c348?auto=format&fit=crop&w=1400&q=80');">

        <!-- Overlay -->
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>

        <!-- Card -->
        <div class="relative w-full max-w-md px-6">
            <div class="bg-white/10 backdrop-blur-2xl p-6 sm:p-8 rounded-2xl shadow-2xl border border-white/20 
                        text-white transition transform hover:scale-[1.01] hover:shadow-white/20 duration-300">

                <!-- Title -->
                <div class="text-center mb-6">
                    <h1 class="text-3xl font-extrabold drop-shadow">Lupa Password?</h1>
                    <p class="text-sm text-white/80 mt-2 leading-relaxed">
                        Masukkan email kamu dan kami akan mengirimkan link reset password.
                    </p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4 text-green-200 text-sm" :status="session('status')" />

                <!-- FORM -->
                <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label class="text-sm font-medium">Email</label>
                        <x-text-input 
                            id="email" 
                            type="email" 
                            name="email" 
                            :value="old('email')" 
                            required 
                            autofocus
                            class="mt-1 block w-full px-4 py-3 bg-white text-black !text-black placeholder-black/50
                                   rounded-xl border border-gray-300 shadow 
                                   focus:ring-2 focus:ring-yellow-300 focus:border-yellow-300 transition" />
                        <x-input-error :messages="$errors->get('email')" class="text-red-200 mt-1" />
                    </div>

                    <!-- Button -->
                    <button type="submit"
                        class="w-full bg-yellow-300 text-black font-semibold py-3 rounded-xl shadow-lg 
                               hover:bg-yellow-400 hover:shadow-yellow-200 transition duration-200">
                        Kirim Link Reset Password
                    </button>

                </form>

                <!-- Back to Login -->
                <div class="text-center mt-6">
                    <a href="{{ route('login') }}" 
                       class="text-white/90 hover:underline hover:text-yellow-300 transition text-sm">
                        Kembali ke Login
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-guest-layout>
