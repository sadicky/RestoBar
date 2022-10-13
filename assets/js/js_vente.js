$(function() {

// When the user clicks anywhere outside of the modal, close it
/*var modal = document.getElementById("myModal");
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}*/

$(document).on('blur', '.edit_place', function(){

    val=$(this).html(); val=val.replace('<br>',''); val=val.trim();
    place_id=$(this).attr('id');
    field=$(this).data('id');
     $.ajax({
                     url:"backend/edit_place.php",
                     method:"POST",
                     data:{val:val,place_id:place_id,field:field},
                     success:function(data)
                     {
                      //alert(data);
                     }
                });
  });

$(document).on('click', '.choose_acc', function(){
  load_insert_acc($(this).data('id'),$(this).attr('id'));
  load_frm_new_sale();
})

$(document).on('keyup', '.content_lib_acc', function(){
  autocomplete_acc($(this).val(),$(this).data('id'));
  
 });

$(document).on('blur', '.content_lib_acc', function(){
  load_insert_acc3($(this).val(),$(this).data('id'));
  load_frm_new_sale();
 });

$(document).on('click', '.save_cmd', function(){
  load_insert_acc2($('.content_lib_acc').val(),$(this).data('id'));
  load_frm_new_sale();
 });

$(document).on('submit', '#frm_product_v', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_product.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
     load_tarif_v();
    }
   });
});

$(document).on('change', '.sep_fact', function(){
  det=$(this).data('id');
  $.ajax({
    url:"backend/sep_fact.php",
    method:"POST",
    data:{cmd:det},
    success:function(data)
    {
     load_frm_new_sale();
    }
  })
  //alert('ok');
 });

$(document).on('change', '.cat-srch', function(){
  cat_id=$(this).val();
  load_tarif_v(cat_id);
 });

$(document).on('click', '#tarif_v', function(){
  load_tarif_v('');
 });

$(document).on('keyup', '.tab_id', function(){
tab=$(this).val();
id=$(this).data('id');
  $.ajax({
      url:'backend/check_table.php',
      method:"POST",
      data:{tab:tab},
      dataType:"json",
      success:function(data)
      {
        //alert(data);
       if(data.nb!= '0')
       {
        //alert(data);
        $('.tab_id').removeClass('border-danger');
        $('#tab_id'+id).addClass('bg-danger');
        $('#tab_id'+data.serv_id).addClass('border-danger');
        $('#tab'+id).attr("disabled", true);
        //alert(data.serv_id);
       }
       else
       {
        //alert(data);
        $('#tab_id'+id).removeClass('bg-danger');
        $('.tab_id').removeClass('border-danger');
        $('#tab'+id).attr("disabled", false);
       }
      }
     })
 });

$(document).on('click', '#print_rap', function(){
  var printable='rap_to_print';
  printData(printable);
 });
$(document).on('click', '#hist_vente', function(){
  load_srch_hist_vente_tab();
 });

$(document).on('click', '#annul', function(){
  load_annul();
 });

$(document).on('submit', '#frm_search_hist_vente', function(event){

  event.preventDefault();
  var client=$('#client_hist').val();
  var from_d=$('#datepicker').val();
  var to_d=$('#datepicker2').val();
  var pos=$('#pos_rap').val();

  load_hit_vente_tab(client,from_d,to_d,pos);


});

$(document).on('submit', '#frm_srch_annul', function(event){

  event.preventDefault();
  var from_d=$('#fromd').val();
  var to_d=$('#tod').val();
  load_annul_tab(from_d,to_d);
});

$(document).on('click', '.show_cont_tab', function(){
  part=$(this).data('id');
  $("#det"+part).toggle();
  if($(this).html()=='<i class="fa fa-minus"></i> Table')
  {
  $(this).html('<i class="fa fa-plus"></i> Table');
  }
  else
  {
   $(this).html('<i class="fa fa-minus"></i> Table');
  }
 });

$(document).on('keyup', '.content_lib_tab', function(){
  keyword=$(this).val();
  serv=$(this).data('id');
  autocomplete_tab(serv,keyword);
  //alert('ok');
 });

