<form method="POST"  class="form-horizontal" role="form" name="formAjoutNote" style="margin-top : 10px; margin-bottom :20px;" ng-submit="addModDev()">
    <!-- #section:elements.form.input-state -->

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="matiere">Mati&egrave;re</label>

        <div class="col-sm-9">
            <input  type="text" ng-model="dev.matiere"  name="matiere" placeholder="Mati&egrave;re" ng-disabled="true">
        </div>
    </div>

    
     <div class="form-group" >
        <label class="col-sm-3 control-label no-padding-right" for="titre">Titre</label>

        <div class="col-sm-9">
            <input  type="text" ng-model="dev.title"  name="titre" placeholder="Titre" required ng-disabled="classe == null">
        </div>
    </div>
    
    
    <div class="form-group" >
        <label class="col-sm-3 control-label no-padding-right" for="details">D&eacute;tails</label>

        <div class="col-sm-9">
            <textarea placeholder="D&eacute;tails" ng-model="dev.details" ng-disabled="classe == null">
            </textarea>
        </div>
    </div>

     <div class="form-group" ng-if="classe == null">
         <label class="col-sm-3 control-label no-padding-right" for="appreciation">Appr&eacute;ciation</label>

        <div class="col-sm-9">
            <input  type="text" ng-model="dev.appreciation"  name="appreciation" placeholder="Appr&eacute;ciation">
        </div>
    </div>
    
    <div class="form-group" >
        <label class="col-sm-3 control-label no-padding-right" for="date">Date</label>

        <div class="col-sm-9">
                 <input ng-model="dev.date" type="text" class="input-mask-date" placeholder="Date" required ng-disabled="classe == null">
        </div>
    </div>
    <div class="form-group" >
        <label class="col-sm-3 control-label no-padding-right" for="date">Date de rendu</label>

        <div class="col-sm-9">
                 <input ng-model="dev.date_rendu" type="text" class="input-mask-date" placeholder="Date limite de rendu" required ng-disabled="classe == null">
        </div>
    </div>
    
    
<div class="clearfix" style="margin-top : 50px">
    <div class="col-md-offset-3 col-md-9">
        <input type="submit"  class="btn btn-primary submit-button" value="Valider"/>
                        &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp;
        <button type="reset" class="btn" ng-click="annulerDev()">
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

