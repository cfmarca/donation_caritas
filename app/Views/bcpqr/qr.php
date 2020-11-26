<div style="text-align: center;">

    <div class="alert alert-danger" role="alert">Estimado(a) <strong>
            <?php if(isset ($firstname)) {echo $firstname." ".$lastname;} else {echo "donante";} ?></strong> ahora
        ingresa a la aplicación de tu banco y escanea el código QR para realizar tu donativo. </div>

    <div>
        <img
            src="<?= base_url() ?> <?php if(isset ($qrimage)) {echo "/".$qrimage;} else {echo "/images/logo_simple.png";} ?>">
    </div>

    <div>
        <form id="form_donation" class="needs-validation" novalidate action="<?php echo base_url(); ?>" method="post">
            <hr />
            <div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        Desea recibir información de nuestro trabajo.
                    </label>
                </div>
            </div>
            <hr />
            <input type="submit" name="submit" class="submit btn btn-danger" value="Finalizar" id="submit" />
        </form>
    </div>
</div>