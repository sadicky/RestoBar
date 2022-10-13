$(function() {

$(document).on('click', '.show_cont_det', function(){
  part=$(this).attr('id');
  name=$(this).data('id');
  $(".det"+part).toggle();

  if($(this).html()=='<i class="fa fa-minus"></i> ' + name)
  {
  $(this).html('<i class="fa fa-plus"></i> ' + name);
  }
  else
  {
   $(this).html('<i class="fa fa-minus"></i> ' + name);
  }

 });

$(document).on('click', '.show_cont_prod', function(){
  part=$(this).attr('id');
  name=$(this).data('id');
  $(".det"+part).toggle();

  if($(this).html()=='<i class="fa fa-minus"></i> ' + name)
  {
  $(this).html('<i class="fa fa-plus"></i> ' + name);
  }
  else
  {
   $(this).html('<i class="fa fa-minus"></i> ' + name);
  }

 });

$(document).on('click', '.row_menu_resto', function(){
var prod_id=$(this).data("id");
$.ajax({
   url:"backend/fetch_compo.php",
   method:"POST",
   data:{prod_id:prod_id},
   //dataType:"json",
   success:function(data)
   {
    load_tab_compo_ingred();
    load_tab_det_compo();
   }
  })

});

$(document).on('click', '.delete_det_compo', function(){
  var compo_id = $(this).attr("id");

  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/delete_det_compo.php",
    method:"POST",
    data:{compo_id:compo_id},
    success:function(data)
    {
     load_tab_det_compo();
    }
  })

  }
  else
  {
   return false;
  }
 });

$(document).on('click', '.row_add_ing', function(){
var ingr=$(this).attr("id");
var unt=$(this).data("id");
$.ajax({
   url:"backend/insert_compo.php",
   method:"POST",
   data:{ingr:ingr,unt:unt},
   //dataType:"json",
   success:function(data)
   {
    load_tab_compo_ingred();
    load_tab_det_compo();
   }
  })
//alert(unt);
});

$(document).on('click', '#compo', function(){
  load_frm_compo();
 });

$(document).on('blur', '#tab_det_compo tbody tr td', function(){

    var val=$(this).html();
    val=val.replace('<br>','');
    val=val.trim();
    compo_id=$(this).attr('id');
     $.ajax({
                     url:"backend/edit_compo_qt.php",
                     method:"POST",
                     data:{qt:val,compo_id:compo_id},
                     success:function(data)
                     {
                      load_tab_det_compo();
                     }
                });

  });

$(document).on('keyup', '#content_lib_cat', function(){
  autocomplete_cat();
 });

$(document).on('keyup', '#searchProd', function(){
  keyVal=$(this).val();
  $.ajax({
    method:'GET',
    data:{keyVal:keyVal},
    url:'forms/frm_get_srch_prod.php',
    beforeSend:function(){
      $('.res_srch').html("en Chargement ....");
    },
    success:function(data)
    {
      $('.res_srch').html(data);
    }
  });
 });

$(document).on('click', '.choose_cat', function(){
  $('#cat_id').val($(this).attr('id'));
  $('#content_lib_cat').val($(this).data('id'));
  $('#content_list_cat').hide();

})



$(document).on('blur', '.edit_prod', function(){

    val=$(this).html(); val=val.replace('<br>',''); val=val.trim();
    prod_id=$(this).attr('id');
    field=$(this).data('id');
     $.ajax({
                     url:"backend/edit_prod.php",
                     method:"POST",
                     data:{val:val,prod_id:prod_id,field:field},
                     success:function(data)
                     {
                     }
                });
  });

$(document).on('blur', '.edit_cat', function(){

    val=$(this).html(); val=val.replace('<br>',''); val=val.trim();
    cat_id=$(this).attr('id');
    field=$(this).data('id');
     $.ajax({
                     url:"backend/edit_cat.php",
                     method:"POST",
                     data:{val:val,cat_id:cat_id,field:field},
                     success:function(data)
                     {
                      //alert(data);
                     }
                });
  });

$(document).on('click', '.stock_state', function(){

    val=$(this).val();
    prod_id=$(this).data('id');
    field='is_stock';
     $.ajax({
                     url:"backend/edit_state_prod.php",
                     method:"POST",
                     data:{val:val,prod_id:prod_id,field:field},
                     success:function(data)
                     {
                      //alert(data);
                     }
                });
                //alert('bon');
  });

$(document).on('blur', '.edit_tarif', function(){

    var val=$(this).html();
    val=val.replace('<br>','');
    val=val.trim();
    var price_id=$(this).attr('id');
    var field=$(this).data('id');
     $.ajax({
                     url:"backend/edit_tarif.php",
                     method:"POST",
                     data:{price:val,price_id:price_id,field:field},
                     success:function(data)
                     {
                      //alert(val + ' '+price_id+' '+field);
                     }
                });


  });

