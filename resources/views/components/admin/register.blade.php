<section class="bg-gray-100 p-3 mb-5 dark:bg-dark">
    <div class="w-full p-4 bg-white dark:bg-secondary rounded-lg h-full max-h-[3000px] overflow-auto">
        <div class="w-full self-center px-4 flex justify-between">
            <h1 class="text-base font-semibold text-primary dark:text-white md:text-xl">Mahasiswa mendaftar</h1>
        </div>
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        @if(count($submissions) == 0)
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
                                    Tempat
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Jadwal
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Link
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Aksi
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($submissions as $s)
                                <tr class="border-b">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $loop->iteration }}</td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4">
                                     {{ $s->user->name }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4">
                                        {{ $s->place }}
                                       </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4">
                                    {{ date ('d/m/Y', strtotime ($s->start)) }} - {{ date ('d/m/Y', strtotime ($s->end)) }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4">
                                        <a target="_blank" href="{{ $s->form }}">Form</a> || 
                                        <a target="_blank" href="{{ $s->transcript }}">Transkrip</a> || 
                                        <a target="_blank" href="{{ $s->vaccine }}">Vaksin</a>
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 flex">
                                        <form title="terima" action="/job-training/accept/{{ $s->user->username }}/{{ $s->id }}" method="post">
                                            @csrf
                                            <button type="submit">
                                                <div class="m-2 rounded-lg bg-primary p-1 hover:opacity-50 transition duration-400">
                                                    <img src="/assets/images/icons/check.png"width="25px" alt="">
                                                </div>
                                            </button>
                                        </form>

                                        <div>
                                            <button title="tolak" onclick="tampilPopup('decline-register-{{ $s->user->username }}')">
                                                <div class="m-2 rounded-lg bg-red-500 p-1 hover:opacity-50 transition duration-400">
                                                    <img src="/assets/images/icons/garbage.png"width="25px" alt="">
                                                </div>
                                            </button>

                                            <section id="decline-register-{{ $s->user->username }}" class="fixed hidden w-full lg:w-4/12 p-3 mb-5 mx-auto my-auto left-0 dark:bg-dark top-0 shadow-lg bg-primary" style="margin: auto">
                                                <div class="w-full p-4 bg-white dark:bg-secondary rounded-lg h-full max-h-[1000px] overflow-auto">
                                                    <div class="w-full flex justify-between self-center px-4">
                                                        <h1 class="text-base font-semibold text-primary dark:text-white md:text-xl">Tolak Berkas {{ $s->user->name }}</h1>
                                                        <button onclick="sembunyiPopup('decline-register-{{ $s->user->username }}')" class="text-base text-black">x</button>
                                                    </div>
                                                    
                                                    <section id="logbook" class="pt-36 pb-32 dark:bg-slate-900">
                                                        <div class="container">        
                                                            <form action="/job-training/decline/{{ $s->user->username }}/{{ $s->id }}" method="POST">
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
</section>