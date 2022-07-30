<?php

namespace App\Http\Controllers;

use ZipArchive;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function updateSystem(Request $request){
        if ($request->hasFile('update_zip')) {
            if (class_exists('ZipArchive')) {

                // Create update directory.
                $dir = 'updates';
                if (!is_dir($dir))
                    mkdir($dir, 0777, true);

                $path = Storage::disk('local')->put('updates', $request->update_zip);
                uploadFileToPublic('system', $request->update_zip);

                // $zipped_file_name = $request->update_zip->getClientOriginalName();

                //Unzip uploaded update file and remove zip file.
                $zip = new ZipArchive();
                $res = $zip->open(storage_path('app/'.$path));

                if ($res === true) {
                    $res = $zip->extractTo(base_path());
                    // $res = $zip->extractTo(base_path()."/unzip");
                    $zip->close();

                    // Delete zip file.
                    if (file_exists(storage_path('app/'.$path))) {
                        unlink(storage_path('app/'.$path));
                    }

                    return 'success';
                } else {
                    return "Could not open the updates zip file.";
                }

                return redirect()->route('update.step1');
            }else {
                return "Please enable ZipArchive extension.";
            }
        }


        return 'no file';
    }
}
