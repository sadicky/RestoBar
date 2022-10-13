$(function() {

$(document).on('click', '#cancel_action_ent', function(){
  $.ajax({
   url:"backend/end_session_ent.php",
   success:function(data)
   {
    load_frm_new_entre_prodf();
   }
  })

 });

$(document).on('click', '#cancel_action_conv', function(){
  $.ajax({
   url:"backend/end_session_ent.php",
   success:function(data)
   {
    load_frm_new_conversion();
   }
  })

 });

$(document).on('click', '.row_edit_entre_hist', function(event){
  entre_id=$(this).data('id');

    $.ajax({
    url:"backend/create_session_appro.php",
    method:'POST',
    data:{entre_id:entre_id},
    success:function(data)
    {
      load_frm_new_entre_prodf();
    }
   });
});


$(document).on('click', '.row_edit_conv_hist', function(event){
  conv_id=$(this).data('id');

    $.ajax({
    url:"backend/create_session_appro.php",
    method:'POST',
    data:{conv_id:conv_id},
    success:function(data)
    {
      load_frm_new_conversion();
    }
   });
});

$(document).on('click', '.print_entre', function(){
var op_id=$(this).attr('id');
  load_tab_bon_entre_pf(op_id);

 });
$(document).on('click', '.print_conv', function(){
var op_id=$(this).attr('id');
  load_tab_bon_conv(op_id);

 });

$(document).on('click', '#hist_entre_pf', function(){
  //alert('cool');
  load_srch_hist_entre_tab();
 });

$(document).on('click', '#hist_conv', function(){
  //alert('cool');
  load_srch_hist_conv_tab();
 });

$(document).on('submit', '#frm_search_hist_entre_pf', function(event){

  event.preventDefault();

  var from_d=$('#datepicker').val();
  var to_d=$('#datepicker2').val();
  var pos=$('#pos_rap').val();
  load_hist_entre_tab(from_d,to_d,pos);


});

$(document).on('submit', '#frm_search_hist_conv', function(event){

  event.preventDefault();

  var from_d=$('#datepicker').val();
  var to_d=$('#datepicker2').val();
  var pos=$('#pos_rap').val();
  load_hist_conv_tab(from_d,to_d,pos);


});

  $(document).on('click', '#entre_prodf', function(){
    //jour=$('#current_jour').val();
  load_frm_new_entre_prodf();
  
 });

$(document).on('click', '#convers', function(){
    //jour=$('#current_jour').val();
  load_frm_new_conversion();
  
 });


$(document).on('keyup', '#rech_prod_entre_pf', function(){
  rech=$(this).val();
  load_product_list_entre(rech);
 });

$(document).on('submit', '#frm_new_entre_pf', function(event){

event.preventDefault();

  var date_ent=$('#datepicker').val();
  var motif=$('#motif').val();
  var op_an_id=$('#op_an_id').val();
  var pos=$('#from_pos').val();
  var party_code=$('#party_code').val();

  $.ajax({
   url:"backend/new_entre_pf.php",
   method:"POST",
   data:{date_ent:date_ent,party_code:party_code,op_an_id:op_an_id,pos:pos},
   success:function(data)
   {
    //alert(data);
    load_frm_new_entre_prodf();
   }
  })
});

$(document).on('submit', '#frm_new_conv', function(event){

event.preventDefault();

  var date_ent=$('#datepicker').val();
  var motif=$('#motif').val();
  var op_an_id=$('#op_an_id').val();
  var pos=$('#from_pos').val();
  var party_code=$('#party_code').val();

  $.ajax({
   url:"backend/new_conversion.php",
   method:"POST",
   data:{date_ent:date_ent,party_code:party_code,op_an_id:op_an_id,pos:pos},
   success:function(data)
   {
    //alert(data);
    load_frm_new_conversion();
   }
  })
});

$(document).on('submit', '#entre_pf_form', function(event){
  var rech=$('#rech_prod_entre_pf').val();

  event.preventDefault();
  if($('#op_id').val()=="")
  {
    alert('Choisir d\'abord l\'operation');
  }
  else
  {

    $.ajax({
    url:"backend/insert_entre_pf.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {

     //alert(data);
     load_product_list_entre(rech);
     load_details_entre();
     $('#lab_action').html("Enregistrer");
     $('#action').val("Add");
     $('#operation').val("Add");
     $('#save_entre_pf').css("visibility","visible");
     $('#cancel_action_ent').css("visibility","hidden");
    }

   });
  $('#entre_pf_form')[0].reset();
  }

});

$(document).on('submit', '#conv_form', function(event){

  event.preventDefault();
  if($('#op_id').val()=="")
  {
    alert('Choisir d\'abord l\'operation');
  }
  else
  {

    $.ajax({
    url:"backend/insert_conversion.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
     load_details_conv();
     $('#lab_action').html("Enregistrer");
     $('#action').val("Add");
     $('#operation').val("Add");
     $('#save_conv').css("visibility","visible");
     $('#cancel_action_ent').css("visibility","hidden");
    }

   });
  $('#conv_form')[0].reset();
  }

});

