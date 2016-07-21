<form method="POST" class="form-horizontal" style="margin-top : 10px; margin-bottom :20px; ">
    <!-- #section:elements.form.input-state -->

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="code_matiere">Code Matiere</label>

        <div class="col-sm-9">
            <input  type="text" ng-model="matiere.code_matiere"  name="code_matiere" placeholder="Code Matiere">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="inputIntitule">Intitul&eacute;</label>

        <div class="col-sm-9">
            <input  type="text" ng-model="matiere.nom"  name="Intitule" placeholder="Intitule">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="Coefficient">Coefficient</label>

        <div class="col-sm-9">
            <input  type="text" ng-model="matiere.coef"  name="Coefficient" placeholder="Coefficient">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="Semestre">Professeur</label>
        <div class="col-sm-9">
            <select  chosen id="professeur" data-placeholder="Choisir un Professeur..." ng-model="matiere.professeur" ng-options="prof.id as (prof.nom +'  '+prof.prenom) for prof in professeurs">
            <option value=""></option>
           </select>
 
        </div>
    </div>
    <div class="clearfix" style="margin-top : 50px">
        <div class="col-md-offset-3 col-md-9" ng-show="matiere.id_matiere == null">
            <button type="button" class="btn btn-info" ng-click="ajoutMatiere()">
                <i class="ace-icon fa fa-check bigger-110"></i>
                Ajouter
            </button>

            &nbsp; &nbsp; &nbsp;
            <button type="reset" class="btn" ng-click="annulerMatiere()">
                <i class="ace-icon fa fa-undo bigger-110"></i>
                Annuler
            </button>
        </div>

        <div class="col-md-offset-3 col-md-9" ng-show="matiere.id_matiere != null">
            <button type="button" class="btn btn-info" ng-click="modifierMatiere()">
                <i class="ace-icon fa fa-check bigger-110"></i>
                Modifier
            </button>

            &nbsp; &nbsp; &nbsp;
            <button type="reset" class="btn" ng-click="annulerModifMatiere()">
                <i class="ace-icon fa fa-undo bigger-110"></i>
                Annuler
            </button>
        </div>
    </div>
</form>
