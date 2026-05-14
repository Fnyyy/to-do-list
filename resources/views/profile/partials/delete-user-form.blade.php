<section x-data="{ deleteModalOpen: false }">
    <p class="text-sm text-slate-500 leading-relaxed">
        Once your account is deleted, all of its resources and data will be permanently deleted.
        Please download any data you wish to retain before proceeding.
    </p>

    <div class="mt-5">
        <button type="button" @click="deleteModalOpen = true"
            class="inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-red-300 hover:bg-red-50 text-red-600 text-sm font-semibold rounded-lg transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
            Delete Account
        </button>
    </div>

    <!-- Delete Confirmation Modal -->
    <div x-show="deleteModalOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4" style="display:none;">
        <div class="absolute inset-0 bg-black/40" @click="deleteModalOpen = false"></div>

        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100">

            <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                    </div>
                    <h3 class="text-base font-semibold text-slate-800">Delete Account</h3>
                </div>
                <button @click="deleteModalOpen = false"
                    class="p-1.5 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form method="post" action="{{ route('profile.destroy') }}" class="p-6 space-y-5">
                @csrf
                @method('delete')

                <p class="text-sm text-slate-600 leading-relaxed">
                    This action is <strong class="text-slate-800">irreversible</strong>. All your data will be permanently deleted.
                    Please enter your password to confirm.
                </p>

                <div>
                    <label for="delete_password" class="block text-sm font-medium text-slate-700 mb-1.5">Your Password</label>
                    <input id="delete_password" name="password" type="password" required
                        placeholder="Enter your password to confirm"
                        class="w-full px-4 py-2.5 rounded-lg border border-slate-300 text-slate-800 text-sm placeholder-slate-400
                               focus:outline-none focus:ring-2 focus:ring-red-400/40 focus:border-red-400 transition-colors" />
                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-1.5" />
                </div>

                <div class="flex items-center justify-end gap-3 pt-2">
                    <button type="button" @click="deleteModalOpen = false"
                        class="px-4 py-2.5 text-sm font-medium text-slate-600 hover:text-slate-800 hover:bg-slate-100 rounded-lg transition-colors">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-lg
                               transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-500/30 focus:ring-offset-2">
                        Permanently Delete Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
