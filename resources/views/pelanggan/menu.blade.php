<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Pelanggan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-5xl mx-auto py-10">
        <h1 class="text-3xl font-bold mb-6">Menu Cafe</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            @foreach ($menus as $menu)
            <div class="bg-white rounded-xl shadow p-4">
                <img src="{{ $menu->image ?? 'https://via.placeholder.com/300' }}"
                     class="w-full h-40 object-cover rounded-lg mb-3">

                <h2 class="text-xl font-semibold">{{ $menu->nama }}</h2>
                <p class="text-gray-500 text-sm">{{ $menu->deskripsi }}</p>

                <div class="mt-3 font-bold text-lg">
                    Rp {{ number_format($menu->harga, 0, ',', '.') }}
                </div>

                <form action="{{ route('pelanggan.pesan', $menu->id) }}" method="POST">
                    @csrf
                    <button
                        class="mt-4 w-full bg-amber-600 text-white py-2 rounded-lg hover:bg-amber-700">
                        Tambah ke Pesanan
                    </button>
                </form>
            </div>
            @endforeach

        </div>
    </div>

</body>
</html>
