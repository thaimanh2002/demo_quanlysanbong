@extends('client.extend')
@section('client_content')
    <main id="main">
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">
                {{ Breadcrumbs::render('client-register') }}
            </div>
        </section><!-- End Breadcrumbs -->
        <section class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            @include('client.layouts.alert')
                            <div class="card-title auth-title">Đăng ký</div>
                            <form method="post" action="{{ route('client.processRegister') }}">
                                @csrf
                                <div class="form-group mb-3">
                                    <label class="form-label">Họ và tên <span class="text-danger">*</span></label>
                                    <input value="{{ old('name') }}" name="name" type="text" placeholder="trinh xuan son" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                                    <input value="{{ old('phone') }}" name="phone" type="number" placeholder="0372238783" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Địa chỉ email <span class="text-danger">*</span></label>
                                    <input value="{{ old('email') }}" name="email" type="email" placeholder="test@123@gmail.com" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Mật khẩu <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input id="password" name="password" type="password" class="form-control">
                                        <span class="input-group-text">
                                            <i class="bi bi-eye-slash-fill hide-password"></i>
                                            <i class="bi bi-eye-fill show-password" style="display: none"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-md-12 text-center">
                                        <button class="btn btn-success btn-block">Đăng ký</button>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <p>Nếu đã có tài khoản  <a href="{{ route('client.login') }}">đăng nhập ngay</a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->
    <script>
        const hide_password = document.querySelector('.hide-password');
        const show_password = document.querySelector('.show-password');
        const password = document.querySelector('#password');
        document.querySelector('#header').classList.add('header-inner-pages');
        hide_password.addEventListener('click', function() {
            this.style.display = 'none';
            show_password.style.display = 'block';
            password.type = 'text';
        });
        show_password.addEventListener('click', function() {
            this.style.display = 'none';
            hide_password.style.display = 'block';
            password.type = 'password';
        });
    </script>
@endsection
