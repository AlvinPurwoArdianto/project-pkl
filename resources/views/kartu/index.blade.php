@extends('layouts.backend.template')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tabel /</span> Dompet</h4>
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Table Dompet <a href="{{ route('kartu.create') }}" class="btn btn-sm btn-primary"
                    style="float: right">Add</a></h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
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
                                    <form action="{{ route('kartu.destroy', $data->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('kartu.edit', $data->id) }}"><i
                                                        class="bx bx-edit-alt me-1"></i> Edit </a>
                                                <a href="{{ route('kartu.destroy', $data->id) }}" class="dropdown-item"
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
@endsection