$(document).on('click', '#category', function(){
  load_cat_form('');
 });

$(document).on('click', '#tarif', function(){
  load_tab_tarif();
 });

$(document).on('click', '#point_vente', function(){
  load_frm_pos('');
 });

$(document).on('click', '.new_pos', function(){
  id=$(this).data('id');
  load_frm_pos(id);
 });

$(document).on('click', '.det_tarif', function(){
  tar_id=$(this).data('id');
  load_tab_tarif_art(tar_id);
 });

$(document).on('click', '#last_prod', function(){
  load_prod_form('');
 });

$(document).on('click', '#products', function(){
  cat_id="";
  load_prod_tab(cat_id);
 });

$(document).on('click', '.cat_products', function(){
  cat_id=$(this).data('id');
  load_prod_tab(cat_id);

 });

$(document).on('click', '.new_cat', function(){
  id=$(this).data('id');		
  load_cat_form(id);
 });

$(document).on('click', '.new_tarif', function(){
  id=$(this).data('id');    
  load_frm_tarif(id);
 });

$(document).on('click', '.new_prod', function(){
  id=$(this).data('id');		
  load_prod_form(id);
 });

$(document).on('click', '.new_tarif_art', function(){
  prod_id=$(this).data('id');   
  id=$(this).attr('id'); 
  load_frm_tarif_art(prod_id,id);
 });

$(document).on('submit', '#frm_product', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_product.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {

     alert(data);
     load_prod_form('');
     $('#operation').val("Add");

    }
   });

   $('#frm_product')[0].reset();
});

$(document).on('submit', '#frm_pos', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_pos.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {

     alert(data);
     load_frm_pos('');
     $('#operation').val("Add");

    }
   });

   $('#frm_pos')[0].reset();
});

$(document).on('submit', '#frm_category', function(event){
  event.preventDefault();
    $.ajax({
    url:"backend/insert_category.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
      alert(data);
      load_cat_form('');
      $('#operation').val("Add");
    }
   });

   $('#frm_category')[0].reset();
});

$(document).on('submit', '#frm_tarif_art', function(event){

  prod_id=$('#prod_id').val();
  event.preventDefault();
    $.ajax({
    url:"backend/insert_new_tarif_art.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
      alert(data);
      load_frm_tarif_art(prod_id,'');
      $('#operation').val("Add");
    }
   });

   $('#frm_tarif_art')[0].reset();
});

$(document).on('submit', '#frm_tarif', function(event){
  event.preventDefault();
    $.ajax({
    url:"backend/insert_tarif.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
      alert(data);
      load_tab_tarif();
      $('#operation').val("Add");
    }
   });

   $('#frm_tarif')[0].reset();
});

$(document).on('click', '.trash_art', function(event){

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
      if(table=="category"){ load_cat_form('')}
      if(table=="products"){ load_prod_form('')}
      if(table=="tarif"){ load_tab_tarif()}
      if(table=="price"){ load_frm_tarif_art(prod_id,'')}
      if(table=="pos"){ load_frm_pos('')}
      if(table=="place"){ load_frm_place('',$(this).data('id'))}
    }
   });
  }
  else
  {
    return false;
  }
});


})
//fin

function load_cat_form(id)
{
  $.ajax({
   url:"forms/frm_category.php",
   method:'GET',
   data:{id:id},
    beforeSend:function(){
      $('#page-content').html("en Chargement ....");
    },
   success:function(data)
   {
    $('#page-content').html(data);
    $('#operation').data("Add");
    $('#cat_parent').selectpicker();
   $(".hide_cont_det").toggle();
   $('#tab').DataTable({
                      paging : "true",
                      searching : "true",
                      dom: 'Bfrtip',
                      buttons: ['excel', 'pdf', 'print']
                     });
   }
  })

}

function load_cat_tab()
{
  $.ajax({
   url:"tables/tab_category.php",
   method:"POST",
    beforeSend:function(){
      $('#page-content').html("en Chargement ....");
    },
   success:function(data)
   {
    $('#page-content').html(data);
    $('#tab').DataTable({
                      paging : "true",
                      searching : "true",
                      dom: 'Bfrtip',
                      buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                     });
   }
  })
}