$(document).on('click', '.choose_tab', function(){
  serv=$(this).data('id');
  tab=$(this).attr('id');
  $('#tab_id'+serv).val(tab);
  $('#content_lib_tab'+serv).val(tab);
  $('#content_list_tab'+serv).hide();
  //alert(tab+serv);

})

$(document).on('change', '#trans_table_sale', function(){
op_id=$(this).val();
  $.ajax({
    url:"backend/trans_table.php",
    method:"POST",
    data:{op_id:op_id},
    success:function(data){
      //$('#edit_serv_sale').css("visibility", "hidden");
      load_frm_new_sale()
    }
  });


 });

$(document).on('click', '.row_op_vente', function(){
var op_id=$(this).data("id");
$.ajax({
   url:"backend/fetch_op_vente.php",
   method:"POST",
   data:{op_id:op_id},
   success:function(data)
   {
    //alert(data);
    load_frm_new_sale();
   }
  })

});

$(document).on('click', '#new_fact', function(){

  $.ajax({
    url:"backend/end_session.php",
   method:"POST",
   success:function(data)
   {
    load_frm_new_sale();
   }
  })
 });

$(document).on('blur', '.edit_det_qt', function(){

    var val=$(this).html();
    val=val.replace('<br>','');
    val=val.trim();
    var det_id=$(this).attr('id');
    var rech=$('#rech_prod_vente').val();

     $.ajax({
                     url:"backend/edit_det_vente_qt.php",
                     method:"POST",
                     data:{prod_qt:val,det_id:det_id},
                     success:function(data)
                     {
                      //alert(data);
                      load_frm_new_sale();
                     }
                });


  });

$(document).on('blur', '.edit_det_price', function(){

    var val=$(this).html();
    val=val.replace('<br>','');
    val=val.trim();
    var det_id=$(this).attr('id');
    var rech=$('#rech_prod_vente').val();

     $.ajax({
                     url:"backend/edit_det_vente_price.php",
                     method:"POST",
                     data:{price:val,det_id:det_id},
                     success:function(data)
                     {
                      //alert(data);
                      load_frm_new_sale();
                     }
                });


  });

$(document).on('blur', '.edit_det_acc', function(){

    var val=$(this).html();
    val=val.replace('<br>','');
    val=val.trim();
    var det_id=$(this).attr('id');
    
     $.ajax({
                     url:"backend/edit_det_acc.php",
                     method:"POST",
                     data:{acc:val,det_id:det_id},
                     success:function(data)
                     {
                      //alert(data);
                      load_frm_new_sale();
                     }
                });


  });

