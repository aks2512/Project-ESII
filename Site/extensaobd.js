$(document).ready(function() {
    //Listeners
    $('#Remuneracao').change(function() {
        var i=this.innerText;
        alert(i);
        var inputspace='<tr><td><input id="tipo'+i+'"></td><td id="valor'+i+'"></td></tr>';
        while(i>1) {
            inputspace=inputspace+'<tr><td><input id="tipo'+i+'"></td><td id="valor'+i+'"></td></tr>';
        }
        document.getElementById('linhasre').innerHTML=inputspace;
    })
})
