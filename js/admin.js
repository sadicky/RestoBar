$(function()
{

$(document).on('click','#colline',function(){
   etat=$(this).data('id');
  load_tab_colline(etat);
});

$(document).on('click','#nv_colline',function(){
id=$(this).data('id');
load_form_colline(id,'');
});

$(document).on('click','.nv_colline',function(){
com=$(this).data('id');
load_form_colline('',com);
});

$(document).on('click','#commune',function(){
   etat=$(this).data('id');
  load_tab_commune(etat);
});

$(document).on('click','#nv_commune',function(){
id=$(this).data('id');
load_form_commune(id,'');
});

$(document).on('click','.nv_commune',function(){
prov=$(this).data('id');
load_form_commune('',prov);
});

$(document).on('click','#province',function(){
   etat=$(this).data('id');
  load_tab_province(etat);
});

$(document).on('click','#nv_province',function(){
id=$(this).data('id');
load_form_province(id);
});

$(document).on('click','#compo_salaire',function(){
   etat=$(this).data('id');
  load_tab_compo_salaire(etat);
});


$(document).on('click','#nv_compo_salaire',function(){
id=$(this).data('id');
load_form_compo_salaire(id);
});

$(document).on('click','#compo_cotisation',function(){
   etat=$(this).data('id');
  load_tab_compo_cotisation(etat);
});


$(document).on('click','#nv_compo_cotisation',function(){
id=$(this).data('id');
load_form_compo_cotisation(id);
});

$(document).on('click','#compo_indemnite',function(){
   etat=$(this).data('id');
  load_tab_compo_indemnite(etat);
});


$(document).on('click','#nv_compo_indemnite',function(){
id=$(this).data('id');
load_form_compo_indemnite(id);
});

$(document).on('click','#compo_impot',function(){
   etat=$(this).data('id');
  load_tab_compo_impot(etat);
});


$(document).on('click','#nv_compo_impot',function(){
id=$(this).data('id');
load_form_compo_impot(id);
});

//insert composition salariale
$(document).on('submit', '#frm_compo_sal', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_compo_sal.php",
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

   $('#frm_compo_sal')[0].reset();
});

//insert province
$(document).on('submit', '#frm_province', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_province.php",
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

   $('#frm_province')[0].reset();
});

//insert formation
$(document).on('submit', '#frm_commune', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_commune.php",
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

   $('#frm_commune')[0].reset();
});

//insert formation
$(document).on('submit', '#frm_colline', function(event){

  event.preventDefault();
    $.ajax({
    url:"backend/insert_colline.php",
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

   $('#frm_colline')[0].reset();
});

})

function load_form_colline(id,com)
{
  $.ajax({

    url:"forms/frm_colline.php",
    method:"GET",
    data:{id:id,com:com},
    beforeSend: function()
    {
      $('#page_content_admin').html('<p>page en chargement .......</p>');
    },
    success:function(data)
    {
      $('#page_content_admin').html(data);
    }

  })
}

function load_tab_colline(etat)
{
  $.ajax({

    url:"tables/tab_colline.php",
    method:"GET",
    data:{etat:etat},
    beforeSend: function()
    {
      $('#page_content_admin').html('<p>page en chargement .......</p>');
    },
    success:function(data)
    {
      $('#page_content_admin').html(data);
      $('#tab_colline').DataTable();
    }

  })
}

function load_form_commune(id,prov)
{
  $.ajax({

    url:"forms/frm_commune.php",
    method:"GET",
    data:{id:id,prov:prov},
    beforeSend: function()
    {
      $('#page_content_admin').html('<p>page en chargement .......</p>');
    },
    success:function(data)
    {
      $('#page_content_admin').html(data);
    }

  })
}

function load_tab_commune(etat)
{
  $.ajax({

    url:"tables/tab_commune.php",
    method:"GET",
    data:{etat:etat},
    beforeSend: function()
    {
      $('#page_content_admin').html('<p>page en chargement .......</p>');
    },
    success:function(data)
    {
      $('#page_content_admin').html(data);
      $('#tab_commune').DataTable();
    }

  })
}

function load_form_province(id)
{
  $.ajax({

    url:"forms/frm_province.php",
    method:"GET",
    data:{id:id},
    beforeSend: function()
    {
      $('#page_content_admin').html('<p>page en chargement .......</p>');
    },
    success:function(data)
    {
      $('#page_content_admin').html(data);
    }

  })
}

function load_tab_province(etat)
{
  $.ajax({

    url:"tables/tab_province.php",
    method:"GET",
    data:{etat:etat},
    beforeSend: function()
    {
      $('#page_content_admin').html('<p>page en chargement .......</p>');
    },
    success:function(data)
    {
      $('#page_content_admin').html(data);
      $('#tab_province').DataTable();
    }

  })
}

function load_form_compo_salaire(id)
{
  $.ajax({

    url:"forms/frm_compo_salaire.php",
    method:"GET",
    data:{id:id},
    beforeSend: function()
    {
      $('#page_content_admin').html('<p>page en chargement .......</p>');
    },
    success:function(data)
    {
      $('#page_content_admin').html(data);
    }

  })
}

function load_tab_compo_salaire(etat)
{
  $.ajax({

    url:"tables/tab_compo_salaire.php",
    method:"GET",
    data:{etat:etat},
    beforeSend: function()
    {
      $('#page_content_admin').html('<p>page en chargement .......</p>');
    },
    success:function(data)
    {
      $('#page_content_admin').html(data);
    }

  })
}

function load_form_compo_cotisation(id)
{
  $.ajax({

    url:"forms/frm_compo_cotisation.php",
    method:"GET",
    data:{id:id},
    beforeSend: function()
    {
      $('#page_content_admin').html('<p>page en chargement .......</p>');
    },
    success:function(data)
    {
      $('#page_content_admin').html(data);
    }

  })
}

function load_tab_compo_cotisation(etat)
{
  $.ajax({

    url:"tables/tab_compo_cotisation.php",
    method:"GET",
    data:{etat:etat},
    beforeSend: function()
    {
      $('#page_content_admin').html('<p>page en chargement .......</p>');
    },
    success:function(data)
    {
      $('#page_content_admin').html(data);
    }

  })
}

function load_form_compo_indemnite(id)
{
  $.ajax({
    url:"forms/frm_compo_indemnite.php",
    method:"GET",
    data:{id:id},
    beforeSend: function()
    {
      $('#page_content_admin').html('<p>page en chargement .......</p>');
    },
    success:function(data)
    {
      $('#page_content_admin').html(data);
    }

  })
}

function load_tab_compo_indemnite(etat)
{
  $.ajax({

    url:"tables/tab_compo_indemnite.php",
    method:"GET",
    data:{etat:etat},
    beforeSend: function()
    {
      $('#page_content_admin').html('<p>page en chargement .......</p>');
    },
    success:function(data)
    {
      $('#page_content_admin').html(data);
    }

  })
}

function load_form_compo_impot(id)
{
  $.ajax({

    url:"forms/frm_compo_impot.php",
    method:"GET",
    data:{id:id},
    beforeSend: function()
    {
      $('#page_content_admin').html('<p>page en chargement .......</p>');
    },
    success:function(data)
    {
      $('#page_content_admin').html(data);
    }

  })
}

function load_tab_compo_impot(etat)
{
  $.ajax({
    url:"tables/tab_compo_impot.php",
    method:"GET",
    data:{etat:etat},
    beforeSend: function()
    {
      $('#page_content_admin').html('<p>page en chargement .......</p>');
    },
    success:function(data)
    {
      $('#page_content_admin').html(data);
    }

  })
}
