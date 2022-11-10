<?php

namespace App\Http\Controllers;

use App\Models\JobTraining;
use App\Models\Mentoring;
use Illuminate\Http\Request;

class MentoringController extends Controller
{
    public function add(){
        $lastSubmission = JobTraining::where(['user_id'=>auth()->user()->id])->latest()->first();

        // cek apakah pengajuan sebelumnya belum selesai
        $addMentorings = Mentoring::where([
            'student_id'=>auth()->user()->id,
        ])->get();

        $statusMentoring = true; // true berarti bisa mengajukan
        foreach($addMentorings as $mentoring){
            // kalo ada yg belum selesai, maka gaboleh ajuin
            if($mentoring->mentoring_status_id != 4 && $mentoring->mentoring_status_id != 2){ 
                $statusMentoring = false;
            }
        }

        if($statusMentoring == false){
            return back()->with('status', 'belum boleh ajuin lagi, selesaiin dulu yg sebelumnya');
        }

        Mentoring::create([
            'student_id'=>auth()->user()->id,
            'academic_year_id' => $lastSubmission->academic_year_id,
            'job_training_id'=>$lastSubmission->id,
            'mentoring_status_id' => 1,
            'lecturer_id' => $lastSubmission->lecturer_id,
            'time' => '-',
            'description'=> '-',
        ]);

        return back()->with('status', 'Berhasil mengajukan bimbingan');
    }

    public function accept(Request $request, $studentID){
        $lastSubmission = JobTraining::where(['user_id'=>$studentID])->latest()->first();

        $request->validate([
            'time' => 'required',
            'description' => 'required',
        ]);
        // cek apakah ada yg mengajukan, takutnya diubah ubah datanya di inspect elemen
        $check = Mentoring::where([
            'student_id' => $studentID,
            'lecturer_id' => auth()->user()->id,
            'job_training_id'=>$lastSubmission->id,
            'mentoring_status_id' => 1,
        ])->first();

        if(!$check){
            return back()->with('status', 'Data tidak ditemukan');
        }

        Mentoring::where([
            'student_id' => $studentID,
            'lecturer_id' => auth()->user()->id,
            'job_training_id'=>$lastSubmission->id,
            'mentoring_status_id' => 1,
        ])->update([
            'mentoring_status_id' => 3,
            'time' => $request->time,
            'description' => $request->description,
        ]);

        return back()->with('status', 'Data berhasil ditambahkan');
    }

    public function decline(Request $request, $studentID){
        $lastSubmission = JobTraining::where(['user_id'=>$studentID])->latest()->first();

        // cek apakah ada yg mengajukan, takutnya diubah ubah datanya di inspect elemen
        $check = Mentoring::where([
            'student_id' => $studentID,
            'lecturer_id' => auth()->user()->id,
            'job_training_id'=>$lastSubmission->id,
            'academic_year_id' =>$lastSubmission->academic_year_id,
            'mentoring_status_id' => 1,
        ])->first();

        if(!$check){
            return back()->with('status', 'Data tidak ditemukan');
        }

        Mentoring::where([
            'student_id' => $studentID,
            'lecturer_id' => auth()->user()->id,
            'job_training_id'=>$lastSubmission->id,
            'mentoring_status_id' => 1,
        ])->update([
            'mentoring_status_id' => 2,
        ]);

        return back()->with('status', 'Berhasil menolak');
    }

    public function cancel(Request $request, $queueID){
        // cek apakah ada yg mengajukan, takutnya diubah ubah datanya di inspect elemen
        $check = Mentoring::where([
            'id' => $queueID,
            'lecturer_id' => auth()->user()->id,
            'mentoring_status_id' => 3,
        ])->first();

        if(!$check){
            return back()->with('status', 'Data tidak ditemukan');
        }

        Mentoring::where([
            'id' => $queueID,
            'lecturer_id' => auth()->user()->id,
            'mentoring_status_id' => 3,
        ])->update([
            'mentoring_status_id' => 2,
        ]);

        return back()->with('status', 'Berhasil membatalkan');
    }

    public function finished(Request $request, $queueID){
        // cek apakah ada yg mengajukan, takutnya diubah ubah datanya di inspect elemen
        $check = Mentoring::where([
            'id' => $queueID,
            'lecturer_id' => auth()->user()->id,
            'mentoring_status_id' => 3,
        ])->first();

        if(!$check){
            return back()->with('status', 'Data tidak ditemukan');
        }

        Mentoring::where([
            'id' => $queueID,
            'lecturer_id' => auth()->user()->id,
            'mentoring_status_id' => 3,
        ])->update([
            'mentoring_status_id' => 4,
        ]);

        return back()->with('status', 'Berhasil merubah data');
    }

    public function update(Request $request, $queueID){
        $request->validate([
            'time' => 'required',
            'description' => 'required',
        ]);
        // cek apakah ada yg mengajukan, takutnya diubah ubah datanya di inspect elemen
        $check = Mentoring::where([
            'id' => $queueID,
            'lecturer_id' => auth()->user()->id,
            'mentoring_status_id' => 3,
        ])->first();

        if(!$check){
            return back()->with('status', 'Data tidak ditemukan');
        }

        Mentoring::where([
            'id' => $queueID,
            'lecturer_id' => auth()->user()->id,
            'mentoring_status_id' => 3,
        ])->update([
            'time' => $request->time,
            'description' => $request->description
        ]);

        return back()->with('status', 'Berhasil update data');
    }
}
