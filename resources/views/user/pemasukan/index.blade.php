@extends('layouts.backend.template')
@section('styles')
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css"> --}}

    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css">
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tabel /</span> pemasukan</h4>
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-header">Table pemasukan <a href="{{ route('pemasukan.create') }}"
                        class="btn btn-sm btn-primary" style="float: right">Add</a></h5>
                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered" id="example">
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
                                    <td> <strong> @currency($data->jumlah_pemasukan) </strong></td>
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
                                                    <a class="dropdown-item"
                                                        href="{{ route('pemasukan.edit', $data->id) }}"><i
                                                            class="bx bx-edit-alt me-1"></i> Edit</a>
                                                    <a href="{{ route('pemasukan.destroy', $data->id) }}"
                                                        class="dropdown-item" data-confirm-delete="true"><i
                                                            class="bx bx-trash-alt me-1"></i>
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
    {{-- <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script> --}}
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
    <script>
        new DataTable('#example', {
            layout: {
                topStart: {
                    buttons: ['pdf', 'excel']
                }
            }
        });
    </script>
@endpush
