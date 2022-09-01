<!doctype html>
<html lang="en">
  <head>
    <title>Pemantaun Korona 2022 </title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

  </head>
  <body>
    <div class="jumbotron p-5 bg-primary">
        <div class="container text-white text-center ">
            <h1 class="display-4">Corona Virus Update</h1>
            <p class="lead">
                <h2>
                    PANTAU PENYEBARAN VIRUS COVID-19 DI DUNIA
                    <br>
                    SECARA REAL TIME <br>
                    MARI MENJAGA DIRI ANDA DAN ORANG LAIN DEMI NEGARA
                </h2>
            </p>

        </div>
    </div>

    <!-- Content -->
    <style type="text/css">
        .box{
            padding: 30px 40px;
            border-radius: 5px;
        }
    </style>
    <div class="container mt-5 text-center">
        <div class="row">
            <!-- Positif -->
            <div class="col-md-4">
                <div class="bg-danger box text-white ">
                    <div class="row">
                        <div class="col-md-6 ">
                            <h5>POSITIF</h5>
                            <h2 id="data-kasus"> 0 </h2>
                            <h5>Orang</h5>
                        </div>
                        <div class="col-md-4">
                            <img src="img/sad.svg" style="width: 100px;" >
                        </div>
                    </div>
                </div>
            </div>

            <!-- Meninggal -->
            <div class="col-md-4">
                <div class="bg-primary box text-white ">
                    <div class="row">
                        <div class="col-md-6 ">
                            <h5>Meninggal</h5>
                            <h2 id="data-meninggal"> 0 </h2>
                            <h5>Orang</h5>
                        </div>
                        <div class="col-md-4">
                            <img src="img/cry.svg" style="width: 100px;" >
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sembuh -->
            <div class="col-md-4">
                <div class="bg-success box text-white ">
                    <div class="row">
                        <div class="col-md-6 ">
                            <h5>Sembuh</h5>
                            <h2 id="data-sembuh"> 0 </h2>
                            <h5>Orang</h5>
                        </div>
                        <div class="col-md-4">
                            <img src="img/happy.svg" style="width: 100px;" >
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-3">
                <div class="bg-primary box text-white ">
                    <div class="row">
                        <div class="col-md-3">
                            <h2>INDONESIA</h2>
                                <h5 id="data-id">Positif    : 0  Orang<br> Meninggal  : 0 Orang<br> Sembuh     : 0 Orang </h5>
                        </div>
                        <div class="col-md-4">
                            <img src="img/Indonesia.svg" style="width: 150px;" >
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Akhir Row -->
        <div class="card mt-2">
            <div class="card-header bg-secondary text-white">
                <b> Data Kasus Korona di Indonesia Berdasarkan Provinsi</b>
            </div>
            <div class="card-body">
            <table class="table table-striped table-hover ">
                <thead>
                    <th>No.</th>
                    <th>Nama Provinsi</th>
                    <th>Positif</th>
                    <th>Sembuh</th>
                    <th>Meninggal</th>
                </thead>
                <tbody id="table-data"></tbody>
            </table>
            </div>

        </div>

    </div>
    <!-- Akhir Container -->

    <!-- Footer -->
    <footer class="bg-primary text-center text-white mt-3 bt-2 pb-2">
        Create by GMF
    </footer>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  </body>
</html>


<script>
    $(document).ready(function(){

        // panggil data global
        All();
        dataNegara();
        dataProv();


        // Untuk refresy otomatis
        setInterval(function(){
            All();
            dataNegara();
            dataProv();
        }, 3000); // setiap 3 detik


        function All(){
            $.ajax({
                url: 'https://coronavirus-19-api.herokuapp.com/all',
                success: function(data){
                    try{
                        var json = data;
                        var kasus = data.cases;
                        var meninggal = data.deaths;
                        var sembuh = data.recovered;

                        //Menampilkan data
                        // Jika menggunakan # maka menggunakan id
                        // Jika menggunakan . maka menggunakan class
                        $('#data-kasus').html(kasus);
                        $('#data-meninggal').html(meninggal);
                        $('#data-sembuh').html(sembuh);
                    }catch{
                        alert('Error');
                    }
                }
            });
        }

        function dataNegara(){
            $.ajax({
                url: 'https://coronavirus-19-api.herokuapp.com/countries',
                success: function(data){
                    try{
                        var json = data;
                        var html = [];

                        if(json.length > 0){
                            var i;
                            for(i = 0; i < json.length; i++){
                                var dataNegara = json[i];
                                var namaNegara = dataNegara.country;
                                
                                if(namaNegara === 'Indonesia'){
                                    var kasus = dataNegara.cases;
                                    var meninggal = dataNegara.deaths;
                                    var sembuh = dataNegara.recovered;

                                    //Menampilkan 
                                    $('#data-id').html(
                                        'Positif : ' +kasus+' Orang <br> Meninggal : ' +meninggal+ ' Orang <br> Sembuh : ' +sembuh+ ' Orang' )
                                    }
                            }
                        }
                    }catch{
                        alert('Error');
                    }
                }
            });
        }
        function dataProv(){
            $.ajax({
                url: 'curl2.php',
                type: 'GET',
                success: function(data){
                    try{

                        $('#table-data').html($data);
                    }catch{
                        alert('Error');
                    }
                }
            });
        }
    });


</script>