$(document).on('click', '.close_sale', function(){
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
     load_frm_new_sale();
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

$(document).on('click', '#add_det_fact', function(){
  var id=$(this).data('id');
  var red=$('#val_red').val();
  var type_red=$('#type_red').val();
  var vente_id=$('#det_sup_vente_id').val();

  $.ajax({
    url:"backend/insert_det_sup_vente.php",
    method:"POST",
    data:{op_id:id,vente_id:vente_id,red:red,type_red:type_red},
    success:function(data)
    {
      load_frm_new_sale();
    }
  })

 });

$(document).on('click', '.row_cmd', function(){
  cmd=$(this).data('id');
  $.ajax({
    url:"backend/row_cmd.php",
    method:"POST",
    data:{cmd:cmd},
    success:function(data){
      load_frm_new_sale();
      //alert(data);
    }
  });
});

$(document).on('click', '#new_cmd', function(){
  $.ajax({
    url:"backend/new_cmd.php",
    method:"POST",
    success:function(data){
      //alert(data);
      load_frm_new_sale();
    }
  });
});

$(document).on('click', '#add_det_tva', function(){
  var id=$(this).data('id');
  var tva=$('#val_tva').val();

  $.ajax({
    url:"backend/insert_det_sup_vente_tva.php",
    method:"POST",
    data:{op_id:id,tva:tva},
    success:function(data)
    {
     load_frm_new_sale();
    }
  })

 });

$(document).on('click', '.delete_det_vente', function(){
  var det_id = $(this).attr("id");
  
  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/delete_vente.php",
    method:"POST",
    data:{det_id:det_id},
    success:function(data)
    {
      alert(data);
     load_frm_new_sale();
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



$(document).on('click', '#print_facture', function(){
  var printable='facture';
  printData(printable);
 });

$(document).on('click', '#print_cmd', function(){
  var printable='cmd_to_print';
  printData(printable);
 });

/*$(document).on('click', '#print_bon', function(){
  var printable='bon';
  printData(printable);
 });*/

$(document).on('click', '#show_s_fact', function(){
  var lot=$('#s_fact').val();
  $.ajax({
    url:"backend/create_lot_fact.php",
    method:"POST",
    data:{lot:lot},
    success:function(data)
    {
     load_frm_new_sale();
    }
  })
 });

$(document).on('blur', '.edit_det_lot', function(){

    var val=$(this).html();
    val=val.replace('<br>','');
    val=val.trim();
    var det_id=$(this).attr('id');
    

     $.ajax({
                     url:"backend/edit_det_lot.php",
                     method:"POST",
                     data:{val:val,det_id:det_id},
                     success:function(data)
                     {
                      //alert(data);
                      //load_frm_info_client();
                     }
                });


  });

$(document).on('click', '.ch_prod', function(){
var prod_id=$(this).data("id");
qt=$('.qt_'+prod_id).val();
$.ajax({
   url:"backend/insert_vente_client.php",
   method:"POST",
   data:{prod_id:prod_id,qt:qt},
   success:function(data)
   {
    //alert(data);
    load_frm_new_sale();
  }
})

});

$(document).on('keyup', '.srch_prod', function(){
cat=$(this).attr("id");
prod=$(this).val();
$.ajax({
   url:"forms/frm_res_prod.php",
   method:"POST",
   data:{cat:cat,prod:prod},
   success:function(data)
   {
    //alert(data);
    $('#srch_res_prod'+cat).html(data);
    $(".hide_cont_det").hide();
   }
})
});

/*$(document).on('submit', '.new_sale_tab', function(){
serv_id=$(this).data("id");
tab_id=$('#tab_id'+serv_id).val();
if(tab_id=='')
{
alert('Numero de Table Svp !');
}
else
{
//alert(tab_id);
$.ajax({
   url:"backend/new_sale.php",
   method:"POST",
   data:{tab_id:tab_id,serv_id:serv_id},
   success:function(data)
   {
    //alert(data);
    load_frm_new_sale();
   }
})
}
});*/

$(document).on('click', '.new_sale_tab', function(){
tab_id=$(this).data("id");
serv=$('#crtServ').val();
//tab_id=$('#tab_id'+serv_id).val();

$.ajax({
   url:"backend/new_sale.php",
   method:"POST",
   data:{tab_id:tab_id,serv:serv},
   success:function(data)
   {
    load_frm_new_sale();
    //alert(data);
   }
})

});

$(document).on('click', '#place', function(){
  load_frm_place('','');
 });

$(document).on('click', '.place', function(){
  id=$(this).attr('id');
  place_id=$(this).attr('id');
  load_frm_place(id,'');
 });

$(document).on('click', '.place_det', function(){
  place_id=$(this).attr('id');
  load_frm_place('',place_id);
 });

$(document).on('submit', '#frm_place', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_place.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {

     alert(data);
     $('#operation').val("Add");
     load_frm_place('','');
    }
   });

   $('#frm_place')[0].reset();
});

$(document).on('click', '.add_new_nb', function(event){
  place_id=$(this).attr('id');
  parent_id=$(this).data('id');
    $.ajax({
    url:"backend/insert_new_nb.php",
    method:'POST',
    data:{parent_id:parent_id},
    success:function(data)
    {
     load_frm_place('',place_id);
    }
   });
});

$(document).on('click', '#hist_pay', function(){
  load_frm_hist_pay();
 });

$(document).on('submit', '#frm_srch_hist_pay', function(event){
  event.preventDefault();
  var from_d=$('#from_d').val();
  var to_d=$('#to_d').val();
  load_tab_hist_pay(from_d,to_d);
});

$(document).on('click', '#op_vente_jour', function(){
  date_from='';
  date_to='';
  jour='';
  crt_cat='';
  load_tab_prod_sale_jour(date_from,date_to,jour,crt_cat);
 });

$(document).on('submit', '#jr-search', function(event){
  event.preventDefault();
  date_from=$('#date_from').val();
  date_to=$('#date_to').val();
  jour='';
  crt_cat='';
  load_tab_prod_sale_jour(date_from,date_to,jour,crt_cat);
 });

$(document).on('click', '.crt-jr', function(){
  date_from=$('#date_from').val();
  date_to=$('#date_to').val();
  jour=$(this).data('id');
  crt_cat='';
  load_tab_prod_sale_jour(date_from,date_to,jour,crt_cat);
 });

$(document).on('change', '#crt_cat', function(){
  date_from=$('#date_from').val();
  date_to=$('#date_to').val();
  jour=$('#crt_jour').val();
  crt_cat=$(this).val();
  load_tab_prod_sale_jour(date_from,date_to,jour,crt_cat);
 });

/*$(document).on('click', '#print_facture', function(){
  var printable='facture';
  printData(printable);
 });*/

$(document).on('click', '#print_rp', function(){
  var printable='rapport';
  printData(printable);
 });

$(document).on('click', '#close_day', function(){
  jour=$('#current_jour').val();
  if(jour=='')
  {
    alert('Ouvrir d\'abord le Journal Svp!');
    load_form_open_day();
  }
  else
  {
    load_form_close_day();
  }
 });

$(document).on('submit', '#frm_close_day', function(event){

  event.preventDefault();
  operation=$('#operation').val();
  if(confirm("Etes-vous sur de vouloir fermer le journal ?"))
  {
  $.ajax({
   url:"backend/insert_close_day.php",
   method:"POST",
   data:new FormData(this),
   contentType:false,
   processData:false,
   success:function(data)
   {
    location.href='logout.php?logout=true';
   }
  })

  }
  else
  {
    return false;
  }
});

$(document).on('submit', '#frm_open_day', function(event){

  event.preventDefault();
  if(confirm("Etes-vous sur de vouloir Ouvrir le journal ?"))
  {
  $.ajax({
   url:"backend/insert_open_day.php",
   method:"POST",
   data:new FormData(this),
   contentType:false,
   processData:false,
   success:function(data)
   {
    location.href='market.php';
   }
  })

  }
  else
  {
    return false;
  }
});

$(document).on('click', '.new_aut_fv', function(){
  $('#myModalAutFV').css("display","block");
 });

$(document).on('click', '.close', function(){
  $('#myModalAutFV').css("display","none");
 });

$(document).on('submit', '#frm_autre_frais_v', function(event){

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
      load_frm_new_sale(date_from,date_to);
    }
   });
});

