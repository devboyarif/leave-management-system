<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountSetupController extends Controller
{
    public function accountSetup(){
        return inertia('company/setup/index');
    }
}
