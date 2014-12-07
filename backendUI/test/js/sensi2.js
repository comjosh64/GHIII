var Sensi2 = Sensi2 || {};		

// SignalR
Sensi2.Hub = $.connection.hub;         
Sensi2.Thermostat = $.connection.thermostat;

Sensi2.UserName = "team25@globalhack.com";
Sensi2.Password = "globalhack";
Sensi2.ICDID = "36-6f-92-ff-fe-01-18-3b";

// End Points
Sensi2.AuthorizeEndpoint = Sensi2.Config.Api + 'authorize';
Sensi2.ThermostatsEndpoint = Sensi2.Config.Api + 'thermostats';

$(function () {
	$.support.cors = true;
	$.ajaxSetup( {
		xhrFields: { withCredentials: true }
		});

	// Login starts the SignalR Hub as well
	Sensi2.LoginAndStartSignalR();
	
});

Sensi2.LoginAndStartSignalR = function() {
	Sensi2.Login(Sensi2.UserName,Sensi2.Password).done(function() {			
					
			Sensi2.StartSignalR().done(function() {
				Sensi2.log("Subscribing to " + Sensi2.ICDID);
				Sensi2.Thermostat.server.subscribe(Sensi2.ICDID);
			});
			
			/*
			Can get all of the ICDID's associated with this account if you uncomment below call
			
			Sensi2.log("Retreiving Thermostats");
			Sensi2.GetThermostatList().done(function (data) {
				Sensi2.log(data); 
			});*/
		});
}

Sensi2.ConnectionError = function() {
	Sensi2.log("Connection Error....");
	Sensi2.Hub.stop();
	Sensi2.LoginAndStartSignalR();
};
Sensi2.Disconnected = function() {
	Sensi2.log('Disconnected');
};

Sensi2.StartSignalR = function() {

	// Declare a proxy to reference the hub.    			
	Sensi2.Hub.error(Sensi2.ConnectionError);
	Sensi2.Hub.disconnected(Sensi2.Disconnected);

	Sensi2.Thermostat.client.online = function(icd,model) {
		Sensi2.log("Online");
	}
	
	Sensi.Thermostat.client.update = function (icd, model) {
		Sensi.log("Update");

		last_data = model;

		if (model.OperationalStatus && model.OperationalStatus.Temperature) {
	        $.ajax({
	            url: 'http://localhost:4567/submit',
	            type: 'put',
	            data: {temperature: model.OperationalStatus.Temperature.F, id: 2},
	            success: function(result) {
	                // Do something with the result
	            }
	        });
	    };
		Sensi.log(model);
	}
	
	Sensi2.Thermostat.client.offline = function (icd) {
		Sensi2.log("Offline");
	}
	
	Sensi2.Thermostat.client.error = function (icd, model) {
		Sensi2.log("Error");
	}
	
	return Sensi2.Hub.start();
}

Sensi2.Login = function (username, password) {
	return $.ajax({
		type: "POST",
		cache: false,
		contentType: 'application/json',
		headers: { "Content-Type": "application/json", "Accept": "application/json; version=1", "X-Requested-With": "XMLHttpRequest" },
		dataType: 'json',
		url: Sensi2.AuthorizeEndpoint,
		data: JSON.stringify({ UserName: username, Password: password }),
		success: function(response) {
			Sensi2.Auth = response;
		}
	})
	.fail(function(ajax, error, errorMessage) {
		Sensi2.log(errorMessage);
	})
	.success(function(ajax, response) {
		Sensi2.log(response);
	});
};

Sensi2.GetThermostatList = function() {
	Sensi2.log("Retreiving Thermostats");
	return Sensi2.JsonRequest("GET", Sensi2.ThermostatsEndpoint)
		.fail(function (ajax, error, errorMessage) { Sensi2.log(errorMessage); });
};

Sensi2.JsonRequest = function(method, url, payload) {
	var data = payload ? JSON.stringify(payload) : undefined;
	var request = Sensi2.flXHR ? url + '?Accept=' + Sensi2.Accept : url;

	return $.ajax({
		url: request,
		data: data,
		headers: { "Content-Type": "application/json", "Accept": "application/json; version=1", "X-Requested-With": "XMLHttpRequest" },
		type: method,
		contentType: 'application/json',
		dataType: 'json'
	});
};

Sensi2.log = function(data) {
	window.console && window.console.log(data);
};
