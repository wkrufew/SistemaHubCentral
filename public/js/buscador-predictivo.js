// constructor del buscador predictivo
var articulos = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.whitespace,
    queryTokenizer: Bloodhound.tokenizers.whitespace,

    //trae los datos de la DB
    prefetch: '../buscador-predictivo'

  });
  
  $('#buscador-predictivo').typeahead({
    hint: true,
    highlight: true,
    minLength: 1
  },
  {
    name: 'articulos',
    source: articulos
  });