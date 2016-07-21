<!DOCTYPE html>
<html ng-app="appAdmin">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>Gestion Eleves</title>

        <meta name="description"
              content="Dynamic tables and grids using jqGrid plugin" />
        <meta name="viewport"
              content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <link rel="stylesheet" href="assets/css/bootstrap.css" />
        <link rel="stylesheet" href="assets/css/font-awesome.css" />
	<link rel="stylesheet" href="assets/css/dropzone.css" />
        <link rel="stylesheet" href="assets/css/jquery-ui.css" />
        <link rel="stylesheet" href="assets/css/datepicker.css" />
        <link rel="stylesheet" href="assets/css/bootstrap-timepicker.css" />
        <link rel="stylesheet" href="assets/css/daterangepicker.css" />
        <link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.css" />
        <link rel="stylesheet" href="assets/css/colorpicker.css" />
        <link rel="stylesheet" href="assets/css/ui.jqgrid.css" />
        <link rel="stylesheet" href="assets/css/chosen.css" />
       <link rel="stylesheet" href="assets/css/chosen-spinner.css" />
        <link rel="stylesheet" href="assets/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="assets/css/select2.css" />
        <link rel="stylesheet" href="assets/css/bootstrap-editable.css" />
        <link rel="stylesheet" href="assets/css/fullcalendar.css" />
        <link rel="stylesheet" href="assets/css/ace-fonts.css" />
        <link rel="stylesheet" href="assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />
        <link rel="stylesheet" href="lib/angular-busy/angular-busy.css">
        <link rel="stylesheet" href="assets/css/angular-growl.css">
        <link rel="stylesheet" href="assets/css/loading-bar.css">
        <link rel="stylesheet" href="public/css/projet.css" />
        <script src="lib/jquery.min.js"></script>
        <script src="assets/js/ace-extra.js"></script>
        <script src="lib/conf.js"></script>
        <script src="assets/js/jquery.js"></script>
        <script src="assets/js/date-time/bootstrap-datepicker.js"></script>
        <script src="assets/js/date-time/daterange-fr.js"></script>
        <script src="assets/js/date-time/moment.js"></script>
        <script src="assets/js/date-time/daterangepicker.js"></script>
        <script src="assets/js/date-time/bootstrap-datetimepicker.js"></script>
        <script src="lib/angular.min.js"></script>
  <script src="assets/js/chosen.js"></script>
        <script src="assets/js/chosen.jquery.js"></script>
        <script type="text/javascript" src="controllers/app.js"></script>
        <script type="text/javascript" src="controllers/tarif.js"></script>
        <script type="text/javascript" src="controllers/login.js"></script>
        <script type="text/javascript" src="controllers/user.js"></script>
	<script type="text/javascript" src="controllers/autocomplete.js"></script>
        <script type="text/javascript" src="controllers/notes_presences.js"></script>
        <script type="text/javascript" src="services/auth.js"></script>
        <script type="text/javascript" src="controllers/routingConfig.js"></script>
        <script type="text/javascript" src="directives/access-level-admin.js"></script>
        <script src="lib/angular-ressource.min.js"></script>
        <script src="lib/angular-ui-router.min.js"></script>
        <script src="lib/angular-cookies.min.js"></script>
        <script src="lib/jquery.dataTables.min.js"></script>
        <script src="lib/angular-datatables.min.js"></script>
        <script src="lib/angular-growl.js"></script>
	<script src="lib/angular-busy/angular-busy.js"></script>
        <script src="lib/angular-ui/mask.js"></script>
        <script src="assets/js/jquery-ui.js"></script>
        <script src="assets/js/jquery.ui.touch-punch.js"></script>
        <script src="assets/js/checklist-model.js"></script>
        <script src="assets/js/loading-bar.js"></script>
        <script src="assets/js/x-editable/bootstrap-editable.js"></script>
        <script src="assets/js/x-editable/ace-editable.js"></script>
        <script src="assets/js/fullcalendar.js"></script>
	<script src="assets/js/ace/elements.wysiwyg.js"></script>
        <script src="assets/js/fuelux/fuelux.tree.js"></script>
        <script src="assets/js/ace/elements.treeview.js"></script>
        <script src="assets/js/fuelux/fuelux.wizard.js"></script>
        <script src="assets/js/ace/elements.wizard.js"></script>
        <script src="assets/js/jquery.maskedinput.js"></script>
        <script src="assets/js/bootstrap-tag.js"></script>
        <script src="assets/js/jquery.hotkeys.js"></script>
        <script src="assets/js/ace/elements.fileinput.js"></script>
        <script src="assets/js/bootstrap-wysiwyg.js"></script>
 <style >
 .chosen-container{ width:50% !important;}
