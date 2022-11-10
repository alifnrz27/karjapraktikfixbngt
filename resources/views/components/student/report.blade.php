<div class="w-full lg:w-1/2 p-4 mb-4 bg-white dark:bg-secondary rounded-lg h-full max-h-[1000px] overflow-auto">
    <div class="w-full self-center px-4 flex justify-between">
        <h1 class="text-base font-semibold text-primary dark:text-white md:text-xl">Pengajuan Laporan</h1>
        @if($submissionStatus < 30)
        <button onclick="tampilPopup('add-report')" class="text-base font-semibold text-white mb-3 bg-primary py-3 px-4 rounded-full hover:opacity-80 hover:shadow-lg transition duration-500 w-4/12">Ajukan Laporan</button>
        @endif
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
                            Link
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Keterangan
                                </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                            Status
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                                @foreach($reports as $report)
                                <tr class="border-b">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $loop->iteration }}</td>
                                    <td class="text-gray-900 font-light px-6 py-4">
                                        <a href="{{ $report->report }}" target="_blank" class="">
                                            <div class="m-2 rounded-lg bg-primary text-white p-1 hover:opacity-50 transition duration-400" width="25px">
                                                <img src="/assets/images/icons/report.png" width="25px">
                                            </div>
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $report->description }}</td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4">
                                        {{ $reportStatus[$report->report_status_id - 1]->name }}
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

@if($submissionStatus < 30)
<section id="add-report" class="fixed hidden w-full lg:w-4/12 p-3 mb-5 mx-auto my-auto dark:bg-dark top-0 shadow-lg bg-primary" style="margin: auto">
    <div class="w-full p-4 bg-white dark:bg-secondary rounded-lg h-full max-h-[1000px] overflow-auto">
        <div class="w-full flex justify-between self-center px-4">
            <h1 class="text-base font-semibold text-primary dark:text-white md:text-xl">Ajukan Laporan</h1>
            <button onclick="sembunyiPopup('add-report')" class="text-base text-black">x</button>
        </div>
        
        <section id="logbook" class="pt-36 pb-32 dark:bg-slate-900">
            <div class="container">        
                <form action="/report/add" method="POST">
                    @csrf
                    <div class="w-full lg:w-2/3 lg:mx-auto">
                        <div class="w-full mb-8 px-4">
                            <label for="report" class="text-base text-primary font-bold">Link Drive Laporan</label>
                            <input type="text" id="report" name="report" value="{{ old('report') }}" class="w-full bg-slate-200 text-dark p-3 rounded-md focus:outline-none focus:ring-primary focus:ring-1 focus:border-primary">
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
@endif