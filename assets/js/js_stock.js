$(function() {



$(document).on('click', '.fiche_det', function(){
  prod_id=$(this).data('id');
  load_tab_det_fiche_art(prod_id);
  up();
 });

$(document).on('click', '.fiche_det_cui', function(){
  prod_id=$(this).data('id');
  load_tab_det_fiche_art_cui(prod_id);
  up();
 });


$(document).on('click', '.show_cont_detap', function(){
  part=$(this).data('id');
  $("#det"+part).toggle();

  if($(this).html()=='<i class="fa fa-minus"></i>')
  {
  $(this).html('<i class="fa fa-plus"></i>');
  }
  else
  {
   $(this).html('<i class="fa fa-minus"></i>');
  }
 });

$(document).on('click', '.new_aut_f', function(){
  $('#myModalAutF').css("display","block");
 });

$(document).on('click', '.close', function(){
  $('#myModalAutF').css("display","none");
 });

$(document).on('submit', '#frm_autre_frais', function(event){

date_from=$('#date_from').val();
date_to=$('#date_to').val();
  event.preventDefault();
    $.ajax({
    url:"backend/insert_autre_frais.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
      //alert(data);
      load_frm_new_appro(date_from,date_to);
    }
   });
});

$(document).on('submit', '#frm_srch_rap_fiche_stk', function(event){
  event.preventDefault();

  from_d=$('#date_from').val();
  to_d=$('#date_to').val();
  pos_id=$('#pos_id').val();
  id_per=$('#id_per').val();
  prod_id=$('#prod_id').val();
  
  load_rap_fiche_stk(from_d,to_d,prod_id,pos_id,id_per);
});

$(document).on('click', '#rap_fiche_stk', function(){
  load_srch_rap_fiche_stk();
 });

$(document).on('click', '#rap_situ_stk_lot', function(){
  load_srch_rap_situ_lot();
 });

$(document).on('click', '#rap_situ_stk_gen', function(){
  load_srch_rap_situ_gen();
 });

$(document).on('click', '#syn_per', function(){
  load_srch_rap_syn_tab();
 });

$(document).on('click', '#mv_per', function(){
  load_srch_rap_mv_tab();
 });

$(document).on('submit', '#frm_search_rap_syn', function(event){

  event.preventDefault();
  from_d=$('#date_from').val();
  to_d=$('#date_to').val();
  pos_id=$('#pos_id').val();
  id_per=$('#id_per').val();
  load_rap_syn_per(from_d,to_d,pos_id,id_per);
});

$(document).on('submit', '#frm_srch_rap_mv', function(event){

  event.preventDefault();
  from_d=$('#date_from').val();
  to_d=$('#date_to').val();
  pos_id=$('#pos_id').val();
  id_per=$('#id_per').val();
  load_rap_mv_per(from_d,to_d,pos_id,id_per);
});

$(document).on('submit', '#frm_srch_rap_situ_lot', function(event){

  event.preventDefault();
  
  pos_id=$('#pos_id').val();
  cat_id=$('#cat_id').val();
  load_rap_situ_lot(pos_id,cat_id);
});

$(document).on('submit', '#frm_srch_rap_situ_gen', function(event){
  event.preventDefault();
  pos_id=$('#pos_id').val();
  cat_id=$('#cat_id').val();
  load_rap_situ_gen(pos_id,cat_id);
});

$(document).on('change', '#id_bq_sup', function(){
  id_bq=$(this).val();

  $.ajax({
   url:"backend/fetch_balance.php",
   method:"POST",
   data:{id_bq},
   dataType:"json",
   success:function(data)
   {
    $('#balance').val(data.balance);
   }
  })
})

$(document).on('click', '#suppliers', function(){
  id='';
  load_frm_fournisseur(id);
 });

$(document).on('click', '.sup_det_pay', function(){
  sup_id=$(this).data('id');
  op_id='';
  load_frm_sup_paie(sup_id,op_id);
  up();
 });

$(document).on('click', '.row_sup_pay', function(){
  sup_id=$(this).data('id');
  op_id=$(this).attr('id');
  load_frm_sup_paie(sup_id,op_id);
  up();
 });

$(document).on('click', '.edit_sup', function(){
  id=$(this).data('id');
  load_frm_fournisseur(id);
 });

$(document).on('submit', '#appro-search', function(){
  event.preventDefault();
    date_from=$('#date_from').val();
    date_to=$('#date_to').val();
    load_frm_new_appro(date_from,date_to);
 });

$(document).on('submit', '#sort-search', function(){
  event.preventDefault();
    date_from=$('#date_from').val();
    date_to=$('#date_to').val();
    load_frm_new_sort(date_from,date_to);
 });

$(document).on('submit', '#chg-search', function(){
  event.preventDefault();
    date_from=$('#date_from').val();
    date_to=$('#date_to').val();
    load_frm_new_chg(date_from,date_to);
 });

$(document).on('click', '.row_edit_appro_hist', function(event){
  appro_id=$(this).data('id');
  date_from=$('#date_from').val();
  date_to=$('#date_to').val();
    $.ajax({
    url:"backend/create_session.php",
    method:'POST',
    data:{appro_id:appro_id},
    success:function(data)
    {
      load_frm_new_appro(date_from,date_to);
    }
   });
});

$(document).on('click', '.edit_appro', function(event){
  appro_id=$(this).data('id');
  date_from='';
  date_to='';
    $.ajax({
    url:"backend/create_session.php",
    method:'POST',
    data:{appro_id:appro_id},
    success:function(data)
    {
      load_frm_new_appro(date_from,date_to);
    }
   });
});

$(document).on('click', '.row_edit_sort_hist', function(event){
  sort_id=$(this).data('id');
  date_from=$('#date_from').val();
  date_to=$('#date_to').val();

    $.ajax({
    url:"backend/create_session.php",
    method:'POST',
    data:{sort_id:sort_id},
    success:function(data)
    {
      load_frm_new_sort(date_from,date_to);
    }
   });
});

$(document).on('click', '.row_edit_chg_hist', function(event){
  chg_id=$(this).data('id');
  date_from=$('#date_from').val();
  date_to=$('#date_to').val();

    $.ajax({
    url:"backend/create_session.php",
    method:'POST',
    data:{chg_id:chg_id},
    success:function(data)
    {
      load_frm_new_chg(date_from,date_to);
    }
   });
});

$(document).on('click', '.new_appro', function(){
date_from='';
date_to='';
    new_operation();
    load_frm_new_appro(date_from,date_to);
 });

$(document).on('click', '.new_sort', function(){
  date_from='';
  date_to='';
  new_operation();
  load_frm_new_sort(date_from,date_to); 
 });

$(document).on('click', '.new_chg', function(){
  date_from='';
  date_to='';
  new_operation();
  load_frm_new_chg(date_from,date_to);
 });

$(document).on('click', '#supply', function(){
  date_from='';
  date_to='';
  load_frm_new_appro(date_from,date_to);
 });

$(document).on('click', '#out_stock', function(){
  date_from='';
  date_to='';
  load_frm_new_sort(date_from,date_to);
 });

$(document).on('click', '#change', function(){
  date_from='';
  date_to='';
  load_frm_new_chg(date_from,date_to);
 });

$(document).on('keyup', '#content_lib_prod', function(){
  autocomplete_prod();
 });



$(document).on('keyup', '#content_lib_sup', function(){
  autocomplete_sup();
 });

$(document).on('click', '.choose_sup', function(){
  $('#sup_id').val($(this).attr('id'));
  $('#content_lib_sup').val($(this).data('id'));
  $('#content_list_sup').hide();

})

$(document).on('click', '.choose_prod', function(){

  $('#prod_id').val($(this).attr('id'));
  $('#prod_equiv').val($(this).attr('id'));

  $('#content_lib_prod').val($(this).data('id'));
  $('#content_list_prod').hide();
  prod_id=$(this).attr('id');
  $.ajax({
   url:"backend/fetch_last_appro.php",
   method:"POST",
   data:{prod_id:prod_id},
   dataType:"json",
   success:function(data)
   {
    //$('#m_exp').val(data.m_exp);
    //$('#y_exp').val(data.y_exp);
    $('#price').val(data.price);
    $('#qt').focus();
    //alert(data);
   }
  })

})


$(document).on('click', '.fetch_inv_op', function(){
  det_id=$(this).attr('id');
  $.ajax({
   url:"backend/fetch_det.php",
   method:"GET",
   data:{det_id:det_id},
   dataType:"json",
   success:function(data)
   {
    $('#m_exp').val(data.m_exp);
    $('#y_exp').val(data.y_exp);
    //$('#date_exp').val(data.date_exp);
    $('#price').val(data.price);
    $('#qt').val(data.qt);
    $('#prod_id').val(data.prod_id);
    $('#content_lib_prod').val(data.prod_name);
    $('#content_lib_prod_v').val(data.prod_name);
    $('#lot').val(data.lot);
    $('#operation_inv').val('Edit');
    $('#operation').val('Edit');
    $('#det_id').val(det_id);

    $('#m_exp').attr("disabled", true);
    $('#y_exp').attr("disabled", true);
    $('#date_exp').attr("disabled", true);

    $('#qt').focus();
    //alert(data.date_exp);
   }
  })

})

$(document).on('click', '.del_det_inv', function(){
  var det_id = $(this).attr("id");
  id_per=$('#id_per').val();
  pos_id=$('#pos_id').val();
  
  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/delete_inv.php",
    method:"POST",
    data:{det_id:det_id},
    success:function(data)
    {
     load_tab_inventaire(id_per,pos_id);
    }
  })
  }
  else
  {
   return false;
  }
 });

