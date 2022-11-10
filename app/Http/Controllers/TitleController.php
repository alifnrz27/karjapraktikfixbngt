<?php

namespace App\Http\Controllers;

use App\Models\JobTraining;
use App\Models\Title;
use Illuminate\Http\Request;

class TitleController extends Controller
{
    public function add(Request $request){
        $request->validate([
            'title' => 'required',
        ]);

        // cek apakah judul sudah diterima
        $check = Title::where([
            'student_id' => auth()->user()->id,
            'title_status_id' => 3,
        ])->first();

        if($check){
            return back()->with('status', 'Judul sudah ada yang diterima');
        }

        // ambil data KP
        $lastSubmission = JobTraining::where([
            'user_id'=>auth()->user()->id,
        ])->latest()->first();

        // Masukkan judul baru
        Title::create([
            'student_id' => auth()->user()->id,
            'lecturer_id' =>$lastSubmission->lecturer_id,
            'job_training_id' => $lastSubmission->id,
            'academic_year_id' => $lastSubmission->academic_year_id,
            'title_status_id' => 1,
            'title' => $request->title,
        ]);

        JobTraining::where([
            'id' => $lastSubmission->id
        ])->update(['submission_status_id' => 16]);
        return back()->with('status', 'Berhasil mengajukan judul');
    }

    public function accept(Request $request, $studentID, $id){

        // cek apakah ada datanya
        $check = Title::where([
            'id' => $id,
            'student_id' => $studentID,
            'lecturer_id' => auth()->user()->id,
            'title_status_id' => 1,
        ])->first();

        if(!$check){
            return back()->with('status', 'Data tidak ditemukan');
        }

        Title::where([
            'id' => $id,
            'student_id' => $studentID,
        ])->update([
            'title_status_id' => 3,
        ]);

        // tolak semua sisa judul
        Title::where([
            ['student_id', '=', $studentID],
            ['title_status_id', '!=', 3]
        ])->update([
            'title_status_id' => 2,
        ]);

        // Student last submission
        $lastSubmission = JobTraining::where([
            'user_id' => $studentID,
        ])->latest()->first();

        JobTraining::where([
            'id' => $lastSubmission->id
        ])->update([
            'submission_status_id' => 18,
        ]);

        return back()->with('status', 'Berhasil menerima judul');
    }

    public function decline (Request $request, $studentID, $id){
        $request->validate([
            'description' => 'required',
        ]);

        // cek apakah ada datanya
        $check = Title::where([
            'id' => $id,
            'student_id' => $studentID,
            'lecturer_id' => auth()->user()->id,
            'title_status_id' => 1,
        ])->first();

        if(!$check){
            return back()->with('status', 'Data tidak ditemukan');
        }

        Title::where([
            'id' => $id,
            'student_id' => $studentID,
            'lecturer_id' => auth()->user()->id,
        ])->update([
            'title_status_id' => 2,
            'description' => $request->description,
        ]);

        // Student last submission
        $lastSubmission = JobTraining::where([
            'user_id' => $studentID,
        ])->latest()->first();

        $checkAllTitles = Title::where([
            'student_id' => $studentID,
            'title_status_id' => 1
        ])->get();

        if(count($checkAllTitles) == 0){
            JobTraining::where([
                'id' => $lastSubmission->id
            ])->update([
                'submission_status_id' => 17,
            ]);
        }

        return back()->with('status', 'Judul telah ditolak');
    }
}
