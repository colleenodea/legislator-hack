<?php

class Data {

    public static function getData($type) {
        $array = self::readCSV(dirname(__FILE__) . "/../data/$type.csv");
        $rows = array();

        $cols = array_shift($array);
        $row = array();
        for($i = 0; $i < count($array); $i++) {
            for($c = 0; $c < count($array[$i]); $c++) {
                $row[strtolower($cols[$c])] = $array[$i][$c];
            }

            $rows[] = $row;
            $row = array();
        }

        return $rows;
    }

    public static function readCSV($path) {
        $file_handle = fopen($path, 'r');

        while (!feof($file_handle) ) {
            $line_of_text[] = fgetcsv($file_handle, 1024);
        }

        fclose($file_handle);

        return $line_of_text;
    }

}