$(document).on('click', '.del_det_aut', function(){
  var aut_id = $(this).data("id");
  date_from=$('#date_from').val();
  date_to=$('#date_to').val();
  direct=$('#direct2').val();
  
  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/delete_aut.php",
    method:"POST",
    data:{aut_id:aut_id},
    success:function(data)
    {
      //alert(data);
     if(direct=='appro')
      load_frm_new_appro(date_from,date_to);
     else
     load_frm_new_sale(date_from,date_to);   
    }
  })
  }
  else
  {
   return false;
  }
 });

$(document).on('click', '.del_det_appro', function(){
  var det_id = $(this).attr("id");
  date_from=$('#date_from').val();
  date_to=$('#date_to').val();
  
  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/delete_appro.php",
    method:"POST",
    data:{det_id:det_id},
    success:function(data)
    {
     load_frm_new_appro(date_from,date_to);
    }
  })
  }
  else
  {
   return false;
  }
 });

$(document).on('click', '.del_det_sort', function(){
  var det_id = $(this).attr("id");
  date_from=$('#date_from').val();
  date_to=$('#date_to').val();
  
  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/delete_sort.php",
    method:"POST",
    data:{det_id:det_id},
    success:function(data)
    {
     load_frm_new_sort(date_from,date_to);
    }
  })
  }
  else
  {
   return false;
  }
 });

