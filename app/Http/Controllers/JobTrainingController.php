<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\JobTraining;
use App\Models\SubmissionStatus;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class JobTrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // jika yang masuk selain student
        if(auth()->user()->role_id != 3 || auth()->user()->active_id == 0){
            return abort(403);
        }

        $academicYear = AcademicYear::where(['is_active' => 1])->first();

        $data['submissionStatus'] = JobTraining::where(['user_id' => auth()->user()->id])->latest()->first();

        if($data['submissionStatus']){
            $data['submissionStatus'] = $data['submissionStatus']->submission_status_id;

            $data['descriptionSubmissionStatus'] = SubmissionStatus::where('id', $data['submissionStatus'])->first();
        }

        if($data['submissionStatus'] == 30 && auth()->user()->active_id == 1){
            $data['submissionStatus'] = Null;
        }

        return view('jobTraining.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $submissionStatus = 9;
        $teamID = 0;
        $academicYear = AcademicYear::where('is_active', 1)->first();
        $rules = [
            'form' => 'required',
            'vaccine' => 'required',
            'name_leader' => 'required',
            'address' => 'required',
            'number' => 'required',
            'transcript' => 'required',
            'place' => 'required',
            'start' => 'required',
            'end' => 'required',
        ];
        if($request->teamStatus == 'on'){
            $rules['members'] = 'required';
        }   

        $request->validate($rules);

        // cek apakah jumlah hari awal ke akhir minus apa tidak, kalau minus gagal daftar
        $dateStart = strtotime($request->start);
        $dateEnd = strtotime($request->end);
        $now = strtotime('now +7 hours');
        if(($dateEnd - $dateStart) <= 0){
            return back()->with('status', 'Tanggal yang dimasukkan salah');
        }

        // jika tanggal mulai ternyata sudah lewat
        if(($dateStart - $now) <= 0){
            return back()->with('status', 'Tanggal mulai sudah lewat');
        }

        // jika input kurang dari 30 hari
        if(($dateEnd - $dateStart) < (strtotime('now +30 days 7 hours') - $now)){
            return back()->with('status', 'Minimal pengajuan 30 Hari!');
        }

        //check team member
        if ($request->teamStatus == 'on'){
            $submissionStatus = 1;
            $members = explode(' ', $request->members);
            $members = array_unique($members);
            foreach($members as $member){
                $user = User::where([
                    'username' => $member,
                    'role_id'  => 3,
                    'active_id' => 1,
                    'inviteable' =>1
                ])->first();

                // ketika tidak ada usernya
                if(!$user){
                    return back()->with('status', 'Anggota tim tidak ditemukan!'); 
                }

                // jika user menginvite diri sendiri
                if($user->username == auth()->user()->username){
                    return back()->with('status', 'Tidak bisa invite diri sendiri!');
                }
            }

            // isi tabel team berdasarkan id ketua tim
            Team::create([
                'user_id'=>auth()->user()->id,
            ]);
            $team = Team::where('user_id', auth()->user()->id)->latest()->first();
            $teamID = $team->id;

            // tambahkan data anggota
            foreach($members as $member){
                $user = User::where([
                    'username' => $member,
                    'role_id'  => 3,
                    'active_id' => 1,
                    'inviteable' =>1
                ])->first();
                JobTraining::create([
                    'user_id'=>$user->id,
                    'team_id'=>$team->id,
                    'name_leader' => $request->name_leader,
                    'address' => $request->address,
                    'number' => $request->number,
                    'place'=>$request->place,
                    'start'=>$request->start,
                    'end'=>$request->end,
                    'academic_year_id'=>$academicYear->id,
                    'submission_status_id'=>2,
                ]);
                User::where('username', $member)
                        ->update(['inviteable' => 0]);
            }
        }

        // isi data untuk ketua
        $validatedData = [
            'user_id'=>auth()->user()->id,
            'team_id'=>$teamID,
            'place'=>$request->place,
            'name_leader' => $request->name_leader,
            'address' => $request->address,
            'number' => $request->number,
            'start'=>$request->start,
            'end'=>$request->end,
            'form'=>$request->form,
            'vaccine'=>$request->vaccine,
            'transcript'=>$request->transcript, 
            'academic_year_id'=>$academicYear->id,
            'submission_status_id'=>$submissionStatus,
        ];
        JobTraining::create($validatedData);
        User::where('id', auth()->user()->id)
              ->update(['inviteable' => 0]);

        return back()->with('status', 'Sukses mengajukan KP');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobTraining  $jobTraining
     * @return \Illuminate\Http\Response
     */
    public function show(JobTraining $jobTraining)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobTraining  $jobTraining
     * @return \Illuminate\Http\Response
     */
    public function edit(JobTraining $jobTraining)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobTraining  $jobTraining
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobTraining $jobTraining)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobTraining  $jobTraining
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobTraining $jobTraining)
    {
        //
    }

    public function memberUpload(Request $request){
        $rules = [
            'form' => 'required',
            'vaccine' => 'required',
            'transcript' => 'required',
        ];

        $request->validate($rules);

        $lastSubmission = JobTraining::where('user_id', auth()->user()->id)->latest()->first();

        JobTraining::where('id' , $lastSubmission->id)
              ->update([
                'form'=>$request->form,
                'vaccine'=>$request->vaccine,
                'transcript'=>$request->transcript,
                'submission_status_id'=>5,
            ]);

            // mengambil data submission se tim yang belum acc undangan
            $invitedSubmission = JobTraining::where(['team_id'=>$lastSubmission->team_id, 'submission_status_id' => 2])->get();

            // kalo udah gaada yg diundang lagi
            if (count($invitedSubmission) == 0){
                // ubah ketua jadi menunggu berkas seluruh anggota
                JobTraining::where(['team_id'=> $lastSubmission->team_id, 'submission_status_id'=> 1])
                        ->update(['submission_status_id' => 5]);
                // mengambil data anggota yang sudah acc tapi belum upload
                $acceptedSubmission = JobTraining::where(['team_id'=>$lastSubmission->team_id, 'submission_status_id' => 4])->get();

                // kalo yg nerima undangan pada udah upload semua
                if(count($acceptedSubmission) == 0){
                    JobTraining::where(['team_id'=> $lastSubmission->team_id, 'submission_status_id'=> 5])
                    ->update(['submission_status_id' => 9]);
                }
            }   
            return back()->with('status', 'Sukses menambahkan data');
    }

    public function accept(Request $request, User $user, JobTraining $submission){

        // cek apakah ada submissionnya, takutnya malah diubah di inspect elemen
        $checkSubmission = JobTraining::where([
            'user_id' => $user->id,
            'id' => $submission->id,
            'submission_status_id' => 9, //status sedang mengajukan
        ])->first();

        if(!$checkSubmission){
            return back()->with('status', 'mahasiswa tidak ditemukan');
        }

        // jika dia tidak berkelompok ubah status menjadi diterima
        if($submission->team_id == 0){
            JobTraining::where([
                'id' => $submission->id
            ])->update([
                'submission_status_id' => 10
            ]);
        }
        
        // jika berkelompok ubah status menjadi menunggu anggota lain di acc
        else{
            JobTraining::where([
                'id' => $submission->id
            ])->update([
                'submission_status_id' => 11
            ]);

            // cek jika seluruh anggota sudah di acc
            $teamSubmissions = JobTraining::where([
                'team_id' => $submission->team_id
            ])->get();
            $waitingTeam = false;
            foreach($teamSubmissions as $submission){
                if($submission->submission_status_id == 9){
                    $waitingTeam = true;
                }
            }
            if($waitingTeam == false){
                JobTraining::where([
                    'team_id' => $submission->team_id,
                    'submission_status_id' => 11
                ])->update([
                    'submission_status_id' => 10
                ]);
            }
        }
        return back()->with('status', 'sukses merubah data');
    }

    public function decline(Request $request, User $user, JobTraining $submission){

        $rules = [
            'description' => 'required',
        ];

        $request->validate($rules);

        // cek apakah ada submissionnya, takutnya malah diubah di inspect elemen
        $checkSubmission = JobTraining::where([
            'id' => $submission->id,
            'user_id' => $user->id,
            'submission_status_id' => 9, //status sedang mengajukan
        ])->first();

        if(!$checkSubmission){
            return back()->with('status', 'Data tidak ditemukan');
        }

        // jika dia tidak berkelompok ubah status menjadi ditolak admin
        if($submission->team_id == 0){
            JobTraining::where([
                'id' => $submission->id
                ])->update([
                    'submission_status_id' => 8,
                    'description' => $request->description,
                ]);
            User::where([
                    'id' => $submission->user_id
                    ])->update([
                        'inviteable' => 1,
                    ]);
        }

        // jika berkelompok ubah status menjadi ditolak beramai ramai
        else{
                // mendapatkan id masing masing anggota
                $members = JobTraining::select('user_id')
                ->where([
                    ['team_id', '=', $submission->team_id],
                    ['submission_status_id', '!=', 3],
                ])->get();
                $userID = [];
                for($i = 0; $i < count($members); $i++){
                    $userID[$i] = $members[$i]['user_id'];
                }

                User::whereIn('id', $userID)
                ->update([
                    'inviteable'=> 1
                ]);

            JobTraining::where([
                ['team_id', '=', $submission->team_id],
                ['submission_status_id', '!=', 3],
            ])->update([
                'submission_status_id' => 8,
                'description' => $request->description,
            ]);


        }
        return back()->with('status', 'Data ditolak');
    }

    public function cancel(){
        $lastSubmission = JobTraining::where('user_id', auth()->user()->id)->latest()->first();

        // jika pengajuan individu
        if($lastSubmission->team_id == 0){
            JobTraining::where('id', $lastSubmission->id)
        ->update(['submission_status_id' => 6]);
        User::where('id', auth()->user()->id)->update(['inviteable'=>1]);
        }
        // kalo dia berkelompok
        else {
            JobTraining::where('team_id', $lastSubmission->team_id)
            ->update(['submission_status_id' => 7]);
            $allSubmissions = JobTraining::where('team_id', $lastSubmission->team_id)->get();
            foreach($allSubmissions as $submission){
                User::where('id', $submission->user_id)->update(['inviteable'=>1]);
            }
        }

        return back()->with('status', 'Anda berhasil membatalkan pengajuan KP Tim');
    }
}
