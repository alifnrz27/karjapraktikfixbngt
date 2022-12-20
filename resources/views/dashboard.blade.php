<x-app-layout>
    @section('title', 'Dashboard')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="w-11/12 lg:w-11/12 flex pt-5 pb-32">
            <div class="w-11/12 lg:w-full dark:text-white">
                <section class="py-4">
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

                <x-card :academicYear="$academicYear" :secondCard="$secondCard" :thirdCard="$thirdCard" :fourthCard="$fourthCard"></x-card>

                @if(auth()->user()->role_id == 1)
                <div id="admin">
                    <x-admin.register :submissions="$submissions"></x-admin.register>
                    <x-admin.letter-major :replyLetters="$replyLetters"></x-admin.letter-major>
    
                    <div class="flex flex-wrap bg-gray-100 dark:bg-dark rounded-lg py-7 px-3">
                        <x-admin.lecturer :lecturer="$lecturer" :mentors="$mentors" :lecturerHistory="$lecturerHistory"></x-admin.lecturer>
                    </div>
    
                    <x-admin.before-presentation :beforePresentations="$beforePresentations"></x-admin.before-presentation>
                    <x-admin.after-presentation :afterPresentations="$afterPresentations"></x-admin.after-presentation>
    
                    <div class="flex flex-wrap bg-gray-100 dark:bg-dark rounded-lg py-7 px-3">
                        <x-admin.hard-copy :hardcopy="$hardcopy"></x-admin.hard-copy>
                        <x-admin.status :status="$status" :statusHistory="$statusHistory"></x-admin.status>
                    </div>
                </div>

                @elseif(auth()->user()->role_id == 2)
                <div id="lecturer">
                    <div class="flex flex-wrap bg-gray-100 dark:bg-dark rounded-lg py-7 px-3">
                        <x-lecturer.mentoring :mentorings="$mentorings"></x-lecturer.mentoring>
                        <x-lecturer.mentoring-queue :mentoringsQueue="$mentoringsQueue"></x-lecturer.mentoring-queue>
                    </div>

                    <div class="flex flex-wrap bg-gray-100 dark:bg-dark rounded-lg py-7 px-3">
                        <x-lecturer.title :titles="$titles"></x-lecturer.title>
                        <x-lecturer.report :reports="$reports"></x-lecturer.report>
                    </div>

                    <div class="flex flex-wrap bg-gray-100 dark:bg-dark rounded-lg py-7 px-3">
                        <x-lecturer.presentation :presentations="$presentations"></x-lecturer.presentation>
                        <x-lecturer.presentation-queue :presentationsQueue="$presentationsQueue"></x-lecturer.presentation-queue>
                    </div>

                    <div class="flex flex-wrap bg-gray-100 dark:bg-dark rounded-lg py-7 px-3 justify-center">
                        <x-lecturer.evaluate :evaluates="$evaluates"></x-lecturer.evaluate>
                        <x-lecturer.student :students="$students"></x-lecturer.student>
                    </div>
                </div>

                @elseif(auth()->user()->role_id == 3)
                <div id="student">
                    @if($submissionStatus != Null)
                    <div class="flex">
                        @if($submissionStatus == 18 || $submissionStatus == 20)  
                        <x-student.before-presentation></x-student.before-presentation>
                        @endif
                        @if($submissionStatus == 21)
                        <x-student.presentation></x-student.presen>
                        @endif
                        @if($submissionStatus == 24 || $submissionStatus == 25 || $submissionStatus == 27)  
                        <x-student.after-presentation></x-student.after-presentation>
                        @endif
                    </div>
                    
                    @if($submissionStatus >=15)
                    <x-student.logbook :logbooks="$logbooks"></x-student.logbook>
                    <div class="flex flex-wrap bg-gray-100 dark:bg-dark rounded-lg py-7 px-3">
                        <x-student.mentoring :mentoring="$mentoring" :mentoringStatus="$mentoringStatus" :submissionStatus="$submissionStatus"></x-student.mentoring>
                        <x-student.title :titles="$titles" :titleStatus="$titleStatus" :submissionStatus="$submissionStatus"></x-student.title>
                    </div>

                    <div class="flex flex-wrap bg-gray-100 dark:bg-dark rounded-lg py-7 px-3">
                        <x-student.report :reports="$reports" :reportStatus="$reportStatus" :submissionStatus="$submissionStatus"></x-student.report>
                    </div>
                    @endif

                    @else
                    <a href="/student-register" class="block justify-center text-center mx-auto text-base font-semibold text-white mb-3 bg-primary py-3 px-4 rounded-full hover:opacity-80 hover:shadow-lg transition duration-500 w-2/12">Silahkan daftar</a>
                    @endif
                </div>
                @endif



                {{-- <x-contact-admin :messages="$messages"></x-contact-admin> --}}
            </div>

            <x-sidebar></x-sidebar>
        </div>
    </div>
</x-app-layout>