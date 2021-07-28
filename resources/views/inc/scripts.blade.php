@if(isset($datatable) and $datatable==true)
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
@endif
@if(isset($filepond) and $filepond==true)
    @push('css')
        <link rel="stylesheet" href="{{asset('plugins/filepond/filepond.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/filepond/filepond-plugin-image-preview.min.css')}}">
    @endpush
    @push('js')
        <script src="{{asset('plugins/filepond/filepond-plugin-image-preview.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/filepond.min.js')}}"></script>
    @endpush
@endif
@if(isset($ckeditor) and $ckeditor==true)
    @push('js')
        <script src="{{asset('plugins/ckeditor/ckeditor.js')}}"></script>
    @endpush
@endif
