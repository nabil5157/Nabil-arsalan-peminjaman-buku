<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-cyan-400 leading-tight flex items-center tracking-widest uppercase">
            <span class="mr-3 animate-pulse text-2xl">🛰️</span> Crew Registry & Personnel
        </h2>
    </x-slot>

    <div class="py-8 min-h-screen bg-[#0a0a12] bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-indigo-900/20 via-[#0a0a12] to-black">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white/5 backdrop-blur-xl overflow-hidden shadow-[0_0_50px_rgba(0,0,0,0.5)] sm:rounded-3xl border border-white/10 relative">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-cyan-500 to-transparent opacity-50"></div>
                
                <div class="p-8">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                        <div>
                            <h3 class="text-2xl font-bold text-white tracking-tight">Database Awak Galaksi</h3>
                            <p class="text-cyan-400/60 text-sm font-mono mt-1 uppercase tracking-widest">// Secure Data Access Authorized</p>
                        </div>
                        <a href="{{ route('anggota.create') }}" class="group inline-flex items-center px-6 py-3 bg-cyan-600 hover:bg-cyan-500 text-white rounded-xl transition duration-300 transform hover:scale-105 shadow-[0_0_20px_rgba(8,145,178,0.3)]">
                            <svg class="w-5 h-5 mr-2 group-hover:rotate-90 transition duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Rekrut Awak Baru
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="bg-emerald-500/10 border border-emerald-500/50 p-4 mb-8 rounded-2xl flex items-center gap-3 animate-bounce-short">
                            <span class="text-emerald-400 text-xl">✅</span>
                            <p class="text-emerald-400 font-medium text-sm">{{ session('success') }}</p>
                        </div>
                    @endif

                    <div class="overflow-hidden rounded-2xl border border-white/5 bg-black/20">
                        <table class="min-w-full divide-y divide-white/10">
                            <thead class="bg-white/5 font-mono text-cyan-300">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em]">Call Sign / Nama</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em]">Comms / Email</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em]">Frequency</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em]">Sector / Alamat</th>
                                    <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-[0.2em]">Command</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($anggotas as $anggota)
                                <tr class="hover:bg-cyan-500/5 transition group">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 rounded-full bg-gradient-to-br from-indigo-600 to-cyan-600 flex items-center justify-center text-white font-bold border border-white/20 shadow-lg">
                                                {{ substr($anggota->nama, 0, 1) }}
                                            </div>
                                            <div class="ml-4 font-semibold text-white group-hover:text-cyan-400 transition">{{ $anggota->nama }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-400 font-mono text-sm">{{ $anggota->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-400 font-mono text-sm">{{ $anggota->telepon }}</td>
                                    <td class="px-6 py-4 text-gray-400 text-sm max-w-xs truncate italic">📍 {{ $anggota->alamat }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                        <div class="flex justify-center gap-3">
                                            <a href="{{ route('anggota.show', $anggota) }}" class="p-2 bg-indigo-500/10 hover:bg-indigo-500/30 text-indigo-400 rounded-lg transition" title="Detail">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" stroke-width="2"/></svg>
                                            </a>
                                            <a href="{{ route('anggota.edit', $anggota) }}" class="p-2 bg-amber-500/10 hover:bg-amber-500/30 text-amber-400 rounded-lg transition" title="Modify">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" stroke-width="2"/></svg>
                                            </a>
                                            <form action="{{ route('anggota.destroy', $anggota) }}" method="POST" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-2 bg-red-500/10 hover:bg-red-500/30 text-red-400 rounded-lg transition" onclick="return confirm('Eject personil ini dari sistem?')" title="Terminate">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-width="2"/></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-20 text-center">
                                        <div class="flex flex-col items-center">
                                            <span class="text-5xl mb-4 opacity-20">📡</span>
                                            <p class="text-gray-500 font-mono tracking-widest">Sinyal Kosong: Belum ada awak yang terdaftar.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-8 pagination-dark">
                        {{ $anggotas->links() }}
                    </div>
                </div>
            </div>

            <div class="mt-6 text-center">
                <p class="text-xs font-mono text-cyan-900/50 uppercase tracking-[0.5em]">Deep Space Management System v2.0</p>
            </div>
        </div>
    </div>

    <style>
        /* Custom animation for alert */
        @keyframes bounce-short {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-4px); }
        }
        .animate-bounce-short {
            animation: bounce-short 2s ease-in-out infinite;
        }

        /* Custom Pagination Style (Apply logic in your CSS/Tailwind config if needed) */
        .pagination-dark nav { background: transparent !important; }
        .pagination-dark span, .pagination-dark a { 
            background-color: rgba(255, 255, 255, 0.05) !important;
            border-color: rgba(255, 255, 255, 0.1) !important;
            color: #94a3b8 !important;
            border-radius: 8px !important;
            margin: 0 2px;
        }
        .pagination-dark a:hover { background-color: rgba(6, 182, 212, 0.2) !important; color: #22d3ee !important; }
    </style>
</x-app-layout>