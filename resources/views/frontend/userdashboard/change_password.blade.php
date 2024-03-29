@extends('frontend.layouts.auth_master')
@section('auth_title')
    User Change Password
@endsection
@section('auth_content')
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('dashboard') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Change Password
            </div>
        </div>
    </div>
    <div class="page-content pt-50 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 m-auto">
                    <div class="row">
                        @include('frontend.layouts.dashboard_sidebar_menu')

                        <div class="col-md-9">
                            <div class="tab-content account dashboard-content pl-50">
                                <div class="tab-pane fade active show" id="dashboard" role="tabpanel"
                                    aria-labelledby="dashboard-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Change Password</h5>
                                        </div>
                                        <div class="card-body">
                                            <form method="post" action="{{ route('user.update.password') }}">
                                                @csrf
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label>Current Password <span class="required">*</span></label>
                                                        <input type="password" name="current_password" id="current_password"
                                                            class="form-control @error('current_password') is-invalid @enderror"
                                                            placeholder="enter your password">
                                                        @error('current_password')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>New Password <span class="required">*</span></label>
                                                        <input type="password" name="new_password" id="new_password"
                                                            class="form-control @error('new_password') is-invalid @enderror"
                                                            placeholder="enter new password">
                                                        @error('new_password')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Confirm Password <span class="required">*</span></label>
                                                        <input type="password" name="new_password_confirmation"
                                                            id="new_password_confirmation" class="form-control"
                                                            placeholder="confirm password">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="submit"
                                                            class="btn btn-fill-out submit font-weight-bold">Save
                                                            Change</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('user_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
