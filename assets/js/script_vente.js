$(function() {
/*setInterval(load_nb_valid, 5000);
setInterval(load_nb_send, 5000);*/
$(document).on('click', '.choose_unite', function(){
  var unite=$(this).attr('id');
  $.ajax({
    url:"backend/choose_unite.php",
    method:"POST",
    data:{unite:unite},
    success:function(data)
    {
     load_frm_info_client();
    }
  })
 });





$(document).on('click', '.new_vente_tab', function(){

  cust_id=$('#cust_sale_id').val();
  date_v=$('#datepicker').val();
  place=$(this).data('id');
  serv_id=$('#acc_ass').val();


  $.ajax({
   url:"backend/new_vente_2.php",
   method:"POST",
   data:{cust_id:cust_id,date_v:date_v,place:place,serv_id:serv_id},
   success:function(data)
   {
    //alert(data);
    $('#vente_id').val('');
    $('#operation_fact').val('New');
    load_frm_info_client();

   }
  })

});

$(document).on('click', '.new_vente_tab2', function(){

  cust_id=$('#cust_sale_id').val();
  date_v=$('#datepicker').val();
  place='0';
  serv_id=$(this).data('id');


  $.ajax({
   url:"backend/new_vente_2.php",
   method:"POST",
   data:{cust_id:cust_id,date_v:date_v,place:place,serv_id:serv_id},
   success:function(data)
   {
    //alert(data);
    $('#vente_id').val('');
    $('#operation_fact').val('New');
    load_frm_info_client();

   }
  })

});



$(document).on('click', '#edit_client', function(){
$('#edit_cust_sale').css("visibility", "visible");
 });

$(document).on('click', '#edit_serv', function(){
$('#edit_serv_sale').css("visibility", "visible");
 });

$(document).on('click', '#edit_table', function(){
$('#edit_table_sale').css("visibility", "visible");
 });

$(document).on('change', '#edit_cust_sale', function(){
client=$(this).val();
  $.ajax({
    url:"backend/edit_client.php",
    method:"POST",
    data:{client:client},
    success:function(data){
      $('#edit_cust_sale').css("visibility", "hidden");
      load_frm_info_client();
    }
  });


 });

$(document).on('change', '#edit_serv_sale', function(){
serv=$(this).val();
  $.ajax({
    url:"backend/edit_serv.php",
    method:"POST",
    data:{serv:serv},
    success:function(data){
      $('#edit_serv_sale').css("visibility", "hidden");
      load_frm_info_client();
    }
  });


 });
$(document).on('change', '#edit_table_sale', function(){
table=$(this).val();
  $.ajax({
    url:"backend/edit_table.php",
    method:"POST",
    data:{table:table},
    success:function(data){
      $('#edit_serv_sale').css("visibility", "hidden");
      load_frm_info_client();
    }
  });


 });

$(document).on('change', '#select_place', function(){
place=$(this).val();
  $.ajax({
    url:"backend/filter_table.php",
    method:"POST",
    data:{place:place},
    success:function(data){
      //alert(data);
      $('#edit_table_sale').html(data); 
    }
  });
 });




$(document).on('click', '.ch_cat', function(){
  cat=$(this).attr('id');
  test=$(this).data('id');
  //alert(cat);
  $.ajax({
    url:"backend/choose_cat.php",
    method:"POST",
    data:{cat:cat,test:test},
    success:function(data){
      load_frm_info_client();
    }
  });
});

$(document).on('click', '.ch_place', function(){
  place=$(this).attr('id');
  color=$(this).data('id');
  //alert(cat);
  $.ajax({
    url:"backend/choose_place.php",
    method:"POST",
    data:{place:place,color:color},
    success:function(data){
      load_frm_info_client();
    }
  });
});

$(document).on('keyup','#med_crt_t',function(){
  ass=$('#current_tarif').val();
  rech=$(this).val();
  load_current_tarif(ass,rech);
});

$(document).on('keyup', '#ch_receipt', function(){
  ch_paid=parseInt($('#ch_paid').val());
  ch_receipt=parseInt($(this).val());

  ch_back=ch_paid-ch_receipt;

  $('#ch_back').val(parseInt(ch_back).toString());
  //alert('ok');
 });

 $(document).on('change', '#current_tarif', function(){
  tarif=$("#current_tarif option:selected").text();
  if(tarif!='INTERNE')
  {
    $('.more_mfp').css('display','block');
  }
  else
  {
    $('.more_mfp').css('display','none');
  }

  ass=$(this).val();
  rech=$('#med_crt_t').val();
  load_current_tarif(ass,rech);
 });

$(document).on('click', '.aff_tarif', function(){
  ass=$(this).attr('id');
  load_tab_tarif_by_ass(ass);
 });

$(document).on('click', '.btn_valid', function(){
  //alert('ok');
  load_frm_info_client();

 });

$(document).on('click', '.btn_send', function(){
  load_frm_cmd();
 });

$(document).on('click', '.aff_tarif', function(){
  ass=$(this).attr('id');
  load_tab_tarif_by_ass(ass);
 });

$(document).on('keyup', '#prod_prix_v', function(){
  pv=parseInt($(this).val());
  pa=parseInt($('#prod_prix').val());
  benef=((pv-pa)/pa)*100;
  //alert(pv.toString());
  $("#benef").val(parseInt(benef).toString());
 });

$(document).on('keyup', '#prod_prix', function(){
  pa=parseInt($(this).val());
  pv=parseInt($('#prod_prix_v').val());
  benef=((pv-pa)/pa)*100;
  //alert(pv.toString());
  $("#benef").val(parseInt(benef).toString());
 });

$(document).on('click', '#jour_op', function(){
  load_srch_jour_op_tab();
 });

 $(document).on('submit', '#frm_search_jour_op', function(event){

  event.preventDefault();
  var user=$('#caisser_op').val();
  var from_d=$('#datepicker').val();
  var to_d=$('#datepicker2').val();

  load_jour_op_tab(user,from_d,to_d);


});

$(document).on('change','#current_pos',function(){
  pos=$(this).val();
  rech=$('#rech_prod_vente').val();
  $.ajax({
    url:"backend/current_stock.php",
    method:"POST",
    data:{pos:pos},
    success:function(data){
      load_product_list_vente(rech);
      load_tab_fact_non_paie();
    }
  });
});



$(document).on('click', '.choose_stk', function(){
  var choice=$(this).data('id');
  var rech=$('#rech_prod_vente').val();
  if(choice=='0')
  {
    $('#gros').removeClass('btn-default');
    $('#gros').addClass('btn-success');

    $('#det').removeClass('btn-success');
    $('#det').addClass('btn-default');
  }
  else if(choice=='1')
  {
    $('#det').removeClass('btn-default');
    $('#det').addClass('btn-success');

    $('#gros').removeClass('btn-success');
    $('#gros').addClass('btn-default');
  }

  $.ajax({
   url:"backend/choose_stk.php",
   method:"POST",
   data:{choice:choice},
   success:function(data)
   {
    load_product_list_vente(rech);
   }
  })
 });

$(document).on('click', '#client_ord', function(){
  jour=$('#current_jour').val();
  if(jour=='')
  {
    alert('Ouvrir d\'abord le Journal Svp!');
    load_form_open_day();
  }
  else
  {
  load_insert_vente();
  }
 });

$(document).on('click', '#cmd_serv', function(){
  jour=$('#current_jour').val();
  if(jour=='')
  {
    alert('Ouvrir d\'abord le Journal Svp!');
    load_form_open_day();
  }
  else
  {
  //load_page_vente_structure();
  load_frm_cmd();
  }
 });


$(document).on('click', '#new_valid', function(){

  $.ajax({
    url:"backend/end_session.php",
   method:"POST",
   success:function(data)
   {
    load_frm_cmd();
   }
  })

 });

$(document).on('click', '#cmd_enc', function(){
  load_cmd_non_valid_structure();
 });

$(document).on('keyup', '#rech_prod_vente', function(){
  rech=$(this).val();
  load_product_list_vente(rech);
  load_product_in_select(rech);
  //alert(rech);
 });

$(document).on('keyup', '#rech_prod_vente_code', function(){
  rech=$(this).val();
  prod_id="";

  $.ajax({
   url:"backend/fetch_insert_prod.php",
   method:"POST",
   data:{rech:rech},
   dataType:"json",
   success:function(data)
   {
    prod_id=data.prod_id;

  if(prod_id!=null)
  {
    insert_prod_on_key(prod_id);
    $('#rech_prod_vente_code').val("");
  }
   }
  });
/*load_product_list_vente_2(rech);


*/
 });

$(document).on('change', '#acc_cust', function(){
  var acc_id = $(this).val();

  $.ajax({
   url:"backend/fetch_single_info.php",
   method:"POST",
   data:{acc_id:acc_id},
   dataType:"json",
   success:function(data)
   {
    $('#service').val(data.service);
    $('#mat').val(data.mat);
    /*alert(data);*/
   },
    error: function() {
    alert('La requête n\'a pas aboutie'); }
  })
 });



$(document).on('submit','#pay_facture', function(event){

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
     load_insert_vente();
     load_acc_balance();
  }
})
//printData(printable);
}
else
{
  return false;
}

});

