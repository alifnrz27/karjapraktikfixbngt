<section class="py-5 rounded-lg bg-gray-100 dark:bg-dark mb-4">
    <div class="">
        <div class="flex flex-wrap">
            <div class="w-1/2 px-4 lg:w-1/4">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-10 lg:mb-1 dark:bg-slate-600">
                    <div class="py-8 px-6">
                        <div class="block  mb-3 font-semibold text-xl text-primary dark:text-white hover:text-primary truncate">
                            <h3 class="">Tahun Ajaran</h3>
                        </div>
                        <p class="font-medium text-base text-secondary mb-6">{{ $academicYear }}</p>
                    </div>
                </div>
            </div>

            <div class="w-1/2 px-4 lg:w-1/4">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-10 lg:mb-1 dark:bg-slate-600">
                    <div class="py-8 px-6">
                        <div class="block  mb-3 font-semibold text-xl text-primary dark:text-white hover:text-primary truncate">
                            @if(auth()->user()->role_id == 1)
                            <h3 class="">Total mahasiswa</h3>
                            @elseif(auth()->user()->role_id == 2)
                            <h3 class="">Total mahasiswa</h3>
                            @elseif(auth()->user()->role_id == 3)
                            <h3 class="">Dosen Pembimbing</h3>
                            @endif
                        </div>
                        <p class="font-medium text-base text-secondary mb-6">{{ $secondCard }}</p>
                    </div>
                </div>
            </div>

            <div class="w-1/2 px-4 lg:w-1/4">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-10 lg:mb-1 dark:bg-slate-600">
                    <div class="py-8 px-6">
                        <a href="" class="block  mb-3 font-semibold text-xl text-primary dark:text-white hover:text-primary truncate">
                            @if(auth()->user()->role_id == 1)
                            <h3 class="">Total mahasiswa yang selesai</h3>                                
                            @elseif(auth()->user()->role_id == 2)
                            <h3 class="">Total antri presentasi</h3>
                            @elseif(auth()->user()->role_id == 3)
                            <h3 class="">Tanggal Presentasi</h3>
                            @endif
                        </a>
                        <p class="font-medium text-base text-secondary mb-6">{{ $thirdCard }}</p>
                    </div>
                </div>
            </div>

            <div class="w-1/2 px-4 lg:w-1/4">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-10 lg:mb-1 dark:bg-slate-600 ">
                    <div class="py-8 px-6">
                        <a href="" class="block  mb-3 font-semibold text-xl text-primary dark:text-white hover:text-primary truncate">
                            @if(auth()->user()->role_id == 1)
                            <h3 class="">Total mahasiswa daftar</h3>                                
                            @elseif(auth()->user()->role_id == 2)
                            <h3 class="">Total antri bimbingan</h3>
                            @elseif(auth()->user()->role_id == 3)
                            <h3 class="">Status</h3>
                            @endif
                        </a>
                        <p class="font-medium text-base text-secondary mb-6">{{ $fourthCard }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>