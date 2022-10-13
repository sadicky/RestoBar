<!-- jQuery -->
    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/dist/js/tether.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.min.js"></script>
    <script src="js/dashboard1.js"></script>
    <!--Style Switcher -->
    <script src="plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
	<script src="plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
	
	<!-- start - This is for export functionality only -->
	<script src="js/dataTables.buttons.min.js"></script>
    <script src="js/buttons.flash.min.js"></script>
    <script src="js/jszip.min.js"></script>
    <script src="js/pdfmake.min.js"></script>
    <script src="js/vfs_fonts.js"></script>
    <script src="js/buttons.html5.min.js"></script>
    <script src="js/buttons.print.min.js"></script>
<!-- end - This is for export functionality only -->
	
	<script src="plugins/bower_components/custom-select/custom-select.min.js" type="text/javascript"></script>
	
	<!-- icheck -->
    <script src="plugins/bower_components/icheck/icheck.min.js"></script>
    <script src="plugins/bower_components/icheck/icheck.init.js"></script>
	
	<!-- jQuery file upload -->
    <script src="plugins/bower_components/dropify/dist/js/dropify.min.js"></script>
	<!-- Date Picker Plugin JavaScript -->
    <script src="plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
	
	 <!-- Magnific popup JavaScript -->
    <script src="plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>
    <script src="plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup-init.js"></script>
	
    <script>
		jQuery('#datepicker-autoclose').datepicker({
               autoclose: true
            , todayHighlight: true
			 , format: 'yyyy-mm-dd'
        });
		
		jQuery('#datepicker-autoclose2').datepicker({
               autoclose: true
            , todayHighlight: true
			 , format: 'yyyy-mm-dd'
        });
		
		 $('#example23').DataTable({
            dom: 'Bfrtip'
            , buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
        });
		
		$(".select2").select2();
    </script>