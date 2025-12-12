<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Diaper;
use App\Models\Child;

class DiaperController extends Controller
{
    public function create(Request $request)
    {
        $user = Auth::guard('web')->user();

        $data = $request->validate([
            'children_id' => 'required|integer|exists:children,id',
            'date' => 'required|date',
            'time' => ['required','date_format:H:i'],
            'diaper_type' => 'required|in:pepee,popoo',
            'note' => 'nullable|string',
        ]);

        // ownership check
        Child::where('id', $data['children_id'])->where('user_id', $user->id)->firstOrFail();

        $diaper = Diaper::create($data);

        return response()->json(['success' => true, 'diaper' => $diaper], 201);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::guard('web')->user();

        $diaper = Diaper::findOrFail($id);

        // ensure the diaper belongs to one of the user's children
        if (!$diaper->child || $diaper->child->user_id !== $user->id) {
            abort(403);
        }

        $data = $request->validate([
            'date' => 'sometimes|required|date',
            'time' => 'sometimes|nullable|string',
            'diaper_type' => 'sometimes|nullable|string|max:255',
        ]);

        $diaper->update($data);

        return response()->json(['success' => true, 'diaper' => $diaper]);
    }

    public function delete($id)
    {
        $user = Auth::guard('web')->user();

        $diaper = Diaper::findOrFail($id);

        if (!$diaper->child || $diaper->child->user_id !== $user->id) {
            abort(403);
        }

        $diaper->delete();

        return response()->json(['success' => true]);
    }
}
