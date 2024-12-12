<!doctype html>
<html lang="en">

<head>
    @include('backend.layout_admin.headonly')
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src="/backend/assets/images/logos/dark-logo.svg" width="180" alt="">
                                </a>
                                <p class="text-center">Admin</p>
                                <form method="POST" action="{{ route('admin.handle_forgot_password') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror" id="email"
                                            aria-describedby="emailHelp" value="{{ old('email') }}"
                                            placeholder="Enter email">
                                        @error('email')
                                            <div class="message-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2"><i
                                            class="fas fa-paper-plane me-2"></i>Send</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.layout_admin.script')
</body>

</html>