$(document).on('submit','#pay_facture_2', function(event){

event.preventDefault(); 

op_id=$('#op_id').val();
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
     load_det_facture(op_id);
     load_acc_balance();
  }
})
//printData(printable);
}
else
{
  return false;
}

});

$(document).on('click','#pay_facture_v', function(){

var m_pay=$(this).data('id');
var operation="Add";
var party_code=$('#fact_party_code').val();
var op_id=$('#fact_op_id').val();
var date_fact_pay=$('#date_fact_pay').val();
var mode_paie='Cash';
var cheque='-';
var printable='facture';

if(confirm("Etes-vous sur de vouloir payer cette facture ?"))
{
$.ajax({
  url:"backend/insert_paie_cli.php",
  method:"POST",
  data:{operation:operation, mont_du:m_pay, mont_trans:m_pay,party_code:party_code,op_id:op_id,date_trans:date_fact_pay,mode_paie:mode_paie,cheque:cheque},
  success:function(data)
  {
    alert(data);
     //load_frm_info_client();
     load_insert_vente();
     load_acc_balance();
  }
})
//printData(printable);
}
else
{
  return false;
}

});

$(document).on('click','#pay_facture_v2', function(){

var m_pay=$(this).data('id');
var operation="Add";
var party_code=$('#fact_party_code').val();
var op_id=$('#fact_op_id').val();
var date_fact_pay=$('#date_fact_pay').val();
var mode_paie='Banque';
var cheque='-';
var printable='facture';

//alert(op_id);

/*if(confirm("Etes-vous sur de vouloir payer cette facture ?"))
  {*/
/*var printable='facture';
printData(printable);*/
$.ajax({
  url:"backend/insert_paie_cli.php",
  method:"POST",
  data:{operation:operation, mont_du:m_pay, mont_trans:m_pay,party_code:party_code,op_id:op_id,date_trans:date_fact_pay,mode_paie:mode_paie,cheque:cheque},
  success:function(data)
  {
     load_frm_info_client();
     //load_insert_vente();
     load_acc_balance();


      
  }
})
//printData(printable);
/*}
else
{
  return false;
}*/

});

