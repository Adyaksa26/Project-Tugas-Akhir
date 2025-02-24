@extends('admin.layout.app')
@section('konten')

<!-- Table Start -->
<div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Pesanan</h6>
                            <div class="mb-4">
                                <a href="{{route('pesanan.create')}}" 
                                class="btn btn-lg btn-primary" >
                                <i class="fas fa-user-plus"></i></a>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Meja</th>
                                            <th>Metode Pembayaran</th>
                                            <th>Tanggal Pesan</th>
                                            <th>Jam Pesan</th>
                                            <th>nama_menu</th>
                                            <th>Jenis Pesanan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no=1 @endphp
                                        @foreach($pesanan as $p)
                                        <tr>
                                            <th>{{$loop->iteration}}</th>
                                            <td>{{$p->no_meja}}</td>
                                            <td>{{$p->metode_pembayaran}}</td>
                                            <td>{{$p->tgl_pesan}}</td>
                                            <td>{{$p->jam_pesan}}</td>
                                            <td>{{$p->nama_menu}}</td>
                                            <td>{{$p->jenis_pesanan_nama}}</td>
                                            <td>
                                                <a href="{{route('pesanan.show', $p->id)}}" class="btn btn-sm btn-success">
                                                <i class="fas fa-eye"></i></a>
                                                <a href="{{route('pesanan.edit', $p->id)}}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i></a>
                                                <!-- Button hapus -->
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{$p->id}}">
                                                <i class="fas fa-trash-alt"></i>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal{{$p->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Produk</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah anda yakin akan menghapus data {{$p->nama}}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <form action="{{ route('pesanan.destroy', $p->id) }}" method="POST" style="display:inline;">
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