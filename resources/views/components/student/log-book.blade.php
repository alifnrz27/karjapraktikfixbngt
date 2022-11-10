<section class="bg-gray-100 p-3 mb-5 dark:bg-dark">
    <div class="w-full p-4 bg-white dark:bg-secondary rounded-lg h-full max-h-[1000px] overflow-auto">
        <div class="w-full self-center px-4 flex justify-between">
            <h1 class="text-base font-semibold text-primary dark:text-white md:text-xl">Logbook</h1>
            <button onclick="tampilPopup('add-logbook')" class="text-base font-semibold text-white mb-3 bg-primary py-3 px-4 rounded-full hover:opacity-80 hover:shadow-lg transition duration-500 w-2/12">Tambah Logbook</button>
        </div>
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table class="min-w-full">
                            <thead class="border-b">
                            <tr>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                No
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Tanggal
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Deskripsi
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($logbooks as $logbook)
                                <tr class="border-b">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $loop->iteration }}</td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4">
                                    {{ $logbook->date }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4">
                                        {{ $logbook->description }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="add-logbook" class="fixed hidden w-full lg:w-4/12 p-3 mb-5 mx-auto my-auto dark:bg-dark top-0 shadow-lg bg-primary" style="margin: auto">
    <div class="w-full p-4 bg-white dark:bg-secondary rounded-lg h-full max-h-[1000px] overflow-auto">
        <div class="w-full flex justify-between self-center px-4">
            <h1 class="text-base font-semibold text-primary dark:text-white md:text-xl">Add New Logbook</h1>
            <button onclick="sembunyiPopup('add-logbook')" class="text-base text-black">x</button>
        </div>
        
        <section id="logbook" class="pt-36 pb-32 dark:bg-slate-900">
            <div class="container">        
                <form action="/logbook/add" method="POST">
                    @csrf
                    <div class="w-full lg:w-2/3 lg:mx-auto">
                        <div class="w-full mb-8 px-4">
                            <label for="date" class="text-base text-primary font-bold">Tanggal</label>
                            <input type="date" id="date" name="date" value="{{ old('date') }}" class="w-full bg-slate-200 text-dark p-3 rounded-md focus:outline-none focus:ring-primary focus:ring-1 focus:border-primary">
                        </div>
                        <div class="w-full mb-8 px-4">
                            <label for="description" class="text-base text-primary font-bold">Kegiatan</label>
                            <textarea type="text" id="description" name="description" class="w-full bg-slate-200 text-dark p-3 rounded-md focus:outline-none focus:ring-primary focus:ring-1 focus:border-primary h-32">{{ old("description") }}</textarea>
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