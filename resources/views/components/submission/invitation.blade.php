<section id="" class="dark:bg-dark  mx-auto" style="margin: auto">
    <div class="container">
        <div class="flex flex-wrap mx-auto">
            <div class="w-full self-center px-4 mx-auto mb-4">
                @if($submissionStatus == 2)
                <div class="flex w-4/12">
                    <form class="mb-4" action="/invitation/accept" method="POST">
                        @csrf
                        <div class="w-full">
                            <button type="submit" class="text-base font-semibold text-white bg-primary py-3 px-8 rounded-full w-full hover:opacity-80 hover:shadow-lg transition duration-500">Terima</button>
                        </div>
                    </form>
                    <form class="mb-4" action="/invitation/decline" method="POST">
                        @csrf
                        <div class="w-full">
                            <button type="submit" class="text-base font-semibold text-white bg-red-500 py-3 px-8 rounded-full w-full hover:opacity-80 hover:shadow-lg transition duration-500">Tolak</button>
                        </div>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>