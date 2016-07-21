
    <div class="row" style="margin-top :10px" ng-controller="DocumentsEtudiantCtrl">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
                <table class="table table-striped table-hover col-sm-3" >
                   <thead>
                   
                        <tr>
                        <th style="background-color : #77abd6 !important;color : #fff">Intitul&eacute;</th>
                        <th style="background-color : #77abd6 !important;color : #fff">Cours</th>
                        <th style="background-color : #77abd6 !important;color : #fff">Examen</th>
                        <th style="background-color : #77abd6 !important;color : #fff">Corrigé</th>
                        </tr>
                       </thead>
                    <tbody>
                      <tr ng-repeat="document in documents">
                            <td>
                                <span style="font-weight : bold">{{document.nom}}</span> : {{document.intitule}}
                            </td>
                            <td class="text-center lead">
                                
                                <a target="_blank" title="Télécharger"  ng-show="document.cours != null && document.cours != '' " 
                                    ng-href="{{appname}}/rest/documents/{{document.cours}}" class="disabled  text-primary"><i class="fa fa-file-pdf-o"></i></a>
                            </td> 
                            
                            <td class="text-center lead">
                                
                                <a target="_blank" title="Télécharger"  ng-show="document.examen != null && document.examen != '' " 
                                    ng-href="{{appname}}/rest/documents/{{document.examen}}" class="disabled  text-primary"><i class="fa fa-file-pdf-o"></i></a>
                            </td> 
                            
                            <td class="text-center lead">
                                
                                <a target="_blank" title="Télécharger"  ng-show="document.corrige != null && document.corrige != '' " 
                                    ng-href="{{appname}}/rest/documents/{{document.corrige}}" class="disabled  text-primary"><i class="fa fa-file-pdf-o"></i></a>
                            </td> 
                        </tr>
                        
                        </tbody>
                    </table>
        </div>
         <div class="col-sm-2"></div>
    </div>