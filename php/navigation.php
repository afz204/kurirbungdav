<nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
    <a class="navbar-brand" href="#"><?=$device['device'] == 'MOBILE' ? 'BD Indonesia' : 'Bunga Davi Indonesia'?></a>
    <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item>
                <a style="text-transform: capitalize;" class="nav-link" href="<?=URL?>"><span class="sr-only">(current)</span></a>
            </li>
        </ul>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="<?=URL?>logout">Sign out</a>
            </li>
        </ul>
    </div>
</nav>
