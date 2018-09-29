<?php
/**
 * Created by PhpStorm.
 * User: small-project
 * Date: 10/04/2018
 * Time: 20.23
 */

session_start();
require '../../config/api.php';
$config = new Admin();

$admin = $config->adminID();

if($_GET['type'] == 'aceptedreject'){
    $a  = $_POST['TransactionID'];
    $b  = $_POST['Types'];

    $data = $config->getData('*', 'transaction', " transactionID = '". $a ."'");

    if($data) {
        if($b == 1) {
            $payment = $config->getData('*', 'delivery_charges', "id_kelurahan = '". $data['kelurahan_id'] ."'");

            if($payment) {
                
                $stmt = 'INSERT INTO pay_kurirs (no_trx, kurir_id, charge_id, total, created_at, admin_id) VALUES (:trx, :a, :b, :total, :c, :d)';
                $stmt = $config->runQuery($stmt);
                $stmt->execute(array(
                    ':trx'  => $a,
                    ':a'    => $admin,
                    ':b'    => $payment['id'],
                    ':total'=> $payment['price'],
                    ':c'    => $config->getDate('Y-m-d H:m:s'),
                    ':d'    => $admin
                ));
                $reff = $config->lastInsertId();
                $logs = $config->saveLogs($reff, $admin, 'c', 'accepted jobs');

                $update = $config->runQuery("UPDATE kurir_jobs SET Status = '1', StatusKirim = 1 WHERE TransactionNumber='". $a ."' AND Status = '' ");
                $update->execute();

                if($update) {
                    echo 'Success!';
                $logs = $config->saveLogs($a, $admin, 'u', 'transaction');

                } else {
                    echo 'Failed!';
                }

            } else {
                echo 'kelurahan belum terdaftar di database!';
            }
        } else {
            $update = $config->runQuery("UPDATE kurir_jobs SET Status = '2', StatusKirim = 0 WHERE TransactionNumber='". $a ."' AND Status = '' ");
            $update->execute();

            if($update) {
                echo 'Success!';
            $logs = $config->saveLogs($a, $admin, 'u', 'transaction');

            } else {
                echo 'Failed!';
            }
        }
    } else {
        echo 'Failed!';
    }
}
if($_GET['type'] == 'returnform'){
    $a  = $_POST['TransactionID'];
    $b  = $_POST['alasan'];
    
    $updatekurirjobs = $config->runQuery("UPDATE kurir_jobs SET StatusKirim = 3, Notes ='". $b ."' WHERE TransactionNumber ='". $a ."' ");
    $updatekurirjobs->execute();

    if($updatekurirjobs) {
        
        $logs = $config->saveLogs($a, $admin, 'u', 'kurir_jobs');

        $updatetransaction = $config->runQuery("UPDATE transaction SET statusOrder = '4', notes = '". $b ."'   WHERE transactionID ='". $a ."' ");
        $updatetransaction->execute();

        if($updatetransaction) {
            echo $config->actionMsg('u', 'transaction');
            $logs = $config->saveLogs($a, $admin, 'u', 'transaction');
        } else {
            echo 'Failed Transaction!';
        }

    } else {
        echo 'Failed Kurir Jobs!';
    }

    
}

?>