$(document).on('click', '#det_facture', function(){
  jour=$('#current_jour').val();
  //alert('ok');
  /*if(jour=='')
  {
    alert('Ouvrir d\'abord le Journal Svp!');
    load_form_open_day();
  }
  else
  {*/
  op_id=$(this).data('id');
  load_det_facture(op_id);
  //}
 });

$(document).on('click', '.det_facture', function(){
  jour=$('#current_jour').val();
  //alert('ok');
  op_id=$(this).data('id');
  load_det_facture(op_id);
 });

$(document).on('click', '#det_hist_facture', function(){
  load_det_hist_facture();
 });

$(document).on('click', '#hist_vente', function(){
  load_srch_hist_vente_tab();
 });

$(document).on('click', '#hist_vente_tva', function(){
  load_srch_hist_vente_tva();
 });

$(document).on('click', '#annul', function(){
  load_annul();
 });





$(document).on('click', '#print_rap', function(){
  var printable='rap_to_print';
  printData(printable);
 });

$(document).on('click', '#print_raps', function(){
  var printable='rap_to_prints';
  printData(printable);
 });



$(document).on('click', '#print_journal_op', function(){
  var printable='tab_journal_op';
  printData(printable);
 });

$(document).on('click', '#print_hist_facture', function(){
  var printable='facture_hist';
  printData(printable);
 });

