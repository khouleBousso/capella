<div class="row"> 
    <div class="col-md-2">
        <span class="profile-picture" ng-show="eleve.avatar == null || eleve.avatar == '' ">
            <img src="public/images/profils/unlogo.jpg" class="imghover"/>
        </span>

        <span class="profile-picture"  ng-show="eleve.avatar != null && eleve.avatar != ''">
            <img  width="130" height="130" ng-src="rest/avatarEleves/{{eleve.avatar}}" class="imghover"/>
        </span>

    </div>

    <div class="col-md-10">
        <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
                <div class="profile-info-name"> Nom & Prenom</div>

                <div class="profile-info-value">
                    <span id="username" class="editable editable-click">{{eleve.nom}}  {{eleve.prenom}}</span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> Lieu naissance </div>

                <div class="profile-info-value">
                    <span id="signup" class="editable editable-click">{{eleve.lieu_naissance}}</span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> Date naissance </div>

                <div class="profile-info-value">
                    <span id="about" class="editable editable-click">{{eleve.date_naissance}}</span>
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> Nationalite </div>

                <div class="profile-info-value">
                    <span id="about" class="editable editable-click">{{eleve.nationalite}}</span>
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> Inscrit (e)  en </div>

                <div class="profile-info-value">
                    <span id="about" class="editable editable-click">{{eleve.classeNom}}</span>
                </div>
            </div>
            <br/><br/>
            <div class="profile-info-row">
                <div class="profile-info-name"> Tuteur </div>

                <div class="profile-info-value">
                    <span id="about" class="editable editable-click">{{eleve.prenomtuteur}} {{eleve.nomtuteur}}</span>
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> Profession </div>

                <div class="profile-info-value">
                    <span id="about" class="editable editable-click">{{eleve.professiontuteur}}</span>
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> Societe </div>

                <div class="profile-info-value">
                    <span id="about" class="editable editable-click">{{eleve.societetuteur}}</span>
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> Adresse </div>

                <div class="profile-info-value">
                    <span id="about" class="editable editable-click">{{eleve.adressetuteur}}</span>
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> E-mail </div>

                <div class="profile-info-value">
                    <span id="about" class="editable editable-click">{{eleve.emailtuteur}}</span>
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> Telephone </div>

                <div class="profile-info-value">
                    <span id="about" class="editable editable-click">{{eleve.telephonetuteur}}</span>
                </div>
            </div><br/><br/>
            <div class="profile-info-row">
                <div class="profile-info-name"> Boursier </div>

                <div class="profile-info-value">
                    <span id="about" class="editable editable-click">{{eleve.boursier}}</span>
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> Sport </div>

                <div class="profile-info-value">
                    <span id="about" class="editable editable-click">{{eleve.sport}}</span>
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> Tenue </div>

                <div class="profile-info-value">
                    <span id="about" class="editable editable-click">{{eleve.tenue}}</span>
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> Transport </div>

                <div class="profile-info-value">
                    <span id="about" class="editable editable-click">{{eleve.transport}}</span>
                </div>
            </div>
			<div class="profile-info-row">
                <div class="profile-info-name"> Handicap </div>

                <div class="profile-info-value">
                    <span id="about" class="editable editable-click">{{eleve.handicape}}</span>
                </div>
            </div>

        </div>
    </div>
</div>