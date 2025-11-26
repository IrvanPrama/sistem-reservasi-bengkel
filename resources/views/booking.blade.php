<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Reservasi Bengkel</title>

<!-- Tailwind -->
<script src="https://cdn.tailwindcss.com"></script>

<style>
    body{
        background: linear-gradient(130deg,#0c4b8a,#1c65b9,#001e3c);
        font-family: 'Poppins',sans-serif;
        scroll-behavior:smooth;
    }

    /* fade muncul saat halaman dibuka */
    .fade { opacity:0; transform:translateY(25px); animation:fadeUp 0.8s forwards; }
    @keyframes fadeUp { to { opacity:1; transform:translateY(0);} }
</style>
</head>
<body>

<!-- Navbar -->
<nav class="fixed top-0 w-full backdrop-blur-xl bg-white/10 border-b border-white/20 shadow-md z-50 fade">
    <div class="max-w-6xl mx-auto flex justify-between items-center px-4 py-3">
        <h1 class="text-2xl font-extrabold text-white">BENGKEL BAGUS</h1>

        <ul class="hidden md:flex gap-8 text-white font-semibold text-sm tracking-widest">
            <li><a href="/" class="hover:text-yellow-300 duration-300">HOME</a></li>
            <li><a href="#kontak" class="hover:text-yellow-300 duration-300">KONTAK</a></li>
            <li><a href="/admin/login" class="hover:text-yellow-300 duration-300">MASUK</a></li>
        </ul>
    </div>
</nav>

<!-- Form -->
<section id="booking" class="min-h-screen flex items-center justify-center px-5 fade pt-24">

    <div class="w-full max-w-xl bg-white/10 backdrop-blur-xl border border-white/20
                rounded-2xl p-9 shadow-[0_10px_40px_rgba(0,0,0,0.45)]">

        <h2 class="text-center text-3xl font-bold text-white mb-9 tracking-wide">
            Reservasi Bengkel Online
        </h2>

        <form action="{{ route('reservasi.store') }}" method="POST" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 gap-4 text-left">

                @php $fields = ['nama_pelanggan'=>'Nama Pelanggan','no_telepon'=>'No Telepon / Whatsapp','email'=>'Email (opsional)',
                'merek'=>'Jenis Kendaraan','alamat'=>'Alamat','no_plat'=>'Nomor Plat Kendaraan','tahun'=>'Tahun Kendaraan']; @endphp
                
                @foreach($fields as $name=>$label)
                <div>
                    <label class="text-white font-semibold">{{ $label }}</label>
                    <input type="{{ $name=='email' ? 'email' : ($name=='tahun'?'number':'text') }}" name="{{ $name }}"
                        class="w-full bg-white/90 border-l-4 border-yellow-400 p-3 rounded-xl text-gray-900
                               focus:ring-2 focus:ring-yellow-400 hover:scale-[1.02] transition-all duration-300 shadow-sm"
                        required="{{ $name!='email' ? 'true' : 'false' }}">
                </div>
                @endforeach

                <div>
                    <label class="text-white font-semibold">Keluhan Kendaraan</label>
                    <input type="text" name="keluhan"
                           class="w-full bg-white/90 border-l-4 border-yellow-400 p-3 rounded-xl text-gray-900
                                  focus:ring-2 focus:ring-yellow-400 hover:scale-[1.02] transition-all duration-300 shadow-sm">
                </div>

                <div>
                    <label class="text-white font-semibold">Tanggal Reservasi</label>
                    <input type="date" name="tanggal" required
                           class="w-full bg-white/90 border-l-4 border-yellow-400 p-3 rounded-xl text-gray-900 
                                  focus:ring-2 focus:ring-yellow-400 hover:scale-[1.02] transition-all duration-300 shadow-sm">
                </div>

                <div>
                    <label class="text-white font-semibold">Jam Reservasi</label>
                    <input type="time" name="jam_kedatangan" required
                           class="w-full bg-white/90 border-l-4 border-yellow-400 p-3 rounded-xl text-gray-900 
                                  focus:ring-2 focus:ring-yellow-400 hover:scale-[1.02] transition-all duration-300 shadow-sm">
                </div>

                <div>
                    <label class="text-white font-semibold">Catatan Tambahan</label>
                    <textarea name="keterangan" rows="3"
                              class="w-full bg-white/90 border-l-4 border-yellow-400 p-3 rounded-xl text-gray-900 
                                     focus:ring-2 focus:ring-yellow-400 hover:scale-[1.02] transition-all duration-300 shadow-sm"></textarea>
                </div>

            </div>

            <button class="w-full mt-4 bg-yellow-400 text-blue-900 font-bold py-3 rounded-xl 
                           text-xl tracking-wide shadow-lg hover:bg-yellow-300 hover:scale-[1.03]
                           transition-all duration-300">
                Kirim Reservasi
            </button>
        </form>
    </div>
</section>

<!-- Footer Kontak -->
<section id="kontak" class="text-center mt-8 mb-12 fade">
    <p class="text-white/85 text-lg">Butuh respon cepat?</p>
    <a href="https://wa.me/6281234567890" target="_blank"
       class="inline-block mt-3 bg-green-500 hover:bg-green-400 text-white font-bold py-3 px-8 rounded-full text-lg shadow-md transition-all">
        Chat via WhatsApp 
    </a>
</section>

</body>
</html>
