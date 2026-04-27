<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-cyan-400 leading-tight flex items-center gap-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
            Mission Control Dashboard
        </h2>
    </x-slot>

    <div class="py-8 min-h-screen bg-[#0a0a12] bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-slate-900 via-[#0a0a12] to-black">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="relative overflow-hidden bg-gradient-to-br from-indigo-900 via-purple-900 to-cyan-900 shadow-[0_0_30px_rgba(79,70,229,0.3)] sm:rounded-3xl p-8 text-white border border-white/10">
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-cyan-500/20 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-purple-500/20 rounded-full blur-3xl"></div>
                
                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h3 class="text-3xl font-extrabold tracking-tight">Salam dari Orbit, {{ Auth::user()->name }}! 🚀</h3>
                        <p class="text-cyan-100/80 mt-2 text-lg">
                            @if(auth()->user()->isAdmin())
                                Navigator: Kelola arsip galaksi dan koordinasi awak anggota.
                            @else
                                Explorer: Jelajahi ribuan pengetahuan di pusat data galaksi.
                            @endif
                        </p>
                    </div>
                    <div class="hidden md:block animate-bounce text-5xl">👨‍🚀</div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white/5 backdrop-blur-lg overflow-hidden shadow-xl sm:rounded-2xl border border-white/10 p-6 group hover:border-cyan-500/50 transition duration-500">
                    <div class="flex items-center gap-4">
                        <div class="bg-cyan-500/20 rounded-2xl p-4 ring-1 ring-cyan-500/50 group-hover:bg-cyan-500/40 transition">
                            <svg class="w-8 h-8 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-cyan-300 uppercase tracking-widest">Total Arsip</p>
                            <p class="text-3xl font-bold text-white leading-none mt-1">{{ \App\Models\Buku::count() }} <span class="text-sm font-normal text-gray-400">Unit</span></p>
                        </div>
                    </div>
                </div>

                @if(auth()->user()->isAdmin())
                <div class="bg-white/5 backdrop-blur-lg overflow-hidden shadow-xl sm:rounded-2xl border border-white/10 p-6 group hover:border-purple-500/50 transition duration-500">
                    <div class="flex items-center gap-4">
                        <div class="bg-purple-500/20 rounded-2xl p-4 ring-1 ring-purple-500/50 group-hover:bg-purple-500/40 transition">
                            <svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-purple-300 uppercase tracking-widest">Awak Kapal</p>
                            <p class="text-3xl font-bold text-white leading-none mt-1">{{ \App\Models\Anggota::count() }} <span class="text-sm font-normal text-gray-400">Jiwa</span></p>
                        </div>
                    </div>
                </div>
                @else
                @php
                    $anggotaLogin = \App\Models\Anggota::where('email', auth()->user()->email)->first();
                    $pinjamAktif = $anggotaLogin ? \App\Models\Peminjaman::where('anggota_id', $anggotaLogin->id)->whereIn('status',['menunggu','disetujui','dipinjam'])->count() : 0;
                @endphp
                <div class="bg-white/5 backdrop-blur-lg overflow-hidden shadow-xl sm:rounded-2xl border border-white/10 p-6 group hover:border-emerald-500/50 transition duration-500">
                    <div class="flex items-center gap-4">
                        <div class="bg-emerald-500/20 rounded-2xl p-4 ring-1 ring-emerald-500/50 group-hover:bg-emerald-500/40 transition">
                            <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-emerald-300 uppercase tracking-widest">Misi Aktif</p>
                            <p class="text-3xl font-bold text-white leading-none mt-1">{{ $pinjamAktif }} <span class="text-sm font-normal text-gray-400">Unit</span></p>
                        </div>
                    </div>
                </div>
                @endif

                <div class="bg-white/5 backdrop-blur-lg overflow-hidden shadow-xl sm:rounded-2xl border border-white/10 p-6 group hover:border-orange-500/50 transition duration-500">
                    <div class="flex items-center gap-4">
                        <div class="bg-orange-500/20 rounded-2xl p-4 ring-1 ring-orange-500/50 group-hover:bg-orange-500/40 transition">
                            <svg class="w-8 h-8 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-orange-300 uppercase tracking-widest">
                                @if(auth()->user()->isAdmin()) Dalam Transit @else Menunggu Radar @endif
                            </p>
                            <p class="text-3xl font-bold text-white leading-none mt-1">
                                @if(auth()->user()->isAdmin())
                                    {{ \App\Models\Peminjaman::where('status','dipinjam')->count() }}
                                @else
                                    {{ $anggotaLogin ? \App\Models\Peminjaman::where('anggota_id', $anggotaLogin->id)->where('status','menunggu')->count() : 0 }}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white/5 backdrop-blur-lg overflow-hidden shadow-xl sm:rounded-2xl border border-white/10 p-6">
                <h3 class="text-lg font-semibold text-cyan-400 mb-4 flex items-center gap-2">
                    <span class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></span> Control Panel
                </h3>
                <div class="flex flex-wrap gap-4">
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('buku.create') }}" class="group inline-flex items-center px-5 py-2.5 bg-cyan-600 hover:bg-cyan-500 text-white rounded-xl transition duration-300 transform hover:-translate-y-1">
                            <svg class="w-5 h-5 mr-2 group-hover:rotate-90 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Input Arsip Baru
                        </a>
                        @else
                        <a href="{{ route('buku.index') }}" class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl transition duration-300 transform hover:-translate-y-1 shadow-[0_4px_15px_rgba(79,70,229,0.4)]">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            Cari Pengetahuan
                        </a>
                    @endif
                    </div>
            </div>

            <div class="bg-white/5 backdrop-blur-lg overflow-hidden shadow-xl sm:rounded-2xl border border-white/10 p-6">
                <h3 class="text-lg font-semibold text-cyan-400 mb-4 flex items-center gap-2">
                     📡 Log Transmisi Terakhir
                </h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-white/10">
                        <thead>
                            <tr class="text-cyan-200/60">
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em]">Pilot / Awak</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em]">Objek / Buku</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em]">Waktu Launch</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em]">Status Misi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5 text-gray-300">
                            @php
                                if (auth()->user()->isAdmin()) {
                                    $recentPinjam = \App\Models\Peminjaman::with(['anggota','buku'])->latest()->take(5)->get();
                                } else {
                                    $recentPinjam = $anggotaLogin ? \App\Models\Peminjaman::with(['anggota','buku'])->where('anggota_id', $anggotaLogin->id)->latest()->take(5)->get() : collect();
                                }
                            @endphp
                            @forelse($recentPinjam as $p)
                            <tr class="hover:bg-white/5 transition duration-300">
                                <td class="px-6 py-4 text-sm font-medium text-white">{{ $p->anggota->nama }}</td>
                                <td class="px-6 py-4 text-sm italic">{{ $p->buku->judul }}</td>
                                <td class="px-6 py-4 text-sm">{{ $p->tanggal_pinjam->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="px-3 py-1 text-[10px] font-bold uppercase rounded-full ring-1 ring-inset {{ $p->status == 'dipinjam' ? 'bg-orange-500/10 text-orange-400 ring-orange-500/50' : 'bg-cyan-500/10 text-cyan-400 ring-cyan-500/50' }}">
                                        {{ $p->status }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="px-6 py-10 text-center text-gray-500 tracking-widest italic">Hening... Tidak ada transmisi data.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>