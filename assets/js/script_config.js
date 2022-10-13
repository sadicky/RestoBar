$(function() {
//categorie des produits
//load_main_menu('');

//load_left_menu();


$(document).on('keyup', '#content_id_cli', function(){
  autocomplet_cli();
 });

$(document).on('keyup', '#content_id_prod', function(){
  autocomplet_prod();
 });

$(document).on('click', '.choose_cli', function(){
  pers_id=$(this).data('id');

  $.ajax({
   url:"backend/fetch_single_pers.php",
   method:"POST",
   data:{pers_id:pers_id},
   dataType:"json",
   success:function(data)
   {
    $('#cust_id').val(pers_id);
    $('#email_cli').val(data.email);
    $('#tel_cli').val(data.contact);    
    $('#email_cli').attr('readonly',true);
    $('#tel_cli').attr('readonly',true);
    //alert(data);
   },
    error: function() {
    alert('La requête n\'a pas aboutie'); }

  })

 });



$(document).on('click', '#left_menu', function(){
  load_left_menu();
 });



//debut Auto complete
/*$(document).on('click', '.choose_prod', function(){
  prod_id=$(this).data('id');

  $.ajax({
   url:"backend/fetch_single_op_prod.php",
   method:"POST",
   data:{prod_id:prod_id},
   dataType:"json",
   success:function(data)
   {
    $('#prod_prix').val(data.prod_prix);
    $('#prod_prix_v').val(data.prod_prix_v);
    $('#benef').val(data.benef);
    $('#prod_id').val(prod_id);
    $('#prod_qt').focus();
    //alert(data);
   },
    error: function() {
    alert('La requête n\'a pas aboutie'); }

  })

 });

*/
$(document).on('click', '.choose_prod_sort', function(){
  prod_id=$(this).data('id');
  lot=$(this).attr('id');
  $.ajax({
   url:"backend/fetch_single_op_prod.php",
   method:"POST",
   data:{prod_id:prod_id},
   dataType:"json",
   success:function(data)
   {
    //$('#prod_prix').val(data.prod_prix);
    //$('#percent').val(data.percent);
    $('#prod_id').val(prod_id);
    $('#lot').val(lot);
    $('#month').val(data.month);
    $('#year').val(data.year);
    $('#prod_qt').focus();
    //load_select_lot(prod_id);
    //alert(data);
   },
    error: function() {
    alert('La requête n\'a pas aboutie'); }

  })

 });

 $(document).on('keyup', '#content_id', function(){
  autocomplet();
 });

 $(document).on('keyup', '#content_id_sort', function(){
  autocomplet_sort();
 });

 $(document).on('keyup', '#content_id_appro', function(){
  autocomplet_appro();
 });

 $(document).on('keyup', '#content_id_ent', function(){
  autocomplet_ent();
 });

 //fin autocomplete

$(document).on('click', '#debiteur', function(){
  load_debiteur_tab();
 });

$(document).on('click', '#creancier', function(){
  load_creancier_tab();
 });

$(document).on('click', '#ass', function(){
  load_ass_tab('1');
 });

$(document).on('click', '#new_ass', function(){
  load_ass_form();
 });

$(document).on('click', '#trash_ass', function(){
  load_ass_tab('0');
});

$(document).on('submit', '#frm_consommateur', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_consommateur.php",
    method:'POST',
    beforeSend : function ()
      {
         $("#Enregistrer").val('saving...');
      },
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {

     //alert(data);
     $('#operation').val("Add");
     $("#Enregistrer").val('Enregistrer');
     load_last_cust_tab();
    }
   });

   $('#frm_consommateur')[0].reset();
});

$(document).on('submit', '#frm_serveur', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_serveur.php",
    method:'POST',
    beforeSend : function ()
      {
         $("#Enregistrer").val('saving...');
      },
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {

     alert(data);
     load_ass_tab('1');
     $('#operation').val("Add");
     $("#Enregistrer").val('Enregistrer');
    }
   });

   $('#frm_serveur')[0].reset();
});


