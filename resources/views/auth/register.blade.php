<x-guest-layout>
    @section('title', 'Register')
    <div id="status" class="container flex justify-content-center">
        <div class="flex fixed mt-40">
            <x-jet-validation-errors class=" fixed mx-auto items-center self-center justify-center bg-white px-5 py-7 rounded-md" />
        </div>
    </div>
    
    <section id="contact" class="pt-36 pb-32 dark:bg-slate-900">
        <div class="container">
            <div class="w-full px-4">
                <div class="mx-auto text-center mb-16">
                    <h4 class="font-semibold text-lg text-primary mb-2">Register</h4>
                    <h2 class="font-bold text-dark dark:text-white text-3xl mb-4 sm:text-4xl lg:text-5xl">Selamat Datang</h2>
                </div>
            </div>

    
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="w-full lg:w-2/3 lg:mx-auto">
                    <div class="w-full mb-8 px-4">
                        <label for="name" class="text-base text-primary font-bold">Nama</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full bg-slate-200 text-dark p-3 rounded-md focus:outline-none focus:ring-primary focus:ring-1 focus:border-primary" required autofocus>
                    </div>
                    <div class="w-full mb-8 px-4">
                        <label for="email" class="text-base text-primary font-bold">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full bg-slate-200 text-dark p-3 rounded-md focus:outline-none focus:ring-primary focus:ring-1 focus:border-primary" required>
                    </div>
                    <div class="w-full mb-8 px-4">
                        <label for="password" class="text-base text-primary font-bold">Password</label>
                        <input type="password" id="password" name="password" class="w-full bg-slate-200 text-dark p-3 rounded-md focus:outline-none focus:ring-primary focus:ring-1 focus:border-primary"  required autocomplete="new-password">
                    </div>
                    <div class="w-full mb-8 px-4">
                        <label for="password_confirmation" class="text-base text-primary font-bold">Konfirmasi Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="w-full bg-slate-200 text-dark p-3 rounded-md focus:outline-none focus:ring-primary focus:ring-1 focus:border-primary"  required autocomplete="new-password">
                    </div>
                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="px-4 mt-4 mb-4">
                            <x-jet-label for="terms">
                                <div class="flex items-center">
                                    <x-jet-checkbox name="terms" id="terms" required />

                                    <div class="ml-2">
                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                        ]) !!}
                                    </div>
                                </div>
                            </x-jet-label>
                        </div>
                    @endif
                    <div class="w-full mb-8 px-4 flex">
                        <a class="underline text-sm text-gray-600 hover:text-primary" href="/login">
                            {{ __('Already have an account? Login') }}
                        </a>
                    </div>
                    <div class="w-full">
                        <button type="submit" class="text-base font-semibold text-white bg-primary py-3 px-8 rounded-full w-full hover:opacity-80 hover:shadow-lg transition duration-500">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</x-guest-layout>
