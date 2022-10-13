$(function() {

  $(document).on('click', '.more_pay_sup', function(){
    $('#myModalPaySup').css("display","block");
  });

  $(document).on('click', '.more_pay_cust', function(){
    $('#myModalPayCust').css("display","block");
  });

  $(document).on('click', '.close', function(){
    $('#myModalPaySup').css("display","none");
    $('#myModalPayCust').css("display","none");
  });


  $(document).on('click', '.del_pay_sup', function(event){

    sup_id=$('#sup_id').val();
    op_id=$('#op_id_paie').val();
    id=$(this).data('id');
    if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
    {
      $.ajax({
        url:"backend/delete_pay_sup.php",
        method:'POST',
        data:{trans_id:id},
        success:function(data)
        {
          alert(data);
          load_frm_sup_paie(sup_id,op_id);
        }
      });
    }
    else
    {
      return false;
    }
  });

  $(document).on('click', '.del_pay_cust', function(event){

    cust_id=$('#cust_id').val();
    op_id=$('#op_id_paie').val();

    direct=$('#direct').val();
    id=$(this).data('id');
    if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
    {
      $.ajax({
        url:"backend/delete_pay_sup.php",
        method:'POST',
        data:{trans_id:id},
        success:function(data)
        {
          alert(data);
          if(direct=='fiche')
            load_frm_cust_paie(cust_id,op_id);
          else
            load_frm_new_sale('','');
        }
      });
    }
    else
    {
      return false;
    }
  });

  $(document).on('submit','#pay_facture', function(event){

    event.preventDefault(); 
	var printable='facture_2';
    sup_id=$('#sup_id').val();
    op_id=$('#op_id_paie').val();
    var printable='facture'

    $.ajax({
      url:"backend/insert_paie_sup.php",
      method:"POST",
      data:new FormData(this),
      contentType:false,
      processData:false,
      success:function(data)
      {
        alert(data);
        load_frm_sup_paie(sup_id,op_id);
      }
    });
	
  });

  $(document).on('submit','#pay_facture_cust', function(event){

    event.preventDefault(); 

    cust_id=$('#cust_id').val();
    op_id=$('#op_id_paie').val();
    var printable='facture'

    $.ajax({
      url:"backend/insert_paie_cust.php",
      method:"POST",
      data:new FormData(this),
      contentType:false,
      processData:false,
      success:function(data)
      {
        alert(data);
        load_frm_cust_paie(cust_id,op_id);
      }
    })
  });

  $(document).on('submit','#pay_facture_sup', function(event){

    event.preventDefault(); 
    date_from=$('#date_from').val();
    date_to=$('#date_to').val();
    if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
    {
    $.ajax({
      url:"backend/insert_paie_sup.php",
      method:"POST",
      data:new FormData(this),
      contentType:false,
      processData:false,
      success:function(data)
      {
        alert(data);
        new_operation();
        load_frm_new_appro(date_from,date_to);

      }
    })
    }
      else
      {
        return false;
      }
  });

  $(document).on('submit','#pay_facture_cust_v', function(event){

    event.preventDefault(); 
	   printable='facture_2';
     if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
    {
    $.ajax({
      url:"backend/insert_paie_cust.php",
      method:"POST",
      data:new FormData(this),
      contentType:false,
      processData:false,
      success:function(data)
      {
        //alert(data);
        new_operation();
        load_frm_new_sale();

      }
    });
	   //printData(printable);
      }
      else
      {
        return false;
      }
  });

  $(document).on('click','#typ_dep',function(){
    load_tab_typ_dep('');
  });

  $(document).on('click','.nv_typ_dep',function(){
    id=$(this).data('id');
    load_tab_typ_dep(id);
  });

  $(document).on('submit', '#frm_typ_dep', function(event){

    event.preventDefault();
    $.ajax({
      url:"backend/insert_type_dep.php",
      method:'POST',
      data:new FormData(this),
      contentType:false,
      processData:false,
      success:function(data)
      {

        alert(data);
        $('#operation').val("Add");
        load_tab_typ_dep('');
      }
    });

    $('#frm_typ_dep')[0].reset();
  });


  $(document).on('click','.nv_alim',function(){
    id=$(this).data('id');
    from_d=$('#from_d').val();
    to_d=$('#to_d').val();
    bq_id=$('#bq_id').val();
    load_tab_operation_alim(id,from_d,to_d,bq_id);
  });

  $(document).on('submit','#frm_srch_rap_alim',function(){
    id='';
    from_d=$('#from_d').val();
    to_d=$('#to_d').val();
    bq_id=$('#bq_id').val();
    load_tab_operation_alim(id,from_d,to_d,bq_id);
  });

  $(document).on('click','.nv_dep',function(){
    id=$(this).data('id');
    from_d=$('#from_d').val();
    to_d=$('#to_d').val();
    bq_id=$('#bq_id').val();
    load_tab_operation_dep(id,from_d,to_d,bq_id);
  });

  $(document).on('click','#dep',function(){
    id='';from_d='';to_d='';bq_id='';
    load_tab_operation_dep(id,from_d,to_d,bq_id);
  });

  $(document).on('submit','#frm_srch_rap_dep',function(){
    id='';
    from_d=$('#from_d').val();
    to_d=$('#to_d').val();
    bq_id=$('#bq_id').val();
    load_tab_operation_dep(id,from_d,to_d,bq_id);
  });

  $(document).on('click','#alim',function(){
    id=''; from_d='', to_d='';bq_id='';
    load_tab_operation_alim(id,from_d,to_d,bq_id);
  });

  $(document).on('click','#trans',function(){
    id=''; from_d='', to_d='';bq_id='';
    load_tab_operation_transf(id,from_d,to_d,bq_id);
  });

  $(document).on('submit','#frm_srch_rap_trans',function(){
    id='';
    from_d=$('#from_d').val();
    to_d=$('#to_d').val();
    bq_id=$('#bq_id').val();
    load_tab_operation_transf(id,from_d,to_d,bq_id);
  });

  $(document).on('click','.nv_trans',function(){
    id=$(this).data('id');
    from_d=$('#from_d').val();
    to_d=$('#to_d').val();
    bq_id=$('#bq_id').val();
    load_tab_operation_transf(id,from_d,to_d,bq_id);
  });

  $(document).on('submit', '#frm_alim_cpt', function(event){
//alert("ca va enregistrer");
from_d=$('#from_d').val();
to_d=$('#to_d').val();
bank='';
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
    load_tab_operation_alim('',from_d,to_d,bank);
    load_acc_balance();
  }
});
});

  $(document).on('submit', '#frm_depense', function(event){
//alert("ca va enregistrer");
from_d=$('#from_d').val();
to_d=$('#to_d').val();
bank='';

event.preventDefault();

$.ajax({
  url:"backend/insert_depense.php",
  method:'POST',
  data:new FormData(this),
  contentType:false,
  processData:false,
  success:function(data)
  {
    alert(data);
    $('#frm_depense')[0].reset();

    $('#lab_action').html("Enregistrer");
    $('#action').val("Add");
    $('#operation').val("Add");

    load_tab_operation_dep('',from_d,to_d,bank);

  }
});

})

  $(document).on('submit', '#frm_trans', function(event){

    from_d=$('#from_d').val();
    to_d=$('#to_d').val();
    bank='';

    event.preventDefault();
    $.ajax({
      url:"backend/insert_trans.php",
      method:'POST',
      data:new FormData(this),
      contentType:false,
      processData:false,
      success:function(data)
      {

        alert(data);
        $('#operation').val("Add");
        load_tab_operation_transf('',from_d,to_d,bank);
      }
    })

    $('#frm_trans')[0].reset();
  });

  $(document).on('click','#nv_bq',function(){
    id=$(this).data('id');
    load_frm_bq(id);
  });

  $(document).on('click','#bq',function(){
    load_tab_bq();
  });

  $(document).on('submit', '#frm_bq', function(event){

    event.preventDefault();
    $.ajax({
      url:"backend/insert_banque.php",
      method:'POST',
      data:new FormData(this),
      contentType:false,
      processData:false,
      success:function(data)
      {

        alert(data);
        $('#operation').val("Add");
        load_tab_bq();
      }
    });

    $('#frm_bq')[0].reset();
  });

  $(document).on('click', '.trash_cash', function(event){

    table=$('#table_name').val();
    id=$('#id_name').val();
    val_id=$(this).attr('id');

    if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
    {
      $.ajax({
        url:"backend/delete_op.php",
        method:'POST',
        data:{table:table,val_id:val_id,id:id},
        success:function(data)
        {
          alert(data);
          if(table=="banque"){ load_tab_bq()}
            if(table=="type_dep"){ load_tab_typ_dep('')}
          }
      });
    }
    else
    {
      return false;
    }
  });

  $(document).on('click', '.trash_trans', function(event){
    from_d=$('#from_d').val();
    to_d=$('#to_d').val();
    bq_id='';
    id=$(this).data('id');
    tab=$('#tab_name').val();

    if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
    {
      $.ajax({
        url:"backend/delete_trans.php",
        method:'POST',
        data:{trans_id:id},
        success:function(data)
        {
          alert(data);
          if(tab=="table_trans"){ load_tab_operation_transf('',from_d,to_d,bq_id);}
          if(tab=="table_dep"){ load_tab_operation_dep('',from_d,to_d,bq_id);}
          if(tab=="table_alim"){ load_tab_operation_alim('',from_d,to_d,bq_id);}
        }
      });
    }
    else
    {
      return false;
    }
  });

  $(document).on('click', '.delete_trans', function(){
    var trans_id = $(this).attr("id");
    var from_d=$('#from_d').val();
    var to_d=$('#to_d').val();

    if(confirm("Etes-vous sur de vouloir effectuer cette operation ?"))
    {
      $.ajax({
        url:"backend/delete_trans.php",
        method:"POST",
        data:{trans_id:trans_id},
        success:function(data)
        {
          alert(data);
          load_tab_hist_pay(from_d,to_d);
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

//fin
});

function load_tab_bq()
{
  $.ajax({

    url:"tables/tab_banque.php",
    method:"GET",
    beforeSend: function()
    {
      $('#page-content').html('<p>page en chargement .......</p>');
    },
    success:function(data)
    {
      $('#page-content').html(data);
      $('#tab_bq').DataTable({
        "bInfo": false,
        "paging":false,
        "bLengthChange": false,
        dom: 'Bfrtip',
        buttons: ['excel', 'pdf', 'print']
      });
    }

  })
}

function load_frm_bq(id)
{
  $.ajax({

    url:"forms/frm_banque.php",
    method:"GET",
    data:{id:id},
    beforeSend: function()
    {
      $('#page-content').html('<p>page en chargement .......</p>');
    },
    success:function(data)
    {
      $('#page-content').html(data);
    }

  })
}

function load_tab_operation_dep(id,from_d,to_d,bq_id)
{
  $.ajax({

    url:"tables/tab_depense.php",
    method:"GET",
    data:{id:id,from_d:from_d,to_d:to_d,bq_id:bq_id},
    beforeSend: function()
    {
      $('#page-content').html('<p>page en chargement .......</p>');
    },
    success:function(data)
    {
      $('#page-content').html(data);
      $('#tab_depense').DataTable({
        "bInfo": false,
        "paging":false,
        "bLengthChange": false,
        dom: 'Bfrtip',
        buttons: ['excel', 'pdf', 'print']
      });
    }

  })
}

function load_tab_operation_transf(id,from_d,to_d,bq_id)
{
  $.ajax({

    url:"tables/tab_transfert.php",
    method:"GET",
    data:{id:id,from_d:from_d,to_d:to_d,bq_id:bq_id},
    beforeSend: function()
    {
      $('#page-content').html('<p>page en chargement .......</p>');
    },
    success:function(data)
    {
      $('#page-content').html(data);
      $('#tab').DataTable({
        "bInfo": false,
        "paging":false,
        "bLengthChange": false,
        dom: 'Bfrtip',
        buttons: ['excel', 'pdf', 'print']
      });
    }

  })
}

function load_tab_operation_alim(id,from_d,to_d,bq_id)
{
  $.ajax({

    url:"tables/tab_alim.php",
    method:"GET",
    data:{id:id,from_d:from_d,to_d:to_d,bq_id:bq_id},
    beforeSend: function()
    {
      $('#page-content').html('<p>page en chargement .......</p>');
    },
    success:function(data)
    {
      $('#page-content').html(data);
      $('#tab').DataTable({
        "bInfo": false,
        "paging":true,
        "bLengthChange": false,
        dom: 'Bfrtip',
        buttons: ['excel', 'pdf', 'print']
      });
    }

  })
}

function load_frm_dep(id)
{
  $.ajax({

    url:"forms/frm_dep.php",
    method:"GET",
    data:{id:id},
    beforeSend: function()
    {
      $('#page-content').html('<p>page en chargement .......</p>');
    },
    success:function(data)
    {
      $('#page-content').html(data);
    }

  })
}

function load_frm_alim(id)
{
  $.ajax({

    url:"forms/frm_alim.php",
    method:"GET",
    data:{id:id},
    beforeSend: function()
    {
      $('#page-content').html('<p>page en chargement .......</p>');
    },
    success:function(data)
    {
      $('#page-content').html(data);
    }

  })
}

function load_frm_depense(id)
{
  $.ajax({

    url:"forms/frm_depense.php",
    method:"GET",
    data:{id:id},
    beforeSend: function()
    {
      $('#page-content').html('<p>page en chargement .......</p>');
    },
    success:function(data)
    {
      $('#page-content').html(data);
    }

  })
}

function load_frm_trans(id)
{
  $.ajax({

    url:"forms/frm_trans.php",
    method:"GET",
    data:{id:id},
    beforeSend: function()
    {
      $('#page-content').html('<p>page en chargement .......</p>');
    },
    success:function(data)
    {
      $('#page-content').html(data);
    }

  })
}

function pay_supplier(mont_trans,op_id,date_ap,mode_paie)
{
  $.ajax({
    url:"backend/insert_paie.php",
    method:"POST",
    data:{mont_trans:mont_trans,op_id:op_id,date_ap:date_ap,mode_paie:mode_paie},
    success:function(data)
    {
      alert(data);
      load_acc_balance();
    }
  })
}

function load_tab_typ_dep(id)
{
  $.ajax({

    url:"tables/tab_type_dep.php",
    method:"GET",
    data:{id:id},
    beforeSend: function()
    {
      $('#page_content').html('<p>page en chargement .......</p>');
    },
    success:function(data)
    {
      $('#page-content').html(data);
      $('#tab_typ_dep').DataTable({
        "bInfo": false,
        "paging":false,
        "bLengthChange": false,
        dom: 'Bfrtip',
        buttons: ['excel', 'pdf', 'print']
      });
    }

  })
}