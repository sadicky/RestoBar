$(function() {
	
load_sup_profil();
load_form_sup_price();
load_sup_price_tab();

$('#action').val("Add");
$('#operation').val("Add");
//$('#reset_act').click(initialiser);

$(document).on('submit', '#sup_price_form', function(event){
	//alert("ca va enregistrer");
  event.preventDefault();
  
 
    $.ajax({
    url:"backend/insert_sup_price.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
     
     alert(data);
     
     $('#action').val("Add");
     $('#operation').val("Add");
     $('#lab_action').html("Enregistrer");
     load_sup_price_tab();
     load_sup_profil(); 
    }
   });
    
   $('#sup_price_form')[0].reset();
})
  
$(document).on('click', '.update', function(){
  //alert('modif')	
  var price_id = $(this).attr("id");
  //alert(trans_id);
  $.ajax({
   url:"backend/fetch_single_price.php",
   method:"POST",
   data:{price_id:price_id},
   dataType:"json",
   success:function(data)
   {
   
    $('#lib_prod').val(data.lib_prod);
    $('#date_debut').val(data.date_debut);
    $('#prix_prod').val(data.prix_prod);
    $('#price_id').val(price_id);
    
    $('#comment_price').val(data.comment_price);
    $('#action').val("Edit");
    $('#operation').val("Edit");
    $('#lab_action').html("Modifier");

    //alert(data); 
    
   },
		error: function() {
		alert('La requête n\'a pas aboutie'); }
  })
 });

$(document).on('click', '.delete', function(){
  var price_id = $(this).attr("id");

  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/delete_price.php",
    method:"POST",
    data:{price_id:price_id},
    success:function(data)
    {
     alert(data);
     load_sup_price_tab();
     
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

function load_sup_profil()
{
	
	var acc_id=$('#acc_id').data('id');
	//alert(acc_id);
	$.ajax({
		type:'GET',
		url:'tables/sup_price_profile.php',
		data:{acc_id:acc_id},
		success:function(data)
		{

			$('#sup_profile').html(data);
		},
		error: function() {
		alert('La requête n\'a pas abouti'); }
	});
}

function load_form_sup_price()
{
	
	var acc_id=$('#sup_id').data('id');
	//alert(acc_id);
	$.ajax({
		type:'GET',
		url:'forms/frm_sup_price.php',
		success:function(data)
		{
			$('#sup_price_form').html(data);
		},
		error: function() {
		alert('La requête n\'a pas abouti'); }
	});
}

function load_sup_price_tab()
{
	
	var acc_id=$('#sup_id').data('id');
	//alert(acc_id);
	$.ajax({
		type:'GET',
		url:'tables/tab_sup_price.php',
		data:{acc_id:acc_id},
		beforeSend : function ()
      {
         $("#sup_price_tab").html('loading...');
      },
		success:function(data)
		{
			$('#sup_price_tab').html(data);
		},
		error: function() {
		alert('La requête n\'a pas abouti'); }
	});
}

function initialiser()
{
  alert("haha haha");
}

