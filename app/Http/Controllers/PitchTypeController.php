<?php

namespace App\Http\Controllers;

use App\Events\PitchTypeChangeEvent;
use App\Models\PitchType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PitchTypeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'quantity' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        PitchType::create($validated);
        return to_route('admin.pitchType')->with('message', 'Thêm loại sân thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        return Response(PitchType::find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'quantity' => 'required|numeric',
            'description' => 'nullable|string',
        ]);
        $pitchType = PitchType::find($id);
        $pitchType->update($validated);
        event(new PitchTypeChangeEvent($pitchType, 'pitchType-updated'));
        return to_route('admin.pitchType')->with('message', 'Cập nhật loại sân thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $pitchType = PitchType::find($id);
        $pitchType->delete();
        return to_route('admin.pitchType')->with('message', 'Xóa loại sân thành công');
    }
}
