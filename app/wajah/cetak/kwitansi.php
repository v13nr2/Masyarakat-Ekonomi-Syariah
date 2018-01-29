<html>
<head>
<?php

if(!empty($margin)){
  foreach($margin as $k){
    $batasatas = $k->batasatas;
    $batasbawah = $k->batasbawah;
    $bataskanan = $k->bataskanan;
    $bataskiri = $k->bataskiri;
  }
}
if(!empty($organisasi)){
  foreach($organisasi as $k){
    $alamat = $k->alamat;
    $gambar = base_url()."assets/uploads/".$k->nm_gbr;
  }
}
$px_atas = $batasatas*2.02 * 100;
$px_bawah = $batasbawah*2.02 * 100;
$px_kanan = $bataskanan*2.02 * 100;
$px_kiri = $bataskiri*2.02 * 100;
?>	
</head>


<style>
body {
    margin-top: <?php echo $px_atas;?>px;
    margin-bottom: <?php echo $px_bawah;?>px;
    margin-right: <?php echo $px_kanan;?>px;
    margin-left: <?php echo $px_kiri;?>px;
}
</style>	
</head>
<body>

        <table width="100%" border="0" style="background-color:#FFFFFF;" >
          <tr>
            <td width="50%" valign="top"><img src="<?php echo $gambar;?>" height="100px"> </td>
            <td><div align="right"><?php echo $alamat;?>
        	</div></td>
          </tr>
        </table><br>
        <table width="100%" border="1" style="background-color:#FFFFFF; border-collapse:collapse" >
          <tr>
            <td width="30%" valign="top">Nomor : <br><i>Number</i> </td>
            <td width="30%"><div align="center"><span style1="font-size: 28px"><b>KWITANSI</b></span></div></td>
            <td width="30%">Tanggal : <br><i>Date</i></td>
          </tr>
        </table><br>
        <table width="100%" border="1" style="background-color:#FFFFFF; border-collapse:collapse" ><tr><td>
            <table width="95%" border="0" style="background-color:#FFFFFF;" >
              <tr>
                <td width="30%" valign="top">Sudah diterima dari  <br><i>Received from</i> </td>
                <td width="5%">:</td>
                <td width="60%">PT. BANK SYARIAH MANDIRI</td>
              </tr>
              <tr>
                <td width="30%" valign="top">Jumlah  <br><i>Amount</i> </td>
                <td width="5%">:</td>
                <td width="65%">7.500.000</td>
              </tr>
            </table>
        
    </td></tr><tr><td></table>
        <table width="100%" border="1" style="background-color:#FFFFFF; border-collapse:collapse" ><tr><td>
            <table width="95%" border="0" style="background-color:#FFFFFF;" >
              <tr>
                <td width="30%" valign="top">Untuk Pembayaran <br><i>Payment for</i> </td>
                <td width="5%">:</td>
                <td width="60%"> </td>
              </tr>
            </table>
            <table width="95%" border="0" style="background-color:#FFFFFF;" >
              <tr>
                  <td width="5%"></td>
                <td width="60%" valign="top"> <table width="200px" border="1" style="background-color:#FFFFFF; border-collapse:collapse" ><tr><td> 7.500.000</td></tr></table>
                </td>
              </tr>
              <tr>
                  <td width="5%"></td>
                <td width="60%" valign="top"> 
                     <input type="checkbox" name="cash" value="Cash">Cash
                     <input type="checkbox" name="chequw" value="Cash">Cheque
                     <input type="checkbox" name="bilyet" value="Cash">Bilyet Giro
                </td>
              </tr>
            </table><br><br>
            <table width="95%" border="0" style="background-color:#FFFFFF;" >
              <tr>
                 <td width="60%">Kwitansi ini dianggap sah setelah pembayaran dengan cek/bilyet giro telah diuangkan.</td>
                <td width="20%" valign="top" align="center">     (Ari Permana)           </td>
                <td width="20%" valign="top" align="center">      (Dewi Novita Sari)          </td>
              </tr>
            </table><br>
        </tr></td>
    </td></tr></table>

</body>	
</html>