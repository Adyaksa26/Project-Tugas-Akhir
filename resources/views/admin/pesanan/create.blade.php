@extends('admin.layout.app')
@section('konten')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<h1 align="center">Input Pesanan</h1>
<hr>
<form method="POST" action="{{route('pesanan.store')}}"
enctype="multipart/form-data">
@csrf

<div class="">
      <div class="bg-light rounded h-100 p-4">
          <h6 class="mb-4">Input Pesanan</h6>
          <form>
          <div class="row mb-3">
              <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">No Meja</label>
                  <div class="col-sm-10">
                      <input type="text" name="no_meja" id="inputEmail3" 
                      class="form-control @error('no_meja') is-invalid @enderror">
                      @error('no_meja')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                      @enderror
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
              <div class="row mb-3">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">Bukti Pembayaran</label>
                  <div class="col-sm-10">
                      <input type="text" name="bukti_pembayaran" class="form-control" id="inputPassword3">
                  </div>
              </div>
              <div class="row mb-3">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">Tanggal Pesan</label>
                  <div class="col-sm-10">
                      <input type="date" name="tgl_pesan" id="inputPassword3" 
                      class="form-control @error('tgl_pesan') is-invalid @enderror">
                      @error('tgl_pesan')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                      @enderror
                  </div>
              </div>
              <div class="row mb-3">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">Jam Pesan</label>
                  <div class="col-sm-10">
                      <input type="time" name="jam_pesan" id="inputPassword3" 
                      class="form-control @error('jam_pesan') is-invalid @enderror">
                      @error('jam_pesan')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                      @enderror
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

@endsection