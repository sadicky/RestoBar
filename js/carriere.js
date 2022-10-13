$(function()
{
load_main_menu();
load_tab_identif();

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

$(document).on('click', '.trash_op', function(event){

  table=$('#table_name').val();
  id=$('#id_name').val();
  val_id=$(this).attr('id');
  etat=$(this).data('id');
  tab=$('#tab_name').val();
if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
  {
    $.ajax({
    url:"backend/delete_op.php",
    method:'POST',
    data:{table:table,val_id:val_id,id:id,etat:etat},
    success:function(data)
    {
      alert(data);
     if(tab=="et_civ"){ load_tab_et_civ(etat)}
     if(tab=="accident"){ load_tab_accident(etat)}
     if(tab=="accident_trav"){ load_tab_accident_trav(etat)}
     if(tab=="compo"){ load_tab_comp_fam(etat)}
     if(tab=="forma"){ load_tab_forma(etat)}
     if(tab=="stage"){ load_stages(etat)}
     if(tab=="refe"){ load_tab_refe(etat)}
     if(tab=="commi"){ load_tab_commi(etat)}
     if(tab=="dist"){ load_tab_distinct(etat)}
     if(tab=="poste"){ load_tab_post_attache(etat)}
     if(tab=="conda"){ load_tab_condamna(etat)}
     if(tab=="sanc"){ load_tab_sanct(etat)}
     if(tab=="dota"){ load_tab_dota(etat)}
     if(tab=="dota_hab"){ load_tab_dota_hab(etat)}
     if(tab=="conge"){ load_tab_conge_oct(etat)}
     if(tab=="exempt"){ load_tab_exempt(etat)}
     if(tab=="nota"){ load_tab_nota(etat)}
     if(tab=="vacc"){ load_tab_vacc(etat)}
     if(tab=="divers"){ load_tab_divers(etat)}
     if(tab=="province"){ load_tab_province(etat)}
     if(tab=="commune"){ load_tab_commune(etat)}
     if(tab=="colline"){ load_tab_colline(etat)}

    }
   });

  }
  else
  {
    return false;
  }
});

//insert identification
$(document).on('submit', '#frm_search_mat', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/search_police.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
      load_main_menu();
      load_tab_identif();
    }
   });

   $('#frm_search_mat')[0].reset();
});


$(document).on('submit', '#frm_identif', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_identif.php",
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

   $('#frm_identif')[0].reset();
});

//insert formation
$(document).on('submit', '#frm_formation', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_formation.php",
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

   $('#frm_formation')[0].reset();
});

//insert etude
$(document).on('submit', '#frm_etude_civile', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_etude.php",
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

   $('#frm_etude_civile')[0].reset();
});

$(document).on('submit', '#frm_stage', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_stage.php",
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

   $('#frm_stage')[0].reset();
});

//insert etude
$(document).on('submit', '#frm_conjoint', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_conjoint.php",
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

   $('#frm_conjoint')[0].reset();
});


$(document).on('submit', '#frm_enfant', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_enfant.php",
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

   $('#frm_enfant')[0].reset();
});

$(document).on('submit', '#frm_reference', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_reference.php",
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

   $('#frm_reference')[0].reset();
});

$(document).on('submit', '#frm_commi', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_commission.php",
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

   $('#frm_commi')[0].reset();
});

$(document).on('submit', '#frm_distinction', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_distinction.php",
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

   $('#frm_distinction')[0].reset();
});

$(document).on('submit', '#frm_poste_attache', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_poste_attache.php",
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

   $('#frm_poste_attache')[0].reset();
});

$(document).on('submit', '#frm_condamnation', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_condamnation.php",
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

   $('#frm_condamnation')[0].reset();
});

$(document).on('submit', '#frm_accident', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_accident.php",
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

   $('#frm_accident')[0].reset();
});

$(document).on('submit', '#frm_accident_trav', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_accident_trav.php",
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

   $('#frm_accident_trav')[0].reset();
});

$(document).on('submit', '#frm_sanction', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_sanction.php",
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

   $('#frm_sanction')[0].reset();
});

$(document).on('submit', '#frm_dotation_arme', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_dotation.php",
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

   $('#frm_dotation_arm')[0].reset();
});

