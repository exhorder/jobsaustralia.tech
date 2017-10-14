<?php

namespace App\Http\Controllers;

use App\Application;
use App\Employer;
use App\Job;
use App\Mail\Apply;
use App\User;

use Auth;
use Mail;
use Uuid;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller{

    /* Create a new controller instance. */
    public function __construct(){
        $this->middleware('auth');
    }

    /* Apply for a job. */
    public function apply(Request $request){
        $this->validate($request, [
            'jobid' => 'required|regex:/^[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}$/|exists:jobs,id',
            'message' => 'required|string'
        ]);

        $id = $request['jobid'];

        $count = Application::where('jobid', $id)->where('userid', Auth::user()->id)->get()->count();

        /* Verify that the job seeker has not yet applied to the job. */
        if($count == 0){
            $job = Job::findOrFail($id);

            $appid = Uuid::generate();

            Application::create([
                'id' => $appid,
                'userid' => Auth::user()->id,
                'employerid' => $job->employerid,
                'jobid' => $id,
                'message' => $request['message']
            ]);

            /* Check that mail is configured before attempting to send. */
            if(env('MAIL_USERNAME') !== null){
                $employer = Employer::findOrFail($job->employerid);
                $email = $employer->email;

                /* Send a notification email to the employer depending on preference. */
                if($employer->notifyapply && substr($email, -4) !== ".dev"){
                    $link = "https://employ.jobsaustralia.tech/application/" . $appid;
                    $title = $job->title;

                    Mail::to($email)->queue(new Apply($link, $title));
                }
            }
        }

        return Redirect::route('applications');
    }

    /* Display applications page. */
    public function indexApplications(){
        $user = Auth::user();

        $applications = Application::where('userid', $user->id)->get();

        foreach($applications as $application){
            $job = Job::findOrFail($application->jobid);
            $application->jobtitle = $job->title;

            $employer = Employer::findOrFail($application->employerid);
            $application->employername = $employer->name;
        }

        return view('applications')->with(compact('applications'));
    }

    /* Display delete application page. */
    public function indexDelete($id){
        $application = Application::findOrFail($id);
        $job = Job::findOrFail($application->jobid);
        $application->jobtitle = $job->title;
        $user = Auth::user();

        if($application->userid == $user->id){
            return view('delete-application', compact('application'));
        }
        else{
            return Redirect::route('applications');
        }
    }

    /* Delete application. */
    public function delete(Request $request){
        $id = $request['id'];
        $application = Application::findOrFail($id);
        $user = Auth::user();

        if(User::findOrFail($application->userid) == $user){
            Application::destroy($id);
        }

        return Redirect::route('applications');
    }
}
