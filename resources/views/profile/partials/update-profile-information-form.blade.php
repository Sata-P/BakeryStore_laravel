

<section class="bg-[#FFFBE9] p-6 rounded-xl border border-[#E3CAA5]">
    <header>
        <h2 class="text-lg font-medium text-[#AD8B73]">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-[#5C4033]">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" class="text-[#AD8B73]" />
            <x-text-input id="name" name="name" type="text"
                class="mt-1 block w-full border border-[#CEAB93] focus:ring-[#AD8B73] focus:border-[#AD8B73] rounded-md"
                :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2 text-red-600" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-[#AD8B73]" />
            <x-text-input id="email" name="email" type="email"
                class="mt-1 block w-full border border-[#CEAB93] focus:ring-[#AD8B73] focus:border-[#AD8B73] rounded-md"
                :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2 text-red-600" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-[#5C4033]">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-[#AD8B73] hover:text-[#8B6C58] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#AD8B73]">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-[#CEAB93] hover:bg-[#AD8B73] text-white font-semibold transition duration-200">
                {{ __('Save') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-[#5C4033]">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>