$(document).on('click', '.del_det_chg', function(){
  var det_id = $(this).attr("id");
   date_from=$('#date_from').val();
  date_to=$('#date_to').val();
  
  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/delete_chg.php",
    method:"POST",
    data:{det_id:det_id},
    success:function(data)
    {
      //alert(data);
     load_frm_new_chg(date_from,date_to);
    }
  })
  }
  else
  {
   return false;
  }
 });

$(document).on('click', '.del_op_chg', function(){
  var op_id = $(this).attr("id");
   date_from=$('#date_from').val();
  date_to=$('#date_to').val();
  
  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/delete.php",
    method:"POST",
    data:{op_id:op_id},
    success:function(data)
    {
      alert(data);
      new_operation();
      load_frm_new_chg(date_from,date_to);
    }
  })
  }
  else
  {
   return false;
  }
 });

$(document).on('click', '.del_op_sort', function(){
  var op_id = $(this).attr("id");
   date_from=$('#date_from').val();
  date_to=$('#date_to').val();
  
  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/delete.php",
    method:"POST",
    data:{op_id:op_id},
    success:function(data)
    {
      alert(data);
      new_operation();
      load_frm_new_sort(date_from,date_to);
    }
  })
  }
  else
  {
   return false;
  }
 });

$(document).on('click', '.del_op_appro', function(){
  var op_id = $(this).attr("id");
  date_from=$('#date_from').val();
  date_to=$('#date_to').val();
  
  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/delete.php",
    method:"POST",
    data:{op_id:op_id},
    success:function(data)
    {
      alert(data);
      new_operation();
      load_frm_new_appro(date_from,date_to);
    }
  })
  }
  else
  {
   return false;
  }
 });

$(document).on('click','#periode',function(){
load_form_periode('');
});

$(document).on('click','.nv_periode',function(){
id=$(this).data('id');	
load_form_periode(id);
});

$(document).on('click', '.trash_stk', function(event){

  table=$('#tab_details').val();
  id=$('#tab_details').data('id');
  val_id=$(this).attr('id');
  prod_id=$('#prod_id').val();
  
if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
    $.ajax({
    url:"backend/delete_op.php",
    method:'POST',
    data:{table:table,val_id:val_id,id:id},
    success:function(data)
    {
      alert(data + table);
      if(table=="periode"){ load_form_periode('')}
      if(table=="personne"){ load_frm_fournisseur('')}
    }
   });
  }
  else
  {
    return false;
  }
});

