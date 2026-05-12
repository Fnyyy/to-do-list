<x-guest-layout>
    <div x-data="{
        tab: {{ ($errors->has('name') || $errors->has('password_confirmation') || old('name')) ? '\'register\'' : '\'login\'' }}
    }">

        <!-- Tab headers -->
        <div class="flex bg-white rounded-xl shadow-sm border border-slate-200 p-1 mb-6">
            <button @click="tab = 'login'"
                :class="tab === 'login' ? 'bg-[#1e2d5a] text-white shadow-sm' : 'text-slate-500 hover:text-slate-700'"
                class="flex-1 py-2.5 text-sm font-semibold rounded-lg transition-all duration-200">
                Sign In
            </button>
            <button @click="tab = 'register'"
                :class="tab === 'register' ? 'bg-[#1e2d5a] text-white shadow-sm' : 'text-slate-500 hover:text-slate-700'"
                class="flex-1 py-2.5 text-sm font-semibold rounded-lg transition-all duration-200">
                Create Account
            </button>
        </div>

        <!-- Login Form -->
        <div x-show="tab === 'login'" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0">

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
                <div class="mb-7">
                    <h1 class="text-2xl font-bold text-slate-800">Welcome back</h1>
                    <p class="text-slate-500 text-sm mt-1">Sign in to your Synergy workspace</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                @if ($errors->any() && !$errors->has('name') && !$errors->has('password_confirmation'))
                    <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-lg text-sm text-red-600">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            autocomplete="username" placeholder="you@example.com"
                            class="w-full px-4 py-2.5 rounded-lg border border-slate-300 text-slate-800 text-sm placeholder-slate-400
                                   focus:outline-none focus:ring-2 focus:ring-[#4361ee]/40 focus:border-[#4361ee] transition-colors
                                   @error('email') border-red-400 focus:ring-red-400/30 @enderror" />
                        <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
                    </div>

                    <!-- Password -->
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                    class="text-xs text-[#4361ee] hover:text-[#3a56d4] font-medium transition-colors">
                                    Forgot password?
                                </a>
                            @endif
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            placeholder="••••••••"
                            class="w-full px-4 py-2.5 rounded-lg border border-slate-300 text-slate-800 text-sm placeholder-slate-400
                                   focus:outline-none focus:ring-2 focus:ring-[#4361ee]/40 focus:border-[#4361ee] transition-colors
                                   @error('password') border-red-400 focus:ring-red-400/30 @enderror" />
                        <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
                    </div>

                    <!-- Remember me -->
                    <div class="flex items-center gap-2">
                        <input id="remember_me" type="checkbox" name="remember"
                            class="w-4 h-4 rounded border-slate-300 text-[#4361ee] focus:ring-[#4361ee]/30 cursor-pointer">
                        <label for="remember_me" class="text-sm text-slate-600 cursor-pointer select-none">Remember me for 30 days</label>
                    </div>

                    <button type="submit"
                        class="w-full py-2.5 px-4 bg-[#1e2d5a] hover:bg-[#263872] text-white text-sm font-semibold rounded-lg
                               transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-[#1e2d5a]/40 focus:ring-offset-2">
                        Sign in to Synergy
                    </button>
                </form>

                <p class="mt-6 text-center text-sm text-slate-500">
                    Don't have an account?
                    <button @click="tab = 'register'" class="text-[#4361ee] font-semibold hover:underline">Create one</button>
                </p>
            </div>
        </div>

        <!-- Register Form -->
        <div x-show="tab === 'register'" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
            style="display: none;">

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
                <div class="mb-7">
                    <h1 class="text-2xl font-bold text-slate-800">Create your account</h1>
                    <p class="text-slate-500 text-sm mt-1">Join Synergy and start collaborating</p>
                </div>

                @if ($errors->any() && ($errors->has('name') || $errors->has('password_confirmation')))
                    <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-lg text-sm text-red-600">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="register_name" class="block text-sm font-medium text-slate-700 mb-1.5">Full name</label>
                        <input id="register_name" type="text" name="name" value="{{ old('name') }}" required autofocus
                            autocomplete="name" placeholder="John Doe"
                            class="w-full px-4 py-2.5 rounded-lg border border-slate-300 text-slate-800 text-sm placeholder-slate-400
                                   focus:outline-none focus:ring-2 focus:ring-[#4361ee]/40 focus:border-[#4361ee] transition-colors
                                   @error('name') border-red-400 @enderror" />
                        <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="register_email" class="block text-sm font-medium text-slate-700 mb-1.5">Email address</label>
                        <input id="register_email" type="email" name="email" value="{{ old('email') }}" required
                            autocomplete="username" placeholder="you@example.com"
                            class="w-full px-4 py-2.5 rounded-lg border border-slate-300 text-slate-800 text-sm placeholder-slate-400
                                   focus:outline-none focus:ring-2 focus:ring-[#4361ee]/40 focus:border-[#4361ee] transition-colors
                                   @error('email') border-red-400 @enderror" />
                        <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="register_password" class="block text-sm font-medium text-slate-700 mb-1.5">Password</label>
                        <input id="register_password" type="password" name="password" required autocomplete="new-password"
                            placeholder="Min. 8 characters"
                            class="w-full px-4 py-2.5 rounded-lg border border-slate-300 text-slate-800 text-sm placeholder-slate-400
                                   focus:outline-none focus:ring-2 focus:ring-[#4361ee]/40 focus:border-[#4361ee] transition-colors
                                   @error('password') border-red-400 @enderror" />
                        <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="register_password_confirmation" class="block text-sm font-medium text-slate-700 mb-1.5">Confirm password</label>
                        <input id="register_password_confirmation" type="password" name="password_confirmation" required
                            autocomplete="new-password" placeholder="Re-enter your password"
                            class="w-full px-4 py-2.5 rounded-lg border border-slate-300 text-slate-800 text-sm placeholder-slate-400
                                   focus:outline-none focus:ring-2 focus:ring-[#4361ee]/40 focus:border-[#4361ee] transition-colors
                                   @error('password_confirmation') border-red-400 @enderror" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5" />
                    </div>

                    <button type="submit"
                        class="w-full py-2.5 px-4 bg-[#1e2d5a] hover:bg-[#263872] text-white text-sm font-semibold rounded-lg
                               transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-[#1e2d5a]/40 focus:ring-offset-2 mt-2">
                        Create Account
                    </button>
                </form>

                <p class="mt-6 text-center text-sm text-slate-500">
                    Already have an account?
                    <button @click="tab = 'login'" class="text-[#4361ee] font-semibold hover:underline">Sign in</button>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>