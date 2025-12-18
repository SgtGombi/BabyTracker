<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Child;

class ChildController extends Controller
{
    public function create(Request $request)
    {
        $user = Auth::guard('web')->user();

        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'age_months' => 'nullable|integer|min:0',
            'gender' => 'nullable|in:boy,girl',
            'height' => 'nullable|integer|min:0',
            'weight' => 'nullable|numeric',
            'note' => 'nullable|string',
        ]);

        $data['user_id'] = $user->id;

        $child = Child::create($data);

        return response()->json(['success' => true, 'child' => $child], 201);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::guard('web')->user();

        $child = Child::where('id', $id)->where('user_id', $user->id)->firstOrFail();

        $data = $request->validate([
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|nullable|string|max:255',
            'nickname' => 'sometimes|nullable|string|max:255',
            'age_months' => 'sometimes|nullable|integer|min:0',
            'gender' => 'sometimes|nullable|in:boy,girl',
            'height' => 'sometimes|nullable|integer|min:0',
            'weight' => 'sometimes|nullable|numeric',
            'note' => 'sometimes|nullable|string',
        ]);

        $child->update($data);

        return response()->json(['success' => true, 'child' => $child]);
    }

    public function delete($id)
    {
        $user = Auth::guard('web')->user();

        $child = Child::where('id', $id)->where('user_id', $user->id)->firstOrFail();

        $child->delete();

        return response()->json(['success' => true]);
    }
}
