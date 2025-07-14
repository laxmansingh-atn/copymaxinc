<!-- jQuery -->
<script src="<?=base_url()?>assets/admin/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?=base_url()?>assets/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?=base_url()?>assets/admin/plugins/iCheck/icheck.min.js"></script>

<!-- Custom Theme JavaScript -->
<!--<script src="<?=base_url()?>assets/admin/js/sb-admin-2.js"></script>-->
<script type="text/javascript">
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
	$('.message').fadeIn(3000);
	$('.message').fadeOut(3000);
  });
  
 /* $(document).on('click' , '#forgotten_password' , function(){
	  
			$.ajax({
				url: '<?= base_url()?>auth/forget_password',		
				type: 'post',
				data: { user_email : $('#user_email').val() } ,		
				success: function( res ){

				if(res == 1){
				$('.payment').html('<span style="color:green">Verification done successfully</span>') ;
				$('.payment').fadeIn(3000) ; 
				$('.payment').fadeOut(5000) ; 
				} 
				}
			}) ;
  
	  
  }); */
  
</script>
</body>

</html>
