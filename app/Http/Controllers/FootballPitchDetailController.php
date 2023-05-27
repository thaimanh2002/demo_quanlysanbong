<?php

namespace App\Http\Controllers;

use App\Models\FootballPitchDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FootballPitchDetailController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
            'football_pitch_id' => 'required|exists:football_pitches,id',
        ]);
        $name = 'football_pitch' . time() . '.' . $request->file('image')->extension();
        $file_name = $request->file('image')->storeAs('images/football_pitches', $name ,  'public');
        FootballPitchDetail::query()->create([
            'image' => $file_name,
            'football_pitch_id' => $request->input('football_pitch_id'),
        ]);
        return redirect()->back()->with('message', 'Thêm ảnh thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $obj = FootballPitchDetail::find($id);
        Storage::disk('public')->delete($obj->image);
        $obj->delete();
        return redirect()->back()->with('message', 'Xóa ảnh thành công');
    }
}
