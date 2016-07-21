<form method="POST"  class="form-horizontal" role="form" name="formAjoutPresence" style="margin-top : 10px; margin-bottom :20px;" ng-submit="addModPresence()">
    <!-- #section:elements.form.input-state -->

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="matiere">Mati&egrave;re</label>

        <div class="col-sm-9">
            <input  type="text" ng-model="presence.matiere"  name="matiere" placeholder="Mati&egrave;re" ng-disabled="true">
        </div>
    </div>

   <div class="form-group" >
        <label class="col-sm-3 control-label no-padding-right" for="type">Type</label>

        <div class="col-sm-9">
            <select class="select-md"  ng-model="presence.type_presence"  required>
                <option> </option>
                <option value="1">PRST</option>
                <option value="2">ABJ</option>
                <option value="3">ABINJ</option>
                <option value="4">RETARD</option>
				<option value="5">RENVOI</option>
            </select>
        </div>
    </div>
      <div class="form-group">
          <label class="col-sm-3 control-label no-padding-right" for="libelle">Libell&eacute;</label>

        <div class="col-sm-9">
            <input  type="text" ng-model="presence.libelle"  name="libelle" placeholder="Libell&eacute;" required>
        </div>
    </div>
    
  <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="date">Date</label>

        <div class="col-sm-9">
                 <input ng-model="presence.date" type="text" id="date_presence" class="input-mask-date" placeholder="Date" required>
        </div>
    </div>
    

<div class="clearfix" style="margin-top : 50px">
    <div class="col-md-offset-3 col-md-9">
        <input type="submit"   class="btn btn-primary submit-button" value="Valider"/>
                        &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp;
        <button type="reset" class="btn" ng-click="annulerPresence()">
            <i class="ace-icon fa fa-undo bigger-110"></i>
            Annuler
        </button>
    </div>

</div>
</form>
<script type="text/javascript">
    jQuery(function ($) {
        
        $('.input-mask-date').mask('99/99/9999');


        // $('#spinner1').ace_spinner({value:0,min:0,max:100,step:5, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
    });
</script>