$(document).on('submit', '#frm_dotation_hab', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_dotation_hab.php",
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

   $('#frm_dotation_hab')[0].reset();
});

$(document).on('submit', '#frm_conge', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_conge.php",
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

   $('#frm_conge')[0].reset();
});

$(document).on('submit', '#frm_exempt', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_exempt.php",
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

   $('#frm_exempt')[0].reset();
});

$(document).on('submit', '#frm_notation', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_notation.php",
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

   $('#frm_notation')[0].reset();
});

$(document).on('submit', '#frm_vaccination', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_vaccination.php",
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

   $('#frm_vaccination')[0].reset();
});

$(document).on('submit', '#frm_divers', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_divers.php",
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

   $('#frm_divers')[0].reset();
});

$(document).on('click','#nv_conjoint',function(){
  id=$(this).data('id');
	load_form_conjoint(id);
});

$(document).on('click','#nv_enfant',function(){
  id=$(this).data('id');
	load_form_enfant(id);
});

$(document).on('change', '#list_prov', function(){
  var id_prov=$(this).val();
  load_commune_by_prov(id_prov);
 });

$(document).on('change', '#list_com', function(){
  var id_com=$(this).val();
  load_colline_by_com(id_com);
 });

$(document).on('click','#et_civ',function(){
  etat=$(this).data('id');
	load_tab_et_civ(etat);
	//alert('bon');
});

$(document).on('click','#nv_etude',function(){
  id=$(this).data('id');
	load_form_et_civ(id);
	//alert('bon');
});

$(document).on('click','#stages',function(){
   etat=$(this).data('id');
	load_stages(etat);
	//alert('bon');
});
$(document).on('click','#forma',function(){
   etat=$(this).data('id');
	load_tab_forma(etat);
	//alert('bon');
});
$(document).on('click','#nv_forma',function(){
  id=$(this).data('id');
	load_form_forma(id);
	//alert('bon');
});

$(document).on('click','#distinct',function(){
   etat=$(this).data('id');
	load_tab_distinct(etat);
	//alert('bon');
});

$(document).on('click','#identif',function(){
   etat=$(this).data('id');
	load_tab_identif(etat);
	//alert('bon');
});
$(document).on('click','#comp_fam',function(){
   etat=$(this).data('id');
	load_tab_comp_fam(etat);
	//alert('bon');
});
$(document).on('click','#nvpolice',function(){
  id=$(this).data('id');
	load_form_identif(id);
	//alert('bon');
});

$(document).on('click','#condamna',function(){
   etat=$(this).data('id');
	load_tab_condamna(etat);
	//alert('bon');
});

$(document).on('click','#dota_arm',function(){
  etat=$(this).data('id');
	load_tab_dota(etat);
	//alert('bon');
});
$(document).on('click','#dota_hab',function(){
   etat=$(this).data('id');
  load_tab_dota_hab(etat);
  //alert('bon');
});

$(document).on('click','#refe',function(){
   etat=$(this).data('id');
	load_tab_refe(etat);
});



$(document).on('click','#commi',function(){
  etat=$(this).data('id');
	load_tab_commi(etat);
});


$(document).on('click','#sanct',function(){
  etat=$(this).data('id');
	load_tab_sanct(etat);
});

$(document).on('click','#exempt',function(){
   etat=$(this).data('id');
	load_tab_exempt(etat);
});

$(document).on('click','#nota',function(){
   etat=$(this).data('id');
	load_tab_nota(etat);
});

$(document).on('click','#vacc',function(){
   etat=$(this).data('id');
	load_tab_vacc(etat);
});

$(document).on('click','#divers',function(){
  etat=$(this).data('id');
	load_tab_divers(etat);
});

$(document).on('click','#post_attache',function(){
   etat=$(this).data('id');
	load_tab_post_attache(etat);
});

$(document).on('click','.accident',function(){
   etat=$(this).data('id');
	load_tab_accident(etat);
});

$(document).on('click','.accident_trav',function(){
   etat=$(this).data('id');
	load_tab_accident_trav(etat);
});

$(document).on('click','#conge_oct',function(){
   etat=$(this).data('id');
  load_tab_conge_oct(etat);
});

