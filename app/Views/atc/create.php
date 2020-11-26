<form id="form_bcpqr" validate action="<?= base_url('atc') ?>" method="post">

    <fieldset>

        <div class="alert alert-danger" role="alert" style="text-align: center;">
            <h4>Datos de contacto</h4>
        </div>

        <div class="form-group col-12 col-sm-12 col-md-6">
            <label for="country">País de residencia</label>
            <select class="form-control" id="country" ng-model="country" ng-true-value="Bolivia"
                onChange="mostrar(this.value)">
                <option>Argentina</option>
                <option selected>Bolivia</option>
                <option>Brasil</option>
                <option>Chile</option>
                <option>Colombia</option>
                <option>Costa Rica</option>
                <option>Cuba</option>
                <option>Ecuador</option>
                <option>El Salvador</option>
                <option>España</option>
                <option>Estados Unidos</option>
                <option>Guatemala</option>
                <option>Haiti</option>
                <option>Honduras</option>
                <option>Mexico</option>
                <option>Nicaragua</option>
                <option>Paraguay</option>
                <option>Panamá</option>
                <option>Perú</option>
                <option>Puerto Rico</option>
                <option>República Dominicana</option>
                <option>Uruguay</option>
                <option>Venezuela</option>
            </select>
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
            <h4>Datos de la Tarjeta</h4>
        </div>

        <div class="form-group col-12 col-sm-12 col-md-6">
            <label for="card">Tipo de Tarjeta</label>
            <select class="form-control" id="card" name="card">
                <option value="VISA" selected>VISA</option>
                <option value="VISA" selected>MASTERCARD</option>
            </select>
        </div>

        <div class="form-group col-12 col-sm-12 col-md-6">
            <label for="numberCard">Número de Tarjeta</label>
            <input type="text" class="form-control" id="numberCard" name="numberCard"
                placeholder="Digite el número de su tarjeta">
            <div class="invalid-feedback">
                Este campo es obligatorio.
            </div>
        </div>

        <div class="form-group col-12 col-sm-12 col-md-6">
            <label for="expiration">Fecha de Vencimiento</label>
            <input type="text" class="form-control" id="expiration" name="expiration"
                placeholder="Digite la fecha de vencimiento">
            <div class="invalid-feedback">
                Este campo es obligatorio.
            </div>
        </div>

        <div class="form-group col-12 col-sm-12 col-md-6">
            <label for="cvvCode">Código CVV o CVC</label>
            <input type="text" class="form-control" id="cvvCode" name="cvvCode"
                placeholder="Digite el código CVV o CVC">
            <div class="invalid-feedback">
                Este campo es obligatorio.
            </div>
        </div>

        <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <label for="coin">Moneda</label>
            <select class="form-control" id="coin" name="coin">
                <option value="BOB" selected>Bolivianos</option>
                <option value="USD" selected>Dólares</option>
            </select>
        </div>

        <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <label for="amount">Monto</label>
            <input type="text" name="amount" id="amount" class="form-control" required>
        </div>

        <hr />
        <input type="button" name="previous" class="previous btn btn-outline-secondary" value="Previo" />
        <input type="submit" name="submit" class="submit btn btn-danger" value="Donar" id="submit" />

    </fieldset>

</form>