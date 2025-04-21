@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
    <!-- Internal DateTimePicker CSS -->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/jquery.datetimepicker.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css">

@endsection

@section('title')
    add bill
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">the bills</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    add bill</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')

    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('bills.store') }}" method="post" enctype="multipart/form-data"
                          autocomplete="off">
                        {{ csrf_field() }}
                        {{-- 1 --}}
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">bill number</label>
                                <input type="text" class="form-control" id="inputName" name="bill_number"
                                       title="please enter number bill" required>
                            </div>

                            <div class="col">
                                <label>bill date </label>
                                <input class="form-control fc-datepicker" name="bill_Date" placeholder="YYYY-MM-DD"
                                       type="text" value="{{ date('Y-m-d') }}"  required>
                            </div>

                            <div class="col">
                                <label>due date</label>
                                <input class="form-control fc-datepicker" name="Due_date" placeholder="YYYY-MM-DD"
                                       type="text" required>
                            </div>
                        </div>

                        {{-- 2 --}}
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">the section</label>
                                <select name="Section" class="form-control SlectBox">
                                    <!--placeholder-->
                                    <option value="" selected disabled>select section</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}"> {{ $section->section_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">the product</label>
                                <select id="prodact" name="product" class="form-control">
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">Collection amount</label>
                                <input type="text" class="form-control" id="inputName" name="Amount_collection"
                                       oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                        </div>

                        {{-- 3 --}}
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">
                                    Commission amount</label>
                                <input type="text" class="form-control form-control-lg" id="Amount_Commission"
                                       name="Amount_Commission" title="please enter Commission amount "
                                       oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                       required>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">discount</label>
                                <input type="text" class="form-control form-control-lg" id="Discount" name="Discount"
                                       title="please enter discount"
                                       oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                       value=0 required>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">Value added tax rate</label>
                                <select name="Rate_VAT" id="Rate_VAT" class="form-control" onchange="myFunction()">
                                    <!--placeholder-->
                                    <option value="" selected disabled>select the tax rate</option>
                                    <option value="5%">5%</option>
                                    <option value="10%">10%</option>
                                </select>
                            </div>
                        </div>

                        {{-- 4 --}}
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">Value added tax value</label>
                                <input type="text" class="form-control" id="Value_VAT" name="Value_VAT" readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">Total including tax</label>
                                <input type="text" class="form-control" id="Total" name="Total" readonly>
                            </div>
                        </div>

                        {{-- 5 --}}
                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">notes</label>
                                <textarea class="form-control" id="exampleTextarea" name="note" rows="3"></textarea>
                            </div>
                        </div><br>

                        <p class="text-danger">*
                            Attachment format: pdf, jpeg ,.jpg , png </p>
                        <h5 class="card-title">attachments</h5>

                        <div class="col-sm-12 col-md-12">
                            <input type="file" name="pic" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png"
                                   data-height="70" />
                        </div><br>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">save data</button>
                        </div>

                    </form>
                </div>
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
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();

    </script>

    <script>
        $(document).ready(function() {
            $('select[name="Section"]').on('change', function() {
                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                        url: "{{ URL::to('section') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="product"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="product"]').append('<option value="' +
                                    value + '">' + value + '</option>');
                            });
                        },
                    });

                } else {
                    console.log('AJAX load did not work');
                }
            });

        });

    </script>


    <script>

            function myFunction() {
                // استرجاع القيم من الحقول
                var Amount_Commission = parseFloat(document.getElementById("Amount_Commission").value);
                var Discount = parseFloat(document.getElementById("Discount").value);
                var Rate_VAT = document.getElementById("Rate_VAT").value;

                // خطوات التصحيح لعرض القيم المسترجعة في وحدة تحكم المتصفح (Console)
                console.log("Amount_Commission: ", Amount_Commission);
                console.log("Discount: ", Discount);
                console.log("Rate_VAT (before cleaning): ", Rate_VAT);

                // التحقق إذا كانت قيمة العمولة المدخلة غير صالحة
                if (isNaN(Amount_Commission)) {
                    alert('يرجي ادخال مبلغ العمولة');
                    return; // إيقاف التنفيذ إذا لم تكن القيمة مدخلة
                }

                // التحقق من الخصم، إذا لم يكن عددًا صحيحًا، نضع قيمته 0
                Discount = isNaN(Discount) ? 0 : Discount;

                // إزالة رمز النسبة المئوية من نسبة الضريبة وتحويلها إلى رقم
                Rate_VAT = parseFloat(Rate_VAT.replace('%', ''));

                // خطوات التصحيح بعد إزالة رمز النسبة المئوية
                console.log("Rate_VAT (after cleaning): ", Rate_VAT);

                // التحقق إذا كانت نسبة الضريبة بعد التحويل إلى عدد غير صالحة
                if (isNaN(Rate_VAT)) {
                    alert('يرجي اختيار نسبة ضريبة صالحة');
                    return; // إيقاف التنفيذ إذا لم يتم تحديد نسبة الضريبة بشكل صحيح
                }

                // حساب قيمة العمولة بعد الخصم
                var Amount_Commission2 = Amount_Commission - Discount;

                // خطوات التصحيح لعرض حساب العمولة بعد الخصم
                console.log("Amount_Commission after discount: ", Amount_Commission2);

                // حساب قيمة الضريبة بناءً على العمولة بعد الخصم
                var intResults = Amount_Commission2 * Rate_VAT / 100;

                // خطوات التصحيح لعرض قيمة الضريبة
                console.log("VAT value: ", intResults);

                // حساب الإجمالي بعد إضافة الضريبة إلى العمولة بعد الخصم
                var intResults2 = parseFloat(intResults + Amount_Commission2);

                // خطوات التصحيح لعرض الإجمالي بعد الضريبة
                console.log("Total including VAT: ", intResults2);

                // تحويل القيم الناتجة إلى رقمين عشريين
                var sumq = parseFloat(intResults).toFixed(2);
                var sumt = parseFloat(intResults2).toFixed(2);

                // إدخال القيم المحسوبة في الحقول المخصصة لها
                document.getElementById("Value_VAT").value = sumq;
                document.getElementById("Total").value = sumt;
            }

    </script>




@endsection