</style>
    </head>

    <body ng-class="{ 'login-layout light-login': isPageLogin , 'no-skin': !isPageLogin  }">
        <!-- #section:basics/navbar.layout -->
        <!-- la  barre de navigation -->
        <div ng-show="!isPageLogin">
            <bare-navigation></bare-navigation>
        </div>
        <!-- /section:basics/navbar.layout -->

        <!-- /section:basics/navbar.layout -->
        <div class="main-container" id="main-container">
            <script type="text/javascript">
                try {
                    ace.settings.check('main-container', 'fixed')
                } catch (e) {
                }
            </script>

            <!-- #section:basics/sidebar -->
            <div ng-show="!isPageLogin" id="sidebar" class="sidebar responsive">
                <ng-include src="'menu.php'"></ng-include>
            </div>

            <!-- /section:basics/sidebar -->
            <div class="main-content">
                <div class="main-content-inner">
                    <div growl></div>
                    <div ui-view></div>
                </div>
            </div>
            <!-- /.main-content -->
            <div ng-show="!isPageLogin" class="footer">
                <footer></footer>
            </div>
            <a href="#" id="btn-scroll-up"
               class="btn-scroll-up btn btn-sm btn-inverse"> <i
                    class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
            </a>
        </div>
        <!-- /.main-container -->

        <!-- basic scripts -->

        <!--[if !IE]> -->
        <script type="text/javascript">
            window.jQuery || document.write("<script src='assets/js/jquery.js'>" + "<" + "/script>");
        </script>

        <!-- <![endif]-->

        <!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery1x.js'>"+"<"+"/script>");
</script>
<![endif]-->
        <script type="text/javascript">
            if ('ontouchstart' in document.documentElement)
                document.write("<script src='assets/js/jquery.mobile.custom.js'>" + "<" + "/script>");
        </script>
        <script src="assets/js/bootstrap.js"></script>


        <!-- ace scripts -->
        <script src="assets/js/ace/elements.scroller.js"></script>
        <script src="assets/js/ace/elements.aside.js"></script>
        <script src="assets/js/ace/ace.js"></script>
        <script src="assets/js/ace/ace.sidebar.js"></script>
        <script src="assets/js/ace/ace.sidebar-scroll-1.js"></script>
        <script src="assets/js/ace/ace.submenu-hover.js"></script>
        <script src="assets/js/ace/ace.widget-box.js"></script>
        <script type="text/javascript"> ace.vars['base'] = '..';</script>
        <script src="assets/js/ace/elements.onpage-help.js"></script>
        <script src="assets/js/ace/ace.onpage-help.js"></script>
        <script src="assets/js/jquery-ui.custom.js"></script>
        <script src="assets/js/jquery.ui.touch-punch.js"></script>
        <script src="assets/js/flot/jquery.flot.js"></script>
        <script src="assets/js/flot/jquery.flot-categories.js"></script>
        <script src="assets/js/flot/jquery.flot.pie.js"></script>
        <script src="assets/js/flot/jquery.flot.resize.js"></script>
        <script src="assets/js/bootbox.js"></script>
        <div class="cg-busy cg-busy-backdrop cg-busy-backdrop-animation ng-scope ng-hide" id="loding-verrou">
        <div class="cg-busy-default-wrapper navbar-fixed-top">
            <div class="cg-busy-default-sign">
                    <img src="assets/images/loading.gif"> Chargement en cours...
            </div>
        </div>
	</div>
    </body>
</html>