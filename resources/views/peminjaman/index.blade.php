<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-emerald-400 leading-tight flex items-center gap-3 tracking-[0.15em] uppercase">
            <span class="animate-spin-slow">🔄</span> Log Transfer Modul
        </h2>
    </x-slot>

    <div class="py-8 min-h-screen bg-[#0a0a12] bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-emerald-900/10 via-[#0a0a12] to-black">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/30 p-4 mb-6 rounded-xl flex items-center gap-3">
                    <span class="text-emerald-400 text-xl">✅</span>
                    <p class="text-emerald-200 text-sm font-mono tracking-tight">{{ session('success') }}</p>
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-500/10 border border-red-500/30 p-4 mb-6 rounded-xl flex items-center gap-3">
                    <span class="text-red-400 text-xl">⚠️</span>
                    <p class="text-red-200 text-sm font-mono tracking-tight">{{ session('error') }}</p>
                </div>
            @endif

            {{-- Terminal: Menunggu Validasi (khusus admin) --}}
            @if(auth()->user()->isAdmin())
                @php $menunggu = $peminjamans->getCollection()->where('status','menunggu'); @endphp
                @if($menunggu->count() > 0)
                <div class="bg-amber-500/5 border border-amber-500/20 shadow-[0_0_30px_rgba(245,158,11,0.05)] sm:rounded-3xl overflow-hidden mb-10 backdrop-blur-md">
                    <div class="px-6 py-5 border-b border-amber-500/10 flex justify-between items-center bg-amber-500/10">
                        <div class="flex items-center gap-3">
                            <span class="relative flex h-3 w-3">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-amber-500"></span>
                            </span>
                            <h3 class="font-bold text-amber-200 uppercase tracking-widest text-sm">Otorisasi Tertunda ({{ $menunggu->count() }})</h3>
                        </div>
                        <span class="text-[10px] font-mono text-amber-500 uppercase tracking-tighter">Priority: High</span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-amber-500/10">
                            <thead class="bg-black/40">
                                <tr class="text-[10px] font-mono text-amber-400/70 uppercase tracking-widest">
                                    <th class="px-6 py-4 text-left">Awak Kapal</th>
                                    <th class="px-6 py-4 text-left">ID Modul</th>
                                    <th class="px-6 py-4 text-left">Timestamp</th>
                                    <th class="px-6 py-4 text-center">Protokol</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-amber-500/5 bg-transparent">
                                @foreach($menunggu as $p)
                                <tr class="hover:bg-amber-500/5 transition">
                                    <td class="px-6 py-4 font-bold text-white text-sm">{{ $p->anggota->nama }}</td>
                                    <td class="px-6 py-4 text-amber-100/80 text-sm italic">{{ $p->buku->judul }}</td>
                                    <td class="px-6 py-4 font-mono text-xs text-amber-500/60">{{ $p->tanggal_pinjam->format('d.m.Y') }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-center items-center gap-3">
                                            <form action="{{ route('peminjaman.setujui', $p) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <button type="submit" onclick="return confirm('Otorisasi transfer ini?')"
                                                    class="px-4 py-1.5 bg-emerald-600/20 border border-emerald-500/50 text-emerald-400 text-[10px] font-black uppercase rounded-full hover:bg-emerald-600 hover:text-white transition shadow-[0_0_10px_rgba(16,185,129,0.2)]">
                                                    Approve
                                                </button>
                                            </form>
                                            <button onclick="document.getElementById('modal-tolak-{{ $p->id }}').classList.remove('hidden')"
                                                class="px-4 py-1.5 bg-red-600/20 border border-red-500/50 text-red-400 text-[10px] font-black uppercase rounded-full hover:bg-red-600 hover:text-white transition">
                                                Deny
                                            </button>
                                            <a href="{{ route('peminjaman.show', $p) }}" class="text-white/40 hover:text-white transition text-xs font-mono">[DIR]</a>
                                        </div>

                                        {{-- Modal: Alasan Penolakan (Futuristic) --}}
                                        <div id="modal-tolak-{{ $p->id }}" class="hidden fixed inset-0 bg-black/80 backdrop-blur-sm flex items-center justify-center z-50 p-4">
                                            <div class="bg-[#161925] border border-red-500/30 rounded-3xl shadow-2xl p-8 w-full max-w-md transform transition-all">
                                                <div class="flex items-center gap-3 mb-6">
                                                    <div class="p-2 bg-red-500/20 rounded-lg text-red-500">✕</div>
                                                    <h4 class="font-black text-white uppercase tracking-widest italic">Inisialisasi Penolakan</h4>
                                                </div>
                                                <form action="{{ route('peminjaman.tolak', $p) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <textarea name="catatan_admin" rows="3" placeholder="Masukkan alasan pembatalan protokol..."
                                                        class="w-full bg-black/40 border-white/10 rounded-xl text-cyan-100 text-sm focus:border-red-500 focus:ring-red-500/50 placeholder:text-gray-600 font-mono"></textarea>
                                                    <div class="flex gap-4 mt-8">
                                                        <button type="submit" class="flex-1 py-3 bg-red-600 text-white font-black rounded-xl hover:bg-red-500 transition text-xs uppercase tracking-widest shadow-lg shadow-red-900/20">Confirm Deny</button>
                                                        <button type="button" onclick="document.getElementById('modal-tolak-{{ $p->id }}').classList.add('hidden')"
                                                            class="flex-1 py-3 border border-white/10 text-gray-400 font-black rounded-xl hover:bg-white/5 transition text-xs uppercase tracking-widest">Abort</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            @endif

            {{-- Main Table: Semua Peminjaman --}}
            <div class="bg-white/5 border border-white/10 shadow-2xl sm:rounded-3xl overflow-hidden backdrop-blur-xl">
                <div class="p-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-white/10">
                    <div>
                        <h3 class="font-black text-white text-xl tracking-tight italic uppercase">Database Transfer Utama</h3>
                        <p class="text-gray-500 font-mono text-[10px] mt-1 tracking-widest uppercase">Global Distribution Tracking</p>
                    </div>
                    <a href="{{ route('peminjaman.create') }}" class="group inline-flex items-center px-6 py-3 bg-indigo-600 text-white text-xs font-black uppercase tracking-widest rounded-xl hover:bg-indigo-500 hover:shadow-[0_0_20px_rgba(79,70,229,0.4)] transition transform hover:-translate-y-1">
                        <span class="mr-2 group-hover:rotate-90 transition">➕</span> Ajukan Transfer Baru
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-white/5">
                        <thead class="bg-black/20">
                            <tr class="text-[10px] font-mono text-cyan-400/60 uppercase tracking-[0.2em]">
                                <th class="px-6 py-5 text-left">Personel</th>
                                <th class="px-6 py-5 text-left">Unit Modul</th>
                                <th class="px-6 py-5 text-left">Jadwal Pinjam</th>
                                <th class="px-6 py-5 text-left">Status</th>
                                <th class="px-6 py-5 text-left">Access Token</th>
                                <th class="px-6 py-5 text-center">Navigasi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @forelse($peminjamans as $p)
                            <tr class="hover:bg-white/[0.02] transition">
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="font-bold text-white uppercase text-sm tracking-wide">{{ $p->anggota->nama }}</span>
                                        <span class="text-[9px] font-mono text-gray-500 tracking-tighter">ID: {{ $p->anggota->id }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-300 text-sm italic">{{ $p->buku->judul }}</td>
                                <td class="px-6 py-4 text-gray-400 font-mono text-xs">{{ $p->tanggal_pinjam->format('d/m/Y') }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 text-[9px] font-black rounded-full border {{ $p->badgeStatus() }} uppercase tracking-widest shadow-sm">
                                        {{ $p->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($p->token)
                                        <div class="flex items-center gap-2 group">
                                            <span class="font-mono text-xs bg-indigo-500/10 text-indigo-400 px-3 py-1 rounded-lg border border-indigo-500/20 group-hover:border-indigo-400 transition">
                                                {{ $p->token }}
                                            </span>
                                        </div>
                                    @else
                                        <span class="text-white/10 text-xs font-mono">---</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex justify-center items-center gap-4">
                                        <a href="{{ route('peminjaman.show', $p) }}" class="text-cyan-500 hover:text-white font-mono text-[10px] uppercase tracking-tighter">[Scan]</a>

                                        @if(auth()->user()->isAdmin())
                                            @if($p->status === 'disetujui')
                                                <form action="{{ route('peminjaman.ambil', $p) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <button class="text-blue-400 hover:text-blue-200 font-mono text-[10px] uppercase tracking-tighter underline underline-offset-4" onclick="return confirm('Konfirmasi pengambilan unit?')">[Pickup]</button>
                                                </form>
                                            @endif
                                            @if($p->status === 'dipinjam')
                                                <form action="{{ route('peminjaman.kembalikan', $p) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <button class="text-emerald-400 hover:text-emerald-200 font-mono text-[10px] uppercase tracking-tighter underline underline-offset-4" onclick="return confirm('Konfirmasi pengembalian unit?')">[Return]</button>
                                                </form>
                                            @endif
                                            <form action="{{ route('peminjaman.destroy', $p) }}" method="POST">
                                                @csrf @method('DELETE')
                                                <button class="text-red-500 hover:text-red-300 font-mono text-[10px] transition" onclick="return confirm('Wipe data dari sistem?')">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1-1v3M4 7h16" stroke-width="2"/></svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center gap-4 opacity-20">
                                        <span class="text-5xl">📡</span>
                                        <p class="font-mono text-gray-400 uppercase tracking-[0.3em] text-xs italic underline decoration-cyan-500 underline-offset-8">Scanning... Tidak ada aktivitas transfer terdeteksi.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-6 border-t border-white/5 space-pagination">
                    {{ $peminjamans->links() }}
                </div>
            </div>
        </div>
    </div>

    <style>
        .animate-spin-slow { animation: spin 6s linear infinite; }
        @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
        
        .space-pagination nav { background: transparent !important; }
        .space-pagination span, .space-pagination a {
            background-color: rgba(255, 255, 255, 0.03) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: #10b981 !important;
            border-radius: 12px !important;
            font-family: monospace;
            font-size: 12px;
        }
        .space-pagination a:hover { background-color: rgba(16, 185, 129, 0.1) !important; }
    </style>
</x-app-layout>