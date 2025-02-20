@extends('admin.layout.app')
@section('konten')

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" rel="stylesheet" 
integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<h1 align="center">Input Ulasan</h1>
<hr>
<form method="POST" action="{{route('ulasan.store')}}"
enctype="multipart/form-data">
@csrf
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
  margin: 2%;
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
<div class="">
          <form>
              <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Ulasan</label>
                  <div class="col-sm-10">
                      <input type="text" name="ulasan" class="form-control" id="inputEmail3">
                  </div>
              </div>
              </div>
              <div class="row mb-3">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">No Meja</label>
                  <div class="col-sm-10">
                  <select id="select" name="pesanan_id" class="custom-select">
                    @foreach($pesanan as $pesan){$id = $pesan->id;
                    <option value="{{$pesan->id}}">{{$pesan->no_meja}}</option>}
                    @endforeach
                    
                  </select>
                  </div>
                  <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2">Rating</label>
            <div class="starrating risingstar d-flex justify-content-center flex-row-reverse">
            <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="5 star"></label>
            <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 star"></label>
            <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 star"></label>
            <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 star"></label>
            <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 star"></label>
            </div>
            </div>
              </div>
              <button name="submit" type="submit" class="btn btn-primary center">Submit</button>
          </form>
      </div>
  </div>
</form>

@endsection