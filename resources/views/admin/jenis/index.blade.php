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
                    <form action="{{url('admin/jenis_menu/store') }}" method="POST" enctype="multipart/form-data">
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
                            <h6 class="mb-4">Jenis Menu</h6>
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
                                            <th scope="col">Jenis Menu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no=1 @endphp
                                        @foreach($jenis as $j)
                                        <tr>
                                            <th scope="row">{{$no++}}</th>
                                            <td>{{$j->nama}}</td>
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