$(document).ready(function(){

    $("#account_phoneNumber").bind("input change keyup", checkExists);

});

var inUse = false;

function checkExists()
{
    // Get the input value
    var phoneNumber = $("#account_phoneNumber").val();

    // Send an ajax request with the user input data
    $.ajax({
        type: "POST",
        headers: {"Access-Control-Allow-Origin": "http://127.0.0.1:8000"},
        url: "http://163.172.67.144:8042/documentation#/api/postApiV1Validate",
        data: {"username": "api", "password": "azpihviyazfb", "phoneNumber": phoneNumber , "countryCode": "Fr" }
        })
        .done(function(data){
            console.log(data);
        }
    );

    // We suppose all went well.
    // If not, the Ajax call will update the flag and display the error message
    inUse = false;
    $("#folder_exists_error").hide();
}