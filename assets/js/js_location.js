$(function() {

$(document).on('click', '.del_pay_cust_hot', function(event){

    var op_id=$('#op_id_loc').val();
    var chamb_id=$('#chamb_id').val();
    id=$(this).data('id');
    if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
    {
      $.ajax({
        url:"backend/delete_pay_sup.php",
        method:'POST',
        data:{trans_id:id},
        success:function(data)
        {
          load_location(chamb_id,op_id);
        }
      });
    }
    else
    {
      return false;
    }
  });

$(document).on('blur', '.edit_loc', function(){
var op_id=$('#op_id_loc').val();
var chamb_id=$('#chamb_id').val();

    val=$(this).html(); val=val.replace('<br>',''); val=val.trim();
    loc_id=$(this).attr('id');
    field=$(this).data('id');
     $.ajax({
                     url:"backend/edit_loc.php",
                     method:"POST",
                     data:{val:val,loc_id:loc_id,field:field},
                     success:function(data)
                     {
                      load_location(chamb_id,op_id);
                     }
                });
  });

$(document).on('click', '.choose_cust_hot', function(){
  $('#cust_id').val($(this).attr('id'));
  $('#content_lib_cust_hot').val($(this).data('id'));
  $('#content_list_cust').hide();

  select_cust($(this).attr('id'));
  //$('#enregistrer_cli').attr("disabled", true);
  $('#enregistrer_loc').attr("disabled", false);
  $('#reset_loc').attr("disabled", false);
  //alert('lll');
})

$(document).on('submit', '#frm_customer', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_customer.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
      alert(data);
     $('#operation').val("Add");
     load_frm_customer('');

    }
   });
   $('#frm_customer')[0].reset();
});

$(document).on('click', '.place_state', function(){

    val=$(this).val();
    place_id=$(this).data('id');
    field='status';
     $.ajax({
                     url:"backend/edit_state_place.php",
                     method:"POST",
                     data:{val:val,place_id:place_id,field:field},
                     success:function(data)
                     {
                      //alert(data);
                     }
                });
                //alert('bon');
  });


$(document).on('keyup', '#content_id_cli', function(){
  autocomplet_cli();
 });

$(document).on('click', '.row_client_redev', function(){
  client=$(this).data("id");
  nom_cli=$(this).html();
  load_details_client(client,nom_cli);
 });

$(document).on('click', '#cli_redv_hot', function(){
  load_client_redev();
 });

$(document).on('click', '.det_facture_hot', function(){
  op_id=$(this).data('id');
  load_det_facture_hot(op_id);
 });

$(document).on('click', '#add_det_hot_tva', function(){
  var op_id=$(this).data('id');
  var tva=$('#val_tva').val();
  var chamb_id=$('#chamb_id').val();

  $.ajax({
    url:"backend/insert_det_hotel_tva.php",
    method:"POST",
    data:{op_id:op_id,tva:tva},
    success:function(data)
    {
     load_location(chamb_id,op_id);
    }
  })

 });

$(document).on('submit', '#frm_customer_hot', function(event){

  var op_id=$('#op_id_loc').val();
  var chamb_id=$('#chamb_id').val();

  event.preventDefault();
    $.ajax({
    url:"backend/insert_customer.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
      alert(data);
     //$('#operation').val("Add");
     load_location(chamb_id,op_id);
    }
   });
   $('#frm_customer_hot')[0].reset();
});

$(document).on('click', '#reset_loc', function(event){

  var op_id=$('#op_id_loc').val();
  var chamb_id=$('#chamb_id').val();
  $.ajax({
   url:"backend/reset_loc.php",
   success:function(data)
   {
    load_location(chamb_id,op_id);
   }
  })   
});

$(document).on('click', '#chambre', function(){
  load_chamb_tab();
 });

$(document).on('submit', '#frm_chambre', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_chambre.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {

     alert(data);
     load_chamb_tab();
     $('#operation').val("Add");

    }
   });

   $('#frm_chambre')[0].reset();
});




