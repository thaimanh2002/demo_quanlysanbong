@extends('client.extend')
@section('client_content')
    <main id="main">
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">
                {{ Breadcrumbs::render('client-footballPitch') }}
                <h2>Thông tin đặt sân</h2>
            </div>
        </section><!-- End Breadcrumbs -->
        <section class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="border p-3 mt-4 mt-lg-0 rounded bg-white">
                        <h4 class="header-title mb-3">Thông tin đặt sân
                        </h4>

                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <td>Tên sân :</td>
                                        <td>{{ $order->footballPitch->name }} <span class="text-secondary">|
                                                {{ $order->footballPitch->pitchType->quantity }} người</span></td>
                                    </tr>
                                    <tr>
                                        <td>Mã đặt sân :</td>
                                        <td>{{ $order->code }}</td>
                                    </tr>
                                    <tr>
                                        <td>Người đặt :</td>
                                        <td>{{ $order->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Số điện thoại : </td>
                                        <td>{{ $order->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email : </td>
                                        <td>{{ $order->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Thời gian đặt :</td>
                                        <td>{{ $order->start_at }}</td>
                                    </tr>
                                    <tr>
                                        <td>Thời gian kết thúc : </td>
                                        <td>{{ $order->end_at }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tổng tiền : </th>
                                        <th>{{ $order->total() }}</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                    <div class="alert alert-info mt-2">
                        <i class="bi bi-info-circle"></i>
                        Nếu sau khi chuyển khoản thành công quá 5 phút mà vẫn chưa được thông báo đặt sân thành công.
                         Vui lòng liên hệ số điện thoại bên dưới
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="border p-3 mt-4 mt-lg-0 rounded bg-white">
                        <h4 class="header-title mb-3">Thông tin chuyển khoản
                        </h4>

                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <td>Số tiền :</td>
                                        <td>{{ $order->deposit() }} - {{ $order->total() }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nội dung :</td>
                                        <td>tien coc {{ $order->id }}</td>
                                    </tr>
                                    @foreach ($bankInfo as $item)
                                        <tr>
                                            <td>Tên chủ thẻ :</td>
                                            <td>{{ $item->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Số tài khoản :</td>
                                            <td>{{ $item->bank_number }}</td>
                                        </tr>
                                        <tr>
                                            <td>Ngân hàng :</td>
                                            <td>{{ $item->bank }}</td>
                                        </tr>
                                        @if ($item->image)
                                            <tr align="center">
                                                <td colspan="2"><img src="{{ config('app.image') . $item->image }}"
                                                        width="300" class="img-fluid" alt=""></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->
    <script>
        document.querySelector('#header').classList.add('header-inner-pages');
    </script>
@endsection
