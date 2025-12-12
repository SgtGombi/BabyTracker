<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Sleep;
use App\Models\Child;

class SleepController extends Controller
{
    public function create(Request $request)
    {
        $user = Auth::guard('web')->user();

        $data = $request->validate([
            'children_id' => 'required|integer|exists:children,id',
            'date_from' => 'required|date',
            'date_to' => 'required|date|after_or_equal:date_from',
            'note' => 'nullable|string',
        ]);

        Child::where('id', $data['children_id'])->where('user_id', $user->id)->firstOrFail();

        $sleep = Sleep::create($data);

        return response()->json(['success' => true, 'sleep' => $sleep], 201);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::guard('web')->user();

        $sleep = Sleep::findOrFail($id);

        if (!$sleep->child || $sleep->child->user_id !== $user->id) {
            abort(403);
        }

        $data = $request->validate([
            'date_from' => 'sometimes|required|date',
            'date_to' => 'sometimes|nullable|date|after_or_equal:date_from',
            'note' => 'sometimes|nullable|string',
        ]);

        $sleep->update($data);

        return response()->json(['success' => true, 'sleep' => $sleep]);
    }

    public function delete($id)
    {
        $user = Auth::guard('web')->user();

        $sleep = Sleep::findOrFail($id);

        if (!$sleep->child || $sleep->child->user_id !== $user->id) {
            abort(403);
        }

        $sleep->delete();

        return response()->json(['success' => true]);
    }
}
