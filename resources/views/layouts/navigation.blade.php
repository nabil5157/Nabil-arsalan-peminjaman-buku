<nav x-data="{ open: false }" class="bg-[#0f111a] border-b border-cyan-500/30 shadow-[0_0_20px_rgba(34,211,238,0.1)] sticky top-0 z-50 backdrop-blur-md bg-opacity-95">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center group">
                        <span class="text-2xl mr-2 filter drop-shadow-[0_0_8px_rgba(34,211,238,0.8)] group-hover:scale-110 transition-transform duration-300">🛰️</span>
                        <span class="text-xl font-black tracking-tighter bg-gradient-to-r from-cyan-400 via-blue-500 to-indigo-500 bg-clip-text text-transparent uppercase">
                            Nabil Space Lib
                        </span>
                    </a>
                </div>

                <div class="hidden space-x-4 sm:-my-px sm:ms-10 sm:flex items-center">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" 
                        class="text-xs font-mono uppercase tracking-[0.2em] hover:text-cyan-400 transition-all duration-300">
                        {{ __('Main Deck') }}
                    </x-nav-link>

                    @if(auth()->user()->isAdmin())
                        <x-nav-link :href="route('kategori.index')" :active="request()->routeIs('kategori.*')"
                            class="text-xs font-mono uppercase tracking-[0.2em] hover:text-purple-400 transition-all duration-300">
                            {{ __('Sectors') }}
                        </x-nav-link>
                    @endif

                    <x-nav-link :href="route('buku.index')" :active="request()->routeIs('buku.*')"
                        class="text-xs font-mono uppercase tracking-[0.2em] hover:text-cyan-400 transition-all duration-300">
                        {{ __('Data Modules') }}
                    </x-nav-link>

                    @if(auth()->user()->isAdmin())
                        <x-nav-link :href="route('anggota.index')" :active="request()->routeIs('anggota.*')"
                            class="text-xs font-mono uppercase tracking-[0.2em] hover:text-indigo-400 transition-all duration-300">
                            {{ __('Crew') }}
                        </x-nav-link>
                    @endif

                    <x-nav-link :href="route('peminjaman.index')" :active="request()->routeIs('peminjaman.*')"
                        class="text-xs font-mono uppercase tracking-[0.2em] hover:text-emerald-400 transition-all duration-300">
                        {{ __('Transfers') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-4 py-2 border border-cyan-500/20 text-sm leading-4 font-medium rounded-xl text-cyan-100 bg-white/5 hover:bg-cyan-500/10 focus:outline-none transition ease-in-out duration-150 shadow-[0_0_10px_rgba(34,211,238,0.05)]">
                                <div class="flex items-center">
                                    <div class="h-2 w-2 bg-emerald-500 rounded-full animate-pulse mr-2"></div>
                                    <span class="font-mono tracking-tight">{{ Auth::user()->name }}</span>
                                </div>
                                <div class="ms-2">
                                    <svg class="fill-current h-4 w-4 text-cyan-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="px-4 py-3 border-b border-white/5 bg-[#161925]">
                                <p class="text-[10px] font-mono uppercase text-gray-500 tracking-widest">Access Level</p>
                                <span class="inline-block mt-2 px-3 py-1 text-[10px] font-black rounded-lg uppercase tracking-widest {{ auth()->user()->isAdmin() ? 'bg-indigo-500/20 text-indigo-400 border border-indigo-500/30' : 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30' }}">
                                    {{ auth()->user()->role }}
                                </span>
                            </div>

                            <div class="bg-[#161925]">
                                <x-dropdown-link :href="route('profile.edit')" class="text-gray-300 hover:bg-white/5 hover:text-cyan-400 transition font-mono text-xs uppercase tracking-wider">
                                    {{ __('Bio-Profile') }}
                                </x-dropdown-link>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                            class="text-red-400 hover:bg-red-500/10 hover:text-red-300 transition font-mono text-xs uppercase tracking-wider"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Disconnect') }}
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-cyan-400 hover:bg-cyan-500/10 transition duration-150">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 20h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-[#0f111a] border-t border-white/5">
        <div class="pt-2 pb-3 space-y-1 px-2">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-cyan-400 font-mono text-xs uppercase tracking-widest">
                Main Deck
            </x-responsive-nav-link>

            @if(auth()->user()->isAdmin())
                <x-responsive-nav-link :href="route('kategori.index')" :active="request()->routeIs('kategori.*')" class="text-purple-400 font-mono text-xs uppercase tracking-widest">
                    Sectors
                </x-responsive-nav-link>
            @endif

            <x-responsive-nav-link :href="route('buku.index')" :active="request()->routeIs('buku.*')" class="text-cyan-400 font-mono text-xs uppercase tracking-widest">
                Data Modules
            </x-responsive-nav-link>

            @if(auth()->user()->isAdmin())
                <x-responsive-nav-link :href="route('anggota.index')" :active="request()->routeIs('anggota.*')" class="text-indigo-400 font-mono text-xs uppercase tracking-widest">
                    Crew Registry
                </x-responsive-nav-link>
            @endif

            <x-responsive-nav-link :href="route('peminjaman.index')" :active="request()->routeIs('peminjaman.*')" class="text-emerald-400 font-mono text-xs uppercase tracking-widest">
                Transfers
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-white/10 bg-black/20">
            <div class="px-4 flex justify-between items-center">
                <div>
                    <div class="font-bold text-sm text-cyan-100 font-mono">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-[10px] text-gray-500 font-mono uppercase">{{ Auth::user()->email }}</div>
                </div>
                <span class="px-2 py-0.5 text-[9px] font-black rounded border border-cyan-500/30 text-cyan-400 uppercase tracking-tighter">
                    {{ auth()->user()->role }}
                </span>
            </div>
            <div class="mt-3 space-y-1 px-2 pb-4">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-gray-400 text-xs font-mono uppercase tracking-widest">
                    {{ __('Bio-Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" class="text-red-400 text-xs font-mono uppercase tracking-widest"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Disconnect') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

<style>
    /* Indikator Active Link bergaya Neon */
    .nav-link-active {
        border-bottom: 2px solid #22d3ee !important;
        color: #22d3ee !important;
        text-shadow: 0 0 10px rgba(34,211,238,0.5);
    }
</style>