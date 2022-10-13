$(function() {

//alert('je suis');

$(document).on('click', '#sortie_mat', function(){
  //alert('cool');
  $.ajax({
   url:"forms/frm_new_sort.php",
   success:function(data)
   {
    $('#page-content').html(data);
    jQuery('#datepicker').datepicker({
               autoclose: true
                , todayHighlight: true
                , format: 'yyyy-mm-dd'
              });
   }
  })
 });

$(document).on('keyup', '#rech_prod_sort', function(){
  rech=$(this).val();
  load_product_list_sort(rech);
 });

$(document).on('keyup', '#rech_prod_transf', function(){
  rech=$(this).val();
  load_product_list_transf(rech);
 });

$(document).on('click', '#sortie_vente', function(){
  //alert('cool');
  $.ajax({
   url:"forms/frm_new_vente.php",
   success:function(data)
   {
    $('#page-content').html(data);
    jQuery('#datepicker').datepicker({
               autoclose: true
                , todayHighlight: true
                , format: 'yyyy-mm-dd'
              });
   }
  })
 });

$(document).on('click', '#transf_prod', function(){
  //alert('cool');
  $.ajax({
   url:"forms/frm_vers_pos_to_pos.php",
   success:function(data)
   {
    $('#page-content').html(data);
    jQuery('#datepicker').datepicker({
               autoclose: true
                , todayHighlight: true
                , format: 'yyyy-mm-dd'
              });
   }
  })
 });

$(document).on('click', '#hist_prod', function(){
  //alert('cool');
  load_srch_hist_prod_tab();
 });

//insert user

//search account
$(document).on('submit', '#frm_new_sort', function(event){

  event.preventDefault();
var stk='0';
if ($("#gros").is(':checked')) {
  stk=$("#gros").val();
}
else {
stk=$("#det").val();
}

  /*if(confirm("Etes-vous sur de vouloir effectuer cet opération ?"))
  {*/
  var date_sort=$('#datepicker').val();
  var motif=$('#motif').val();
  var type_sort=$('#type_sort').val();
  var op_an_id=$('#op_an_id').val();
  var pos=$('#from_pos').val();

  $.ajax({
   url:"backend/new_sort.php",
   method:"POST",
   data:{date_sort:date_sort,motif:motif,op_an_id:op_an_id,type_sort:type_sort,stk:stk,pos:pos},
   success:function(data)
   {
    //load_product_list_sort();
    load_rech_prod_sort_form();
    load_sort_form();
    load_sort_tab();
    $("#op_an_id").val("");
    $("#date_sort").val("");
    //alert(data);
   }
  })

  /*}
  else
  {
    return false;
  }*/
});

$(document).on('submit', '#frm_new_sort_vente', function(event){

  event.preventDefault();
  /*if(confirm("Etes-vous sur de vouloir effectuer cet opération ?"))
  {*/
  var date_sort=$('#datepicker').val();
  var motif=$('#motif').val();
  var op_an_id=$('#op_an_id').val();

  $.ajax({
   url:"backend/new_sort_vente.php",
   method:"POST",
   data:{date_sort:date_sort,motif:motif,op_an_id:op_an_id},
   success:function(data)
   {
    //load_product_list_sort();
    load_rech_prod_sort_form();
    load_sort_form();
    load_sort_tab();
    $("#op_an_id").val("");
    $("#date_sort").val("");
    //alert(data);
   }
  })

  /*}
  else
  {
    return false;
  }*/
});


//search account
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
    //load_product_list_transf();
    load_rech_prod_transf_form();
    load_transf_prod_form();
    load_transf_prod_tab();
    $("#op_an_id").val("");
    $("#date_sort").val("");
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
     load_product_list_sort(rech);
     load_sort_tab();
     load_sort_form();
     $('#lab_action').html("Enregistrer");
     $('#action').val("Add");
     $('#operation').val("Add");

    }

   });
  //$('#sort_form')[0].reset();
  }

});

