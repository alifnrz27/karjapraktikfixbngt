<?php

namespace App\Http\Controllers;

use App\Models\JobTraining;
use App\Models\Mentoring;
use App\Models\Report;
use App\Models\Role;
use App\Models\Team;
use App\Models\Title;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        if(auth()->user()->role_id != 1){
            return abort(403);
        }

        $data['users'] = User::where([
            ['email', '!=', 'admin@el.itera.ac.id'],
            ['active_id', '!=', 0]
        ])->with(['role'])->latest()->get();

        $data['roles'] = Role::get();

        return view('user.index', $data);
    }

    public function update(Request $request, User $user){
        $request->validate([
            'role_id' => 'required'
        ]);

        $user->update([
            'role_id' => $request->role_id
        ]);

        return back()->with('status', 'Berhasil mengubah role '.$user->name);
    }

    public function destroy(Request $request, User $user){

        if($user->role_id != 3){
            return abort(404);
        }

        $Submissions = JobTraining::where(['user_id' => $user->id])->get();

        foreach($Submissions as $s){
            if($s->team_id != 0){
                $memberTeam = JobTraining::where(['team_id' => $s->team_id])->first();
                Team::where(['id' => $s->team_id])->update([
                    'user_id' => $memberTeam->user_id
                ]);
            }
        }

        $user->update([
            'active_id'=>0,
            'inviteable' => 0
        ]);

        JobTraining::where([
            'user_id' => $user->id
        ])->delete();

        Mentoring::where([
            'student_id' => $user->id
        ])->delete();

        Report::where([
            'student_id' => $user->id
        ])->delete();

        Title::where([
            'student_id' => $user->id
        ])->delete();



        return back()->with('status', 'Berhasil mencegah user '.$user->name);
    }
}
