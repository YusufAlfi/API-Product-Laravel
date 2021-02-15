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
                            Daftar Barang
                        </h4>
                    </div>

                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($products as $product)
                                    <tr>
                                            
                                        
                                        <td> {{ $product->id}}</td>
                                        <td> {{ $product->name}}</td>
                                        <td> {{ $product->type}}</td>
                                        <td> {{ $product->price}}</td>
                                        <td>{{ $product->quantity}}</td>
                                        <td>
                                            
                                            <a href="{{route('products.gallery', $product->id)}}" class="btn btn-info btn-sm">
                                                        {{-- <a href="" class="btn btn-info btn-sm"> --}}
                                                <i class="fa fa-picture-o"></i>
                                            </a>

                                            <a href="{{route('products.edit', $product->id)}}" class="btn btn-primary btn-sm">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <form action="{{route('products.destroy', $product->id)}}" method="POST" class="d-inline">
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