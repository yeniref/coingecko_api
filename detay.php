<?php error_reporting(1);
include('fonk.php');
$coin = $_GET['coin']; 
$site_url ="http://localhost/coingecko/";
$getir = "https://api.coingecko.com/api/v3/coins/".$coin;
$getir = file_get_contents($getir);
$getir = json_decode($getir);
$coin_adi = $getir->name;
$coin_resim_url = $getir->image->thumb;
$coin_fiyat_usd = number_format($getir->market_data->current_price->usd); 
$coin_fiyat_try = number_format($getir->market_data->current_price->try);
$coin_piyasa_degeri = number_format($getir->market_data->market_cap->usd);
$coin_24_saat_yuksek = number_format($getir->market_data->high_24h->usd);
$coin_24_saat_dusuk = number_format($getir->market_data->low_24h->usd);
$coin_sembol = $getir->symbol;
$coin_dolasimdaki_arz = number_format($getir->market_data->circulating_supply); 
$coin_max_arz = number_format($getir->market_data->max_supply); 
$coin_toplam_arz = number_format($getir->market_data->total_supply); 
$coin_ath_usd = number_format($getir->market_data->ath->usd);
?>
<html lang="tr">
<head>
<title>Coingecko - uygulaması - <?php echo $getir->name;?></title>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
 <div class="container"> 
 <div class="row">
 <ul class="list-group" style="width:100%;">
<li class="list-group-item"><div class="float-left"><img src="<?php echo $coin_resim_url;?>" alt="<?php echo $coin_adi;?>" width="48" height="48"></div><h4 class="float-right" style="font-size: 15px;font-weight: bold;margin-top: 15px;"><?php echo $coin_adi;?></h4></li>
<li class="list-group-item"><i class="fas fa-tags text-primary"></i> Fiyat : <span class="float-right" style="font-weight: bold;">$<?php echo $coin_fiyat_usd;?></span></li>
<li class="list-group-item"><i class="fas fa-money-check-alt text-primary"></i> Piyasa Değeri : <span class="float-right" style="font-weight: bold;">$<?php echo $coin_piyasa_degeri;?></span></li>
<li class="list-group-item"><i class="fas fa-code text-primary"></i> Coin Kodu : <span class="float-right" style="font-weight: bold;"><?php echo $coin_sembol;?></span></li>
<li class="list-group-item"><i class="fas fa-dice-three text-primary"></i> Dolaşımdaki Arz : <span class="float-right" style="font-weight: bold;"><?php echo $coin_dolasimdaki_arz;?></span></li>
<li class="list-group-item"><i class="fas fa-dice-four text-primary"></i> Maksimum Arz : <span class="float-right" style="font-weight: bold;"><?php echo $coin_max_arz;?></span></li>
<li class="list-group-item"><i class="fas fa-dice-five text-primary"></i> Toplam Arz : <span class="float-right" style="font-weight: bold;"><?php echo $coin_toplam_arz;?></span></li>
<li class="list-group-item"><i class="fas fa-percentage text-primary"></i> Dolaşımdaki Arz Yüzdesi : <span class="float-right" style="font-weight: bold;"><?php echo yuzde($coin_toplam_arz,$coin_dolasimdaki_arz);?></span></li>
<li class="list-group-item"><i class="fas fa-calendar-alt text-primary"></i> En Yüksek Fiyat : <span class="float-right" style="font-weight: bold;">$<?php echo $coin_ath_usd;?></span></li>
<li class="list-group-item"><div class="row"><span class="col-md-4" style="font-weight: bold;"><i class="fa fa-subscript text-danger"></i><?php echo $coin_24_saat_dusuk;?></span><span class="col-md-4" style="font-weight: bold;text-align: right;"> <i class="fa fa-superscript text-success"></i><?php echo $coin_24_saat_yuksek;?></span></div></li>
<div></div></ul>

</div>
</div> 
</body>
</html>

  
