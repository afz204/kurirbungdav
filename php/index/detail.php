<?php 
    $arrstatus = [
        'New Jobs',
        'On Delivery',
        'Success',
        'Return'
    ];
    $data = $config->getData('kurir_jobs.Status as StatusAcepted, kurir_jobs.StatusKirim as StatusDelivery, transaction.*, provinces.name as ProvinsiName, regencies.name as KotaName, districts.name as Kecamatan, villages.name as Kelurahan', 'kurir_jobs LEFT JOIN transaction on transaction.transactionID = kurir_jobs.TransactionNumber LEFT JOIN provinces ON provinces.id = transaction.provinsi_id LEFT JOIN regencies on regencies.id = transaction.kota_id LEFT JOIN districts ON districts.id = transaction.kecamata_id LEFT JOIN villages on villages.id = transaction.kelurahan_id', " transaction.transactionID = '". $_GET['order'] ."'");
?>
<style type="text/css">
	.content {
		display: block;
		width: 100%;
	}
	.detail {
		display: block;
		width: 100%;
		border: 1px dashed #ebebeb;
		padding: 2%;
	}
	.images td {
		border: 1px dashed #ebebeb;
	}
	.images td img {
		display: block;
		width: 100%;
		padding: 2%;
	}
	.title td {
		font-size: 14px;
		font-weight: 500;
	}
	.detail tr td[id="1"] {
		width: 20%;
		vertical-align: top;
	}
	.detail tr td[id="2"] {
		width: 4%;
		vertical-align: top;
	}
	.detail tr td[id="3"] {
		width: 66%;
		vertical-align: top;
	}
	.button tr td[id="1"]{
		text-align: center;
	}
