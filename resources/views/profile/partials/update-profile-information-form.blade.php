<section class="space-y-5">
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('patch')

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">Full Name</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus
                autocomplete="name"
                class="w-full px-4 py-2.5 rounded-lg border border-slate-300 text-slate-800 text-sm
                       focus:outline-none focus:ring-2 focus:ring-[#4361ee]/40 focus:border-[#4361ee] transition-colors
                       @error('name') border-red-400 @enderror" />
            <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email Address</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
                autocomplete="username"
                class="w-full px-4 py-2.5 rounded-lg border border-slate-300 text-slate-800 text-sm
                       focus:outline-none focus:ring-2 focus:ring-[#4361ee]/40 focus:border-[#4361ee] transition-colors
                       @error('email') border-red-400 @enderror" />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2 p-3 bg-amber-50 border border-amber-200 rounded-lg">
                    <p class="text-sm text-amber-700">
                        Your email address is unverified.
                        <button form="send-verification"
                            class="underline font-medium hover:text-amber-900 transition-colors">
                            Click here to resend the verification email.
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-1 text-sm text-green-700 font-medium">
                            A new verification link has been sent to your email address.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Actions -->
        <div class="flex items-center gap-3 pt-1">
            <button type="submit"
                class="px-5 py-2.5 bg-[#1e2d5a] hover:bg-[#263872] text-white text-sm font-semibold rounded-lg
                       transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-[#1e2d5a]/30 focus:ring-offset-2">
                Save Changes
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2500)"
                    class="text-sm text-green-600 font-medium flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    Saved!
                </p>
            @endif
        </div>
    </form>
</section>
