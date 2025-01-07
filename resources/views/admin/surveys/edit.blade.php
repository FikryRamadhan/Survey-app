@extends('layouts.master')

@section('content')
    <div class="col-lg-6 card">
        <div class="card-header mt-1">
            Edit Data {{ $survey->title }}
            <div class="float-end">
                <a class="btn btn-sm btn-primary" href="{{ route('admin.layanan') }}">Back</a>
            </div>
        </div>
        <hr>
        <div class="card-body">
            <form action="{{ route('admin.layanan.update', $survey->id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="basicInput" class="form-label">Title</label>
                        <input type="text" placeholder="Inputkan nama" class="form-control" name="title" id="name"
                            value="{{ $survey->title }}">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="disableInput" class="form-label">Deskripsi</label>
                        <textarea type="text" placeholder="Masukan Deskripsi" class="form-control" name="description">{{ $survey ? $survey->description : '' }}</textarea>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option disabled selected>Pilih Status</option>
                            <option value="active">Active</option>
                            <option value="noActive">No Active</option>
                        </select>
                    </div>
                </div>

                <hr>

                <button class="btn btn-primary" type="submit">Save</button>
            </form>
        </div>
    </div>
    </div>
@endsection
