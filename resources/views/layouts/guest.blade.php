<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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
                    colors: {
                        brand: {
                            50:  '#f0f4ff',
                            100: '#dde6ff',
                            500: '#4361ee',
                            600: '#3a56d4',
                            700: '#2f48b8',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .perspective-1000 { perspective: 1000px; }
        .transform-style-3d { transform-style: preserve-3d; }
        .backface-hidden { backface-visibility: hidden; -webkit-backface-visibility: hidden; }
        .rotate-y-180 { transform: rotateY(180deg); }

        /* Subtle diagonal stripe pattern for the left panel */
        .stripe-pattern {
            background-image: repeating-linear-gradient(
                -45deg,
                transparent,
                transparent 20px,
                rgba(255,255,255,0.03) 20px,
                rgba(255,255,255,0.03) 40px
            );
        }
    </style>
</head>

<body class="font-sans antialiased bg-slate-100 min-h-screen flex">

    <!-- Left decorative panel — solid, no glow -->
    <div class="hidden lg:flex lg:w-[52%] xl:w-[55%] bg-[#1e2d5a] flex-col justify-between p-14 stripe-pattern relative overflow-hidden">
        <!-- Top brand -->
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-lg bg-white flex items-center justify-center">
                <svg class="w-5 h-5 text-[#1e2d5a]" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <span class="text-white text-xl font-bold tracking-tight">Synergy</span>
        </div>

        <!-- Center content -->
        <div>
            <blockquote class="text-white/90 text-3xl font-semibold leading-snug mb-6">
                "Collaborate smarter.<br>Ship faster.<br>Build together."
            </blockquote>
            <p class="text-white/50 text-sm leading-relaxed max-w-sm">
                Synergy is your team's single source of truth — manage projects, assign tasks, and track progress all in one place.
            </p>

            <!-- Feature bullets -->
            <div class="mt-10 space-y-4">
                @foreach(['Project management & kanban boards', 'Real-time task assignment & tracking', 'Team collaboration & notifications'] as $f)
                <div class="flex items-center gap-3">
                    <div class="w-5 h-5 rounded-full bg-white/20 flex items-center justify-center flex-shrink-0">
                        <svg class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <span class="text-white/70 text-sm">{{ $f }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Bottom -->
        <div class="text-white/30 text-xs">
            © {{ date('Y') }} Synergy. All rights reserved.
        </div>

        <!-- Decorative shape — bottom right -->
        <div class="absolute -bottom-20 -right-20 w-72 h-72 rounded-full border border-white/5"></div>
        <div class="absolute -bottom-10 -right-10 w-48 h-48 rounded-full border border-white/5"></div>
    </div>

    <!-- Right: form area -->
    <div class="flex-1 flex flex-col justify-center items-center p-6 sm:p-10 bg-slate-100 min-h-screen lg:min-h-0">
        <!-- Mobile logo -->
        <div class="lg:hidden mb-8 flex items-center gap-2">
            <div class="w-8 h-8 rounded-lg bg-[#1e2d5a] flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <span class="text-[#1e2d5a] text-xl font-bold">Synergy</span>
        </div>

        <div class="w-full max-w-[420px]">
            {{ $slot }}
        </div>
    </div>

</body>

</html>