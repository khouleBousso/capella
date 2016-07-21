  <form class= "form-horizontal"   style="margin-top : 10px; margin-bottom :20px; " enctype="multipart/form-data"  >
       <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right">
                <span class="inline space-24 hidden-480"></span>
                Intitul&eacute; 
            </label>

            <div class="col-sm-9">
                <textarea  class="form-textarea col-xs-7" contenteditable="true" placeholder="Intitul&eacute;" ng-model="document.intitule"></textarea>
            </div>
        </div>

      
        <div class="hr hr-18 dotted"></div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="inputClasse">Classe</label>

            <div class="col-sm-9">
                <select name="classe" id="classe" class="col-xs-7" ng-model="document.classe" ng-options="classe.nom for classe in classes" ng-change="changeClasse()"> 
                </select>
            </div>
        </div>
        <div class="hr hr-18 dotted"></div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="inputMatiere">Mati&egrave;re</label>

            <div class="col-sm-9">
                <select name="matiere" id="matiere" class="col-xs-7" ng-model="document.matiere" ng-options="matiere.nom for matiere in matieres" > 
                </select>
            </div>
        </div>
        
          <div class="hr hr-18 dotted"></div>

        <div class="form-group" id="groupeCours">
            <label class="col-sm-3 control-label no-padding-right">Cours</label>

            <div class="col-sm-9">
                <input  type="text" ng-model="upload.cours.name"  name="document" placeholder="Cours" ng-click="launchCours()" class="col-xs-7">
            </div>
        </div>
          
        <div class="form-group" id="groupeExamen">
            <label class="col-sm-3 control-label no-padding-right">Examen</label>

            <div class="col-sm-9">
                <input  type="text" ng-model="upload.examen.name"  name="document" placeholder="Examen" ng-click="launchExamen()" class="col-xs-7">
            </div>
        </div>
          
          
        <div class="form-group" id="groupeCorrige">
            <label class="col-sm-3 control-label no-padding-right">Corrig&eacute;</label>

            <div class="col-sm-9">
                <input  type="text" ng-model="upload.corrige.name"  name="document" placeholder="Corrig&eacute;" ng-click="launchCorrige()" class="col-xs-7">
            </div>
        </div>
          
        <div class=" clearfix" style="margin-top : 50px">
            <div class="col-md-offset-3">
                <button type="button" class="btn btn-info" ng-click="ajoutDocument()">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    Ajouter
                </button>

                &nbsp; &nbsp; &nbsp;
                <button type="reset" class="btn" ng-click="annulerDocument()">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    Annuler
                </button>
            </div>

        </div>
        <input type="file" name="iconeCours" fileavatar="upload.cours"  id="iconeCours" style="display : none">
        <input type="file" name="iconeExamen" fileavatar="upload.examen"  id="iconeExamen" style="display : none">
        <input type="file" name="iconeCorrige" fileavatar="upload.corrige"  id="iconeCorrige" style="display : none">
    </form>