<div class="w-full lg:w-1/2 p-4 mb-4 bg-white dark:bg-secondary rounded-lg h-full max-h-[2000px] overflow-auto">
    <div class="w-full self-center px-4 lg:w-1/2">
        <h1 class="text-base font-semibold text-primary dark:text-white md:text-xl">Daftar antri penilaian</h1>
    </div>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    @if(count($evaluates) == 0)
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
                                Link Penilaian
                                </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                            Aksi
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($evaluates as $evaluate)
                            <tr class="border-b">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $loop->iteration }}</td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4">
                                {{ $evaluate->user->name }}
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                    <a target="_blank" href="http://bit.ly/form-bimbingan-kp">
                                        Bimbingan
                                    </a> || 
                                    <a target="_blank" href="http://bit.ly/form-seminar-kp">
                                        Seminar
                                    </a>
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4">
                                    <form action="/evaluate/{{ $evaluate->user_id }}/{{ $evaluate->id }}" method="post">
                                        @csrf
                                        <button type="submit">
                                            <div class="m-2 rounded-lg bg-primary p-1 hover:opacity-50 transition duration-400">
                                                <img src="/assets/images/icons/check.png"width="25px" alt="">
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