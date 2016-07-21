<form method="POST"  class="form-horizontal" role="form" name="formAjoutNote" style="margin-top : 10px; margin-bottom :20px;" ng-submit="addModNote()">
    <!-- #section:elements.form.input-state -->

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="matiere">Mati&egrave;re</label>

        <div class="col-sm-9">
            <input  type="text" ng-model="note.matiere"  name="matiere" placeholder="Mati&egrave;re" ng-disabled="true">
        </div>
    </div>

   <div class="form-group" >
        <label class="col-sm-3 control-label no-padding-right" for="type">Type</label>

        <div class="col-sm-9">
            <select class="select-md"  ng-model="note.id_type_examen" ng-disabled="note.id_note !=null" required>
                <option> </option>
                <option value="1">CC</option>
                <option value="2" ng-show="noteCompObject.noteComp ==-1">Composition</option>
            </select>
        </div>
    </div>
      <div class="form-group">
          <label class="col-sm-3 control-label no-padding-right" for="libelle">Libell&eacute;</label>

        <div class="col-sm-9">
            <input  type="text" ng-model="note.libelle"  name="libelle" placeholder="Libell&eacute;" required>
        </div>
    </div>
    
  <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="note">Note</label>

        <div class="col-sm-9">
            <input   type="text" ng-model="note.note"  name="note" placeholder="Note" required>
        </div>
    </div>
    

<div class="clearfix" style="margin-top : 50px">
    <div class="col-md-offset-3 col-md-9">
        <input type="submit"  class="btn btn-primary submit-button" value="Valider"/>
                        &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp;
        <button type="reset" class="btn" ng-click="annulerNote()">
            <i class="ace-icon fa fa-undo bigger-110"></i>
            Annuler
        </button>
    </div>

</div>
</form>
