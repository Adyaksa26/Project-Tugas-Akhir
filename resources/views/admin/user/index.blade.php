@extends('admin.layout.app')
@section('konten')
@if(Auth::user()->role != 'staff' && Auth::user()->role != 'manager')
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Jenis Menu</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="nama" class="form-control" id=""
                            placeholder="Masukkan Jenis Menu">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

<!-- Table Start -->
<div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Management User</h6>
                            <div class="mb-4">
                                <a href="" class="btn btn-primary" 
                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fas fa-user-plus"></i></i></a>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @foreach($userAll as $ua)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>{{$ua->name}}</td>
                                            <td>{{$ua->email}}</td>
                                            <td>{{$ua->role}}</td>
                                            @if($ua->is_active == true)
                                            <td>Aktif</td>
                                            @else
                                            <td>
                                                <form action="{{route('admin.user.activate', $ua->id)}}"
                                                method="POST">
                                                @csrf
                                                    <button type="submit" class="btn btn-sm btn-primary">Aktifkan</button>
                                                </form>
                                            </td>
                                            @endif
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
@else
@php
abort(403, 'Forbidden');
@endphp
@endif

@endsection