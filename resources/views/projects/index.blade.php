<x-app-layout>
    <div class="space-y-6">

        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Projects</h1>
                <p class="text-slate-500 text-sm mt-1">Manage and track all your projects.</p>
            </div>
            <a href="{{ route('projects.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#1e2d5a] hover:bg-[#263872] text-white text-sm font-semibold rounded-lg
                       transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-[#1e2d5a]/30 focus:ring-offset-2 self-start sm:self-auto">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                New Project
            </a>
        </div>

        <!-- Project Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
            @forelse($projects as $project)
                <div class="group bg-white rounded-xl border border-slate-200 hover:border-slate-300 hover:shadow-md transition-all duration-200 flex flex-col">
                    <div class="p-6 flex-1 flex flex-col">
                        <!-- Card top: icon + status -->
                        <div class="flex items-start justify-between mb-5">
                            <div class="w-11 h-11 rounded-xl bg-[#1e2d5a]/8 flex items-center justify-center text-[#1e2d5a] font-bold text-sm flex-shrink-0 border border-[#1e2d5a]/10">
                                {{ strtoupper(substr($project->name, 0, 2)) }}
                            </div>
                            @php
                                $sCfg = [
                                    'active'    => 'bg-green-100 text-green-700',
                                    'completed' => 'bg-blue-100 text-blue-700',
                                    'on_hold'   => 'bg-slate-100 text-slate-500',
                                ];
                                $sCls = $sCfg[$project->status] ?? 'bg-slate-100 text-slate-500';
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $sCls }}">
                                {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                            </span>
                        </div>

                        <!-- Name & description -->
                        <h3 class="font-semibold text-slate-800 text-base mb-1.5 group-hover:text-[#1e2d5a] transition-colors">
                            <a href="{{ route('projects.show', $project) }}" class="focus:outline-none">
                                <span class="absolute inset-0"></span>
                                {{ $project->name }}
                            </a>
                        </h3>
                        <p class="text-slate-500 text-sm leading-relaxed line-clamp-2 mb-5 flex-1">
                            {{ $project->description ?: 'No description provided.' }}
                        </p>

                        <!-- Footer meta -->
                        <div class="flex items-center justify-between text-xs text-slate-400 pt-4 border-t border-slate-100 mt-auto">
                            <div class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                                </svg>
                                {{ $project->workspace->name }}
                            </div>
                            @if($project->due_date)
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                    </svg>
                                    {{ $project->due_date->format('M d, Y') }}
                                </div>
                            @else
                                <span>No deadline</span>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center bg-white rounded-xl border border-dashed border-slate-300">
                    <svg class="w-12 h-12 text-slate-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                    </svg>
                    <h3 class="text-slate-700 font-semibold mb-1">No projects yet</h3>
                    <p class="text-slate-400 text-sm mb-6">Create your first project to get started.</p>
                    <a href="{{ route('projects.create') }}"
                        class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#1e2d5a] text-white text-sm font-semibold rounded-lg hover:bg-[#263872] transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Create Your First Project
                    </a>
                </div>
            @endforelse
        </div>

    </div>
</x-app-layout>