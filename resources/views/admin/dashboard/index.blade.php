@extends('layouts.master')

@section('content')
    <div class="title">
        Hallo {{ auth()->user()->name }}
    </div>
    <div class="content-wrapper">
        <div class="row same-height">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body mt-2">
                        <div class="row">
                            <div class="col-5">
                                <div class="text-center">
                                    <h1> <i class="ti ti-id-badge text-primary"></i></h1>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category"> Total Layanan </p>
                                    <h4 class="card-title">{{ App\Models\Survey::count() }} </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body mt-2">
                        <div class="row">
                            <div class="col-5">
                                <div class="text-center">
                                    <h1> <i class="ti ti-id-badge text-primary"></i></h1>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category"> Total Pengajuan </p>
                                    <h4 class="card-title">{{ App\Models\Survey::count() }} </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body mt-2">
                        <div class="row">
                            <div class="col-5">
                                <div class="text-center">
                                    <h1> <i class="ti ti-id-badge text-primary"></i></h1>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category"> Total Pengajuan </p>
                                    <h4 class="card-title">{{ App\Models\FillSurveys::count() }} </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
