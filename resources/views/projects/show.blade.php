<x-app-layout>
    <div x-data="{
        taskModalOpen: false,
        activeTab: 'board',
    }" class="flex flex-col h-full" style="min-height: calc(100vh - 8rem);">

        <!-- ══════════════ PROJECT HEADER ══════════════ -->
        <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 mb-6">
            <div class="flex-1 min-w-0">
                <!-- Back link -->
                <a href="{{ route('projects.index') }}"
                    class="inline-flex items-center gap-1 text-sm text-slate-500 hover:text-slate-700 transition-colors mb-3">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                    All Projects
                </a>

                <div class="flex flex-wrap items-center gap-3">
                    <h1 class="text-2xl font-bold text-slate-800 truncate">{{ $project->name }}</h1>
                    @php
                        $sCfg = [
                            'active'    => 'bg-green-100 text-green-700',
                            'completed' => 'bg-blue-100 text-blue-700',
                            'on_hold'   => 'bg-slate-100 text-slate-600',
                        ];
                        $sCls = $sCfg[$project->status] ?? 'bg-slate-100 text-slate-600';
                    @endphp
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $sCls }}">
                        {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                    </span>
                </div>

                @if($project->description)
                    <p class="text-slate-500 text-sm mt-2 max-w-2xl leading-relaxed">{{ $project->description }}</p>
                @endif

                @if($project->due_date)
                    <div class="flex items-center gap-1.5 text-xs text-slate-400 mt-3">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                        Due {{ $project->due_date->format('F j, Y') }}
                        @if($project->due_date->isPast())
                            <span class="text-red-500 font-medium">(Overdue)</span>
                        @elseif($project->due_date->diffInDays() <= 7)
                            <span class="text-amber-600 font-medium">({{ $project->due_date->diffForHumans() }})</span>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-3 flex-shrink-0">
                <!-- View toggle -->
                <div class="flex bg-white border border-slate-200 rounded-lg p-1">
                    <button @click="activeTab = 'board'"
                        :class="activeTab === 'board' ? 'bg-slate-100 text-slate-800' : 'text-slate-500 hover:text-slate-700'"
                        class="flex items-center gap-1.5 px-3 py-1.5 rounded-md text-xs font-medium transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2" />
                        </svg>
                        Board
                    </button>
                    <button @click="activeTab = 'list'"
                        :class="activeTab === 'list' ? 'bg-slate-100 text-slate-800' : 'text-slate-500 hover:text-slate-700'"
                        class="flex items-center gap-1.5 px-3 py-1.5 rounded-md text-xs font-medium transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                        List
                    </button>
                </div>

                <button @click="taskModalOpen = true"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#1e2d5a] hover:bg-[#263872] text-white text-sm font-semibold rounded-lg
                           transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-[#1e2d5a]/30 focus:ring-offset-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Add Task
                </button>
            </div>
        </div>

        <!-- ══════════════ BOARD VIEW ══════════════ -->
        <div x-show="activeTab === 'board'" class="flex gap-4 overflow-x-auto pb-4 flex-1"
            style="scrollbar-width: thin; scrollbar-color: #cbd5e1 transparent;">
            @php
                $statuses = [
                    'todo'        => ['label' => 'To Do',       'color' => 'slate',  'dot' => 'bg-slate-400'],
                    'in_progress' => ['label' => 'In Progress', 'color' => 'blue',   'dot' => 'bg-blue-500'],
                    'review'      => ['label' => 'In Review',   'color' => 'amber',  'dot' => 'bg-amber-500'],
                    'done'        => ['label' => 'Done',        'color' => 'green',  'dot' => 'bg-green-500'],
                ];
            @endphp

            @foreach($statuses as $statusKey => $statusCfg)
                @php $columnTasks = $project->tasks->where('status', $statusKey); @endphp
                <div class="flex-shrink-0 w-72 flex flex-col bg-slate-100 rounded-xl border border-slate-200 max-h-full">
                    <!-- Column header -->
                    <div class="flex items-center justify-between px-4 py-3 border-b border-slate-200">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full {{ $statusCfg['dot'] }}"></span>
                            <h3 class="text-sm font-semibold text-slate-700">{{ $statusCfg['label'] }}</h3>
                        </div>
                        <span class="w-5 h-5 flex items-center justify-center rounded-full bg-white border border-slate-200 text-[10px] font-bold text-slate-500">
                            {{ $columnTasks->count() }}
                        </span>
                    </div>

                    <!-- Column cards -->
                    <div class="p-3 space-y-2.5 overflow-y-auto flex-1" style="scrollbar-width: thin; scrollbar-color: #cbd5e1 transparent;">
                        @forelse($columnTasks as $task)
                            <div class="group bg-white rounded-lg border border-slate-200 hover:border-slate-300 hover:shadow-sm transition-all duration-150 p-4 relative">
                                <!-- Priority badge + delete -->
                                <div class="flex items-center justify-between mb-2.5">
                                    @php
                                        $pCfg = [
                                            'urgent' => 'bg-red-100 text-red-700',
                                            'high'   => 'bg-orange-100 text-orange-700',
                                            'medium' => 'bg-amber-100 text-amber-700',
                                            'low'    => 'bg-slate-100 text-slate-600',
                                        ];
                                        $pCls = $pCfg[$task->priority] ?? 'bg-slate-100 text-slate-600';
                                    @endphp
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wide {{ $pCls }}">
                                        {{ $task->priority }}
                                    </span>
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                                        onsubmit="return confirm('Delete this task?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="opacity-0 group-hover:opacity-100 text-slate-400 hover:text-red-500 transition-all p-0.5 rounded">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>

                                <!-- Task title -->
                                <h4 class="text-sm font-medium text-slate-800 leading-snug mb-3">{{ $task->title }}</h4>

                                <!-- Footer: assignee + move buttons -->
                                <div class="flex items-center justify-between">
                                    <div>
                                        @if($task->assigned_to && $task->assignee)
                                            <div class="w-6 h-6 rounded-full bg-[#1e2d5a] flex items-center justify-center text-white font-bold text-[10px]"
                                                title="{{ $task->assignee->name }}">
                                                {{ strtoupper(substr($task->assignee->name, 0, 1)) }}
                                            </div>
                                        @else
                                            <div class="w-6 h-6 rounded-full border border-dashed border-slate-300 flex items-center justify-center" title="Unassigned">
                                                <svg class="w-3 h-3 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Status move buttons (show on hover) -->
                                    <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                        @foreach($statuses as $sKey => $sCfg)
                                            @if($sKey !== $statusKey)
                                                <form action="{{ route('tasks.update', $task) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="{{ $sKey }}">
                                                    <button type="submit"
                                                        title="Move to {{ $sCfg['label'] }}"
                                                        class="w-5 h-5 rounded flex items-center justify-center bg-slate-100 hover:bg-slate-200 transition-colors text-slate-500 hover:text-slate-700">
                                                        <span class="text-[8px] font-bold leading-none">
                                                            {{ strtoupper(substr($sCfg['label'], 0, 1)) }}
                                                        </span>
                                                    </button>
                                                </form>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="py-8 text-center">
                                <p class="text-xs text-slate-400">No tasks here</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>

        <!-- ══════════════ LIST VIEW ══════════════ -->
        <div x-show="activeTab === 'list'"
            class="bg-white rounded-xl border border-slate-200 overflow-hidden"
            style="display:none;">

            <div class="px-6 py-4 border-b border-slate-100">
                <h2 class="text-sm font-semibold text-slate-700">All Tasks ({{ $project->tasks->count() }})</h2>
            </div>

            @if($project->tasks->isEmpty())
                <div class="py-16 text-center">
                    <p class="text-slate-400 text-sm">No tasks yet. Add your first task!</p>
                </div>
            @else
                <div class="divide-y divide-slate-50">
                    @foreach($project->tasks->sortBy('status') as $task)
                        @php
                            $pCfg = [
                                'urgent' => 'bg-red-100 text-red-700',
                                'high'   => 'bg-orange-100 text-orange-700',
                                'medium' => 'bg-amber-100 text-amber-700',
                                'low'    => 'bg-slate-100 text-slate-600',
                            ];
                            $pCls = $pCfg[$task->priority] ?? 'bg-slate-100 text-slate-600';

                            $sCfg2 = [
                                'todo'        => 'text-slate-500',
                                'in_progress' => 'text-blue-600',
                                'review'      => 'text-amber-600',
                                'done'        => 'text-green-600',
                            ];
                            $sCls2 = $sCfg2[$task->status] ?? 'text-slate-500';
                            $statusLabel = $statuses[$task->status]['label'] ?? ucfirst($task->status);
                        @endphp
                        <div class="flex items-center gap-4 px-6 py-4 hover:bg-slate-50 transition-colors group">
                            <!-- Status dot -->
                            <span class="w-2 h-2 rounded-full {{ $statuses[$task->status]['dot'] ?? 'bg-slate-300' }} flex-shrink-0"></span>

                            <!-- Title -->
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-slate-800">{{ $task->title }}</p>
                            </div>

                            <!-- Priority badge -->
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wide {{ $pCls }} flex-shrink-0">
                                {{ $task->priority }}
                            </span>

                            <!-- Status label -->
                            <span class="text-xs font-medium {{ $sCls2 }} hidden sm:block flex-shrink-0 w-24 text-right">
                                {{ $statusLabel }}
                            </span>

                            <!-- Delete -->
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                                onsubmit="return confirm('Delete this task?')"
                                class="flex-shrink-0 opacity-0 group-hover:opacity-100 transition-opacity">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-slate-400 hover:text-red-500 transition-colors p-1 rounded">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- ══════════════ ADD TASK MODAL ══════════════ -->
        <div x-show="taskModalOpen"
            class="fixed inset-0 z-50 flex items-center justify-center p-4"
            style="display:none;">
            <!-- Backdrop -->
            <div class="absolute inset-0 bg-black/40" @click="taskModalOpen = false"></div>

            <!-- Modal -->
            <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95">

                <!-- Modal header -->
                <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
                    <h3 class="text-base font-semibold text-slate-800">Add New Task</h3>
                    <button @click="taskModalOpen = false"
                        class="p-1.5 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Modal body -->
                <form action="{{ route('tasks.store', $project) }}" method="POST" class="p-6 space-y-5">
                    @csrf
                    <div>
                        <label for="task_title" class="block text-sm font-medium text-slate-700 mb-1.5">Task Title <span class="text-red-500">*</span></label>
                        <input type="text" id="task_title" name="title" required placeholder="e.g. Design landing page hero section"
                            class="w-full px-4 py-2.5 rounded-lg border border-slate-300 text-slate-800 text-sm placeholder-slate-400
                                   focus:outline-none focus:ring-2 focus:ring-[#4361ee]/40 focus:border-[#4361ee] transition-colors">
                    </div>

                    <div>
                        <label for="task_priority" class="block text-sm font-medium text-slate-700 mb-1.5">Priority</label>
                        <select id="task_priority" name="priority"
                            class="w-full px-4 py-2.5 rounded-lg border border-slate-300 text-slate-700 text-sm
                                   focus:outline-none focus:ring-2 focus:ring-[#4361ee]/40 focus:border-[#4361ee] transition-colors bg-white">
                            <option value="low">🟢 Low</option>
                            <option value="medium" selected>🟡 Medium</option>
                            <option value="high">🟠 High</option>
                            <option value="urgent">🔴 Urgent</option>
                        </select>
                    </div>

                    <!-- Modal footer -->
                    <div class="flex items-center justify-end gap-3 pt-2">
                        <button type="button" @click="taskModalOpen = false"
                            class="px-4 py-2.5 text-sm font-medium text-slate-600 hover:text-slate-800 hover:bg-slate-100 rounded-lg transition-colors">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-5 py-2.5 text-sm font-semibold text-white bg-[#1e2d5a] hover:bg-[#263872] rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-[#1e2d5a]/30 focus:ring-offset-2">
                            Add Task
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>