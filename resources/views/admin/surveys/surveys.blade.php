@extends('layouts.master')

@section('content')
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
                        <th>Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($surveys as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->status }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        pilih Aksi
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><button class="dropdown-item btn-edit">Edit</button></li>
                                        <li><button class="dropdown-item btn-delete">Hapus</button></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-muted">Data Belum Tersedia</td>
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
            <form id="formCreate">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-12">
                                <label for="basicInput" class="form-label">Nama</label>
                                <input type="text" placeholder="Inputkan nama" class="form-control" name="title"
                                    id="name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="disableInput" class="form-label">Deskripsi</label>
                                <textarea type="text" placeholder="Masukan Deskripsi" class="form-control" name="description"></textarea>
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