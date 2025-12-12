<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Medication;
use App\Models\Child;

class MedicationController extends Controller
{
    public function create(Request $request)
    {
        $user = Auth::guard('web')->user();

        $data = $request->validate([
            'children_id' => 'required|integer|exists:children,id',
            'medication_name' => 'required|string|max:255',
            'quantity' => 'required|numeric',
            'unit' => 'required|string|max:50',
            'date' => 'required|date',
            'time' => ['required','date_format:H:i'],
            'note' => 'nullable|string',
        ]);

        Child::where('id', $data['children_id'])->where('user_id', $user->id)->firstOrFail();

        $med = Medication::create($data);

        return response()->json(['success' => true, 'medication' => $med], 201);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::guard('web')->user();

        $med = Medication::findOrFail($id);

        if (!$med->child || $med->child->user_id !== $user->id) {
            abort(403);
        }

        $data = $request->validate([
            'medication_name' => 'sometimes|required|string|max:255',
            'quantity' => 'sometimes|nullable|numeric',
            'unit' => 'sometimes|nullable|string|max:50',
            'date' => 'sometimes|required|date',
            'time' => 'sometimes|nullable|string',
            'note' => 'sometimes|nullable|string',
        ]);

        $med->update($data);

        return response()->json(['success' => true, 'medication' => $med]);
    }

    public function delete($id)
    {
        $user = Auth::guard('web')->user();

        $med = Medication::findOrFail($id);

        if (!$med->child || $med->child->user_id !== $user->id) {
            abort(403);
        }

        $med->delete();

        return response()->json(['success' => true]);
    }
}