$(document).on('click', '.update_det_entre_pf', function(){
  //alert('modif')
  var det_id = $(this).attr("id");
  //alert(det_id);
  $.ajax({
   url:"backend/fetch_single_appro.php",
   method:"POST",
   data:{det_id:det_id},
   dataType:"json",
   success:function(data)
   {

    $('#prod_det').val(data.prod_appro);
    $('#content_id').val(data.prod_appro);
    $('#prod_id').val(data.prod_id);
    $('#prod_prix').val(data.prod_prix);

    $('#det_id').val(det_id);

    $('#prod_qt').val(data.prod_qt);

    $('#entre_pf_id').val(det_id);

    $('#action').val("Edit");
    $('#operation').val("Edit");
    $('#lab_action').html("Modifier");

    //alert(data);

   },
    error: function() {
    alert('La requête n\'a pas aboutie'); }
  })
 });


$(document).on('click', '.update_det_conv', function(){
  //alert('modif')
  var det_id = $(this).attr("id");
  //alert(det_id);
  $.ajax({
   url:"backend/fetch_single_appro.php",
   method:"POST",
   data:{det_id:det_id},
   dataType:"json",
   success:function(data)
   {

    $('#prod_det').val(data.prod_appro);
    $('#content_id_ent').val(data.prod_appro);
    $('#prod_id').val(data.prod_id);
    $('#prod_prix').val(data.prod_prix);
    $('#lot').val(data.lot);
    $('#month').val(data.month);
    $('#year').val(data.year);

    $('#det_id').val(det_id);

    $('#prod_qt').val(data.prod_qt);

    $('#conv_id').val(det_id);

    $('#action').val("Edit");
    $('#operation').val("Edit");
    $('#lab_action').html("Modifier");

    //alert(data);

   },
    error: function() {
    alert('La requête n\'a pas aboutie'); }
  })
 });

$(document).on('click', '.choose_for_conv', function(){
  //alert('modif')
  var det_id = $(this).attr("id");
  //alert(det_id);
  $.ajax({
   url:"backend/fetch_single_appro.php",
   method:"POST",
   data:{det_id:det_id},
   dataType:"json",
   success:function(data)
   {
    $('#lot').val(data.lot);
    $('#month').val(data.month);
    $('#year').val(data.year);
   },
    error: function() {
    alert('La requête n\'a pas aboutie'); }
  })
 });

$(document).on('click', '.delete_det_entre_pf', function(){
  var det_id = $(this).attr("id");
  var rech=$('#rech_prod_entre_pf').val();
  //alert(det_id);
  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/delete_ent.php",
    method:"POST",
    data:{det_id:det_id},
    success:function(data)
    {
     alert(data);
     load_details_conv();

    },
    error: function() {
    alert('La requête n\'a pas abouti'); }
  })

  }
  else
  {
   return false;
  }
  /*load_hist_prod_tab_after_del();*/
 });

$(document).on('click', '.delete_det_conv', function(){
  var det_id = $(this).attr("id");
  var rech=$('#rech_prod_entre_pf').val();
  //alert(det_id);
  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/delete_conv.php",
    method:"POST",
    data:{det_id:det_id},
    success:function(data)
    {
     alert(data);
     load_details_conv();

    },
    error: function() {
    alert('La requête n\'a pas abouti'); }
  })

  }
  else
  {
   return false;
  }
  /*load_hist_prod_tab_after_del();*/
 });

$(document).on('click', '.row_prod_entre_pf', function(){

var prod_id=$(this).data("id");

//alert('select ok ok ' + prod_id);

$.ajax({
   url:"backend/fetch_prod_appro.php",
   method:"POST",
   data:{prod_id:prod_id},
   dataType:"json",
   success:function(data)
   {
    $('#prod_det').val(data.prod_appro);
    $('#prod_id').val(data.prod_id);
    $('#prod_prix').val(data.prod_prix);
    $('#prod_cat').html(data.prod_cat);

    //alert(data);

   },
    error: function() {
    alert('La requête n\'a pas aboutie'); }

  })
});

$(document).on('click', '#save_entre_pf', function(){

op_id=$('#op_id').val();
  if(confirm("Etes-vous sur de vouloir sauvegarder cette opération ?"))
  {
  $.ajax({
   url:"backend/add_pf_quantity_stock.php",
   method:"GET",
   beforeSend:function()
   {
    $('#save_text').html('<p class="text-success">Enregistrement ....</p>');
   },
   success:function(data)
   {
    //load_frm_new_entre_prodf();
    load_tab_bon_entre_pf(op_id);
   }
  })

  }
  else
  {
    return false;
  }
});