$(document).on('click', '#vente_details', function(){
  var id_state = $(this).data("id");
  //alert(id);
  if(id_state==0)
  {
    load_det_vente();
    $(this).html("<i class='fa fa-minus'></i> Produits");
    $(this).data("id",1);
  }
  else if(id_state==1)
  {
    //load_product_list_vente();
    load_rech_prod_vente_form();
    $(this).html("<i class='fa fa-plus'></i> Détails");
    $(this).data("id",0);
  }

});

//search account
$(document).on('submit', '#frm_new_vente', function(event){

  event.preventDefault();

  var acc_id=$('#cust_sale_id').val();
  var date_v=$('#datepicker').val();

  $.ajax({
   url:"backend/new_vente.php",
   method:"POST",
   data:new FormData(this),
   contentType:false,
   processData:false,
   success:function(data)
   {


    //alert(data);
    $('#vente_id').val('');
    $('#frm_new_vente')[0].reset();
    $('#lib_cmd').html('Nouveau');
    $('#operation_fact').val('New');

    load_frm_info_client();

   }
  })

});



$(document).on('click', '.row_op_cmd', function(){
var op_id=$(this).data("id");
$.ajax({
   url:"backend/fetch_op_vente.php",
   method:"POST",
   data:{op_id:op_id},
   success:function(data)
   {
    load_frm_cmd();
   }
  })

});

$(document).on('click', '.row_op_vente_valid', function(){

var op_id=$(this).data("id");

$.ajax({
   url:"backend/fetch_op_vente.php",
   method:"POST",
   data:{op_id:op_id},
   dataType:"json",
   success:function(data)
   {
    load_det_vente_valid();
   }
  })
});

$(document).on('submit', '#vente_prod_form', function(event){


  event.preventDefault();
  if($('#op_vente_id').val()=="")
  {
    alert('Choisir d\'abord l\'operation');
  }
  else
  {

    $.ajax({
    url:"backend/insert_vente.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
     //alert(data);
     //load_crt_det_vente();
     load_frm_info_client();
     
     $('#action').val("Add");
     $('#operation').val("Add");

    }

   });
    $('#vente_prod_form')[0].reset();
    
  }

});

$(document).on('click', '.update_det_vente', function(){

  var det_id = $(this).attr("id");

  $.ajax({
   url:"backend/fetch_single_appro.php",
   method:"POST",
   data:{det_id:det_id},
   dataType:"json",
   success:function(data)
   {

    $('#prod_det').val(data.prod_appro);
    $('#prod_id').val(data.prod_id);
    $('#prod_prix').val(data.prod_prix);
    $('#num_lot').val(data.num_lot);
    $('#date_exp').val(data.date_exp);
    $('#det_id').val(det_id);

    $('#prod_qt').val(data.prod_qt);

    $('#vente_id').val(det_id);

    $('#action').val("Edit");
    $('#operation').val("Edit");
    //$('#lab_action').html("Modifier");



   },
    error: function() {
    alert('La requête n\'a pas aboutie'); }
  })
 });







