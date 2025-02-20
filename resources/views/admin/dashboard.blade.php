@extends('admin.layout.app')
@section('konten')

 <!-- Sale & Revenue Start -->
 <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-primary"></i>
                            <div class="ms-3">
                                <div class="mb-2">Menu : {{$menu}}</div>
                                <a href="{{route('menu.index')}}">Show All</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Pesanan : {{$pesanan}}</p>
                                <a href="{{route('pesanan.index')}}">Show All</a>
                            </div>
                        </div>
                    </div>
                    @if(Auth::user()->role == 'admin')
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-area fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Jenis Pesanan : {{$jenis_pesanan}}</p>
                                <a href="{{url('admin/jenis_pesanan')}}">Show All</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-pie fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Jenis Menu : {{$jenis_menu}}</p>
                                <a href="{{url('admin/jenis_menu')}}">Show All</a>
                            </div>
                        </div>
                    </div>

                    @endif
                </div>
            </div>

            <!-- Sale & Revenue End -->

           <!-- Chart Start -->
           <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Single Line Chart</h6>
                            <canvas id="line-chart"></canvas>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Pie Chart</h6>
                            <canvas id="pie-chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
<script>
    var menuData = @json($menuData);
    //kodingan diatas memanggil variable menuData yang dikirim compact dari 
    //DashboardController
    //json mengubah data dari data array ke json untuk dideklarasikan ke javascript
    var labels = menuData.map(function(item){
        return item.nama; 
    });
    //var labels mendeklarasikan data yang mengambil kolom kode 
    var data = menuData.map(function(item){
        return item.harga;
    //map ada fungsi untuk mengurutkan data
    });
    // Single Line Chart
    var ctx3 = document.getElementById("line-chart");
    var myChart3 = new Chart(ctx3, {
        type: "line",
        data: {
            labels: labels,
            datasets: [{
                label: "nama",
                fill: false,
                backgroundColor: "rgba(0, 156, 255, .3)",
                data: data
            }]
        },
        options: {
            responsive: true
        }
    });
</script>
<script>
    var pesananData = @json($pesananData);
    var labels = pesananData.map(function(item){
        return item.metode_pembayaran; 
    });
    var data = pesananData.map(function(item){
        return item.Menu_id;
    });
    // Pie Chart
    var ctx5 = document.getElementById("pie-chart");
    var myChart5 = new Chart(ctx5, {
        type: "pie",
        data: {
            labels: labels,
            datasets: [{
                backgroundColor: [
                    "rgba(0, 156, 255, .7)",
                    "rgba(0, 156, 255, .6)",
                    "rgba(0, 156, 255, .5)",
                    "rgba(0, 156, 255, .4)",
                    "rgba(0, 156, 255, .3)"
                ],
                data: data
            }]
        },
        options: {
            responsive: true
        }
    });

</script>
@endsection