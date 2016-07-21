<form method="POST"  class="form-horizontal"  enctype="multipart/form-data"  role="form" name="formAjoutUser" style="margin-top : 10px; margin-bottom :20px;" ng-submit="ajoutModUser()">
    <!-- #section:elements.form.input-state -->

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="nom">Nom</label>

        <div class="col-sm-9">
            <input  type="text" ng-model="user.nom"  name="nom" placeholder="Nom" required>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="prenom">Pr&eacute;nom</label>

        <div class="col-sm-9">
            <input  type="text" ng-model="user.prenom"  name="prenom" placeholder="Prenom" required>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="Email">Email</label>

        <div class="col-sm-9">
            <input  type="email" ng-model="user.email"  name="Email" placeholder="Email" required>
            <span ng-class="{'has-error': invalidMail, 'has-success': !invalidMail}" ng-show="invalidMail">Email invalide ou existe d&eacute;ja!</span>

        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="Telephone">Telephone</label>

        <div class="col-sm-9">   
            <input  ng-model="user.telephone" class="input-mask-phone" type="text" placeholder="T&eacute;l&eacute;phone" required>

        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="Adresse">Adresse</label>

        <div class="col-sm-9">   
            <textarea  ng-model="user.adresse" type="text" placeholder="Adresse" >
            </textarea>                      
        </div>
    </div>

    <div class="form-group" id="groupeAvatar">
        <label class="col-sm-3 control-label no-padding-right" for="photo">Photo</label>

        <div class="col-sm-9">
            <input  type="text" ng-model="upload.avatar.name"  name="photo" placeholder="Photo" ng-click="launch()">
        </div>
    </div>  

    <div class="form-group" >
        <label class="col-sm-3 control-label no-padding-right" for="Adresse">Profil</label>
        <div class="col-sm-4" >
            <select  class="form-control "  id="form-field-select-3" data-placeholder="Choisir un profil... " ng-model="user.id_profil"  required>
                <option value="">  </option>
                <?php
                try {
                    $bdd = new PDO('mysql:host=91.216.107.161;dbname=capel646515', 'capel646515', 'Su4wcTgW', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
                } catch (Exception $e) {
                    die('Erreur : ' . $e->getMessage());
                }
                $reponse = $bdd->query("SELECT * FROM profil where  id != 2 and id != 5 ");
                while ($donnees = $reponse->fetch()) {
                    echo '<option value="' . $donnees['id'] . '" >' . $donnees['code_profil'] . '</option>';
                }
                ?>
            </select> 
        </div>

    </div>

    <div class="clearfix" style="margin-top : 50px">
        <div class="col-md-offset-3 col-md-9">
            <input type="submit"   class="btn btn-primary submit-button" value="Valider"/>
            &nbsp; &nbsp; &nbsp;
            &nbsp; &nbsp; &nbsp;
            <button type="reset" class="btn" ng-click="annulerUser()">
                <i class="ace-icon fa fa-undo bigger-110"></i>
                Annuler
            </button>
        </div>
    </div>
    <input type="file" name="icone" fileavatar="upload.avatar"  id="icone" style="display : none">
</form>


<script type="text/javascript">
    jQuery(function ($) {
        $('.input-mask-phone').mask('99 999-99-99');

        // $('#spinner1').ace_spinner({value:0,min:0,max:100,step:5, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
    });
</script>