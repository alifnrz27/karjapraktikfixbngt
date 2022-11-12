<?php

namespace App\Http\Controllers;

use App\Models\JobTraining;
use Illuminate\Http\Request;

class EvaluateController extends Controller
{
    public function store(Request $request, $studentID, $id){

        $submission = JobTraining::where([
            'user_id' => $studentID,
            'id' => $id,
            'evaluated_id' => 0
        ])->latest()->first();

        if(!$submission){
            return abort(403);
        }

        if($submission->submission_status_id == 24){
            $submission->update([
                'submission_status_id' => 25,
                'evaluated_id' => 1
        ]);
        } 
        else{
            $submission->update([
                'evaluated_id' => 1
            ]);
        }

        return back()->with('status', 'Berhasil memberi nilai');
    }
}
