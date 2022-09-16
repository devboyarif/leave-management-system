<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ZipArchive;
use Illuminate\Support\Facades\Storage;

class UpgradeController extends Controller
{
    public function updateSystem(Request $request)
    {
        $time_start = microtime(true);

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
                $res = $zip->open(storage_path('app/' . $path));

                if ($res === true) {
                    // $res = $zip->extractTo(base_path());
                    $res = $zip->extractTo(base_path() . "/unzip");
                    $zip->close();

                    // Delete zip file.
                    if (file_exists(storage_path('app/' . $path))) {
                        unlink(storage_path('app/' . $path));
                    }

                    $time_end = microtime(true);
                    $execution_time = ($time_end - $time_start);
                    return '<b>Total Execution Time:</b> ' . ($execution_time * 1000) . 'Milliseconds';

                    return 'success';
                } else {
                    return "Could not open the updates zip file.";
                }

                return redirect()->route('update.step1');
            } else {
                return "Please enable ZipArchive extension.";
            }
        }


        $time_end = microtime(true);
        $execution_time = ($time_end - $time_start);
        return '<b>Total Execution Time:</b> ' . ($execution_time * 1000) . 'Milliseconds';

        return 'no file';
    }
}
