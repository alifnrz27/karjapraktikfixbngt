<?php

namespace App\Http\Controllers;

use App\Models\JobTraining;
use Illuminate\Http\Request;

class BeforePresentationController extends Controller
{
    public function add(Request $request){
        $request->validate([
            'form_presentation'=>'required',
            'result_company'=>'required',
            'log_activity'=>'required',
            'form_mentoring'=>'required',
            'report'=>'required',
            'screenshot_before_presentation'=>'required',
        ]);

        $lastSubmission = JobTraining::where(['user_id' => auth()->user()->id])->latest()->first();

        if($lastSubmission->submission_status_id == 19){
            return back()->with('status', 'Menunggu pengajuan sebelumnya');
        }

        if($lastSubmission->submission_status_id == 18){
            JobTraining::where([
                'user_id' => auth()->user()->id,
                'academic_year_id' =>  $lastSubmission->academic_year_id,
                'submission_status_id' => 18,
            ])->update([
                "form_presentation"=> $request->form_presentation,
                "result_company"=> $request->result_company,
                "log_activity"=> $request->log_activity,
                "form_mentoring"=> $request->form_mentoring,
                "report"=> $request->report,
                "screenshot_before_presentation"=>$request->screenshot_before_presentation,
                "statement_letter"=> $request->statement_letter,
                'submission_status_id' => 19,
            ]);
        }elseif($lastSubmission->submission_status_id == 20){
            JobTraining::where([
                'user_id' => auth()->user()->id,
                'academic_year_id' =>  $lastSubmission->academic_year_id,
                'submission_status_id' => 20,
            ])->update([
                "form_presentation"=> $request->form_presentation,
                "result_company"=> $request->result_company,
                "log_activity"=> $request->log_activity,
                "form_mentoring"=> $request->form_mentoring,
                "report"=> $request->report,
                "screenshot_before_presentation"=>$request->screenshot_before_presentation,
                "statement_letter"=> $request->statement_letter,
                'submission_status_id' => 19,
            ]);
        }
        return back()->with('status', 'Berhasil mengajukan berkas');
    }

    public function accept(Request $request, $studentID, $id){
        // cek apakah ada datanya, takutnya diubah di inspect elemen
        $check = JobTraining::where([
            'user_id' => $studentID,
            'submission_status_id' => 19,
        ])->latest()->first();
        if(!$check){
            return back()->with('status', 'Data tidak ditemukan');
        }

        JobTraining::where([
            'user_id' => $studentID,
            'submission_status_id' => 19,
        ])->update([
            'submission_status_id' => 21,
        ]);

        return back()->with('status', 'Berhasil menerima berkas');
    }

    public function decline(Request $request, $studentID, $id){
        $request->validate([
            'description' => 'required',
        ]);
        // cek apakah ada datanya, takutnya diubah di inspect elemen
        $check = JobTraining::where([
            'user_id' => $studentID,
            'submission_status_id' => 19,
        ])->latest()->first();
        if(!$check){
            return back()->with('status', 'Data tidak ditemukan');
        }

        JobTraining::where([
            'user_id' => $studentID,
            'submission_status_id' => 19,
        ])->update([
            'submission_status_id' => 20,
        ]);

        return back()->with('status', 'Berhasil menolak berkas');
    }
}
