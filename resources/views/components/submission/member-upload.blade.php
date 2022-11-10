<form action="/job-training/member-upload" method="POST">
    @csrf
    <div class="w-full lg:w-2/3 lg:mx-auto">
        <div class="w-full mb-8 px-4">
            <label for="transcript" class="text-base text-primary font-bold">Link Drive Transkrip Nilai*</label>
            <input type="text" id="transcript" name="transcript" value="{{ old('transcript') }}" class="w-full bg-slate-200 text-dark p-3 rounded-md focus:outline-none focus:ring-primary focus:ring-1 focus:border-primary" required>
        </div>
        <div class="w-full mb-8 px-4">
            <label for="vaccine" class="text-base text-primary font-bold">Link Drive Sertifikat Vaksin*</label>
            <input type="text" id="vaccine" name="vaccine" value="{{ old('vaccine') }}" class="w-full bg-slate-200 text-dark p-3 rounded-md focus:outline-none focus:ring-primary focus:ring-1 focus:border-primary" required autofocus>
        </div>
        <div class="w-full mb-8 px-4">
            <label for="form" class="text-base text-primary font-bold">Link Drive Form Pendaftaran*</label>
            <input type="text" id="form" name="form" value="{{ old('form') }}" class="w-full bg-slate-200 text-dark p-3 rounded-md focus:outline-none focus:ring-primary focus:ring-1 focus:border-primary" required>
        </div>
        <div class="w-full">
            <button type="submit" class="text-base font-semibold text-white bg-primary py-3 px-8 rounded-full w-full hover:opacity-80 hover:shadow-lg transition duration-500">Ajukan</button>
        </div>
    </div>
</form>