$(document).on('submit', '#frm_periode', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_periode.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {

     alert(data);
     $('#operation').val("Add");
     load_form_periode('');
    }
   });

   $('#frm_periode')[0].reset();
});

$(document).on('submit', '#frm_new_appro', function(event){
date_from=$('#date_from').val();
date_to=$('#date_to').val();
  event.preventDefault();
    $.ajax({
    url:"backend/insert_appro.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {

     //alert(data);
     load_frm_new_appro(date_from,date_to);
     $('#operation').val("Add");
    }
   });

   $('#frm_new_appro')[0].reset();
});

$(document).on('submit', '#frm_new_sort', function(event){

  event.preventDefault();

  date_from=$('#date_from').val();
  date_to=$('#date_to').val();
    $.ajax({
    url:"backend/insert_sortie.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {

     //alert(data);
     $('#operation').val("Add");
     load_frm_new_sort(date_from,date_to);
    }
   });

   $('#frm_new_sort')[0].reset();
});

$(document).on('submit', '#frm_new_chg', function(event){

  event.preventDefault();

  date_from=$('#date_from').val();
  date_to=$('#date_to').val();
    $.ajax({
    url:"backend/insert_change.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {

     //alert(data);
     $('#operation').val("Add");
     load_frm_new_chg(date_from,date_to);
    }
   });

   $('#frm_new_sort')[0].reset();
});

$(document).on('submit', '#frm_fournisseur', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_fournisseur.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
      alert(data);
     $('#operation').val("Add");
     load_frm_fournisseur('');

    }
   });
   $('#frm_fournisseur')[0].reset();
});

$(document).on('submit', '#frm_inventaire', function(event){
id_per=$('#id_per').val();
pos_id=$('#pos_id').val();

  event.preventDefault();
    $.ajax({
    url:"backend/insert_inventaire.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
      //alert(data);
     load_tab_inventaire(id_per,pos_id);
     $('#operation_inv').val('Add');
    }
   });

   //$('#frm_inventaire')[0].reset();
});

$(document).on('submit', '#frm_det_inv', function(event){
id_per=$('#id_per').val();
pos_id=$('#pos_id').val();


  event.preventDefault();
    $.ajax({
    url:"backend/insert_det_inv.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
      alert(data);
     load_tab_inventaire(id_per,pos_id);
    }
   });

   $('#frm_det_inv')[0].reset();
});

//fin
})

function load_tab_periode(etat)
{
  $.ajax({

    url:"tables/tab_periode.php",
    method:"GET",
    data:{etat:etat},
    beforeSend: function()
    {
      $('#page-content').html('<p>page en chargement .......</p>');
    },
    success:function(data)
    {
      $('#page-content').html(data);
      $('#tab').DataTable();
    }

  })
}

function load_form_periode(id)
{
  $.ajax({

    url:"forms/frm_periode.php",
    method:"GET",
    data:{id:id},
    beforeSend: function()
    {
      $('#page-content').html('<p>page en chargement .......</p>');
    },
    success:function(data)
    {
      $('#page-content').html(data);
      $('#tab').DataTable();
    }

  })
}

function load_sup_tab(status)
{
  $.ajax({
   url:"tables/tab_fournisseur.php",
    method:"POST",
    data:{status:status},
    beforeSend : function ()
      {
         $("#page-content").html('<img src="assets/img/waiting2.gif"/>');
      },
   success:function(data)
   {
    $('#page-content').html(data);
    $('#example23').DataTable({
                      "bInfo": false,
                      "bLengthChange": false,
                      dom: 'Bfrtip',
                      buttons: ['excel', 'pdf', 'print']
                     });
   }
  })
}

function load_frm_fournisseur(id)
{
 $.ajax({
   url:"forms/frm_fournisseur.php",
   method:'GET',
   data:{id,id},
   beforeSend : function ()
      {
         $("#page-content").html('chargement ...');
      },
   success:function(data)
   {
    $('#page-content').html(data);
    $('#operation').data("Add");
    $('#tab').dataTable();
   }
  })
}

