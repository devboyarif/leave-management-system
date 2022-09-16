<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Http\Requests\Admin\LanguageCreateRequest;
use App\Http\Requests\Admin\LanguageUpdateRequest;

class LanguageController extends Controller
{
    public function index()
    {
        $languages = Language::all();
        $path = base_path('resources/json/languages.json');
        $langInfos = json_decode(file_get_contents($path), true);
        $defaultLanguage = Language::where('code', config('kodebazar.default_language'))->value('id');

        return inertia('admin/setting/language/index', [
            'languages' => $languages,
            'langInfos' => $langInfos,
            'defaultLanguage' => $defaultLanguage,
        ]);
    }

    public function store(LanguageCreateRequest $request)
    {
        $language = Language::create([
            'name' => $request->name,
            'code' => $request->code,
            'status' => $request->status ? 1 : 0,
        ]);

        $baseFile = base_path('resources/lang/en.json');
        $fileName = base_path('resources/lang/' . strSlug($request->code) . '.json');
        copy($baseFile, $fileName);

        session()->flash('success', 'Language added successfully.');
        return redirect()->route('languages.translation.edit', $language->id);
    }

    public function update(LanguageUpdateRequest $request, Language $lang)
    {
        $oldFile = $lang->code . '.json';
        $oldName = base_path('resources/lang/' . $oldFile);
        $newFile = strSlug($request->code) . '.json';
        $newName = base_path('resources/lang/' . $newFile);

        rename($oldName, $newName);

        $lang->update([
            'name' => $request->name,
            'code' => $request->code,
            'status' => $request->status ? 1 : 0
        ]);

        session()->flash('success', 'Language updated successfully.');
        return back();
    }

    public function destroy(Language $lang)
    {
        if (File::exists(base_path('resources/lang/' . $lang->code . '.json'))) {
            File::delete(base_path('resources/lang/' . $lang->code . '.json'));
        }

        $lang->delete();

        session()->flash('success', 'Language deleted successfully.');
        return back();
    }

    public function translationEdit(Language $lang)
    {
        $path = base_path('resources/lang/' . $lang->code . '.json');
        $translations = json_decode(file_get_contents($path), true);

        return inertia('admin/setting/language/translation', [
            'lang' => $lang,
            'translations' => $translations,
        ]);
    }

    public function translationUpdate(Request $request, Language $lang)
    {
        $filePath = base_path('resources/lang/' . $lang->code . '.json');

        $data = file_get_contents($filePath);
        $translations = json_decode($data, true);
        $requestTranslations = $request->translations;

        foreach ($translations as $key => $value) {
            if ($requestTranslations[$key]) {
                $translations[$key] = $requestTranslations[$key];
            } else {
                $translations[$key] = "";
            }
        }
        file_put_contents($filePath, json_encode($translations, JSON_UNESCAPED_UNICODE));

        session()->flash('success', 'Language translation updated successfully.');
        return back();
    }

    public function statusUpdate(Language $lang)
    {
        if ($lang->status) {
            $lang->update(['status' => 0]);
        } else {
            $lang->update(['status' => 1]);
        }

        session()->flash('success', 'Language status updated successfully.');
        return back();
    }

    public function singleTranslate(Request $request)
    {
        try {
            $code = $request->code;
            $key = $request->key;

            $translatedText = translateIt($key, $code);
            return response()->json($translatedText);
        } catch (\Exception $e) {
            return response()->json($key);
        }
    }
    public function allTranslate()
    {
        $language = Language::findOrFail(request('id'));
        $data = file_get_contents(base_path('resources/lang/' . $language->code . '.json'));
        $translations = json_decode($data, true);

        $afterTrans = [];
        $tr = new GoogleTranslate($language->code);
        foreach ($translations as $key => $value) {

            $autoTransValue = $tr->translate($value);
            $afterTrans[$key] = $autoTransValue;
        }

        return response()->json($afterTrans);
    }

    public function defaultLanguage(Language $lang){
        checkSetEnv('APP_DEFAULT_LANGUAGE', $lang->code);

        session()->flash('success', 'Language default set successfully.');
        return back();
    }
}
