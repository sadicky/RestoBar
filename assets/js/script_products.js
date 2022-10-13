$(function() {

load_animal_det();
load_prod_size_det();
load_products_det();

$('#operation').val("Add");

$('#action_size').val("Add_size");
$('#operation_size').val("Add_size");

//animal crud
$(document).on('submit', '#animal_form', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_animal.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {

     alert(data);

     $('#operation').val("Add");

     load_animal_det();
     load_products_det();
    }
   });

   $('#animal_form')[0].reset();
});

$(document).on('click', '.update', function(){
  //alert('modif')
  var animal_id = $(this).attr("id");

  $.ajax({
   url:"backend/fetch_single_animal.php",
   method:"POST",
   data:{animal_id:animal_id},
   dataType:"json",
   success:function(data)
   {

    $('#animal_name').val(data.animal_name);
    $('#animal_id').val(animal_id);
    $('#operation').val("Edit");

   }
  })
 });

$(document).on('click', '.delete', function(){
  var animal_id = $(this).attr("id");

  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/delete_animal.php",
    method:"POST",
    data:{animal_id:animal_id},
    success:function(data)
    {
     alert(data);
     load_animal_det();
     load_products_det();
    }
  })

  }
  else
  {
   return false;
  }
 });

//prod size crud
$(document).on('submit', '#prod_size_form', function(event){

  event.preventDefault();

    $.ajax({
    url:"backend/insert_prod_size.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {

     alert(data);

     $('#operation_size').val("Add_size");

     load_prod_size_det();
     load_products_det();
    }
   });

   $('#prod_size_form')[0].reset();
});

$(document).on('click', '.update_size', function(){
  //alert('modif')
  var size_id = $(this).attr("id");

  $.ajax({
   url:"backend/fetch_single_prod_size.php",
   method:"POST",
   data:{size_id:size_id},
   dataType:"json",
   success:function(data)
   {
    $('#prod_size_name').val(data.prod_size_name);
    $('#prod_size_id').val(size_id);
    $('#operation_size').val("Edit_size");
   }
  })
 });

$(document).on('click', '.delete_size', function(){
  var size_id = $(this).attr("id");

  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/delete_prod_size.php",
    method:"POST",
    data:{size_id:size_id},
    success:function(data)
    {
     alert(data);
     load_prod_size_det();
     load_products_det();
    }
  })

  }
  else
  {
   return false;
  }
 });

});


function load_animal_det()
{

	$.ajax({
		type:'GET',
		url:'forms/frm_animal.php',
		beforeSend : function ()
      {
         $("#animal_det").html('loading...');
      },
		success:function(data)
		{
			$('#animal_det').html(data);

		}
	});
}

function load_prod_size_det()
{

  $.ajax({
    type:'GET',
    url:'forms/frm_prod_size.php',
    beforeSend : function ()
      {
         $("#prod_size_det").html('loading...');
      },
    success:function(data)
    {
      $('#prod_size_det').html(data);
    }
  });
}

function load_products_det()
{

  $.ajax({
    type:'GET',
    url:'tables/tab_products.php',
    beforeSend : function ()
      {
         $("#product-det").html('loading...');
      },
    success:function(data)
    {
      $('#product-det').html(data);

    },
    error: function() {
    alert('La requête n\'a pas abouti'); }
  });
}


