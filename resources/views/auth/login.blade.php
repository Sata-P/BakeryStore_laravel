<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-[#5C4033]" />
            <x-text-input 
                id="email" 
                class="block mt-1 w-full border-[#CEAB93] bg-[#E3CAA5] text-[#5C4033] placeholder:text-[#AD8B73] focus:border-[#AD8B73] focus:ring-[#AD8B73]"
                type="email" 
                name="email" 
                :value="old('email')" 
                required autofocus autocomplete="username" 
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-[#5C4033]" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-[#5C4033]" />
            <x-text-input 
                id="password" 
                class="block mt-1 w-full border-[#CEAB93] bg-[#E3CAA5] text-[#5C4033] placeholder:text-[#AD8B73] focus:border-[#AD8B73] focus:ring-[#AD8B73]" 
                type="password" 
                name="password" 
                required autocomplete="current-password" 
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-[#5C4033]" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input 
                    id="remember_me" 
                    type="checkbox"
                    class="rounded border-[#CEAB93] text-[#AD8B73] focus:ring-[#AD8B73] bg-[#FFFBE9] shadow-sm"
                    name="remember"
                >
                <span class="ms-2 text-sm text-[#5C4033]">{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- Links + Button -->
        <div class="flex items-center justify-end mt-6">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-[#5C4033] hover:text-[#2F1B0C] transition font-medium"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <a class="underline text-sm text-[#5C4033] hover:text-[#2F1B0C] transition font-medium ms-4"
                href="{{ url('/register') }}">
                {{ __('Register?') }}
            </a>


            <button 
                type="submit" 
                class="ms-4 inline-flex items-center px-5 py-2 bg-[#5C4033] text-[#FFFBE9] font-semibold rounded-md shadow-md hover:bg-[#AD8B73] focus:ring-2 focus:ring-[#CEAB93] focus:outline-none transition"
            >
                Log in
            </button>
        </div>
    </form>
</x-guest-layout>
