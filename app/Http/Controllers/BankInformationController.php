<?php

namespace App\Http\Controllers;

use App\Models\BankInformation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class BankInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $banks = BankInformation::all();
        return response()->json([
            'data' => $banks,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'bank_number' => 'required|string',
            'bank' => 'required|string',
            'note' => 'nullable|string',
            'image' => 'nullable|image',
        ]);
        $arr = [
            'name' => $validated['name'],
            'bank_number' => $validated['bank_number'],
            'bank' => $validated['bank'],
            'note' => $validated['note'],
        ];
        if ($request->hasFile('image')) {
            $file_name = 'bank_info' . time() . '.' .  $request->file('image')->extension();
            $file = $request->file('image')->storeAs('images/bank', $file_name, 'public');
            $arr['image'] = $file;
        }
        BankInformation::create($arr);
        return response()->json([
            'status' => 'success',
            'message' => 'Thêm thông tin ngân hàng thành công',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $obj = BankInformation::find($id);
        if ($obj) {
            return response()->json($obj);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Không tìm thấy thông tin ngân hàng'
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'bank_number' => 'required|string',
            'bank' => 'required|string',
            'note' => 'nullable|string',
            'image' => 'nullable|image',
        ]);
        $obj = BankInformation::find($id);
        if ($obj) {
            $arr = [
                'name' => $validated['name'],
                'bank_number' => $validated['bank_number'],
                'bank' => $validated['bank'],
                'note' => $validated['note'],
            ];
            if ($obj->image) {
                Storage::disk('public')->delete($obj->image);
            }
            if ($request->hasFile('image')) {
                $file_name = 'bank_info' . time() . '.' .  $request->file('image')->extension();
                $file = $request->file('image')->storeAs('images/bank', $file_name, 'public');
                $arr['image'] = $file;
            }
            $obj->update($arr);
            return response()->json([
                'status' => 'success',
                'message' => 'Cập nhật thông tin ngân hàng thành công'
            ]);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Không tìm thấy thông tin ngân hàng'
        ], Response::HTTP_NOT_FOUND);
    }

    public function change_display(Request $request, string $id)
    {
        $validated = $request->validate([
           'isShow' => 'required|in:0,1', 
        ]);
        $bank = BankInformation::find($id);
        $bank->isShow = $validated['isShow'];
        $bank->save();
        $message = $validated['isShow'] ? 'Hiển thị' : 'Ẩn';
        return response()->json([
            'status' => 'success',
            'message' => $message . ' thông tin ngân hàng thành công',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $obj = BankInformation::find($id);
        if ($obj) {
            if ($obj->image) {
                Storage::disk('public')->delete($obj->image);
            }
            $obj->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Xóa thông tin ngân hàng thành công',
            ]);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Không tìm thấy thông tin ngân hàng'
        ], Response::HTTP_NOT_FOUND);
    }
}
