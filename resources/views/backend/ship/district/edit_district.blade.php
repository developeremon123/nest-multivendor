@extends('backend.admin.dashboard')
@section('admin_title')
    Admin - Update District
@endsection
@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Update District</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Update District</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.all.district') }}" class="btn btn-danger btn-sm">Back</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.update.district', $district->id) }}" id="myForm"
                                method="post">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Division</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <select name="division_id" id="division_id"
                                            class="form-control @error('division_id') is-invalid @enderror">
                                            <option value="">Select Division</option>
                                            @foreach ($divisions as $division)
                                                <option value="{{ $division->id }}"
                                                    @if ($division->id == $district->division_id) selected @endif>
                                                    {{ $division->division_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">District Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text"
                                            class="form-control @error('district_name') is-invalid @enderror"
                                            name="district_name" id="district_name" placeholder="Enter District Name"
                                            value="{{ $district->district_name }}">
                                        @error('district_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <button type="submit" class="btn btn-success px-4">Save Changes</button>
                                        <button type="reset" class="btn btn-danger px-4">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('admin_scripts')
    <script>
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    division_id: {
                        required: true,
                    },
                    district_name: {
                        required: true,
                    },
                },
                messages: {
                    division_id: {
                        required: 'Please Select Division',
                    },
                    district_name: {
                        required: 'Please Enter District Name',
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
@endpush
