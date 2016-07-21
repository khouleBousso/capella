<form  class="form-horizontal" style="margin-top : 10px; margin-bottom :20px; ">
    <!-- #section:elements.form.input-state -->
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="inputOperaton">Op&eacute;ration</label>

        <div class="col-sm-9">
            <select name="operation" id="operation" class="input-medium" ng-model="facture.description">
                <option value="">------------------</option>
                <option value="scolarite"> Facture Scolarit&eacute;</option>
                <option value="transport"> Facture Transport</option>
                <option value="sport">Facture Sport</option>
                <option value="tenue">Facture Tenue</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="inputLibelle">Libelle</label>

        <div class="col-sm-9">
            <textarea placeholder="Libell&eacute" ng-model="facture.libelle">
            </textarea>
        </div>
    </div>

    <div class="form-group" id="groupeMontant">
        <label class="col-sm-3 control-label no-padding-right" for="inputMontant">Montant</label>

        <div class="col-sm-9">
            <input  type="text" ng-model="facture.montant" placeholder="Montant" ng-blur="changeMontant()" name="montant" id="Montant">
        </div>
    </div>


    <div class="form-group">
        <label class="col-xs-12 col-sm-3 control-label no-padding-right" for="inputDate">Date</label>

        <div class="col-sm-4">
            <input ng-model="facture.date_payement" type="text" id="date_naissance" class="form-control input-mask-date" placeholder="Date">
        </div>
    </div>
</div>

<div class="clearfix" style="margin-top : 50px">
    <div class="col-md-offset-3 col-md-9">
        <button type="button" class="btn btn-info" ng-click="ajoutAllFacture()">
            <i class="ace-icon fa fa-check bigger-110"></i>
            Ajouter
        </button>

        &nbsp; &nbsp; &nbsp;
        <button type="reset" class="btn" ng-click="annulerAllFacture()">
            <i class="ace-icon fa fa-undo bigger-110"></i>
            Annuler
        </button>
    </div>

</div>
</form>
<script type="text/javascript">
    jQuery(function ($) {
        $('.input-mask-date').mask('99/99/9999');
    });
</script>