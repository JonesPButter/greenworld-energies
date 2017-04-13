// /**
//  * Created by jonas on 12.04.2017.
//  */
$(document).ready(function(){

    console.log("Hello, World");
    $("#signUpForm").on('submit', function(event) {
        var $form = $(this);
        var formdata = $form.serializeArray();
        var data = JSON.stringify({email:formdata[0].value, password:formdata[1].value, passwordRetyped:formdata[2].value});
        console.debug(data);
        $.ajax({
            type: $form.attr('method'),
            url: $form.attr('action'),
            data: data,
            success: function(data, status) {
                alert(status);
            },
            dataType: "json",
            contentType : "application/json"
        });

        event.preventDefault();
    });
});