function load_tab_inventaire(id_per,pos_id)
{
  $.ajax({

    url:"tables/tab_inventaire.php",
    method:"POST",
    data:{id_per:id_per,pos_id:pos_id},
    beforeSend: function()
    {
      $('.details_inv').html('<p>page en chargement .......</p>');
    },
    success:function(data)
    {
      //alert(data);
      $('.details_inv').html(data);
      $('#tab2').DataTable();
    }

  })
}

function autocomplete_prod() {
keyword = $('#content_lib_prod').val();
  $.ajax({
    url: 'tables/list_prod.php',
    type: 'POST',
    data: {keyword:keyword},
    success:function(data){
      $('#content_list_prod').show();
      $('#content_list_prod').html(data);
    }
  });
}

function autocomplete_acc(keyT,det_id) {
all =keyT;
txt=all.split("+");
keyword = txt[txt.length-1];
keyword=keyword.trim();
  $.ajax({
    url: 'tables/list_acc.php',
    type: 'POST',
    data: {keyword:keyword,det_id:det_id},
    success:function(data){
      //alert(data);
      $('.content_list_acc'+det_id).show();
      $('.content_list_acc'+det_id).html(data);
    }
  });
}

function autocomplete_sup() {
keyword = $('#content_lib_sup').val();
  $.ajax({
    url: 'tables/list_sup.php',
    type: 'POST',
    data: {keyword:keyword},
    success:function(data){
      $('#content_list_sup').show();
      $('#content_list_sup').html(data);
    }
  });
}

function load_frm_new_appro(date_from,date_to)
{
  $.ajax({
   url:"forms/frm_new_appro.php",
   method:'GET',
   data:{date_from:date_from,date_to:date_to},
   success:function(data)
   {
    $('#page-content').html(data);
     $(".hide_cont_det").toggle();
    $('.tab').dataTable({
                      "bInfo": false,
                      "bLengthChange": false,
                      dom: 'Bfrtip',
                      buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                     });
   }
  })
}

function load_frm_new_sort(date_from,date_to)
{
  $.ajax({
   url:"forms/frm_new_sortie.php",
   method:'GET',
   data:{date_from:date_from,date_to:date_to},
   success:function(data)
   {
    $('#page-content').html(data);
     $(".hide_cont_det").toggle();
    $('.tab').dataTable({
      'Ordering':false,
      });
   }
  })
}

function load_frm_new_chg(date_from,date_to)
{
  $.ajax({
   url:"forms/frm_new_change.php",
   method:'GET',
   data:{date_from:date_from,date_to:date_to},
   success:function(data)
   {
    $('#page-content').html(data);
     $(".hide_cont_det").toggle();
    $('.tab').dataTable({
      'Ordering':false,
      });
   }
  })
}

function new_operation()
{
  $.ajax({
   url:"backend/end_session.php",
   success:function(data)
   {
   }
  })
}

function load_frm_sup_paie(sup_id,op_id)
{
 $.ajax({
   url:"forms/frm_sup_paie.php",
   method:'POST',
   data:{sup_id:sup_id,op_id:op_id},
  beforeSend: function()
    {
      $('.sup_paie').html('<p>page en chargement .......</p>');
    },
   success:function(data)
   {
    $('.sup_paie').html(data);
    $('.tab').dataTable({"order": [[ 0, "desc" ]]});
   }
  }) 
}

function load_rap_syn_per(from_d,to_d,pos_id,id_per)
{
  $.ajax({
   url:"tables/tab_rap_syn_stk.php",
   method:'GET',
   data:{from_d:from_d,to_d:to_d,pos_id:pos_id,id_per:id_per},
   beforeSend : function ()
      {
         $("#tab_rap_syn").html('Chargement...');
      },
   success:function(data)
   {
        $('#tab_rap_syn').html(data);
        $('#tab').DataTable({
                      //"bInfo": false,
                      "paging":false,
                      "bLengthChange": false,
                      "ordering":false,
                      //bFilter:false
                     });


    }
    })
}

function load_rap_mv_per(from_d,to_d,pos_id,id_per)
{
  $.ajax({
   url:"tables/tab_rap_mv_stk.php",
   method:'GET',
   data:{from_d:from_d,to_d:to_d,pos_id:pos_id,id_per:id_per},
   beforeSend : function ()
      {
         $("#tab_rap_syn").html('Chargement...');
      },
   success:function(data)
   {
        $('#tab_rap_syn').html(data);
        $('#tab').DataTable({
                      //"bInfo": false,
                      "paging":false,
                      "bLengthChange": false,
                      "ordering":false,
                      //bFilter:false
                     });


    }
    })
}