$(document).on('click', '.row_cust_pay', function(){
  sup_id=$(this).data('id');
  op_id=$(this).attr('id');
  load_frm_cust_paie(sup_id,op_id);
  up();
 });

$(document).on('change', '#tar_id_v', function(){
  prod_id=$('#prod_id').val();
  tar_id=$(this).val();
  pos_id=$('#pos_id_v').val();
  load_lot(prod_id,pos_id,tar_id);
  select_price(prod_id,tar_id);
})

$(document).on('click', '.choose_lot_v', function(){
  prod_id=$(this).attr('id');
  tar_id=$('#tar_id_v').val();
  pos_id=$('#pos_id_v').val();
  load_lot(prod_id,pos_id,tar_id);
})



$(document).on('change', '#pos_id_v', function(){
  prod_id=$('#prod_id').val();
  tar_id=$('#tar_id_v').val();
  pos_id=$(this).val();
  load_lot(prod_id,pos_id,tar_id);
})

$(document).on('click', '.choose_prod_v', function(){

  $('#prod_id').val($(this).attr('id'));
  $('#prod_equiv').val($(this).attr('id'));

  $('#content_lib_prod_v').val($(this).data('id'));
  $('#content_list_prod_v').hide();
  prod_id=$(this).attr('id');
  tar_id=$('#tar_id_v').val();
  select_price(prod_id,tar_id);
})

$(document).on('keyup', '#content_lib_prod_v', function(){
  autocomplete_prod_v();
 });

$(document).on('click', '.editDate', function(){
  $('#myModalDate').css("display","block");
  op_id=$(this).attr('id');
  select_op(op_id);
 });

