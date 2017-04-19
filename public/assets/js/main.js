// /**
//  * Created by jonas on 12.04.2017.
//  */

function checkRadioButtons(){
    var length = document.priceCalculatorForm.optradio.length;
    var value = "";
    for (i = 0; i < length; i++) {

        if ( document.priceCalculatorForm.optradio[i].checked ) {

            value = document.priceCalculatorForm.optradio[i].value;
            document.priceCalculatorForm.kwh.value=value;
            break;
        }
    }
}

// JQuery
$(document).ready(function(){

    console.log("Load page: " + document.baseURI);
    $("#signUpForm").on('submit', function(event) {
        var $form = $(this);
        var formdata = $form.serializeArray();
        var data = JSON.stringify({email:formdata[0].value, password:formdata[1].value, passwordRetyped:formdata[2].value});
        $.ajax({
            type: $form.attr('method'),
            url: $form.attr('action'),
            data: data,
            dataType: "json",
            contentType : "application/json",
            error: function(response, status, error){
                if(response.status === 303){
                    console.log("nice job!");
                    var jsonObject = JSON.parse(response.responseText);
                    window.location.replace(jsonObject.redirect);
                } else{
                    console.debug(JSON.parse(response.responseText));
                }
            }
        });

        event.preventDefault();
    });
});
