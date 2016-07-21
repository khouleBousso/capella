var tarifModule = angular.module('tarif', ['ui.router']);

 

appAdmin.controller('ListTarifCtrl', ListTarifCtrl, ['$scope', 'growl']);
function ListTarifCtrl($resource, $http, $scope, $location, growl, $stateParams, $state)
{
    
        $http.get(gOptions.serveur + '/rest/TarifManager.php/ListTarif/1').
	success(
			function(data) 
			{

				$scope.tarifsIns=data.data;
			}
	).
	error(function(result) 
			{
			});
$http.get(gOptions.serveur + '/rest/TarifManager.php/ListTarif/0').
	success(
			function(data) 
			{

				$scope.tarifsReIns=data.data;
			}
	).
	error(function(result) 
			{
			});
}

//start TarifCtrl
tarifModule.controller('TarifCtrl', TarifCtrl, [ '$scope']);
function TarifCtrl($resource, $http, $scope, $location,Auth)
{
        $scope.user=Auth.user;
	$scope.tarifs=[];
	$scope.tarifsRe=[];
	$scope.tarif={};
	$scope.showAjoutTarif= false;
	$scope.showAjoutTarifRe= false;
	$scope.showModifierTarif= false;
	$scope.showSupprTarif = false;
        $scope.showModifierTarifRe= false;
	$scope.showSupprTarifRe = false;
	$http.get(gOptions.serveur + '/rest/TarifManager.php/ListTarif/1').
	success(
			function(data) 
			{

				$scope.tarifs=data.data;
			}
	).
	error(function(result) 
			{
			});
$http.get(gOptions.serveur + '/rest/TarifManager.php/ListTarif/0').
	success(
			function(data) 
			{

				$scope.tarifsRe=data.data;
			}
	).
	error(function(result) 
			{
			});

	$scope.popupAjoutTarif = function(){
		$scope.showAjoutTarif = !$scope.showAjoutTarif;

	}

	$scope.popupAjoutTarifRe = function(){
		$scope.showAjoutTarifRe = !$scope.showAjoutTarifRe;

	}
	
	
	$scope.popupModifierTarif = function(tarifId){
		$scope.showModifierTarif = !$scope.showModifierTarif;
		$http.get(gOptions.serveur + '/rest/TarifManager.php/GetTarif/'+tarifId).
		success(
				function(data) 
				{

					$scope.tarif = data.data[0];
				}
		).
		error(function(result) 
				{
				});
	}

		
	$scope.popupModifierTarifRe = function(tarifId){
		$scope.showModifierTarifRe = !$scope.showModifierTarifRe;
		$http.get(gOptions.serveur + '/rest/TarifManager.php/GetTarif/'+tarifId).
		success(
				function(data) 
				{

					$scope.tarif = data.data[0];
				}
		).
		error(function(result) 
				{
				});
	}

	
	$scope.popupSupprimerTarif = function(tarifId){
		$scope.showSupprTarif = !$scope.showSupprTarif;
		$http.get(gOptions.serveur + '/rest/TarifManager.php/GetTarif/'+tarifId).
		success(
				function(data) 
				{

					$scope.tarif = data.data[0];
				}
		).
		error(function(result) 
				{
				});
	}

		$scope.popupSupprimerTarifRe = function(tarifId){
		$scope.showSupprTarifRe = !$scope.showSupprTarifRe;
		$http.get(gOptions.serveur + '/rest/TarifManager.php/GetTarif/'+tarifId).
		success(
				function(data) 
				{

					$scope.tarif = data.data[0];
				}
		).
		error(function(result) 
				{
				});
	}


	$scope.annulerSupprTarif = function(){

		$scope.showSupprTarif = !$scope.showSupprTarif;
	}
$scope.annulerSupprTarifRe = function(){

		$scope.showSupprTarifRe = !$scope.showSupprTarifRe;
	}

	$scope.confirmSupprTarif = function(){
	
		$http.post(gOptions.serveur + '/rest/TarifManager.php/DeleteTarif/', $scope.tarif).
		success(
				function(data) 
				{
					$scope.showSupprTarif = !$scope.showSupprTarif;
					$scope.tarif={};
						$http.get(gOptions.serveur + '/rest/TarifManager.php/ListTarif/1').
	                    success(
									function(data) 
									{

										$scope.tarifs=data.data;
									}
						).
						error(function(result) 
								{
								});

				}).
				error(function(result) 
						{
						});
	}
	
	$scope.confirmSupprTarifRe = function(){
	
		$http.post(gOptions.serveur + '/rest/TarifManager.php/DeleteTarif/', $scope.tarif).
		success(
				function(data) 
				{
					$scope.showSupprTarifRe = !$scope.showSupprTarifRe;
					$scope.tarif={};
						$http.get(gOptions.serveur + '/rest/TarifManager.php/ListTarif/0').
	                    success(
									function(data) 
									{

										$scope.tarifsRe=data.data;
									}
						).
						error(function(result) 
								{
								});

				}).
				error(function(result) 
						{
						});
	}

	$scope.ajoutTarif= function()
	{

$scope.tarif.type="1";
		$http.post(gOptions.serveur + '/rest/TarifManager.php/AddTarif/', $scope.tarif).
		success(
				function(data) 
				{
					$scope.showAjoutTarif = !$scope.showAjoutTarif;
					$scope.tarif={};
					$http.get(gOptions.serveur + '/rest/TarifManager.php/ListTarif/1').
	                    success(
									function(data) 
									{

										$scope.tarifs=data.data;
									}
						).
						error(function(result) 
								{
								});

				}).
				error(function(result) 
						{
						});
	}

$scope.ajoutTarifRe= function()
	{

$scope.tarif.type="0";
		$http.post(gOptions.serveur + '/rest/TarifManager.php/AddTarif/', $scope.tarif).
		success(
				function(data) 
				{
					$scope.showAjoutTarifRe = !$scope.showAjoutTarifRe;
					$scope.tarif={};
					$http.get(gOptions.serveur + '/rest/TarifManager.php/ListTarif/0').
	                    success(
									function(data) 
									{

										$scope.tarifsRe=data.data;
									}
						).
						error(function(result) 
								{
								});

				}).
				error(function(result) 
						{
						});
	}



	$scope.annulerAjoutTarif= function()
	{
		$scope.showAjoutTarif = !$scope.showAjoutTarif;
		$scope.tarif={};
	}

	$scope.annulerAjoutTarifRe= function()
	{
		$scope.showAjoutTarifRe = !$scope.showAjoutTarifRe;
		$scope.tarif={};
	}
	
	$scope.annulerModifierTarif= function()
	{
		$scope.showModifierTarif = !$scope.showModifierTarif;
		$scope.tarif={};
	}

	$scope.annulerModifierTarifRe= function()
	{
		$scope.showModifierTarifRe = !$scope.showModifierTarifRe;
		$scope.tarif={};
	}


	$scope.modifierTarif= function()
	{
	    $scope.tarif.type="1";
		$http.post(gOptions.serveur + '/rest/TarifManager.php/UpdateTarif/', $scope.tarif).
		success(
				function(data) 
				{
					$scope.showModifierTarif = !$scope.showModifierTarif;
					$scope.tarif={};
					$http.get(gOptions.serveur + '/rest/TarifManager.php/ListTarif/1').
	                    success(
									function(data) 
									{

										$scope.tarifs=data.data;
									}
						).
						error(function(result) 
								{
								});
				}).
				error(function(result) 
						{
						});

	}

$scope.modifierTarifRe= function()
	{
	$scope.tarif.type="0";
		$http.post(gOptions.serveur + '/rest/TarifManager.php/UpdateTarif/', $scope.tarif).
		success(
				function(data) 
				{
					$scope.showModifierTarifRe = !$scope.showModifierTarifRe;
					$scope.tarif={};
					$http.get(gOptions.serveur + '/rest/TarifManager.php/ListTarif/0').
	                    success(
									function(data) 
									{

										$scope.tarifsRe=data.data;
									}
						).
						error(function(result) 
								{
								});
				}).
				error(function(result) 
						{
						});

	}

	$scope.dismiss= function(){
		$scope.tarif={};
	}

};

