<form method="POST" class="form-horizontal" style="margin-top : 10px; margin-bottom :20px; ">
    <!-- #section:elements.form.input-state -->

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="code_transport">Code transport</label>

        <div class="col-sm-9">
            <input  type="text" ng-model="transport.code_transport"  name="code_transport" placeholder="Itineraire">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="inputMensualite">Mensualite</label>

        <div class="col-sm-9">
            <input  type="text" ng-model="transport.mensualite"  name="mensualite" placeholder="Montant">
        </div>
    </div>


    <div class="clearfix" style="margin-top : 50px">
        <div class="col-md-offset-3 col-md-9" ng-show="transport.id_transport == null">
            <button type="button" class="btn btn-info" ng-click="ajoutTransport()">
                <i class="ace-icon fa fa-check bigger-110"></i>
                Ajouter
            </button>

            &nbsp; &nbsp; &nbsp;
            <button type="reset" class="btn" ng-click="annulerTransport()">
                <i class="ace-icon fa fa-undo bigger-110"></i>
                Annuler
            </button>
        </div>

        <div class="col-md-offset-3 col-md-9" ng-show="transport.id_transport != null">
            <button type="button" class="btn btn-info" ng-click="modifierTransport()">
                <i class="ace-icon fa fa-check bigger-110"></i>
                Modifier
            </button>

            &nbsp; &nbsp; &nbsp;
            <button type="reset" class="btn" ng-click="annulerModTransport()">
                <i class="ace-icon fa fa-undo bigger-110"></i>
                Annuler
            </button>
        </div>
    </div>
</form>
