<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Meal;
use App\Models\Child;

class MealController extends Controller
{
    public function create(Request $request)
    {
        $user = Auth::guard('web')->user();

        $data = $request->validate([
            'children_id' => 'required|integer|exists:children,id',
            'date' => 'required|date',
            'time' => ['required','date_format:H:i'],
            'meal_type' => 'required|in:drink,food',
            'meal_name' => 'required|string|max:255',
            'meal_quantity' => 'nullable|numeric',
            'meal_unit' => 'nullable|string|max:50',
            'note' => 'nullable|string',
        ]);

        Child::where('id', $data['children_id'])->where('user_id', $user->id)->firstOrFail();

        $meal = Meal::create($data);

        return response()->json(['success' => true, 'meal' => $meal], 201);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::guard('web')->user();

        $meal = Meal::findOrFail($id);

        if (!$meal->child || $meal->child->user_id !== $user->id) {
            abort(403);
        }

        $data = $request->validate([
            'date' => 'sometimes|required|date',
            'time' => 'sometimes|nullable|string',
            'meal_type' => 'sometimes|nullable|string|max:255',
            'meal_name' => 'sometimes|nullable|string|max:255',
            'meal_quantity' => 'sometimes|nullable|numeric',
            'meal_unit' => 'sometimes|nullable|string|max:50',
        ]);

        $meal->update($data);

        return response()->json(['success' => true, 'meal' => $meal]);
    }

    public function delete($id)
    {
        $user = Auth::guard('web')->user();

        $meal = Meal::findOrFail($id);

        if (!$meal->child || $meal->child->user_id !== $user->id) {
            abort(403);
        }

        $meal->delete();

        return response()->json(['success' => true]);
    }
}
