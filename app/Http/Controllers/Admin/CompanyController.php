<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Company;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\CompanyCreateRequest;
use App\Http\Requests\CompanyUpdateRequest;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = request('search') ?? '';
        $country = request('country') ?? '';

        $companies = User::query()
            ->where('role', 'company')
            ->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%');
            })
            ->when($country, function ($query, $country) {
                $query->whereHas('company', function ($query) use ($country) {
                    $query->where('country_id', $country);
                });
            })
            ->with('company.country')
            ->latest()
            ->paginate(10)
            ->withQueryString()
            ->through(fn ($user) => [
                'id' => $user->id,
                'name' => $search ? preg_replace('/(' . $search . ')/i', "<b class='bg-warning'>$1</b>", $user->name) : $user->name,
                'email' => $search ? preg_replace('/(' . $search . ')/i', "<b class='bg-warning'>$1</b>", $user->email) : $user->email,
                'avatar' => $user->avatar,
                'country' => $user->company->country->name ?? '',
            ]);

        $countries = Country::all(['id', 'name', 'slug']);

        return inertia('admin/company/index', [
            'companies' => $companies,
            'countries' => $countries,
            'filters' => [
                'search' => $search,
                'country' => $country ?? '',
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all(['id', 'name']);

        return inertia('admin/company/create', [
            'countries' => $countries,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyCreateRequest $request)
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

        $user = User::create($data);

        $user->company()->create([
            'country_id' => $request->country,
        ]);

        session()->flash('success', 'Company created successfully!');
        return redirect()->route('companies.index');
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
    public function edit(User $company)
    {
        $user = $company;
        $countries = Country::all(['id', 'name']);

        return inertia('admin/company/edit', [
            'user' => $user,
            'country_id' => $user->company->country_id,
            'countries' => $countries,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyUpdateRequest $request, User $company)
    {
        $user = $company;

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

        $user->company()->update([
            'country_id' => $request->country,
        ]);

        session()->flash('success', 'Company updated successfully!');
        return redirect()->route('companies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $company)
    {
        $company->delete();

        session()->flash('success', 'Company deleted successfully!');
        return back();
    }

    public function companiesTeams(Company $company)
    {
        $teams = $company->teams;

        return response()->json([
            'success' => true,
            'teams' => $teams,
        ]);
    }

    public function companiesLeaveTypes(User $user)
    {
        $leaveTypes = $user->company->leaveTypes;

        return response()->json([
            'success' => true,
            'leaveTypes' => $leaveTypes,
        ]);
    }

    public function companiesEmployees(User $user)
    {
        $employeesUsers = $user->company->employees->load('user');

        return response()->json([
            'success' => true,
            'employeesUsers' => $employeesUsers,
        ]);
    }
}
