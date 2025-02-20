@extends('admin.layout.app')
@section('konten')

<!-- Table Start -->
<div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">User</h6>
                            <div class="mb-4">
                                <a href="{{route('users.create')}}" 
                                class="btn btn-primary">
                                <i class="fas fa-user-plus"></i></a>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Email</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>No_HP</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no=1 @endphp
                                        @foreach($users as $u)
                                        <tr>
                                            <th>{{$loop->iteration}}</th>
                                            <td>{{$u->email}}</td>
                                            <td>{{$u->username}}</td>
                                            <td>{{$u->password}}</td>
                                            <td>{{$u->no_hp}}</td>
                                            <td>{{$u->role}}</td>
                                            <td>
                                                <a href="{{route('users.show', $u->id)}}" class="btn btn-sm btn-success">
                                                <i class="fas fa-eye"></i></a>
                                                <a href="{{route('users.edit', $u->id)}}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i></a>
                                                <!-- Button hapus -->
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{$u->id}}">
                                                <i class="fas fa-trash-alt"></i>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal{{$u->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Produk</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah anda yakin akan menghapus data {{$u->nama}}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <form action="{{ route('users.destroy', $u->id) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                </div>
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