$(document).on('click', '.update_cust', function(){
  //alert('modif')
  var personne_id = $(this).attr("id");
  load_cust_form();
  $.ajax({
   url:"backend/fetch_single_utilisateur.php",
   method:"POST",
   data:{personne_id:personne_id},
   dataType:"json",
   success:function(data)
   {
    //alert(data);
    $('#nom').val(data.nom);
    $('#person_id').val(personne_id);
    $('#email').val(data.email);
    $('#genre').val(data.genre);
    $('#contact').val(data.contact);

    $('#nat').val(data.nat);
    $('#cni').val(data.cni);


    $('#operation').val("Edit");


   }

  })
 });
$(document).on('click', '.delete_cust', function(){
  var personne_id = $(this).attr("id");
  var status = $(this).data("id");

  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/delete_personne.php",
    method:"POST",
    data:{person_id:personne_id, status:status},
    beforeSend: function()
    {
      $(this).html("suppression ...");
    },
    success:function(data)
    {
     alert(data);
     load_cust_tab('1');

    }
  })

  }
  else
  {
   return false;
  }
 });

$(document).on('keyup', '#prod_code', function(){
var code=$(this).val();
  $.ajax({
      url:'backend/check_code.php',
      method:"POST",
      data:{code:code},
      success:function(data)
      {
       if(data != '0')
       {
        $('#available_msg').html('<span class="text-danger">Le code existe</span>');
        $('#action').attr("disabled", true);
       }
       else
       {
        $('#available_msg').html('<span class="text-success">Le code est disponible</span>');
        $('#action').attr("disabled", false);
       }
      }
     })
 });

$(document).on('keyup', '#prod_name', function(){
var code=$(this).val();
  $.ajax({
      url:'backend/check_name.php',
      method:"POST",
      data:{code:code},
      success:function(data)
      {
       if(data != '0')
       {
        $('#available_msg_2').html('<span class="text-danger">Le nom existe</span>');
        $('#action').attr("disabled", true);
       }
       else
       {
        $('#available_msg_2').html('<span class="text-success">Le nom est disponible</span>');
        $('#action').attr("disabled", false);
       }
      }
     })
 });

$(document).on('keyup', '#pseudo', function(){
var pseudo=$(this).val();
  $.ajax({
      url:'backend/check_pseudo.php',
      method:"POST",
      data:{pseudo:pseudo},
      success:function(data)
      {
       if(pseudo=='')
       {
        $('#availability').html('<span class="text-danger">Veuillez remplir le pseudo</span>');
        $('#Enregistrer').attr("disabled", false);
       }
      else if(data != '0')
       {
        $('#availability').html('<span class="text-danger">Pseudo indisponible</span>');
        $('#Enregistrer').attr("disabled", true);
       }
       else
       {
        $('#availability').html('<span class="text-success">Pseudo disponible</span>');
        $('#Enregistrer').attr("disabled", false);
       }
      }
     })
 });

$(document).on('keyup', '#conf', function(){
var conf=$(this).val();
var mp=$('#mp').val();

       if(conf!=mp)
       {
        $('#availability_conf').html('<span class="text-danger">Mot de passe non Conforme</span>');
        $('#Enregistrer').attr("disabled", true);
       }
       else
       {
        $('#availability_conf').html('<span class="text-success">Mot de passe Conformes</span>');
        $('#Enregistrer').attr("disabled", false);
       }

 });

$(document).on('keyup', '#matri', function(){
var mat=$(this).val();
  $.ajax({
      url:'backend/check_matricule.php',
      method:"POST",
      data:{mat:mat},
      success:function(data)
      {
       if(data != '0')
       {
        $('#mat_available_msg').html('<span class="text-danger">Le matricule existe déjà</span>');
        $('#Enregistrer').attr("disabled", true);
       }
       else
       {
        $('#mat_available_msg').html('<span class="text-success">Matricule Disponible</span>');
        $('#Enregistrer').attr("disabled", false);
       }
      }
     })
 });

$(document).on('click', '.delete_per', function(){
  var id_per = $(this).attr("id");
  
  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/delete_per.php",
    method:"POST",
    data:{id_per:id_per},
    success:function(data)
    {
     alert(data);
     load_tab_periode('1');
     
    }
  })

  }
  else
  {
   return false;
  }
 });

