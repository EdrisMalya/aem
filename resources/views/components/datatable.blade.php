@include('inc.scripts',['datatable'=>true,'buttons'=>$buttons])
<div wire:ignore>
    <table class="stripe display row-border compact hover" style="display: none"
           x-data="{show:false}"
           {{$attributes}}
           @if($buttons)
           x-init="
            setTimeout(()=>{
                $('#{{$attributes['id']}}').DataTable({
                    'drawCallback': function (settings) {
                        $('#example_info').addClass('mt-3');
                        $('#example_paginate').addClass('mt-3');
                        $('input').addClass('browser-default');
                        $('.dataTables_wrapper').find('select').addClass('browser-default c-select');
                        $('.dt-button').removeClass('dt-button').addClass('btn waves-effect transparent black-text btn-small mb-4');
                        $('.stripe').show();
                    },
                    responsive: true,
                    dom: 'Bfrtip',
                    buttons: [
                        'pageLength',
                        {
                            extend: 'colvis',
                            className: 'mr-3'
                        },
                        'copy', 'csv', 'excel', {
                            extend: 'pdfHtml5',
                            exportOptions: {
                                columns: ':visible',
                                modifier: { order: 'index' },
                                format: {
                                    body: function (data, row, column, node) {
                                        const arabic = /[\u0600-\u06FF]/;

                                        if (arabic.test(data)) {
                                            return data.split(' ').reverse().join(' ');
                                        }
                                        return data;
                                    },
                                    header: function (data, row, column, node) {
                                        const arabic = /[\u0600-\u06FF]/;

                                        if (arabic.test(data)) {
                                            return data.split(' ').reverse().join(' ');
                                        }
                                        return data;
                                    }
                                }
                            }
                        }, 'print'
                    ],
                    columnDefs: [{
                        targets: -1,
                        visibile: false
                    }]
                });
                 $('.table').show();
            },300)
        "
           @else
           x-init="
            setTimeout(()=>{
                $('#{{$attributes['id']}}').DataTable({
                    'drawCallback': function (settings) {
                        $('.table').show();
                        $('#example_info').addClass('mt-3');
                        $('#example_paginate').addClass('mt-3');
                        $('input').addClass('browser-default');
                        $('.dataTables_wrapper').find('select').addClass('browser-default c-select');
                        $('.dt-button').removeClass('dt-button').addClass('btn waves-effect transparent black-text btn-small mb-4');
                    },
                    responsive: true,
                });
            },500)
        "
        @endif
    >
        {{$slot}}
    </table>
</div>