$(document).on('click','#exempt',function(){
   etat=$(this).data('id');
  load_tab_exempt(etat);
});

$(document).on('click','#nv_stage',function(){
id=$(this).data('id');
load_form_stages(id);
});

$(document).on('click','#nv_reference',function(){
  id=$(this).data('id');
	load_form_refe(id);
});

$(document).on('click','#nv_commi',function(){
  id=$(this).data('id');
	load_form_commi(id);
});

$(document).on('click','#nv_distinct',function(){
  id=$(this).data('id');
	load_form_distinct(id);
});

$(document).on('click','#nv_post_attache',function(){
  id=$(this).data('id');
	load_form_post_attache(id);
});

$(document).on('click','#nv_condamna',function(){
  id=$(this).data('id');
	load_form_condamna(id);
});

$(document).on('click','#nv_accident',function(){
  id=$(this).data('id');
	load_form_accident(id);
});

$(document).on('click','#nv_accident_trav',function(){
  id=$(this).data('id');
	load_form_accident_trav(id);
});

$(document).on('click','#nv_sanction',function(){
  id=$(this).data('id');
	load_form_sanct(id);
});

$(document).on('click','#nv_dotation_arme',function(){
  id=$(this).data('id');
  load_form_dota(id);
});

$(document).on('click','#nv_dotation_hab',function(){
  id=$(this).data('id');
  load_form_dota_hab(id);
});

$(document).on('click','#nv_conge_oct',function(){
  id=$(this).data('id');
  load_form_conge_oct(id);
});

$(document).on('click','#nv_exempt',function(){
  id=$(this).data('id');
  load_form_exempt(id);
});

$(document).on('click','#nv_nota',function(){
  id=$(this).data('id');
  load_form_nota(id);
});

$(document).on('click','#nv_vacc',function(){
  id=$(this).data('id');
  load_form_vacc(id);
});

$(document).on('click','#nv_div',function(){
  id=$(this).data('id');
  load_form_divers(id);
});

});

//mes fonctions a charger

function load_commune_by_prov(id_prov)
{
	$.ajax({

		url:"backend/list_com_prov.php",
		method:"POST",
		data:{id_prov:id_prov},
		beforeSend: function()
		{
			$('#list_com').html('<option value="">page en chargement .......</option>');
		},
		success:function(data)
		{
			$('#list_com').html(data);
		}

	})
}
function load_colline_by_com(id_com)
{
	$.ajax({

		url:"backend/list_col_com.php",
		method:"POST",
		data:{id_com:id_com},
		beforeSend: function()
		{
			$('#list_col').html('<option value="">page en chargement .......</option>');
		},
		success:function(data)
		{
			$('#list_col').html(data);
		}

	})
}

function load_tab_distinct(etat)
{
	$.ajax({
		url:"tables/tab_distinction.php",
		method:"GET",
    data:{etat:etat},
		beforeSend: function()
		{
			$('#page_content').html('<p>page en chargement .......</p>');
		},
		success:function(data)
		{
			$('#page_content').html(data);
		}

	})
}

function load_form_distinct(id)
{
	$.ajax({

		url:"forms/frm_distinction.php",
		method:"GET",
    data:{id:id},
		beforeSend: function()
		{
			$('#page_content').html('<p>page en chargement .......</p>');
		},
		success:function(data)
		{
			$('#page_content').html(data);
		}

	})
}

function load_tab_forma(etat)
{
	$.ajax({

		url:"tables/tab_formation.php",
		method:"GET",
    data:{etat:etat},
		beforeSend: function()
		{
			$('#page_content').html('<p>page en chargement .......</p>');
		},
		success:function(data)
		{
			$('#page_content').html(data);
		}

	})
}

function load_form_forma(id)
{
	$.ajax({

		url:"forms/frm_formation.php",
		method:"GET",
    data:{id:id},
		beforeSend: function()
		{
			$('#page_content').html('<p>page en chargement .......</p>');
		},
		success:function(data)
		{
			$('#page_content').html(data);
		}

	})
}

