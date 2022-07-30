<?php

use Carbon\Carbon;
use App\Models\Holiday;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    // Check .env
    $val = "APP_URL";
    $type = URL::to('/');

    $path = base_path('.env');
    if (file_exists($path)) {
        $val = '"'.trim($val).'"';
        file_put_contents($path, str_replace(
            $type.'="'.env($type).'"', $type.'='.$val, file_get_contents($path)
        ));
    }

    // Check permission
    $permission['curl_enabled']           = function_exists('curl_version');
    $permission['db_file_write_perm']     = is_writable(base_path('.env'));
    $permission['routes_file_write_perm'] = is_writable(base_path('app/Providers/RouteServiceProvider.php'));

    // Check database connect
    $db_host = env('DB_HOST');
    $db_user = env('DB_USERNAME');
    $db_pass = env('DB_PASSWORD');
    $db_name = env('DB_DATABASE');

    if(@mysqli_connect($db_host, $db_user, $db_pass, $db_name)) {
       echo "Connected";
    }else {
        return false;
    }


    // Import sql file
    $sql_path = base_path('updates/app.sql');
    DB::unprepared(file_get_contents($sql_path));

    return 'done';











































    $sql_path = base_path('updates/app.sql');
    DB::unprepared(file_get_contents($sql_path));

    return 'done';

})->name('test');
