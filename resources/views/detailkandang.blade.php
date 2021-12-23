@extends('template.template')
@section('title', 'Detail Penangkaran')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        @if (session('create'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">&times;</button>
                                <h6><i class="icon fas fa-check"></i>{{ session('create') }} </h6>
                            </div>
                        @elseif(session('delete'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">&times;</button>
                                <h6><i class="icon fas fa-check"></i>{{ session('delete') }}</h6>
                            </div>
                        @endif
                        <h3 class="card-title">
                            <td>
                                <button type="button" class="btn btn-block btn-outline-success" data-toggle="modal"
                                    data-target="#modal-lg">
                                    <ion-icon name="attach"></ion-icon> <b>Tambah</b>
                                </button>

                                <div class="modal fade" id="modal-lg">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Tambah Pengguna</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('kandang') }}" method="post">
                                                    @csrf
                                                    <div class="input-group mb-3">
                                                        <input type="text" id="namakandang" name="namakandang"
                                                            class="form-control @error('namakandang') is-invalid @enderror"
                                                            placeholder="Nama Kandang" value="{{ old('namakandang') }}">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <ion-icon name="code-slash"></ion-icon>
                                                            </div>
                                                        </div>
                                                        @error('namakandang')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <input type="text" id="category_id" name="category_id"
                                                            class="form-control @error('category_id') is-invalid @enderror"
                                                            placeholder="Kategori" value="{{ old('category_id') }}">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <ion-icon name="attach"></ion-icon>
                                                            </div>
                                                        </div>
                                                        @error('category_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <input type="text" style="display:none" id="penangkaran_id"
                                                            name="penangkaran_id"
                                                            class="form-control @error('penangkaran_id') is-invalid @enderror"
                                                            placeholder="Penangkaran" value="{{ $penangkarans->id }}">
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success">Tambah</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                            </td>
                        </h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div style="text-align:center">
                            <h2><b>{{ $penangkarans->lokasi_penangkaran }}</b></h2>
                        </div>
                        <br>
                        <div class="row">
                            <?php $no = 1; ?>
                            @foreach ($penangkarans->kandangs as $data)
                                <div class="col-md-6 ">
                                    <div class="card">
                                        {{-- <img src="..." class="card-img-top" alt="..."> --}}
                                        <div class="card-body">
                                            <h5 class="card-title"><b>{{ $data->namakandang }}</b></h5>
                                            <p class="card-text">Kondisi Kandang<br>
                                                <b>{{ $data->category->kategori }}</b><br>
                                                <b></b>
                                            </p>
                                            <a href="/penangkaran" class="btn btn-primary">Go
                                                somewhere</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
