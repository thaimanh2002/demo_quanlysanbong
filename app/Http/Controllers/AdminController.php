<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatusEnum;
use App\Models\FootballPitch;
use App\Models\FootballPitchDetail;
use App\Models\Order;
use App\Models\PitchType;
use Carbon\Carbon;

class AdminController extends Controller
{
    //Trang chu
    public function dashboard()
    {
        $title = 'Dashboard';
        return view('admin.dashboard.index', [
            'title' => $title,
        ]);
    }
    //The loai san bong
    public function pitchType()
    {
        $title = 'Pitch Type';
        $pitchTypes = PitchType::query()->orderByDesc('id')->get();
        return view('admin.pitch_type.index', [
            'title' => $title,
            'pitchTypes' => $pitchTypes,
        ]);
    }
    //San bong
    public function footballPitch()
    {
        $title = 'Football Pitch';
        $footballPitches = FootballPitch::query()->orderByDesc('id')->with('pitchType')->get();
        $pitchTypes = PitchType::all();
        return view('admin.football_pitch.index', [
            'title' => $title,
            'footballPitches' => $footballPitches,
            'pitchTypes' => $pitchTypes,
        ]);
    }
    //Chi tiet san bong
    public function footballPitchDetail(string $id)
    {
        $title = 'Football Pitch Detail';
        $footballPitchDetails = FootballPitchDetail::query()->where('football_pitch_id', '=', $id)->get();
        $footballPitch = FootballPitch::query()->with('pitchType')
            ->with('toFootballPitch')
            ->with('fromFootballPitch')->find($id);
        $pitchTypes = PitchType::all();
        $footballPitches = FootballPitch::query()->orderByDesc('id')->get([
            'id',
            'name',
            'to_football_pitch_id',
            'from_football_pitch_id',
        ]);
        return view('admin.football_pitch.detail', [
            'title' => $title,
            'footballPitchDetails' => $footballPitchDetails,
            'footballPitch' => $footballPitch,
            'pitchTypes' => $pitchTypes,
            'footballPitches' => $footballPitches,
        ]);
    }
    //yeu cau lich
    public function orderCalendar()
    {
        $title = 'Order';
        $footballPitches = FootballPitch::query()->where('is_maintenance', 0)->with('pitchType')->get([
            'id',
            'name',
            'pitch_type_id',
        ]);
        return view('admin.order.calendar', [
            'title' => $title,
            'footballPitches' => $footballPitches,
        ]);
    }
    //yeu cau bang
    public function orderTable()
    {
        $title = 'Order';
        return view('admin.order.table', [
            'title' => $title,
        ]);
    }
    //thanh toan
    public function checkout(string $id)
    {
        $order = Order::query()->with('footballPitch')->find($id);
        if (!$order) {
            abort(404); 
        }
        $arr = [];
        $isCheckout = ($order->status == OrderStatusEnum::Paid) ? true : false;
        if ($isCheckout) {
            $arr['status'] = 'success';
            $arr['message'] = 'Đã thanh toán';
        }
        else {
            $arr['status'] = 'danger';
            $arr['message'] = 'Chưa thanh toán';
        }
        //dd($order->status);
        $title = "Checkout";
        return view('admin.order.checkout', [
            'title' => $title,
            'order' => $order,
            'arr' => $arr,
            'isCheckout' => $isCheckout,
        ]);
    }
    //thong tin ngan hang
    public function bankInformation()
    {
        $title = 'Bank information';
        return view('admin.bank_info.index', [
            'title' => $title,
        ]);
    }
}
