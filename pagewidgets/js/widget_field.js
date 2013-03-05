function arrayToInput() {
  var itemsarr = $('#widget_sorting').sortable('toArray');
  itemsarr = itemsarr.join(',');
  $('#widget_page').find('input[type="hidden"]').val(itemsarr);
}
function makeList() {
  var items = {};
  var template = '';
  $('#widget_page').find('select').find('option').filter(':selected').each(function(index, value) {
    items[$(this).val()] = $(this).html();
  });
  for(var key in items) {
    template += '<li id="widget_'+key+'">'+items[key]+'</li>';
  }
  $('#widget_sorting').html(template);
  arrayToInput();
}
jQuery(function($) {
  $(function() {
    $("#widget_sorting").sortable({
      forcePlaceholderSize: true,
      forceHelperSize: true,
      update: function(event, ui) {
        arrayToInput();
      }
    }).disableSelection();
    $('#widget_page').find('select').on('change', function() {
      makeList();
    });
    // makeList();
  });
});