<?php

namespace App\Http\Controllers;

use App\Models\JobTraining;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function add(Request $request){
        // cek apakah sebelumnya pernah mengajukan
        $report = Report::where(['student_id' => auth()->user()->id, 'report_status_id' => 1])->first();
        if($report) {
            return back()->with('status', 'silahkan menunggu pengajuan sebelumnya');
        }
        $request->validate([
            'report' => 'required',
        ]);

        $lastSubmission = JobTraining::where([
            'user_id' => auth()->user()->id
        ])->latest()->first();

        Report::create([
            'student_id' => auth()->user()->id,
            'lecturer_id' => $lastSubmission->lecturer_id,
            'report' => $request->report,
            'academic_year_id' => $lastSubmission->academic_year_id,
            'report_status_id' => 1,
            'description'=>'-',
        ]);
        return back()->with('status', 'Berhasil mengajukan laporan');

    }

    public function decline(Request $request, $id) {
        $request->validate([
            'description' => 'required',
        ]);
        // cek apakah ada yg mengajukan, takutnya diubah ubah datanya di inspect elemen
        $check = Report::where([
            'id' => $id,
            'lecturer_id' => auth()->user()->id,
            'submission_report_status_id' => 1,
        ])->first();

        if(!$check){
            return back()->with('status', 'Data tidak ditemukan');
        }

        Report::where([
            'id' => $id,
            'lecturer_id' => auth()->user()->id,
            'submission_report_status_id' => 1,
        ])->update([
            'submission_report_status_id' => 2,
            'description' =>$request->description,
        ]);

        return back()->with('status', 'Laporan ditolak');
    }

    public function accept(Request $request, $id){
        $request->validate([
            'description' => 'required',
        ]);
        // cek apakah ada yg mengajukan, takutnya diubah ubah datanya di inspect elemen
        $check = Report::where([
            'id' => $id,
            'lecturer_id' => auth()->user()->id,
            'submission_report_status_id' => 1,
        ])->first();

        if(!$check){
            return back()->with('status', 'Data tidak');;
        }

        Report::where([
            'id' => $id,
            'lecturer_id' => auth()->user()->id,
            'submission_report_status_id' => 1,
        ])->update([
            'submission_report_status_id' => 3,
            'description' =>$request->description,
        ]);

        return back()->with('status', 'Berhasil menerima laporan');
    }
}