$(document).on('click', '#save_conv', function(){
op_id=$('#op_id').val();
  if(confirm("Etes-vous sur de vouloir sauvegarder cette opération ?"))
  {
  $.ajax({
   url:"backend/add_conv_quantity_stock.php",
   method:"GET",
   beforeSend:function()
   {
    $('#save_text').html('<p class="text-success">Enregistrement ....</p>');
   },
   success:function(data)
   {
    //load_frm_new_entre_prodf();
    load_tab_bon_conv(op_id);
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



function load_frm_new_entre_prodf()
{
  $.ajax({
   url:"forms/frm_new_entre_prodf.php",
   success:function(data)
   {
    $('#page-content').html(data);
    //alert(data);
   }
  })
}

function load_frm_new_conversion()
{
  $.ajax({
   url:"forms/frm_new_conversion.php",
   success:function(data)
   {
    $('#page-content').html(data);
    //alert(data);
   }
  })
}

function load_product_list_entre(rech)
{
  $.ajax({
    //type:'GET',
    url:'tables/tab_product_entre.php',
    method:'POST',
    data:{rech:rech},
    beforeSend : function ()
      {
         $("#tab_srched_prod").html('Chargement ...');
      },
    success:function(data)
    {
      $('#tab_srched_prod').html(data);
       $('#dataTables-example').DataTable({
                      "bInfo": false,
                      "bLengthChange": false,
                      bFilter:false
                      /*dom: 'Bfrtip',
                      buttons: ['copy', 'csv', 'excel', 'pdf', 'print']*/
                     });
    }
  });
}

function load_details_entre()
{
  $.ajax({
    type:'GET',
    url:'tables/tab_details_entre.php',
    beforeSend : function ()
      {
         $("#tab_details_entre").html('Chargement ...');
      },
    success:function(data)
    {
      $('#tab_details_entre').html(data);
    },
    error: function() {
    alert('La requête n\'a pas abouti'); }
  });
}

function load_details_conv()
{
  $.ajax({
    type:'GET',
    url:'tables/tab_details_conv.php',
    beforeSend : function ()
      {
         $("#tab_details_conv").html('Chargement ...');
      },
    success:function(data)
    {
      $('#tab_details_conv').html(data);
    },
    error: function() {
    alert('La requête n\'a pas abouti'); }
  });
}

function load_tab_bon_entre_pf(op_id)
{
  $.ajax({
   url:"tables/tab_bon_entre_pf.php",
   method:"POST",
   data:{op_id:op_id},
   success:function(data)
   {
    $('#page-content').html(data);
   }
  })
}

function load_tab_bon_conv(op_id)
{
  $.ajax({
   url:"tables/tab_bon_conv.php",
   method:"POST",
   data:{op_id:op_id},
   success:function(data)
   {
    $('#page-content').html(data);
   }
  })
}

function load_srch_hist_entre_tab()
{
  $.ajax({
    type:'GET',
    url:'forms/frm_srch_hist_entre_pf.php',
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

function load_srch_hist_conv_tab()
{
  $.ajax({
    type:'GET',
    url:'forms/frm_srch_hist_conv.php',
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

function load_hist_entre_tab(from_d,to_d,pos)
{
var stock = $("#pos_rap option:selected").text();
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

  var haut='POS : ' + stock + ' \n HISTORIQUE DES PRODUCTIONS DU ' + from_d + ' AU ' + to_d;
  var bas='Etabli par ' + $('#sess_name').html() + '\n A la date du ' + today ;
  var titre=$('#soft_title').html();

  $.ajax({
   url:"tables/tab_hist_entre_pf.php",
   method:'GET',
   data:{from_d:from_d,to_d:to_d,pos:pos},
   beforeSend : function ()
      {
         $("#tab_hist_entre_pf").html('Chargement...');
      },
   success:function(data)
   {

    $('#tab_hist_entre_pf').html(data);
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

function load_hist_conv_tab(from_d,to_d,pos)
{
var stock = $("#pos_rap option:selected").text();
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

  var haut='POS : ' + stock + ' \n HISTORIQUE DES CONVERSIONS DU ' + from_d + ' AU ' + to_d;
  var bas='Etabli par ' + $('#sess_name').html() + '\n A la date du ' + today ;
  var titre=$('#soft_title').html();

  $.ajax({
   url:"tables/tab_hist_conv.php",
   method:'GET',
   data:{from_d:from_d,to_d:to_d,pos:pos},
   beforeSend : function ()
      {
         $("#tab_hist_conv").html('Chargement...');
      },
   success:function(data)
   {

    $('#tab_hist_conv').html(data);
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