$(document).on('click', '.editTable', function(){
  $('#myModalTable').css("display","block");
 });

$(document).on('click', '.new_aut_f', function(){
  $('#myModalAutF').css("display","block");
 });

$(document).on('click', '.new_prod_tar', function(){
  $('#myModalProd').css("display","block");
 });

$(document).on('click', '.close', function(){
  $('#myModalAutF').css("display","none");
  $('#myModalDate').css("display","none");
  $('#myModalTable').css("display","none");
  $('#myModalProd').css("display","none");
 });

$(document).on('submit', '#frm_edit_date_op', function(event){

  event.preventDefault();

  date_from=$('#date_from').val();
  date_to=$('#date_to').val();
    $.ajax({
    url:"backend/edit_date_op.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
     //alert(data);
    }
   });

   load_frm_new_sale(date_from,date_to);   
});

$(document).on('submit', '#frm_edit_table', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/edit_table.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
     load_frm_new_sale();  
    }
   });

    
});

$(document).on('click', '.choose_cust', function(){
  $('#cust_idr').val($(this).attr('id'));
  $('#content_lib_cust').val($(this).data('id'));
  $('#content_list_cust').hide();

  select_cust($(this).attr('id'));
})



$(document).on('click', '.choose_serv', function(){
  $('#serv_id').val($(this).attr('id'));
  $('#serv_code').val($(this).data('id'));
  $('#content_lib_serv').val($(this).html());
  $('#content_list_serv').hide();

  select_serv($(this).attr('id'));
})

$(document).on('keyup', '#content_lib_cust', function(){
  autocomplete_cust();
  $('#cust_id').val('');
 });

$(document).on('keyup', '#content_lib_cust_hot', function(){
  autocomplete_cust_hot();
  $('#cust_id').val('');
 });

$(document).on('keyup', '#content_lib_serv', function(){
  autocomplete_serv();
  $('#serv_id').val('');
 });

$(document).on('submit', '#frm_new_sale', function(event){

  event.preventDefault();

  date_from=$('#date_from').val();
  date_to=$('#date_to').val();
    $.ajax({
    url:"backend/insert_sale.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {

     //alert(data);
     $('#operation').val("Add");
     load_frm_new_sale(date_from,date_to);
    }
   });

   $('#frm_new_sale')[0].reset();
});

$(document).on('submit', '#frm_edit_customer', function(event){
  event.preventDefault();
    $.ajax({
    url:"backend/edit_customer.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
      //alert(data);
     load_frm_new_sale();
    }
   });
});

$(document).on('submit', '#frm_edit_server', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/edit_serv.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
     load_frm_new_sale();
    }
   });
});


$(document).on('click', '.del_op_sale', function(){
  var op_id = $(this).attr("id");
   
  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/delete.php",
    method:"POST",
    data:{op_id:op_id},
    success:function(data)
    {
      //alert(data);
      new_operation();
      load_frm_new_sale();
    }
  })
  }
  else
  {
   return false;
  }
 });

$(document).on('click', '.del_op_sale_hist', function(){
  var op_id = $(this).attr("id");
  var client=$('#client_hist').val();
  var from_d=$('#datepicker').val();
  var to_d=$('#datepicker2').val();
  var pos=$('#pos_rap').val();
   
  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/delete.php",
    method:"POST",
    data:{op_id:op_id},
    success:function(data)
    {
      load_hit_vente_tab(client,from_d,to_d,pos);
    }
  })
  }
  else
  {
   return false;
  }
 });

$(document).on('click', '.del_det_hist', function(){
  var det_id = $(this).attr("id");

  var client=$('#client_hist').val();
  var from_d=$('#datepicker').val();
  var to_d=$('#datepicker2').val();
  var pos=$('#pos_rap').val();
  
  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/delete_vente.php",
    method:"POST",
    data:{det_id:det_id},
    success:function(data)
    {
      //alert(data);
     load_hit_vente_tab(client,from_d,to_d,pos);
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

$(document).on('click', '.del_det_sale', function(){
  var det_id = $(this).attr("id");
  
  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/delete_sale.php",
    method:"POST",
    data:{det_id:det_id},
    success:function(data)
    {
     load_frm_new_sale();
    }
  })
  }
  else
  {
   return false;
  }
 });

