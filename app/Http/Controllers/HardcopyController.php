<?php

namespace App\Http\Controllers;

use App\Models\JobTraining;
use Illuminate\Http\Request;

class HardcopyController extends Controller
{
    public function accept(Request $request, $studentID, $id){
        // cek apakah ada datanya, takutnya diubah di inspect elemen
        $check = JobTraining::where([
            'user_id' => $studentID,
            'id' => $id,
            'submission_status_id' => 28,
        ])->first();
        if(!$check){
            return back()->with('status', 'Data tidak ditemukan');
        }

        JobTraining::where([
            'user_id' => $studentID,
            'submission_status_id' => 28,
        ])->update([
            'submission_status_id' => 29,
        ]);

        return back()->with('status', 'Berhasil menerima berkas');
    }
}
