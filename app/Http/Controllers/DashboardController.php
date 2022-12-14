<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\JobTraining;
use App\Models\Logbook;
use App\Models\Mentoring;
use App\Models\MentoringStatus;
use App\Models\Report;
use App\Models\ReportStatus;
use App\Models\Title;
use App\Models\TitleStatus;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index () {
        $academicYear = AcademicYear::where(['is_active' => 1])->first();
        if(!$academicYear){
            if(auth()->user()->role_id == 1){
                return redirect('/calender')->with('status', 'tambahkan tahun ajaran!');
            }else{
                return redirect('/user/profile');
            }
        }
        $data['academicYear'] = $academicYear->year;

        if(auth()->user()->role_id == 1){

            $data['secondCard'] = JobTraining::where([
                'academic_year_id' => $academicYear->id,
                ['submission_status_id', '!=', 3],
                ['submission_status_id', '!=', 6],
                ['submission_status_id', '!=', 7],
                ['submission_status_id', '!=', 8],
            ])->count();

            $data['thirdCard'] = JobTraining::where([
                ['academic_year_id', '=', $academicYear->id],
                ['submission_status_id', '!=', 3],
                ['submission_status_id', '!=', 6],
                ['submission_status_id', '!=', 7],
                ['submission_status_id', '!=', 8],
                ['submission_status_id', '>=' , 30]
            ])->count();

            $data['fourthCard'] = JobTraining::where([
                ['academic_year_id', '=', $academicYear->id],
                ['submission_status_id', '!=', 3],
                ['submission_status_id', '!=', 6],
                ['submission_status_id', '!=', 7],
                ['submission_status_id', '!=', 8],
                ['submission_status_id', '<=' , 13]
            ])->count();

            $data['submissions'] = JobTraining::where([
                                        'submission_status_id' => 9,
                                        'academic_year_id' => $academicYear->id,
                                    ])->with(['user'])->get();
            $data['replyLetters'] = JobTraining::where([
                                        'submission_status_id' => 12,
                                        'academic_year_id' => $academicYear->id,
                                    ])->with(['user'])->get();

            $data['lecturer'] = JobTraining::where([
                                        'submission_status_id' => 14,
                                        'academic_year_id' => $academicYear->id,
                                    ])->with(['user'])->get();
            
            $data['lecturerHistory'] = JobTraining::where([
                                        ['submission_status_id', '>=', 15],
                                        ['academic_year_id' ,'=', $academicYear->id],
                                    ])->with(['user'])->latest()->get();

            $data['mentors'] = User::where([
                                        'role_id' => 2,
                                        'active_id' => 1
                                    ])->get();

            $data['beforePresentations'] = JobTraining::where([
                                            'submission_status_id' => 19,
                                            'academic_year_id' => $academicYear->id,
                                        ])->with(['user'])->get();

            $data['afterPresentations'] = JobTraining::where([
                                            'submission_status_id' => 26,
                                            'academic_year_id' => $academicYear->id,
                                        ])->with(['user'])->get();

            $data['hardcopy'] = JobTraining::where([
                                            'submission_status_id' => 28,
                                            'academic_year_id' => $academicYear->id,
                                        ])->with(['user'])->get();

            $data['status'] = JobTraining::where([
                                            'submission_status_id' => 29,
                                            'academic_year_id' => $academicYear->id,
                                        ])->with(['user'])->get();

            $data['statusHistory'] = JobTraining::where([
                                            'submission_status_id' => 30,
                                        ])->with(['user'])->latest()->get();
        }

        elseif(auth()->user()->role_id == 2){
            
            $data['secondCard'] = JobTraining::where([
                'academic_year_id' => $academicYear->id,
                'lecturer_id' => auth()->user()->id
            ])->count();

            $data['thirdCard'] = JobTraining::where([
                'lecturer_id' => auth()->user()->id,
                'submission_status_id' => 23,
            ])->count();

            $data['fourthCard'] = Mentoring::where([
                'lecturer_id' => auth()->user()->id,
                'mentoring_status_id' => 3,
            ])->count();

            $data['mentorings'] = Mentoring::where([
                'lecturer_id' => auth()->user()->id,
                'mentoring_status_id' => 1,
            ])->with(['student'])->get();

            $data['mentoringsQueue'] = Mentoring::where([
                'lecturer_id' => auth()->user()->id,
                'mentoring_status_id' => 3,
            ])->with(['student'])->get();

            $data['titles'] = Title::where([
                'lecturer_id' => auth()->user()->id,
                'title_status_id' => 1,
            ])->with(['student'])->get();

            $data['reports'] = Report::where([
                'lecturer_id' => auth()->user()->id,
                'report_status_id' => 1,
            ])->with(['student'])->get();

            $data['presentations'] = JobTraining::where([
                'lecturer_id' => auth()->user()->id,
                'submission_status_id' => 22,
            ])->with(['user'])->get();

            $data['presentationsQueue'] = JobTraining::where([
                'lecturer_id' => auth()->user()->id,
                'submission_status_id' => 23,
            ])->with(['user'])->get();

            $data['evaluates'] = JobTraining::where([
                ['lecturer_id', '=', auth()->user()->id],
                ['submission_status_id', '>=', 24],
                ['evaluated_id', '=', 0],
            ])->with(['user'])->get();

            $data['students'] = JobTraining::where([
                'lecturer_id' => auth()->user()->id,
                'academic_year_id' => $academicYear->id
            ])->orderBy('submission_status_id', 'asc')->with(['user', 'submissionStatus'])->get();
        }

        elseif(auth()->user()->role_id == 3){
            $data['submission'] = JobTraining::where(['user_id' => auth()->user()->id])->with(['lecturer'])->latest()->first();
            
            if($data['submission']){
                $data['submissionStatus'] = $data['submission']->submission_status_id;
                $data['fourthCard'] = $data['submission']->submissionStatus->name;
                if($data['submission']->lecturer_id){
                    $data['secondCard'] = $data['submission']->lecturer->name;
                }else{
                    $data['secondCard'] = '-';
                }
    
                if($data['submission']->date_presentation){
                    $data['thirdCard'] = $data['submission']->date_presentation;
                }else{
                    $data['thirdCard'] = '-';
                }
            }else{
                $data['submissionStatus'] = Null;
                $data['secondCard'] = '-';
                $data['thirdCard'] = '-';
                $data['fourthCard'] = '-';
            }


            $data['logbooks'] = Logbook::where(['user_id' => auth()->user()->id])->latest()->get();
            $data['mentoring'] = Mentoring::where(['student_id' => auth()->user()->id])->latest()->get();
            $data['mentoringStatus'] = MentoringStatus::get();

            $data['titles'] = Title::where(['student_id' => auth()->user()->id])->latest()->get();
            $data['titleStatus'] = TitleStatus::get();

            $data['reports'] = Report::where(['student_id' => auth()->user()->id])->latest()->get();
            $data['reportStatus'] = ReportStatus::get();
        }
        return view('dashboard', $data);
    }
}
