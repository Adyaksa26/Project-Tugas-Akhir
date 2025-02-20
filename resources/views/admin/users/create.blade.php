@extends('admin.layout.app')
@section('konten')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<h1 align="center">Update User</h1>
<form method="POST" action="{{route('users.store')}}"
enctype="multipart/form-data">
@csrf
  <div class="form-group row">
    <label for="text" class="col-4 col-form-label">Email</label> 
    <div class="col-8">
      <input id="text" name="email" type="text" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label for="text1" class="col-4 col-form-label">Username</label> 
    <div class="col-8">
      <input id="text1" name="username" type="text" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label for="text1" class="col-4 col-form-label">Password</label> 
    <div class="col-8">
      <input id="text1" name="password" type="text" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label for="text1" class="col-4 col-form-label">No_HP</label> 
    <div class="col-8">
      <input id="text1" name="no_hp" type="text" class="form-control">
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Foto</label>
    <div class="col-sm-10">
        <input type="file" name="foto" class="form-control" id="inputPassword3">
    </div>
    </div>
  <div class="form-group row">
    <label for="text2" class="col-4 col-form-label">Role</label> 
    <div class="col-8">
        @foreach ($role as $r)
        @php 
        $cek = (old('r') == $r) ? 'checked': ''; @endphp
    <div class="custom-control custom-radio custom-control-inline">
        <input name="role" id="radio_0{{$r}}" type="radio" 
        class="custom-control-input" value="{{$r}}" {{$cek}}> 
        <label for="radio_0{{$r}}" class="custom-control-label">{{$r}}</label>
      </div>
      @endforeach
    </div>
  </div>
  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="submit" type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>


@endsection