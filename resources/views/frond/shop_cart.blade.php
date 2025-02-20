@extends('frond.layout.app_no_banner')
@section('content')
<script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="{{ config('midtrans.client_key') }}">
</script>
      
<style>
    .btn-custom-blue {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
    }

    .btn-custom-blue:hover {
        background-color: #0056b3;
        border-color: #0056b3;
        color: white;
    }
</style>

<!-- Start Cart  -->
<div class="cart-box-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-main table-responsive">
                    <table class="table">
                        <thead>
                            <tr style="background-color: red; color: #fff;">
                                <th>Images</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0 @endphp
                            @if($cart && count($cart) > 0)
                                @foreach($cart as $id => $details)
                                    @php $total += $details['harga'] * $details['quantity'] @endphp
                                    <tr data-id="{{ $id }}">
                                        <td class="thumbnail-img">
                                            <a href="#">
                                                <img class="img-fluid" src="{{ $details['foto'] ? url('admin/img/'.$details['foto']) : url('admin/img/nofoto.png') }}" alt="" />
                                            </a>
                                        </td>
                                        <td class="name-pr">
                                            <a href="#">
                                                {{ $details['nama'] }}
                                            </a>
                                        </td>
                                        <td class="price-pr">
                                            <p>Rp. {{ $details['harga'] }}</p>
                                        </td>
                                        <td class="quantity-box">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-outline-primary quantity-decrease" type="button">-</button>
                                                </div>
                                                <input type="number" size="4" value="{{ $details['quantity'] }}" min="1" step="1" class="form-control text-center qty-input" readonly>
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-primary quantity-increase" type="button">+</button>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="total-pr">
                                            <p class="item-total">Rp. {{ $details['harga'] * $details['quantity'] }}</p>
                                        </td>
                                        <td class="remove-pr">
                                            <a href="{{ route('remove.from.cart', $id) }}" class="btn btn-outline-danger btn-sm rounded-pill">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center">Your cart is empty!</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if($cart && count($cart) > 0)
            <div class="row mt-4">
                <div class="col-lg-8"></div>
                <div class="col-lg-4">
                    <div class="order-box bg-danger text-white p-4">
                        <h3 class="mb-4">Ringkasan Pesanan :</h3>
                        <div class="order-summary">
                            @foreach($cart as $id => $details)
                                <div class="d-flex justify-content-between">
                                    <p>{{ $details['nama'] }}</p>
                                    <p>Rp. {{ $details['harga'] * $details['quantity'] }}</p>
                                </div>
                            @endforeach
                            <div class="card">
                                <div class="card-body p-4">
                                    <div class="row d-flex justify-content-between align-items-center">
                                        <div class="col-md-8 col-lg-8 col-xl-8 d-flex justify-content-center">
                                            <button type="button" class="btn btn-custom-blue btn-block btn-lg custom-btn-width" id="pay-button">Checkout</button>
                                        </div>
                                        <div class="col-md-4 col-lg-4 col-xl-4 offset-lg-1">
                                            <h5 class="mb-0">Total Rp. {{ number_format($total, 0, ',', '.') }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script type="text/javascript">
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function(result){
                alert("payment success!"); 
                console.log(result);
                window.location.href = '/ulasan/create/' + result.order_id; // Redirect to ulasan create page
            },
            onPending: function(result){
                alert("waiting for your payment!"); console.log(result);
            },
            onError: function(result){
                alert("payment failed!"); console.log(result);
            },
            onClose: function(){
                alert('you closed the popup without finishing the payment');
            }
        });
    });
</script>


        @endif

    </div>
</div>
@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(".update-cart").change(function (e) {
        e.preventDefault();
        var ele = $(this);
        var id = ele.closest('.card').data('id');
        $.ajax({
            url: '{{ route('update.cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
                quantity: ele.val()
            },
            success: function (response) {
                window.location.reload();
            }
        });
    });

    $(".remove-from-cart").click(function (e) {
        e.preventDefault();
        var ele = $(this);
        var id = ele.closest('.card').data('id');
        if(confirm("Are you sure want to remove?")) {
            $.ajax({
                url: '{{ url('remove-from-cart') }}' + '/' + id,
                method: "GET",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
</script>
@endsection
