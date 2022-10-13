$(function() {

$(document).on('click', '#sale_static', function(){
//alert('oko');
load_tab_sales_static();
 });

$(document).on('click', '#prod_static', function(){
//alert('oko');
load_tab_prod_static();
 });

});

function load_tab_sales_static()
{
  var haut='Transactions\n';
  var bas='Etabli par ' + $('#sess_name').html() + '\n';
  var titre=$('#soft_title').html();

  $.ajax({
    type:'GET',
    url:'tables/sales_static.php',
    beforeSend : function ()
      {
         $("#page-content").html('loading...');
      },
    success:function(data)
    {
      $('#page-content').html(data);
      /*$('.example2').DataTable({
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
                     });*/


    }
  });
}

function load_tab_prod_static()
{
  var haut='Transactions\n';
  var bas='Etabli par ' + $('#sess_name').html() + '\n';
  var titre=$('#soft_title').html();

  $.ajax({
    type:'GET',
    url:'tables/products_static.php',
    beforeSend : function ()
      {
         $("#page-content").html('loading...');
      },
    success:function(data)
    {
      $('#page-content').html(data);
      $('.example2').DataTable({
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

