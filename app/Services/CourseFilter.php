<?php

namespace App\Services;

use Config;

class CourseFilter {
    public function filterCoursesByValue($courses, $key, $value)
    {
        $filteredArray = array();
        foreach ($courses as $item){
            if ($item[$key] == $value){
                $filteredArray[] = $item;  
            }
        }
        return $filteredArray;
    }

    public function filterCourseKeys($courses, $keys){
        $filteredArray = array_map(function ($course) use($keys){
            $filtered = [];
            foreach ($keys as $key){
                if (array_key_exists($key, $course)){
                    $filtered[$key] = $course[$key];
                }
            }
            return $filtered;
        }, $courses);
        return $filteredArray;
    }
}