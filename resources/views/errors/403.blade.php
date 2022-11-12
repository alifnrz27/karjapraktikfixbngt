<x-guest-layout>
    @section('title', '403')
    <section id="contact" class="pt-36 pb-32 dark:bg-slate-900">
        <div class="container">
            <div class="w-full px-4">
                <div class="mx-auto text-center mb-16">
                    <h2 class="font-bold text-dark dark:text-white text-3xl mb-4 sm:text-4xl lg:text-5xl">403 Access Denied</h2>
                    <img src="/assets/images/errors/403.jpeg" class="mx-auto max-w-xl mb-5" alt="">
                    <a href="/dashboard" class="text-base font-semibold text-white bg-primary mt-7 py-3 px-8 rounded-full hover:shadow-lg hover:opacity-80 transition duration-300 ease-in-out">Back to home</a>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>