
$(function() {

$(document).key('shift+f1', function() {
  jour=$('#current_jour').val();
  if(jour=='')
  {
    alert('Ouvrir d\'abord le Journal Svp!');
    load_form_open_day();
  }
  else
  {
  load_main_menu('25');
  load_frm_info_client();
  }
 });

$(document).key('f2', function() {
  var printable='facture';
  printData(printable);
});

$(document).key('f3', function() {
  var printable='cmd_to_print';
  printData(printable);
});

$(document).key('f4', function(event) {

event.preventDefault();
var printable='facture'
if(confirm("Etes-vous sur de vouloir payer cette facture ?"))
  {
$.ajax({
  url:"backend/insert_paie_cli.php",
  method:"POST",
  data:new FormData(this),
  contentType:false,
  processData:false,
  success:function(data)
  {
     load_frm_info_client();
     load_acc_balance();
  }
})
printData(printable);
}
else
{
  return false;
}

});

$(document).key('f6', function() {
  var operation_id = $(this).attr("id");

  if(confirm("Etes-vous sur de vouloir effectuer cette sauvegarde de vente ?"))
  {
   $.ajax({
    url:"backend/save_vente.php",
    method:"POST",
    data:{operation_id:operation_id},
    success:function(data)
    {
     //alert(data);
     load_frm_info_client();
    },
    error: function() {
    alert('La requête n\'a pas abouti'); }
  })

  }
  else
  {
   return false;
  }

 });

$(document).key('f7', function() {
  $.ajax({
    url:"backend/end_session.php",
   method:"POST",
   success:function(data)
   {
    load_frm_info_client();
   }
  })

 });

$(document).key('f8', function() {
  $.ajax({
    url:"backend/new_cmd.php",
    method:"POST",
    success:function(data){
      load_frm_info_client();
    }
  });
});


})