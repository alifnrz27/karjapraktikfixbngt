<?php

namespace App\Http\Controllers;

use App\Models\JobTraining;
use Illuminate\Http\Request;

class PresentationController extends Controller
{
    public function add(Request $request){
        $lastSubmission = JobTraining::where(['user_id' => auth()->user()->id])->latest()->first();
        JobTraining::where([
            'user_id' => auth()->user()->id,
            'academic_year_id' => $lastSubmission->academic_year_id,
            'submission_status_id' => 21,
        ])->update([
            'date_presentation'=>'-',
            'submission_status_id' => 22,
        ]);

        return back()->with('status', 'Berhasil mengajukan presentasi');
    }

    public function accept(Request $request, $studentID, $id){
        $request->validate([
            'date_presentation' => 'required',
            'description'=>'required',
        ]);
        // cek apakah ada datanya, takutnya diubah di inspect elemen
        $check = JobTraining::where([
            'user_id' => $studentID,
            'submission_status_id' => 22,
        ])->first();
        if(!$check){
            return back()->with('status', 'Data tidak ditemukan');
        }

        JobTraining::where([
            'id' =>$id,
            'user_id' => $studentID,
            'submission_status_id' => 22,
        ])->update([
            'submission_status_id' => 23,
            'date_presentation' => $request->date_presentation,
            'description'=> $request->description,
        ]);

        return back()->with('status', 'Berhasil menerima presentasi');
    }

    public function finished(Request $request, $studentID, $id){
        $lastSubmission = JobTraining::where(['user_id' => $studentID, 'submission_status_id' => 23])->latest()->first();
        // cek apakah ada datanya, takutnya diubah di inspect elemen
        if(!$lastSubmission){
            return back()->with('status', 'Data tidak ditemukan');
        }

        JobTraining::where([
            'user_id' => $studentID,
            'submission_status_id' => 23,
        ])->update([
            'submission_status_id' => 24,
        ]);

        return back()->with('status', 'Berhasil menyelesaikan presentasi');
    }
}
