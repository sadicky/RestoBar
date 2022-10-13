$(document).ready(function () {
          
           			//upload
//utilisateur			
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
    url:"forms/upload.php",
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
    }
   });
  }
 });
 
 //client photo			
$(document).on('change', '#upload_doc input', function(){
  var image_id = $(this).attr("class"); 
  var name = document.getElementById("file" + image_id).files[0].name;
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
  {
   alert("Image invalide");
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
   form_data.append("id_cli", image_id);
   
   $.ajax({
    url:"forms/upload_cli.php",
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
    }
   });
  }
 });
 
 //client signature		
$(document).on('change', '#upload_signa input', function(){

  var image_id = $(this).attr("class") + 's'; 
  var name = document.getElementById("file" + image_id).files[0].name;
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
  {
   alert("Image invalide");
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
   form_data.append("id_cli", image_id);
   
   $.ajax({
    url:"forms/upload_cli2.php",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend:function(){
     $('#s' + image_id).html("<label class='text-success'>Image Uploading...</label>");
    },   
    success:function(data)
    {
     $('#s' + image_id).html(data);
    }
   });
  }
 });
        });