$(function() {

$('#ma_balance').toggle();

$(document).on('click', '#no_valid_jour', function(){
  jour=$('#current_jour').val();
  if(jour=='')
  {
    alert('Ouvrir d\'abord le Journal Svp!');
    load_form_open_day();
  }
  else
  {
  load_tab_jour_no_valid();
  }
 });

$(document).on('click', '.valid_jour', function(){
  var jour_id = $(this).attr("id");

  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/valid_jour.php",
    method:"POST",
    data:{jour_id:jour_id},
    success:function(data)
    {
     alert(data);
     load_tab_jour_no_valid();
     load_acc_balance();
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

$(document).on('click', '.retreat_jour', function(){
  var jour_id = $(this).attr("id");
  var from_d=$('#datepicker').val();
  var to_d=$('#datepicker2').val();
  var pos=$('#pos_rap').val();
  choix=$('#choix').val();

  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/retreat_jour.php",
    method:"POST",
    data:{jour_id:jour_id},
    success:function(data)
    {
     alert(data);
     load_hist_jour_tab(from_d,to_d,pos,choix);
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

$(document).on('blur', '.edit_comment', function(){

    cont=$(this).html();
    jour_id=$(this).attr('id');
     $.ajax({
                     url:"backend/edit_comment.php",
                     method:"POST",
                     data:{cont:cont,jour_id:jour_id},
                     success:function(data)
                     {
                      //alert(data);
                      //load_form_open_day();
                     }
                });

  });

$(document).on('blur', '.edit_final', function(){

    cont=$(this).html();
    jour_id=$(this).attr('id');
     $.ajax({
                     url:"backend/edit_final.php",
                     method:"POST",
                     data:{cont:cont,jour_id:jour_id},
                     success:function(data)
                     {
                      //alert(data);
                      //load_form_open_day();
                     }
                });

  });

$(document).on('click', '#pay_under_min', function(){
  load_tab_pay_under_min();
 });

$(document).on('click', '.show_ma_balance', function(){
  $("#ma_balance").toggle();
  if($(this).attr('id')=='0')
  {
  $(this).html('<i class="fa fa-minus"></i>');
  $(this).attr('id','1');
  }
  else
  {
   $(this).html('<i class="fa fa-plus"></i>');
   $(this).attr('id','0');
  }
 });

$(document).on('click', '.show_paid_det', function(){
  part=$(this).data('id');
  $("#det"+part).toggle();
 });

$(document).on('click', '.aff_recu_four', function(){
  paie_id=$(this).data('id');
  op_id=$(this).attr('id');
  load_tab_recu_paie_four(op_id,paie_id);
 });

$(document).on('keyup', '#mont_trans', function(){
  mont=parseInt($(this).val());
  du=parseInt($('#mont_du').val());

  if(mont<du)
  {
    $('#date_pay').removeAttr("readonly");
    //alert('ok');
  }
  else
  {
    $('#date_pay').attr('readonly','readonly');
    //alert('non');
  }
  //alert('yes');
 });

$(document).on('click', '#open_day', function(){
    load_form_open_day();
 });

$(document).on('click', '#jour_ant', function(){
    load_srch_hist_jour_tab();
 });

$(document).on('submit', '#frm_srch_hist_jour', function(event){

  event.preventDefault();
  var from_d=$('#datepicker').val();
  var to_d=$('#datepicker2').val();
  var pos=$('#pos_rap').val();
  choix=$('#choix').val();

  load_hist_jour_tab(from_d,to_d,pos,choix);


});

$(document).on('submit', '#frm_open_day', function(event){

  event.preventDefault();
  operation=$('#operation').val();
  if(confirm("Etes-vous sur de vouloir ouvrir le journal ?"))
  {
  $.ajax({
   url:"backend/insert_open_day.php",
   method:"POST",
   data:new FormData(this),
   dataType:"json",
   contentType:false,
   processData:false,
   success:function(data)
   {
    alert(data.msg);
    load_display_journal();
    load_left_menu();
    $('#current_jour').val(data.jour);
    $('#page-content').html('');
    if(data.jour=='')
    {
    $('#open_day').html('Cloturer le Journal');
    }
    else
    {
    $('#open_day').html('Ouvrir le Journal');
    }

    load_main_menu_2();
    location.reload(true);
   }
  })

  }
  else
  {
    return false;
  }
});

//versement
$(document).on('click', '#alim_cpt', function(){
  jour=$('#current_jour').val();

  if(jour=='')
  {
    alert('Ouvrir d\'abord le Journal Svp!');
    load_form_open_day();
  }
  else
  {
    load_form_trans_alim();
  }
 });

//retrait
$(document).on('click', '#trans_cpt', function(){
  jour=$('#current_jour').val();

  if(jour=='')
  {
    alert('Ouvrir d\'abord le Journal Svp!');
    load_form_open_day();
  }
  else
  {
    load_form_trans_transf();
  }
 });

$(document).on('click', '#ret_cpt', function(){
  jour=$('#current_jour').val();

  if(jour=='')
  {
    alert('Ouvrir d\'abord le Journal Svp!');
    load_form_open_day();
  }
  else
  {
    load_form_trans_ret();
  }
 });

$(document).on('click', '#transact_jour', function(){
  load_trans_tab_jour();
 });

$(document).on('click', '.transact_jour', function(){
  caissier=$(this).data('id');
  jour=$(this).attr('id');
  load_trans_tab_jour_ant(jour,caissier);
 });

//Transfert
$(document).on('click', '#transf_cpt', function(){
    load_form_trans_transf();
    load_trans_tab_transf();
 });

//retrait
$(document).on('click', '#dep', function(){
    load_form_trans_dep();
    load_trans_tab_dep();
 });

$(document).on('click', '#add_fund', function(){
    load_form_trans_alim();
 });

//paiement
$(document).on('click', '#paiement', function(){
    load_trans_tab_paie();
 });

$(document).on('click', '#paiement_cli', function(){
    load_trans_tab_paie_cli();
 });

$(document).on('click', '#add_pyt', function(){
  $.ajax({
   url:"forms/frm_new_paie.php",
   success:function(data)
   {
    $('#page-content').html(data);
   }
  })
 });

$(document).on('click', '#add_pymt_cli', function(){
  $.ajax({
   url:"forms/frm_new_paie_cli.php",
   success:function(data)
   {
    $('#page-content').html(data);
   }
  })
 });

$(document).on('submit', '#frm_search_jour_cais', function(event){

  event.preventDefault();
  var user_acc=$('#user_acc').val();
  var from_d=$('#datepicker').val();
  var to_d=$('#datepicker2').val();

  load_jour_cais_tab(user_acc,from_d,to_d);


});

$(document).on('click', '.achat_non_paie', function(event){

  var four=$(this).data('id');
  nom_four=$(this).attr('id');
  load_achat_non_pay_tab(four,nom_four);

});

$(document).on('click', '.fiche_four', function(event){

  var four=$(this).data('id');
  nom_four=$(this).attr('id')
    load_tab_fiche_four(four,nom_four);

});

$(document).on('click', '.fiche_cli', function(event){

  var cli=$(this).data('id');
  var nom_cli=$(this).attr('id');
    load_tab_fiche_vente(cli,nom_cli);

});

//search account
$(document).on('submit', '#frm_search_acc_pay_cli', function(event){

  event.preventDefault();
  var acc_id=$('#rech_acc_num_cli').val();

    load_user_profil_cli(acc_id);
    load_pay_form_cli(acc_id);
    load_vente_non_pay_tab_cli(acc_id,"");

});

$(document).on('click', '.row_achat', function(){
jour=$('#current_jour').val();

  if(jour=='')
  {
    alert('Ouvrir d\'abord le Journal Svp!');
    load_form_open_day();
  }
  else
  {
var op_id=$(this).data("id");
//alert(op_id);
$.ajax({
   url:"forms/frm_paie.php",
   method:"POST",
   data:{op_id:op_id},
   success:function(data)
   {
    $('#page-content').html(data);
   }
  })
}
});

$(document).on('click', '.row_pay_date', function(){

var op_id=$(this).data("id");
//alert(op_id);
$.ajax({
   url:"forms/frm_date_paie.php",
   method:"POST",
   data:{op_id:op_id},
   success:function(data)
   {
    $('#page-content').html(data);
   }
  })

});

$(document).on('click', '.row_vente', function(){

var op_id=$(this).data("id");
var acc_id=$("#sup_acc_id").data("id");
//alert(acc_id);
$.ajax({
   url:"backend/fetch_op_paie_vente.php",
   method:"POST",
   data:{op_id:op_id},
   dataType:"json",
   success:function(data)
   {
    $('#op_id_paie').val(data.op_id);
    $('#mont_du').val(data.mont_du);
    $('#num_fact').html(data.num_vente);
    load_vente_non_pay_tab_cli(acc_id,op_id);
    /*alert(data);*/

   }
  })

});

$('#action').val("Add");
$('#operation').val("Add");
$('#reset_act').click(initialiser);

$(document).on('submit', '#frm_alim_cpt', function(event){
	//alert("ca va enregistrer");
  event.preventDefault();

    $.ajax({
    url:"backend/insert_alim_cpt.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
      alert(data);
     $('#frm_alim_cpt')[0].reset();
     $('#lab_action').html("Enregistrer");
     $('#action').val("Add");
     $('#operation').val("Add");
     load_acc_balance();
    }
   });

})

$(document).on('submit', '#frm_ret_cpt', function(event){
  //alert("ca va enregistrer");
  event.preventDefault();

    $.ajax({
    url:"backend/insert_ret_cpt.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
      alert(data);
     $('#frm_ret_cpt')[0].reset();
     $('#lab_action').html("Enregistrer");
     $('#action').val("Add");
     $('#operation').val("Add");
     load_acc_balance();
    }
   });

})

$(document).on('submit', '#frm_trans_cpt', function(event){
  //alert("ca va enregistrer");
  event.preventDefault();

    $.ajax({
    url:"backend/insert_trans_cpt.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
      alert(data);
     $('#frm_trans_cpt')[0].reset();
     $('#lab_action').html("Enregistrer");
     $('#action').val("Add");
     $('#operation').val("Add");
     load_acc_balance();
    }
   });

})

$(document).on('submit', '#frm_transf_cpt', function(event){
  //alert("ca va enregistrer");
  event.preventDefault();

    $.ajax({
    url:"backend/insert_transf_cpt.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
      alert(data);
      $('#frm_transf_cpt')[0].reset();

     $('#lab_action').html("Enregistrer");
     $('#action').val("Add");
     $('#operation').val("Add");

     load_acc_balance();
     load_trans_tab_transf();

    }
   });

})

$(document).on('submit', '#frm_dep', function(event){
  //alert("ca va enregistrer");
  event.preventDefault();

    $.ajax({
    url:"backend/insert_dep.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
      alert(data);
      $('#frm_dep')[0].reset();

     $('#lab_action').html("Enregistrer");
     $('#action').val("Add");
     $('#operation').val("Add");

     load_acc_balance();
     load_trans_tab_dep();

    }
   });

})

$(document).on('submit', '#frm_paie', function(event){

  event.preventDefault();
  four =$('#four_id').val();
  nom_four=$('#nom_four').val()

    $.ajax({
    url:"backend/insert_paie.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
      alert(data);
      $('#frm_paie')[0].reset();

     $('#lab_action').html("Enregistrer");
     $('#action').val("Add");
     $('#operation').val("Add");

      load_achat_non_pay_tab(four,nom_four);
      load_acc_balance();
    }
   });

})

$(document).on('submit', '#frm_date_paie', function(event){

  event.preventDefault();
  four =$('#four_id').val();
  nom_four =$('#nom_four').val();
    $.ajax({
    url:"backend/insert_date_paie.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
      //alert(data);

     $('#frm_date_paie')[0].reset();
     $('#lab_action').html("Enregistrer");
     $('#action').val("Add");
     $('#operation').val("Add");

      load_achat_non_pay_tab(four,nom_four);
    }
   });

})

$(document).on('submit', '#frm_paie_cli', function(event){

  event.preventDefault();
  var acc_id=$('#sup_acc_id').data('id');
  var op_id=$('#op_id_paie').val();
    $.ajax({
    url:"backend/insert_paie_cli_per.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
      alert(data);
      $('#frm_paie_cli')[0].reset();

     $('#lab_action').html("Enregistrer");
     $('#action').val("Add");
     $('#operation').val("Add");


      load_vente_non_pay_tab_cli(acc_id,op_id);
      load_acc_balance();
    }
   });
})


