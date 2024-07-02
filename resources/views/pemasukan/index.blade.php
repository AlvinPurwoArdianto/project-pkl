@extends('layouts.backend.template')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tabel /</span> pemasukan</h4>
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Table pemasukan <a href="{{ route('pemasukan.create') }}" class="btn btn-sm btn-primary"
                    style="float: right">Add</a></h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jumlah pemasukan</th>
                            <th>Deskripsi</th>
                            <th>Nama Dompet</th>
                            <th>Tanggal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($pemasukan as $data)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td> <strong> Rp. {{ $data->jumlah_pemasukan }} </strong></td>
                                <td> <strong> {{ $data->deskripsi }} </strong></td>
                                <td> <strong> {{ $data->kartu->nama_kartu }} </strong></td>
                                <td> <strong> {{ $data->created_at->format('d-m-Y') }} </strong></td>
                                <td>
                                    <form action="{{ route('pemasukan.destroy', $data->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('pemasukan.edit', $data->id) }}"><i
                                                        class="bx bx-edit-alt me-1"></i> Edit</a>
                                                <a href="{{ route('pemasukan.destroy', $data->id) }}" class="dropdown-item"
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
