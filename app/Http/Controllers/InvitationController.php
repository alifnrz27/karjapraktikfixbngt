<?php

namespace App\Http\Controllers;

use App\Models\JobTraining;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function accept(){
        $lastSubmission = JobTraining::where(['user_id' => auth()->user()->id])->latest()->first();

        // ganti status jadi menerima undangan
        JobTraining::where('id', $lastSubmission->id)
        ->update(['submission_status_id' => 4]);

        //mendapatkan user id ketua
        $leader = Team::where('id', $lastSubmission->team_id)->first();
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
        return back()->with('status', 'Anda menerima undangan');
    }

    public function decline(){
        $lastSubmission = JobTraining::where('user_id', auth()->user()->id)->latest()->first();

        // ganti status jadi menolak undangan
        JobTraining::where('id', $lastSubmission->id)
        ->update(['submission_status_id' => 3]);
        // ubah inviteable nya
        User::where('id', auth()->user()->id)->update(['inviteable'=>1]);
        
        //mendapatkan user id ketua
        $leader = Team::where('id', $lastSubmission->team_id)->first();
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

        return back()->with('status', 'Anda berhasil menolak');
    }
}
