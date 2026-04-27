<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-cyan-400 leading-tight flex items-center tracking-widest uppercase">
            <span class="mr-3 text-2xl animate-pulse">📁</span> Sektor Klasifikasi Galaksi
        </h2>
    </x-slot>

    <div class="py-8 min-h-screen bg-[#0a0a12] bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-slate-900 via-[#0a0a12] to-black">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white/5 backdrop-blur-xl overflow-hidden shadow-[0_0_40px_rgba(34,211,238,0.1)] sm:rounded-3xl border border-white/10 relative">
                
                <div class="h-1 w-full bg-gradient-to-r from-transparent via-cyan-500 to-transparent opacity-40"></div>

                <div class="p-8">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
                        <div>
                            <h3 class="text-2xl font-bold text-white tracking-tight italic underline decoration-cyan-500/50 underline-offset-8">Indeks Sektor Data</h3>
                            <p class="text-cyan-400/60 text-xs font-mono mt-3 uppercase tracking-[0.3em]">System: Ready // Database: Sync</p>
                        </div>
                        <a href="{{ route('kategori.create') }}" class="group inline-flex items-center px-6 py-3 bg-transparent border-2 border-cyan-500 text-cyan-400 rounded-full text-sm font-bold uppercase tracking-widest hover:bg-cyan-500 hover:text-black transition duration-300 shadow-[0_0_15px_rgba(34,211,238,0.2)]">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Inisialisasi Sektor
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="bg-cyan-500/10 border border-cyan-500/30 p-4 mb-8 rounded-xl flex items-center gap-3 animate-pulse">
                            <span class="flex h-3 w-3 rounded-full bg-cyan-500 shadow-[0_0_10px_#22d3ee]"></span>
                            <p class="text-cyan-300 font-mono text-xs uppercase tracking-wider">{{ session('success') }}</p>
                        </div>
                    @endif

                    <div class="overflow-hidden rounded-2xl border border-white/5 bg-black/30">
                        <table class="min-w-full divide-y divide-white/10">
                            <thead class="bg-white/5">
                                <tr class="text-cyan-500/70 font-mono text-xs uppercase tracking-[0.2em]">
                                    <th class="px-6 py-5 text-left">Nama Sektor</th>
                                    <th class="px-6 py-5 text-left">Deskripsi Koordinat</th>
                                    <th class="px-6 py-5 text-center">Otoritas Navigasi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($kategoris as $kategori)
                                <tr class="hover:bg-cyan-500/[0.03] transition-colors duration-200 group">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="h-2 w-4 bg-cyan-600 rounded-sm group-hover:w-6 transition-all duration-300 shadow-[0_0_10px_#0891b2]"></div>
                                            <span class="font-bold text-white tracking-wide uppercase text-sm">{{ $kategori->nama }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-gray-400 font-mono text-xs italic leading-relaxed max-w-md">
                                            {{ $kategori->deskripsi ?? 'NULL // Tanpa deskripsi transmisi' }}
                                        </p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <div class="flex justify-center gap-4">
                                            <a href="{{ route('kategori.show', $kategori) }}" class="text-indigo-400 hover:text-white transition-colors flex items-center gap-1 font-mono text-[10px] uppercase tracking-tighter bg-indigo-500/10 px-2 py-1 rounded border border-indigo-500/20">
                                                [ View ]
                                            </a>
                                            <a href="{{ route('kategori.edit', $kategori) }}" class="text-amber-400 hover:text-white transition-colors flex items-center gap-1 font-mono text-[10px] uppercase tracking-tighter bg-amber-500/10 px-2 py-1 rounded border border-amber-500/20">
                                                [ Edit ]
                                            </a>
                                            <form action="{{ route('kategori.destroy', $kategori) }}" method="POST" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-400 hover:text-white transition-colors flex items-center gap-1 font-mono text-[10px] uppercase tracking-tighter bg-red-500/10 px-2 py-1 rounded border border-red-500/20" onclick="return confirm('Hapus sektor ini?')">
                                                    [ Purge ]
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center gap-2 opacity-30">
                                            <svg class="w-12 h-12 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            <p class="text-gray-400 font-mono tracking-widest text-xs uppercase italic">Radar: Sektor Tidak Terdeteksi</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-8 space-pagination">
                        {{ $kategoris->links() }}
                    </div>
                </div>
            </div>
            
            <div class="mt-6 flex justify-between items-center px-4 opacity-20 font-mono text-[10px] text-cyan-300 uppercase tracking-[0.5em]">
                <span>Sector-Mapping-Active</span>
                <span>v2.0.4-Galactic</span>
            </div>
        </div>
    </div>

    <style>
        /* Custom Pagination Styling */
        .space-pagination nav { background: transparent !important; }
        .space-pagination span, .space-pagination a {
            background-color: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid rgba(34, 211, 238, 0.1) !important;
            color: #22d3ee !important;
            border-radius: 4px !important;
            font-family: monospace !important;
            font-size: 11px !important;
        }
        .space-pagination a:hover {
            background-color: rgba(34, 211, 238, 0.2) !important;
            border-color: #22d3ee !important;
        }
    </style>
</x-app-layout>