$(document).on('click', '.update_vers', function(){

  var trans_id = $(this).attr("id");
  load_form_trans_alim();
  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
  $.ajax({
   url:"backend/fetch_single_trans.php",
   method:"POST",
   data:{trans_id:trans_id},
   dataType:"json",
   success:function(data)
   {
    $('#mont_trans').val(data.mont_trans);
    $('#comment_trans').val(data.comment_trans);
    $('#hidden_mont').val(data.mont_trans);
    $('#trans_id').val(trans_id);
    $('#action').val("Edit");
    $('#operation').val("Edit");
    $('#lab_action').html("Modifier");

    //alert(data);

   },
		error: function() {
		alert('La requête n\'a pas abouti'); }
  })
  }
else
{
  load_trans_tab_jour();
}
 });

$(document).on('click', '.update_ret', function(){

  var trans_id = $(this).attr("id");
  load_form_trans_ret();
  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
  $.ajax({
   url:"backend/fetch_single_trans.php",
   method:"POST",
   data:{trans_id:trans_id},
   dataType:"json",
   success:function(data)
   {
    $('#mont_trans').val(data.mont_trans);
    $('#comment_trans').val(data.comment_trans);
    $('#hidden_mont').val(data.mont_trans);
    $('#trans_id').val(trans_id);
    $('#action').val("Edit");
    $('#operation').val("Edit");
    $('#lab_action').html("Modifier");

    //alert(data);

   },
    error: function() {
    alert('La requête n\'a pas abouti'); }
  })
  }
else
{
   load_trans_tab_jour();
}
 });

