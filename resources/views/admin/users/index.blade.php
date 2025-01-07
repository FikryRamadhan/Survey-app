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
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{!! $item->email !!}</td>
                                <td>{!! $item->role !!}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                                            id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            pilih Aksi
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li>
                                                <form id="delete-form" action="{{ route('admin.user.delete', $item->id) }}" method="POST" style="display: none;">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                                <button class="dropdown-item btn-delete" data-id="{{ $item->id }}">Hapus</button>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
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
                <form action="{{ route('admin.user.create') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-12">
                                    <label for="basicInput" class="form-label">Nama</label>
                                    <input type="text" placeholder="Inputkan nama" class="form-control" name="name"
                                        id="name">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="disableInput" class="form-label">Email</label>
                                    <input type="email" placeholder="Masukan Deskripsi" class="form-control"
                                        name="email" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="disableInput" class="form-label">Password</label>
                                    <input type="password" placeholder="Masukan Deskripsi" class="form-control"
                                        name="password" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="disableInput" class="form-label">Konfirmasi Password</label>
                                    <input type="password" placeholder="Masukan Deskripsi" class="form-control"
                                        name="password_confirmation" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="disableInput" class="form-label">Konfirmasi Password</label>
                                    <select class="form-control" name="role">
                                        <option selected disabled>-- Pilih Role --</option>
                                        <option value="admin">Admin</option>
                                        <option value="users">User</option>
                                    </select>
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

        $(document).ready(function () {
            $('.btn-delete').on('click', function (e) {
                e.preventDefault();

                let id = $(this).data('id'); // ID data
                let form = $('#delete-form'); // Form penghapusan
                let action = "{{ route('admin.user.delete', ':id') }}".replace(':id', id);
                form.attr('action', action);

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini tidak dapat dikembalikan setelah dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Kirim form jika dikonfirmasi
                    }
                });
            });
        });
    </script>
@endsection
