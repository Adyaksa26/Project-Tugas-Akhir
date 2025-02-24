@extends('admin.layout.app')
@section('konten')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<h1 align="center">Input Pesanan</h1>
<hr>

@foreach($pesanan as $p)
<form method="POST" action="{{route('pesanan.update',$p->id)}}"
enctype="multipart/form-data">
@csrf
@method('PUT')

<div class="">
      <div class="bg-light rounded h-100 p-4">
          <h6 class="mb-4">Input Pesanan</h6>
          <form>
          <div class="row mb-3">
              <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">No Meja</label>
                  <div class="col-sm-10">
                      <input type="text" name="no_meja" class="form-control" id="inputEmail3" value="{{$p->no_meja}}">
                  </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Metode Pembayaran</label>
                <div class="col-sm-10">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="metode_pembayaran" id="cash" value="Cash">
                        <label class="form-check-label" for="cash">
                            Cash
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="metode_pembayaran" id="debit" value="Debit">
                        <label class="form-check-label" for="debit">
                            Debit
                        </label>
                    </div>
                    @error('metode_pembayaran')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                </div>
              </div>
              <div class="row mb-3">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">Tanggal Pesan</label>
                  <div class="col-sm-10">
                      <input type="date" name="tgl_pesan" class="form-control" id="inputPassword3" value="{{$p->tgl_pesan}}">
                  </div>
              </div>
              <div class="row mb-3">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">Jam Pesan</label>
                  <div class="col-sm-10">
                      <input type="time" name="jam_pesan" class="form-control" id="inputPassword3" value="{{$p->jam_pesan}}">
                  </div>
              </div>
              <div class="row mb-3">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">Deskripsi</label>
                  <div class="col-sm-10">
                  <textarea id="textarea" name="deskripsi" cols="40" rows="5" class="form-control">{{$p->deskripsi}}</textarea>
                  </div>
              </div>
              <div class="row mb-3">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">Foto</label>
                  <div class="col-sm-10">
                      <input type="file" name="foto" class="form-control" id="inputPassword3" value="{{$p->foto}}">
                        @if(!empty($p->foto))
                        <img src="{{url('admin/img')}}/{{$p->foto}}" alt="">
                        @endif
                  </div>
              </div>
              <div class="row mb-3">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">Jenis Pesanan</label>
                  <div class="col-sm-10">
                  <select id="select" name="jenis_pesanan_id" class="custom-select">
                  @foreach($jenis_pesanan as $jenis_pesanan_nama)
                  <option value="{{$jenis_pesanan_nama->id}}">{{$jenis_pesanan_nama->nama}}</option>
                  @endforeach
                  </select>
                  </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Jenis Menu</label>
                <div class="col-sm-10">
                    @foreach($menu as $menu_nama)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="menu_ids[]" value="{{$menu_nama->id}}" id="menu_{{$menu_nama->id}}">
                            <label class="form-check-label" for="menu_{{$menu_nama->id}}">
                                {{$menu_nama->nama}}
                            </label>
                        </div>
                    @endforeach
                </div>
                </div>
              <button name="submit" type="submit" class="btn btn-primary">Submit</button>
          </form>
      </div>
  </div>
</form>
@endforeach
@endsection