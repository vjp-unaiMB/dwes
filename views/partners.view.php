<?php include __DIR__.'/partials/inicio-doc.part.php'; ?>
<?php include __DIR__.'/partials/nav.part.php'; ?>

<!-- Principal Content Start -->
    <div id="asociados">
   	    <div class="container">
   	        <div class="col-xs-12 col-sm-8 col-sm-push-2">
                <h1>ASOCIADOS</h1>
                <hr>
                <!-- Combruebo a ver si estoy recibiendo los datos del formulario -->
                <?php if($_SERVER["REQUEST_METHOD"] == 'POST') : ?>
                    <div class="alert alert-<?=empty($errores)?'info' : 'danger';?> alert-dismissibre" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hiddej="true">x</span>
                        </button>
                        <?php if(empty($errores))  : ?>
                            <p><?= $mensaje ?></p>   
                        <?php else : ?>
                            <ul>
                                <?php foreach ($errores as $error) : ?>
                                    <li><?= $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF'] ?>">
                <div class="form-group">
                        <div class="col-xs-12">
                            <label class="label-control">Nombre</label>
                            <input class="form-control-file" type="text" name="nombre">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label class="label-control">Logo</label>
                            <input class="form-control-file" type="file" name="imagen">
                        </div>
                    </div>
                    <div class="from-group">
                        <div class="col-xs-12">
                            <label class="label-control">Descripción</label>
                            <textarea class="form-control" name="descripcion"><?= $descripcion ?></textarea>
                            <button class="pull-right btn btn-lg sr-button">ENVIAR</button>
                        </div>
                    </div>
                </form>
                <hr class="divider">
                <div class="imagenes_galeria">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Logo</th>
                                
                            </tr>
                        </thead>
                        <?php foreach ($partners as $partner) : ?>
                            <tr>
                                <th scope="row"><?=$partner->getId()?></th>
                                <td><?= $partner->getNombre() ?></td>
                                <td>
                                    <img src="../<?= Partner::RUTA_LOGOS . $partner->getLogo()  ?>" width="100px">
                                </td>
                                

                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>    
	            </div>
	        </div>   
   	    </div>
    </div>
    <!-- Principal Content Start -->
<?php include __DIR__.'/partials/fin-doc.part.php'; ?>
