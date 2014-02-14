$(document).ready(function(){
    $('#editMaterial').modal({
        keyboard: true,
        backdrop: "static",
        show:false,
    }).on('show', function(){
          var getIdFromRow = $(this).data('orderid');
        //make your ajax call populate items or what even you need
        $(this).find('#details').html($('<b> Order Id selected: ' + getIdFromRow  + '</b>'))
    });
    
    $(".table-hover").find('tr[data-target]').on('click', function(){
        //or do your operations here instead of on show of modal to populate values to modal.
         $('#editMaterial').data('orderid',$(this).data('id'));
    });
    
});