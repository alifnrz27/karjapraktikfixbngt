<div class="w-full lg:w-1/2 p-4 mb-4 bg-white dark:bg-secondary rounded-lg h-full max-h-[2000px] overflow-auto">
    <div class="w-full self-center px-4 lg:w-1/2">
        <h1 class="text-base font-semibold text-primary dark:text-white md:text-xl">Daftar pengajuan laporan</h1>
    </div>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    @if(count($reports) == 0)
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
                                Judul
                                </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                            Aksi
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($reports as $t)
                            <tr class="border-b">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $loop->iteration }}</td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4">
                                {{ $t->student->name }}
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                    <a target="_blank" href="{{ $t->report }}">Laporan</a>
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 flex">
                                    <div>
                                        <button title="terima" onclick="tampilPopup('accept-report-{{ $t->student->username }}')">
                                            <div class="m-2 rounded-lg bg-primary p-1 hover:opacity-50 transition duration-400">
                                                <img src="/assets/images/icons/check.png"width="25px" alt="">
                                            </div>
                                        </button>

                                        <section id="accept-report-{{ $t->student->username }}" class="fixed hidden w-full lg:w-4/12 p-3 mb-5 mx-auto my-auto left-0 dark:bg-dark top-0 shadow-lg bg-primary" style="margin: auto">
                                            <div class="w-full p-4 bg-white dark:bg-secondary rounded-lg h-full max-h-[1000px] overflow-auto">
                                                <div class="w-full flex justify-between self-center px-4">
                                                    <h1 class="text-base font-semibold text-primary dark:text-white md:text-xl">Terima Laporan {{ $t->student->name }}</h1>
                                                    <button onclick="sembunyiPopup('accept-report-{{ $t->student->username }}')" class="text-base text-black">x</button>
                                                </div>
                                                
                                                <section id="logbook" class="pt-36 pb-32 dark:bg-slate-900">
                                                    <div class="container">        
                                                        <form action="/report/accept/{{ $t->id }}" method="POST">
                                                            @csrf
                                                            <div class="w-full lg:w-2/3 lg:mx-auto">
                                                                <div class="w-full mb-8 px-4">
                                                                    <label for="description" class="text-base text-primary font-bold">Keterangan</label>
                                                                    <input type="text" id="description" name="description" value="{{ old('description') }}" class="w-full bg-slate-200 text-dark p-3 rounded-md focus:outline-none focus:ring-primary focus:ring-1 focus:border-primary">
                                                                </div>
                                                                <div class="w-full">
                                                                    <button type="submit" class="text-base font-semibold text-white bg-primary py-3 px-8 rounded-full w-full hover:opacity-80 hover:shadow-lg transition duration-500">Kirim</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </section>
                                            </div>
                                        </section>
                                    </div>
                                    <div>
                                        <button title="tolak" onclick="tampilPopup('decline-report-{{ $t->student->username }}')">
                                            <div class="m-2 rounded-lg bg-red-500 p-1 hover:opacity-50 transition duration-400">
                                                <img src="/assets/images/icons/garbage.png"width="25px" alt="">
                                            </div>
                                        </button>

                                        <section id="decline-report-{{ $t->student->username }}" class="fixed hidden w-full lg:w-4/12 p-3 mb-5 mx-auto my-auto left-0 dark:bg-dark top-0 shadow-lg bg-primary" style="margin: auto">
                                            <div class="w-full p-4 bg-white dark:bg-secondary rounded-lg h-full max-h-[1000px] overflow-auto">
                                                <div class="w-full flex justify-between self-center px-4">
                                                    <h1 class="text-base font-semibold text-primary dark:text-white md:text-xl">Tolak Laporan {{ $t->student->name }}</h1>
                                                    <button onclick="sembunyiPopup('decline-report-{{ $t->student->username }}')" class="text-base text-black">x</button>
                                                </div>
                                                
                                                <section id="logbook" class="pt-36 pb-32 dark:bg-slate-900">
                                                    <div class="container">        
                                                        <form action="/report/decline/{{ $t->id }}" method="POST">
                                                            @csrf
                                                            <div class="w-full lg:w-2/3 lg:mx-auto">
                                                                <div class="w-full mb-8 px-4">
                                                                    <label for="description" class="text-base text-primary font-bold">Keterangan</label>
                                                                    <input type="text" id="description" name="description" value="{{ old('description') }}" class="w-full bg-slate-200 text-dark p-3 rounded-md focus:outline-none focus:ring-primary focus:ring-1 focus:border-primary">
                                                                </div>
                                                                <div class="w-full">
                                                                    <button type="submit" class="text-base font-semibold text-white bg-primary py-3 px-8 rounded-full w-full hover:opacity-80 hover:shadow-lg transition duration-500">Kirim</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </section>
                                            </div>
                                        </section>
                                    </div>

                                    
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