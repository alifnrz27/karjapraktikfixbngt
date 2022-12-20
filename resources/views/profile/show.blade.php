<x-app-layout>
    @section('title', 'Edit profile')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="w-full flex pt-5 pb-6">
        <x-sidebar></x-sidebar>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <section class="pb-4">
                <div class="container flex justify-between">
                    <div class=" self-center px-4">
                        <h1 class="text-base font-semibold text-primary md:text-xl">Update profile, <span class="block font-bold text-dark dark:text-white text-4xl lg:text-5xl">{{ auth()->user()->name }}</span></h1>
                        <h1 class="text-base font-semibold text-primary md:text-l">{{ date('d-M-Y') }}</h1>
                    </div>
                    <div class=" self-center px-4 hidden sm:block">
                        <h1 class="text-base font-semibold text-primary md:text-l">Kerja Praktik <span class="block font-bold text-dark dark:text-white text-4xl lg:text-2xl">Teknik Elektro</span></h1>
                        <h1 class="text-base font-semibold text-primary md:text-sm">ITERA</h1>
                    </div>
                </div>
                <hr>
            </section>
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')

                <x-jet-section-border />
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class=" sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <x-jet-section-border />
            @endif

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class=" sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>

                <x-jet-section-border />
            @endif

            <div class=" sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-jet-section-border />

                <div class=" sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
