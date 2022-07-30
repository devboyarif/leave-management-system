<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/test', function () {
    return view('system.app_status');
})->name('test');

Route::post('update/system', function(Request $request){

    if ($request->hasFile('update_zip')) {
        if (class_exists('ZipArchive')) {
            // return class_exists('ZipArchive');
            // Create update directory.
            $dir = 'updates';
            if (!is_dir($dir))
                mkdir($dir, 0777, true);

            $path = Storage::disk('local')->put('updates', $request->update_zip);

            $zipped_file_name = $request->update_zip->getClientOriginalName();

            return $zipped_file_name;

            //Unzip uploaded update file and remove zip file.
            $zip = new ZipArchive;
            $res = $zip->open(base_path('public/' . $path));

            if ($res === true) {
                $res = $zip->extractTo(base_path());
                $zip->close();
            } else {
                return "Could not open the updates zip file.";
            }

            return redirect()->route('update.step1');
        }else {
            return "Please enable ZipArchive extension.";
        }
    }



    return 'no file';









})->name('update.system');
