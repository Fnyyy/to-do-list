<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Synergy') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        html, body { height: 100%; }
        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        /* Sidebar scrollbar */
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-track { background: transparent; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.15); border-radius: 2px; }
    </style>
</head>

<body class="h-full font-sans antialiased bg-slate-100" x-data="{ sidebarOpen: false }">

    <div class="flex h-full">

        <!-- ═══════════════════════ SIDEBAR ═══════════════════════ -->
        <!-- Mobile overlay -->
        <div x-show="sidebarOpen"
            class="fixed inset-0 z-40 bg-black/40 lg:hidden"
            x-transition.opacity
            @click="sidebarOpen = false">
        </div>

        <aside
            class="fixed inset-y-0 left-0 z-50 w-64 bg-[#1e2d5a] flex flex-col transform transition-transform duration-300 ease-in-out lg:relative lg:translate-x-0 lg:flex-shrink-0"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

            <!-- Sidebar Brand -->
            <div class="flex items-center gap-3 h-16 px-6 border-b border-white/10 flex-shrink-0">
                <div class="w-8 h-8 rounded-lg bg-white flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-[#1e2d5a]" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <span class="text-white text-lg font-bold tracking-tight">Synergy</span>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 overflow-y-auto sidebar-scroll py-6 px-4 space-y-1">
                <p class="text-white/30 text-[10px] font-semibold uppercase tracking-widest px-3 mb-3">Menu</p>
                @include('layouts.navigation')
            </nav>

            <!-- Sidebar Footer: User quick info -->
            <div class="border-t border-white/10 p-4 flex-shrink-0">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-white text-sm font-medium truncate">{{ Auth::user()->name }}</p>
                        <p class="text-white/40 text-xs truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- ═══════════════════════ MAIN CONTENT ═══════════════════════ -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

            <!-- Top Navbar -->
            <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-6 flex-shrink-0">
                <div class="flex items-center gap-4">
                    <!-- Mobile menu button -->
                    <button @click="sidebarOpen = true"
                        class="lg:hidden p-2 rounded-lg text-slate-500 hover:bg-slate-100 hover:text-slate-700 transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <!-- Page title (breadcrumb feel) -->
                    <div class="hidden sm:flex items-center gap-2 text-sm text-slate-500">
                        <span class="font-medium text-slate-700">{{ config('app.name', 'Synergy') }}</span>
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                        <span>Dashboard</span>
                    </div>
                </div>

                <!-- Right side actions -->
                <div class="flex items-center gap-2">
                    <!-- Notifications -->
                    <div x-data="{ open: false }" class="relative">
                        <button type="button" @click.stop="open = !open"
                            class="relative p-2 rounded-lg text-slate-500 hover:bg-slate-100 hover:text-slate-700 transition-colors focus:outline-none">
                            @if (Auth::user()->unreadNotifications->count() > 0)
                                <span class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full bg-red-500"></span>
                            @endif
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                            </svg>
                        </button>

                        <!-- Notification panel -->
                        <div x-show="open" @click.outside="open = false"
                            x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 top-full mt-2 w-80 bg-white rounded-xl shadow-lg border border-slate-200 z-50 overflow-hidden"
                            style="display:none;">

                            <div class="px-4 py-3 border-b border-slate-100 flex items-center justify-between">
                                <h3 class="text-sm font-semibold text-slate-800">Notifications</h3>
                                @if (Auth::user()->unreadNotifications->count() > 0)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                        {{ Auth::user()->unreadNotifications->count() }} new
                                    </span>
                                @endif
                            </div>

                            <div class="max-h-72 overflow-y-auto">
                                @forelse(Auth::user()->unreadNotifications as $notification)
                                    @php
                                        $type = $notification->data['type'] ?? 'info';
                                        $dotColors = [
                                            'success' => 'bg-green-500',
                                            'warning' => 'bg-amber-500',
                                            'error'   => 'bg-red-500',
                                            'info'    => 'bg-blue-500',
                                        ];
                                        $dot = $dotColors[$type] ?? $dotColors['info'];
                                    @endphp
                                    <div class="px-4 py-3 border-b border-slate-50 hover:bg-slate-50 transition-colors flex items-start gap-3">
                                        <span class="mt-1.5 w-2 h-2 rounded-full {{ $dot }} flex-shrink-0"></span>
                                        <div class="flex-1 min-w-0">
                                            @if(isset($notification->data['title']))
                                                <p class="text-sm font-semibold text-slate-800">{{ $notification->data['title'] }}</p>
                                            @endif
                                            <p class="text-xs text-slate-500 mt-0.5 leading-relaxed">{{ $notification->data['message'] ?? 'New notification' }}</p>
                                            <p class="text-[10px] text-slate-400 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                                        </div>
                                        <a href="{{ route('notifications.read', $notification->id) }}"
                                            class="text-slate-400 hover:text-slate-600 transition-colors flex-shrink-0 mt-0.5" title="Mark as read">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </a>
                                    </div>
                                @empty
                                    <div class="py-10 text-center">
                                        <svg class="w-8 h-8 text-slate-300 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                        </svg>
                                        <p class="text-sm text-slate-400 mb-3">You're all caught up!</p>
                                        <a href="{{ route('notifications.test') }}"
                                            class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg bg-slate-100 text-slate-600 hover:bg-slate-200 transition-colors">
                                            Send test notification
                                        </a>
                                    </div>
                                @endforelse
                            </div>

                            @if (Auth::user()->unreadNotifications->count() > 0)
                                <div class="px-4 py-2.5 border-t border-slate-100 bg-slate-50">
                                    <a href="{{ route('notifications.readAll') }}"
                                        class="text-xs font-semibold text-[#4361ee] hover:text-[#3a56d4] transition-colors">
                                        Mark all as read
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="h-6 w-px bg-slate-200"></div>

                    <!-- User Menu -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open"
                            class="flex items-center gap-2.5 px-2 py-1.5 rounded-lg hover:bg-slate-100 transition-colors focus:outline-none">
                            <div class="w-7 h-7 rounded-full bg-[#1e2d5a] flex items-center justify-center text-white font-bold text-xs flex-shrink-0">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div class="hidden sm:block text-left">
                                <p class="text-sm font-semibold text-slate-700 leading-none">{{ Auth::user()->name }}</p>
                            </div>
                            <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="open" @click.outside="open = false"
                            x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 top-full mt-2 w-52 bg-white rounded-xl shadow-lg border border-slate-200 py-1 z-50"
                            style="display:none;">

                            <div class="px-4 py-3 border-b border-slate-100">
                                <p class="text-xs text-slate-400">Signed in as</p>
                                <p class="text-sm font-medium text-slate-700 truncate mt-0.5">{{ Auth::user()->email }}</p>
                            </div>

                            <a href="{{ route('profile.edit') }}"
                                class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-slate-600 hover:bg-slate-50 hover:text-slate-800 transition-colors">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                                Profile Settings
                            </a>

                            <div class="border-t border-slate-100 mt-1 pt-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full flex items-center gap-2.5 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                        </svg>
                                        Sign Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6 lg:p-8">
                @if (session('success'))
                    <div class="mb-6 flex items-center gap-3 px-4 py-3 bg-green-50 border border-green-200 rounded-lg text-green-700 text-sm">
                        <svg class="w-5 h-5 flex-shrink-0 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>

</body>

</html>