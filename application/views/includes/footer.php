   <footer>
          <div class="pull-right">
          Court Case Portal
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

  <!-- jQuery -->
	<script src="<?php echo base_url();?>js/jquery.knob.js"></script>
	<!-- jQuery File Upload Dependencies -->
	<script src="<?php echo base_url();?>js/jquery.ui.widget.js"></script>
	<script src="<?php echo base_url();?>js/jquery.iframe-transport.js"></script>
	<script src="<?php echo base_url();?>js/jquery.fileupload.js"></script>
	<!-- Only used for the demos. Please ignore and remove. -->
    <!-- Bootstrap -->
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url();?>js/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url();?>js/nprogress.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url();?>js/icheck.min.js"></script>
    <script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>

<script type="text/javascript"
        src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

	 <!-- Datatables -->
    <script src="<?php echo base_url();?>js/datatable/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>js/datatable/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>js/datatable/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url();?>js/datatable/buttons.bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>js/datatable/buttons.flash.min.js"></script>
    <script src="<?php echo base_url();?>js/datatable/buttons.html5.min.js"></script>
    <script src="<?php echo base_url();?>js/datatable/buttons.print.min.js"></script>
    <script src="<?php echo base_url();?>js/datatable/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo base_url();?>js/datatable/dataTables.keyTable.min.js"></script>
    <script src="<?php echo base_url();?>js/datatable/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url();?>js/datatable/responsive.bootstrap.js"></script>
    <script src="<?php echo base_url();?>js/datatable/datatables.scroller.min.js"></script>
    <script src="<?php echo base_url();?>js/datatable/jszip.min.js"></script>
    <script src="<?php echo base_url();?>js/datatable/pdfmake.min.js"></script>
    <script src="<?php echo base_url();?>js/datatable/vfs_fonts.js"></script>
	 <script src="<?php echo site_base_url();?>js/minglefit.js"></script>
	 <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url();?>js/custom.min.js"></script>
 <!-- Datatables -->
    <script>
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              dom: "Bfrtip",
              buttons: [
                {
                  extend: "print",
                  className: "btn-sm"
                },
              ],
              responsive: true
            });
          }
        };

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();

        $('#datatable').dataTable();

        $('#datatable-keytable').DataTable({
          keys: true
        });

        $('#datatable-responsive').DataTable();



        $('#datatable-fixed-header').DataTable({
          fixedHeader: true
        });

        var $datatable = $('#datatable-checkbox');

        $datatable.dataTable({
          'order': [[ 1, 'asc' ]],
          'columnDefs': [
            { orderable: false, targets: [0] }
          ]
        });
        $datatable.on('draw.dt', function() {
          $('input').iCheck({
            checkboxClass: 'icheckbox_flat-green'
          });
        });

        TableManageButtons.init();
      });
    </script>
    <!-- /Datatables -->


	<script>
        $(function(){

    var ul = $('#upload ul');

    $('#drop a').click(function(){
        // Simulate a click on the file input button
        // to show the file browser dialog
        $(this).parent().find('input').click();
    });

    // Initialize the jQuery File Upload plugin
    $('#upload').fileupload({

        // This element will accept file drag/drop uploading
        dropZone: $('#drop'),

        // This function is called when a file is added to the queue;
        // either via the browse button, or via drag/drop:
        add: function (e, data) {

            var tpl = $('<li class="working"><input type="text" value="0" data-width="48" data-height="48"'+
                ' data-fgColor="#0788a5" data-readOnly="1" data-bgColor="#3e4043" /><p></p><span></span></li>');

            // Append the file name and file size
            tpl.find('p').text(data.files[0].name)
                         .append('<i>' + formatFileSize(data.files[0].size) + '</i>');

            // Add the HTML to the UL element
            data.context = tpl.appendTo(ul);

            // Initialize the knob plugin
            tpl.find('input').knob();

            // Listen for clicks on the cancel icon
            tpl.find('span').click(function(){

                if(tpl.hasClass('working')){
                    jqXHR.abort();
                }

                tpl.fadeOut(function(){
                    tpl.remove();
                });

            });

            // Automatically upload the file once it is added to the queue
            var jqXHR = data.submit();
        },

        progress: function(e, data){

            // Calculate the completion percentage of the upload
            var progress = parseInt(data.loaded / data.total * 100, 10);

            // Update the hidden input field and trigger a change
            // so that the jQuery knob plugin knows to update the dial
            data.context.find('input').val(progress).change();

            if(progress == 100){
                data.context.removeClass('working');
            }
        },

        fail:function(e, data){
            // Something has gone wrong!
            data.context.addClass('error');
        }

    });


    // Prevent the default action when a file is dropped on the window
    $(document).on('drop dragover', function (e) {
        e.preventDefault();
    });

    // Helper function that formats the file sizes
    function formatFileSize(bytes) {
        if (typeof bytes !== 'number') {
            return '';
        }

        if (bytes >= 1000000000) {
            return (bytes / 1000000000).toFixed(2) + ' GB';
        }

        if (bytes >= 1000000) {
            return (bytes / 1000000).toFixed(2) + ' MB';
        }

        return (bytes / 1000).toFixed(2) + ' KB';
    }

});


$(document).ready(function(){

});


	</script>








  </body>
</html>
