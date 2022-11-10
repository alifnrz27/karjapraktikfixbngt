<?php

namespace App\Http\Controllers;

use App\Models\JobTraining;
use App\Models\User;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function accept(Request $request, $studentID, $id){
        // cek apakah ada datanya, takutnya diubah di inspect elemen
        $check = JobTraining::where([
            'user_id' => $studentID,
            'id' => $id,
            'submission_status_id' => 29,
        ])->first();
        if(!$check){
            return back()->with('status', 'Data tidak ditemukan');
        }

        JobTraining::where([
            'user_id' => $studentID,
            'submission_status_id' => 29,
        ])->update([
            'submission_status_id' => 30,
        ]);

        User::where([
            'id' => $studentID
        ])->update([
            'active_id' => 0
        ]);

        return back()->with('status', 'Berhasil meluluskan mahasiswa');
    }

    public function decline(Request $request, $studentID, $id){
        // cek apakah ada datanya, takutnya diubah di inspect elemen
        $check = JobTraining::where([
            'user_id' => $studentID,
            'id' => $id,
            'submission_status_id' => 29,
        ])->first();
        if(!$check){
            return back()->with('status', 'Data tidak ditemukan');
        }

        JobTraining::where([
            'user_id' => $studentID,
            'submission_status_id' => 29,
        ])->update([
            'submission_status_id' => 30,
        ]);

        User::where([
            'id' => $studentID
        ])->update([
            'inviteable' => 1
        ]);

        return back()->with('status', 'Mahasiswa tidak lulus');
    }

    public function updateAcept(Request $request, $studentID, $id){
        // cek apakah ada datanya, takutnya diubah di inspect elemen
        $check = JobTraining::where([
            'user_id' => $studentID,
            'id' => $id,
            'submission_status_id' => 30,
        ])->first();
        if(!$check){
            return back()->with('status', 'Data tidak ditemukan');
        }

        User::where([
            'id' => $studentID
        ])->update([
            'inviteable' => 0,
            'active_id' => 0
        ]);

        return back()->with('status', 'Mahasiswa lulus');
    }

    public function updateDecline(Request $request, $studentID, $id){
        // cek apakah ada datanya, takutnya diubah di inspect elemen
        $check = JobTraining::where([
            'user_id' => $studentID,
            'id' => $id,
            'submission_status_id' => 30,
        ])->first();
        if(!$check){
            return back()->with('status', 'Data tidak ditemukan');
        }

        User::where([
            'id' => $studentID
        ])->update([
            'inviteable' => 1,
            'active_id' => 1
        ]);

        return back()->with('status', 'Mahasiswa tidak lulus');
    }
}
