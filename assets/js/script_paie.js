$(function() {
load_acc_profil();
load_form_trans();
load_trans_tab();

$('#action').val("Add");
$('#operation').val("Add");
$('#reset_act').click(initialiser);

$(document).on('submit', '#user_form', function(event){
	//alert("ca va enregistrer");
  event.preventDefault();

  var extension = $('#user_image').val().split('.').pop().toLowerCase();
  if(extension != '')
  {
   if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
   {
    alert("Invalid Image File");
    $('#user_image').val('');
    return false;
   }
  }

    $.ajax({
    url:"backend/insert_paie.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
      alert(data);
      $('#user_form')[0].reset();

     $('#lab_action').html("Enregistrer");
     $('#action').val("Add");
     $('#operation').val("Add");
      load_acc_profil();
      load_trans_tab();
    }
   });

})

$(document).on('click', '.update', function(){
  //alert('modif')
  var trans_id = $(this).attr("id");
  //alert(trans_id);
  $.ajax({
   url:"backend/fetch_single_trans.php",
   method:"POST",
   data:{trans_id:trans_id},
   dataType:"json",
   success:function(data)
   {

    $('#trans_typ').val(data.trans_typ);
    $('#date_trans').val(data.date_trans);
    $('#mont_trans').val(data.mont_trans);
    $('#hidden_mont').val(data.mont_trans);
    //$('.modal-title').text("Modification de la transaction");
    $('#trans_id').val(trans_id);
    $('#hidden_ref').val(data.reference);
    $('#action').val("Edit");
    $('#operation').val("Edit");
    $('#lab_action').html("Modifier");

    //alert(data);

   },
		error: function() {
		alert('La requête n\'a pas abouti'); }
  })
 });

$(document).on('click', '.delete', function(){
  var trans_id = $(this).attr("id");

  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/delete_trans.php",
    method:"POST",
    data:{trans_id:trans_id},
    success:function(data)
    {
     alert(data);

     load_trans_tab();
     load_acc_profil();

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

$(document).on('click', '.row_op', function(){

var op_id=$(this).data("id");

$.ajax({
   url:"backend/fetch_op_paie.php",
   method:"POST",
   data:{op_id:op_id},
   //dataType:"json",
   success:function(data)
   {
    load_form_trans();
    load_trans_tab();
   },
    error: function() {
    alert('La requête n\'a pas aboutie'); }
  })

});



});

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

function load_form_trans()
{

	var acc_id=$('#acc_id').data('id');
	//alert(acc_id);
	$.ajax({
		type:'GET',
		url:'forms/frm_paiement.php',
		success:function(data)
		{
			$('#trans_form').html(data);
		},
		error: function() {
		alert('La requête n\'a pas abouti'); }
	});
}

function load_trans_tab()
{

	var acc_id=$('#acc_id').data('id');
	//alert(acc_id);
	$.ajax({
		type:'GET',
		url:'tables/tab_paiement.php',
		data:{acc_id:acc_id},
		beforeSend : function ()
      {
         $("#acc_trans_tab").html('loading...');
      },
		success:function(data)
		{
			$('#acc_trans_tab').html(data);
		},
		error: function() {
		alert('La requête n\'a pas abouti'); }
	});
}

function initialiser()
{
  alert("haha haha");
}