$(document).on('click', '.elm_mod', function(){
  var elm=$(this).data("id");

  $.ajax({
   url:"forms/module_session.php",
   method:'POST',
   data:{elm:elm},
   success:function(data)
   {

   }
  })

 });


$(document).on('click', '#param_con', function(){
  //alert('modif')
  var personne_id = $(this).data("id");

  load_form_param_con();
  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
  $.ajax({
   url:"backend/fetch_single_utilisateur.php",
   method:"POST",
   data:{personne_id:personne_id},
   dataType:"json",
   success:function(data)
   {

    $('#operation').val("Con");
    $('#Enregistrer').val("Modifier");
    $('#pseudo').val(data.pseudo);
    $('#person_id').val(personne_id);
    /*$('#mp').prop('disabled', true);
    $('#conf').prop('disabled', true)*/

    //alert(data);

   }

  })

  }
  else
  {
    return false;
  }

 });

$(document).on('click', '.delete_ut', function(){
  var personne_id = $(this).attr("id");
  var status = $(this).data("id");

  if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
   $.ajax({
    url:"backend/delete_personne.php",
    method:"POST",
    data:{person_id:personne_id, status:status},
    beforeSend: function()
    {
      $(this).html("suppression ...");
    },
    success:function(data)
    {
     alert(data);
     load_user_tab('1');

    }
  })

  }
  else
  {
   return false;
  }
 });


