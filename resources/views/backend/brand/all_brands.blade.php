@extends('backend.admin.dashboard')
@section('admin_title')
    Admin - brands list
@endsection
@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Brand</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Brand</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.add.brand') }}" class="btn btn-primary btn-sm">Add Brand</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example" class="table table-striped table-bordered dataTable" style="width: 100%;"
                                role="grid" aria-describedby="example_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1"
                                            colspan="1" aria-sort="ascending"
                                            aria-label="Name: activate to sort column descending" style="width: 10%">SL</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                            colspan="1" aria-label="Position: activate to sort column ascending"
                                            style="width: 30%;">Brand Name</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                            colspan="1" aria-label="Office: activate to sort column ascending"
                                            style="width: 30%">Image</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                            colspan="1" aria-label="Age: activate to sort column ascending"
                                            style="width: 30%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($brands as $brand)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1">{{ $i++ }}</td>
                                            <td>{{ $brand->brand_name }}</td>
                                            <td>
                                                @if (!empty($brand->image))
                                                    <img src="{{ asset('upload/brand_images/' . $brand->image) }}"
                                                        class="rounded-circle" alt="Brand" width="50">
                                                @else
                                                    <img src="{{ asset('backend/assets/images/websiteplanet-dummy-250X250.png') }}"
                                                        class="rounded-circle" alt="Brand" width="50">
                                                @endif
                                            </td>
                                            <td>
                                                @if (Auth::user()->can('brand.edit'))
                                                    <a href="{{ route('admin.edit.brand', $brand->id) }}"
                                                        class="btn btn-info btn-sm">Edit</a>
                                                @endif
                                                @if (Auth::user()->can('brand.delete'))
                                                    <a href="{{ route('admin.delete.brand', $brand->id) }}"
                                                        class="btn btn-danger btn-sm" id="delete">Delete</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
