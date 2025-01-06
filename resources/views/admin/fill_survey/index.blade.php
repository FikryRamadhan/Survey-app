@extends('layouts.master')

@section('content')
    <div class="col-lg-12 card">
        <div class="card-header mt-1">
            Data Ajuan
        </div>
        <hr>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Survey</th>
                            <th>Nama</th>
                            <th>Response</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->survey_title }}</td>
                                <td>{{ $item->name_user }}</td>
                                <td>{!! $item->question_response !!}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-muted">Data tidak tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
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