</style>
<main role="main" class="container">
      <div class="my-3 p-3 bg-white rounded shadow-sm">
      	<table class="content" border="0">
      		<tr class="title">
      			<td>Images Product</td>
      		</tr>
		<?php $product = $config->Products('id_product,product_name, transaction.delivery_date', "transaction_details LEFT JOIN transaction on transaction.transactionID = transaction_details.id_trx WHERE id_trx = '". $data['transactionID'] ."'");
				while($row = $product->fetch(PDO::FETCH_LAZY)) {
					$nameproduct = strtolower($row['product_name']);
					$nameproduct = str_replace(' ', '_', $nameproduct).'.jpg';
		?>
      		<tr class="images">
      			<td>
      				<img src="<?=URL_SERVER?>assets/images/product/<?=$nameproduct?>" class="img img-responsive img-rounded">
      			</td>
      		</tr>
				<?php } ?>
      		<tr class="title">
      			<td>Detail Pengiriman</td>
      		</tr>
      		<tr>
      			<table class="detail">
      				<tr class="title">
      					<td id="1">Nomor Invoice </td>
      					<td id="2">: </td>
      					<td id="3">#<?=$data['transactionID']?> </td>
      				</tr>
      				<tr class="title">
      					<td id="1">Tanggal Kirim</td>
      					<td id="2">: </td>
      					<td id="3"><?=$config->_formatdate($data['delivery_date'])?></td>
      				</tr>
      				<tr class="title">
      					<td id="1">Kirim Ke </td>
      					<td id="2">: </td>
      					<td id="3"><?=$data['nama_penerima']?> </td>
      				</tr>
      				<tr class="title">
      					<td id="1">Alamat </td>
      					<td id="2">: </td>
      					<td id="3"><?=$data['alamat_penerima']?> </td>
      				</tr>
      				<tr class="title">
      					<td id="1">Kelurahan </td>
      					<td id="2">: </td>
      					<td id="3"><?=$data['Kelurahan']?> </td>
      				</tr>
      				<tr class="title">
      					<td id="1">Kecamatan </td>
      					<td id="2">: </td>
      					<td id="3"><?=$data['Kecamatan']?> </td>
      				</tr>
      				<tr class="title">
      					<td id="1">Kota </td>
      					<td id="2">: </td>
      					<td id="3"><?=$data['KotaName']?> </td>
      				</tr>
      				<tr class="title">
      					<td id="1">Notes </td>
      					<td id="2">: </td>
      					<td id="3"><?=$data['delivery_marks']?></td>
      				</tr>
					  <?php if(isset($_GET['success']) && $_GET['success'] == 'true') { if($data['StatusDelivery'] != 2) { ?>
						<tr class="title">
								<td colspan="3" id="1" style="text-align: center; padding-top: 20px;">Input Images & Notes</td>
							</tr>
							<tr>
								<td colspan="3" id="1" style="border: 1px dashed red; border-radius: 20px; padding: 10px; ">
									<div class="form-group">
									<textarea class="form-control" id="notesuccess" rows="3" placeholder="input notes success"></textarea>
									</div>
								</td>
							</tr>
							<tr class="button">
								<td colspan="3" id="1" style="border: 1px dashed red; border-radius: 20px; padding: 10px; ">
								<form id="uploadImagesProduct" method="post" enctype="multipart/form-data" >
									<div class="form-group">
										<input type="hidden" id="ImagesProductID" name="ImagesProductID" value="<?=$data['transactionID']?>">
										<input type="hidden" id="ImagesName" name="ImagesName" value="success_<?=$data['transactionID']?>">
										<input type="hidden" id="urlserver" name="urlserver" value="<?=URL_SERVER?>">
										<div class="file-loading">
											<input type="file" id="images" name="images[]" multiple>
										</div>
										<br>
									</div>
								</form>
								<div id="kv-success-2" class="alert alert-success" style="margin-top:10px;display:none"></div>
								</td>
							</tr>
							<?php } else { ?>
								<tr class="button">
								<td colspan="3" id="1">
									<div class="btn-group" role="group" aria-label="Basic example">
										<button type="button" onclick="location.href='<?=URL?>'" class="btn btn-sm btn-outline-success">Back</button>
									</div>
								</td>
							</tr>
							<?php }  ?>
					  <?php } elseif(isset($_GET['success']) && $_GET['success'] == 'false') { 
						  if($data['StatusDelivery'] != 3) { ?>
							<tr class="title">
								<td colspan="3" id="1" style="text-align: center; padding-top: 20px;">Form Return</td>
							</tr>
							<tr class="button">
								<td colspan="3" id="1" style="border: 1px dashed red; border-radius: 20px; padding: 10px; ">
									<form methode="post" action="" id="formreturn">
									<div class="form-group">
									<textarea class="form-control" id="alasanreturn" rows="3" placeholder="input alasan return"></textarea>
									<input type="hidden" id="transactionID" value="<?=$data['transactionID']?>">
									</div>
									<button type="submit" class="btn btn-sm btn-block btn-primary">Submit Return</button>
									</form>
								</td>
							</tr>
					  <?php } else { ?>
						<tr class="button">
      					<td colspan="3" id="1">
      						<div class="btn-group" role="group" aria-label="Basic example">
					            <button type="button" onclick="location.href='<?=URL?>'" class="btn btn-sm btn-outline-success">Back</button>
					        </div>
      					</td>
      				</tr>
					  <?php }  ?>
					  <?php } else {  if($data['StatusAcepted'] == 0 && $data['StatusDelivery'] == 1) { ?>
					  <tr class="button">
      					<td colspan="3" id="1">
      						<div class="btn-group" role="group" aria-label="Basic example">
					            <button type="button" onclick="location.href='<?=URL?>index/?p=detail&order=<?=$data['transactionID']?>&success=true'" class="btn btn-sm btn-outline-success">Success</button>
					            <button type="button" onclick="location.href='<?=URL?>index/?p=detail&order=<?=$data['transactionID']?>&success=false'" class="btn btn-sm btn-outline-danger">Return </button>
					        </div>
      					</td>
      				</tr>
					  <tr class="button">
								<td colspan="3" id="1">
									<div class="btn-group" role="group" aria-label="Basic example">
										<button type="button" onclick="location.href='<?=URL?>'" class="btn btn-sm btn-outline-success">Back</button>
									</div>
								</td>
							</tr>
					  <?php } else { ?> 
						<tr class="button">
      					<td colspan="3" id="1">
      						<div class="btn-group" role="group" aria-label="Basic example">
					            <button type="button" onclick="location.href='<?=URL?>'" class="btn btn-sm btn-outline-success">Back</button>
					        </div>
      					</td>
      				</tr>
					  <?php } } ?>
      			</table>
      		</tr>
      	</table>
      </div>
  </main>