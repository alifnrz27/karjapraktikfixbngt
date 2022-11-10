<?php

namespace App\Http\Controllers;

use App\Models\JobTraining;
use App\Models\Logbook;
use Illuminate\Http\Request;

class LogbookController extends Controller
{
    public function add(Request $request){
        // cek apakah yang akses adalah mahasiswa
        if(auth()->user()->role_id != 3){
            return abort(403);
        }
        $rules = [
            'date' => 'required',
            'description' => 'required',
        ];
        $validated = $request->validate($rules);

        $submission = JobTraining::where('user_id', auth()->user()->id)->latest()->first();
        
        $logbooks = Logbook::where(['user_id' => auth()->user()->id, 'job_training_id' => $submission->id])->get();
        if (count($logbooks) > 0){
            $countLogbook = count($logbooks);
            $logbook = $logbooks[$countLogbook-1];
        }

        $inputDate = strtotime($request->date);
        $startDate = strtotime($submission->start);
        $endDate = strtotime($submission->end);
        $now = strtotime('now +7 hours');
        
        // jika tanggal di luar rentang waktu yang ditentukan
        if ($inputDate < $startDate || $inputDate > $endDate ){
            return back()->with('status', 'tanggal inputan di luar rentang');
        }

        // jika user memasukkan tanggal yang belum dilalui
        if($inputDate > $now){
            return back()->with('status', 'Selesaikan harimu, baru input data');
        }

        // jika user belum memasukkan data sebelum hari ini
        if(count($logbooks) == 0){
            // jika user belum memasukkan sama sekali logbook, namun sudah lompat ke tanggal lain
            if($inputDate >= strtotime($submission->start . ' +1 day')){
                return back()->with('status', 'Hari pertama belum diisi');
            }
        }
        else{
            // jika user memasukkan tanggal, namun hari sebelumnya belum diinputkan
            if($inputDate > strtotime($logbook->date . ' +1 day')){
                return back()->with('status', 'Isi hari sebelumnya');
            }
        }

        // jika user memasukkan logbook di tanggal yang sudah diinput
        foreach($logbooks as $logbook){
            if($logbook->date == $request->date){
                return back()->with('status', 'Kamu sudah isi hari ini');
            }
        }

        // isi tabel logbook
        Logbook::create([
            'user_id'=>auth()->user()->id,
            'job_training_id' => $submission->id,
            'date'=>$request->date,
            'description'=>$request->description
        ]);

        return back()->with('status', 'Berhasil menambah logbook');
    }
}
