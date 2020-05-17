$(document).ready(function () {
  //Listeners para incrementar quantidade de campos input conforme requisitado
  $("#reqtde").keyup(function () {
    //obs: atributo name="nome[]" indica array, onde elementos que o forman devem ter o mesmo nome
    var i = this.value;
    var inputspace =
      '<td><input id="inputbox"  id="Rtipo" class="col-md-6" name="Rtipo[]" placeholder="TIPO"><input id="inputbox"  id="Rval" class="col-md-6" name="Rval[]" placeholder="Valor"></td>'; //Armazena Dupla de input onde deve ser colocado o tipo e valor do item de remuneração ex:salario - 300
    if (i > 20) {
      alert("Não pode haver mais de 20 tipos!");
      i = 20;
    }
    while (i > 1) {
      inputspace =
        inputspace +
        '<td><input id="inputbox"  id="Rtipo" class="col-md-6" name="Rtipo[]" placeholder="TIPO"><input id="inputbox"  id="Rval" class="col-md-6" name="Rval[]" placeholder="Valor"></td>';
      i--;
    }
    document.getElementById("reinput").innerHTML = inputspace;
  });
  $("#deqtde").keyup(function () {
    var i = this.value;
    var inputspace =
      '<td><input id="inputbox"  id="Dtipo" class="col-md-6" name="Dtipo[]" placeholder="TIPO"><input id="inputbox"  id="Dval" class="col-md-6" name="Dval[]" placeholder="Valor"></td>';
    if (i > 20) {
      alert("Não pode haver mais de 20 tipos!");
      i = 20;
    }
    while (i > 1) {
      inputspace =
        inputspace +
        '<td><input id="inputbox"  id="Dtipo" class="col-md-6" name="Dtipo[]" placeholder="TIPO"><input id="inputbox"  id="Dval" class="col-md-6" name="Dval[]" placeholder="Valor"></td>';
      i--;
    }
    document.getElementById("redescontos").innerHTML = inputspace;
  });
});
