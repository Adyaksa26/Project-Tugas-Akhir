@extends('layouts.app')

@section('content')
<div class="container">
    <h1 align="center">Konfirmasi Pembayaran</h1>
    <hr>
    <p>Terima kasih telah menyelesaikan pembayaran. Silakan berikan ulasan Anda tentang pengalaman Anda.</p>
    
    <form method="POST" action="{{ route('ulasan.store') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="pesanan_id" value="{{ $pesanan->id }}">
        <div class="form-group">
            <label for="ulasan">Ulasan</label>
            <input type="text" name="ulasan" class="form-control" id="ulasan" required>
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
        <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
    </form>
</div>
@endsection
