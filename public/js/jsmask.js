
   
  $(document).ready(function($){
  //$('#dn').mask('00/00/0000');
  //$('.time').mask('00:00:00');
  //$('.date_time').mask('00/00/0000 00:00:00');
  //$('#cep').mask('00.000-000');
  //$('.phone').mask('0000-0000');
  $('#telefone_cliente').mask('(00) 90000-0000');
    $('#telefone_fixo').mask('(00) 90000-0000');
  //$('.phone_us').mask('(000) 000-0000');
  //$('.mixed').mask('AAA 000-S0S');
  // $('#cpf').mask('000.000.000-00', {reverse: true});
  //$('.cnpj').mask('00.000.000/0000-00', {reverse: true});
  //$('.money').mask('000.000.000.000.000,00', {reverse: true});
  $('#preco').mask("#.##0,00", {reverse: true});

// Mascara para cpf e cnpj
$(document).on('keydown', '[data-mask-for-cpf-cnpj]', function (e) {

    var digit = e.key.replace(/\D/g, '');

    var value = $(this).val().replace(/\D/g, '');

    var size = value.concat(digit).length;

    $(this).mask((size <= 11) ? '000.000.000-00' : '00.000.000/0000-00');
});

// Mascara para telefone
$(document).on('keydown', '[data-mask-for-telefone]', function (e) {

    var digit = e.key.replace(/\D/g, '');

    var value = $(this).val().replace(/\D/g, '');

    var size = value.concat(digit).length;

    $(this).mask((size <= 12) ? '(00)0000-00000' : '(00)00000-0000');
});


  /*$('.ip_address').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
    translation: {
      'Z': {
        pattern: /[0-9]/, optional: true 
      }
    }
  });*/
 // $('.ip_address').mask('099.099.099.099');
  //$('.percent').mask('##0,00%', {reverse: true});
  //$('.clear-if-not-match').mask("00/00/0000", {clearIfNotMatch: true});
  //$('.placeholder').mask("00/00/0000", {placeholder: "__/__/____"});
  /*$('.fallback').mask("00r00r0000", {
      translation: {
        'r': {
          pattern: /[\/]/,
          fallback: '/'
        },
        placeholder: "__/__/____"
      }
    });*/
 // $('.selectonfocus').mask("00/00/0000", {selectOnFocus: true});
// });
// $(document).ready(function(){
// $(":input").inputmask();



// $("#inputTelefone").inputmask({
// mask: '999 999 9999',
// placeholder: ' ',
// showMaskOnHover: false,
// showMaskOnFocus: false,
// onBeforePaste: function (pastedValue, opts) {
// var processedValue = pastedValue;

// //do something with it

// return processedValue;
// }
// });
// });

  })
