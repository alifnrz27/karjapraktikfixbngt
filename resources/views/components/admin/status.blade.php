<div class="w-full lg:w-1/2 p-4 mb-4 bg-white dark:bg-secondary rounded-lg h-full max-h-[1000px] overflow-auto">
    <div class="w-full self-center px-4 flex justify-center">
        <h1 class="w-6/12 text-base font-semibold text-primary dark:text-white md:text-xl">Daftar yang belum diberi keterangan</h1>
        <button onclick="tampilPopup('history-status')" class="text-base font-semibold text-white mb-3 bg-primary py-3 px-4 rounded-full hover:opacity-80 hover:shadow-lg transition duration-500 w-4/12">History</button>

    </div>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    @if(count($status) == 0)
                    <div class="m-2 rounded-lg p-1 hover:opacity-50 transition duration-400">
                        <img src="/assets/images/icons/undraw_no_data_re_kwbl.svg" class="mx-auto" width="200px" alt="">
                    </div>
                    @else
                    <table class="min-w-full">
                        <thead class="border-b">
                        <tr>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                            No
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                            Nama
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                            Aksi
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($status as $s)
                            <tr class="border-b">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $loop->iteration }}</td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4">
                                {{ $s->user->name }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 flex">
                                    <form action="/status/accept/{{ $s->user_id }}/{{ $s->id }}" method="post">
                                        @csrf
                                        <button type="submit">
                                            <div class="m-2 rounded-lg bg-primary p-1 hover:opacity-50 transition duration-400">
                                                <img src="/assets/images/icons/graduated.png"width="25px" alt=""> </div>
                                        </button>
                                    </form>

                                    <form action="/status/decline/{{ $s->user_id }}/{{ $s->id }}" method="post">
                                        @csrf
                                        <button type="submit">
                                            <div class="m-2 rounded-lg bg-red-500 p-1 hover:opacity-50 transition duration-400">
                                                <img src="/assets/images/icons/stop.png"width="25px" alt="">
                                            </div>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<section id="history-status" class="fixed hidden w-full lg:w-4/12 p-3 mb-5 mx-auto my-auto dark:bg-dark top-0 shadow-lg bg-primary" style="margin: auto">
    <div class="w-full p-4 bg-white dark:bg-secondary rounded-lg h-full max-h-[1000px] overflow-auto">
        <div class="w-full flex justify-between self-center px-4">
            <h1 class="text-base font-semibold text-primary dark:text-white md:text-xl">History</h1>
            <button onclick="sembunyiPopup('history-status')" class="text-base text-black">x</button>
        </div>
        
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        @if(count($statusHistory) == 0)
                        <div class="m-2 rounded-lg p-1 hover:opacity-50 transition duration-400">
                            <img src="/assets/images/icons/undraw_no_data_re_kwbl.svg" class="mx-auto" width="200px" alt="">
                        </div>
                        @else
                        <table class="min-w-full">
                            <thead class="border-b">
                            <tr>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                No
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Nama
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Aksi
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($statusHistory as $s)
                                <tr class="border-b">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $loop->iteration }}</td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4">
                                    {{ $s->user->name }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 flex">
                                        @if($s->user->active_id == 1)    
                                            <form action="/status/update/accept/{{ $s->user_id }}/{{ $s->id }}" method="POST">
                                                @csrf
                                                <button type="submit">
                                                    <div class="m-2 rounded-lg bg-primary p-1 hover:opacity-50 transition duration-400">
                                                        <img src="/assets/images/icons/graduated.png"width="25px" alt="">
                                                    </div>
                                                </button>
                                            </form>
                                        @elseif($s->user->active_id == 0)
                                            <form action="/status/update/decline/{{ $s->user_id }}/{{ $s->id }}" method="POST">
                                        @csrf
                                        <button type="submit">
                                            <div class="m-2 rounded-lg bg-red-500 p-1 hover:opacity-50 transition duration-400">
                                                <img src="/assets/images/icons/stop.png"width="25px" alt="">
                                            </div>
                                        </button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>