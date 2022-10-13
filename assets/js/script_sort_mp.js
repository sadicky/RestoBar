$(function() {

$(document).on('click', '#cancel_action_sort', function(){
  $.ajax({
   url:"backend/end_session_sort.php",
   success:function(data)
   {
    load_frm_new_sort_mp();
   }
  })

 });

$(document).on('click', '#cancel_action_transf', function(){
  $.ajax({
   url:"backend/end_session_transf.php",
   success:function(data)
   {
    load_frm_new_transf_prod();
   }
  })

 });

$(document).on('click', '.row_edit_sort_hist', function(event){
  sort_id=$(this).data('id');

    $.ajax({
    url:"backend/create_session_appro.php",
    method:'POST',
    data:{sort_id:sort_id},
    success:function(data)
    {
      load_frm_new_sort_mp();
    }
   });
});

$(document).on('click', '.row_edit_transf_hist', function(event){
  transf_id=$(this).data('id');

    $.ajax({
    url:"backend/create_session_appro.php",
    method:'POST',
    data:{transf_id:transf_id},
    success:function(data)
    {
      load_frm_new_transf_prod();
    }
   });
});
$(document).on('click', '.print_sort', function(){
var op_id=$(this).attr('id');
  load_tab_bon_sort(op_id);

 });

$(document).on('click', '.print_transf', function(){
var op_id=$(this).attr('id');
  load_tab_bon_transf_prod(op_id);

 });

$(document).on('click', '#hist_sort_mp', function(){
  //alert('cool');
  load_srch_hist_sort_tab();
 });

$(document).on('click', '#hist_transf_prod', function(){
  //alert('cool');
  load_srch_hist_transf_tab();
 });

$(document).on('submit', '#frm_search_hist_sort_mp', function(event){

  event.preventDefault();

  var from_d=$('#datepicker').val();
  var to_d=$('#datepicker2').val();
  var pos=$('#pos_rap').val();
  load_hist_sort_tab(from_d,to_d,pos);


});

$(document).on('submit', '#frm_search_hist_transf_prod', function(event){

  event.preventDefault();

  var from_d=$('#datepicker').val();
  var to_d=$('#datepicker2').val();
  var pos=$('#pos_rap').val();
  load_hist_transf_tab(from_d,to_d,pos);
});

  $(document).on('click', '#sortie_mat', function(){
  //jour=$('#current_jour').val();
  load_frm_new_sort_mp();
 });

$(document).on('click', '#transf_prod', function(){
  //jour=$('#current_jour').val();
  load_frm_new_transf_prod();
 });

$(document).on('keyup', '#rech_prod_sort', function(){
  rech=$(this).val();
  load_product_list_sort(rech);
 });

$(document).on('submit', '#frm_new_sort', function(event){

event.preventDefault();

  var date_sort=$('#datepicker').val();
  var motif=$('#motif').val();
  var type_sort=$('#motif').val();
  var op_an_id=$('#op_an_id').val();
  var pos=$('#from_pos').val();

  $.ajax({
   url:"backend/new_sort.php",
   method:"POST",
   data:{date_sort:date_sort,motif:motif,op_an_id:op_an_id,type_sort:type_sort,pos:pos},
   success:function(data)
   {
    load_frm_new_sort_mp();
   }
  })
});

$(document).on('submit', '#frm_new_transf_prod', function(event){

  event.preventDefault();
  /*if(confirm("Etes-vous sur de vouloir effectuer cet opération ?"))
  {*/

  var date_sort=$('#datepicker').val();
  var dest_pos=$('#dest_pos').val();
  var from_pos=$('#from_pos').val();
  var op_an_id=$('#op_an_id').val();

  $.ajax({
   url:"backend/new_transf_prod.php",
   method:"POST",
   data:{date_sort:date_sort,dest_pos:dest_pos,op_an_id:op_an_id,from_pos:from_pos},
   success:function(data)
   {

    load_frm_new_transf_prod();
    $("#op_an_id").val("");
    //$("#date_sort").val("");
    //alert(data);
   }
  })

  /*}
  else
  {
    return false;
  }*/
});

$(document).on('submit', '#sort_mat_form', function(event){
  var rech=$('#rech_prod_sort').val();

  event.preventDefault();
  if($('#op_id').val()=="")
  {
    alert('Choisir d\'abord l\'operation');
  }
  else
  {

    $.ajax({
    url:"backend/insert_sort.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {

     alert(data);
     //load_product_list_sort(rech);
     load_details_sort();
     $('#lab_action').html("Enregistrer");
     $('#action').val("Add");
     $('#operation').val("Add");
     $('#save_sortie').css("visibility","visible");
     $('#cancel_action_sort').css("visibility","hidden");
    }

   });
  $('#sort_mat_form')[0].reset();
  }

});

$(document).on('submit', '#transf_produit_form', function(event){
  var rech=$('#rech_prod_sort').val();

  event.preventDefault();
  if($('#op_id').val()=="")
  {
    alert('Choisir d\'abord l\'operation');
  }
  else
  {

    $.ajax({
    url:"backend/insert_transf_prod.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {

     //alert(data);
     load_product_list_sort(rech);
     load_details_transf();
     $('#lab_action').html("Enregistrer");
     $('#action').val("Add");
     $('#operation').val("Add");
     $('#save_transf_prod').css("visibility","visible");
     $('#cancel_action_transf').css("visibility","hidden");
    }

   });
  $('#transf_produit_form')[0].reset();
  }

});

