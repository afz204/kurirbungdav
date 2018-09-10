<?php
session_start();
require '../../config/api.php';
$config = new Admin();

$admin = $_SESSION['user_session'];
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $title = $_GET['title'];
        $submenu = $config->ProductsJoin('sub_menus.id, sub_menus.submenu, sub_menus.link, menus.menu', 'sub_menus',
            'INNER JOIN menus ON menus.id = sub_menus.id_menu', 'WHERE sub_menus.id_menu = '. $id);
        ?>
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card border-dark mb-3">
                    <div class="card-header bg-transparent border-dark">detail menu <?=$title?></div>
                    <div class="card-body">

                        <p>
                            <button class="btn btn-sm btn-primary addSubmenu" data-id="<?=$id?>" data-name="<?=$title?>" type="button"><span class="fa fa-fw fa-plus"></span> admin</button>
                        </p>
                        <table class="table table-bordered  table-condensed table-hover" style="text-transform: capitalize;">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">submenu</th>
                                <th scope="col">link</th>
                                <th scope="col">action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; while ($menu = $submenu->fetch(PDO::FETCH_LAZY)){ ?>
                            <tr style="text-transform: lowercase;">
                                <td><?=$i++?></td>
                                <td><?=$menu['submenu']?></td>
                                <td><?=$menu['link']?></td>
                                <td>
                                        <button class="btn btn-sm btn-danger delSubMenu" data-id="<?=$menu['id']?>" data-admin="<?=$admin?>" style="text-transform: uppercase; font-size: 10px; font-weight: 500;"><i class="fa fa-fw fa-trash"></i></button>

                                </td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php }else{ $id = ""; } ?>
