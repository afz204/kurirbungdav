<?php 
    $arrstatus = [
        'New Jobs',
        'On Delivery',
        'Success',
        'Return'
    ];
    $newjobs = $config->ProductsJoin('kurir_jobs.Status as StatusAcepted, kurir_jobs.StatusKirim as StatusDelivery, transaction.*, provinces.name as ProvinsiName, regencies.name as KotaName, districts.name as Kecamatan, villages.name as Kelurahan', 'kurir_jobs', 'LEFT JOIN transaction on transaction.transactionID = kurir_jobs.TransactionNumber LEFT JOIN provinces ON provinces.id = transaction.provinsi_id LEFT JOIN regencies on regencies.id = transaction.kota_id LEFT JOIN districts ON districts.id = transaction.kecamata_id LEFT JOIN villages on villages.id = transaction.kelurahan_id', " WHERE kurir_jobs.KurirID = '". $datakurir['id'] ."' AND kurir_jobs.StatusKirim NOT IN (1, 2, 3)");

?>
<style>
    table {
        display: block;
        width: 100%;
    }
    table tr td {
        padding: 1%;
        font-size: 14px;
    }
    table tr td[id="1"] {
        width: 100px;
        font-weight: 500;
        vertical-align: top;
    }
    table tr td[id="2"] {
        width: 10px;
        text-align: center;
        vertical-align: top;
    }
    table tr td[id="3"] {
        width: 200px; 
        vertical-align: top;
    }
    table tr td[id="4"] {
        vertical-align: top;
        text-align: center;
        padding-bottom: 2%;
        border-bottom: 1px dashed #8e8a8a;
    }
    .badge {
        display: inline-block;
        padding: .30em .7em;
        font-size: 90%;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: .2rem;
    }
</style>
<main role="main" class="container">
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="border-bottom border-gray pb-2 mb-0">New Jobs</h6>
        <div class="media text-muted pt-3">
          <div class="row">
                <div class="content">
                
                    <?php while($row = $newjobs->fetch(PDO::FETCH_LAZY)) { 
                        if($row['StatusAcepted'] == 1) $infokirim = '<span class="badge badge-sm badge-success">Accept</span>';
                        if($row['StatusAcepted'] == 2) $infokirim = '<span class="badge badge-sm badge-danger">Reject</span>';
                        ?>
                        <table border="0">
                        <tr>
                            <td colspan="3">
                            <div class="title">
                                <a href="<?=URL?>index/?p=detail&order=<?=$row['transactionID']?>">OrderNumber #<?=$row['transactionID']?></a>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <td id="1">Status Jobs</td>
                            <td id="2">:</td>
                            <td id="3"><span class="badge badge-sm badge-info"><?=$arrstatus[$row['StatusDelivery']]?></span></td>
                        </tr>
                        <tr>
                            <td id="1">Kirim Ke</td>
                            <td id="2">:</td>
                            <td id="3"><span class="badge badge-primary"><?=$row['Kelurahan']?></span> </td>
                        </tr>
                        <tr>
                            <td id="1">Alamat</td>
                            <td id="2">:</td>
                            <td id="3"><?=$row['alamat_penerima']?></td>
                        </tr>
                        <tr>
                            <td id="1">Kelurahan</td>
                            <td id="2">:</td>
                            <td id="3"><?=$row['Kelurahan']?></td>
                        </tr>
                        <tr>
                            <td id="1">Kecamatan</td>
                            <td id="2">:</td>
                            <td id="3"><?=$row['Kecamatan']?></td>
                        </tr>
                        <tr>
                            <td id="1">Kota</td>
                            <td id="2">:</td>
                            <td id="3"><?=$row['KotaName']?></td>
                        </tr>
                        <?php if($row['StatusDelivery'] == 0) { ?>
                        <tr>
                            <td colspan="3" id="4">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" onclick="aceptedreject(1, '<?=$row['transactionID']?>')" class="btn btn-sm btn-outline-success">Accept</button>
                                <button type="button" onclick="aceptedreject(2, '<?=$row['transactionID']?>')" class="btn btn-sm btn-outline-danger">Reject </button>
                            </div>
                            </td>
                        </tr>
                        <?php } else { ?>
                        <tr>
                            <td colspan="3" id="4">
                            <?=$infokirim?>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                    <?php } ?>
                </div>
          </div>
        </div>
      </div>

      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="border-bottom border-gray pb-2 mb-0">History Jobs</h6>
        <div class="media text-muted pt-3">
          <img data-src="holder.js/32x32?theme=thumb&amp;bg=007bff&amp;fg=007bff&amp;size=1" alt="32x32" class="mr-2 rounded" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2232%22%20height%3D%2232%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2032%2032%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16585e38c22%20text%20%7B%20fill%3A%23007bff%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A2pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16585e38c22%22%3E%3Crect%20width%3D%2232%22%20height%3D%2232%22%20fill%3D%22%23007bff%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2211.546875%22%20y%3D%2216.9%22%3E32x32%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true" style="width: 32px; height: 32px;">
          <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
            <div class="d-flex justify-content-between align-items-center w-100">
              <strong class="text-gray-dark">Full Name</strong>
              <a href="#">Follow</a>
            </div>
            <span class="d-block">@username</span>
          </div>
        </div>
      </div>
    </main>