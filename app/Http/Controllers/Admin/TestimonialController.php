<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::all();

        return inertia('admin/others/testimonial', [
            'testimonials' => $testimonials,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'description' => 'required',
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data['name'] = $request->name;
        $data['position'] = $request->position;
        $data['description'] = $request->description;

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $request->validate([
                'avatar' => ['image', 'mimes:jpeg,png,jpg'],
            ]);
            $url = uploadFileToPublic('avatars', $request->avatar);
            $data['avatar'] = $url;
        }
        Testimonial::create($data);

        session()->flash('success', 'Testimonial created successfully!');
        return back();
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'description' => 'required',
        ]);

        $data['name'] = $request->name;
        $data['position'] = $request->position;
        $data['description'] = $request->description;

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {

            $url = uploadFileToPublic('avatars', $request->avatar);
            $data['avatar'] = $url;
        }
        $testimonial->update($data);

        session()->flash('success', 'Testimonial updated successfully!');
        return back();
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        session()->flash('success', 'Testimonial deleted successfully!');
        return back();
    }
}
