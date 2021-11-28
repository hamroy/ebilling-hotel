<html>
<style type="text/css">

body {
    margin: 0.1in;
}
#kiri {
    width: 40%;
    float: left;
    padding: 10px;
}
#kanan {
    width: 80%;
    padding: 30px;
     float: center;
}

h1, h2, h3, h4, h5, h6, li, blockquote, p, th, td {
    font-family: Helvetica, Arial, Verdana, sans-serif; /*Trebuchet MS,*/
}
h1, h2, h3, h4 {
    color: #000000;
    font-weight: normal;
}
h4, h5, h6 {
    color: #000000;
}
h2 {
    margin: 0 auto auto auto;
    font-size: x-large;
}
li, blockquote, p, th, td {
    font-size: 80%;
}
ul {
    list-style: url(/img/bullet.gif) none;
}

#footer {
    border-top: 1px solid #000000;
    text-align: right;
}

table, th, td {
   /* border: 1px solid black; */
    border-collapse: collapse;
    font-family: "Trebuchet MS", Arial, sans-serif;
    color: black;    
}
td, th {
    padding: 4px;
}

P.breakhere {page-break-after: always}
</style>
 <body>
  
  
   <div class="page-header" style="padding:10px">
   <br/>
        <h2 align="center"> ROOM RESERVATION</h2>
        <h3 align="center"> <?=$namapt?></h3>
        </div>
	<h4>Your Payment Details</h4>
    <hr/>

 <table border="0" width="100%" >
	<tr>
		<th colspan="9" align="left"><img align="left" src="<?php echo base_url();?>images/<?=$s?>.png" width="150" /><h4><b></b></h4></th>
	</tr>
	<tr><td></td></tr>
	<tr>
		<th class="warning" align="left" width="30%">Nota.no</th>
		<th colspan="8" align="left">: <?php if($h_row->tipe=='K'){ echo'DC'; }else{ echo 'DT' ;} ?><?=$h_row->nota?></th>
	</tr>
	<tr>
		<th class="warning" align="left">Name of the guest</th>
		<th colspan="8" align="left">: <?=$h_row->nama?></th>
	</tr>
	
	<tr>
	<?php
	/////MEngambil bulan dari tanggal
	
	$ti=substr($h_row->cekin,'0','2');
	$bi=substr($h_row->cekin,'3','2');
	$bln=array(
	'01'=>'Januari',
	'02'=>'Februari',
	'03'=>'Maret',
	'04'=>'April',
	'05'=>'Mei',
	'06'=>'Juni',
	'07'=>'Juli',
	'08'=>'Agustus',
	'09'=>'September',
	'10'=>'Oktober',
	11=>'November',
	12=>'Desember',
	);

	$thi= substr($h_row->cekin,'6','4');
	?>
		<td class="warning">Check in date</td>
		<td>: <?=$ti.' '.'<b>'.$bln[$bi].'</b>'.' '.$thi?>&nbsp;&nbsp;&nbsp;&nbsp;<?=substr($h_row->cekin,'11')?> ( WIB )</td>
		<td></td>
	</tr>
	
	<tr>
	<?php
	/////MEngambil bulan dari tanggal
	
	$tc=substr($h_row->cekout,'0','2');
	$bc=substr($h_row->cekout,'3','2');
	$thc= substr($h_row->cekout,'6','4');
	?>
		<td class="warning">Check out date</td>
		<td>: <?=$tc.' '.'<b>'.$bln[$bc].'</b>'.' '.$thc?>&nbsp;&nbsp;&nbsp;&nbsp;<?=substr($h_row->cekout,'11')?> ( WIB )</td>
		<td colspan="2"></td>
	</tr>
	<tr>
		<td class="warning" align="justify">Rooms</td>
	
		
			
			<?php
			$pec=explode('-', $h_row->id_k); ////di pecah di masukkan dalam erray
			//echo $h_row->id_k;
		//	echo count($pec);
			$dd=0;
			$db=0;
			$fr=0;
			$js=0;
			$pa=0;
			for($i = 1; $i< count($pec); $i++){ 
			 $j=$this->Madmin->getjenikam($pec[$i])->row()->id_jkamar;
			// $jen=$j->row();
			 //$jenis=$jen->jenis_kamar;
			switch ($j){
				case '4'; ///Dulaxe Depan
				$dd=$dd+1;
				
				break;
				case '5'; ///Dulaxe Belakang
				$db=$db+1;
				
				break;
				
				case '2'; ///Famliy room
				$fr=$fr+1;
				
				break;
				case '3'; ///Famliy room
				$js=$js+1;
				
				break;
				case '1'; ///Paviliun
				$pa=$pa+1;
				
				break;
			}
			 }
			 
			 /////
			 ?>
			 	<td class="warning" align="justify">: <?=$dd+$db+$fr+$js+$pa?> Rooms :
			
			
		
			</td>
			<?php
			//////////////////////
			
			 	if($dd!=0){ ?>
			 	<tr >
			 	<td></td>
			 	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&diams;<?=$dd.' '.$this->db->get_where('tbl_jenis_kamar',array('id_jkamar'=>4))->row()->jenis_kamar?></td>
			 	
				<!--<li style="font-size: 15px"></li>-->
				</tr>
	
				<?php }
			 	
			 	//////
			 	
			 	if($db!=0){ ?>
			 	<tr >
			 	<td></td>
			 	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&diams; <?=$db.' '.$this->db->get_where('tbl_jenis_kamar',array('id_jkamar'=>5))->row()->jenis_kamar?></td>
			 	
				<!--<li style="font-size: 15px"></li>-->
				</tr>
				<?php }
				//////
			 	if($js!=0){ ?>
			 	<tr >
			 	<td></td>
			 	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&diams; <?=$js.' '.$this->db->get_where('tbl_jenis_kamar',array('id_jkamar'=>3))->row()->jenis_kamar?></td>
				</tr>
				<?php }
				//////
			 	if($fr!=0){ ?>
			 		<tr >
			 	<td></td>
			 	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&diams; <?=$fr.' '.$this->db->get_where('tbl_jenis_kamar',array('id_jkamar'=>2))->row()->jenis_kamar?> </td>
				</tr>
				<?php }
				//////
			 	if($pa!=0){ ?>
			 		<tr >
			 	<td></td>
			 	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&diams; <?=$pa.' '.$this->db->get_where('tbl_jenis_kamar',array('id_jkamar'=>1))->row()->jenis_kamar?> </td>
				</tr>
				<?php }
			 	?> 
			
		

	</tr>
	<tr>
	<?php
	/////MEngambil bulan dari tanggal
	
	$tt=substr($h_row->tanggal,'0','2');
	$bt=substr($h_row->tanggal,'3','2');
	$tht= substr($h_row->tanggal,'6','4');
	?>
		<td class="warning">Tanggal Deposit</td>
		<td colspan="3">: <?=$tt.' '.'<b>'.$bln[$bt].'</b>'.' '.$tht?>
		
		</td>

	</tr>
	<tr>
		<td class="warning">Nominal</td>
		<td colspan="3">: <?=number_format($h_row->nominal,0,',','.')?>
			<?php
			if($h_row->bank!='Cash'){
				echo '( '.$h_row->bank.' )';
			}
			 ?>
		</td>
		<?php
			if($h_row->bank!='Cash'){ ?>
				
				<tr>
		<td class="warning" >Nama Rekening Pengirim</td>
		<td colspan="3">: <?=$h_row->rek?>
		
		</td>

	</tr>
				
		<?php	}
			 ?>

	</tr>
	<tr>
		<td colspan="9"></td>
	</tr>
	
	</table>
<br/>

<br/>
  
</body>
</html>