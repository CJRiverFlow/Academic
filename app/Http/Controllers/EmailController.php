<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CoursesAPI;
use App\Services\CourseFilter;
use App\Services\ReportGenerator;
use Mail;


class EmailController extends Controller
{   
    private $reportColumns;

    public function __construct()
    {
        $this->reportColumns = array("id", "name", "course_code", "workflow_state", "start_at", "end_at");
    }

    public function email(){
        return view('email');
    }

    private function getAvailableCourses(){
        $coursesAPI = new CoursesAPI(); 
        $courses = $coursesAPI->getAllCourses($arrayFormat=True);
        $courseFilter = new CourseFilter();
        $filteredCourses = $courseFilter->filterCoursesByValue($courses, "workflow_state", "available");
        $filteredCourses = $courseFilter->filterCourseKeys($filteredCourses, $this->reportColumns);
        return $filteredCourses;
    }

    private function getTempPathFile(){
        $str = rand();
        $randString = md5($str); 
        $temp_path = '/tmp/course_report_'.$randString.'.csv';
        return $temp_path;
    }

    public function emailPost(Request $request){
        $this->validate($request, ['email' => 'required|email']);
        $recipient = $request->get('email');
        
        $courses = $this->getAvailableCourses();
        $reportGenerator = new ReportGenerator();
        $filePath = $this->getTempPathFile();
        $isReportCreated = $reportGenerator->createCSV($courses, $filePath);

        Mail::send('course_report', ['email' => $recipient,'courses' => $courses],
                function ($message) use($recipient, $filePath, $isReportCreated){
                        $message->from(getenv('MAIL_FROM_ADDRESS'));
                        $message->to($recipient);
                        $message->subject('Available Courses');
                        if ($isReportCreated == true && file_exists($filePath)){
                            $message->attach($filePath);
                        }
        });
        if (file_exists($filePath)){
            unlink($filePath);
        }
        return redirect('/')->with('success', 'Report sent to '.$recipient);
    }
}
