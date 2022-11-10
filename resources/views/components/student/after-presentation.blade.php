<button onclick="tampilPopup('add-after-presentation')" class="text-base font-semibold text-white mb-3 bg-primary py-3 px-4 rounded-full hover:opacity-80 hover:shadow-lg transition duration-500 w-2/12">Ajukan Pasca Seminar</button>
                            <section id="add-after-presentation" class="fixed hidden w-full lg:w-4/12 p-3 mb-5 mx-auto my-auto dark:bg-dark top-0 shadow-lg bg-primary" style="margin: auto">
                                <div class="w-full p-4 bg-white dark:bg-secondary rounded-lg h-full max-h-[1000px] overflow-auto">
                                    <div class="w-full flex justify-between self-center px-4">
                                        <h1 class="text-base font-semibold text-primary dark:text-white md:text-xl">Ajukan berkas setelah presentasi</h1>
                                        <button onclick="sembunyiPopup('add-after-presentation')" class="text-base text-black">x</button>
                                    </div>
                                    
                                    <section id="logbook" class="pt-36 pb-32 dark:bg-slate-900">
                                        <div class="container">        
                                            <form action="/after-presentation/add" method="POST">
                                                @csrf
                                                <div class="w-full lg:w-2/3 lg:mx-auto">
                                                    <div class="w-full mb-8 px-4">
                                                        <label for="report_of_presentation" class="text-base text-primary font-bold">Link drive berita acara*</label>
                                                        <input type="text" id="report_of_presentation" name="report_of_presentation" value="{{ old('report_of_presentation') }}" class="w-full bg-slate-200 text-dark p-3 rounded-md focus:outline-none focus:ring-primary focus:ring-1 focus:border-primary">
                                                    </div>
                                                    <div class="w-full mb-8 px-4">
                                                        <label for="notes" class="text-base text-primary font-bold">Link drive notulensi*</label>
                                                        <input type="text" id="notes" name="notes" value="{{ old('notes') }}" class="w-full bg-slate-200 text-dark p-3 rounded-md focus:outline-none focus:ring-primary focus:ring-1 focus:border-primary">
                                                    </div>
                                                    <div class="w-full mb-8 px-4">
                                                        <label for="report_revision" class="text-base text-primary font-bold">Link drive revisi laporan*</label>
                                                        <input type="text" id="report_revision" name="report_revision" value="{{ old('report_revision') }}" class="w-full bg-slate-200 text-dark p-3 rounded-md focus:outline-none focus:ring-primary focus:ring-1 focus:border-primary">
                                                    </div>
                                                    <div class="w-full mb-8 px-4">
                                                        <label for="screenshot_after_presentation" class="text-base text-primary font-bold">Link drive SS pengumpulan berkas*</label>
                                                        <input type="text" id="screenshot_after_presentation" name="screenshot_after_presentation" value="{{ old('screenshot_after_presentation') }}" class="w-full bg-slate-200 text-dark p-3 rounded-md focus:outline-none focus:ring-primary focus:ring-1 focus:border-primary">
                                                    </div>
                                                    <div class="w-full mb-8 px-4">
                                                        <label for="report" class="text-base text-primary font-bold">Link drive laporan*</label>
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