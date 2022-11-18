<?php

namespace App\Services;


class ReportGenerator{
    public function createCSV($jsonList, $filePath)
    {   
        $filePointer = fopen($filePath, 'w');
        if ($filePointer == false || empty($jsonList)){
            return false;
        }
        $isHeadersSaved = false;
        foreach ($jsonList as $list){
            if ($isHeadersSaved == false){
                $keys = array_keys($list);
                $isHeadersSaved = true;
                fputcsv($filePointer, $keys);
            }
            $values = array_values($list);
            fputcsv($filePointer, $values);
        }
        return true;
    }
}