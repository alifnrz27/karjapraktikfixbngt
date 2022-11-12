<form action="/job-training" method="POST">
    @csrf
    <div class="w-full lg:w-2/3 lg:mx-auto">
        <div class="w-full mb-8 px-4">
            <label for="place" class="text-base text-primary font-bold">Tampat KP*</label>
            <input type="text" id="place" name="place" value="{{ old('place') }}" class="w-full bg-slate-200 text-dark p-3 rounded-md focus:outline-none focus:ring-primary focus:ring-1 focus:border-primary" required autofocus>
            <x-jet-input-error for="place" class="mt-2" />
        </div>
        <div class="w-full mb-8 px-4">
            <label for="name_leader" class="text-base text-primary font-bold">Nama Kepala Instansi*</label>
            <input type="text" id="name_leader" name="name_leader" value="{{ old('name_leader') }}" class="w-full bg-slate-200 text-dark p-3 rounded-md focus:outline-none focus:ring-primary focus:ring-1 focus:border-primary" required>
            <x-jet-input-error for="name_leader" class="mt-2" />
        </div>
        <div class="w-full mb-8 px-4">
            <label for="address" class="text-base text-primary font-bold">Alamat KP*</label>
            <input type="text" id="address" name="address" value="{{ old('address') }}" class="w-full bg-slate-200 text-dark p-3 rounded-md focus:outline-none focus:ring-primary focus:ring-1 focus:border-primary" required autofocus>
            <x-jet-input-error for="address" class="mt-2" />
        </div>
        <div class="w-full mb-8 px-4">
            <label for="number" class="text-base text-primary font-bold">Nomor Telpon Instansi*</label>
            <input type="text" id="number" name="number" value="{{ old('number') }}" class="w-full bg-slate-200 text-dark p-3 rounded-md focus:outline-none focus:ring-primary focus:ring-1 focus:border-primary" required>
            <x-jet-input-error for="number" class="mt-2" />
        </div>
        <div class="w-full mb-8 px-4">
            <label for="transcript" class="text-base text-primary font-bold">Link Drive Transkrip Nilai*</label>
            <input type="text" id="transcript" name="transcript" value="{{ old('transcript') }}" class="w-full bg-slate-200 text-dark p-3 rounded-md focus:outline-none focus:ring-primary focus:ring-1 focus:border-primary" required>
            <x-jet-input-error for="transcript" class="mt-2" />
        </div>
        <div class="w-full mb-8 px-4">
            <label for="vaccine" class="text-base text-primary font-bold">Link Drive Sertifikat Vaksin*</label>
            <input type="text" id="vaccine" name="vaccine" value="{{ old('vaccine') }}" class="w-full bg-slate-200 text-dark p-3 rounded-md focus:outline-none focus:ring-primary focus:ring-1 focus:border-primary" required autofocus>
            <x-jet-input-error for="vaccine" class="mt-2" />
        </div>
        <div class="w-full mb-8 px-4">
            <label for="form" class="text-base text-primary font-bold">Link Drive Form Pendaftaran*</label>
            <input type="text" id="form" name="form" value="{{ old('form') }}" class="w-full bg-slate-200 text-dark p-3 rounded-md focus:outline-none focus:ring-primary focus:ring-1 focus:border-primary" required>
            <x-jet-input-error for="form" class="mt-2" />
        </div>
        <div class="w-full mb-8 px-4">
            <label for="start" class="text-base text-primary font-bold">Tanggal Mulai*</label>
            <input type="date" id="start" name="start" value="{{ old('start') }}" class="w-full bg-slate-200 text-dark p-3 rounded-md focus:outline-none focus:ring-primary focus:ring-1 focus:border-primary" required autofocus>
            <x-jet-input-error for="start" class="mt-2" />
        </div>
        <div class="w-full mb-8 px-4">
            <label for="end" class="text-base text-primary font-bold">Tanggal Selesai*</label>
            <input type="date" id="end" name="end" value="{{ old('end') }}" class="w-full bg-slate-200 text-dark p-3 rounded-md focus:outline-none focus:ring-primary focus:ring-1 focus:border-primary" required>
            <x-jet-input-error for="end" class="mt-2" />
        </div>
        <div class="flex mb-8">
            <span class="mr-2 text-sm text-slate-500 dark:text-white">Individu</span>
            <input type="checkbox" class="hidden" name="teamStatus" id="teamStatus">
            <label for="teamStatus" id="label-team-status">
                <div class="flex h-5 w-9 cursor-pointer items-center rounded-full bg-slate-500 p-1">
                    <div id="toggle-team-status" class=" h-4 w-4 rounded-full bg-white transition duration-300"></div>
                </div>
            </label>
            <span class="ml-2 text-sm text-slate-500 dark:text-white">Berkelompok</span>
        </div>
        <div id="members-input" class="hidden w-full mb-8 px-4">
            <label for="members" class="text-base text-primary font-bold">Anggota Tim*</label>
            <input type="text" id="members" name="members" value="{{ old('members') }}" class="w-full bg-slate-200 text-dark p-3 rounded-md focus:outline-none focus:ring-primary focus:ring-1 focus:border-primary">
            <x-jet-input-error for="members" class="mt-2" />
        </div>
        <div class="w-full">
            <button type="submit" class="text-base font-semibold text-white bg-primary py-3 px-8 rounded-full w-full hover:opacity-80 hover:shadow-lg transition duration-500">Register</button>
        </div>
    </div>
</form>