@extends('layouts.app')

@section('content')
    <section id="booking" class="min-h-screen flex items-center justify-center px-5 pt-10">

        <div class="w-full max-w-xl bg-white/10 backdrop-blur-xl border border-white/20
                    rounded-2xl p-9 shadow-[0_10px_40px_rgba(0,0,0,0.45)]">

            <h2 class="text-center text-3xl font-bold text-white mb-9 tracking-wide">
                Booking Bengkel Online
            </h2>

            @if(session('success'))
            <div class="bg-green-600 text-white font-semibold p-3 rounded text-center mb-5">
                {{ session('success') }}
            </div>
            @endif

            <form action="{{ route('reservasi.store') }}" method="POST" class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 gap-4 text-left"> @php $fields = ['nama_pelanggan'=>'Nama Pelanggan','no_telepon'=>'No Telepon / Whatsapp','email'=>'Email (opsional)', 'merek'=>'Jenis Kendaraan','alamat'=>'Alamat','no_plat'=>'Nomor Plat Kendaraan','tahun'=>'Tahun Kendaraan']; @endphp @foreach($fields as $name=>$label) <div> <label class="text-white font-semibold">{{ $label }}</label> <input type="{{ $name=='email' ? 'email' : ($name=='tahun'?'number':'text') }}" name="{{ $name }}" class="w-full bg-white/90 border-l-4 border-yellow-400 p-3 rounded-xl text-gray-900 focus:ring-2 focus:ring-yellow-400 hover:scale-[1.02] transition-all duration-300 shadow-sm" required="{{ $name!='email' ? 'true' : 'false' }}"> </div> @endforeach <div> <label class="text-white font-semibold">Keluhan Kendaraan</label> <input type="text" name="keluhan" class="w-full bg-white/90 border-l-4 border-yellow-400 p-3 rounded-xl text-gray-900 focus:ring-2 focus:ring-yellow-400 hover:scale-[1.02] transition-all duration-300 shadow-sm"> </div> <div> <label class="text-white font-semibold">Tanggal Reservasi</label> <input type="date" name="tanggal" required class="w-full bg-white/90 border-l-4 border-yellow-400 p-3 rounded-xl text-gray-900 focus:ring-2 focus:ring-yellow-400 hover:scale-[1.02] transition-all duration-300 shadow-sm"> </div> <div> <label class="text-white font-semibold">Jam Reservasi</label> <input type="time" name="jam_kedatangan" required class="w-full bg-white/90 border-l-4 border-yellow-400 p-3 rounded-xl text-gray-900 focus:ring-2 focus:ring-yellow-400 hover:scale-[1.02] transition-all duration-300 shadow-sm"> </div> <div> <label class="text-white font-semibold">Catatan Tambahan</label> <textarea name="keterangan" rows="3" class="w-full bg-white/90 border-l-4 border-yellow-400 p-3 rounded-xl text-gray-900 focus:ring-2 focus:ring-yellow-400 hover:scale-[1.02] transition-all duration-300 shadow-sm"></textarea> </div> </div> <button class="w-full mt-4 bg-yellow-400 text-blue-900 font-bold py-3 rounded-xl text-xl tracking-wide shadow-lg hover:bg-yellow-300 hover:scale-[1.03] transition-all duration-300"> Kirim Reservasi </button>
                
            </form>
        </div>
    </section>
@endsection
