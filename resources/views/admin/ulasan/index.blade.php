@extends('admin.layout.app')
@section('konten')

<div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Ulasan</h6>
                            <div class="mb-4">
                                <a href="{{ route('ulasan.create', ['pesanan_id' => 1]) }}"
                                class="btn btn-primary">
                                <i class="fas fa-user-plus"></i></a>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Meja</th>
                                            <th>Ulasan</th>
                                            <th>Rating</th>
                                            <th>Action</th>


                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no=1 @endphp
                                        @foreach($ulasan as $u)
                                        <tr>
                                            <th>{{$loop->iteration}}</th>
                                            <td>{{$u->pesan}}</td>
                                            <td>{{$u->ulasan}}</td>
                                            <td>{{$u->rating}}</td>
                                            <td>
                                                <a href="{{route('ulasan.edit', $u->id)}}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i></a>
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
            <!-- Table End -->

@endsection