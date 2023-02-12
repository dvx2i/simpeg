  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1
    </div>
     <img style="max-height: 3.5rem;"  src="<?= base_url('assets/publik') ?>/img/bsre-logo.png" alt="">
    <strong>Copyright &copy; 2020 SIPEDAS.</strong> 
  </footer>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="<?php echo base_url(); ?>assets/bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/morris.js/morris.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/chart.js/Chart.min.js"></script>

<!-- Sparkline -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<!--<script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>-->
<!--<script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>-->
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url(); ?>assets/bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo base_url(); ?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--<script src="<?php echo base_url(); ?>assets/dist/js/pages/dashboard.js"></script>-->
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
<!-- DataTables -->
<!-- <script src="<?php echo base_url(); ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script> -->
<script src="<?= base_url('assets') ?>/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- <script src="<?= base_url('assets') ?>/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables.net-select/js/dataTables.select.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script> -->
<script src="<?= base_url() ?>/assets/datatables/dataTables.checkbox.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables.net-buttons/js/buttons.colVis.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/pdfmake/build/pdfmake.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/pdfmake/build/vfs_fonts.js"></script>
<script src="<?= base_url('assets') ?>/plugins/jszip/dist/jszip.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script type="text/javascript">
function formatOption (state) {
  
  var str = state.text;
  var dat = str.split('~');
  var type = dat[0];
  var $res = dat[1];

if(type == '0'){
	return $res;
}
  return '<b>'+$res+'</b>';
};

  $(function() {
    $('#example1').DataTable();
    $('#example2').DataTable({
      'paging': true,
      'lengthChange': false,
      'searching': false,
      'ordering': true,
      'info': true,
      'autoWidth': false
    });
    //Initialize Select2 Elements
    $('.select2').select2();
  
  
  
$(".select2custom").select2({
  templateResult: formatOption,
escapeMarkup: function(markup) {
    return markup;
  }

});

    //Date picker
    $('.date').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    });

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    });

    $('[rel="tooltip"]').tooltip();


    // $('.dateEntry').dateEntry({
    //   dateFormat: 'dmy/'
    // });

    $('.dateEntry').datetextentry({
      show_tooltips: false,
      errorbox_x: -135,
      errorbox_y: 28
    });


    // $(".dateEntry").on("change", function() {
    //   this.setAttribute(
    //     "data-date",
    //     moment(this.value, "YYYY-MM-DD")
    //     .format(this.getAttribute("data-date-format"))
    //   )
    // }).trigger("change")

  });


  function angka(e) {
    if (!/^[0-9]+$/.test(e.value)) {
      e.value = e.value.substring(0, e.value.length - 1);
    }

  }
</script>
<script>
  function loading() {

    $('#loading').addClass('fa fa-spinner');
    $('#loadname').html('Loading... sedang memproses data');
    return true;
  }
</script>