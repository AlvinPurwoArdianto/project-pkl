@extends('layouts.backend.template')
@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tabel /</span> Dompet</h4>
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-header">Table Dompet <a href="{{ route('dompet.create') }}" class="btn btn-sm btn-primary"
                        style="float: right">Add</a></h5>
                <div class="table-responsive text-nowrap">
                    <table class="table table-striped" id="example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Dompet</th>
                                <th>Nomor Kartu</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($kartu as $data)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td> <strong> {{ $data->nama_kartu }} </strong></td>
                                    <td> <strong> {{ $data->no_kartu }} </strong></td>
                                    <td> <strong>Rp. {{ $data->total }} </strong></td>
                                    <td>
                                        <form action="{{ route('dompet.destroy', $data->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('dompet.edit', $data->id) }}"><i
                                                            class="bx bx-edit-alt me-1"></i> Edit </a>
                                                    <a href="{{ route('dompet.destroy', $data->id) }}" class="dropdown-item"
                                                        data-confirm-delete="true"><i class="bx bx-trash-alt me-1"></i>
                                                        Delete</a>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#example');
    </script>
@endpush
