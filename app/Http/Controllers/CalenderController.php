<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Semester;
use Illuminate\Http\Request;

class CalenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->role_id != 1){
            return abort(403);
        }
        $data['calenders'] = AcademicYear::with(['semester'])->latest()->get();
        $data['semesters'] = Semester::get();
        $data['activeYear'] = AcademicYear::where(['is_active' => 1])->with(['semester'])->first();
        return view('calender.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'semester_id' =>'required',
            'year' => 'required'
        ]);

        AcademicYear::where([
            'is_active' =>1
        ])->update([
            'is_active' =>0
        ]);

        AcademicYear::create([
            'semester_id' => $request->semester_id,
            'year' => $request->year,
            'is_active' => 1
        ]);

        return back()->with('status', 'Berhasil menambahkan tahun ajaran baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $year)
    {
        $year = AcademicYear::where('id', $year)->first();
        $year->delete();

        $checkYears = AcademicYear::get();
        if(count($checkYears) > 0){
            if($year->is_active == 1){
                $latestYear = AcademicYear::latest()->first();
                $latestYear->update([
                    'is_active' => 1
                ]);
            }
        }

        return back()->with('status', 'Berhasil menghapus tahun ajaran');
    }
}
