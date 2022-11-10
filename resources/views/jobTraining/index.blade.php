<x-app-layout>
    @section('title', 'Register')
    <div id="status" class="container flex justify-content-center">
        <div class="flex fixed mt-40">
            <x-jet-validation-errors class=" fixed mx-auto items-center self-center justify-center bg-white px-5 py-7 rounded-md" />
        </div>
    </div>
    <div class="w-11/12 lg:w-11/12 flex pt-5 pb-32">
        <section id="student-register" class="w-full pt-36 pb-32 dark:bg-slate-900">
            <div class="container">
                <div class="w-full px-4">
                    <div class="mx-auto text-center mb-16">
                        <h4 class="font-semibold text-lg text-primary mb-2">Selamat Datang</h4>
                        <h2 class="font-bold text-dark dark:text-white text-3xl mb-4 sm:text-4xl lg:text-5xl">Silahkan Daftar Kerja Praktik</h2>
                    </div>
                </div>
                
                @if($submissionStatus == Null || $submissionStatus == 3 || $submissionStatus == 6 || $submissionStatus == 7 || $submissionStatus == 8)
                <x-submission.job-training :submissionStatus="$submissionStatus"></x-submission.job-training>
                @elseif($submissionStatus == 4 || $submissionStatus == 10 || $submissionStatus == 13)
                <h1 class="text-base font-semibold text-primary md:text-xl mx-auto">{{ $descriptionSubmissionStatus->name }}</h1>
                    @if($submissionStatus == 4)
                        <x-submission.member-upload :submissionStatus="$submissionStatus"></x-submission.member-upload>

                    @elseif($submissionStatus == 10 || $submissionStatus == 13)
                        <x-submission.letter :submissionStatus="$submissionStatus"></x-submission.letter>
                    @endif

                    <div class="w-2/12 mx-auto">
                        <form action="/job-training/cancel" method="post">
                            @csrf
                            <button type="submit" class="text-base font-semibold text-white bg-red-500 py-3 px-8 rounded-full w-full hover:opacity-80 hover:shadow-lg transition duration-500">Batalkan pengajuan</button>
                        </form>
                    </div>


                @elseif($submissionStatus == 1 || $submissionStatus == 2 || $submissionStatus == 5 || $submissionStatus == 9 || $submissionStatus == 11 || $submissionStatus == 12)
                <h1 class="text-base font-semibold text-primary md:text-xl mx-auto">{{ $descriptionSubmissionStatus->name }}</h1>
                <x-submission.invitation :submissionStatus="$submissionStatus"></x-submission.invitation>
                <div class="w-2/12 mx-auto">
                    <form action="/job-training/cancel" method="post">
                        @csrf
                        <button type="submit" class="text-base font-semibold text-white bg-red-500 py-3 px-8 rounded-full w-full hover:opacity-80 hover:shadow-lg transition duration-500">Batalkan pengajuan</button>
                    </form>
                </div>
                @endif
            </div>
        </section>

        <x-sidebar></x-sidebar>
    </div>

    <script>
        const labelTeamStatus = document.querySelector('#label-team-status');
        const teamStatus = document.querySelector('#teamStatus');
        const input = document.querySelector('#members-input');
        labelTeamStatus.addEventListener('click', function(){
            if(teamStatus.checked) {
                input.classList.add('hidden');
            }
            else{
                input.classList.remove('hidden');
            }
        });

        // status
        const statusData = document.querySelector('#status');
        setTimeout(function(){
            statusData.style.display = 'none';
        }, 1000);

        
    </script>
</x-app-layout>
