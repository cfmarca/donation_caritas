<div style="text-align: center;">

    <div class="alert alert-danger" role="alert">
        <p>Estimado(a) <strong>
                <?php if(isset ($firstname)) {echo $firstname." ".$lastname;} else {echo "donante";} ?></strong> también
            puedes realizar tu donativo a las siguientes cuentas bancarias.</p>
    </div>

    <div>
        <div class="form-row">

            <div class="form-group col-12 col-sm-12 col-md-12">
                <p>NIT: 121391027</p>
                <p>A nombre de: Caritas Boliviana</p>
                <hr />
            </div>

            <div class="form-group col-12 col-sm-12 col-md-4">
                <img src="<?php echo base_url() ?>/images/logo_bnb.png" alt="BNB" height="50"
                    style="background-color: green;">
                <br />
                <br />
                <div>
                    <p><strong>Banco Nacional de Bolivia</strong></p>
                    <p>Moneda: Bolivianos</p>
                    <p>Cuenta: 100 – 0257199</p>
                </div>
            </div>

            <div class="form-group col-12 col-sm-12 col-md-4">
                <img src="<?php echo base_url() ?>/images/logo_bcp.png" alt="BCP" height="50"
                    style="background-color: white;">
                <br />
                <br />
                <div>
                    <p><strong>Banco de Crédito de Bolivia</strong></p>
                    <p>Moneda: Bolivianos</p>
                    <p>Cuenta: 201 – 5044277 - 3 - 24</p>
                </div>
            </div>

            <div class="form-group col-12 col-sm-12 col-md-4">
                <img src="<?php echo base_url() ?>/images/logo_bcp.png" alt="BCP" height="50"
                    style="background-color: white;">
                <br />
                <br />
                <div>
                    <p><strong>Banco de Crédito de Bolivia</strong></p>
                    <p>Moneda: Dólares</p>
                    <p>Cuenta: 201 – 5015330 - 2 - 21</p>
                </div>
            </div>

            <div class="form-group col-12 col-sm-12 col-md-12">
                <hr />
                <input type="button" name="home" class="home btn btn-outline-secondary" value="Inicio"
                    onclick="window.location='<?php echo base_url(); ?>';" />
            </div>

        </div>
    </div>
</div>