<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class ImagesHelper {

   static function GetImagePath($strAction, $id, $filename,$withDefault=true) {

        if($withDefault){
            $default = asset('assets/production/images/not-available.jpg');
        }else{
            $default = '';
        }

        if($filename == '') {
            return $default;
        }

        $path = Config::get('app.IMAGE_BASE');
        $checkFile = str_replace('Engine', 'Backend', public_path() . '/uploads');
        // $checkFile = str_replace('public_html', 'public_html/Backend', public_path() . '/uploads');

        switch ($strAction) {
            case "users":
                $fullPath = $path.'uploads' . '/users/' . $id . '/' . $filename;
                $checkFile = $checkFile . '/users/' . $id . '/' . $filename;
                return is_file($checkFile) ? URL::to($fullPath) : $default;
                break;
            case "pages":
                $fullPath = $path.'uploads' . '/pages/' . $id . '/' . $filename;
                $checkFile = $checkFile . '/pages/' . $id . '/' . $filename;
                return is_file($checkFile) ? URL::to($fullPath) : $default;
                break;
            case "sliders":
                $fullPath = $path.'uploads' . '/sliders/' . $id . '/' . $filename;
                $checkFile = $checkFile . '/sliders/' . $id . '/' . $filename;
                return is_file($checkFile) ? URL::to($fullPath) : $default;
                break;
            case "variables":
                $fullPath = $path.'uploads' . '/variables/' . $id . '/' . $filename;
                $checkFile = $checkFile . '/variables/' . $id . '/' . $filename;
                return is_file($checkFile) ? URL::to($fullPath) : $default;
                break;
            case "photos":
                $fullPath = $path.'uploads' . '/photos/' . $filename;
                $checkFile = $checkFile . '/photos/' . $filename;
                return is_file($checkFile) ? URL::to($fullPath) : $default;
                break;
            case "memberships":
                $fullPath = $path.'uploads' . '/memberships/' . $id . '/' . $filename;
                $checkFile = $checkFile . '/memberships/' . $id . '/' . $filename;
                return is_file($checkFile) ? URL::to($fullPath) : $default;
                break;
            case "projects":
                $fullPath = $path.'uploads' . '/projects/' . $id . '/' . $filename;
                $checkFile = $checkFile . '/projects/' . $id . '/' . $filename;
                return is_file($checkFile) ? URL::to($fullPath) : $default;
                break;
            case "blogs":
                $fullPath = $path.'uploads' . '/blogs/' . $id . '/' . $filename;
                $checkFile = $checkFile . '/blogs/' . $id . '/' . $filename;
                return is_file($checkFile) ? URL::to($fullPath) : $default;
                break;
        }

        return $default;
    }

    static function uploadImage($strAction, $fieldInput, $id, $customPath = '') {

        if ($fieldInput == '') {
            return false;
        }

        if (is_object($fieldInput)) {
            $fileObj = $fieldInput;
        } else {
            if (!Request::hasFile($fieldInput)) {
                return false;
            }

            $fileObj = Request::file($fieldInput);
        }

        if ($fileObj->getSize() >= 10000000) {
            return false;
        }

        $extensionExplode = explode('/' , $fileObj->getMimeType()); // getting image extension
        unset($extensionExplode[0]);
        $extensionExplode = array_values($extensionExplode);
        $extension = $extensionExplode[0];

        if (!in_array($extension, ['vnd.openxmlformats-officedocument.wordprocessingml.document','jpg', 'jpeg', 'JPG', 'JPEG', 'png', 'PNG', 'gif', 'GIF','zip','rar','docx','pdf','dwg'])) {
            return false;
        }
            
        $rand = rand() . date("YmdhisA");
        $fileName = 'ryady' . '-' . $rand;
        $directory = '';

        $path = public_path() . '/uploads/';
        $path = str_replace('Engine', 'Backend', $path);
        // $path = str_replace('public_html', 'public_html/Backend', $path);

        if ($strAction == 'users') {
            $directory = $path . 'users/' . $id;
        }

        if ($strAction == 'pages') {
            $directory = $path . 'pages/' . $id;
        }

        if ($strAction == 'sliders') {
            $directory = $path . 'sliders/' . $id;
        }

        if ($strAction == 'memberships') {
            $directory = $path . 'memberships/' . $id;
        }

        if ($strAction == 'projects') {
            $directory = $path . 'projects/' . $id;
        }

        if ($strAction == 'blogs') {
            $directory = $path . 'blogs/' . $id;
        }

        if ($strAction == 'variables') {
            $directory = $path . 'variables/' . $id;
        }

        $fileName_full = $fileName . '.' . $extension;

        if ($directory == '') {
            return false;
        }

        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }

        if ($fileObj->move($directory, $fileName_full)){
            return $fileName_full;
        }

        return false;
    }

    static function uploadCustom($strAction, $fieldInput, $customPath = '') {

        if ($fieldInput == '') {
            return false;
        }

        if (is_object($fieldInput)) {
            $fileObj = $fieldInput;
        } else {
            if (!Request::hasFile($fieldInput)) {
                return false;
            }

            $fileObj = Request::file($fieldInput);
        }

        if ($fileObj->getSize() >= 2000000) {
            return false;
        }

        $extensionExplode = explode('/' , $fileObj->getMimeType()); // getting image extension
        unset($extensionExplode[0]);
        $extensionExplode = array_values($extensionExplode);
        $extension = $extensionExplode[0];
        if (!in_array($extension, ['jpg', 'jpeg', 'JPG', 'JPEG', 'png', 'PNG', 'gif', 'GIF','zip','rar','vnd.openxmlformats-officedocument.wordprocessingml.document','vnd.openxmlformats-officedocument.spreadsheetml.sheet','xlsx','csv','docx','pdf','dwg'])) {
            return false;
        }
        $directory = '';
        $path = public_path() . '/uploads/';

        if ($strAction == 'photos') {
            $directory = $path . 'photos/';
        }
        if ($strAction == 'files') {
            $directory = $path . 'files/';
        }

        $fileName_full = $fileObj->getClientOriginalName();

        if ($directory == '') {
            return false;
        }

        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }

        if ($fileObj->move($directory, $fileName_full)){
            return $fileName_full;
        }

        return false;
    }



    static function deleteDirectory($dir) {
        system('rm -r ' . escapeshellarg($dir), $retval);
        return $retval == 0; // UNIX commands return zero on success
    }

}