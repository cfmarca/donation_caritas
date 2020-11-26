<form id="form_bnbqr" validate action="<?= base_url() ?>/bnbqr/generateqr" method="post">

    <fieldset>


        <div class="form-group col-12 col-sm-12 col-md-6">
            <label for="firstname">Nombre(s)</label>
            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Escriba su nombre" value="Pepito">
        </div>

        <div class="form-group col-12 col-sm-12 col-md-6">
            <label for="lastname">Apellido(s)</label>
            <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Escriba su apellido" value="Perez">
        </div>

        <div class="form-group col-12 col-sm-12 col-md-6">
            <label for="email">Correo electrónico</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Escriba su correo" required value="pperez@correo.com">
        </div>

        <div class="form-group col-12 col-sm-12 col-md-6">
            <label for="phone">Teléfono </label>
            <input type="text" class="form-control" name="phone" id="phone" placeholder="Escriba su teléfono/celular" value="76543210">
        </div>

        <div class="form-group col-12 col-sm-12 col-md-6" ng-if="visible" id="departmentShow">
            <label for=" department">Departamento</label>
            <select class="form-control" id="department">
                <option value="BE">Beni</option>
                <option value="CB">Cochabamba</option>
                <option value="CH">Chuquisaca</option>
                <option value="LP" selected>La Paz</option>
                <option value="OR">Oruro</option>
                <option value="PD">Pando</option>
                <option value="PT">Potosi</option>
                <option value="SC">Santa Cruz</option>
                <option value="TJ">Tarija</option>
            </select>
        </div>

        <div class="form-group col-12 col-sm-12 col-md-6" ng-if="visible" id="locationShow">
            <label for="location">Localidad</label>
            <input type="text" class="form-control" name="location" id="location" placeholder="Escriba su localidad" value="La Paz">
        </div>

        <hr />
        <input type="button" name="home" class="home btn btn-outline-secondary" value="Inicio"
            onclick="window.location='<?php echo base_url(); ?>';" />
        <input type="button" name="next" class="next btn btn-outline-danger" value="Siguiente" />
    </fieldset>

    <fieldset>



        <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <label for="validity">Válido por</label>
            <select name="validity" id="validity" class="form-control">
                <option value="SINGLE" selected>Único uso</option>
                <option value="WEEK">Una semana</option>
                <option value="MONTH">Un mes</option>
                <option value="YEAR">Un año</option>
            </select>
        </div>

        <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <label for="reference">Referencia</label>
            <input type="text" name="reference" id="reference" class="form-control" required value="Donación">
        </div>

        <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <label for="amount">Monto</label>
            <input type="text" name="amount" id="amount" class="form-control" required value="20">
        </div>

        <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <label for="coin">Moneda</label>
            <!--         <input type="text" name="coin" id="coin"> -->
            <select name="coin" id="coin" class="form-control" required>
                <option value="BOB" selected>Bolivianos</option>
                <option value="USD">Dólares</option>
            </select>
        </div>

        <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <label for="date" hidden>Fecha de creación</label>
            <input type="datetime" name="date" id="date" value="<?php echo date('Y-m-d H:i:s')?>" hidden>
        </div>
        <hr />

        <input type="button" name="previous" class="previous btn btn-outline-secondary" value="Previo" />
        <input type="submit" value="Generar" class="btn btn-danger">
    </fieldset>
</form>