/**
 * Created by jonas on 12.04.2017.
 */
$(document).ready(function(){

    console.log("Hello, World");
    $("#signUpForm").on('submit', function(event) {
        var $form = $(this);
        var formdata = JSON.stringify($form.serializeArray());
        $.ajax({
            type: $form.attr('method'),
            url: $form.attr('action'),
            data: formdata,
            success: function(data, status) {
                alert(status);
            },
            dataType: "json",
            contentType : "application/json"
        });

        event.preventDefault();
    });
});

    // console.log("hello");
    // function submitSignUpForm(){
    //     var formdata = JSON.stringify($form.serializeArray());
    //     console.debug(formdata);
    //     $.ajax({
    //         type: form.attr('method'),
    //         url: form.attr('action'),
    //         data: formdata,
    //         success: function(data, status) {
    //             alert(status);
    //         },
    //         dataType: "json",
    //         contentType : "application/json"
    //     });
    // }