function load_tab_divers(etat)
{
	$.ajax({

		url:"tables/tab_divers.php",
		method:"GET",
    data:{etat:etat},
		beforeSend: function()
		{
			$('#page_content').html('<p>page en chargement .......</p>');
		},
		success:function(data)
		{
			$('#page_content').html(data);
		}

	})
}

function load_form_divers(id)
{
	$.ajax({

		url:"forms/frm_divers.php",
		method:"GET",
    data:{id:id},
		beforeSend: function()
		{
			$('#page_content').html('<p>page en chargement .......</p>');
		},
		success:function(data)
		{
			$('#page_content').html(data);
		}

	})
}

function load_tab_nota(etat)
{
	$.ajax({

		url:"tables/tab_notation.php",
		method:"GET",
    data:{etat:etat},
		beforeSend: function()
		{
			$('#page_content').html('<p>page en chargement .......</p>');
		},
		success:function(data)
		{
			$('#page_content').html(data);
		}

	})
}
function load_form_nota(id)
{
	$.ajax({

		url:"forms/frm_notation.php",
		method:"GET",
    data:{id:id},
		beforeSend: function()
		{
			$('#page_content').html('<p>page en chargement .......</p>');
		},
		success:function(data)
		{
			$('#page_content').html(data);
		}

	})
}

function load_tab_dota(etat)
{
	$.ajax({

		url:"tables/tab_dotation.php",
		method:"GET",
    data:{etat:etat},
		beforeSend: function()
		{
			$('#page_content').html('<p>page en chargement .......</p>');
		},
		success:function(data)
		{
			$('#page_content').html(data);
		}

	})
}

function load_tab_dota_hab(etat)
{
  $.ajax({

    url:"tables/tab_dotation_hab.php",
   method:"GET",
    data:{etat:etat},
    beforeSend: function()
    {
      $('#page_content').html('<p>page en chargement .......</p>');
    },
    success:function(data)
    {
      $('#page_content').html(data);
    }

  })
}

function load_form_dota(id)
{
	$.ajax({

		url:"forms/frm_dotation_arme.php",
		method:"GET",
    data:{id:id},
		beforeSend: function()
		{
			$('#page_content').html('<p>page en chargement .......</p>');
		},
		success:function(data)
		{
			$('#page_content').html(data);
		}

	})
}

function load_form_dota_hab(id)
{
  $.ajax({

    url:"forms/frm_dotation_hab.php",
    method:"GET",
    data:{id:id},
    beforeSend: function()
    {
      $('#page_content').html('<p>page en chargement .......</p>');
    },
    success:function(data)
    {
      $('#page_content').html(data);
    }

  })
}

function load_tab_vacc(etat)
{
	$.ajax({

		url:"tables/tab_vaccination.php",
		method:"GET",
    data:{etat:etat},
		beforeSend: function()
		{
			$('#page_content').html('<p>page en chargement .......</p>');
		},
		success:function(data)
		{
			$('#page_content').html(data);
		}

	})
}
function load_form_vacc(id)
{
	$.ajax({

		url:"forms/frm_vaccination.php",
		method:"GET",
    data:{id:id},
		beforeSend: function()
		{
			$('#page_content').html('<p>page en chargement .......</p>');
		},
		success:function(data)
		{
			$('#page_content').html(data);
		}

	})
}

function load_form_conjoint(id)
{
	$.ajax({

		url:"forms/frm_conjoint.php",
		method:"GET",
    data:{id:id},
		beforeSend: function()
		{
			$('#page_content').html('<p>page en chargement .......</p>');
		},
		success:function(data)
		{
			$('#page_content').html(data);
		}

	})
}

function load_tab_accident(etat)
{
	$.ajax({

		url:"tables/tab_accident.php",
		method:"GET",
    data:{etat:etat},
		beforeSend: function()
		{
			$('#page_content').html('<p>page en chargement .......</p>');
		},
		success:function(data)
		{
			$('#page_content').html(data);
		}

	})
}

function load_tab_accident_trav(etat)
{
	$.ajax({

		url:"tables/tab_accident_trav.php",
		method:"GET",
    data:{etat:etat},
		beforeSend: function()
		{
			$('#page_content').html('<p>page en chargement .......</p>');
		},
		success:function(data)
		{
			$('#page_content').html(data);
		}

	})
}

