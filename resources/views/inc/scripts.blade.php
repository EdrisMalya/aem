@if(isset($datatable) and $datatable==true)
    @push('css')
        <link href="{{asset('plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet" />
        <link href="{{asset('plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet" />
    @endpush
    @push('js')
        <script src="{{asset('plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    @endpush
    @if(isset($buttons) and $buttons==true)
        @push('css')
            <link href="{{asset('plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet" />
            <link href="{{asset('plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet" />
            <link href="{{asset('plugins/datatable/css/buttons.dataTables.min.css')}}" rel="stylesheet" />
        @endpush
        @push('js')
            <script src="{{asset('plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
            <script src="{{asset('plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
            <script src="{{asset('plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
            <script src="{{asset('plugins/datatable/js/jszip.min.js')}}"></script>
            <script src="{{asset('plugins/datatable/js/pdfmake.min.js')}}"></script>
            <script src="{{asset('plugins/datatable/js/vfs_fonts.js')}}"></script>
            <script src="{{asset('plugins/datatable/js/buttons.html5.min.js')}}"></script>
            <script src="{{asset('plugins/datatable/js/buttons.print.min.js')}}"></script>
            <script src="{{asset('plugins/datatable/js/buttons.colVis.min.js')}}"></script>
        @endpush
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
@if(isset($sweetalert) and $sweetalert)
    @push('js')
        <script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>
    @endpush
@endif
