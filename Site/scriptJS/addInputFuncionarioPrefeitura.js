var cont_rem = 0;
var cont_des = 0;

//inserir funcionario add_input funcões
function add_qtd_remuneracao(){
  $(document).on("keyup", "#reqtde", function () {
    var qtd_rem = this.value;
    var inputspace = '';
    for(var i = 0; i<qtd_rem; i++){
      inputspace =
        inputspace +
        '<div><input id="TR'+i+'" name="TR'+i+'" class="col-md-6" placeholder="TIPO"><input id="VR'+i+'" name="VR'+i+'"  class="col-md-6" placeholder="Valor"></div>';
    }
    document.getElementById("reinput").innerHTML = inputspace;
  });
}

function add_qtd_desconto(){
  $(document).on("keyup", "#deqtde", function () {
    var qtd_des = this.value;
    var inputspace = '';
    for(var i = 0; i<qtd_des; i++){
      inputspace =
        inputspace +
        '<div><input id="TD'+i+'" name="TD'+i+'" class="col-md-6" placeholder="TIPO"><input id="VD'+i+'" name="VD'+i+'"  class="col-md-6" placeholder="Valor"></div>';
    }
    document.getElementById("redescontos").innerHTML = inputspace;
  });
}

//atualizar funcionario add_input and rmv_input funções
function add_remuneracao(){
  var inputspace = '\
  <div id="new_rem_div'+cont_rem+'" class="row mb-3">\
    <div class="col-md-5 text-left">\
      <input name="nomesR[]" type="text">\
    </div>\
    <div class="col-md-5 text-left">\
      <input name="valoresR[]" type="text" >\
    </div>\
    <div class="col-md-2">\
      <button name="'+cont_rem+'" type="button" class="btn btn-danger btn-new-rmvRem" onclick="rmv_new_remuneracao()">-</button>\
    </div>\
  </div>';
  $("#input-remuneracao").append(inputspace);
  cont_rem++;
}

function rmv_remuneracao(){
  $(document).on("click", ".btn-rmvRem", function() {
    var button_name = $(this).attr("name");
    $('#delete_rem'+button_name+'').val('true');
    $('#rem_div'+button_name+'').css({'display': 'none'});
  });
}

function rmv_new_remuneracao(){
  $(document).on("click", ".btn-new-rmvRem", function(event) {
    event.preventDefault();
    var button_name = $(this).attr("name");
    $('#new_rem_div'+button_name+'').remove();
  });
}

function add_desconto(){
  var inputspace = '\
  <div id="new_des_div'+cont_des+'" class="row mb-3">\
  <div class="col-md-5 text-left">\
  <input name="nomesD[]" type="text">\
  </div>\
  <div class="col-md-5 text-left">\
  <input name="valoresD[]" type="text">\
  </div>\
  <div class="col-md-2">\
  <button name="'+cont_des+'" type="button" class="btn btn-danger btn-new-rmvDes" onclick="rmv_new_desconto()">-</button>\
  </div>\
  </div>';
  $("#input-desconto").append(inputspace);
  cont_des++;
}

function rmv_desconto(){
  $(document).on("click", ".btn-rmvDes", function() {
    var button_name = $(this).attr("name");
    $('#delete_des'+button_name+'').val('true');
    $('#des_div'+button_name+'').css({'display': 'none'});
  });
}

function rmv_new_desconto(){
  $(document).on("click", ".btn-new-rmvDes", function(event) {
    event.preventDefault();
    var button_name = $(this).attr("name");
    $('#new_des_div'+button_name+'').remove();
  });
}
