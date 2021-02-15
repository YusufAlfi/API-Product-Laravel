@extends('layouts.default')


@section('content')
    <div class="order">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    @if(session('status'))
                        <div class="alert alert-success">
                            {{session('status')}}
                        </div>
                    @endif
                    <div class="card-body">
                        <h4 class="box-title">
                            Daftar Foto Barang
                        </h4>
                    </div>

                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Barang</th>
                                        <th>Foto</th>
                                        <th>Default</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($galleries as $gallery)
                                    <tr>
                                            
                                        <td> {{ $gallery->id}}</td>
                                        {{-- panggil relasi product dan panggil namenya --}}
                                        <td> {{ $gallery->product->name}}</td>
                                        <td>
                                            <img src=" {{url($gallery->photo)}}">
                                        </td>
                                        <td>
                                            {{ $gallery->is_default ? 'ya' : 'tidak' }}
                                        </td>

                                        <td>

                                            {{-- <a href="{{route('product-galleries.edit', $gallery->id)}}" class="btn btn-primary btn-sm">
                                                <i class="fa fa-pencil"></i>
                                            </a> --}}
                                            
                                            <form action="{{route('product-galleries.destroy', $gallery->id)}}" method="POST" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i>
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