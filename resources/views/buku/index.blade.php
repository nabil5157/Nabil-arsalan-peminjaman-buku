<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-cyan-400 leading-tight flex items-center tracking-widest uppercase">
            <span class="mr-3 text-2xl animate-spin-slow">🪐</span> Galaksi Pengetahuan
        </h2>
    </x-slot>

    <div class="py-8 min-h-screen bg-[#0a0a12] bg-[radial-gradient(circle_at_bottom_left,_var(--tw-gradient-stops))] from-purple-900/20 via-[#0a0a12] to-black">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white/5 backdrop-blur-xl shadow-[0_0_50px_rgba(79,70,229,0.2)] sm:rounded-3xl border border-white/10 overflow-hidden relative">
                
                <div class="absolute top-0 left-0 w-full h-[2px] bg-cyan-500 opacity-30 shadow-[0_0_15px_#22d3ee] animate-scan"></div>

                <div class="p-8">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4 border-b border-white/5 pb-6">
                        <div>
                            <h3 class="text-2xl font-bold text-white flex items-center gap-2">
                                Arsip Data Buku
                                <span class="text-xs bg-cyan-500/20 text-cyan-400 px-2 py-0.5 rounded border border-cyan-500/30 font-mono tracking-tighter">ONLINE</span>
                            </h3>
                            <p class="text-gray-400 text-sm mt-1 font-mono tracking-wider">Laporan Inventaris Sektor Pengetahuan</p>
                        </div>
                        
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('buku.create') }}" class="group relative inline-flex items-center px-6 py-3 font-bold text-white transition-all duration-300 bg-indigo-600 rounded-xl hover:bg-indigo-500 hover:shadow-[0_0_20px_rgba(79,70,229,0.5)] transform hover:-translate-y-1">
                                <svg class="w-5 h-5 mr-2 group-hover:rotate-180 transition duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                Tambah Modul Buku
                            </a>
                        @endif
                    </div>

                    @if(session('success'))
                        <div class="bg-cyan-500/10 border-l-4 border-cyan-400 p-4 mb-6 rounded-r-xl flex items-center gap-3">
                            <span class="text-cyan-400">📡</span>
                            <p class="text-cyan-200 text-sm font-medium tracking-wide">{{ session('success') }}</p>
                        </div>
                    @endif

                    <div class="overflow-x-auto rounded-2xl border border-white/5 bg-black/40 shadow-inner">
                        <table class="min-w-full">
                            <thead>
                                <tr class="bg-white/5 text-cyan-300 font-mono text-xs uppercase tracking-[0.25em]">
                                    <th class="px-6 py-5 text-left">Identitas / Judul</th>
                                    <th class="px-6 py-5 text-left">Arsitek / Penulis</th>
                                    <th class="px-6 py-5 text-left">Sektor / Kategori</th>
                                    <th class="px-6 py-5 text-left">Unit / Stok</th>
                                    <th class="px-6 py-5 text-center">Otoritas</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($bukus as $buku)
                                <tr class="hover:bg-indigo-500/5 transition-all duration-300 group">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-2 h-2 bg-indigo-500 rounded-full group-hover:shadow-[0_0_10px_#6366f1] transition-all"></div>
                                            <span class="font-bold text-white group-hover:text-cyan-300 transition">{{ $buku->judul }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-400 text-sm font-medium italic">{{ $buku->penulis }}</td>
                                    <td class="px-6 py-4">
                                        <span class="text-xs font-mono text-purple-400 bg-purple-500/10 px-2 py-1 rounded border border-purple-500/20 uppercase tracking-tighter">
                                            {{ $buku->kategori->nama }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <span class="text-lg font-bold {{ $buku->stok > 0 ? 'text-white' : 'text-red-500 animate-pulse' }}">
                                                {{ str_pad($buku->stok, 2, '0', STR_PAD_LEFT) }}
                                            </span>
                                            <div class="w-16 h-1.5 bg-white/10 rounded-full overflow-hidden hidden sm:block">
                                                <div class="h-full {{ $buku->stok > 0 ? 'bg-cyan-500' : 'bg-red-500' }}" style="width: {{ min(($buku->stok / 10) * 100, 100) }}%"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-center items-center gap-3">
                                            <a href="{{ route('buku.show', $buku) }}" class="text-cyan-400 hover:text-white p-2 hover:bg-cyan-500/20 rounded-lg transition" title="Scan Detail">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10 21h4m-4-4V5a2 2 0 012-2h0a2 2 0 012 2v12m-4 4h4" stroke-width="2"/></svg>
                                            </a>
                                            @if(auth()->user()->isAdmin())
                                                <a href="{{ route('buku.edit', $buku) }}" class="text-amber-400 hover:text-white p-2 hover:bg-amber-500/20 rounded-lg transition" title="Modify Module">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" stroke-width="2"/></svg>
                                                </a>
                                                <form action="{{ route('buku.destroy', $buku) }}" method="POST" class="inline">
                                                    @csrf @method('DELETE')
                                                    <button class="text-red-400 hover:text-white p-2 hover:bg-red-500/20 rounded-lg transition" onclick="return confirm('Hapus data dari sistem pusat?')">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-width="2"/></svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <p class="text-gray-500 italic tracking-[0.2em]">Sektor Kosong: Belum ada modul data terdeteksi.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-8 pagination-cosmic">
                        {{ $bukus->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes scan {
            0% { top: 0; opacity: 0; }
            50% { opacity: 0.5; }
            100% { top: 100%; opacity: 0; }
        }
        .animate-scan {
            animation: scan 4s linear infinite;
        }
        .animate-spin-slow {
            animation: spin 8s linear infinite;
        }
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        /* Custom Dark Pagination */
        .pagination-cosmic nav span, 
        .pagination-cosmic nav a {
            background-color: rgba(255, 255, 255, 0.05) !important;
            border-color: rgba(255, 255, 255, 0.1) !important;
            color: #22d3ee !important;
        }
    </style>
</x-app-layout>