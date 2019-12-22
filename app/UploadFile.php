<?php
/**
 * Created by PhpStorm.
 * User: Vaharsolta
 * Date: 22.12.2019
 * Time: 7:03
 */

namespace App;

use Illuminate\Support\Facades\Input;


class UploadFile
{
    public $array_path = [
        'icon' => 'ibgame/img/',
        'resource' => 'file/resource/',
        'evidence' => 'file/evidence/',
        'trigger' => 'file/trigger/'
    ];

    public function uploadFile($key)
    {

        if (Input::file($key)) {
            $input = Input::file($key);
            $extension = $input->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '.' . $extension;
            $destinationPath = public_path($this->array_path[$key]);
            $input->move($destinationPath, $fileName);
            return $fileName;
        }
        return null;
    }

    public function deleteCurrentFile($currentFile, $key)
    {
        if (true === $this->fileExists($currentFile, $key)) {
            unlink(public_path($this->array_path[$key] . $currentFile));
        }
    }

    private  function fileExists($currentFile, $key)
    {
        if (!empty($currentFile) && $currentFile != null) {
            return file_exists(public_path($this->array_path[$key] . $currentFile));
        }
    }
}