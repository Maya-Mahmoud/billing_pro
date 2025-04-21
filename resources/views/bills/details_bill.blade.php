@extends('layouts.master')
@section('css')

    <link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/inputtags/inputtags.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
@endsection
@section('title')
    bill details
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">list of bill</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                   bill details</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif



    @if (session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

   

    <!-- row opened -->
    <div class="row row-sm">

        <div class="col-xl-12">
            <!-- div -->
            <div class="card mg-b-20" id="tabs-style2">
                <div class="card-body">
                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-2">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs main-nav-line">
                                            <li><a href="#tab4" class="nav-link active" data-toggle="tab">bill information
                                                    </a></li>
                                            <li><a href="#tab5" class="nav-link" data-toggle="tab">Payment statuses</a></li>
                                            <li><a href="#tab6" class="nav-link" data-toggle="tab">Attachments</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border">
                                    <div class="tab-content">


                                        <div class="tab-pane active" id="tab4">
                                            <div class="table-responsive mt-15">

                                                <table class="table table-striped" style="text-align:center">
                                                    <tbody>
                                                    <tr>

                                                    <td>{{ optional($bills->section)->section_name }}</td>

                                                        <th scope="row">:section</th>
                                                        <td>{{  $bills->Due_date }}</td>
                                                        <th scope="row">:due date</th>
                                                        <td>{{ $bills->bill_Date  }}</td>
                                                        <th scope="row">:Release date</th>
                                                        <td>{{$bills->bill_number}}</td>
                                                        <th scope="row">:bill number</th>



                                                    </tr>

                                                    <tr>
                                                        <td>{{ $bills->Discount }}</td>
                                                        <th scope="row">:Discount</th>
                                                        <td>{{  $bills->Amount_Commission }}</td>
                                                        <th scope="row">:Amount Commission</th>
                                                        <td>{{ $bills->Amount_collection }}</td>
                                                        <th scope="row">:Amount collection</th>
                                                        <td>{{ $bills->product }}</td>
                                                        <th scope="row">:product</th>




                                                    </tr>



                                                    <tr>
                                                        @if ($bills && $bills->Value_Status == 1)
                                                            <td><span class="badge badge-pill badge-success">{{ $bills->Status }}</span></td>
                                                        @elseif ($bills && $bills->Value_Status == 2)
                                                            <td><span class="badge badge-pill badge-danger">{{ $bills->Status }}</span></td>
                                                        @else
                                                            <td>غير متوفر</td>
                                                        @endif
                                                            <th scope="row">:Current status</th>
                                                            <td>{{ $bills->Total  }}</td>
                                                            <th scope="row">:Total with tax</th>
                                                            <td>{{ $bills->Value_VAT }}</td>
                                                            <th scope="row">:Value VAT</th>
                                                            <td>{{  $bills->Rate_VAT  }}</td>
                                                        <th scope="row">:Rate VAT</th>








                                                    </tr>


                                                    <tr>
                                                        <td>{{  $bills->note }}</td>
                                                        <th scope="row">:notes</th>

                                                   </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>

                                        <div class="tab-pane" id="tab5">
                                            <div class="table-responsive mt-15">
                                                <table class="table center-aligned-table mb-0 table-hover"
                                                       style="text-align:center">
                                                    <thead>
                                                    <tr class="text-dark">
                                                        <th>#</th>
                                                        <th>:bill number </th>
                                                        <th>:product type</th>
                                                        <th>:section</th>
                                                        <th>:Payment status</th>
                                                        <th>:Payment date </th>
                                                        <th>:notes</th>
                                                        <th>:Date added</th>
                                                        <th>:user</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php $i = 0; ?>
                                                    @foreach ($details as $x)
                                                            <?php $i++; ?>
                                                        <tr>
                                                            <td>{{ $i }}</td>
                                                            <td>{{ $x->bill_number }}</td>
                                                            <td>{{ $x->product }}</td>
                                                            <td>{{ $bills->section->section_name }}</td>
                                                            @if ($x->Value_Status == 1)
                                                                <td><span
                                                                        class="badge badge-pill badge-success">{{ $x->Status }}</span>
                                                                </td>
                                                            @elseif($x->Value_Status ==2)
                                                                <td><span
                                                                        class="badge badge-pill badge-danger">{{ $x->Status }}</span>
                                                                </td>
                                                            @else
                                                                <td><span
                                                                        class="badge badge-pill badge-warning">{{ $x->Status }}</span>
                                                                </td>
                                                            @endif
                                                            <td>{{ $x->Payment_Date }}</td>
                                                            <td>{{ $x->note }}</td>
                                                            <td>{{ $x->created_at }}</td>
                                                            <td>{{ $x->user }}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>


                                            </div>
                                        </div>


                                        <div class="tab-pane" id="tab6">
                                            <!--المرفقات-->
                                            <div class="card card-statistics">
                                            @can('Add attachment')
                                                    <div class="card-body">
                                                        <p class="text-danger">* attachment format pdf, jpeg ,.jpg , png </p>
                                                        
                                                        <h5 class="card-title">add attachment </h5>
                                            
                                                        <form method="post" action="{{ url('/BillAttachments') }}"
                                                              enctype="multipart/form-data">
                                                            {{ csrf_field() }}
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="customFile"
                                                                       name="file_name" required>
                                                                <input type="hidden" id="customFile" name="bill_number"
                                                                       value="{{ $bills->bill_number }}">
                                                                <input type="hidden" id="bill_id" name="bill_id"
                                                                       value="{{$bills->id }}">
                                                                <label class="custom-file-label" for="customFile">select attachment
                                                                   </label>
                                                            </div><br><br>
                                                            <button type="submit" class="btn btn-primary btn-sm "
                                                                    name="uploadedFile">confirm</button>
                                                        </form>
                                                    </div>
                                                 @endcan
                                                <br>

                                                <div class="table-responsive mt-15">
                                                    <table class="table center-aligned-table mb-0 table table-hover"
                                                           style="text-align:center">
                                                        <thead>
                                                        <tr class="text-dark">
                                                            <th scope="col">#</th>
                                                            <th scope="col">file name</th>
                                                            <th scope="col">He added</th>
                                                            <th scope="col">date add</th>
                                                            <th scope="col">operations</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $i = 0; ?>
                                                        @foreach ( $attachments as $attachment)
                                                            <?php $i++; ?>
                                                            <tr>
                                                                <td>{{ $i }}</td>
                                                                <td>{{ $attachment->file_name }}</td>
                                                                <td>{{ $attachment->Created_by }}</td>
                                                                <td>{{ $attachment->created_at }}</td>
                                                                <td colspan="2">

                                                                    <a class="btn btn-outline-success btn-sm"
                                                                       href="{{ url('View_file') }}/{{ $bills->bill_number }}/{{ $attachment->file_name }}"
                                                                       role="button"><i class="fas fa-eye"></i>&nbsp;
                                                                      show</a>

                                                                    <a class="btn btn-outline-info btn-sm"
                                                                       href="{{ url('download') }}/{{ $bills->bill_number }}/{{ $attachment->file_name }}"
                                                                       role="button"><i
                                                                            class="fas fa-download"></i>&nbsp;
                                                                       download</a>


                                                                        <button class="btn btn-outline-danger btn-sm"
                                                                                data-toggle="modal"
                                                                                data-file_name="{{ $attachment->file_name }}"
                                                                                data-bill_number="{{ $attachment->bill_number }}"
                                                                                data-id_file="{{ $attachment->id }}"
                                                                                data-target="#delete_file">delete</button>


                                                                </td>
                                                            </tr>
                                                    @endforeach

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /div -->
        </div>

    </div>
    <!-- /row -->

    <!-- delete -->
    <div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
         @can('delete attachment')
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">delete attachment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('delete_file') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p class="text-center">
                        <h6 style="color:red"> are you sure of attachment delete proses</h6>
                        </p>

                        <input type="hidden" name="id_file" id="id_file" value="">
                        <input type="hidden" name="file_name" id="file_name" value="">
                        <input type="hidden" name="bill_number" id="bill_number" value="">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
                        <button type="submit" class="btn btn-danger">confirm</button>
                    </div>
                </form>
            </div>
        </div>
        @endcan
    </div>
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Jquery.mCustomScrollbar js-->
    <script src="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- Internal Input tags js-->
    <script src="{{ URL::asset('assets/plugins/inputtags/inputtags.js') }}"></script>
    <!--- Tabs JS-->
    <script src="{{ URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
    <script src="{{ URL::asset('assets/js/tabs.js') }}"></script>
    <!--Internal  Clipboard js-->
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.js') }}"></script>
    <!-- Internal Prism js-->
    <script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>

    <script>
        $('#delete_file').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id_file = button.data('id_file')
            var file_name = button.data('file_name')
            var bill_number = button.data('bill_number')
            var modal = $(this)

            modal.find('.modal-body #id_file').val(id_file);
            modal.find('.modal-body #file_name').val(file_name);
            modal.find('.modal-body #bill_number').val(bill_number);
        })

    </script>

    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

    </script>

    @endsection
