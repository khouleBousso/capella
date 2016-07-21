<form  class="form-horizontal" style="margin-top : 10px; margin-bottom :20px; ">
    <!-- #section:elements.form.input-state -->
    <div class="form-group">
        <br/>
        <p style="text-align:center;" ng-show="recue.id_recu != null"> Re&ccedil;u № : <strong style="border-bottom:1px dashed green">{{recue.id_recu}}</strong></p><br/>
     
        <label class="col-sm-3 control-label no-padding-right" for="inputOperaton">Op&eacute;ration</label>

        <div class="col-sm-9">
            <select name="operation" id="operation" class="input-medium" ng-model="recue.operation" ng-change="choseRecu()" >
                <option value="">------------------</option>
                <option value="scolarite"> Re&ccedil;u Inscription</option>
                <option value="scolarite"> Re&ccedil;u Scolarit&eacute;</option>
                <option value="transport"> Re&ccedil;u Transport</option>
                <option value="sport">Re&ccedil;u Sport</option>
                <option value="tenue">Re&ccedil;u Tenue</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <br/>
        <label class="col-sm-3 control-label no-padding-right" for="numero_facture">№ facture</label>

        <div class="col-sm-9">
            <select name="code" id="code" class="input-medium" 
                    ng-options="facture.code for facture in factureChosen track by facture.code" ng-disabled="recue.id_recu !=null"   ng-model="recue.facture" ng-change="getSolde()">

            </select> 
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="inputLibelle">Libell&eacute;</label>

        <div class="col-sm-9">
            <textarea placeholder="Libell&eacute" ng-model="recue.libelle">
            </textarea>
        </div>
    </div>



    <div class="form-group" id="groupeMontantVersement">
        <label class="col-sm-3 control-label no-padding-right" for="Versement">Versement</label>

        <div class="col-sm-9">
            <input  type="text" ng-model="recue.versement" placeholder="Versement" id="versement" ng-change="validateNumber('versement', 'groupeMontantVersement')">
        </div>
    </div>
	
	<div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="inputOperaton">Type</label>

        <div class="col-sm-9">
            <select name="operation" id="operation" class="input-medium" ng-model="recue.genre">
                <option value="">------------------</option>
                <option value="espece">Esp&egrave;ce</option>
                <option value="cheque">Ch&egrave;que</option>
                <option value="virement">Virement</option>
                <option value="orange money">Orange Money</option>
                <option value="wari">Wari</option>
		s<option value="Joni joni">Joni joni</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-xs-12 col-sm-3 control-label no-padding-right" for="inputDate">Date</label>

        <div class="col-sm-4">
            <input ng-model="recue.date_recu" type="text" id="date_naissance" class="form-control input-mask-date" placeholder="Date ">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="Solde">A payer</label>

        <div class="col-sm-9">
            <input  type="text" ng-model="recue.solde"  ng-disabled="true">
        </div>
    </div>

</div>

<div class="clearfix" style="margin-top : 50px">
    <div class="col-md-offset-3 col-md-9" ng-show="recue.id_recu == null">
        <button type="button" class="btn btn-info" ng-click="ajoutRecu()">
            <i class="ace-icon fa fa-check bigger-110"></i>
            Ajouter
        </button>

        &nbsp; &nbsp; &nbsp;
        <button type="reset" class="btn" ng-click="annulerRecu()">
            <i class="ace-icon fa fa-undo bigger-110"></i>
            Annuler
        </button>
    </div>

    <div class="col-md-offset-3 col-md-9" ng-show="recue.id_recu != null">
        <button type="button" class="btn btn-info" ng-click="modifierRecu()">
            <i class="ace-icon fa fa-check bigger-110"></i>
            Modifier
        </button>

        &nbsp; &nbsp; &nbsp;
        <button type="reset" class="btn" ng-click="annulerModifRecu()">
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