
$(document).ready(function () {
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
  CKEDITOR.replace('editor1')
});
