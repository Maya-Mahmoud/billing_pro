@extends('layouts.master')
@section('title')
    list of bills
@endsection
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal   Notify -->

    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
    
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">the bill</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ list of bill</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @if (session()->has('delete_bill'))
        <script>
            window.onload = function() {
                notif({
                    msg: "the bill deleted successfully",
                    type: "success"
                })
            }

        </script>
    @endif


    @if (session()->has('Status_Update'))
        <script>
            window.onload = function() {
                notif({
                    msg: "the bill updated successfully",
                    type: "success"
                })
            }

        </script>
    @endif

    @if (session()->has('restore_bill'))
        <script>
            window.onload = function() {
                notif({
                    msg: "The bill has been successfully retrieved",
                    type: "success"
                })
            }

        </script>
    @endif


    <!-- row -->
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">

                        <a href="bills/create" class="modal-effect btn btn-sm btn-primary" style="color:white">
                            @can('add bill')
                    <i class="fas fa-plus"></i>&nbsp; add bill</a>
                    @endcan

                  
                            </div>

                        <div class="col-xl-12">
                            <div class="card mg-b-20">
                                <div class="card-header pb-0">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="card-title mg-b-0">Bordered Table</h4>
                                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                                    </div>
                                    <p class="tx-12 tx-gray-500 mb-2">Example of Valex Bordered Table.. <a href="">Learn more</a></p>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'style="text-align: center">
                                            <thead>
                                            <tr>
                                                <th class="border-bottom-0">#</th>
                                                <th class="border-bottom-0">bill_number</th>
                                                <th class="border-bottom-0">bill_date</th>
                                                <th class="border-bottom-0">due_date</th>
                                                <th class="border-bottom-0">prodatct</th>
                                                <th class="border-bottom-0"> section</th>
                                                <th class="border-bottom-0">Discount</th>
                                                <th class="border-bottom-0">Tax_rate</th>
                                                <th class="border-bottom-0">tax_value</th>
                                                <th class="border-bottom-0">Total</th>
                                                <th class="border-bottom-0">status</th>
                                                <th class="border-bottom-0">notes</th>
                                                <th class="border-bottom-0">operations</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach ($bills as $bill)
                                                @php
                                                    $i++
                                                @endphp
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $bill->bill_number }} </td>
                                                    <td>{{$bill->bill_Date }}</td>
                                                    <td>{{ $bill->Due_date }}</td>
                                                    <td>{{ $bill->product }}</td>
                                                    <td>
                                                        <a href="{{ url('billsDetails') }}/{{ $bill->id }}">{{ $bill->section->section_name }}
                                                        </a>
                                                    </td>
                                                    <td>{{ $bill->Discount }}</td>
                                                    <td>{{$bill->Rate_VAT }}</td>
                                                    <td>{{ $bill->Value_VAT }}</td>
                                                    <td>{{ $bill->Total }}</td>
                                                    <td>
                                            @if ($bill->Value_Status == 1)
                                                <span class="text-success">{{ $bill->Status }}</span>
                                            @elseif($bill->Value_Status == 2)
                                                <span class="text-danger">{{ $bill->Status }}</span>
                                            @else
                                                <span class="text-warning">{{ $bill->Status }}</span>
                                            @endif

                                        </td>

                                                    <td>{{ $bill->note }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button aria-expanded="false" aria-haspopup="true"
                                                                    class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                                    type="button">operations<i class="fas fa-caret-down ml-1"></i></button>
                                                            <div class="dropdown-menu tx-13">
                                                               @can('edit bill')
                                                                    <a class="dropdown-item"  href=" {{ url('edit_bill') }}/{{$bill->id }}">edit bill </a>
                                                                     @endcan
                                                                      
                                                               

                                                                
                                                                    <a class="dropdown-item" href="#" data-bill_id="{{$bill->id }}"
                                                                       data-toggle="modal" data-target="#delete_bill">
                                                                       @can('Delete bill')
                                                                       <i class="text-danger fas fa-trash-alt"></i>&nbsp;delete bill
                                                                       @endcan
                                                                       </a>
                                                              

                                                                
                                                                    <a class="dropdown-item"
                                                                       href="{{ URL::route('Status_show', [$bill->id]) }}">
                                                                       @can('Change of payment status')
                                                                       <i class=" text-success fas fa-money-bill"></i>&nbsp;&nbsp; change Payment status</a>
                                                                        @endcan
                                                               

                                                               
                                                                    <a class="dropdown-item" href="#" data-bill_id="{{ $bill->id }}"
                                                                       data-toggle="modal" data-target="#Transfer_bill">
                                                                       @can('archive bill')
                                                                       <i class="text-warning fas fa-exchange-alt"></i>&nbsp;&nbsp;moved to archive 
                                                                       @endcan
                                                                        </a>
                                                                       
                                                               

                                                                
                                                                    <a class="dropdown-item" href="Print_bill/{{ $bill->id }}">
                                                                    @can('Print bill')
                                                                        
                                                                    <i  class="text-success fas fa-print"></i>&nbsp;&nbsp;print bill
                                                                            @endcan

                                                                    </a>
                                                                
                                                            </div>
                                                        </div>

                                                    </td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>



                        <div class="modal fade" id="delete_bill" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">delete bill</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <form action="{{ route('bills.destroy', 'test') }}" method="post">
                                        {{ method_field('delete') }}
                                        {{ csrf_field() }}
                                    </div>
                                    <div class="modal-body">
                                    ?  Are you sure about the deletion process
                                        <input type="hidden" name="bill_id" id="bill_id" value="">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
                                        <button type="submit" class="btn btn-danger">confirm</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <!-- ارشيف الفاتورة -->
                        <div class="modal fade" id="Transfer_bill" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Archive the bill</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <form action="{{ route('bills.destroy', 'test') }}" method="post">
                                        {{ method_field('delete') }}
                                        {{ csrf_field() }}
                                    </div>
                                    <div class="modal-body">
                                    ? Are you sure about the archiving process
                                        <input type="hidden" name="bill_id" id="bill_id" value="">
                                        <input type="hidden" name="id_page" id="id_page" value="2">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
                                        <button type="submit" class="btn btn-success">confirm</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- row closed -->
                </div>
                
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>

    <script>
        $('#delete_bill').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var bill_id = button.data('bill_id')
            var modal = $(this)
            modal.find('.modal-body #bill_id').val(bill_id);
        })

    </script>

    <script>
        $('#Transfer_bill').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var bill_id = button.data('bill_id')
            var modal = $(this)
            modal.find('.modal-body #bill_id').val(bill_id);
        })

    </script>







@endsection
