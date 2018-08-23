
$(document).ready(function () {
  //bootstrapToggle
$('.toggle_check').bootstrapToggle();
$('.toggle_check').change(function(){
  var status =$(this).prop('checked');
  var Id =$(this).attr('dataId');
  var base_url =$(this).attr('dataUrl');
  $.post(base_url, {Id:Id,status:status},function(response){});
});

//datatable
  $('.sidebar-menu').tree()
  $('#example1').DataTable()
  $('#example2').DataTable({
    'paging'      : true,
    'lengthChange': false,
    'searching'   : false,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : false
  })
  //editor textarea
  CKEDITOR.replace('editor1');
    CKEDITOR.replace('editor2');
});
