<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial=" 1">
    <title>{{ config('app.name', 'Synergy') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>

<body class="antialiased font-sans bg-gray-900 text-white selection:bg-indigo-500 selection:text-white">
    <div class="relative min-h-screen overflow-hidden">
        <!-- Background Gradients -->
        <div
            class="absolute top-0 left-1/2 -translate-x-1/2 w-[1000px] h-[500px] bg-[#ff003c]/20 rounded-full blur-[100px] -z-10">
        </div>
        <div class="absolute bottom-0 right-0 w-[800px] h-[600px] bg-[#881337]/30 rounded-full blur-[120px] -z-10">
        </div>

        <!-- Navbar -->
        <nav class="container mx-auto px-6 py-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div
                    class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#ff003c] to-[#be123c] flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-[#ff003c]/50">
                    S
                </div>
                <span class="text-2xl font-bold tracking-tight">Synergy</span>
            </div>
            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="px-5 py-2.5 rounded-lg bg-white/10 hover:bg-white/20 border border-white/10 transition font-medium backdrop-blur-sm">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="px-5 py-2.5 rounded-lg text-gray-300 hover:text-white font-medium transition">Log in</a>
                    <a href="{{ route('register') }}"
                        class="px-5 py-2.5 rounded-lg bg-[#ff003c] hover:bg-[#d40032] text-white font-semibold shadow-[0_0_15px_rgba(255,0,60,0.5)] transition transform hover:-translate-y-0.5">Get
                        Started</a>
                @endauth
            </div>
        </nav>

        <!-- Hero Section -->
        <main class="container mx-auto px-6 pt-20 pb-32 text-center">
            <div
                class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/5 border border-white/10 text-red-300 text-sm mb-8 animate-fade-in-up shadow-[0_0_10px_rgba(255,0,60,0.3)]">
                <span class="w-2 h-2 rounded-full bg-[#ff003c] animate-pulse shadow-[0_0_10px_#ff003c]"></span>
                Now v1.0 with AI Insights
            </div>

            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight mb-8 leading-tight">
                Manage logic, <br>
                <span
                    class="text-transparent bg-clip-text bg-gradient-to-r from-[#ff003c] via-red-500 to-[#be123c] drop-shadow-[0_0_5px_rgba(255,0,60,0.5)]">master
                    chaos.</span>
            </h1>

            <p class="text-lg md:text-xl text-gray-400 max-w-2xl mx-auto mb-10 leading-relaxed">
                Synergy brings your team's work together in one shared workspace.
                Plan, track, and collaborate on projects with an interface designed for experts.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('register') }}"
                    class="w-full sm:w-auto px-8 py-4 rounded-xl bg-[#ff003c] text-white font-bold text-lg hover:bg-[#d40032] transition shadow-[0_0_20px_rgba(255,0,60,0.4)]">
                    Start for free
                </a>
                <a href="#features"
                    class="w-full sm:w-auto px-8 py-4 rounded-xl bg-white/5 border border-white/10 hover:bg-white/10 transition font-semibold text-lg backdrop-blur-sm">
                    Live Demo
                </a>
            </div>

            <!-- Dashboard Preview -->
            <div
                class="mt-20 relative mx-auto max-w-5xl rounded-xl bg-gray-800/50 border border-white/10 p-2 shadow-2xl backdrop-blur-xl">
                <div
                    class="rounded-lg overflow-hidden bg-gray-900 border border-white/5 aspect-video flex items-center justify-center text-gray-600">
                    <!-- Placeholder for a screenshot content to prevent empty look -->
                    <div class="text-center">
                        <svg class="w-20 h-20 mx-auto text-gray-700 mb-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" />
                        </svg>
                        <span class="text-xl font-medium">Interactive Dashboard Preview</span>
                    </div>
                </div>
            </div>
        </main>

        <!-- Feature Grid -->
        <section id="features" class="py-24 bg-gray-900/50 border-t border-white/5">
            <div class="container mx-auto px-6">
                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div
                        class="p-8 rounded-2xl bg-white/5 border border-white/10 hover:border-[#ff003c]/50 transition group hover:shadow-[0_0_15px_rgba(255,0,60,0.15)]">
                        <div
                            class="w-12 h-12 rounded-lg bg-[#ff003c]/10 flex items-center justify-center mb-6 text-[#ff003c] group-hover:scale-110 transition group-hover:shadow-[0_0_15px_#ff003c]">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Instant Workspaces</h3>
                        <p class="text-gray-400 leading-relaxed">Create isolated environments for different teams
                            securely. Switch contexts in milliseconds.</p>
                    </div>
                    <!-- Feature 2 -->
                    <div
                        class="p-8 rounded-2xl bg-white/5 border border-white/10 hover:border-[#ff003c]/50 transition group hover:shadow-[0_0_15px_rgba(255,0,60,0.15)]">
                        <div
                            class="w-12 h-12 rounded-lg bg-[#ff003c]/10 flex items-center justify-center mb-6 text-[#ff003c] group-hover:scale-110 transition group-hover:shadow-[0_0_15px_#ff003c]">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0116.5 7.605" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Kanban Power</h3>
                        <p class="text-gray-400 leading-relaxed">Visualize workflows with drag-and-drop boards.
                            Customize columns and statuses effortlessly.</p>
                    </div>
                    <!-- Feature 3 -->
                    <div
                        class="p-8 rounded-2xl bg-white/5 border border-white/10 hover:border-[#ff003c]/50 transition group hover:shadow-[0_0_15px_rgba(255,0,60,0.15)]">
                        <div
                            class="w-12 h-12 rounded-lg bg-[#ff003c]/10 flex items-center justify-center mb-6 text-[#ff003c] group-hover:scale-110 transition group-hover:shadow-[0_0_15px_#ff003c]">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Real-time Analytics</h3>
                        <p class="text-gray-400 leading-relaxed">Track progress with beautiful charts and insights. Know
                            exactly where your project stands.</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

</html>