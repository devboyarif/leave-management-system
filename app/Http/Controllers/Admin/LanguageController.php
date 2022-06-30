<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\LanguageCreateRequest;
use App\Http\Requests\Admin\LanguageUpdateRequest;

class LanguageController extends Controller
{
    public function index()
    {
        $languages = Language::all();

        return inertia('admin/setting/language/index', [
            'languages' => $languages,
        ]);
    }

    public function store(LanguageCreateRequest $request)
    {
        Language::create([
            'name' => $request->name,
            'code' => $request->code,
            'direction' => $request->direction,
        ]);

        $baseFile = base_path('resources/lang/en.json');
        $fileName = base_path('resources/lang/' . strSlug($request->code) . '.json');
        copy($baseFile, $fileName);

        session()->flash('success', 'Language added successfully.');
        return back();
    }

    public function update(LanguageUpdateRequest $request, Language $language)
    {
        $oldFile = $language->code . '.json';
        $oldName = base_path('resources/lang/' . $oldFile);
        $newFile = strSlug($request->code) . '.json';
        $newName = base_path('resources/lang/' . $newFile);

        rename($oldName, $newName);

        $language->update([
            'name' => $request->name,
            'code' => $request->code,
            'direction' => $request->direction
        ]);

        session()->flash('success', 'Language updated successfully.');
        return back();
    }

    public function destroy(Language $language)
    {
        if (File::exists(base_path('resources/lang/' . $language->code . '.json'))) {
            File::delete(base_path('resources/lang/' . $language->code . '.json'));
        }

        $language->delete();

        session()->flash('success', 'Language deleted successfully.');
        return back();
    }
}
