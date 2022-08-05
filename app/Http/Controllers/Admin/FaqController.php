<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::all();

        return inertia('admin/others/faq', [
            'faqs' => $faqs,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        Faq::create($request->all());

        session()->flash('success', 'Faq created successfully!');
        return back();
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        $faq->update($request->all());

        session()->flash('success', 'Faq updated successfully!');
        return back();
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        session()->flash('success', 'Faq deleted successfully!');
        return back();
    }
}
