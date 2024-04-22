@extends('backend.admin.dashboard')
@section('admin_title')
    Admin - Add Permission
@endsection
@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Add Permission</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add Permission</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.all.permission') }}" class="btn btn-danger btn-sm">Back</a>
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
                            <form action="{{ route('admin.store.permission') }}" method="post">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Permission Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Enter Permission Name">
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Group Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <select class="form-select mb-3" name="group_name"
                                            aria-label="Default select example">
                                            <option selected="">Open this select group</option>
                                            <option value="admin">Admin</option>
                                            <option value="ads">Ads</option>
                                            <option value="area">Area</option>
                                            <option value="brand">Brand</option>
                                            <option value="blog">Blog</option>
                                            <option value="category">Category</option>
                                            <option value="coupon">Coupon</option>
                                            <option value="order">Order</option>
                                            <option value="product">Product</option>
                                            <option value="role">Role</option>
                                            <option value="review">Review</option>
                                            <option value="report">Report</option>
                                            <option value="return">Return</option>
                                            <option value="subcategory">Subcategory</option>
                                            <option value="slider">Slider</option>
                                            <option value="setting">Setting</option>
                                            <option value="stock">Stock</option>
                                            <option value="user">User Management</option>
                                            <option value="vendor">Vendor</option>
                                        </select>
                                        @error('group_name')
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