$(document).on('click', '.update_trans', function(){

  var trans_id = $(this).attr("id");
  load_form_trans_transf();
  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
  $.ajax({
   url:"backend/fetch_single_trans.php",
   method:"POST",
   data:{trans_id:trans_id},
   dataType:"json",
   success:function(data)
   {
    $('#mont_trans').val(data.mont_trans);
    $('#comment_trans').val(data.comment_trans);
    $('#hidden_mont').val(data.mont_trans);
    $('#trans_id').val(trans_id);
    $('#action').val("Edit");
    $('#operation').val("Edit");
    $('#lab_action').html("Modifier");

    //alert(data);

   },
    error: function() {
    alert('La requête n\'a pas abouti'); }
  })
  }
else
{
   load_trans_tab_jour();
}
 });

$(document).on('click', '.delete_trans', function(){
  var trans_id = $(this).attr("id");

  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/cancel_trans.php",
    method:"POST",
    data:{trans_id:trans_id},
    success:function(data)
    {
     alert(data);
     load_trans_tab_jour();
     load_acc_balance();
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

$(document).on('click', '.delete_trans2', function(){
  var trans_id = $(this).attr("id");
  var client=$('#client_hist').val();
  var from_d=$('#datepicker').val();
  var to_d=$('#datepicker2').val();
  var pos=$('#pos_rap').val();

  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/cancel_trans.php",
    method:"POST",
    data:{trans_id:trans_id},
    success:function(data)
    {
     alert(data);
     

     load_hit_vente_tab(client,from_d,to_d,pos);
     load_acc_balance();
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

$(document).on('click', '.delete_ret', function(){
  var trans_id = $(this).attr("id");

  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/delete_ret.php",
    method:"POST",
    data:{trans_id:trans_id},
    success:function(data)
    {
     alert(data);

     load_acc_balance();
     load_trans_tab_ret();
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

$(document).on('click', '.delete_dep', function(){
  var trans_id = $(this).attr("id");

  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/delete_dep.php",
    method:"POST",
    data:{trans_id:trans_id},
    success:function(data)
    {
     alert(data);

     load_acc_balance();
     load_trans_tab_dep();
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


$(document).on('click', '.delete_paie_four', function(){
  var trans_id = $(this).attr("id");
  var acc_id=$('#rech_acc_num').val();

  if(confirm("Etes-vous sur de vouloir annuler cette operation ?"))
  {
   $.ajax({
    url:"backend/delete_paie_four.php",
    method:"POST",
    data:{trans_id:trans_id},
    success:function(data)
    {
     alert(data);

     load_achat_non_pay_tab(acc_id,"");
     load_acc_balance();

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


});

function load_jour_cais_tab(user_acc,from_d,to_d)
{
  $.ajax({
   url:"tables/tab_jour_cais.php",
   method:'GET',
   data:{user_acc:user_acc,from_d:from_d,to_d:to_d},
   beforeSend : function ()
      {
         $("#tab_jour_cais").html('Chargement...');
      },
   success:function(data)
   {

    $('#tab_jour_cais').html(data);
    $('#example2').DataTable({
                      "bInfo": false,
                      "bLengthChange": false,
                      dom: 'Bfrtip',
                      buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                     });

    }
    })
}

function load_acc_profil()
{

	var acc_id=$('#acc_id').data('id');
	//alert(acc_id);
	$.ajax({
		type:'GET',
		url:'tables/account_profile.php',
		data:{acc_id:acc_id},
		success:function(data)
		{

			$('#acc_profile').html(data);
		},
		error: function() {
		alert('La requête n\'a pas abouti'); }
	});
}

function load_srch_jour_cais_tab()
{
  $.ajax({
    type:'GET',
    url:'forms/frm_srch_jour_cais.php',
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

function load_form_trans_alim()
{

	var acc_id=$('#acc_id').data('id');
	//alert(acc_id);
	$.ajax({
		type:'GET',
		url:'forms/frm_transations_alim.php',
		success:function(data)
		{
			$('#page-content').html(data);
		}
	});
}

function load_form_encais(jour)
{
  $.ajax({
    method:'GET',
    url:'forms/frm_encais_vend.php',
    data:{jour_vend:jour},
    success:function(data)
    {
      $('#page-content').html(data);
    }
  });
}

function load_form_trans_ret()
{

  var acc_id=$('#acc_id').data('id');
  //alert(acc_id);
  $.ajax({
    type:'GET',
    url:'forms/frm_retrait_cais.php',
    success:function(data)
    {
      $('#page-content').html(data);
    }
  });
}

function load_form_trans_transf()
{

  var acc_id=$('#acc_id').data('id');
  //alert(acc_id);
  $.ajax({
    type:'GET',
    url:'forms/frm_trans_cais.php',
    success:function(data)
    {
      $('#page-content').html(data);

    }
  });
}

function load_form_trans_dep()
{

  var acc_id=$('#acc_id').data('id');
  //alert(acc_id);
  $.ajax({
    type:'GET',
    url:'forms/frm_depense.php',
    success:function(data)
    {
      $('#page-content').html(data);
      jQuery('#date_trans').datepicker({
               autoclose: true
                , todayHighlight: true
                , format: 'yyyy-mm-dd'
              });
    }
  });
}

function load_acc_balance()
{
  $.ajax({
    type:'GET',
    url:'backend/ma_balance.php',
    success:function(data)
    {
      $('#ma_balance').html(data);
    }
  });
}

//transactions

function load_trans_tab_jour()
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

  var haut='Journal Encours de  : '+ $('#sess_name').html() +'\n';
  var bas='Etabli par ' + $('#sess_name').html() + '\n A la date du ' + today ;
  var titre=$('#soft_title').html();

  $.ajax({
    type:'GET',
    url:'tables/tab_transactions.php',
    beforeSend : function ()
      {
         $("#page-content").html('loading...');
      },
    success:function(data)
    {
      $('#page-content').html(data);
      $('#example2').DataTable({
                      /*"bInfo": false,*/
                      "ordering": false,
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
  });
}

function load_trans_tab_jour_ant(jour,caissier)
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

  var haut='Journal de  : '+ caissier +'\n';
  var bas='Etabli par ' + $('#sess_name').html() + '\n A la date du ' + today ;
  var titre=$('#soft_title').html();

  $.ajax({
    type:'POST',
    url:'tables/tab_transactions_ant.php',
    data:{jour:jour},
    beforeSend : function ()
      {
         $("#page-content").html('loading...');
      },
    success:function(data)
    {
      $('#page-content').html(data);
      $('#example2').DataTable({
                      /*"bInfo": false,*/
                      "ordering": false,
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
  });
}

//load versement historique
function load_trans_tab_alim()
{

	var acc_id=$('#acc_id').data('id');
	//alert(acc_id);
	$.ajax({
		type:'GET',
		url:'tables/tab_transactions_alim.php',
		data:{acc_id:acc_id},
		beforeSend : function ()
      {
         $("#trans_alim_tab").html('loading...');
      },
		success:function(data)
		{
			$('#trans_alim_tab').html(data);
      $('#example2').DataTable({
                      "bInfo": false,
                      "bLengthChange": false,
                      dom: 'Bfrtip',
                      buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                     });
		}
	});
}

//load retrait historique
function load_trans_tab_ret()
{

  var acc_id=$('#acc_id').data('id');
  //alert(acc_id);
  $.ajax({
    type:'GET',
    url:'tables/tab_retrait_cais.php',
    data:{acc_id:acc_id},
    beforeSend : function ()
      {
         $("#trans_ret_tab").html('loading...');
      },
    success:function(data)
    {
      $('#trans_ret_tab').html(data);
      $('#example2').DataTable({
                      "bInfo": false,
                      "bLengthChange": false,
                      dom: 'Bfrtip',
                      buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                     });
    }
  });
}


//load transfert historique
function load_trans_tab_transf()
{

  var acc_id=$('#acc_id').data('id');
  //alert(acc_id);
  $.ajax({
    type:'GET',
    url:'tables/tab_transf_cais.php',
    data:{acc_id:acc_id},
    beforeSend : function ()
      {
         $("#trans_transf_tab").html('loading...');
      },
    success:function(data)
    {
      $('#trans_transf_tab').html(data);
      $('#example2').DataTable({
                      "bInfo": false,
                      "bLengthChange": false,
                      dom: 'Bfrtip',
                      buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                     });
    }
  });
}

function load_trans_tab_dep()
{

  var acc_id=$('#acc_id').data('id');
  //alert(acc_id);
  $.ajax({
    type:'GET',
    url:'tables/tab_depense_cais.php',
    data:{acc_id:acc_id},
    beforeSend : function ()
      {
         $("#trans_dep_tab").html('loading...');
      },
    success:function(data)
    {
      $('#trans_dep_tab').html(data);
      $('#example2').DataTable({
                      "bInfo": false,
                      "bLengthChange": false,
                      dom: 'Bfrtip',
                      buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                     });
    }
  });
}


//load payement history
function load_trans_tab_paie()
{

  var acc_id=$('#acc_id').data('id');
  //alert(acc_id);
  $.ajax({
    type:'GET',
    url:'tables/tab_transactions_paie.php',
    data:{acc_id:acc_id},
    beforeSend : function ()
      {
         $("#page-content").html('loading...');
      },
    success:function(data)
    {
      $('#page-content').html(data);
      $('#example2').DataTable({
                      "bInfo": false,
                      "bLengthChange": false,
                      dom: 'Bfrtip',
                      buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                     });
    }
  });
}

function load_trans_tab_paie_cli()
{

  var acc_id=$('#acc_id').data('id');
  //alert(acc_id);
  $.ajax({
    type:'GET',
    url:'tables/tab_transactions_paie_cli.php',
    data:{acc_id:acc_id},
    beforeSend : function ()
      {
         $("#page-content").html('loading...');
      },
    success:function(data)
    {
      $('#page-content').html(data);
      $('#example2').DataTable({
                      "bInfo": false,
                      "bLengthChange": false,
                      dom: 'Bfrtip',
                      buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                     });
    }
  });
}

function load_user_profil(acc_id)
{

  //alert(acc_id);
  $.ajax({
    type:'GET',
    url:'tables/user_min_profile.php',
    data:{acc_id:acc_id},
    success:function(data)
    {

      $('#paie_profile').html(data);
    }
  });
}

function load_user_profil_cli(acc_id)
{

  //alert(acc_id);
  $.ajax({
    type:'GET',
    url:'tables/user_min_profile.php',
    data:{acc_id:acc_id},
    success:function(data)
    {

      $('#paie_profile_cli').html(data);
    }
  });
}

function load_pay_form(acc_id)
{
  $.ajax({
    type:'GET',
    url:'forms/frm_paie.php',
    data:{acc_id:acc_id},
    success:function(data)
    {
      $('#paie_form').html(data);
    }
  });
}

function load_date_pay_form(acc_id)
{

  //alert(acc_id);
  $.ajax({
    type:'GET',
    url:'forms/frm_date_paie.php',
    data:{acc_id:acc_id},
    success:function(data)
    {
      $('#paie_form').html(data);
    }
  });
}

function load_pay_form_cli(acc_id)
{

  //alert(acc_id);
  $.ajax({
    type:'GET',
    url:'forms/frm_paie_cli.php',
    data:{acc_id:acc_id},
    success:function(data)
    {
      $('#paie_form_cli').html(data);
    }
  });
}

function load_achat_non_pay_tab(four,nom_four)
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

  var haut='ACHATS NON PAYES\n FOURNISSEUR : '+nom_four+'\n';
  var bas='Etabli par ' + $('#sess_name').html() + '\n A la date du ' + today ;
  var titre=$('#soft_title').html();

  $.ajax({
    url:'tables/tab_achat_non_paie.php',
    method:"GET",
    data:{four:four},
    beforeSend : function ()
      {
         $("#page-content").html('loading...');
      },
    success:function(data)
    {
      $('#page-content').html(data);
      $(".hide_paid_det").toggle();
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
  });
}

function load_tab_fiche_four(four,nom_four)
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

  var haut='Fiche du Fournisseur  : '+ nom_four +'\n';
  var bas='\nEtabli par ' + $('#sess_name').html() + '\n A la date du ' + today ;
  var titre=$('#soft_title').html();

  $.ajax({
    url:'tables/tab_fiche_four.php',
    method:"GET",
    data:{four:four},
    beforeSend : function ()
      {
         $("#page-content").html('loading...');
      },
    success:function(data)
    {
      $('#page-content').html(data);
      $(".hide_paid_det").toggle();
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
  });
}

function load_tab_fiche_vente(cli,nom_cli)
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

  var haut='Fiche du Client  : '+ nom_cli +'\n';
  var bas='\nEtabli par ' + $('#sess_name').html() + '\n A la date du ' + today ;
  var titre=$('#soft_title').html();

  $.ajax({
    url:'tables/tab_fiche_vente.php',
    method:"GET",
    data:{cli:cli},
    beforeSend : function ()
      {
         $("#page-content").html('loading...');
      },
    success:function(data)
    {
      $('#page-content').html(data);
      $(".hide_paid_det").toggle();
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
  });
}

function load_vente_non_pay_tab_cli(acc_id,op_id)
{
  $.ajax({
    type:'POST',
    url:'tables/tab_info_pay_det_cli.php',
    data:{acc_id:acc_id,op_id:op_id},
    beforeSend : function ()
      {
         $("#vente_tab_det").html('loading...');
      },
    success:function(data)
    {
      $('#vente_tab_det').html(data);
    }
  });
}

function initialiser()
{
  alert("haha haha");
}

function load_form_open_day()
{
  //alert(acc_id);
  $.ajax({
    type:'GET',
    url:'forms/frm_open_day.php',
    success:function(data)
    {
      $('#page-content').html(data);

      $('#example23').DataTable({
                      "bInfo": false,
                      "bLengthChange": false,
                      dom: 'Bfrtip',
                      buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                     });
    }
  });
}

function load_tab_jour_no_valid()
{
  $.ajax({
    type:'GET',
    url:'tables/tab_jour_non_valid.php',
    success:function(data)
    {
      $('#page-content').html(data);

      $('#example23').DataTable({
                      "bInfo": false,
                      "bLengthChange": false,
                      dom: 'Bfrtip',
                      buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                     });
    }
  });
}

function load_display_journal()
{
  //alert(acc_id);
  $.ajax({
    type:'GET',
    url:'backend/display_journal.php',
    success:function(data)
    {
      $('#display_journal').html(data);
    }
  });
}

function load_srch_hist_jour_tab()
{
  $.ajax({
    type:'GET',
    url:'forms/frm_srch_hist_jour.php',
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

function load_hist_jour_tab(from_d,to_d,pos)
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

  var haut='Journal du ' + from_d + ' : Au : ' + to_d + ' \n POS : '+ stock ;
  var bas='\nEtabli par ' + $('#sess_name').html() + ' A la date du ' + today ;
  var titre=$('#soft_title').html();

  $.ajax({
   url:"tables/tab_hist_jour.php",
   method:'GET',
   data:{from_d:from_d,to_d:to_d,pos:pos,choix:choix},
   beforeSend : function ()
      {
         $("#tab_hist_jour").html('Chargement...');
      },
   success:function(data)
   {

    $('#tab_hist_jour').html(data);
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

function load_tab_recu_paie_four(op_id,paie_id)
{
  $.ajax({
    url:'tables/tab_recu_paie_four.php',
    method:'POST',
    data:{op_id:op_id,paie_id:paie_id},
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
function load_tab_pay_under_min()
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

  var haut='Paiement des fournitures à effecutuer bientôt\n';
  var bas='Etabli par ' + $('#sess_name').html() + '\n A la date du ' + today ;
  var titre=$('#soft_title').html();

  $.ajax({
   url:"tables/tab_pay_under_min.php",
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

