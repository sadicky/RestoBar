$(function() {

$(document).on('click', '#supply', function(){
  //alert('cool');
  $.ajax({
   url:"forms/frm_new_appro.php",
   success:function(data)
   {
    $('#page-content').html(data);
   }
  })
 });


$('#action').val("Add");
$('#operation').val("Add");
$('#reset_act').click(initialiser);

$(document).on('submit', '#sup_appro_form', function(event){
	//alert("Not coding ....");
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

     alert(data);
     $('#sup_appro_form')[0].reset();
     $('#lab_action').html("Enregistrer");
     $('#action').val("Add");
     $('#operation').val("Add");
     load_sup_appro_tab();
     load_appro_profil();
    }
   });
  }

});

$(document).on('click', '.nv_appro', function(){

  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
  $.ajax({
   url:"backend/new_appro.php",
   //method:"POST",
   //data:{price_id:price_id},
   //dataType:"json",
   success:function(data)
   {
    load_form_sup_appro();
    load_sup_appro_tab();
   },
    error: function() {
    alert('La requête n\'a pas aboutie'); }
  })
  }
  else
  {
    return false;
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
    $('#prod_id').val(data.prod_id);
    $('#prod_prix').val(data.prod_prix);

    $('#s_qty').val(data.s_qty);
    $('#s_wgt').val(data.s_wgt);
    $('#ns_qty').val(data.ns_qty);
    $('#ns_wgt').val(data.ns_wgt);

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

  //alert(det_id);
  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/delete_appro.php",
    method:"POST",
    data:{det_id:det_id},
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

var price_id=$(this).data("id");
//alert('select ok ok ' + price_id);

$.ajax({
   url:"backend/fetch_prod_appro.php",
   method:"POST",
   data:{price_id:price_id},
   dataType:"json",
   success:function(data)
   {

    $('#prod_appro').val(data.prod_appro);
    $('#prod_id').val(data.prod_id);
    $('#prod_prix').val(data.prod_prix);

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
    load_form_sup_appro();
    load_sup_appro_tab();
   },
    error: function() {
    alert('La requête n\'a pas aboutie'); }
  })

});
});


function load_appro_profil()
{

	var acc_id=$('#acc_id').data('id');
	//alert(acc_id);
	$.ajax({
		type:'GET',
		url:'tables/sup_appro_profile.php',
		data:{acc_id:acc_id},
		success:function(data)
		{

			$('#appro_profile').html(data);
		},
		error: function() {
		alert('La requête n\'a pas abouti'); }
	});
}

function load_form_sup_appro()
{

	var acc_id=$('#sup_id').data('id');
	//alert(acc_id);
	$.ajax({
		type:'GET',
		url:'forms/frm_sup_appro.php',

   beforeSend:function()
   {
    $('#appro_form').html('loading ....');
   }
		success:function(data)
		{
			$('#appro_form').html(data);
		},
		error: function() {
		alert('La requête n\'a pas abouti'); }
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
		},
		error: function() {
		alert('La requête n\'a pas abouti'); }
	});
}

function initialiser()
{
  alert("haha haha");
}
