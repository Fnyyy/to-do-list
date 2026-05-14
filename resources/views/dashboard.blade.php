<x-app-layout>
    <div class="space-y-8">

        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Dashboard</h1>
                <p class="text-slate-500 text-sm mt-1">
                    Good {{ now()->hour < 12 ? 'morning' : (now()->hour < 18 ? 'afternoon' : 'evening') }},
                    <span class="font-medium text-slate-700">{{ Auth::user()->name }}</span>.
                    Here's an overview of your workspace.
                </p>
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

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            <!-- Total Projects -->
            <div class="bg-white rounded-xl border border-slate-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-sm font-medium text-slate-500">Total Projects</p>
                    <div class="w-9 h-9 rounded-lg bg-blue-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-slate-800">{{ $stats['projects'] }}</p>
                <p class="text-xs text-slate-400 mt-1">All workspaces</p>
            </div>

            <!-- Pending Tasks -->
            <div class="bg-white rounded-xl border border-slate-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-sm font-medium text-slate-500">Pending Tasks</p>
                    <div class="w-9 h-9 rounded-lg bg-amber-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-slate-800">{{ $stats['pending_tasks'] }}</p>
                <p class="text-xs text-slate-400 mt-1">To do &amp; in progress</p>
            </div>

            <!-- Upcoming Deadlines -->
            <div class="bg-white rounded-xl border border-slate-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-sm font-medium text-slate-500">Upcoming Deadlines</p>
                    <div class="w-9 h-9 rounded-lg bg-red-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-slate-800">{{ $stats['upcoming_deadlines'] }}</p>
                <p class="text-xs text-slate-400 mt-1">Within next 7 days</p>
            </div>
        </div>

        <!-- Recent Projects Table -->
        <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                <h2 class="text-base font-semibold text-slate-800">Recent Projects</h2>
                <a href="{{ route('projects.index') }}"
                    class="text-sm font-medium text-[#4361ee] hover:text-[#3a56d4] transition-colors">
                    View all →
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-slate-100 bg-slate-50">
                            <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Project</th>
                            <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                            <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Due Date</th>
                            <th class="text-right px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($recentProjects as $project)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-lg bg-[#1e2d5a]/10 flex items-center justify-center text-[#1e2d5a] font-bold text-xs flex-shrink-0">
                                            {{ strtoupper(substr($project->name, 0, 2)) }}
                                        </div>
                                        <span class="font-medium text-slate-800">{{ $project->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusCfg = [
                                            'active'    => ['bg-green-100 text-green-700',  '●'],
                                            'completed' => ['bg-blue-100 text-blue-700',    '●'],
                                            'on_hold'   => ['bg-slate-100 text-slate-600',  '●'],
                                        ];
                                        [$cls, $dot] = $statusCfg[$project->status] ?? ['bg-slate-100 text-slate-600', '●'];
                                    @endphp
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold {{ $cls }}">
                                        <span class="text-[8px]">{{ $dot }}</span>
                                        {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-slate-500">
                                    {{ $project->due_date ? $project->due_date->format('M d, Y') : '—' }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('projects.show', $project) }}"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-medium transition-colors">
                                        Open
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-16 text-center">
                                    <svg class="w-10 h-10 text-slate-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                                    </svg>
                                    <p class="text-slate-500 font-medium mb-1">No projects yet</p>
                                    <p class="text-slate-400 text-sm mb-4">Create your first project to get started.</p>
                                    <a href="{{ route('projects.create') }}"
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-[#1e2d5a] text-white text-sm font-medium rounded-lg hover:bg-[#263872] transition-colors">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>
                                        Create Project
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>