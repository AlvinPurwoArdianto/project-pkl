@extends('layouts.backend.template')
@section('content')
    {{-- <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tabel /</span> Rekap</h4>
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama User</th>
                            <th>Nama Dompet</th>
                            <th>Jumlah</th>
                            <th>Jenis</th>
                            <th>Deskripsi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($kartu as $data)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td> <strong> {{ Auth::user()->name }} </strong></td>
                                <td> <strong> {{ $data->nama_kartu }} </strong></td>
                                <td> <strong> {{ $data->pemasukan->jumlah_pemasukan }} </strong></td>
                                <td> <strong> {{ $data->pemasukan->deskripsi }} </strong></td>
                                <td></td>
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
    </div> --}}
@endsection