$(document).on('click', '.change_st', function(){

  var loc_id = $(this).attr("id");
  var status = $(this).data('id');

  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/chambre_state.php",
    method:"POST",
    data:{loc_id:loc_id,status:status},
    success:function(data)
    {
     alert(data);
     load_chamb_tab();
    }
    })
  }
  else
  {
   return false;
  }
 });

$(document).on('click', '.row_op_loc', function(){
var op_id=$(this).attr("id");
var chamb_id='';
$.ajax({
   url:"backend/fetch_op_loc.php",
   method:"POST",
   data:{op_id:op_id},
   success:function(data)
   {
    load_location(chamb_id,op_id);
   }
  })

});



$(document).on('click','#print_facture_loc', function(event){
var printable='facture'
printData(printable);
});

$(document).on('submit','#pay_facture_hot', function(event){

event.preventDefault(); 
var printable='facture'
var chamb_id=$('#chamb_id').val();
var op_id=$('#op_id_loc').val();
if(confirm("Etes-vous sur de vouloir payer cette facture ?"))
  {
$.ajax({
  url:"backend/insert_paie_cust_hot.php",
  method:"POST",
  data:new FormData(this),
  contentType:false,
  processData:false,
  success:function(data)
  {
  	alert(data);
    load_chamb_tab();
  }
})
//printData(printable);
}
else
{
  return false;
}

});

$(document).on('submit','#pay_facture_hot_2', function(event){
event.preventDefault(); 

var op_id=$('#op_id').val();

if(confirm("Etes-vous sur de vouloir payer cette facture ?"))
  {
$.ajax({
  url:"backend/insert_paie_cli_hot.php",
  method:"POST",
  data:new FormData(this),
  contentType:false,
  processData:false,
  success:function(data)
  {
     load_det_facture_hot(op_id); 
     load_acc_balance();
  }
})
}
else
{
  return false;
}

});

$(document).on('click', '#add_loc_red', function(){
  var id=$(this).data('id');
  var red=$('#val_red').val();
  var type_red=$('#type_red').val();
  var chamb_id=$('#chamb_id').val()
  var tot=$('#tot_amount').val()
  op_id=$('#op_id').val();

  $.ajax({
    url:"backend/insert_loc_red.php",
    method:"POST",
    data:{op_id:id,red:red,type_red:type_red,tot:tot},
    success:function(data)
    {
    alert(data);
    if(chamb_id=='')
    {
      load_location(chamb_id,id);
    }
    else
    {
     load_location(chamb_id,id);
     }
    }
  })

 });

$(document).on('click', '.close_location', function(){
  var id=$(this).attr('id');
  var chamb_id=$('#chamb_id').val()
  op_id=$('#op_id_loc').val();

  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
  $.ajax({
    url:"backend/save_location.php",
    method:"POST",
    data:{op_id:id,chamb_id:chamb_id},
    success:function(data)
    {
      //alert(data);
      load_location(chamb_id,op_id);
    }
  })
}
else
{
	return false;
}

 });

$(document).on('submit', '#frm_search_hist_loc', function(event){

  event.preventDefault();
  var client=$('#client_hist').val();
  var from_d=$('#datepicker').val();
  var to_d=$('#datepicker2').val();

  load_hist_loc_tab(client,from_d,to_d);
});

$(document).on('click', '.new_loc', function(){
	jour=$('#current_jour').val();
  //alert('ok');
  if(jour=='')
  {
    alert('Ouvrir d\'abord le Journal Svp!');
    //load_form_open_day();
  }
  else
  {
	chamb_id=$(this).data("id");
  op_id=$(this).attr("id");
	load_location(chamb_id,op_id);
 }
 });



$(document).on('click', '#hist_loc', function(){
  load_srch_hist_loc_tab();
 });