$(document).on('submit', '#sale-search', function(){
  event.preventDefault();
    date_from=$('#date_from').val();
    date_to=$('#date_to').val();
    load_frm_hist_sale(date_from,date_to);
 });

$(document).on('click', '.row_edit_sale_hist', function(event){
  sale_id=$(this).data('id');
  
    $.ajax({
    url:"backend/create_session.php",
    method:'POST',
    data:{sale_id:sale_id},
    success:function(data)
    {
      load_frm_new_sale();
    }
   });
});

$(document).on('click', '.new_sale', function(){
  
  new_operation();
  load_frm_new_sale(); 
 });

$(document).on('click', '#customers', function(){
  id='';
  load_frm_customer(id);
 });

$(document).on('click', '#server', function(){
  id='';
  load_frm_server(id);
 });

$(document).on('click', '.cust_det_pay', function(){
  cust_id=$(this).data('id');
  op_id='';
  load_frm_cust_paie(cust_id,op_id);
 });

$(document).on('click', '.row_cust_pay', function(){
  cust_id=$(this).data('id');
  op_id=$(this).attr('id');
  load_frm_cust_paie(cust_id,op_id);
 });



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



$(document).on('submit', '#frm_server', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_serveur.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
      alert(data);
     $('#operation').val("Add");
     load_frm_server('');
    }
   });
   $('#frm_server')[0].reset();
});

$(document).on('click', '.edit_cust', function(){
  id=$(this).data('id');
  load_frm_customer(id);
 });

$(document).on('click', '.edit_serv', function(){
  id=$(this).data('id');
  load_frm_server(id);
 });

$(document).on('click', '.editCust', function(){
  $('#myModal').css("display","block");
  
  op_id=$(this).attr('id');
  pers_id=$(this).data('id');
  $('#cust_id').val(pers_id);

  //alert(op_id);
  $('#op_id_edit').val(op_id);
  select_cust(pers_id);
 });

$(document).on('click', '.editServ', function(){
  $('#myModalServ').css("display","block");
  
  op_id=$(this).attr('id');
   pers_id=$(this).data('id');
  $('#serv_id').val(pers_id);
  $('#op_id_edit2').val(op_id);
 
  select_serv(pers_id);
 });

$(document).on('click', '.close', function(){
  $('#myModal').css("display","none");;
 });

$(document).on('click', '.close', function(){
  $('#myModalServ').css("display","none");;
 });

$(document).on('click', '#new_sale', function(){
  
  jour=$('#current_jour').val();
  if(jour=='')
  {
    alert('Ouvrir d\'abord le Journal Svp!');
    load_form_open_day();
  }
  else
  {
  load_frm_new_sale();
  //load_frm_hist_sale('','');
  }
 });

$(document).on('click', '.trash_sale', function(event){

  table=$('#tab_details').val();
  id=$('#tab_details').data('id');
  val_id=$(this).attr('id');
  prod_id=$('#prod_id').val();
  aux=$(this).data('id');
  
if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
    $.ajax({
    url:"backend/delete_op.php",
    method:'POST',
    data:{table:table,val_id:val_id,id:id},
    success:function(data)
    {
      alert(data + table);
      if(aux=="customer"){ load_frm_customer('')}
      if(aux=="serveur"){ load_frm_server('')}
    }
   });
  }
  else
  {
    return false;
  }
});

/*fin */
})

