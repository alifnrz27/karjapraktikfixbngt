<x-app-layout>
    @section('title', 'Calender')
    <div id="status" class="container flex justify-content-center">
        <div class="flex fixed mt-40">
            <x-jet-validation-errors class=" fixed mx-auto items-center self-center justify-center bg-white px-5 py-7 rounded-md" />
        </div>
    </div>
    <div class="w-11/12 lg:w-11/12 flex pb-32">
        <section id="student-register" class="w-full pt-6 pb-32 dark:bg-slate-900">
            <section class="pb-4">
                <div class="container flex justify-between">
                    <div class=" self-center px-4">
                        <h1 class="text-base font-semibold text-primary md:text-xl">Selamat Datang, <span class="block font-bold text-dark dark:text-white text-4xl lg:text-5xl">{{ auth()->user()->name }}</span></h1>
                        <h1 class="text-base font-semibold text-primary md:text-l">{{ date('d-M-Y') }}</h1>
                    </div>
                    <div class=" self-center px-4 hidden sm:block">
                        <h1 class="text-base font-semibold text-primary md:text-l">Kerja Praktik <span class="block font-bold text-dark dark:text-white text-4xl lg:text-2xl">Teknik Elektro</span></h1>
                        <h1 class="text-base font-semibold text-primary md:text-sm">ITERA</h1>
                    </div>
                </div>
                <hr>
            </section>
            <div class="container">
                <div class="w-full px-4">
                    <div class="mx-auto text-center mb-16 flex justify-between">
                        @if(count($calenders) > 0)
                        <h4 class="font-semibold text-lg dark:text-white text-primary mb-2">Tahun Aktif {{ $activeYear->semester->name }} {{ $activeYear->year }}</h4>
                        @endif
                        <button onclick="tampilPopup('add-new-calender')" class="text-base font-semibold text-white mb-3 bg-primary py-3 px-4 rounded-full hover:opacity-80 hover:shadow-lg transition duration-500 w-2/12">Tambah Tahun Ajaran</button>
                    </div>
                </div>
                
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="overflow-hidden">
                                @if(count($calenders) == 0)
                                <div class="m-2 rounded-lg p-1 hover:opacity-50 transition duration-400">
                                    <img src="/assets/images/icons/undraw_no_data_re_kwbl.svg" class="mx-auto" width="200px" alt="">
                                </div>
                                @else
                                <table class="min-w-full">
                                    <thead class="border-b">
                                    <tr>
                                        <th scope="col" class="text-sm font-medium text-gray-900 dark:text-white px-6 py-4 text-left">
                                        No
                                        </th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 dark:text-white px-6 py-4 text-left">
                                        Semester
                                        </th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 dark:text-white px-6 py-4 text-left">
                                            Tahun
                                        </th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 dark:text-white px-6 py-4 text-left">
                                        Aksi
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($calenders as $calender)
                                        <tr class="border-b @if($calender->is_active == 1){{ "bg-gray-300" }}@endif">
                                            <td class="text-sm font-light px-6 py-4 @if($calender->is_active == 1){{ "dark:text-gray-900" }}@else {{ "dark:text-white text-dark" }} @endif">{{ $loop->iteration }}</td>
                                            <td class="text-sm font-light px-6 py-4 @if($calender->is_active == 1){{ "dark:text-gray-900" }}@else {{ "dark:text-white text-dark" }} @endif">
                                            {{ $calender->semester->name }}
                                            </td>
                                            <td class="text-sm font-light px-6 py-4 @if($calender->is_active == 1){{ "dark:text-gray-900" }}@else {{ "dark:text-white text-dark" }} @endif">
                                                {{ $calender->year }}
                                            </td>
                                            <td class="text-sm dark:text-white text-dark font-light px-6 py-4 flex">
                                                <td class="text-sm text-gray-900 font-light px-6 py-4 flex">
                                                    <form title="hapus" action="/calender/{{ $calender->id }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit">
                                                            <div class="m-2 rounded-lg bg-red-500 p-1 hover:opacity-50 transition duration-400">
                                                                <img src="/assets/images/icons/garbage.png"width="25px" alt="">
                                                            </div>
                                                        </button>
                                                    </form>
                                                </td>
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

        <section id="add-new-calender" class="fixed hidden w-full lg:w-4/12 p-3 mb-5 mx-auto my-auto dark:bg-dark top-0 shadow-lg bg-primary" style="margin: auto">
            <div class="w-full p-4 bg-white dark:bg-secondary rounded-lg h-full max-h-[1000px] overflow-auto">
                <div class="w-full flex justify-between self-center px-4">
                    <h1 class="text-base font-semibold text-primary dark:text-white md:text-xl">Add New Calender</h1>
                    <button onclick="sembunyiPopup('add-new-calender')" class="text-base text-black">x</button>
                </div>
                
                <section id="semester" class="pt-36 pb-32 dark:bg-slate-900">
                    <div class="container">        
                        <form action="/calender" method="POST">
                            @csrf
                            <div class="w-full lg:w-2/3 lg:mx-auto">
                                <div class="w-full mb-8 px-4">
                                    <label for="year" class="text-base text-primary font-bold">Tahun Ajaran</label>
                                    <input type="year" id="year" name="year" value="{{ old('year') }}" class="w-full bg-slate-200 text-dark p-3 rounded-md focus:outline-none focus:ring-primary focus:ring-1 focus:border-primary">
                                </div>
                                <div class="w-full mb-8 px-4">
                                    <label for="year" class="text-base text-primary font-bold">Tahun Ajaran</label>
                                    <select name="semester_id" id="semester_id">
                                        @foreach($semesters as $semester)
                                        <option value="{{ $semester->id }}">{{ $semester->name }}</option>
                                        @endforeach
                                      </select>
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

        <x-sidebar></x-sidebar>
    </div>

</x-app-layout>