//upload menu icon
$(document).on('change', '#upload_icon input', function(){
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
   form_data.append("id_ut", image_id);

   $.ajax({
    url:"backend/upload_menu_icon.php",
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

//upload
$(document).on('change', '#upload input', function(){
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
   form_data.append("id_ut", image_id);

   $.ajax({
    url:"backend/upload.php",
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

$(document).on('click', '.row_menu', function(){
var menu_id=$(this).data("id");
var perso_id=$('#attrib_person').val();
load_sous_menu(menu_id,perso_id);
load_user_attrib_menu(perso_id,menu_id);
});

$(document).on('click', '.row_add_sm', function(){
var sm_id=$(this).data("id");
var menu_id=$('#pr_menu_id').val();
var perso_id=$('#attrib_person').val();

$.ajax({
   url:"backend/insert_attrib_menu.php",
    method:"POST",
    data:{menu_id:sm_id,perso_id:perso_id},
   success:function(data)
   {
     load_sous_menu(menu_id,perso_id);
     load_user_attrib_menu(perso_id,menu_id);

   }
  })

});

$(document).on('click', '.row_del_sm', function(){

  var attrib_id = $(this).attr("id");
  var menu_id=$('#pr_menu_id').val();
  var perso_id=$('#attrib_person').val();

   $.ajax({
    url:"backend/delete_attrib.php",
    method:"POST",
    data:{attrib_id:attrib_id},
    success:function(data)
    {
     load_sous_menu(menu_id,perso_id);
     load_user_attrib_menu(perso_id,menu_id);
    }
  })
 });

});

function load_user_profile()
{
  $.ajax({
   url:"tables/tab_profil_user.php",
    method:"POST",
    beforeSend : function ()
      {
         $("#page-content").html('En chargement ........');
      },
   success:function(data)
   {
    $('#page-content').html(data);
   }
  })
}


function load_last_user_tab()
{
  //alert('je teste');
  $.ajax({
   url:"forms/tab_last_user_tab.php",
    method:"POST",
    beforeSend : function ()
      {
         $("#last_inserted").html('En chargement ..............');
      },
   success:function(data)
   {
    $('#last_inserted').html(data);
    $('#example23').DataTable({
                      "ordering":false,
                      "bInfo": false,
                      "bLengthChange": false,
                      dom: 'Bfrtip',
                      buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                     });
   }
  })
}

function load_last_sup_tab()
{
  //alert('je teste');
  $.ajax({
   url:"tables/tab_last_sup_tab.php",
    method:"POST",
    data:{status:status},
    beforeSend : function ()
      {
         $("#last_inserted").html('En chargement ..............');
      },
   success:function(data)
   {
    $('#last_inserted').html(data);
    $('#example23').DataTable({
                      "ordering":false,
                      "bInfo": false,
                      "bLengthChange": false,
                      dom: 'Bfrtip',
                      buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                     });
   }
  })
}


function load_form_param_con()
{
 $.ajax({
   url:"forms/frm_param_con.php",
   beforeSend : function ()
      {
         $("#page-content").html('<img src="assets/img/waiting2.gif"/>');
      },
   success:function(data)
   {
    $('#page-content').html(data);
    $('#operation').data("Add");
   }
  })
}


function load_main_menu_2()
{
  $.ajax({

    url:"include/sous-menu_2.php",
    method:"POST",
    beforeSend: function()
    {
      $('#main_menu_2').html('<p>Chargement .......</p>');
    },
    success:function(data)
    {
      $('#main_menu_2').html(data);
    }

  })
}

function load_left_menu()
{
  $.ajax({

    url:"include/menu.php",
    method:"POST",
    success:function(data)
    {
      //$('#page-content').html(data);
    }

  })
}

//auto complete
function autocomplet() {
  var keyword = $('#content_id').val();
  is_sale=$('#is_sale').val();
  $.ajax({
    url: 'tables/ajax_refresh_prod_list.php',
    type: 'POST',
    data: {keyword:keyword,is_sale:is_sale},
    success:function(data){
      $('#content_list_id').show();
      $('#content_list_id').html(data);

          }
  });
}

function autocomplet_sort() {
  var keyword = $('#content_id_sort').val();
  is_sale=$('#is_sale').val();
  $.ajax({
    url: 'tables/ajax_refresh_prod_list_sort.php',
    type: 'POST',
    data: {keyword:keyword,is_sale:is_sale},
    success:function(data){
      $('#content_list_id').show();
      $('#content_list_id').html(data);

          }
  });
}

function autocomplet_appro() {
  var keyword = $('#content_id_appro').val();
  is_sale=$('#is_sale').val();
  $.ajax({
    url: 'tables/ajax_refresh_prod_list_appro.php',
    type: 'POST',
    data: {keyword:keyword,is_sale:is_sale},
    success:function(data){
      $('#content_list_id').show();
      $('#content_list_id').html(data);

          }
  });
}

function autocomplet_ent() {
  var keyword = $('#content_id_ent').val();
  is_sale=$('#is_sale').val();
  $.ajax({
    url: 'tables/ajax_refresh_prod_list_ent.php',
    type: 'POST',
    data: {keyword:keyword,is_sale:is_sale},
    success:function(data){
      $('#content_list_id').show();
      $('#content_list_id').html(data);

          }
  });
}

function load_select_lot(prod_id) {

  $.ajax({
    url: 'tables/ajax_select_lot.php',
    type: 'POST',
    data: {prod_id:prod_id},
    success:function(data){
    if(data=='')
    {
      $('#lot').html('<option value="">Pas de lot</option>');
    }
    else
    {
    $('#lot').html(data);
    }
  }
  });
}

// set_item : this function will be executed when we select an item
function set_item(item) {
  // change input value
  $('#content_id').val(item);
  $('#content_id_appro').val(item);
  $('#content_id_ent').val(item);
  $('#content_id_sort').val(item);
  // hide proposition list
  $('#content_list_id').hide();
}
//periode


function autocomplet_cli() {
keyword = $('#content_id_cli').val();
  $.ajax({
    url: 'tables/refresh_cli.php',
    type: 'POST',
    data: {keyword:keyword},
    success:function(data){
      $('#content_list_id_cli').show();
      $('#content_list_id_cli').html(data);

          }
  });
}

function autocomplet_prod() {

keyword = $('#content_id_prod').val();

  $.ajax({
    url: 'tables/refresh_prod.php',
    type: 'POST',
    data: {keyword:keyword},
    success:function(data){
      $('#content_list_id_prod').show();
      $('#content_list_id_prod').html(data);
          }
  });
}

function set_item_prod(item) {
  // change input value
  $('#content_id_prod').val(item);
  $('#content_list_id_prod').hide();
}

function set_item_cli(item) {
  $('#content_id_cli').val(item);
  $('#content_list_id_cli').hide();
}