function load_rap_fiche_stk(from_d,to_d,prod_id,pos_id,id_per)
{
  $.ajax({
   url:"tables/tab_rap_fiche_stk.php",
   method:'GET',
   data:{from_d:from_d,to_d:to_d,prod_id:prod_id,pos_id:pos_id,id_per:id_per},
   beforeSend : function ()
      {
         $("#tab_rap_fiche_stk").html('Chargement...');
      },
   success:function(data)
   {
        $('#tab_rap_fiche_stk').html(data);
        $('#tab').DataTable();


    }
    })
}

function load_srch_rap_syn_tab()
{
  $.ajax({
    type:'GET',
    url:'forms/frm_srch_rap_syn.php',
    beforeSend : function ()
      {
         $("#page-content").html('loading...');
      },
    success:function(data)
    {
      $('#page-content').html(data);
    }
  });
}

function load_srch_rap_mv_tab()
{
  $.ajax({
    type:'GET',
    url:'forms/frm_srch_rap_mv.php',
    beforeSend : function ()
      {
         $("#page-content").html('loading...');
      },
    success:function(data)
    {
      $('#page-content').html(data);
    }
  });
}

function load_srch_rap_situ_gen()
{
  $.ajax({
    type:'GET',
    url:'forms/frm_srch_rap_situ_gen.php',
    beforeSend : function ()
      {
         $("#page-content").html('loading...');
      },
    success:function(data)
    {
      $('#page-content').html(data);

    }
  });
}

function load_srch_rap_situ_lot()
{
  $.ajax({
    type:'GET',
    url:'forms/frm_srch_rap_situ_lot.php',
    beforeSend : function ()
      {
         $("#page-content").html('loading...');
      },
    success:function(data)
    {
      $('#page-content').html(data);
    }
  });
}

function load_srch_rap_fiche_stk()
{
  $.ajax({
    type:'GET',
    url:'forms/frm_srch_rap_fiche_stk.php',
    beforeSend : function ()
      {
         $("#page-content").html('loading...');
      },
    success:function(data)
    {
      $('#page-content').html(data);
    }
  });
}

function load_rap_situ_lot(pos_id,cat_id)
{
  $.ajax({
   url:"tables/tab_situ_stock_lot.php",
   method:"GET",
   data:{pos_id:pos_id,cat_id:cat_id},
   beforeSend : function ()
      {
         $("#tab_situ_lot").html('Chargement...');
      },
   success:function(data)
   {
        $('#tab_situ_lot').html(data);

        $('#tab').DataTable({
                      "bInfo": false,
                      "bLengthChange": false,
                      "pageLength": 10,
                      dom: 'Bfrtip',
                      buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                     });
    }
    })
}

function load_rap_situ_gen(pos_id,cat_id)
{
  $.ajax({
   url:"tables/tab_situ_stock_gen.php",
   method:"GET",
   data:{pos_id:pos_id,cat_id:cat_id},
   beforeSend : function ()
      {
         $("#tab_situ").html('Chargement du stock en cours ...');
      },
   success:function(data)
   {
        $('#tab_situ').html(data);

        $('#tab').DataTable({
                      "bInfo": false,
                      "paging":false,
                      "bLengthChange": false
                     });
    }
    })
}

function up()
{
  $('html, body').animate({scrollTop: '0px'},2000); 
  return false;
}

function load_tab_det_fiche_art(prod_id)
{
 $.ajax({
   url:"tables/tab_det_fiche_stk.php",
   method:'GET',
   data:{prod_id:prod_id},
  beforeSend: function()
    {
      $('.fiche_art').html('<p>page en chargement .......</p>');
    },
   success:function(data)
   {
    $('.fiche_art').html(data);
    $('#tab2').DataTable({
                      "bInfo": false,
                      "paging":false,
                      "bLengthChange": false
                     });
   }
  }) 
}

function load_tab_det_fiche_art_cui(prod_id)
{
 $.ajax({
   url:"tables/tab_det_fiche_stk_cui.php",
   method:'GET',
   data:{prod_id:prod_id},
  beforeSend: function()
    {
      $('.fiche_art_cui').html('<p>page en chargement .......</p>');
    },
   success:function(data)
   {
    $('.fiche_art_cui').html(data);
    $('#tab').DataTable({
                      "bInfo": false,
                      "paging":false,
                      "bLengthChange": false
                     });
    //$('.tab').dataTable();
   }
  }) 
}
