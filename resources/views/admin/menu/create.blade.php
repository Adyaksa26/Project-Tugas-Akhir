@extends('admin.layout.app')
@section('konten')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<h1 align="center">Input Menu</h1>
<hr>
@if($errors->any())
<div class="allert allert-danger">
  <ul>
    @foreach($errors->all() as $error)
    <li>{{$error}}</li>
    @endforeach
  </ul>
</div>
@endif
<form method="POST" action="{{route('menu.store')}}"
enctype="multipart/form-data">
@csrf
<div class="">
      <div class="bg-light rounded h-100 p-4">
          <h6 class="mb-4">Input Menu</h6>
          <form>
              <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                  <div class="col-sm-10">
                      <input type="text" name="nama" id="inputEmail3"
                      class="form-control @error('nama') is-invalid @enderror">
                      @error('nama')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                      @enderror
                  </div>
              </div>
              <div class="row mb-3">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">Harga</label>
                  <div class="col-sm-10">
                      <input type="text" name="harga" id="inputPassword3" 
                      class="form-control @error('harga') is-invalid @enderror">
                      @error('harga')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                      @enderror
                  </div>
              </div>
              <div class="row mb-3">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">Deskripsi</label>
                  <div class="col-sm-10">
                      <textarea type="textarea" name="deskripsi" class="form-control" id="textarea"></textarea>
                  </div>
              </div>
              <div class="row mb-3">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">Foto</label>
                  <div class="col-sm-10">
                      <input type="file" name="foto" class="form-control" id="inputPassword3">
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
              <button name="submit" type="submit" class="btn btn-primary">Submit</button>
          </form>
      </div>
  </div>
</form>

@endsection