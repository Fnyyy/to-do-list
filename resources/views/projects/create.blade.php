<x-app-layout>
    <div class="max-w-2xl mx-auto">

        <!-- Back + Header -->
        <div class="mb-8">
            <a href="{{ route('projects.index') }}"
                class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-slate-700 transition-colors mb-4">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
                Back to Projects
            </a>
            <h1 class="text-2xl font-bold text-slate-800">Create New Project</h1>
            <p class="text-slate-500 text-sm mt-1">Fill in the details below to set up your project.</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <form action="{{ route('projects.store') }}" method="POST">
                @csrf

                <div class="p-8 space-y-6">

                    <!-- Project Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">
                            Project Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                            placeholder="e.g. Website Redesign, Mobile App v2.0"
                            class="w-full px-4 py-2.5 rounded-lg border border-slate-300 text-slate-800 text-sm placeholder-slate-400
                                   focus:outline-none focus:ring-2 focus:ring-[#4361ee]/40 focus:border-[#4361ee] transition-colors
                                   @error('name') border-red-400 focus:ring-red-400/30 @enderror" />
                        <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
                    </div>

                    <!-- Workspace -->
                    <div>
                        <label for="workspace_id" class="block text-sm font-medium text-slate-700 mb-1.5">
                            Workspace <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select id="workspace_id" name="workspace_id"
                                class="w-full appearance-none px-4 py-2.5 rounded-lg border border-slate-300 text-slate-700 text-sm bg-white
                                       focus:outline-none focus:ring-2 focus:ring-[#4361ee]/40 focus:border-[#4361ee] transition-colors cursor-pointer
                                       @error('workspace_id') border-red-400 @enderror">
                                <option value="" disabled selected>Select a workspace...</option>
                                @foreach($workspaces as $workspace)
                                    <option value="{{ $workspace->id }}" {{ old('workspace_id') == $workspace->id ? 'selected' : '' }}>
                                        {{ $workspace->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('workspace_id')" class="mt-1.5" />
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-slate-700 mb-1.5">
                            Description <span class="text-slate-400 font-normal">(optional)</span>
                        </label>
                        <textarea id="description" name="description" rows="4"
                            placeholder="Describe the project goals, scope, and key deliverables..."
                            class="w-full px-4 py-2.5 rounded-lg border border-slate-300 text-slate-800 text-sm placeholder-slate-400
                                   focus:outline-none focus:ring-2 focus:ring-[#4361ee]/40 focus:border-[#4361ee] transition-colors resize-none
                                   @error('description') border-red-400 @enderror">{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-1.5" />
                    </div>

                    <!-- Due Date -->
                    <div>
                        <label for="due_date" class="block text-sm font-medium text-slate-700 mb-1.5">
                            Due Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" id="due_date" name="due_date" value="{{ old('due_date') }}" required
                            min="{{ date('Y-m-d') }}"
                            class="w-full px-4 py-2.5 rounded-lg border border-slate-300 text-slate-700 text-sm
                                   focus:outline-none focus:ring-2 focus:ring-[#4361ee]/40 focus:border-[#4361ee] transition-colors
                                   @error('due_date') border-red-400 @enderror" />
                        <x-input-error :messages="$errors->get('due_date')" class="mt-1.5" />
                    </div>

                </div>

                <!-- Form Footer -->
                <div class="flex items-center justify-end gap-3 px-8 py-5 bg-slate-50 border-t border-slate-100">
                    <a href="{{ route('projects.index') }}"
                        class="px-5 py-2.5 text-sm font-medium text-slate-600 hover:text-slate-800 hover:bg-slate-200 rounded-lg transition-colors">
                        Cancel
                    </a>
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#1e2d5a] hover:bg-[#263872] text-white text-sm font-semibold rounded-lg
                               transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-[#1e2d5a]/30 focus:ring-offset-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Create Project
                    </button>
                </div>
            </form>
        </div>

    </div>
</x-app-layout>