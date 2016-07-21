<div class="row" ng-controller="LoginCtrl">
    <div class="col-sm-10 col-sm-offset-1">
        <div class="login-container">
            <div class="center">
                <h1>
                    <img width="250" height="130" src="assets/images/logo1.png"/>
                </h1>
            </div>
            <div class="position-relative">
                <div id="login-box" class="login-box visible widget-box no-border">
                    <div class="widget-body">
                        <div class="widget-main">
                            <h4 class="header blue lighter bigger">
                                <i class="ace-icon fa fa-coffee blue"></i> Entrez vos
                                Informations
                            </h4>
                            <div class="alert alert-block alert-danger" ng-show="error != null && error != ''">{{error}}</div>
                            <div class="space-6"></div>
                            <form>
                                <fieldset>
                                    <label class="block clearfix"> <span
                                            class="block input-icon input-icon-right"> <input
                                                type="text" class="form-control" placeholder="Identifiant"
                                                ng-model="user.login" /> <i class="ace-icon fa fa-user"></i>
                                        </span>
                                    </label> <label class="block clearfix"> <span
                                            class="block input-icon input-icon-right"> <input
                                                type="password" class="form-control" ng-model="user.password"
                                                placeholder="Mot de Passe" /> <i class="ace-icon fa fa-lock"></i>
                                        </span>
                                    </label>
                                    <div class="space"></div>
                                    <div class="clearfix">
                                        <button type="button"
                                                class="width-36 pull-right btn btn-sm btn-primary"
                                                ng-disabled="!user.login || !user.password"
                                                ng-click="login(user)">
                                            <i class="ace-icon fa fa-key"></i> <span class="bigger-110">Se
                                                connecter</span>
                                        </button>
                                    </div>
                                    <div class="space-4"></div>
                                </fieldset>
                            </form>
                            <div class="space-6"></div>
                        </div>
                        <!-- /.widget-main -->
                    </div>
                    <!-- /.widget-body -->
                </div>
                <!-- /.login-box -->
                <div id="signup-box" class="signup-box widget-box no-border">
                </div>
            </div>
        </div>
    </div>
</div>