$(document).on('click', '.send_sale', function(){
  var operation_id = $(this).attr("id");

  if(confirm("Etes-vous sur de vouloir effectuer cette envoyer cette vente ?"))
  {
   $.ajax({
    url:"backend/send_vente.php",
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

$(document).on('click', '.valid_op_vente', function(){
  var op_id = $(this).attr("id");

  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/valid_operation.php",
    method:"POST",
    data:{op_id:op_id},
    success:function(data)
    {
     //alert(data);
     load_frm_cmd();
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

$(document).on('click', '#is_send', function(){
  var op_id = $(this).data("id");
  //alert('ok');
   $.ajax({
    url:"backend/send_operation.php",
    method:"POST",
    data:{op_id:op_id},
    success:function(data)
    {
     //alert(data);
     load_vente_form();
    },
   error: function() {
    alert('La requête n\'a pas aboutie'); }
  })

 });


$(document).on('click', '.row_prod_vente', function(){

var prod_id=$(this).data("id");
var rech=$('#rech_prod_vente').val();
//alert('select ok ok ');

$.ajax({
   url:"backend/insert_vente_client.php",
   method:"POST",
   data:{prod_id:prod_id},
   //dataType:"json",
   success:function(data)
   {

    $('#prod_det').val(data.prod_appro);
    $('#prod_id').val(data.prod_id);
    $('#prod_prix').val(data.prod_prix);
    $('#prod_cat').html(data.prod_cat);



     //alert(data);
     load_tab_fact_non_paie();
     load_det_vente();
     load_product_list_vente(rech);
   },
    error: function() {
    alert('La requête n\'a pas aboutie'); }

  })
});

//search period customers
$(document).on('submit', '#frm_search_hist_vente', function(event){

  event.preventDefault();
  var client=$('#client_hist').val();
  var from_d=$('#datepicker').val();
  var to_d=$('#datepicker2').val();
  var pos=$('#pos_rap').val();

  load_hit_vente_tab(client,from_d,to_d,pos);


});

$(document).on('submit', '#frm_search_hist_vente_tva', function(event){

  event.preventDefault();
  var client=$('#client_hist').val();
  var from_d=$('#datepicker').val();
  var to_d=$('#datepicker2').val();
  var pos=$('#pos_rap').val();

  load_hist_vente_tva(client,from_d,to_d,pos);
});

$(document).on('submit', '#frm_srch_annul', function(event){

  event.preventDefault();
  var from_d=$('#fromd').val();
  var to_d=$('#tod').val();
  load_annul_tab(from_d,to_d);
});

$(document).on('click', '#glob_fact', function(event){

  event.preventDefault();
  var client=$('#client_hist').val();
  var from_d=$('#datepicker').val();
  var to_d=$('#datepicker2').val();
  var pos=$('#pos_rap').val();

  load_glob_fact(client,from_d,to_d,pos);


});

$(document).on('click', '.vente_non_paie', function(event){

  var client=$(this).data('id');

  load_vente_non_paie_tab(client);


});

$(document).on('click', '.row_op_vente_hist', function(){

var op_id=$(this).data("id");
var client=$('#client_hist').val();
var from_d=$('#datepicker').val();
var to_d=$('#datepicker2').val();



$.ajax({
   url:"backend/fetch_op_vente_hist.php",
   method:"POST",
   data:{op_id:op_id},
   //dataType:"json",
   success:function(data)
   {
    load_det_hist_vente();

   }
  })

});

})

function load_product_list_vente($rech)
{
  $.ajax({
    //type:'GET',
    url:'tables/tab_product_prodf_vente.php',
    method:'POST',
    data:{rech:rech},
    beforeSend : function ()
      {
         $("#tab_srched_prod").html('Chargement ...');
      },
    success:function(data)
    {
    $('#tab_srched_prod').html(data);
    //$('#tab_srched_prod').fadeIn("slow");
    $('#example22').DataTable({
                      "bInfo": false,
                      "bLengthChange": false,
                      bFilter:false
                      /*dom: 'Bfrtip',
                      buttons: ['copy', 'csv', 'excel', 'pdf', 'print']*/
                     });
    }
  });
}

function load_product_list_vente_2($rech)
{
  $.ajax({
    //type:'GET',
    url:'tables/tab_product_prodf_vente_2.php',
    method:'POST',
    data:{rech:rech},
    beforeSend : function ()
      {
         $("#tab_srched_prod").html('Chargement ...');
      },
    success:function(data)
    {
    $('#tab_srched_prod').html(data);
    //$('#tab_srched_prod').fadeIn("slow");
    $('#example22').DataTable({
                      "bInfo": false,
                      "bLengthChange": false,
                      bFilter:false
                      /*dom: 'Bfrtip',
                      buttons: ['copy', 'csv', 'excel', 'pdf', 'print']*/
                     });
    }
  });
}

function load_product_in_select($rech)
{
  $.ajax({
    //type:'GET',
    url:'tables/filtre_select_prod.php',
    method:'POST',
    data:{rech:rech},
    success:function(data)
    {
    $('#filtre_select_prod').html(data);

    }
  });
}

function load_rech_prod_vente_form()
{

  //alert(acc_id);
  $.ajax({
    type:'GET',
    url:'forms/frm_rech_prod_vente.php',
    beforeSend:function(){
      $('#list_prod_vente').html("en Chargement ....");
    },
    success:function(data)
    {
      $('#list_prod_vente').html(data);
    }
  });
}

function load_vente_form()
{

  //alert(acc_id);
  $.ajax({
    type:'GET',
    url:'forms/frm_vente.php',
    beforeSend:function(){
      $('#vente_form').html("en Chargement ....");
    },
    success:function(data)
    {
      $('#vente_form').html(data);
    }
  });
}

function load_frm_info_client()
{
  

  $.ajax({
    type:'GET',
    url:'forms/frm_new_vente.php',
    beforeSend : function ()
      {
         $("#page-content").html('loading...');
      },
    success:function(data)
    {
       $('#page-content').html(data);
       //$('#operation_fact').val("New");
       //$('#lib_cmd').html('Nouveau');
       $('.tab').dataTable();


    },
    error: function() {
    alert('La requête n\'a pas abouti'); }
  });
  $('#rech_prod_vente_code').focus();
  $('.more_mfp').toggle();
}

function load_frm_cmd()
{
  $.ajax({
    type:'GET',
    url:'forms/frm_new_cmd.php',
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
  $('#rech_prod_vente_code').focus();
}

function loadFocus() {
  $('#rech_prod_vente_code').focus();
}
function load_tab_fact_non_paie()
{
  $.ajax({
    type:'GET',
    url:'tables/tab_fact_non_paie.php',
    /*beforeSend : function ()
      {
         $("#info_fact_non_paie").html('loading...');
      },*/
    success:function(data)
    {
      $('#info_fact_non_paie').html(data);
      $('#example2a').DataTable({
                      "bInfo": false,

                      "bLengthChange": false
                      /*dom: 'Bfrtip',
                      buttons: ['copy', 'csv', 'excel', 'pdf', 'print']*/
                     });
    }/*,
    error: function() {
    alert('La requête n\'a pas abouti'); }*/
  });
}

function load_tab_cmd_non_valid()
{
  $.ajax({
    url:'tables/tab_fact_non_valid.php',
    /*beforeSend : function ()
      {
         $("#info_fact_non_valid").html('loading...');
      },*/
    success:function(data)
    {
      $('#info_fact_non_valid').html(data);
      $('#example2x').DataTable({
                      "bInfo": false,
                      "bLengthChange": false,
                      dom: 'Bfrtip',
                      buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                     });
    }/*,
    error: function() {
    alert('La requête n\'a pas abouti'); }*/
  });
}



function load_det_vente()
{
  $.ajax({
    type:'GET',
    url:'tables/tab_det_vente.php',
    beforeSend : function ()
      {
         $("#vente_form").html('loading...');
      },
    success:function(data)
    {
      $('#vente_form').html(data);
      $('#example22a').DataTable({
                      "bInfo": false,
                      "bLengthChange": false,
                      dom: 'Bfrtip',
                      buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                     });
    },
    error: function() {
    alert('La requête n\'a pas abouti'); }
  });
}

function load_det_vente_valid()
{
  $.ajax({
    type:'GET',
    url:'tables/tab_det_vente_valid.php',
    beforeSend : function ()
      {
         $("#list_prod_vente").html('loading...');
      },
    success:function(data)
    {
      $('#list_prod_vente').html(data);
      $('#example22').DataTable({
                      "bInfo": false,
                      "bLengthChange": false,
                      dom: 'Bfrtip',
                      buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                     });
    },
    error: function() {
    alert('La requête n\'a pas abouti'); }
  });
}

function load_det_facture(op_id)
{
  $.ajax({
    /*type:'GET',*/
    url:'tables/tab_current_fact.php',
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

function load_det_hist_facture()
{
  $.ajax({
    type:'GET',
    url:'tables/tab_hist_fact.php',
    beforeSend : function ()
      {
         $("#hist_vente_tab").html('loading...');
      },
    success:function(data)
    {
      $('#hist_vente_tab').html(data);
    },
    error: function() {
    alert('La requête n\'a pas abouti'); }
  });
}

function load_det_hist_vente()
{
  $.ajax({
    type:'GET',
    url:'tables/tab_det_hist_vente.php',
    beforeSend : function ()
      {
         $("#hist_vente_tab").html('loading...');
      },
    success:function(data)
    {
      $('#hist_vente_tab').html(data);
    },
    error: function() {
    alert('La requête n\'a pas abouti'); }
  });
}

function load_page_vente_structure()
{

  $.ajax({
   url:"tables/tab_info_vente.php",
   success:function(data)
   {
    $('#page-content').html(data);
    //load_frm_info_client();
    load_tab_fact_non_paie();
    //load_vente_form();
    load_det_vente();
    //load_product_list_vente();
    load_rech_prod_vente_form();
   }
  })
}

function load_cmd_non_valid_structure()
{

  $.ajax({
   url:"tables/tab_cmd_non_valid.php",
   success:function(data)
   {
    $('#page-content').html(data);
    load_tab_cmd_non_valid();
   }
  })
}

function printData(printable)
{
   var divToPrint=document.getElementById(printable);
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}

function load_srch_hist_vente_tab()
{
  $.ajax({
    type:'GET',
    url:'forms/frm_srch_hist_vente.php',
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

function load_srch_hist_vente_tva()
{
  $.ajax({
    type:'GET',
    url:'forms/frm_srch_hist_vente_tva.php',
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

function load_annul()
{
  $.ajax({
    type:'GET',
    url:'forms/frm_srch_annul.php',
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

function load_hit_vente_tab(client,from_d,to_d,pos)
{
var stock = $("#pos_rap option:selected").text();
var today = new Date();
var dd = today.getDate();

if(stock=='Tous')
{
  stock='GENERAL';
}

var mm = today.getMonth()+1;
var yyyy = today.getFullYear();
if(dd<10)
{
    dd='0'+dd;
}

if(mm<10)
{
    mm='0'+mm;
}
today = yyyy+'/'+mm+'/'+dd;

  var haut='Historique des Ventes du ' + from_d + ' : Au : ' + to_d + ' / Stock : '+ stock ;
  var bas='Etabli par ' + $('#sess_name').html() + ' à la date du ' + today ;
  var titre=$('#MOTEL').html();

  $.ajax({
   url:"tables/tab_hist_vente.php",
   method:'GET',
   data:{client:client,from_d:from_d,to_d:to_d,pos:pos},
   beforeSend : function ()
      {
         $("#tab_hist_vente").html('Chargement...');
      },
   success:function(data)
   {

    $('#tab_hist_vente').html(data);
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

function load_hist_vente_tva(client,from_d,to_d,pos)
{
var stock = $("#pos_rap option:selected").text();
var today = new Date();
var dd = today.getDate();

if(stock=='Tous')
{
  stock='GENERAL';
}

var mm = today.getMonth()+1;
var yyyy = today.getFullYear();
if(dd<10)
{
    dd='0'+dd;
}

if(mm<10)
{
    mm='0'+mm;
}
today = yyyy+'/'+mm+'/'+dd;

  var haut='Rapport des Ventes du ' + from_d + ' : Au : ' + to_d + ' / Stock : '+ stock ;
  var bas='Etabli par ' + ' à la date du ' + today ;
  var titre=$('#ATRIUM LOUNGE').html();

  $.ajax({
   url:"tables/tab_hist_vente_tva.php",
   method:'GET',
   data:{client:client,from_d:from_d,to_d:to_d,pos:pos},
   beforeSend : function ()
      {
         $("#tab_hist_vente").html('Chargement...');
      },
   success:function(data)
   {

    $('#tab_hist_vente').html(data);
    $('#example23').DataTable({
                      "bInfo": false,
                      "ordering":false,
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

function load_annul_tab(from_d,to_d)
{
  $.ajax({
   url:"tables/tab_annul.php",
   method:'GET',
   data:{from_d:from_d,to_d:to_d},
   beforeSend : function ()
      {
         $("#tab_annul").html('Chargement...');
      },
   success:function(data)
   {
    $('#tab_annul').html(data);
    }
    })
}

function load_glob_fact(client,from_d,to_d,pos)
{
  $.ajax({
   url:"tables/tab_glob_fact.php",
   method:'GET',
   data:{client:client,from_d:from_d,to_d:to_d,pos:pos},
   beforeSend : function ()
      {
         $("#tab_hist_vente").html('Chargement...');
      },
   success:function(data)
   {

    $('#tab_hist_vente').html(data);
    $('#example23').DataTable({
                      "bInfo": false,

                      "bLengthChange": false,
                      dom: 'Bfrtip',
                      buttons: ['copy', 'csv','excel','print','pdf']
                     });

    }
    })
}

function load_vente_non_paie_tab(client)
{

var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1;
var yyyy = today.getFullYear();
if(dd<10)
{
    dd='0'+dd;
}

if(mm<10)
{
    mm='0'+mm;
}
today = yyyy+'/'+mm+'/'+dd;

  var haut='Factures Impayées';
  var bas='Etabli par ' + $('#sess_name').html() + '\n à la date du ' + today ;
  var titre=$('#MOTEL').html();

  $.ajax({
   url:"tables/tab_vente_non_paie.php",
   method:'GET',
   data:{client:client},
   beforeSend : function ()
      {
         $("#page-content").html('Chargement...');
      },
   success:function(data)
   {

    $('#page-content').html(data);
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

function load_tab_tarif_by_ass(ass)
{

var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1;
var yyyy = today.getFullYear();
if(dd<10)
{
    dd='0'+dd;
}

if(mm<10)
{
    mm='0'+mm;
}
today = yyyy+'/'+mm+'/'+dd;

  var haut='Tarifs de vente';
  var bas='Etabli par ' + $('#sess_name').html() + '\n à la date du ' + today ;
  var titre=$('#MOTEL').html();

  $.ajax({
   url:"tables/tab_tarif.php",
   method:'GET',
   data:{ass:ass},
   beforeSend : function ()
      {
         $("#page-content").html('Chargement...');
      },
   success:function(data)
   {

    $('#page-content').html(data);
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

function load_acc_balance_vente()
{
  $.ajax({
    type:'GET',
    url:'forms/acc_balance.php',
    success:function(data)
    {
      $('#acc_balance').html(data);
    }
  });
}

function load_edit_hist_vente()
{
  var client=$('#client_hist').val();
  var from_d=$('#datepicker').val();
  var to_d=$('#datepicker2').val();

  load_hit_vente_tab(client,from_d,to_d);
}

function load_srch_jour_op_tab()
{
  $.ajax({
    type:'GET',
    url:'forms/frm_srch_jour_op.php',
    beforeSend : function ()
      {
         $("#page-content").html('loading...');
      },
    success:function(data)
    {
      $('#page-content').html(data);

      $('#datepicker').datepicker({
               autoclose: true
                , todayHighlight: true
                , format: 'yyyy-mm-dd'
              });

      $('#datepicker2').datepicker({
               autoclose: true
                , todayHighlight: true
                , format: 'yyyy-mm-dd'
              });
    },
    error: function() {
    alert('La requête n\'a pas abouti'); }
  });
}

function load_jour_op_tab(user,from_d,to_d)
{
  $.ajax({
   url:"tables/tab_jour_op.php",
   method:'GET',
   data:{user:user,from_d:from_d,to_d:to_d},
   beforeSend : function ()
      {
         $("#tab_jour_op").html('Chargement...');
      },
   success:function(data)
   {

    $('#tab_jour_op').html(data);


    }
    })
}

function insert_prod_on_key(prod_id)
{
  $.ajax({
   url:"backend/insert_vente_client.php",
   method:"POST",
   data:{prod_id:prod_id},
   //dataType:"json",
   success:function(data)
   {
     //alert(data);
     //load_frm_info_client();
     load_crt_det_vente();
     $('#close_sale').css("visibility", "visible");
     $('#action').val("Add");
     $('#operation').val("Add");
   },
    error: function() {
    alert('La requête n\'a pas aboutie'); }

  })
}

function load_nb_valid()
{
  $.ajax({
    url:'backend/nb_valid.php',
    success:function(data)
    {
      $('.nb_valid').html(data);
    }
  });
}

function load_nb_send()
{
  $.ajax({
    url:'backend/nb_send.php',
    success:function(data)
    {
      $('.nb_send').html(data);
    }
  });
}

function load_current_tarif(ass,rech)
{
  $.ajax({
    url:"tables/tab_current_tarif.php",
    method:"POST",
    data:{ass:ass,rech:rech},
    success:function(data){
      $('#tab_current_tar').html(data);
    }
  });
}

function load_crt_det_vente()
{
  $.ajax({
    url:"tables/tab_det_vente_aff.php",
    method:"POST",
    success:function(data){
      $('#current_det_vente').html(data);
    }
  });
}

function load_insert_vente()
{
  
  $.ajax({
   url:"backend/new_vente.php",
   method:"GET",
   success:function(data)
   {
    //alert(data);
    load_frm_info_client();

   }
  })
}
