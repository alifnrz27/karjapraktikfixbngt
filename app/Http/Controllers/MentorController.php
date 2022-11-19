<?php

namespace App\Http\Controllers;

use App\Models\JobTraining;
use App\Models\User;
use Illuminate\Http\Request;

class MentorController extends Controller
{
    public function add(Request $request, $student)
    {
        // cek apakah dosen ada, takutnya diubah di inspect elemen
        $mentor = User::where(['username' => $request->mentor, 'role_id' => 2, 'active_id' => 1])->first();
        // cek apakah dosen ada, takutnya diubah di inspect elemen
        $student = User::where(['username' => $student, 'role_id' => 3, 'active_id' => 1])->first();
            
        $request->validate(['mentor' => 'required']);
        // cek apakah benar student belum mendapatkan mentor
        $submission = JobTraining::where([
            'user_id' => $student->id,
            'submission_status_id' => 14,
        ])->latest()->first();

        
        if(!$mentor || $student->role_id != 3 || $student->active_id != 1){
            return back()->with('status', 'Tidak ada user');// salah user
        }

        

        if(!$submission){
            return back()->with('status', 'Tidak ada data');// ga ditemukan submissionnnya
        }

        JobTraining::where([
            'user_id' => $student->id,
            'submission_status_id' => 14,
        ])->update([
            'submission_status_id'=>15,
            'lecturer_id' => $mentor->id,
        ]);

        return back()->with('status', 'Berhasil menambahkan data');
    }

    public function update(Request $request, $student, $id)
    {
        // cek apakah dosen dan mahasiswa ada, takutnya diubah di inspect elemen
        $mentor = User::where(['username' => $request->mentor, 'role_id' => 2, 'active_id' => 1])->first();
        $student = User::where(['username' => $student, 'role_id' => 3, 'active_id' => 1])->first();

        
        // cek apakah benar student sudah mendapatkan mentor
        $submission = JobTraining::where([
            'user_id' => $student->id,
        ])->latest()->first();

        if(!$mentor || !$student || !$submission){
            return back()->with('status', 'Tidak ada user');// salah user
        }

        // cek apakah ada student dan mentor di semester yang sama
        $checkMentor = JobTraining::where(['user_id' => $student->id, 
        'lecturer_id' => $mentor->id,
        'id' => $id])->first();
        if($checkMentor){
            return back()->with('status', 'Gagal menambahkan, data sudah ada!');
        }

        // jika ada maka ubah data mentornya
        JobTraining::where([
            'user_id' => $student->id, 
            'id' => $id,
            ])->update(['lecturer_id' => $mentor->id]);

            return back()->with('status', 'Data berhasil diubah');
    }
}
