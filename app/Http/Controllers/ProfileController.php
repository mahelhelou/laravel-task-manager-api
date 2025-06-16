<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = Profile::all();
        return response()->json($profiles, 200);
    }

    public function store(StoreProfileRequest $request)
    {
        $profile = Profile::create($request->validated());
        return response()->json($profile, 201);
    }

    public function show(string $id)
    {
        // $profile = Profile::findOrFail($id);
        $profile = Profile::where('user_id', $id)->firstOrFail();
        return response()->json($profile, 200);
    }

    public function update(UpdateProfileRequest $request, string $id)
    {
        $profile = Profile::findOrFail($id);
        $profile->update($request->validated());

        return response()->json($profile, 200);
    }

    public function destroy(string $id)
    {
        $profile = Profile::findOrFail($id);
        $profile->delete();

        return response()->json($profile, 200);
    }
}
