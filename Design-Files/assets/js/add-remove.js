// JavaScript Document

<!-- add & Remove -->

jQuery(document).on("ready", function() {

  initAddRows();

});

function initAddRows() {

  var template = jQuery("#template"),
      dataRows = jQuery("#dataRows");

  jQuery("#btnAdd").on("click", function() {

    var newRow = template.clone(true, true),
        fieldRows = dataRows.find(".fieldRow");

    newRow.attr('id', 'row' + (fieldRows.length + 1)).find('[id]').each(function() {

      jQuery(this).attr("id", jQuery(this).attr("id") + (fieldRows.length + 1));

    });

    fieldRows.filter(":last").after(newRow);

  });

  dataRows.on("click", ".remove", function() {

    jQuery(this).parent().remove();

  });
}

                                                <!-- add & Remove2 -->
                                                     
$('.AddNew').click(function(){
   var row = $(this).closest('tr').clone();
   row.find('input').val('');
   $(this).closest('tr').after(row);
   $('input[type="button"]', row).removeClass('AddNew').addClass('RemoveRow').val('Remove item');
});

$('table').on('click', '.RemoveRow', function(){
  $(this).closest('tr').remove();
});