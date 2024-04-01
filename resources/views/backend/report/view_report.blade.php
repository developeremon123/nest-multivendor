@extends('backend.admin.dashboard')
@section('admin_title')
    View Report
@endsection
@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Ecommerce Report</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Ecommerce Report</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr>
    <div class="row row-cols-1 row-cols-md-1 row-cols-lg-3 row-cols-xl-3">
        <form action="" method="post">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Search By Date</h5>
                        <label for="" class="form-label">Date:</label>
                        <input type="date" name="date" id="" class="form-control">
                        <br>
                        <button type="submit" class="btn btn-rounded btn-primary">Search</button>
                    </div>
                </div>
            </div>
        </form>
        <form action="" method="post">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Search By Month/Year</h5>
                        <label for="" class="form-label">Select Month:</label>
                        <select name="month" class="form-select mb-3" aria-label="Default select example">
                            <option selected="">Open this select menu</option>
                            <option value="Janurary">Janurary</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                        </select>
                        <label for="" class="form-label">Select Year:</label>
                        <select name="year_name" class="form-select mb-3" aria-label="Default select example">
                            <option selected="">Open this select menu</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                        </select> <br>
                        <button type="submit" class="btn btn-rounded btn-primary">Search</button>
                    </div>
                </div>
            </div>
        </form>
        <form action="" method="post">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Search By Year</h5>
                        <label for="" class="form-label">Select Year:</label>
                        <select name="year" class="form-select mb-3" aria-label="Default select example">
                            <option selected="">Open this select menu</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                        </select> <br>
                        <button type="submit" class="btn btn-rounded btn-primary">Search</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
