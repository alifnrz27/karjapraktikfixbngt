<?php

namespace App\Http\Controllers;

use App\Models\JobTraining;
use Illuminate\Http\Request;

class AfterPresentationController extends Controller
{
    public function add(Request $request){
        $request->validate([
            'report_of_presentation'=>'required',
            'notes'=>'required',
            'report_revision'=>'required',
            'screenshot_after_presentation'=>'required',
        ]);

        $lastSubmission = JobTraining::where(['user_id' => auth()->user()->id])->latest()->first();
        if($lastSubmission->submission_status_id == 26){
            return back()->with('status', 'Menunggu pengajuan sebelumnya');
        }

        if($lastSubmission->submission_status_id == 24){
            JobTraining::where([
                'user_id' => auth()->user()->id,
                'academic_year_id' => $lastSubmission->academic_year_id,
                'submission_status_id' => 24,
            ])->update([
                'report_of_presentation'=>$request->report_of_presentation,
                'notes'=>$request->notes,
                'report_revision'=>$request->report_revision,
                'screenshot_after_presentation'=>$request->screenshot_after_presentation,
                'submission_status_id' => 26,
            ]);
        }
        elseif($lastSubmission->submission_status_id == 25){
            JobTraining::where([
                'user_id' => auth()->user()->id,
                'academic_year_id' => $lastSubmission->academic_year_id,
                'submission_status_id' => 25,
            ])->update([
                'report_of_presentation'=>$request->report_of_presentation,
                'notes'=>$request->notes,
                'report_revision'=>$request->report_revision,
                'screenshot_after_presentation'=>$request->screenshot_after_presentation,
                'submission_status_id' => 26,
            ]);
        }elseif($lastSubmission->submission_status_id == 27){
            JobTraining::where([
                'user_id' => auth()->user()->id,
                'academic_year_id' => $lastSubmission->academic_year_id,
                'submission_status_id' => 27,
            ])->update([
                'report_of_presentation'=>$request->report_of_presentation,
                'notes'=>$request->notes,
                'report_revision'=>$request->report_revision,
                'screenshot_after_presentation'=>$request->screenshot_after_presentation,
                'submission_status_id' => 26,
            ]);
        }
        return back()->with('status', 'Berhasil mengajukan berkas');
    }

    public function accept(Request $request, $studentID, $id){
        // cek apakah ada datanya, takutnya diubah di inspect elemen
        $check = JobTraining::where([
            'id' => $id,
            'user_id' => $studentID,
            'submission_status_id' => 26,
        ])->latest()->first();
        if(!$check){
            return back()->with('status', 'Data tidak ditemukan');
        }

        JobTraining::where([
            'user_id' => $studentID,
            'submission_status_id' => 26,
        ])->update([
            'submission_status_id' => 28,
        ]);

        return back()->with('status', 'Berhasil menerima berkas');
    }

    public function decline(Request $request, $studentID, $id){
        $request->validate([
            'description' => 'required',
        ]);
        
        // cek apakah ada datanya, takutnya diubah di inspect elemen
        $check = JobTraining::where([
            'id' => $id,
            'user_id' => $studentID,
            'submission_status_id' => 26,
        ])->latest()->first();
        if(!$check){
            return back()->with('status', 'Data tidak ditemukan');
        }

        JobTraining::where([
            'user_id' => $studentID,
            'submission_status_id' => 26,
        ])->update([
            'submission_status_id' => 27,
        ]);

        return back()->with('status', 'Berhasil menolak berkas');
    }

}
