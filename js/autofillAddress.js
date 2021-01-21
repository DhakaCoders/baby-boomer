function autofilladress(){
    var address = $('#address').val();
    var city = '';
    var state = '';
    var postalcode = '';
    if(address != '')
    {
        jQuery.getJSON('https://maps.googleapis.com/maps/api/geocode/json?address=' + address+'&key=AIzaSyDHa-LIqK_BQrZ8590VZ6lUtorZDE_u37I').success(function (response) {
            console.log(response);
            if (response.results.length !== 0){
                //find the city and state
                console.log(response.results[0]);
                var address_components = response.results[0].address_components;
                if (address_components !== 'undefined'){
                    jQuery.each(address_components, function (index, component) {
                        var types = component.types;
                        jQuery.each(types, function (index, type) {
                            if (type == 'locality') {
                                city = component.long_name;
                            }
                            if (type == 'administrative_area_level_1') {
                                state = component.short_name;
                            }
                            if (type == 'postal_code') {
                                postalcode = component.short_name;
                            }
                        });
                    });
                    //pre-fill the city and state
                    $('#City').val(city);
                    $('#states').val(state);
                    $('#postalCode').val(postalcode);
                    //console.log(state);
                }
            }else{
                autofilladress();
            }
        });
    }
}
function autofilladressBilling(){
    var addressBilling = $('#billing_street_address').val();
    var cityBilling = '';
    var stateBilling = '';
    var postalcodeBilling = '';
    if(addressBilling != '')
    {
        jQuery.getJSON('https://maps.googleapis.com/maps/api/geocode/json?address=' + addressBilling+'&key=AIzaSyDHa-LIqK_BQrZ8590VZ6lUtorZDE_u37I').success(function (response) {
            console.log(response);
            if (response.results.length !== 0){
                //find the city and state
                console.log(response.results[0]);
                var address_components = response.results[0].address_components;
                if (address_components !== 'undefined'){
                    jQuery.each(address_components, function (index, component) {
                        var types = component.types;
                        jQuery.each(types, function (index, type) {
                            if (type == 'locality') {
                                cityBilling = component.long_name;
                            }
                            if (type == 'administrative_area_level_1') {
                                stateBilling = component.short_name;
                            }
                            if (type == 'postal_code') {
                                postalcodeBilling = component.short_name;
                            }
                        });
                    });
                    //pre-fill the city and state
                    $('#billing_city').val(cityBilling);
                    $('#billing_state').val(stateBilling);
                    $('#billing_postcode').val(postalcodeBilling);
                    //console.log(state);
                }
            }else{
                autofilladressBilling();
            }
        });
    }
}