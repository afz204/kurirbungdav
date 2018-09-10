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
      		<tr class="images">
      			<td>
      				<img src="<?=URL?>assets/images/product/the_beautifully_flowers.jpg" class="img img-responsive img-rounded">
      			</td>
      		</tr>
      		<tr class="title">
      			<td>Detail Pengiriman</td>
      		</tr>
      		<tr>
      			<table class="detail">
      				<tr class="title">
      					<td id="1">Kirim Ke </td>
      					<td id="2">: </td>
      					<td id="3">Rumah Mantan </td>
      				</tr>
      				<tr class="title">
      					<td id="1">Alamat </td>
      					<td id="2">: </td>
      					<td id="3">Jalan Kenangan indah nomor 2 </td>
      				</tr>
      				<tr class="title">
      					<td id="1">Kelurahan </td>
      					<td id="2">: </td>
      					<td id="3">Pondok Bambu </td>
      				</tr>
      				<tr class="title">
      					<td id="1">Kecamatan </td>
      					<td id="2">: </td>
      					<td id="3">Duren Sawit </td>
      				</tr>
      				<tr class="title">
      					<td id="1">Kota </td>
      					<td id="2">: </td>
      					<td id="3">Jatinegara </td>
      				</tr>
      				<tr class="title">
      					<td id="1">Nomor HP </td>
      					<td id="2">: </td>
      					<td id="3">082210364609 </td>
      				</tr>
      				<tr class="title">
      					<td id="1">Notes </td>
      					<td id="2">: </td>
      					<td id="3">Silahkan kirim sesuai orderan saja ya. </td>
      				</tr>
      				<tr class="button">
      					<td colspan="3" id="1">
      						<div class="btn-group" role="group" aria-label="Basic example">
					            <button type="button" class="btn btn-sm btn-outline-success">Success</button>
					            <button type="button" class="btn btn-sm btn-outline-danger">Return </button>
					        </div>
      					</td>
      				</tr>
      			</table>
      		</tr>
      	</table>
      </div>
  </main>