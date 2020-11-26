<form id="form_bcpqr" validate action="<?= base_url('atc') ?>" method="post">

    <fieldset>

        <div class="alert alert-danger" role="alert" style="text-align: center;">
            <h3>Datos de contacto</h3>
        </div>

        <div class="form-group col-12 col-sm-12 col-md-6">
            <label for="firstname">Nombre(s)</label>
            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Escriba su nombre">
        </div>

        <div class="form-group col-12 col-sm-12 col-md-6">
            <label for="lastname">Apellido(s)</label>
            <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Escriba su apellido">
        </div>

        <div class="form-group col-12 col-sm-12 col-md-6">
            <label for="email">Correo electrónico</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Escriba su correo" required>
        </div>

        <div class="form-group col-12 col-sm-12 col-md-6">
            <label for="phone">Teléfono </label>
            <input type="text" class="form-control" name="phone" id="phone" placeholder="Escriba su teléfono/celular">
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
            <input type="text" class="form-control" name="location" id="location" placeholder="Escriba su localidad">
        </div>

        <hr />
        <input type="button" name="home" class="home btn btn-outline-secondary" value="Inicio"
            onclick="window.location='<?php echo base_url(); ?>';" />
        <input type="button" name="next" class="next btn btn-outline-danger" value="Siguiente" />

    </fieldset>

    <fieldset>

        <div class="alert alert-danger" role="alert" style="text-align: center;">
            <h3>Datos de transacción</h3>
        </div>

        <div class="form-group col-12 col-sm-12 col-md-6">
            <label for="movil">Número de celular</label>
            <input type="text" class="form-control" id="movil" name="movil" placeholder="Digite su número de celular" required>
        </div>

        <div class="form-group col-12 col-sm-12 col-md-6">
            <label for="amount">Monto</label>
            <input type="text" class="form-control" id="amount" name="amount" placeholder="Digite un monto" required >
        </div>

        <hr />
        <input type="button" name="previous" class="previous btn btn-outline-secondary" value="Previo" />
        <input type="submit" name="submit" class="submit btn btn-danger" value="Donar" id="submit" />

    </fieldset>

</form>