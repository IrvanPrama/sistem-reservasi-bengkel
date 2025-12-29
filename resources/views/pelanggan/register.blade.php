<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Pendaftaran Member | KADEK MOTOR</title>

<script src="https://cdn.tailwindcss.com"></script>

<style>
    body{
        background: linear-gradient(130deg,#0c4b8a,#1c65b9,#001e3c);
        font-family: 'Poppins',sans-serif;
        scroll-behavior:smooth;
    }

    /* Animasi Fade */
    .fade { opacity:0; transform:translateY(25px); animation:fadeUp 0.8s forwards; }
    @keyframes fadeUp { to { opacity:1; transform:translateY(0);} }

    /* Mobile Sidebar Overlay */
    .sidebar{
        position:fixed; top:0; right:-270px;
        width:260px; height:100vh;
        background:rgba(255,255,255,0.12);
        backdrop-filter:blur(18px);
        border-left:1px solid rgba(255,255,255,0.25);
        transition:.4s;
        padding:25px;
        z-index:9999;
    }
    .sidebar.active{ right:0; }
</style>
</head>
<body>

<!-- NAVBAR -->
<nav class="fixed top-0 w-full backdrop-blur-xl bg-white/10 border-b border-white/20 shadow-md z-50 fade">
    <div class="max-w-6xl mx-auto flex justify-between items-center px-4 py-3">

        <h1 class="text-2xl font-extrabold text-white tracking-wider">KADEK MOTOR</h1>

        <!-- Desktop Menu -->
<ul class="hidden md:flex gap-8 text-white font-semibold text-sm tracking-widest">

    <li>
        <a href="/"
           class="pb-1 hover:text-yellow-300 duration-300 
           {{ request()->is('/') ? 'text-yellow-300 border-b-2 border-yellow-400' : '' }}">
           HOME
        </a>
    </li>

    <li>
        <a href="/booking"
           class="pb-1 hover:text-yellow-300 duration-300 
           {{ request()->is('booking') ? 'text-yellow-300 border-b-2 border-yellow-400' : '' }}">
           BOOKING
        </a>
    </li>

    <li>
        <a href="/daftar-member"
           class="pb-1 hover:text-yellow-300 duration-300 
           {{ request()->is('daftar-member') ? 'text-yellow-300 border-b-2 border-yellow-400' : '' }}">
           DAFTAR MEMBER
        </a>
    </li>

    <li>
        <a href="#kontak"
           class="pb-1 hover:text-yellow-300 duration-300 
           {{ request()->is('kontak') ? 'text-yellow-300 border-b-2 border-yellow-400' : '' }}">
           KONTAK
        </a>
    </li>
</ul>


        <!-- Mobile Menu Button -->
        <button onclick="toggleSidebar()" class="md:hidden text-white text-3xl">&#9776;</button>
    </div>
</nav>


<!-- ========== MOBILE SIDEBAR ========== -->
<div id="sidebar" class="sidebar">
    <button onclick="toggleSidebar()" class="text-white text-2xl float-right mb-6">&times;</button>

    <ul class="mt-10 space-y-5 text-white font-semibold text-base">
        <li><a href="/" class="block hover:text-yellow-300 duration-300">🏠 Home</a></li>
        <li><a href="/booking" class="block hover:text-yellow-300 duration-300">📝 Booking</a></li>
        <li><a href="/daftar-member" class="block text-yellow-300 font-bold">👥 Daftar Member</a></li>
        <li><a href="#kontak" class="block hover:text-yellow-300 duration-300">☎ Kontak</a></li>
        <li><a href="/admin/login" class="block hover:text-yellow-300 duration-300">🔐 Admin Login</a></li>
    </ul>
</div>

<script>
    function toggleSidebar(){
        document.getElementById("sidebar").classList.toggle("active");
    }
</script>
<!-- ===================================== -->


<!-- FORM PENDAFTARAN -->
<section class="min-h-screen flex items-center justify-center px-5 fade pt-24">

    <div class="w-full max-w-xl bg-white/10 backdrop-blur-xl border border-white/20
                rounded-2xl p-9 shadow-[0_10px_40px_rgba(0,0,0,0.45)]">

        <h2 class="text-center text-3xl font-bold text-white mb-9 tracking-wide">
            Daftar Member Bengkel KADEK MOTOR
        </h2>

        @if(session('success'))
        <div class="bg-green-600 text-white font-semibold p-3 rounded text-center mb-5">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('member.store') }}" method="POST" class="space-y-4">
            @csrf
            
            @php 
                $fields = [
                    'nama_pelanggan'=>'Nama Pelanggan','no_telepon'=>'No Telepon',
                    'email'=>'Email','alamat'=>'Alamat','merek'=>'Merek Kendaraan',
                    'no_plat'=>'Nomor Plat','tahun'=>'Tahun Kendaraan'
                ]; 
            @endphp

            @foreach($fields as $name=>$label)
            <div>
                <label class="text-white font-semibold">{{ $label }}</label>
                <input type="{{ $name=='email'?'email':($name=='tahun'?'number':'text') }}" 
                       name="{{ $name }}"
                       class="w-full bg-white/90 border-l-4 border-yellow-400 p-3 rounded-xl text-gray-900
                              focus:ring-2 focus:ring-yellow-400 hover:scale-[1.02] transition-all duration-300"
                       required>
                @error($name) <p class="text-yellow-300 text-sm">{{ $message }}</p> @enderror
            </div>
            @endforeach

            <button 
                class="w-full bg-yellow-400 text-blue-900 font-bold py-3 rounded-xl 
                       text-xl tracking-wide shadow-lg hover:bg-yellow-300 hover:scale-[1.03]
                       transition-all duration-300">
                Daftar Sekarang
            </button>
        </form>
    </div>
</section>


<!-- FOOTER KONTAK -->
<section id="kontak" class="text-center mt-10 mb-12 fade">
    <p class="text-white/85 text-lg">Butuh bantuan cepat?</p>
    <a href="https://wa.me/6281234567890" target="_blank"
       class="inline-block mt-3 bg-green-500 hover:bg-green-400 text-white font-bold py-3 px-8 rounded-full text-lg shadow-md transition-all">
        Chat WhatsApp 
    </a>
</section>

</body>
</html>
