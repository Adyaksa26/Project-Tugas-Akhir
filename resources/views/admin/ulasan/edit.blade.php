@extends('admin.layout.app')
@section('konten')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<h1 align="center">Edit Ulasan</h1>
<hr>

<style>
 /***
 *  Simple Pure CSS Star Rating Widget Bootstrap 4 
 * 
 *  www.TheMastercut.co
 *  
 ***/

@import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

/* Styling h1 and links
––––––––––––––––––––––––––––––––– */
h1[alt="Simple"] {color: white;}
a[href], a[href]:hover {color: grey; font-size: 1em; text-decoration: none}


body
{
  background: auto !important;
}

.starrating > input {display: none;}  /* Remove radio buttons */

.starrating > label:before { 
  content: "\f005"; /* Star */
  margin: 1em;
  font-size: 2em;
  font-family: FontAwesome;
  display: inline-block; 
}

.starrating > label
{
  color: #222222; /* Start color when not clicked */
}

.starrating > input:checked ~ label
{ color: #ffca08 ; } /* Set yellow color when star checked */

.starrating > input:hover ~ label
{ color: #ffca08 ;  } /* Set yellow color when star hover */
    </style>

<div class="bg-light rounded h-100 p-4">
  <h6 class="mb-4">Edit Ulasan</h6>
  <form method="POST" action="{{route('ulasan.update', $ulasan->id)}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row mb-3">
      <label for="inputUlasan" class="col-sm-2 col-form-label">Ulasan</label>
      <div class="col-sm-10">
        <input type="text" name="ulasan" class="form-control" id="inputUlasan" value="{{$ulasan->ulasan}}">
      </div>
    </div>
    <div class="row mb-3">
      <label for="select" class="col-sm-2 col-form-label">No Meja</label>
      <div class="col-sm-10">
        <select id="select" name="pesanan_id" class="custom-select">
          @foreach($pesanan as $pesan)
            <option value="{{$pesan->id}}" {{$pesan->id == $ulasan->pesanan_id ? 'selected' : ''}}>{{$pesan->no_meja}}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="row mb-3">
      <label for="inputRating" class="col-sm-2 col-form-label">Rating</label>
      <div class="col-sm-10">
        <div class="starrating risingstar d-flex justify-content-center flex-row-reverse">
        <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="5 star"></label>
            <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 star"></label>
            <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 star"></label>
            <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 star"></label>
            <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 star"></label>
        </div>
      </div>
    </div>
    <button name="submit" type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

@endsection
