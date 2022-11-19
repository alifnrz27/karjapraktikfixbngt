<?php

namespace App\Http\Controllers;

use App\Models\JobTraining;
use App\Models\User;
use Illuminate\Http\Request;

class LetterController extends Controller
{
    public function upload(Request $request){
        $submission = JobTraining::where('user_id', auth()->user()->id)->latest()->first();

        $rules = [
            'replyFromMajor' => 'required',
            'replyFromCompany' => 'required',
        ];

        $request->validate($rules);
        // jika tidak ada kelompok
        if($submission->team_id == 0){
            JobTraining::where('id', $submission->id)
            ->update([
                'submission_status_id' => 12,
                'from_major' => $request->replyFromMajor,
                'from_company' => $request->replyFromCompany,
            ]);
        }

        // jika ada kelompok
        else{            
            JobTraining::where([['team_id', '=', $submission->team_id], ['submission_status_id', '!=', 3]])
            ->update([
                'submission_status_id' => 12,
                'from_major' => $request->replyFromMajor,
                'from_company' => $request->replyFromCompany,
            ]);
        }

        return back()->with('status', 'Berhasil upload berkas jurusan');
    }

    public function accept(Request $request, User $user, $team_id){
        // cek keberadaan data, takutnya diubah dari inspect element
        $checkLetter = JobTraining::where([
            'submission_status_id' => 12,
            'user_id' => $user->id,
            'team_id' => $team_id
        ])->latest()->first();

        if(!$checkLetter){
            return back()->with('status', 'Data tidak ditemukan');
        }

        // jika tidak berkelompok
        if($checkLetter->team_id == 0){
            JobTraining::where([
                'user_id' => $checkLetter->user_id,
                'submission_status_id' => 12,
            ])->update([
                'submission_status_id' => 14,
            ]);
        }

        // jika berkelompok
        else{
            JobTraining::where([
                'team_id' => $checkLetter->team_id,
                'submission_status_id' => 12,
            ])->update([
                'submission_status_id' => 14,
            ]);
        }

        return back()->with('status', 'Berhasil menerima data');
    }

    public function decline(Request $request, User $user, $team_id){
        $request->validate([
            'description' => 'required'
        ]);
        // cek keberadaan data, takutnya diubah dari inspect element
        $checkLetter = JobTraining::where([
            'submission_status_id' => 12,
            'user_id' => $user->id,
            'team_id' => $team_id
        ])->latest()->first();

        if(!$checkLetter){
            return back()->with('status', 'Data tidak ditemukan');
        }

        // jika tidak berkelompok
        if($checkLetter->team_id == 0){
            JobTraining::where([
                'user_id' => $checkLetter->user_id,
                'submission_status_id' => 12,
            ])->update([
                'submission_status_id' => 13,
                'description' => $request->description,
            ]);
        }

        // jika berkelompok
        else{
            JobTraining::where([
                'team_id' => $checkLetter->team_id,
                'submission_status_id' => 12,
            ])->update([
                'submission_status_id' => 13,
                'description' => $request->description,
            ]);
        }
        return back()->with('status', 'Berhasil menolak surat');
    }
}
