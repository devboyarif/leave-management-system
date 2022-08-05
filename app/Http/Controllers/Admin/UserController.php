<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\ProfileUpdateRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = request('search') ?? '';

        $admins = User::query()
            ->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%');
            })
            ->where('role', 'admin')
            ->latest()
            ->paginate(10)
            ->withQueryString()
            ->through(fn ($user) => [
                'id' => $user->id,
                'name' => $search ? preg_replace('/(' . $search . ')/i', "<b class='bg-warning'>$1</b>", $user->name) : $user->name,
                'email' => $search ? preg_replace('/(' . $search . ')/i', "<b class='bg-warning'>$1</b>", $user->email) : $user->email,
                'avatar' => $user->avatar,
            ]);

        return inertia('admin/user/index', [
            'admins' => $admins,
            'filters' => request()->only('search'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return inertia('admin/user/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $request->validate([
                'avatar' => ['image', 'mimes:jpeg,png,jpg'],
            ]);
            $url = uploadFileToPublic('avatars', $request->avatar);
            $data['avatar'] = $url;
        }

        User::create($data);

        session()->flash('success', 'User created successfully!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $admin)
    {
        $user = $admin;
        return inertia('admin/user/edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $admin)
    {
        $user = $admin;
        $data = $request->all();
        if ($request->password) {
            $data['password'] = bcrypt($data['password']);
        }

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $request->validate([
                'avatar' => ['image', 'mimes:jpeg,png,jpg'],
            ]);
            $url = uploadFileToPublic('avatars', $request->avatar);
            $data['avatar'] = $url;
        }

        $user->update($data);

        session()->flash('success', 'User updated successfully!');
        return redirect()->route('admins.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        session()->flash('success', 'User deleted successfully!');
        return back();
    }

    public function profile()
    {
        return inertia('admin/user/profile', [
            'user' => auth()->user(),
        ]);
    }

    public function profileUpdate(ProfileUpdateRequest $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => "required|string|email|max:255|unique:users,email, $user->id",
        ]);

        $data = $request->all();

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $request->validate([
                'avatar' => ['image', 'mimes:jpeg,png,jpg'],
            ]);
            $url = uploadFileToPublic('avatars', $request->avatar);
            $data['avatar'] = $url;
        }

        $user->update($data);

        session()->flash('success', 'Profile updated successfully!');
        return back();
    }

    public function passwordUpdate(ProfileUpdateRequest $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'password' => ['required'],
            'password_confirmation' => ['required', 'same:password'],
        ]);

        auth()->user()->update([
            'password' => bcrypt($request->password),
        ]);

        session()->flash('success', 'Password changed successfully!');
        return back();
    }
}
