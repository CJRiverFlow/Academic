<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Services\CoursesAPI;
use App\Services\CourseFilter;
use Cache;
use Log;


class FetchCoursesController extends Controller
{   
    private $reportColumns;

    public function __construct()
    {
        $this->reportColumns = array("id", "name", "course_code", "workflow_state", "start_at", "end_at");
    }

    public function __invoke(): JsonResponse
    {
    $minutes = 5;
    $courses = Cache::remember('courses', $minutes, function () {
        Log::info("Not from cache");
        $coursesAPI = new CoursesAPI(); 
        $courseList = $coursesAPI->getAllCourses($arrayFormat=true);
        $courseFilter = new CourseFilter();
        $filteredCourses = $courseFilter->filterCourseKeys($courseList, $this->reportColumns);
        return $filteredCourses;
    });
    return response() -> json($courses);
    }
}
