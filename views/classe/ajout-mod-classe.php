<form  class="form-horizontal" style="margin-top : 10px; margin-bottom :20px; ">
    <!-- #section:elements.form.input-state -->

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="inputCodeClasse">Code classe</label>

        <div class="col-sm-9">
            <input  type="text" ng-model="classe.code_classe" placeholder="Code">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="inputNom">Nom de la classe</label>

        <div class="col-sm-9">
            <input  type="text" ng-model="classe.nom" placeholder="Nom">
        </div>
    </div>
    <div class="form-group">

        <label class="col-sm-3 control-label no-padding-right" for="inputCycle">Cycle</label>

        <div class="col-sm-4">
            <select class=" form-control "  id="form-field-select-3" data-placeholder="Choisir le cycle... " ng-model="classe.id_cycle">
                <option value="">  </option>
                <?php
                try {
                    $bdd = new PDO('mysql:host=91.216.107.161;dbname=capel646515', 'capel646515', 'Su4wcTgW', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' ));
                } catch (Exception $e) {
                    die('Erreur : ' . $e->getMessage());
                }
                $reponse = $bdd->query("SELECT id_cycle,libelle_cycle from cycle");
                while ($donnees = $reponse->fetch()) {
                    echo '<option value="' . $donnees['id_cycle'] . '" >' . $donnees['libelle_cycle'] . '</option>';
                }
                ?>
            </select> 
        </div>
    </div>
  

</div>

<div class="clearfix" style="margin-top : 50px">
    <div class="col-md-offset-3 col-md-9" ng-show="classe.id_classe == null">
        <button type="button" class="btn btn-info" ng-click="ajoutClasse()">
            <i class="ace-icon fa fa-check bigger-110"></i>
            Ajouter
        </button>

        &nbsp; &nbsp; &nbsp;
        <button type="reset" class="btn" ng-click="annulerClasse()">
            <i class="ace-icon fa fa-undo bigger-110"></i>
            Annuler
        </button>
    </div>
    <div class="col-md-offset-3 col-md-9" ng-show="classe.id_classe != null">
        <button type="button" class="btn btn-info" ng-click="modifierClasse()">
            <i class="ace-icon fa fa-check bigger-110"></i>
            Modifier
        </button>

        &nbsp; &nbsp; &nbsp;
        <button type="reset" class="btn" ng-click="annulerModifClasse()">
            <i class="ace-icon fa fa-undo bigger-110"></i>
            Annuler
        </button>
    </div>
</div>
</form>

