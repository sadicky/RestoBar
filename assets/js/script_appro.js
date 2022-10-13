$(function() {
  $(document).on('click', '#cancel_action_appro_mp', function(){
  $.ajax({
   url:"backend/end_session_appro_mp.php",
   success:function(data)
   {
    load_frm_new_appro();
   }
  })

 });
//editing quantity
  

  $(document).on('blur', '.edit_exp', function(){

    var val=$(this).html();
    val=val.replace('<br>','');
    val=val.trim();
    id=$(this).attr('id');
     $.ajax({
                     url:"backend/edit_exp.php",
                     method:"POST",
                     data:{date_exp:val,id:id},
                     success:function(data)
                     {
                      //load_tab_det_compo();
                      //alert(data);
                     }
                });

  });



$(document).on('click', '#stk_under_min', function(){
  load_tab_under_min();
 });

$(document).on('click', '#stk_zero', function(){
  load_tab_zero();
 });



$(document).on('click', '#hist_appro', function(){
  //alert('cool');
  load_srch_hist_appro_tab();
 });



$(document).on('click', '#category_heb', function(){
  //alert('cool');
  load_cat_heb_tab();
 });

$(document).on('click', '#table', function(){
  //alert('cool');
  load_table_tab('1');
 });

$(document).on('click', '#coupon', function(){
  //alert('cool');
  load_coupon_tab('1');
 });

$(document).on('click', '#trash_cat', function(){
  //alert('cool');
  load_cat_tab('0');
 });

$(document).on('click', '#trash_table', function(){
  //alert('cool');
  load_table_tab('0');
 });

$(document).on('click', '#trash_coupon', function(){
  //alert('cool');
  load_coupon_tab('0');
 });

$(document).on('click', '#new_cat_heb', function(){
  load_cat_heb_form();
 });

$(document).on('click', '#new_table', function(){
  load_table_form();
 });

$(document).on('click', '#new_coupon', function(){
  load_coupon_form();
 });

$(document).on('click', '.new_heb', function(){
var cat_id=$(this).attr('id');
  load_chamb_form(cat_id);
 });

$(document).on('click', '.print_appro', function(){
var op_id=$(this).attr('id');
  load_tab_bon_appro(op_id);

 });

//Edit supply history





$(document).on('submit', '#frm_table', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_table.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {

     alert(data);
     $('#operation').val("Add");
     load_table_tab();
    }
   });

   $('#frm_table')[0].reset();
});

$(document).on('submit', '#frm_coupon', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_coupon.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {

     alert(data);
     $('#operation').val("Add");
    }
   });

   $('#frm_coupon')[0].reset();
});
//insert account

//search period suppliers


$(document).on('keyup', '#rech_prod', function(event){

var srch=$(this).val();
load_product_list(srch);
});

$(document).on('submit', '#sup_appro_form', function(event){
  //alert("Not coding ....");
  var srch=$('#rech_prod').val();

  event.preventDefault();
  if($('#op_id').val()=="")
  {
    alert('Choisir d\'abord l\'operation');
  }
  else
  {

    $.ajax({
    url:"backend/insert_sup_appro.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {

     //alert(data);
     $('#sup_appro_form')[0].reset();
     $('#lab_action').html("Enregistrer");
     $('#action').val("Add");
     $('#operation').val("Add");
     //load_sup_appro_tab();
     //load_product_list(srch);
     load_details_appro();
     $('#save_supply').css("visibility", "visible");
     $('#cancel_action_appro_mp').css("visibility", "hidden");
    }
   });
  }

});

$(document).on('click', '.update_det', function(){
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

    $('#prod_appro').val(data.prod_appro);
    $('#content_id_appro').val(data.prod_appro);
    $('#prod_id').val(data.prod_id);
    $('#prod_prix').val(data.prod_prix);
    $('#poids').val(data.poids);
    $('#lot').val(data.lot);
    $('#month').val(data.month);
    $('#year').val(data.year);

    $('#det_id').val(det_id);

    $('#prod_qt').val(data.prod_qt);

    $('#appro_id').val(det_id);

    $('#action').val("Edit");
    $('#operation').val("Edit");
    $('#lab_action').html("Modifier");

    //alert(data);

   },
    error: function() {
    alert('La requête n\'a pas aboutie'); }
  })
 });



