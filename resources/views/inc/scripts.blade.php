
@if ($type == "css")
    <link href="{{asset('plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet" />
    <link href="{{asset('plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet" />
    @if (isset($buttons) and $buttons == true)
        <link href="{{asset('plugins/datatable/css/buttons.dataTables.min.css')}}" rel="stylesheet" />
    @endif
@elseif($type=="js")
    <script src="{{asset('plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    @if (isset($buttons) and $buttons == true)
        <script src="{{asset('plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('plugins/datatable/js/jszip.min.js')}}"></script>
        <script src="{{asset('plugins/datatable/js/pdfmake.min.js')}}"></script>
        <script src="{{asset('plugins/datatable/js/vfs_fonts.js')}}"></script>
        <script src="{{asset('plugins/datatable/js/buttons.html5.min.js')}}"></script>
        <script src="{{asset('plugins/datatable/js/buttons.print.min.js')}}"></script>
        <script src="{{asset('plugins/datatable/js/buttons.colVis.min.js')}}"></script>

    @else
        {{--<script>
            $(document).ready(function () {
                $('.table').DataTable({
                    responsive: true,
                    "drawCallback": function( settings ) {
                        $('#example_info').addClass('mt-3');
                        $('#example_paginate').addClass('mt-3');
                        $('input[type="search"]').addClass('browser-default');
                        $('.dataTables_wrapper').find('select').addClass('browser-default c-select');
                        $('.dt-button').removeClass('dt-button').addClass('btn waves-effect transparent black-text btn-small mb-4');
                        $('.table').show();
                    },
                });

            });
        </script>--}}
    @endif
    <style>
        .paginate_button {
            padding: 5px 10px !important;
        }

        .dt-button {
            background: t
        }
    </style>
@endif
