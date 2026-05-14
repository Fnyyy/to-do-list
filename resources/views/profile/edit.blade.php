<x-app-layout>
    <div class="max-w-2xl mx-auto space-y-6">

        <!-- Page Header -->
        <div class="mb-2">
            <h1 class="text-2xl font-bold text-slate-800">Profile Settings</h1>
            <p class="text-slate-500 text-sm mt-1">Manage your account information and security settings.</p>
        </div>

        <!-- Update Profile Information -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100">
                <h2 class="text-sm font-semibold text-slate-700">Personal Information</h2>
                <p class="text-xs text-slate-400 mt-0.5">Update your name and email address.</p>
            </div>
            <div class="p-6">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- Update Password -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100">
                <h2 class="text-sm font-semibold text-slate-700">Password</h2>
                <p class="text-xs text-slate-400 mt-0.5">Use a strong password to keep your account secure.</p>
            </div>
            <div class="p-6">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- Danger Zone: Delete Account -->
        <div class="bg-white rounded-xl border border-red-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-red-100">
                <h2 class="text-sm font-semibold text-red-600">Danger Zone</h2>
                <p class="text-xs text-slate-400 mt-0.5">Irreversible actions. Proceed with caution.</p>
            </div>
            <div class="p-6">
                @include('profile.partials.delete-user-form')
            </div>
        </div>

    </div>
</x-app-layout>
