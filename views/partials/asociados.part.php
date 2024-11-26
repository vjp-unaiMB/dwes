<div class="last-box row">
    <div class="col-xs-12 col-sm-4 col-sm-push-4 last-block">
        <div class="partner-box text-center">
            <p>
            <i class="fa fa-map-marker fa-2x sr-icons"></i> 
            <span class="text-muted">35 North Drive, Adroukpape, PY 88105, Agoe Telessou</span>
            </p>
            <h4>Nuestros Asociados:</h4>
            <hr>

            <div class="text-muted text-left">
            <?php   print_r($partners) ;
                    shuffle($partners); 
                    for ($i=0; $i < 3; $i++) : ?>

                <ul class="list-inline">
                    <li><img src="../<?= Partner::RUTA_LOGOS . $partners[$i]->getLogo()  ?>" alt="logo" width="100px"></li>
                    <li><?= $partners[$i]->getNombre() ?></li>
                </ul>

            <?php endfor;?>
            </div>
        </div>
    </div>
</div>