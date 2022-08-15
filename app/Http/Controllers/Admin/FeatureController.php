<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    public function index()
    {
        $features = Feature::latest()->paginate(10);

        return inertia('admin/others/features', compact('features'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        Feature::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        session()->flash('success', 'Feature created successfully!');
        return back();
    }

    public function update(Request $request, Feature $feature)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $feature->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        session()->flash('success', 'Feature updated successfully!');
        return back();
    }

    public function destroy(Feature $feature)
    {
        $feature->delete();

        session()->flash('success', 'Feature deleted successfully!');
        return back();
    }
}
