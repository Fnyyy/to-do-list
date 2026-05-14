<section class="space-y-5">
    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div>
            <label for="update_password_current_password" class="block text-sm font-medium text-slate-700 mb-1.5">Current Password</label>
            <input id="update_password_current_password" name="current_password" type="password"
                autocomplete="current-password" placeholder="Enter current password"
                class="w-full px-4 py-2.5 rounded-lg border border-slate-300 text-slate-800 text-sm placeholder-slate-400
                       focus:outline-none focus:ring-2 focus:ring-[#4361ee]/40 focus:border-[#4361ee] transition-colors
                       @error('current_password', 'updatePassword') border-red-400 @enderror" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-1.5" />
        </div>

        <!-- New Password -->
        <div>
            <label for="update_password_password" class="block text-sm font-medium text-slate-700 mb-1.5">New Password</label>
            <input id="update_password_password" name="password" type="password"
                autocomplete="new-password" placeholder="Min. 8 characters"
                class="w-full px-4 py-2.5 rounded-lg border border-slate-300 text-slate-800 text-sm placeholder-slate-400
                       focus:outline-none focus:ring-2 focus:ring-[#4361ee]/40 focus:border-[#4361ee] transition-colors
                       @error('password', 'updatePassword') border-red-400 @enderror" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-1.5" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-medium text-slate-700 mb-1.5">Confirm New Password</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                autocomplete="new-password" placeholder="Re-enter new password"
                class="w-full px-4 py-2.5 rounded-lg border border-slate-300 text-slate-800 text-sm placeholder-slate-400
                       focus:outline-none focus:ring-2 focus:ring-[#4361ee]/40 focus:border-[#4361ee] transition-colors
                       @error('password_confirmation', 'updatePassword') border-red-400 @enderror" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-1.5" />
        </div>

        <!-- Actions -->
        <div class="flex items-center gap-3 pt-1">
            <button type="submit"
                class="px-5 py-2.5 bg-[#1e2d5a] hover:bg-[#263872] text-white text-sm font-semibold rounded-lg
                       transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-[#1e2d5a]/30 focus:ring-offset-2">
                Update Password
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2500)"
                    class="text-sm text-green-600 font-medium flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    Password updated!
                </p>
            @endif
        </div>
    </form>
</section>