function load_frm_tarif(id)
{
  $.ajax({
   url:"forms/frm_tarif.php",
   method:'GET',
   data:{id:id},
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

function load_tab_tarif()
{
  $.ajax({
   url:"tables/tab_tarif_det.php",
   method:"POST",
    beforeSend:function(){
      $('#page-content').html("en Chargement ....");
    },
   success:function(data)
   {
    $('#page-content').html(data);
    $('.tab').DataTable({
                      paging : "true",
                      searching : "true",
                      dom: 'Bfrtip',
                      buttons: ['excel', 'pdf', 'print']
                     });
   }
  })
}

function load_tab_tarif_art(tar_id)
{
  $.ajax({
   url:"tables/tab_tarif.php",
   method:"GET",
   data:{tar_id:tar_id},
    beforeSend:function(){
      $('#disp_tarif').html("en Chargement ....");
    },
   success:function(data)
   {
    $('#disp_tarif').html(data);
    $('.tab2').DataTable({
                      paging : "true",
                      searching : "true",
                      dom: 'Bfrtip',
                      buttons: ['excel', 'pdf', 'print']
                     });
   }
  })
}

function load_prod_form(id)
{
  $.ajax({
   url:"forms/frm_product.php",
   method:'GET',
   data:{id:id},
    beforeSend:function(){
      $('#page-content').html("en Chargement ....");
    },
   success:function(data)
   {
    $('#page-content').html(data);
    $('#cat_id').selectpicker();
    $('#operation').data("Add");

    $('#tab').DataTable({
                      "ordering":true,
                      paging : "false",
                      "searching": true
                     });
   }
  })
}

function load_prod_tab(cat_id)
{
  $.ajax({

   url:"tables/tab_products.php",
   method:'GET',
   data:{cat_id:cat_id},
   beforeSend : function ()
      {
         $("#page-content").html('Chargement...');
      },
   success:function(data)
   {
        $('#page-content').html(data);
        $(".hide_cont_det").toggle();
        $('.tab').DataTable({
                      paging : "true",
                      searching : "true",
                      dom: 'Bfrtip',
                      buttons: ['excel','print']
                     });

    }
    })
}

function load_frm_tarif_art(prod_id,id)
{
  $.ajax({
   url:"forms/frm_new_tarif_art.php",
   method:'GET',
   data:{prod_id:prod_id,id:id},
    beforeSend:function(){
      $('#page-content').html("en Chargement ....");
    },
   success:function(data)
   {
    $('#page-content').html(data);
    $('#tar_id').selectpicker();
    $('#operation').data("Add");
   }
  })
}

function load_last_prod_tab()
{
  $.ajax({

   url:"tables/tab_last_products.php",
   method:'GET',
   beforeSend : function ()
      {
         $("#page-content").html('Chargement...');
      },
   success:function(data)
   {
        $('#page-content').html(data);
        $('#tab').DataTable({
                      "ordering":false,
                      paging : "true",
                      searching : "false"
                     });

    }
    })
}

function load_frm_pos(id)
{
  $.ajax({
   url:"forms/frm_pos.php",
   method:'GET',
   data:{id:id},
    beforeSend:function(){
      $('#page-content').html("en Chargement ....");
    },
   success:function(data)
   {
    $('#page-content').html(data);
    $('#operation').data("Add");

    $('.tab').DataTable({
                      "ordering":false,
                      paging : "true",
                      searching : "true",
                      dom: 'Bfrtip',
                      buttons: ['excel', 'pdf', 'print']
                     });
   }
  })
}

function autocomplete_cat() {
keyword = $('#content_lib_cat').val();
  $.ajax({
    url: 'tables/list_cat.php',
    type: 'POST',
    data: {keyword:keyword},
    success:function(data){
      $('#content_list_cat').show();
      $('#content_list_cat').html(data);
    }
  });
}

function load_frm_compo()
{

  //alert(acc_id);
  $.ajax({
    type:'GET',
    url:'forms/frm_composition.php',
    beforeSend:function(){
      $('#page-content').html("en Chargement ....");
    },
    success:function(data)
    {
      $('#page-content').html(data);

      $('#tab1').DataTable({
                      "bInfo": false,
                      pagingType: "simple",
                      "pageLength": 10,
                      "bLengthChange": false
                     });

      load_tab_compo_ingred();
      load_tab_det_compo();
    }
  });
}

function load_tab_compo_ingred()
{

  //alert(acc_id);
  $.ajax({
    type:'GET',
    url:'forms/tab_ingred.php',
    beforeSend:function(){
      $('#tab_compo_ingred').html("en Chargement ....");
    },
    success:function(data)
    {
      $('#tab_compo_ingred').html(data);

      $('#tab2').DataTable({
                      "bInfo": false,
                      pagingType: "simple",
                      "pageLength": 10,
                      "bLengthChange": false
                     });

    }
  });
}

function load_tab_det_compo()
{
  $.ajax({
    type:'GET',
    url:'forms/tab_det_compo.php',
    beforeSend:function(){
      $('#tab_det_compo').html("en Chargement ....");
    },
    success:function(data)
    {
      $('#tab_det_compo').html(data);

      $('#tab3').DataTable({
                      "bInfo": false,
                      pagingType: "simple",
                      "pageLength": 10,
                      "bLengthChange": false
                     });

    }
  });
}

