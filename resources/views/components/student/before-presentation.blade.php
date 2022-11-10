<button onclick="tampilPopup('add-before-presentation')" class="text-base font-semibold text-white mb-3 bg-primary py-3 px-4 rounded-full hover:opacity-80 hover:shadow-lg transition duration-500 w-2/12">Ajukan Pra Seminar</button>
                            <section id="add-before-presentation" class="fixed hidden w-full lg:w-4/12 p-3 mb-5 mx-auto my-auto dark:bg-dark top-0 shadow-lg bg-primary" style="margin: auto">
                                <div class="w-full p-4 bg-white dark:bg-secondary rounded-lg h-full max-h-[1000px] overflow-auto">
                                    <div class="w-full flex justify-between self-center px-4">
                                        <h1 class="text-base font-semibold text-primary dark:text-white md:text-xl">Ajukan berkas sebelum presentasi</h1>
                                        <button onclick="sembunyiPopup('add-before-presentation')" class="text-base text-black">x</button>
                                    </div>
                                    
                                    <section id="logbook" class="pt-36 pb-32 dark:bg-slate-900">
                                        <div class="container">        
                                            <form action="/before-presentation/add" method="POST">
                                                @csrf
                                                <div class="w-full lg:w-2/3 lg:mx-auto">
                                                    <div class="w-full mb-8 px-4">
                                                        <label for="form_presentation" class="text-base text-primary font-bold">Link drive form pendaftaran*</label>
                                                        <input type="text" id="form_presentation" name="form_presentation" value="{{ old('form_presentation') }}" class="w-full bg-slate-200 text-dark p-3 rounded-md focus:outline-none focus:ring-primary focus:ring-1 focus:border-primary">
                                                    </div>
                                                    <div class="w-full mb-8 px-4">
                                                        <label for="result_company" class="text-base text-primary font-bold">Link drive penilaian dari perusahaan*</label>
                                                        <input type="text" id="result_company" name="result_company" value="{{ old('result_company') }}" class="w-full bg-slate-200 text-dark p-3 rounded-md focus:outline-none focus:ring-primary focus:ring-1 focus:border-primary">
                                                    </div>
                                                    <div class="w-full mb-8 px-4">
                                                        <label for="log_activity" class="text-base text-primary font-bold">Link drive logbook*</label>
                                                        <input type="text" id="log_activity" name="log_activity" value="{{ old('log_activity') }}" class="w-full bg-slate-200 text-dark p-3 rounded-md focus:outline-none focus:ring-primary focus:ring-1 focus:border-primary">
                                                    </div>
                                                    <div class="w-full mb-8 px-4">
                                                        <label for="form_mentoring" class="text-base text-primary font-bold">Link drive penilaian bimbingan*</label>
                                                        <input type="text" id="form_mentoring" name="form_mentoring" value="{{ old('form_mentoring') }}" class="w-full bg-slate-200 text-dark p-3 rounded-md focus:outline-none focus:ring-primary focus:ring-1 focus:border-primary">
                                                    </div>
                                                    <div class="w-full mb-8 px-4">
                                                        <label for="report" class="text-base text-primary font-bold">Link drive laporan*</label>
                                                        <input type="text" id="report" name="report" value="{{ old('report') }}" class="w-full bg-slate-200 text-dark p-3 rounded-md focus:outline-none focus:ring-primary focus:ring-1 focus:border-primary">
                                                    </div>
                                                    <div class="w-full mb-8 px-4">
                                                        <label for="screenshot_before_presentation" class="text-base text-primary font-bold">Link drive SS pengumpulan*</label>
                                                        <input type="text" id="screenshot_before_presentation" name="screenshot_before_presentation" value="{{ old('screenshot_before_presentation') }}" class="w-full bg-slate-200 text-dark p-3 rounded-md focus:outline-none focus:ring-primary focus:ring-1 focus:border-primary">
                                                    </div>
                                                    <div class="w-full mb-8 px-4">
                                                        <label for="statement_letter" class="text-base text-primary font-bold">Link drive surat pernyataan</label>
                                                        <input type="text" id="statement_letter" name="statement_letter" value="{{ old('statement_letter') }}" class="w-full bg-slate-200 text-dark p-3 rounded-md focus:outline-none focus:ring-primary focus:ring-1 focus:border-primary">
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