$(document).on('click', '.delete_det', function(){
  var det_id = $(this).attr("id");
  var srch=$('#rech_prod').val();
  //alert(det_id);
  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/delete_appro.php",
    method:"POST",
    data:{det_id:det_id},
    success:function(data)
    {
     //alert(data);
     load_details_appro();
     //load_sup_appro_tab();
     //load_product_list(srch);
     //load_hit_appro_tab_after_del();
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

$(document).on('click', '.delete_op', function(){
  var op_id = $(this).attr("id");

  //alert(det_id);
  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/delete_operation.php",
    method:"POST",
    data:{op_id:op_id},
    success:function(data)
    {
     alert(data);
     load_sup_appro_tab();
     load_appro_profil();

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


$(document).on('click', '.row_prod', function(){

var prod_id=$(this).data("id");

//alert('select ok ok ' + prod_id);

$.ajax({
   url:"backend/fetch_prod_appro.php",
   method:"POST",
   data:{prod_id:prod_id},
   dataType:"json",
   success:function(data)
   {

    $('#prod_appro').val(data.prod_appro);
    $('#prod_id').val(data.prod_id);
    $('#prod_cat').html(data.prod_cat);
    //alert(data);

   },
    error: function() {
    alert('La requête n\'a pas aboutie'); }

  })
});

$(document).on('click', '.row_op', function(){

var op_id=$(this).data("id");

$.ajax({
   url:"backend/fetch_op_appro.php",
   method:"POST",
   data:{op_id:op_id},
   //dataType:"json",
   success:function(data)
   {
    load_appro_form();
    load_sup_appro_tab();
   }
  })

});



$(document).on('click', '.row_op_appro_hist', function(){

var op_id=$(this).data("id");
var four=$('#four_hist').val();
var from_d=$('#datepicker').val();
var to_d=$('#datepicker2').val();



$.ajax({
   url:"backend/fetch_op_appro_hist.php",
   method:"POST",
   data:{op_id:op_id},
   //dataType:"json",
   success:function(data)
   {
    load_det_hist_appro();
   }
  })

});

$(document).on('click', '.update_table', function(){
  //alert('modif')
  var table_id = $(this).attr("id");
  load_table_form();
  $.ajax({
   url:"backend/fetch_single_tab.php",
   method:"POST",
   data:{table_id:table_id},
   dataType:"json",
   success:function(data)
   {

    $('#table_num').val(data.table_num);
    $('#table_parent').val(data.table_parent);
    $('#table_id').val(table_id);
    $('#operation').val("Edit");


   }
  })
 });

$(document).on('click', '.update_coupon', function(){
  //alert('modif')
  var coupon_id = $(this).attr("id");
  load_coupon_form();
  $.ajax({
   url:"backend/fetch_single_coup.php",
   method:"POST",
   data:{coupon_id:coupon_id},
   dataType:"json",
   success:function(data)
   {

    $('#coupon_name').val(data.coupon_name);
    $('#coupon_id').val(coupon_id);
    $('#operation').val("Edit");


   }
  })
 });

$(document).on('click', '.update_prod', function(){
  //alert('modif')
  var prod_id = $(this).attr("id");
  var cat_id = $(this).data("id");
  //alert(cat_id);
load_prod_form(cat_id);
  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {

  $.ajax({
   url:"backend/fetch_single_prod.php",
   method:"POST",
   data:{prod_id:prod_id},
   dataType:"json",
   success:function(data)
   {

    $('#prod_name').val(data.prod_name);
    $('#prod_code').val(data.prod_code);
    $('#prod_price').val(data.prod_price);
    $('#qt_min').val(data.qt_min);
    $('#unt_mes').val(data.unt_mes);
    $('#prod_id').val(prod_id);
    
    if(data.is_stock=='Oui')
    {
      $('#is_stock_oui').attr('checked',true);
    }

    if(data.is_stock=='Non')
    {
      $('#is_stock_oui').attr('checked',true);
    }


    $('#operation').val("Edit");
   }
  })

  }
  else
  {
    return false;
  }
 });

$(document).on('click', '.update_chamb', function(){
  //alert('modif')
  var chamb_id = $(this).attr("id");
  var cat_id = $(this).data("id");
  //alert(cat_id);
load_chamb_form(cat_id);
  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {

  $.ajax({
   url:"backend/fetch_single_chamb.php",
   method:"POST",
   data:{chamb_id:chamb_id},
   dataType:"json",
   success:function(data)
   {

    $('#chamb_num').val(data.chamb_num);
    $('#chamb_price').val(data.chamb_price);
    $('#chamb_id').val(chamb_id);
    //$('#cat_id').val(data.cat_id);
  
    $('#operation').val("Edit");
   }
  })

  }
  else
  {
    return false;
  }
 });



$(document).on('click', '.delete_table', function(){
  var table_id = $(this).attr("id");
  var status = $(this).data("id");

  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/delete_tab.php",
    method:"POST",
    data:{table_id:table_id,status:status},
    success:function(data)
    {
     alert(data);
     load_table_tab('1');
    }
  })

  }
  else
  {
   return false;
  }
 });

$(document).on('click', '.delete_coupon', function(){
  var coupon_id = $(this).attr("id");
  var status = $(this).data("id");

  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/delete_coup.php",
    method:"POST",
    data:{coupon_id:coupon_id,status:status},
    success:function(data)
    {
     alert(data);
     load_coupon_tab('1');
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
  var cat_id = $(this).data("id");

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

});



function load_cat_heb_form()
{
  $.ajax({
   url:"forms/frm_category_heb.php",

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

function load_table_form()
{
  $.ajax({
   url:"forms/frm_table.php",

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

function load_coupon_form()
{
  $.ajax({
   url:"forms/frm_coupon.php",

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



function load_cat_heb_tab()
{
  $.ajax({
   url:"tables/tab_category_heb.php",
   method:"POST",
    //data:{status:status},

    beforeSend:function(){
      $('#page-content').html("en Chargement ....");
    },
   success:function(data)
   {
    $('#page-content').html(data);
    $('#example2').DataTable({
                      paging : "true",
                      searching : "true",
                      dom: 'Bfrtip',
                      buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                     });
   }
  })
}


function load_tab_under_min()
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

  var haut='Stock en dessous de la quantité Minimale\n';
  var bas='Etabli par ' + $('#sess_name').html() + '\n A la date du ' + today ;
  var titre=$('#MOTEL').html();

  $.ajax({
   url:"tables/tab_stock_under_min.php",
   method:"POST",
    beforeSend:function(){
      $('#page-content').html("en Chargement ....");
    },
   success:function(data)
   {
    $('#page-content').html(data);
    $('#example2').DataTable({
                      paging : "true",
                      searching : "true",
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

function load_tab_zero()
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

  var haut='Stock Moins de 3/4 de la quantité Minimale\n';
  var bas='Etabli par ' + $('#sess_name').html() + '\n A la date du ' + today ;
  var titre=$('#soft_title').html();

  $.ajax({
   url:"tables/tab_stock_zero.php",
   method:"POST",
    beforeSend:function(){
      $('#page-content').html("en Chargement ....");
    },
   success:function(data)
   {
    $('#page-content').html(data);
    $('#example2').DataTable({
                      paging : "true",
                      searching : "true",
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

function load_table_tab(status)
{
  $.ajax({
   url:"tables/tab_table.php",
   method:"POST",
    data:{status:status},
    beforeSend:function(){
      $('#page-content').html("en Chargement ....");
    },
   success:function(data)
   {
    $('#page-content').html(data);
    $('#example2').DataTable({
                      paging : "true",
                      searching : "true",
                      dom: 'Bfrtip',
                      buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                     });
   }
  })
}

function load_coupon_tab(status)
{
  $.ajax({
   url:"tables/tab_coupon.php",
   method:"POST",
    data:{status:status},

    beforeSend:function(){
      $('#page-content').html("en Chargement ....");
    },
   success:function(data)
   {
    $('#page-content').html(data);
    $('#example2').DataTable({
                      paging : "true",
                      searching : "true",
                      dom: 'Bfrtip',
                      buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                     });
   }
  })
}








function load_hit_appro_tab_after_del()
{
  var four=$('#four_hist').val();
  var from_d=$('#datepicker').val();
  var to_d=$('#datepicker2').val();
  var pos=$('#pos_rap').val();
  load_hit_appro_tab(four,from_d,to_d,pos);
}

function load_sup_profil(acc_id)
{

  //alert(acc_id);
  $.ajax({
    type:'GET',
    url:'tables/user_min_profile.php',
    data:{acc_id:acc_id},
    beforeSend:function(){
      $('#appro_profile').html("en Chargement ....");
    },
    success:function(data)
    {

      $('#appro_profile').html(data);
    }
  });
}

function load_product_list(srch)
{
  $.ajax({
    url:'tables/tab_product_sale.php',
    method:'POST',
    data:{srch:srch},
    beforeSend : function ()
      {
         $("#tab_srched_prod").html('Chargement ...');
      },
    success:function(data)
    {

        $("#tab_srched_prod").html(data);
         $('#dataTables-example').DataTable({
                      "bInfo": false,
                      pagingType: "simple",
                      "pageLength": 5,
                      "bLengthChange": false,
                      bFilter:false
                      //dom: 'Bfrtip'
                      //buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                     });
    }
  });
}


function load_appro_form()
{

  //alert(acc_id);
  $.ajax({
    type:'GET',
    url:'forms/frm_appro_det.php',
    beforeSend:function(){
      $('#appro_form').html("en Chargement ....");
    },
    success:function(data)
    {
      $('#appro_form').html(data);
      jQuery('#date_expx').datepicker({
               autoclose: true
                , todayHighlight: true
                , format: 'yyyy-mm-dd'
              });
    }
  });
}

function load_rech_prod()
{
  //alert(acc_id);
  $.ajax({
    url:'forms/frm_rech_prod.php',
    beforeSend:function(){
      $('#list_prod').html("en Chargement ....");
    },
    success:function(data)
    {
      $('#list_prod').html(data);

    }
  });
}

function load_sup_appro_tab()
{

  var acc_id=$('#sup_id').data('id');
  //alert(acc_id);
  $.ajax({
    type:'GET',
    url:'tables/tab_sup_appro.php',
    data:{acc_id:acc_id},
    beforeSend : function ()
      {
         $("#appro_tab").html('loading...');
      },
    success:function(data)
    {
      $('#appro_tab').html(data);

       $('#example24').DataTable({
                      "bInfo": false,
                      pagingType: "simple",
                      "pageLength": 5,
                      "bLengthChange": false,
                      dom: 'Bfrtip',
                      buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                     });
       $('#example23').DataTable({
                      "bInfo": false,
                      pagingType: "simple",
                      "pageLength": 5,
                      "bLengthChange": false,
                      dom: 'Bfrtip',
                      buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                     });
    },
    error: function() {
    alert('La requête n\'a pas abouti'); }
  });
}



function load_frm_filter_prod()
{
  $.ajax({
    type:'GET',
    url:'forms/frm_filter_prod.php',
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

function load_det_hist_appro()
{
  $.ajax({
    type:'GET',
    url:'tables/tab_det_hist_appro.php',
    beforeSend : function ()
      {
         $("#hist_det_appro_tab").html('loading...');
      },
    success:function(data)
    {
      $('#hist_det_appro_tab').html(data);
    },
    error: function() {
    alert('La requête n\'a pas abouti'); }
  });
}

function load_details_appro()
{
  $.ajax({
    type:'GET',
    url:'tables/tab_details_appro.php',
    beforeSend : function ()
      {
         $("#tab_details_appro").html('Chargement ...');
      },
    success:function(data)
    {
      $('#tab_details_appro').html(data);
      $('#example24').DataTable({
                      paging : "true",
                      searching : "true",
                      dom: 'Bfrtip',
                      buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                     });
      //alert(data);
    },
    error: function() {
    alert('La requête n\'a pas abouti'); }
  });
}



function load_tab_bon_appro(op_id)
{
  $.ajax({
   url:"tables/tab_bon_appro.php",
   method:"POST",
   data:{op_id:op_id},
   success:function(data)
   {
    $('#page-content').html(data);
   }
  })
}
