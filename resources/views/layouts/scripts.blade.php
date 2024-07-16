<!-- jQuery -->
<script src="{{ asset('public/admin_assets') }}/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('public/admin_assets') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- Bootstrap 4 -->
<script src="{{ asset('public/admin_assets') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('public/admin_assets') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<!-- summer note -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<!-- AdminLTE App -->

<script src="{{ asset('public/admin_assets') }}/dist/js/adminlte.js"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('public/admin_assets') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('public/admin_assets') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('public/admin_assets') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('public/admin_assets') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('public/admin_assets') }}/plugins/jszip/jszip.min.js"></script>
<script src="{{ asset('public/admin_assets') }}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{ asset('public/admin_assets') }}/plugins/pdfmake/vfs_fonts.js"></script>

{{-- Normalization Script --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"
    integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('#formID').one('submit', function() {
        $(this).find('button[type="submit"]').attr('disabled', 'disabled');
    });

    $('.normalize').selectize();

    $(function() {
        $("#example1").DataTable({
            "responsive": false,
            "lengthChange": true,
            "autoWidth": true,
            // "buttons": ["pdf", "print"],
            // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });
    });
    // .buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
</script>