function load_frm_new_sale()
{
  $.ajax({
   url:"forms/frm_new_sale.php",
   method:'GET',
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

function load_frm_customer(id)
{
 $.ajax({
   url:"forms/frm_customer.php",
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

function load_frm_server(id)
{
 $.ajax({
   url:"forms/frm_server.php",
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

function load_frm_cust_paie(cust_id,op_id)
{
 $.ajax({
   url:"forms/frm_cust_paie.php",
   method:'POST',
   data:{cust_id:cust_id,op_id:op_id},
  beforeSend: function()
    {
      $('.cust_paie').html('<p>page en chargement .......</p>');
    },
   success:function(data)
   {
    $('.cust_paie').html(data);
    $('.tab').dataTable();
   }
  }) 
}

function autocomplete_cust() {
keyword = $('#content_lib_cust').val();
  $.ajax({
    url: 'tables/list_cust.php',
    type: 'POST',
    data: {keyword:keyword},
    success:function(data){
      $('#content_list_cust').show();
      $('#content_list_cust').html(data);
    }
  });
}

function autocomplete_cust_hot() {
keyword = $('#content_lib_cust_hot').val();
  $.ajax({
    url: 'tables/list_cust_hot.php',
    type: 'POST',
    data: {keyword:keyword},
    success:function(data){
      $('#content_list_cust').show();
      $('#content_list_cust').html(data);
    }
  });
}

function autocomplete_serv() {
keyword = $('#content_lib_serv').val();
  $.ajax({
    url: 'tables/list_serv.php',
    type: 'POST',
    data: {keyword:keyword},
    success:function(data){
      $('#content_list_serv').show();
      $('#content_list_serv').html(data);
    }
  });
}

function select_cust(pers_id)
{
	$.ajax({
   url:"backend/fetch_one_customer.php",
   method:"POST",
   data:{pers_id:pers_id},
   dataType:"json",
   success:function(data)
   {
    //alert(data);
    $('#content_lib_cust').val(data.nom);
    $('#nom').val(data.nom);
    $('#tel').val(data.tel);
    $('#cust_code').val(data.cust_code);
    $('#cust_adr').val(data.cust_adr);
    $('#cust_num').val(data.cust_num);

    $('#personne_id').val(pers_id);
    //$('#cust_id').val(pers_id);
   }

  })
}

function select_serv(pers_id)
{
  $.ajax({
   url:"backend/fetch_one_server.php",
   method:"POST",
   data:{pers_id:pers_id},
   dataType:"json",
   success:function(data)
   {
    //alert(data);
    $('#content_lib_serv').val(data.nom);
    $('#serv_code').val(data.serv_code);
    $('#personne_id2').val(pers_id);
   }

  })
}

function select_op(op_id)
{
	$.ajax({
   url:"backend/fetch_one_op.php",
   method:"POST",
   data:{op_id:op_id},
   dataType:"json",
   success:function(data)
   {
    
    $('#date_op').val(data.date_op);
    $('#op_type').val(data.op_type);
    $('#op_edit_date').val(op_id);
   }

  })
}

function autocomplete_prod_v() {
keyword = $('#content_lib_prod_v').val();
  $.ajax({
    url: 'tables/list_prod_v.php',
    type: 'POST',
    data: {keyword:keyword},
    success:function(data){
      $('#content_list_prod_v').show();
      $('#content_list_prod_v').html(data);
    }
  });
}

function select_price(prod_id,tar_id)
{
  $.ajax({
   url:"backend/fetch_last_vente.php",
   method:"POST",
   data:{prod_id:prod_id,tar_id:tar_id},
   dataType:"json",
   success:function(data)
   {
    $('#price').val(data.price);
    $('#qt').focus();
    //alert(data);
   }
  })
}

function load_form_close_day()
{
  $.ajax({
    type:'GET',
    url:'forms/frm_close_day.php',
    success:function(data)
    {
      $('#page-content').html(data);
    }
  });
}

function printData(printable)
{
   var divToPrint=document.getElementById(printable);
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}

function load_tab_prod_sale_jour(date_from,date_to,jour,crt_cat)
{
  $.ajax({
    method:'GET',
    url:'tables/tab_prod_sale_jour.php',
    data:{date_from:date_from,date_to:date_to,jour:jour,crt_cat:crt_cat},
    beforeSend : function ()
      {
         $("#page-content").html('loading...');
      },
    success:function(data)
    {
      $('#page-content').html(data);
      $('#tab').DataTable({
                      "bInfo": false,
                      "ordering": true,
                      "paging":true,
                      "bLengthChange": true,
                      "bFilter":true
                     });
    }
  });
}

function load_tab_hist_pay(from_d,to_d)
{
  $.ajax({
    method:'GET',
    data:{from_d:from_d,to_d:to_d},
    url:'tables/tab_hist_pay.php',
    beforeSend : function ()
      {
         $("#tab_hist_pay").html('loading...');
      },
    success:function(data)
    {
      $('#tab_hist_pay').html(data);
      $('.tab').DataTable({
                      "bInfo": false,
                      "paging":false,
                      "bLengthChange": false,
                      dom: 'Bfrtip',
                      buttons: ['copy', 'csv','excel',{extend:'pdf',footer:true},{extend:'print',footer:true}],
              drawCallback: function () {
      var api = this.api();
      $('#t1').html(api.column( 2, {page:'current'} ).data().sum()).number( true, 0 );
    }
                     });
     $('.tc').number( true, 0 );
    }
  });
}

function load_frm_hist_sale(date_from,date_to)
{
  $.ajax({
    method:'GET',
    data:{date_from:date_from,date_to:date_to},
    url:'forms/frm_hist_sale.php',
    beforeSend : function ()
      {
         $("#hist_sale").html('loading...');
      },
    success:function(data)
    {
      $('#hist_sale').html(data);
      $('.tab').DataTable({
        "bInfo": false,
        "paging":false,
        "bLengthChange": false
      });
    }
  });
}

function load_frm_hist_pay()
{
  $.ajax({
    method:'GET',
    url:'forms/frm_srch_hist_pay.php',
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

function load_frm_place(id,place_id)
{
  $.ajax({
   url:"forms/frm_place.php",
   method:'GET',
   data:{id,id,place_id:place_id},
    beforeSend:function(){
      $('#page-content').html("en Chargement ....");
    },
   success:function(data)
   {
    $('#page-content').html(data);
   $(".tab").dataTable();
    
    $('#operation').data("Add");
   }
  })

}

function load_frm_place2(id)
{
  $.ajax({
   url:"forms/frm_place.php",
   method:'GET',
   data:{id,id},
    beforeSend:function(){
      $('#page-content').html("en Chargement ....");
    },
   success:function(data)
   {
    $('#page-content').html(data);
   //$(".hide_cont_det").toggle();
    
    $('#operation').data("Add");
   }
  })

}

function autocomplete_tab(serv,keyword) {
keyword =keyword; 
serv=serv;
  $.ajax({
    url: 'tables/list_tab.php',
    type: 'POST',
    data: {keyword:keyword,serv:serv},
    success:function(data){
      $('#content_list_tab'+serv).show();
      $('#content_list_tab'+serv).html(data);
    }
  });
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

  var haut='Vente du ' + from_d + ' : Au : ' + to_d + ' / Stock : '+ stock ;
  var bas='Etabli par ' + $('#sess_name').html() + ' A la date du ' + today ;
  var titre=$('#soft_title').html();

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

function load_tarif_v(cat_id)
{
  $.ajax({
   url:"tables/tab_tarif_vente.php",
   method:'GET',
   data:{cat_id:cat_id},
   beforeSend : function ()
      {
         $("#page-content").html('Chargement...');
      },
   success:function(data)
   {
    $('#page-content').html(data);
    $('.tab').DataTable({
                      "bInfo": false,
                      "paging":false,
                      "bLengthChange": false});
    }
    })
}

function load_frm_art(id)
{
  $.ajax({
   url:"forms/frm_product2.php",
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
   }
  })
}

function load_insert_acc(acc_name,det_id)
{
  $.ajax({
   url:"backend/insert_acc.php",
   method:'POST',
   data:{acc_name:acc_name,det_id:det_id},
   success:function(data)
   {
    //alert(acc_name + ' ' + det_id);
   }
  })
}

function load_insert_acc3(acc_name,det_id)
{
  $.ajax({
   url:"backend/insert_acc3.php",
   method:'POST',
   data:{acc_name:acc_name,det_id:det_id},
   success:function(data)
   {
    //alert(acc_name + ' ' + det_id);
    //alert(data);
   }
  })
}

function load_insert_acc2(acc_name,det_id)
{
  $.ajax({
   url:"backend/insert_acc2.php",
   method:'POST',
   data:{acc_name:acc_name,det_id:det_id},
   success:function(data)
   {
    //alert(acc_name + ' ' + det_id);
   }
  })
}

