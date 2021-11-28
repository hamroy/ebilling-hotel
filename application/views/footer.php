
<div id="footer">
		<div class="container" align="center">
        <p class="text-muted"  align="center"> <?=date('Y')?>  &copy;  <?=$namapt?> </p>
       </div>	
	</div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
   <!--<script src="<?=base_url()?>boot3_login/js/jquery-1.8.0.min.js"></script>--><script src="<?=base_url()?>boot3/jquery-2.1.1.min.js"></script>
   <script src="<?=base_url()?>boot3/momentv2.js"></script>
    <!--<script src="<?=base_url()?>jasny-bootstrap/js/bootstrap.js"></script>--><script src="<?=base_url()?>boot3/bootstrap331.js"></script>
    <script src="<?=base_url()?>jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
   <!-- <script src="<?=base_url()?>boot3/bootstrap-datepicker.js"></script>--> <script src="<?=base_url()?>boot3/bootstrap-datepickerv2.js"></script>
    
   <!-- <script>
		$(function(){
			$('#datetimepicker5, #datetimepicker5').datepicker();
			//$('#tooltip,#tooltip1,#tooltip2,#tooltip3').tooltip();
	});
	</script>-->
	        <script type="text/javascript">
            $(function () {
                $('#datetimepicker5').datetimepicker({   
               // locale: 'ru'
                //format: 'd/M/Y H:mm '
                //format: 'DD-MM-YYYY 15:00',
                format: 'DD-MM-YYYY HH:mm',
		//language: 'nl'

                });
           
            });
        </script>  <script type="text/javascript">
            $(function () {
                $('#datetimepicker6').datetimepicker({   
               // locale: 'ru'
                //format: 'd/M/Y H:mm '
                format: 'DD-MM-YYYY 13:00',
		//language: 'nl'

                });
           
            });
        </script>
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker6_1').datetimepicker({   
               // locale: 'ru'
                //format: 'd/M/Y H:mm '
                format: 'DD-MM-YYYY 15:00',
		//language: 'nl'

                });
           
            });
        </script>
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker7').datetimepicker({   
               // locale: 'ru'
                //format: 'd/M/Y H:mm '
                format: 'DD-MM-YYYY HH:mm',
		//language: 'nl'

                });
           
            });
        </script>
         <script type="text/javascript">
            $(function () {
                $('#datetimepicker8,#datetimepicker9,#datetimepicker10,#datetimepicker11').datetimepicker({   
               // locale: 'ru'
                //format: 'd/M/Y H:mm '
                format: 'DD-MM-YYYY ',
		//language: 'nl'

                });
           
            });
        </script>
        <?php
   $this->session->set_userdata('url',current_url());
    ?>
    
    
    <?php
    	
    ?>