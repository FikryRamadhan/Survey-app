@extends('layouts.master')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="col-lg-12 card">
        <div class="card-header mt-1">
            Data kategori Materi
            <div class="float-end">
                <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal"
                    data-bs-target="#createModal">Tambah +</button>
            </div>
        </div>
        <hr>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Layanan</th>
                            <th>Pertanyaan</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->survey_title }}</td>
                                <td>{!! $item->questions !!}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-muted">Data tidak tersedia.</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.question.create') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-12">
                                    <label for="basicInput" class="form-label">Nama</label>
                                    <select class="form-control" name="survey_id" id="name">
                                        <option selected disabled>-- pilih layanan --</option>
                                        @forelse ($survey as $item)
                                            <option value="{{ $item->id }}">{{ $item->title }}</option>
                                        @empty
                                            <option disabled>Belum ada data layanan</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="disableInput" class="form-label">Pertanyaan</label>
                                    <textarea type="text" placeholder="Masukan pertanyaan" class="form-control" name="question"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#dataTable').DataTable({
            processing: true,
            autoWidth: true
        })
    </script>
@endsection
