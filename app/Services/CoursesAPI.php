<?php

namespace App\Services;

use Config;
use Log;


class CoursesAPI {
    public $courses_url;
    
    public function __construct()
    {
        $this->courses_url = Config::get('services.courses.url');
    }

    public function getAllCourses($arrayFormat=false)
    {
        Log::info($this->courses_url);
        $client = new \GuzzleHttp\Client();
        $res = $client->get($this->courses_url);   
        if ($res->getStatusCode() == 200) {
            $body = $res->getBody();
            $courses = json_decode($body, $arrayFormat);
        } else {
            error_log("Failed to fetch courses, error: ".$res->getBody());
            $courses = [];
        }
        return $courses;
    }
}