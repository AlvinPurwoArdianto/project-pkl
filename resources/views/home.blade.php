@extends('layouts.frontend.template')
@section('content')
    <div class="container-fluid py-4">
        <div class="row mb-3">
            <div class="col-lg-6">
                <div class="row">
                    <div class="card mt-0 p-2">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row mt-3">
                                    <div class="col-6 px-4">
                                        <h4><b>Dompet Anda :</b></h4>
                                    </div>
                                    <div class="col-6 px-3 text-end">
                                        <a class="btn bg-gradient-dark" href="{{ route('dompet.create') }}"><i
                                                class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Kartu</a>
                                    </div>
                                </div>
                            </div>
                            @foreach ($kartu as $data)
                                <div class="col me-auto mb-2 px-3">
                                    <div class="card bg-transparent shadow-xl">
                                        <div class="overflow-hidden position-relative border-radius-xl"
                                            style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/card-visa.jpg');">
                                            <span class="mask bg-gradient-dark"></span>
                                            <div class="card-body position-relative z-index-1 p-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <p class="text-white text-sm opacity-8">Nomor</p>
                                                        <h6 class="text-white mb-6"> {{ $data->no_kartu }} </h6>
                                                    </div>
                                                    <div class="col text-end">
                                                        <form action="{{ route('dompet.destroy', $data->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="{{ route('dompet.destroy', $data->id) }}"
                                                                class="text-white" data-confirm-delete="true"><i
                                                                    class="bx bx-trash-alt me-1"></i>
                                                                Delete</a>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="d-flex">
                                                        <div class="me-4">
                                                            <p class="text-white text-sm opacity-8 mb-0">Nama Dompet</p>
                                                            <h6 class="text-white mb-1"> {{ $data->nama_kartu }} </h6>
                                                        </div>
                                                        <div>
                                                            <p class="text-white text-sm opacity-8 mb-0">Total Saldo</p>
                                                            <h6 class="text-white mb-0"> @currency($data->total) </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-lg-12 mb-2">
                                <div class="row mt-3">
                                    <div class="col-6 px-4">
                                        <h6>Total Semua Saldo Di Dompet :</h6>
                                        <h5><b> @currency($saldo) </b></h5>
                                    </div>
                                    <div class="col-3 text-center">
                                        <a class="btn bg-gradient-success"
                                            href="{{ route('pemasukan.create') }}">Pemasukan</a>
                                    </div>
                                    <div class="col-3 text-center">
                                        <a class="btn bg-gradient-warning"
                                            href="{{ route('pengeluaran.create') }}">Pengeluaran</a>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-4 px-4 mt-2">
                                        <h5>Pemasukan</h5>
                                        <h5><b>@currency($allPemasukan)</b></h5>
                                    </div>
                                    <div class="col-4 px-4 mt-2">
                                        <h5>pengeluaran</h5>
                                        <h5><b>@currency($allPengeluaran) </b></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card p-2">
                    <div class="card-header bg-transparent">
                        <h4><b>Statistik</b></h4>
                        <p class="text-sm mt-4">
                            <i class="fa fa-arrow-up text-success"></i>
                            <span class="font-weight-bold">4% more</span> in 2021
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="chart-line" class="chart-canvas" height="250"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h4><b>History</b></h4>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                No</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Username</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Kartu</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Jumlah</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Jenis</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Kategori</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        <tr>
                                            <td>
                                                {{ $no++ }}</td>
                                            <td>{{ Auth::user()->username }}</td>
                                            <td>a</td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
