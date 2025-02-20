@extends('admin.layout.app')
@section('konten')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<h1 align="center">Input Menu</h1>
<hr>

@foreach($menu as $m)
<form method="POST" action="{{route('menu.update',$m->id)}}"
enctype="multipart/form-data">
@csrf
@method('PUT')
<div class="">
      <div class="bg-light rounded h-100 p-4">
          <h6 class="mb-4">Input Menu</h6>
          <form>
              <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                  <div class="col-sm-10">
                      <input type="text" name="nama" class="form-control" id="inputEmail3" value="{{$m->nama}}">
                  </div>
              </div>
              <div class="row mb-3">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">Harga</label>
                  <div class="col-sm-10">
                      <input type="text" name="harga" class="form-control" id="inputPassword3" value="{{$m->harga}}">
                  </div>
              </div>
              <div class="row mb-3">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">Deskripsi</label>
                  <div class="col-sm-10">
                  <textarea id="textarea" name="deskripsi" cols="40" rows="5" class="form-control">{{$m->deskripsi}}</textarea>
                  </div>
              </div>
              <div class="row mb-3">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">Foto</label>
                  <div class="col-sm-10">
                      <input type="file" name="foto" class="form-control" id="inputPassword3" value="{{$m->foto}}">
                        @if(!empty($m->foto))
                        <img src="{{url('admin/img')}}/{{$m->foto}}" alt="">
                        @endif
                  </div>
              </div>
              <div class="row mb-3">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">Jenis Menu</label>
                  <div class="col-sm-10">
                  <select id="select" name="jenis_menu_id" class="custom-select">
                    @foreach($jenis_menu as $jenis)

                    <option value="{{$jenis->id}}">{{$jenis->nama}}</option>
                    @endforeach

                  </select>
                  </div>
              </div>
              <button name="proses" value="simpan" type="submit" class="btn btn-primary">Submit</button>
          </form>
      </div>
  </div>
</form>
@endforeach
@endsection
