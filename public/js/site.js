/**
 * Funçao que filtra os dados de uma tabela. Procura os campos que contenham a 
 * classe "filtered" e olha para o valor do atributo "filteredby" destes campos 
 * para saber qual o id do campo que detem o valor filtrado.
 * 
 * @param  string  tabela  Nome do id da tabela que se deseja aplicar o filtro
 */
function filterTable(tabela)
{
  var  filter, table, tr, td, fby;
  table = document.getElementById(tabela);
  tr = table.getElementsByTagName("tr");
  
  // percorre todas as linhas da tabela
  for (i = 0; i < tr.length; i++) {
    //exibe a linha
    tr[i].style.display = "";
    //obtem os elementos td com a classe 'filtered'
    td = tr[i].getElementsByClassName('filtered');
    //percorre todos os elementos td encontrados
    for (j = 0; j < td.length; j++) {
      //obtem o id do campo pelo qual este td deve ser filtrado
      fby = td[j].getAttribute('filteredby');
      //obtem o valor do campo
      filter = document.getElementById(fby).value;
      // se o td nao possuir o valor, esconde a linha
      if (td[j].innerHTML.indexOf(filter) != 0) {
        tr[i].style.display = "none";
      }
    }
  }
}

/**
 * Valida se a data é válida
 * @param  {[type]} campo Referencia do campo que se deseja validar a data.
 */
function validarData(campo) {
  function verificaData(data) {
    
    var partes = data.split("/");

    if( partes.length != 3 ) return false;
    var dia = partes[0];
    var mes = partes[1];
    var ano = partes[2];
    if( isNaN(dia) || isNaN(mes) || isNaN(ano) ) return false;
    if( mes > 12 || mes < 1 || ano < 1 || dia < 1) return false;
    if( mes == 2 ) {
      maiorDia = ( ( (!(ano % 4)) && (ano % 100) ) || (!(ano % 400)) )? 29: 28;
      if( dia > maiorDia ) return false;
    }else {
      if( mes == 4 || mes == 6 || mes == 9 || mes == 11 ) {
        if( dia > 30 ) return false;
      }else {
        if( dia > 31 ) return false;
      }
    }
    return true;
  }
  
  var data = campo.value;
  data = data.replace(/[^0-9\/]/g, "");
  campo.value = data;
  if (data != '') {
    if (verificaData(data) !== true) {
      alert('A data informada não é válida.');
      setTimeout(function() { campo.focus(); }, 0);
    }
  }
}