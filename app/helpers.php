<?php

use App\Models\Company;
use Illuminate\Support\Str;

function uploadFileToPublic(string $path, $file)
{
    if ($file && $path) {
        $url = $file->move('uploads/' . $path, $file->hashName());
    } else {
        $url = null;
    }

    return $url;
}

function getCompany($user_id)
{
    return Company::where('user_id', $user_id)->firstOrFail();
}

function strSlug($name)
{
    return Str::slug($name);
}