function load_form_accident(id)
{
	$.ajax({

		url:"forms/frm_accident.php",
		method:"GET",
    data:{id:id},
		beforeSend: function()
		{
			$('#page_content').html('<p>page en chargement .......</p>');
		},
		success:function(data)
		{
			$('#page_content').html(data);
		}

	})
}

function load_form_accident_trav(id)
{
	$.ajax({

		url:"forms/frm_accident_trav.php",
		method:"GET",
    data:{id:id},
		beforeSend: function()
		{
			$('#page_content').html('<p>page en chargement .......</p>');
		},
		success:function(data)
		{
			$('#page_content').html(data);
		}

	})
}

function load_tab_sanct(etat)
{
	$.ajax({

		url:"tables/tab_sanction.php",
		method:"GET",
    data:{etat:etat},
		beforeSend: function()
		{
			$('#page_content').html('<p>page en chargement .......</p>');
		},
		success:function(data)
		{
			$('#page_content').html(data);
		}

	})
}
function load_form_sanct(id)
{
	$.ajax({

		url:"forms/frm_sanction.php",
		method:"GET",
    data:{id:id},
		beforeSend: function()
		{
			$('#page_content').html('<p>page en chargement .......</p>');
		},
		success:function(data)
		{
			$('#page_content').html(data);
		}

	})
}

function load_tab_commi(etat)
{
	$.ajax({

		url:"tables/tab_commission.php",
		method:"GET",
    data:{etat:etat},
		beforeSend: function()
		{
			$('#page_content').html('<p>page en chargement .......</p>');
		},
		success:function(data)
		{
			$('#page_content').html(data);
		}

	})
}
function load_form_commi(id)
{
	$.ajax({

		url:"forms/frm_commission.php",
		method:"GET",
    data:{id:id},
		beforeSend: function()
		{
			$('#page_content').html('<p>page en chargement .......</p>');
		},
		success:function(data)
		{
			$('#page_content').html(data);
		}

	})
}

function load_tab_post_attache(etat)
{
	$.ajax({

		url:"tables/tab_poste_attache.php",
		method:"GET",
    data:{etat:etat},
		beforeSend: function()
		{
			$('#page_content').html('<p>page en chargement .......</p>');
		},
		success:function(data)
		{
			$('#page_content').html(data);
		}

	})
}
function load_form_post_attache(id)
{
	$.ajax({

		url:"forms/frm_poste_attache.php",
		method:"GET",
    data:{id:id},
		beforeSend: function()
		{
			$('#page_content').html('<p>page en chargement .......</p>');
		},
		success:function(data)
		{
			$('#page_content').html(data);
		}

	})
}


function load_tab_refe(etat)
{
	$.ajax({

		url:"tables/tab_reference.php",
		method:"GET",
    data:{etat:etat},
		beforeSend: function()
		{
			$('#page_content').html('<p>page en chargement .......</p>');
		},
		success:function(data)
		{
			$('#page_content').html(data);
		}

	})
}

function load_form_refe(id)
{
	$.ajax({

		url:"forms/frm_reference.php",
		method:"GET",
    data:{id:id},
		beforeSend: function()
		{
			$('#page_content').html('<p>page en chargement .......</p>');
		},
		success:function(data)
		{
			$('#page_content').html(data);
		}

	})
}

function load_tab_conge_oct(etat)
{
	$.ajax({

		url:"tables/tab_conge.php",
		method:"GET",
    data:{etat:etat},
		beforeSend: function()
		{
			$('#page_content').html('<p>page en chargement .......</p>');
		},
		success:function(data)
		{
			$('#page_content').html(data);
		}

	})
}

function load_tab_exempt(etat)
{
  $.ajax({
    url:"tables/tab_exempt.php",
    method:"GET",
    data:{etat:etat},
    beforeSend: function()
    {
      $('#page_content').html('<p>page en chargement .......</p>');
    },
    success:function(data)
    {
      $('#page_content').html(data);
    }

  })
}
function load_form_conge_oct(id)
{
	$.ajax({

		url:"forms/frm_conge.php",
		method:"GET",
    data:{id:id},
		beforeSend: function()
		{
			$('#page_content').html('<p>page en chargement .......</p>');
		},
		success:function(data)
		{
			$('#page_content').html(data);
		}

	})
}

