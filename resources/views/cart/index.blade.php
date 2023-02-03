@extends('layouts.admin')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @include('layouts/_flash')
                <div class="card">
                    <div class="card-header">
                        Data cart
                        <a href="{{ route('cart.create') }}" class="btn btn-sm btn-primary" style="float: right">
                            Tambah Data
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>User ID</th>
                                        <th>Obat</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Total Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach ($cart as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->user->name }}</td>
                                            <td>{{ $data->obat->nama_obat }}</td>
                                            <td>{{ $data->obat->harga }}</td>
                                            <td>{{ $data->jumlah }}</td>
                                            <td>{{$total_harga = $data->jumlah * $data->obat->harga}}</td>
                                            <td>
                                                <form action="{{ route('kategori.destroy', $data->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="{{ route('kategori.edit', $data->id) }}"
                                                        class="btn btn-sm btn-outline-success">
                                                        Edit
                                                    </a> |
                                                    <a href="{{ route('kategori.show', $data->id) }}"
                                                        class="btn btn-sm btn-outline-warning">
                                                        Show
                                                    </a> |
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('Apakah Anda Yakin?')">Delete
                                                    </button>
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
        </div>
    </div>
@endsection 