$(document).on('keyup', '#cni_clix', function(){
  var cni = $(this).val();
  $.ajax({
   url:"backend/fetch_single_cli.php",
   method:"POST",
   data:{cni:cni},
   dataType:"json",
   success:function(data)
   {
    //alert(data);
    
    if(data.nom.trim()!='')
    {
    $('#nom').val(data.nom);
    $('#person_id').val(data.id);
    $('#email').val(data.email);
    $('#genre').val(data.genre);
    $('#contact_cli').val(data.contact);
    $('#nat').val(data.nat);
    	$('#enregistrer_cli').attr("disabled", true);
    	$('#enregistrer_loc').attr("disabled", false);
    }
    else
    {
    	$('#enregistrer_cli').attr("disabled", false);
    	$('#enregistrer_loc').attr("disabled", true);
    }
   }

  })
 });

$(document).on('submit', '#frm_location', function(event){

hamb_id=$('#chamb_id').val();
op_id=$('#op_id').val();

  event.preventDefault();
    $.ajax({
    url:"backend/new_location.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    dataType:"json",
    success:function(data)
    {

     alert(data.msg);
     load_location(chamb_id,data.op_id);
    }
   });
   //alert('test');
});


$(document).on('change', '#select_cat_chamb', function(){
cat=$(this).val();
  $.ajax({
    url:"backend/filter_chambre.php",
    method:"POST",
    data:{cat:cat},
    success:function(data){
      //alert(data);
      $('#select_chamb_loc').html(data); 
    }
  });
 });

$(document).on('change', '#select_chamb_loc', function(){
chamb_id=$(this).val();
op_id=$('#op_id_loc').val();
load_location(chamb_id,op_id);
 });

$(document).on('click', '.change_st2', function(){
  var chamb_id = $(this).attr("id");
  op_id=$('#op_id_loc').val();
  var loc_id = $(this).data("id");

  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/chambre_state2.php",
    method:"POST",
    data:{loc_id:loc_id,chamb_id:chamb_id},
    success:function(data)
    {
     alert(data);
     load_location(chamb_id,op_id);
    }
  })

  }
  else
  {
   return false;
  }
 });

$(document).on('click', '.cancel_loc2', function(){
  var chamb_id = $(this).attr("id");
  var loc_id = $(this).data("id");

  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/delete_loc.php",
    method:"POST",
    data:{loc_id:loc_id,chamb_id:chamb_id},
    success:function(data)
    {
     alert(data);
     load_chamb_tab();
    }
  })

  }
  else
  {
   return false;
  }
 });

$(document).on('click', '.delete_chamb', function(){
  var chamb_id = $(this).attr("id");
  //var loc_id = $(this).data("id");

  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/delete_chamb.php",
    method:"POST",
    data:{chamb_id:chamb_id},
    success:function(data)
    {
     alert(data);
     load_chamb_tab();
    }
  })

  }
  else
  {
   return false;
  }
 });
//fin

})

function load_location(chamb_id,op_id)
{
  $.ajax({
    url:'tables/tab_location_chamb.php',
    method:'POST',
    data:{chamb_id:chamb_id,op_id:op_id},
    beforeSend : function ()
      {
         $("#page-content").html('loading...');
      },
    success:function(data)
    {
      $('#page-content').html(data);
    },
    error: function() {
    alert('La requête n\'a pas abouti'); }
  });
}

function load_location_paie()
{
  $.ajax({
    url:'tables/tab_location_paie.php',
    method:'POST',
    beforeSend : function ()
      {
         $("#page-content").html('loading...');
      },
    success:function(data)
    {
      $('#page-content').html(data);
    },
    error: function() {
    alert('La requête n\'a pas abouti'); }
  });
}

function load_srch_hist_loc_tab()
{
  $.ajax({
    type:'GET',
    url:'forms/frm_srch_hist_loc.php',
    beforeSend : function ()
      {
         $("#page-content").html('loading...');
      },
    success:function(data)
    {
      $('#page-content').html(data);

      jQuery('#datepicker').datepicker({
               autoclose: true
                , todayHighlight: true
                , format: 'yyyy-mm-dd'
              });

      jQuery('#datepicker2').datepicker({
               autoclose: true
                , todayHighlight: true
                , format: 'yyyy-mm-dd'
              });
    },
    error: function() {
    alert('La requête n\'a pas abouti'); }
  });
}