function load_form_exempt(id)
{
  $.ajax({

    url:"forms/frm_exempt.php",
    method:"GET",
    data:{id:id},
    beforeSend: function()
    {
      $('#page_content').html('<p>page en chargement .......</p>');
    },
    success:function(data)
    {
      $('#page_content').html(data);
    }

  })
}

function load_form_enfant(id)
{
	$.ajax({

		url:"forms/frm_enfant.php",
		method:"GET",
    data:{id:id},
		beforeSend: function()
		{
			$('#page_content').html('<p>page en chargement .......</p>');
		},
		success:function(data)
		{
			$('#page_content').html(data);
		}

	})
}
function load_tab_identif()
{
	$.ajax({

		url:"tables/tab_profile.php",
		method:"POST",
		beforeSend: function()
		{
			$('#page_content').html('<p>page en chargement .......</p>');
		},
		success:function(data)
		{
			$('#page_content').html(data);
		}

	})
}

function load_main_menu()
{
	$.ajax({

		url:"include/menu.php",
		method:"POST",
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
function load_form_identif(id)
{
	$.ajax({

		url:"forms/frm_identif.php",
		method:"GET",
    data:{id:id},
		beforeSend: function()
		{
			$('#page_content').html('<p>page en chargement .......</p>');
		},
		success:function(data)
		{
			$('#page_content').html(data);
		}

	})
}
function load_tab_comp_fam(etat)
{
	$.ajax({

		url:"tables/tab_composition_fam.php",
		method:"GET",
    data:{etat:etat},
		beforeSend: function()
		{
			$('#page_content').html('<p>page en chargement .......</p>');
		},
		success:function(data)
		{
			$('#page_content').html(data);
		}

	})
}
function load_form_comp_fam(id)
{
	$.ajax({

		url:"forms/frm_composition.php",
		method:"GET",
    data:{id:id},
		beforeSend: function()
		{
			$('#page_content').html('<p>page en chargement .......</p>');
		},
		success:function(data)
		{
			$('#page_content').html(data);
		}

	})
}



function load_tab_condamna(etat)
{
	$.ajax({

		url:"tables/tab_condamnation.php",
		method:"GET",
    data:{etat:etat},
		beforeSend: function()
		{
			$('#page_content').html('<p>page en chargement .......</p>');
		},
		success:function(data)
		{
			$('#page_content').html(data);
		}

	})
}

function load_form_condamna(id)
{
	$.ajax({

		url:"forms/frm_condamnation.php",
		method:"GET",
    data:{id:id},
		beforeSend: function()
		{
			$('#page_content').html('<p>page en chargement .......</p>');
		},
		success:function(data)
		{
			$('#page_content').html(data);
		}

	})
}




function load_form_et_civ(id)
{
	$.ajax({

		url:"forms/frm_etude_civile.php",
		method:"GET",
    data:{id:id},
		beforeSend: function()
		{
			$('#page_content').html('<p>page en chargement .......</p>');
		},
		success:function(data)
		{
			$('#page_content').html(data);
		}

	})
}

function load_tab_et_civ(etat)
{
	$.ajax({

		url:"tables/tab_etude_civile.php",
		method:"GET",
    data:{etat:etat},
		beforeSend: function()
		{
			$('#page_content').html('<p>page en chargement .......</p>');
		},
		success:function(data)
		{
			$('#page_content').html(data);
		}

	})
}
function load_form_stages(id)
{
	$.ajax({

		url:"forms/frm_stage.php",
		method:"GET",
    data:{id:id},
		beforeSend: function()
		{
			$('#page_content').html('<p>page en chargement .......</p>');
		},
		success:function(data)
		{
			$('#page_content').html(data);
		}

	})
}

function load_stages(etat)
{
	$.ajax({

		url:"tables/tab_stage.php",
		method:"GET",
    data:{etat:etat},
		beforeSend: function()
		{
			$('#page_content').html('<p>page en chargement .......</p>');
		},
		success:function(data)
		{
			$('#page_content').html(data);
		}

	})
}
