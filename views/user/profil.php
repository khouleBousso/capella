<div class="breadcrumbs" id="breadcrumbs">

    <ul class="breadcrumb">
        <li><i class="ace-icon fa fa-home home-icon"></i> <a
                ui-sref="home">Accueil</a></li>
    </ul>
    <!-- /.breadcrumb -->

    <!-- /.nav-search -->

    <!-- /section:basics/content.searchbox -->
</div>

<div ng-controller="ProfilCtrl">
<!-- /section:basics/content.breadcrumbs -->
<div class="page-content" >
    <div class="page-header">
        <h1>
            Profil <small> <i class="ace-icon fa fa-angle-double-right"></i>
                {{user.prenom}}&nbsp;{{user.nom}}
            </small>
        </h1>
    </div>

<div class="row" > 
    <div class="col-md-2">
        <span class="profile-picture" ng-show="user.avatar == null">
            <img src="public/images/profils/unlogo.jpg" class="imghover"/>
        </span>

        <span class="profile-picture"  ng-show="user.avatar != null">
            <img  width="130" height="130"  ng-src="rest/avatarUsers/{{user.avatar}}" class="imghover"/>
        </span>

    </div>

    <div class="col-md-10">
        <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
                <div class="profile-info-name"> Nom & Prenom</div>

                <div class="profile-info-value">
                    <span id="username" class="editable editable-click">{{user.nom}}  {{user.prenom}}</span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> Adresse </div>

                <div class="profile-info-value">
                    <span id="age" class="editable editable-click">{{user.adresse}}</span>
                </div>
            </div>

          
            <div class="profile-info-row">
                <div class="profile-info-name"> E-mail </div>

                <div class="profile-info-value">
                    <span id="about" class="editable editable-click">{{user.email}}</span>
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> Telephone </div>

                <div class="profile-info-value">
                    <span id="about" class="editable editable-click">{{user.telephone}}</span>
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> Login</div>

                <div class="profile-info-value">
                    <span id="about" class="editable editable-click">{{user.login}}</span>
                </div>
            </div>

        </div>
    </div>
</div>
    </div>
</div>