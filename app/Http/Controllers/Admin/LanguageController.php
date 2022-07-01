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

        $path = base_path('Resources/json/languages.json');
        $langInfos = json_decode(file_get_contents($path), true);

        return inertia('admin/setting/language/index', [
            'languages' => $languages,
            'langInfos' => $langInfos,
        ]);
    }

    public function store(LanguageCreateRequest $request)
    {
        Language::create([
            'name' => $request->name,
            'code' => $request->code,
            'direction' => $request->direction,
            'status' => $request->status ? 1 : 0,
        ]);

        $baseFile = base_path('resources/lang/en.json');
        $fileName = base_path('resources/lang/' . strSlug($request->code) . '.json');
        copy($baseFile, $fileName);

        session()->flash('success', 'Language added successfully.');
        return back();
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
            'direction' => $request->direction,
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

        return response()->json(['success' => 'Language status updated successfully.']);

        $lang = Language::find(request('id'));
        $lang->status = request('status');
        $lang->save();
    }

    public function singleTranslate(Request $request)
    {
        $code = $request->code;
        $key = $request->key;

        $translatedText = translateIt($key, $code);
        return response()->json($translatedText);
    }
    public function allTranslate()
    {
        $language = Language::findOrFail(request('id'));

        // return $language;

        $tr = new GoogleTranslate($language->code);

        $translations = json_decode(file_get_contents(base_path('resources/lang/' . $language->code . '.json')), true);
        $stringArray = [];
        foreach ($translations as $key => $value) {
            array_push($stringArray, $value);
        }

        $translationString = implode(" ® ", $stringArray);
        $translatedTexts = explode(" ® ", $tr->translate($translationString));

        $newTranslatedTextArray = [];
        $data = array_replace($translations, $translatedTexts);

        $arrayKeys = array_keys($translations);
        return [$arrayKeys, $translatedTexts];
        foreach ($translations as $index => $item) {
            $newTranslatedTextArray[$item] = $translatedTexts[$index];
        }

        return response()->json($newTranslatedTextArray);


        // $code = $request->code;
        // $key = $request->key;

        // $translatedText = translateIt($key, $code);
        // return response()->json($translatedText);
    }
}
