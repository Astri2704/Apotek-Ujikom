    @extends('layouts.admin')
    @section('content')

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    {{-- @include('layouts/_flash') --}}
                    @include('sweetalert::alert')
                    <div class="card">
                        <div class="card-header">
                            Data obat
                            <a href="{{ route('kategori.create') }}" class="btn btn-sm btn-primary" style="float: right">
                                Tambah Data
                            </a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-middle" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kategori</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($kategori as $data)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $data->nama_kategori }}</td>
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