$(document).on('submit', '#transf_produit_form', function(event){
  var rech=$('#rech_prod_transf').val();

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

     alert(data);
     load_product_list_transf(rech);
     load_transf_prod_tab();
     load_transf_prod_form();
     $('#lab_action').html("Enregistrer");
     $('#action').val("Add");
     $('#operation').val("Add");

    }

   });
  //$('#sort_form')[0].reset();
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
    $('#prod_id').val(data.prod_id);
    $('#prod_prix').val(data.prod_prix);
    //$('#num_lot').val(data.num_lot);
    //$('#date_exp').val(data.date_exp);
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
     load_sort_tab();
     load_product_list_sort(rech);

    },
    error: function() {
    alert('La requête n\'a pas abouti'); }
  })

  }
  else
  {
   return false;
  }
  load_hist_prod_tab_after_del();
 });


$(document).on('click', '.delete_det_transf_prod', function(){
  var det_id = $(this).attr("id");
  var rech=$('#rech_prod_transf').val();
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
     load_transf_prod_tab();
     load_product_list_transf(rech);
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

$(document).on('click', '.delete_op_sort', function(){
  var op_id = $(this).attr("id");

  //alert(det_id);
  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/end_operation.php",
    method:"POST",
    data:{op_id:op_id},
    success:function(data)
    {
     alert(data);
     load_sort_tab();
     load_sort_form();
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

$(document).on('click', '.delete_op_transf_prod', function(){
  var op_id = $(this).attr("id");

  //alert(det_id);
  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/end_operation.php",
    method:"POST",
    data:{op_id:op_id},
    success:function(data)
    {
     alert(data);
     load_transf_prod_tab();
     load_transf_prod_form();
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


$(document).on('click', '.row_prod_sort', function(){

var prod_id=$(this).data("id");

//alert('select ok ok ' + prod_id);

$.ajax({
   url:"backend/fetch_prod_sort.php",
   method:"POST",
   data:{prod:prod_id},
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

$(document).on('click', '.row_op_sort', function(){

var op_id=$(this).data("id");

$.ajax({
   url:"backend/fetch_op_sort.php",
   method:"POST",
   data:{op_id:op_id},
   dataType:"json",
   success:function(data)
   {
    load_sort_form();
    load_sort_tab();

    $('#datepicker').val(data.date_sort);
    $('#motif').val(data.motif);
    $('#type_sort').val(data.type_sort);
    //$('#label_action').html("Modifier");
    $('#op_an_id').val(data.op_id);
   }
  })

});

$(document).on('click', '.row_op_transf_prod', function(){

var op_id=$(this).data("id");

$.ajax({
   url:"backend/fetch_op_sort.php",
   method:"POST",
   data:{op_id:op_id},
   dataType:"json",
   success:function(data)
   {
    load_transf_prod_form();
    load_transf_prod_tab();

    $('#datepicker').val(data.date_sort);
    $('#dest_pos').val(data.dest_pos);
    //$('#label_action').html("Modifier");
    $('#op_an_id').val(data.op_id);

    //alert(data);
   }
  })

});


//search period production
$(document).on('submit', '#frm_search_hist_prod', function(event){

  event.preventDefault();
  var from_d=$('#datepicker').val();
  var to_d=$('#datepicker2').val();
  var pos=$('#pos_rap').val();

  load_hit_prod_tab(from_d,to_d,pos);


});

$(document).on('click', '.row_op_sort_hist', function(){

var op_id=$(this).data("id");
load_sort_det_hist(op_id);
});

$(document).on('click', '.row_op_ent_hist', function(){

var op_id=$(this).data("id");
load_prodf_det_hist(op_id);
//lalert(op_id);
});

})

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

function load_rech_prod_sort_form()
{

  //alert(acc_id);
  $.ajax({
    type:'GET',
    url:'forms/frm_rech_prod_sort.php',
    beforeSend:function(){
      $('#list_prod_sort').html("en Chargement ....");
    },
    success:function(data)
    {
      $('#list_prod_sort').html(data);
    }
  });
}

function load_product_list_transf(rech)
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

function load_rech_prod_transf_form()
{

  //alert(acc_id);
  $.ajax({
    type:'GET',
    url:'forms/frm_rech_prod_transf.php',
    beforeSend:function(){
      $('#list_prod_transf').html("en Chargement ....");
    },
    success:function(data)
    {
      $('#list_prod_transf').html(data);
    }
  });
}

function load_sort_form()
{

  //alert(acc_id);
  $.ajax({
    type:'GET',
    url:'forms/frm_sort_det.php',
    beforeSend:function(){
      $('#sort_form').html("en Chargement ....");
    },
    success:function(data)
    {
      $('#sort_form').html(data);
    }
  });
}

function load_transf_prod_form()
{

  //alert(acc_id);
  $.ajax({
    type:'GET',
    url:'forms/frm_transf_prod_det.php',
    beforeSend:function(){
      $('#transf_prod_form').html("en Chargement ....");
    },
    success:function(data)
    {
      $('#transf_prod_form').html(data);
    }
  });
}

function load_sort_tab()
{

  var acc_id=$('#sup_id').data('id');
  //alert(acc_id);
  $.ajax({
    type:'GET',
    url:'tables/tab_sort.php',
    data:{acc_id:acc_id},
    beforeSend : function ()
      {
         $("#sort_tab").html('loading...');
      },
    success:function(data)
    {
      $('#sort_tab').html(data);
    },
    error: function() {
    alert('La requête n\'a pas abouti'); }
  });
}


function load_transf_prod_tab()
{

  /*var perso_id=$('#dest_pos').val();*/
  //alert(acc_id);
  $.ajax({
    type:'GET',
    url:'tables/tab_transf_prod.php',
   /* data:{dest_pos:dest_pos},*/
    beforeSend : function ()
      {
         $("#transf_prod_tab").html('loading...');
      },
    success:function(data)
    {
      $('#transf_prod_tab').html(data);
    },
    error: function() {
    alert('La requête n\'a pas abouti'); }
  });
}

function load_srch_hist_prod_tab()
{
  $.ajax({
    type:'GET',
    url:'forms/frm_srch_hist_prod.php',
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

function load_hit_prod_tab(from_d,to_d,pos)
{
  $.ajax({
   url:"tables/tab_hist_prod.php",
   method:"GET",
   data:{from_d:from_d, to_d:to_d,pos:pos},
   beforeSend : function ()
      {
         $("#tab_hist_prod").html('Chargement...');
      },
   success:function(data)
   {
        $('#tab_hist_prod').html(data);

        $('#example23').DataTable({
                      "bInfo": false,
                      "bLengthChange": false,
                      "pageLength": 10,
                      dom: 'Bfrtip',
                      buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                     });
    }
    })
}

function load_hist_prod_tab_after_del()
{
  var from_d=$('#datepicker').val();
  var to_d=$('#datepicker2').val();
  var pos=$('#pos_rap').val();
  load_hit_prod_tab(from_d,to_d,pos);
}

function load_sort_det_hist(op_id)
{
  $.ajax({
    type:'POST',
    url:'tables/tab_sort_det_hist.php',
    data:{op_id:op_id},
    beforeSend : function ()
      {
         $("#sort_hist_det_tab").html('loading...');
      },
    success:function(data)
    {
      $('#sort_hist_det_tab').html(data);
    },
    error: function() {
    alert('La requête n\'a pas abouti'); }
  });
}

function load_prodf_det_hist(op_id)
{
  $.ajax({
    type:'POST',
    url:'tables/tab_prodf_det_hist.php',
    data:{op_id:op_id},
    beforeSend : function ()
      {
         $("#sort_hist_det_tab").html('loading...');
      },
    success:function(data)
    {
      $('#sort_hist_det_tab').html(data);
    },
    error: function() {
    alert('La requête n\'a pas abouti'); }
  });
}
