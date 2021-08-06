<?php print_r(error_get_last());
include('fonk.php');
 $sayfa = $_GET['page']; $site_url ="http://localhost/coingecko/";?>
<html lang="tr">
<head>
<title>Coingecko - uygulaması</title>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
 <div class="container"> 
 <div class="row">
 <div class="col-sm-10"></div>
  <div class="col-sm-2 float-sm-right"> 

 <a name="sayfa" href="<?php echo $site_url;?>?page=<?php if($sayfa>1){echo $sayfa-1;} elseif($sayfa==1){echo $sayfa;} else{echo "1";} ?>"><i class="m-1 float-sm-left fa tw-text-gray-700 dark:tw-text-white fa fa-angle-left fa-lg"></i></a>

 <a name="sayfa" href="<?php echo $site_url;?>?page=<?php if($sayfa>=1){echo $sayfa+1;}elseif($sayfa==''){echo '2';}else {echo "hata mata";}?>"><i class="m-1 float-sm-right fa tw-text-gray-700 dark:tw-text-white fa fa-angle-right fa-lg"></i></a></div>

</div>
<?php

$getir = file_get_contents("https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&order=market_cap_desc&per_page=100&page=$sayfa");
$getir = json_decode($getir);
?>
  <table id="kripto_tablo" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered"  width="100%">
            <thead>
            <tr>
                <th>No</th>
                <th>Kripto Adı</th>
                <th>Fiyat</th>
                <th>Piyasa Değeri</th>
                <th>% 24 Saat Değişim</th>

            </tr>
        </thead>
        <tbody>
  <?php $i= 0;
foreach ($getir as $key => $veriler){
$i++; 

?>
<tr>
<td><?php  if($sayfa>1){  $carp = $sayfa*100; echo $carp+$i;} elseif($sayfa==''){echo $i;} else { echo $i;}?></td>
<td><a href="<?php echo $site_url;?>detay.php?coin=<?php echo $veriler->id;?>"><img class="m-1" src="<?php echo $veriler->image;?>" width='18' height="18"><?php echo $veriler->name;?> </a> (<i class="fa fa-arrow-up text-success"></i><?php echo $veriler->high_24h;?> - <i class="fa fa-arrow-down text-danger"></i><?php echo $veriler->low_24h;?>)</td>
<td><?php echo number_format($veriler->current_price, 4, ',', '.');?></td>
<td>$<?php echo number_format($veriler->market_cap);?></td>
<td><div class="row"><?php if($veriler->price_change_percentage_24h>0){ ?><span class="col-md-6"><i class="fa fa-arrow-up text-success"></i></span> <span class="col-md-4"> <i class="fa fa-percentage"></i><?php echo number_format($veriler->price_change_percentage_24h, 2, ',', '.');?></span><?php } elseif($veriler->price_change_percentage_24h<0) { ?><span class="col-md-6"><i class="fa fa-arrow-down text-danger"></i> </span><span class="col-md-4"> <i class="fa fa-percentage"></i><?php echo number_format($veriler->price_change_percentage_24h, 2, ',', '.');?></span><?php } else { ?> <span class="col-md-6"><i class="fa fa-minus text-primary"></i></span> <span class="col-md-4"> <i class="fa fa-percentage"></i> <?php echo number_format($veriler->price_change_percentage_24h, 2, ',', '.');?></span><?php }?></div></td>
</tr>
<?php } ?>
</tbody>
        <tfoot>
        <tr>
                <th>No</th>
                <th>Kripto Adı</th>
                <th>Fiyat</th>
                <th>Piyasa Değeri</th>
                <th>% 24 Saat Değişim %</th>

            </tr>
        </tfoot>
    </table>
  


</div>

    <script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/> 
<script>
$(document).ready(function() {
    $('#kripto_tablo').DataTable( {
        responsive: true,
     "order": [[ 0, "asc" ]],
       "columnDefs": [
      { className: "text-right", "targets": [2,3] },
      { className: "text-center", "targets": [2] },
          ],
        "language": {

	"sProcessing":   "İşleniyor...",
	"sLengthMenu":   "Sayfada _MENU_ Kayıt Göster",
	"sZeroRecords":  "Eşleşen Kayıt Bulunmadı",
	"sInfo":         "  _TOTAL_ Kayıttan _START_ - _END_ Arası Kayıtlar",
	"sInfoEmpty":    "Kayıt Yok",
	"sInfoFiltered": "( _MAX_ Kayıt İçerisinden Bulunan)",
	"sInfoPostFix":  "",
	"sSearch":       "Bul:",
	"sUrl":          "",
	"oPaginate": {
		"sFirst":    "İlk",
		"sPrevious": "Önceki",
		"sNext":     "Sonraki",
		"sLast":     "Son"
	}
}        
    } );
} );
</script>    
</body>
</html>