function load_hist_loc_tab(client,from_d,to_d)
{

  var haut='Réservation du ' + from_d + ' : Au : ' + to_d;
  var bas='Etabli par ' + $('#sess_name').html();
  var titre=$('#soft_title').html();
  //alert(from_d+'-'+to_d);
  $.ajax({
   url:"tables/tab_hist_loc.php",
   method:'POST',
   data:{client:client,from_d:from_d,to_d:to_d},
   beforeSend : function ()
      {
         $("#tab_hist_loc").html('Chargement...');
      },
   success:function(data)
   {

    $('#tab_hist_loc').html(data);
    $('#example23').DataTable({
                      "bInfo": false,

                      "bLengthChange": false,
                      dom: 'Bfrtip',
                      buttons: ['copy', 'csv',
                      {
              extend: 'excel',
              footer:true,
              title: titre,
              messageTop: haut,
              messageBottom: bas
                    }
                    ,
                    {
              extend: 'pdf',
              orientation: 'landscape',
              pageSize: 'LEGAL',
              footer:true,
              title: titre,
              messageTop: haut,
              messageBottom: bas
                    },
                  {
              extend: 'print',
              footer:true,
              title: titre,
              messageTop: haut,
              messageBottom: bas
                    }]
                     });

    }
    })
}

function load_chamb_form(cat_id)
{
  $.ajax({
   url:"forms/frm_chambre.php",
   method:'POST',
   data:{cat_id:cat_id},
    beforeSend:function(){
      $('#page-content').html("en Chargement ....");
    },
   success:function(data)
   {
    $('#page-content').html(data);
    $('#operation').data("Add");
    
   }
  })
}

function load_chamb_tab()
{
  $.ajax({

   url:"tables/tab_chambre.php",
   method:'GET',
   beforeSend : function ()
      {
         $("#page-content").html('Chargement...');
      },
   success:function(data)
   {
        $('#page-content').html(data);
        $('.tab').DataTable();

    }
    })
}

function load_client_redev()
{
  $.ajax({

   url:"tables/tab_client_redev.php",
   method:'GET',
   beforeSend : function ()
      {
         $("#page-content").html('Chargement...');
      },
   success:function(data)
   {
        $('#page-content').html(data);
        $('.dtab').DataTable({
                      paging : false,
                      "bLengthChange": false,
                      "bInfo": false,
                      searching : true
                     });

    }
    })
}

function load_details_client(client,nom_cli)
{
  titre='Facture Redevable : ' + nom_cli;

  $.ajax({
   url:"tables/tab_details_client.php",
   method:'GET',
   data:{client,client},
   beforeSend : function ()
      {
         $("#details_client").html('Chargement...');
      },
   success:function(data)
   {
        $('#details_client').html(data);
        $('.dtab2').DataTable({
                      paging : false,
                      "bLengthChange": false,
                      "bInfo": false,
                      searching : true,
                      footer:true,
                      dom: 'Bfrtip',
                      buttons: [{extend: 'pdf',footer:true,title: titre},
                                {extend: 'print',footer:true,title: titre}]
                     });

    }
    })
}

function load_det_facture_hot(op_id)
{
  $.ajax({
    /*type:'GET',*/
    url:'tables/tab_facture_hot_hist.php',
    method:'POST',
    data:{op_id:op_id},
    beforeSend : function ()
      {
         $("#page-content").html('loading...');
      },
    success:function(data)
    {
      $('#page-content').html(data);
    },
    error: function() {
    alert('La requête n\'a pas abouti'); }
  });
}

function autocomplet_cli() {
keyword = $('#content_id_cli').val();
  $.ajax({
    url: 'tables/refresh_cli.php',
    type: 'POST',
    data: {keyword:keyword},
    success:function(data){
      $('#content_list_id_cli').show();
      $('#content_list_id_cli').html(data);

          }
  });
}

function set_item_cli(item) {
  $('#content_id_cli').val(item);
  $('#content_list_id_cli').hide();
}