$(function() {
load_main_menu();

$(document).on('keyup', '#mp', function(){
var mp=$(this).val();
  $.ajax({
      url:'backend/check_mp.php',
      method:"POST",
      data:{mp:mp},
      success:function(data)
      {
       // alert(data);
       if(mp=='')
       {
        $('#availability_pswd').html('<span class="text-danger">Veuillez remplir le code secret</span>');
        $('#Enregistrer').attr("disabled", false);
       }
      else if(data != '0')
       {
        $('#availability_pswd').html('<span class="text-danger">Code Secret indisponible</span>');
        $('#Enregistrer').attr("disabled", true);
       }
       else
       {
        $('#availability_pswd').html('<span class="text-success">Code Secret disponible</span>');
        $('#Enregistrer').attr("disabled", false);
       }
      }
     })
 });

$(document).on('change', '#upload_joint input', function(){
  var image_id = $(this).attr("class");
  var name = document.getElementById("file" + image_id).files[0].name;
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1)
  {
   alert("Image invalid");
  }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("file" + image_id).files[0]);
  var f = document.getElementById("file" + image_id).files[0];
  var fsize = f.size||f.fileSize;
  if(fsize > 10000000)
  {
   alert("Image est trop grande");
  }
  else
  {
   form_data.append("file", document.getElementById('file' + image_id).files[0]);
   form_data.append("joint_id", image_id);

   $.ajax({
    url:"backend/upload_joint.php",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend:function(){
     $('#p' + image_id).html("<label class='text-success'>Image Uploading...</label>");
    },
    success:function(data)
    {
     $('#p' + image_id).html(data);
     //alert(data);
    }
   });
  }
 });

$(document).on('click', '.delete_menu', function(){
  var menu_id = $(this).attr("id");
  

  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/delete_menu.php",
    method:"POST",
    data:{menu_id:menu_id},
    beforeSend: function()
    {
      $(this).html("suppression ...");
    },
    success:function(data)
    {
     alert(data);
     load_tab_menu();
    }
  })

  }
  else
  {
   return false;
  }
 });

$(document).on('click', '.active_pers', function(){
  user_id = $(this).attr('id');
  etat = $(this).data('id');
  $.ajax({
   url:"backend/active_pers.php",
   method:"POST",
   data:{user_id:user_id,etat:etat},
   success:function(data)
   {
   	alert(data + user_id);
   	load_user_tab();
   }
  })
 });

$(document).on('click', '.trash_conf', function(event){

table=$('#tab_details').val();
id=$('#tab_details').data('id');
val_id=$(this).attr('id');

if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
	{
$.ajax({
url:"backend/delete_op.php",
method:'POST',
data:{table:table,val_id:val_id,id:id},
success:function(data)
{
alert(data + table);
if(table=="personne"){ load_user_tab()}
}
});
}
else
{
return false;
}
});

$(document).on('click', '.show_menu', function(){
  load_main_menu();
  $('#page-content').html('');
 });

$(document).on('click', '#users', function(){
  load_user_tab();
 });

$(document).on('click', '#tab_menu', function(){
  load_tab_menu("");
 });

$(document).on('click', '#new_user', function(){
  load_user_form('');
 });

$(document).on('click', '#frm_menu', function(){
  load_frm_menu('');
 });

$(document).on('click', '.attrib_menu', function(){
  var perso_id=$(this).attr('id');
  load_frm_attrib(perso_id);
 });

$(document).on('blur', '.edit_order', function(){
menu_id=$(this).data('id');
val=$(this).html();
val=val.replace('<br>','');
val=val.trim();
  $.ajax({
      url:'backend/edit_menu_order.php',
      method:"POST",
      data:{menu_id:menu_id,val:val},
      success:function(data)
      {

      }
     })
 });

$(document).on('submit', '#frm_utilisateur', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_utilisateur.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    beforeSend:function()
    {
      $('#message').html('Enregistrement encours .....');
    },
    success:function(data)
    {
     alert(data);
     load_user_tab();
    }
   });

   $('#frm_utilisateur')[0].reset();
});

$(document).on('submit', '#frm_param_con', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/update_pswd.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    beforeSend:function()
    {
      $('#message').html('Enregistrement encours .....');
    },
    success:function(data)
    {
     alert(data);
     location.reload(true);
    }
   });
});

$(document).on('submit', '#frm_send_menu', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_menu.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
     alert(data);
     load_tab_menu();
    }
   });

   $('#frm_send_menu')[0].reset();
});

$(document).on('click', '.update_ut', function(){
  personne_id = $(this).attr("id");
  load_user_form(personne_id);
 });

$(document).on('click', '.update_menu', function(){
  menu_id = $(this).attr("id");
  load_frm_menu(menu_id);
 });

/*Fin */
})

function load_main_menu()
{
  $.ajax({
    url:"include/header-menu.php",
    method:"POST",
    //data:{parent_id:parent_id},
    beforeSend: function()
    {
      $('#main_menu').html('<p>Chargement .......</p>');
    },
    success:function(data)
    {
      $('#main_menu').html(data);
    }
  })
}

function load_tab_menu(mod)
{
  $.ajax({
   url:"tables/tab_menu.php",
   method:"GET",
   data:{mod:mod},
   beforeSend : function ()
      {
         $("#page-content").html('<p>Chargement .......</p>');
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
  })
}

function load_frm_menu(id)
{
  $.ajax({
   url:"forms/frm_menu.php",
   method:"GET",
   data:{id:id},
   beforeSend : function ()
      {
         $("#page-content").html('<p>Chargement .......</p>');
      },
   success:function(data)
   {
    $('#page-content').html(data);
   }
  })
}

function load_frm_attrib(perso_id)
{
  $.ajax({
   url:"forms/frm_attrib_menu.php",
   method:"POST",
   data:{perso_id:perso_id,},
   beforeSend : function ()
      {
         $("#page-content").html('En Chargement .......');

      },
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
  })
}

function load_sous_menu(menu_id,perso_id)
{
  $.ajax({
   url:"tables/tab_sous_menu_attrib.php",
    method:"POST",
    data:{menu_id:menu_id,perso_id:perso_id},
    beforeSend : function ()
      {
      $("#list_sub_menu_attrib").html('En Chargement .........');
      },
      success:function(data)
      {
      $('#list_sub_menu_attrib').html(data);
      }
  })
}

function load_user_attrib_menu(perso_id,menu_id)
{
  $.ajax({
   url:"tables/tab_user_attrib_menu.php",
    method:"POST",
    data:{perso_id:perso_id,menu_id:menu_id},
    beforeSend : function ()
      {
    $("#tab_user_attrib_menu").html('<p>En chargement .....</p>');
      },
   success:function(data)
   {

    $('#tab_user_attrib_menu').html(data);
   }
  })
}

function load_user_tab()
{
  $.ajax({
   url:"tables/tab_utilisateur.php",
    method:"POST",
    beforeSend : function ()
      {
         $("#page-content").html('<p>En chargement .....</p>');
      },
   success:function(data)
   {
    $('#page-content').html(data);
    $('#tab').DataTable({
                      "bInfo": false,
                      "bLengthChange": false,
                      dom: 'Bfrtip',
                      buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                     });
   }
  })
}

function load_user_form(id)
{
 $.ajax({
   url:"forms/frm_utilisateur.php",
   method:"GET",
   data:{id:id},
   beforeSend : function ()
      {
         $("#page-content").html('<p>En chargement .....</p>');
      },
   success:function(data)
   {
    $('#page-content').html(data);
    $('#operation').data("Add");
   }
  })
}