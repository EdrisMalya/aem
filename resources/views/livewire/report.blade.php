<div>
    <x-layout title="My tasks report" active="index">
        <nav class="pl-5 breadcrumb-nav grey lighten-4 z-depth-0 border-bottom" style="z-index:1">
            <div class="nav-wrapper">
                <div class="col s12">
                    <a href="{{route('index')}}" class="breadcrumb black-text">Home</a>
                    <a href="javascript:void(0)" style="cursor:text" class="breadcrumb disabled">Report</a>
                </div>
            </div>
        </nav>
        <div class="row mx-2">
            <div class="col s12">
                <h5 class="d-inline-block">
                    My tasks report
                </h5>
                <br /><br />
                <x-button onclick="aem.exportTableToExcel('table','my_works.csv')">
                    Export to excel
                </x-button><br><br>
                <table id="table">
                    <thead>
                        <tr>
                            <th>Year</th>
                            <th>Month</th>
                            <th>Title</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($completed_tasks as $task)
                            @php

                                $monthNum  = $task->month;
                                $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                                $monthName = $dateObj->format('F');
                            @endphp
                            <tr>
                                @if($task->year_number == 1)
                                    <td rowspan='{{ $task->year_rowspan }}'>{{ $task->year }}</td>
                                    <td rowspan='{{ $task->month_rowspan }}'>{{ $monthName }}</td>
                                    <td style="text-align: left">{{ $task->title }} <small>{!! $task->description !!}</small></td>
                                @elseif($task->month_number == 1)
                                    <td rowspan='{{ $task->month_rowspan}}'>{{ $monthName }}</td>
                                    <td style="text-align: left">{{ $task->title }} <small>{!! $task->description !!}</small></td>
                                @else
                                <td style="text-align: left">{{ $task->title }} <small>{!! $task->description !!}</small></td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @push('css')
            <style>
                table tr, th, td{
                    border: 1px solid black;
                    text-align:center;
                    padding: 5px;
                }
            </style>
        @endpush
        @if($show_task_details)
            <x-modal style="height: 100%;width: 90%;">
                @livewire('my-work-details',['id'=>$task_id],key($task_id))
            </x-modal>
        @endif
    </x-layout>
</div>
@include('inc.scripts',['datatable'=>true,'buttons'=>true])