$(document).on('click', '.update_det_sort', function(){
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

    $('#sort_id').val(det_id);

    $('#action').val("Edit");
    $('#operation').val("Edit");
    $('#lab_action').html("Modifier");

    //alert(data);

   },
    error: function() {
    alert('La requête n\'a pas aboutie'); }
  })
 });


$(document).on('click', '.delete_det_transf_prod', function(){
  var det_id = $(this).attr("id");
  var rech=$('#rech_prod_sort').val();
  //alert(det_id);
  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/delete_transf_prod.php",
    method:"POST",
    data:{det_id:det_id},
    success:function(data)
    {
     alert(data);
     load_details_transf();
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

$(document).on('click', '.delete_det_sort', function(){
  var det_id = $(this).attr("id");
  var rech=$('#rech_prod_sort').val();
  //alert(det_id);
  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/delete_sort.php",
    method:"POST",
    data:{det_id:det_id},
    success:function(data)
    {
     alert(data);
     load_details_sort();

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

$(document).on('click', '.row_prod_sort', function(){

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

$(document).on('click', '#save_sortie', function(){

op_id=$('#op_id').val();
  if(confirm("Etes-vous sur de vouloir sauvegarder cette opération ?"))
  {
  $.ajax({
   url:"backend/remove_quantity_stock.php",
   method:"GET",
   beforeSend:function()
   {
    $('#save_text').html('<p class="text-success">Enregistrement ....</p>');
   },
   success:function(data)
   {
    //load_frm_new_sort_mp();
    load_tab_bon_sort(op_id);
      }
  })

  }
  else
  {
    return false;
  }
});

$(document).on('click', '#save_transf_prod', function(){

op_id=$('#op_id').val();
  if(confirm("Etes-vous sur de vouloir sauvegarder cette opération ?"))
  {
  $.ajax({
   url:"backend/out_transf_quantity_stock.php",
   method:"GET",
   beforeSend:function()
   {
    $('#save_text').html('<p class="text-success">Enregistrement ....</p>');
   },
   success:function(data)
   {
    //load_frm_new_transf_prod();
    load_tab_bon_transf_prod(op_id);
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

function load_frm_new_sort_mp()
{
  $.ajax({
   url:"forms/frm_new_sortie_mp.php",
   success:function(data)
   {
    $('#page-content').html(data);
   }
  })
}

function load_frm_new_transf_prod()
{
  $.ajax({
   url:"forms/frm_new_appro_pv.php",
   success:function(data)
   {
    $('#page-content').html(data);

    $('#dt').DataTable();
   }
  })
}

function load_product_list_sort(rech)
{
  $.ajax({
    //type:'GET',
    url:'tables/tab_product_sort_mat.php',
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

function load_details_sort()
{
  $.ajax({
    type:'GET',
    url:'tables/tab_details_sort.php',
    beforeSend : function ()
      {
         $("#tab_details_sort").html('Chargement ...');
      },
    success:function(data)
    {
      $('#tab_details_sort').html(data);
    },
    error: function() {
    alert('La requête n\'a pas abouti'); }
  });
}

function load_details_transf()
{
  $.ajax({
    type:'GET',
    url:'tables/tab_details_transf.php',
    beforeSend : function ()
      {
         $("#tab_details_transf").html('Chargement ...');
      },
    success:function(data)
    {
      $('#tab_details_transf').html(data);
    },
    error: function() {
    alert('La requête n\'a pas abouti'); }
  });
}

function load_tab_bon_sort(op_id)
{
  $.ajax({
   url:"tables/tab_bon_sort.php",
   method:"POST",
   data:{op_id:op_id},
   success:function(data)
   {
    $('#page-content').html(data);
   }
  })
}

function load_tab_bon_transf_prod(op_id)
{
  $.ajax({
   url:"tables/tab_bon_transf_prod.php",
   method:"POST",
   data:{op_id:op_id},
   success:function(data)
   {
    $('#page-content').html(data);
   }
  })
}

function load_hist_sort_tab(from_d,to_d,pos)
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

  var haut='POS : ' + stock + ' \n HISTORIQUE DES SORTIES DU ' + from_d + ' AU ' + to_d;
  var bas='Etabli par ' + $('#sess_name').html() + '\n A la date du ' + today ;
  var titre=$('#soft_title').html();

  $.ajax({
   url:"tables/tab_hist_sortie_mp.php",
   method:'GET',
   data:{from_d:from_d,to_d:to_d,pos:pos},
   beforeSend : function ()
      {
         $("#tab_hist_sort_mp").html('Chargement...');
      },
   success:function(data)
   {

    $('#tab_hist_sort_mp').html(data);
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

function load_srch_hist_sort_tab()
{
  $.ajax({
    type:'GET',
    url:'forms/frm_srch_hist_sort_mp.php',
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

function load_hist_transf_tab(from_d,to_d,pos)
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

  var haut='Point de Vente : ' + stock + ' \n HISTORIQUE DES APPROVISIONNEMENTS POINT DE VENTE DU ' + from_d + ' AU ' + to_d;
  var bas='Etabli par ' + $('#sess_name').html() + '\n à la date du ' + today ;
  var titre=$('#MOTEL').html();

  $.ajax({
   url:"tables/tab_hist_transf_prod.php",
   method:'GET',
   data:{from_d:from_d,to_d:to_d,pos:pos},
   beforeSend : function ()
      {
         $("#tab_hist_transf_prod").html('Chargement...');
      },
   success:function(data)
   {

    $('#tab_hist_transf_prod').html(data);
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

function load_srch_hist_transf_tab()
{
  $.ajax({
    type:'GET',
    url:'forms/frm_srch_hist_transf_prod.php',
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
