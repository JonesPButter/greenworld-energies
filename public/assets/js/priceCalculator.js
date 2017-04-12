
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
