@extends('layouts.master')
@section('css')
@endsection
@section('title')
change Payment status
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">the bills</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                change Payment status</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('Status_Update', ['id' => $bills->id]) }}" method="post" autocomplete="off">
                        {{ csrf_field() }}
                        {{-- 1 --}}
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">bill number</label>
                                <input type="hidden" name="bill_id" value="{{ $bills->id }}">
                                <input type="text" class="form-control" id="inputName" name="bille_number"
                                    title="please enter bill number" value="{{ $bills->bill_number }}" required
                                    readonly>
                            </div>

                            <div class="col">
                                <label>bill date</label>
                                <input class="form-control fc-datepicker" name="bill_Date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ $bills->bill_Date }}" required readonly>
                            </div>

                            <div class="col">
                                <label>Due_date</label>
                                <input class="form-control fc-datepicker" name="Due_date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ $bills->Due_date }}" required readonly>
                            </div>

                        </div>

                        {{-- 2 --}}
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">section</label>
                                <select name="Section" class="form-control SlectBox" onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')" readonly>
                                    <!--placeholder-->
                                    <option value=" {{ $bills->section->id }}">
                                        {{ $bills->section->section_name }}
                                    </option>

                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">product</label>
                                <select id="product" name="product" class="form-control" readonly>
                                    <option value="{{ $bills->product }}"> {{ $bills->product }}</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">Amount_collection</label>
                                <input type="text" class="form-control" id="inputName" name="Amount_collection"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{ $bills->Amount_collection }}" readonly>
                            </div>
                        </div>


                        {{-- 3 --}}

                        <div class="row">

                            <div class="col">
                                <label for="inputName" class="control-label">Amount_Commission</label>
                                <input type="text" class="form-control form-control-lg" id="Amount_Commission"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{ $bills->Amount_Commission }}" required readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">discount</label>
                                <input type="text" class="form-control form-control-lg" id="Discount" name="Discount"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{ $bills->Discount }}" required readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">VAT rate</label>
                                <select name="Rate_VAT" id="Rate_VAT" class="form-control" onchange="myFunction()" readonly>
                                    <!--placeholder-->
                                    <option value=" {{ $bills->Rate_VAT }}">
                                        {{ $bills->Rate_VAT }}
                                </select>
                            </div>

                        </div>

                        {{-- 4 --}}

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">Value Added Tax</label>
                                <input type="text" class="form-control" id="Value_VAT" name="Value_VAT"
                                    value="{{ $bills->Value_VAT }}" readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">Total including tax</label>
                                <input type="text" class="form-control" id="Total" name="Total" readonly
                                    value="{{ $bills->Total }}">
                            </div>
                        </div>

                        {{-- 5 --}}
                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">nots</label>
                                <textarea class="form-control" id="exampleTextarea" name="note" rows="3" readonly>
                                {{ $bills->note }}</textarea>
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">Payment status</label>
                                <select class="form-control" id="Status" name="Status" required>
                                    <option selected="true" disabled="disabled">--Select payment status--</option>
                                    <option value="Paid">Paid</option>
                                    <option value="Partially paid">Partially paid</option>
                                </select>
                            </div>

                            <div class="col">
                                <label>Payment date</label>
                                <input class="form-control fc-datepicker" name="Payment_Date" placeholder="YYYY-MM-DD"
                                    type="text" required>
                            </div>


                        </div><br>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Update payment status</button>
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
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();

    </script>
@endsection