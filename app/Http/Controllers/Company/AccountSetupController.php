<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Traits\Company\HasAccountSetup;
use Illuminate\Http\Request;

class AccountSetupController extends Controller
{
    use HasAccountSetup;

    public function accountSetup(){
        return inertia('company/setup/index');
    }

    public function step1(Request $request){
        try {
            $this->saveStep1($request);
            return back();
        } catch (\Throwable $th) {
            session()->flash('error', config('app.debug') ? $th->getMessage():'Something went wrong');
            return back();
        }

    }

    public function step2(Request $request){
        try {
            $this->saveStep2($request);
            return back();
        } catch (\Throwable $th) {
            session()->flash('error', config('app.debug') ? $th->getMessage():'Something went wrong');
            return back();
        }
    }

    public function step3(Request $request){
        //
    }

    public function step4(Request $request){
        //
    }

    public function step5(Request $request){
        //
    }
}
