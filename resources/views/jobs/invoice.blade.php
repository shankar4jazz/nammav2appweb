<!DOCTYPE html>
<html>

<head>
    <title>{{env('APP_NAME')}}</title>
    <meta charset="UTF-8">
</head>
<style type="text/css">
    :root {
        --bs-blue: #0d6efd;
        --bs-indigo: #6610f2;
        --bs-purple: #6f42c1;
        --bs-pink: #d63384;
        --bs-red: #dc3545;
        --bs-orange: #fd7e14;
        --bs-yellow: #ffc107;
        --bs-green: #198754;
        --bs-teal: #20c997;
        --bs-cyan: #0dcaf0;
        --bs-black: #000;
        --bs-white: #fff;
        --bs-gray: #6c757d;
        --bs-gray-dark: #343a40;
        --bs-gray-100: #f8f9fa;
        --bs-gray-200: #e9ecef;
        --bs-gray-300: #dee2e6;
        --bs-gray-400: #ced4da;
        --bs-gray-500: #adb5bd;
        --bs-gray-600: #6c757d;
        --bs-gray-700: #495057;
        --bs-gray-800: #343a40;
        --bs-gray-900: #212529;
        --bs-primary: #0d6efd;
        --bs-secondary: #6c757d;
        --bs-success: #198754;
        --bs-info: #0dcaf0;
        --bs-warning: #ffc107;
        --bs-danger: #dc3545;
        --bs-light: #f8f9fa;
        --bs-dark: #212529;
        --bs-primary-rgb: 13, 110, 253;
        --bs-secondary-rgb: 108, 117, 125;
        --bs-success-rgb: 25, 135, 84;
        --bs-info-rgb: 13, 202, 240;
        --bs-warning-rgb: 255, 193, 7;
        --bs-danger-rgb: 220, 53, 69;
        --bs-light-rgb: 248, 249, 250;
        --bs-dark-rgb: 33, 37, 41;
        --bs-white-rgb: 255, 255, 255;
        --bs-black-rgb: 0, 0, 0;
        --bs-body-color-rgb: 33, 37, 41;
        --bs-body-bg-rgb: 255, 255, 255;
        --bs-font-sans-serif: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", "Noto Sans", "Liberation Sans", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        --bs-font-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
        --bs-gradient: linear-gradient(180deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0));
        --bs-body-font-family: var(--bs-font-sans-serif);
        --bs-body-font-size: 1rem;
        --bs-body-font-weight: 400;
        --bs-body-line-height: 1.5;
        --bs-body-color: #212529;
        --bs-body-bg: #fff;
        --bs-border-width: 1px;
        --bs-border-style: solid;
        --bs-border-color: #dee2e6;
        --bs-border-color-translucent: rgba(0, 0, 0, 0.175);
        --bs-border-radius: 0.375rem;
        --bs-border-radius-sm: 0.25rem;
        --bs-border-radius-lg: 0.5rem;
        --bs-border-radius-xl: 1rem;
        --bs-border-radius-2xl: 2rem;
        --bs-border-radius-pill: 50rem;
        --bs-link-color: #0d6efd;
        --bs-link-hover-color: #0a58ca;
        --bs-code-color: #d63384;
        --bs-highlight-bg: #fff3cd;
    }

    *,
    ::after,
    ::before {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        font-family: var(--bs-body-font-family);
        font-size: var(--bs-body-font-size);
        font-weight: var(--bs-body-font-weight);
        line-height: var(--bs-body-line-height);
        color: var(--bs-body-color);
        text-align: var(--bs-body-text-align);
        background-color: var(--bs-body-bg);
        -webkit-text-size-adjust: 100%;
        -webkit-tap-highlight-color: transparent;
    }

    .container {
        max-width: 1320px;
    }

    .row {
        --bs-gutter-x: 1.5rem;
        --bs-gutter-y: 0;
        flex-wrap: wrap;
        margin-top: calc(-1 * var(--bs-gutter-y));
        margin-right: calc(-.5 * var(--bs-gutter-x));
        margin-left: calc(-.5 * var(--bs-gutter-x));
    }

    .card {
        --bs-card-spacer-y: 1rem;
        --bs-card-spacer-x: 1rem;
        --bs-card-title-spacer-y: 0.5rem;
        --bs-card-border-width: 1px;
        --bs-card-border-color: var(--bs-border-color-translucent);
        --bs-card-border-radius: 0.375rem;
        --bs-card-box-shadow: ;
        --bs-card-inner-border-radius: calc(0.375rem - 1px);
        --bs-card-cap-padding-y: 0.5rem;
        --bs-card-cap-padding-x: 1rem;
        --bs-card-cap-bg: rgba(0, 0, 0, 0.03);
        --bs-card-cap-color: ;
        --bs-card-height: ;
        --bs-card-color: ;
        --bs-card-bg: #fff;
        --bs-card-img-overlay-padding: 1rem;
        --bs-card-group-margin: 0.75rem;
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        height: var(--bs-card-height);
        word-wrap: break-word;
        background-color: var(--bs-card-bg);
        background-clip: border-box;
        border: var(--bs-card-border-width) solid var(--bs-card-border-color);
        border-radius: var(--bs-card-border-radius);
    }

    .col-lg-12 {
        flex: 0 0 auto;
        width: 100%;
    }

    .card-body {
        flex: 1 1 auto;
        padding: var(--bs-card-spacer-y) var(--bs-card-spacer-x);
        color: var(--bs-card-color);
    }

    .container {
        --bs-gutter-x: 1.5rem;
        --bs-gutter-y: 0;
        width: 100%;
        padding-right: calc(var(--bs-gutter-x) * .5);
        padding-left: calc(var(--bs-gutter-x) * .5);
        margin-right: auto;
        margin-left: auto;
    }

    .float-end {
        float: right !important;
    }

    .mb-4 {
        margin-bottom: 1.5rem !important;
    }

    .bg-success {
        --bs-bg-opacity: 1;
        background-color: #0a5231 !important;
    }

    .ms-2 {
        margin-left: 0.5rem !important;
    }

    .badge {
        --bs-badge-padding-x: 0.65em;
        --bs-badge-padding-y: 0.35em;
        --bs-badge-font-size: 0.75em;
        --bs-badge-font-weight: 700;
        --bs-badge-color: #fff;
        --bs-badge-border-radius: 0.375rem;
        display: inline-block;
        padding: var(--bs-badge-padding-y) var(--bs-badge-padding-x);
        font-size: var(--bs-badge-font-size);
        font-weight: var(--bs-badge-font-weight);
        line-height: 1;
        color: var(--bs-badge-color);
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: var(--bs-badge-border-radius);
    }

    .mb-4 {
        margin-bottom: 1.5rem !important;
    }

    .text-muted {
        --bs-text-opacity: 1;
        color: #6c757d !important;
    }

    .h2,
    h2 {
        font-size: 2rem;
    }

    .h4,
    h4 {
        font-size: 1.5rem;
    }

    .h1,
    .h2,
    .h3,
    .h4,
    .h5,
    .h6,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        margin-top: 0;
        margin-bottom: 0.5rem;
        font-weight: 500;
        line-height: 1.2;
    }

    .h5,
    h5 {
        font-size: 1.25rem;
    }

    .table {
        --bs-table-color: var(--bs-body-color);
        --bs-table-bg: transparent;
        --bs-table-border-color: var(--bs-border-color);
        --bs-table-accent-bg: transparent;
        --bs-table-striped-color: var(--bs-body-color);
        --bs-table-striped-bg: rgba(0, 0, 0, 0.05);
        --bs-table-active-color: var(--bs-body-color);
        --bs-table-active-bg: rgba(0, 0, 0, 0.1);
        --bs-table-hover-color: var(--bs-body-color);
        --bs-table-hover-bg: rgba(0, 0, 0, 0.075);
        width: 100%;
        margin-bottom: 1rem;
        color: var(--bs-table-color);
        vertical-align: top;
        border-color: var(--bs-table-border-color);
    }

    .table>tbody {
        vertical-align: inherit;
    }

    .table>:not(caption)>*>* {
        padding: 0.5rem 0.5rem;
        background-color: var(--bs-table-bg);
        border-bottom-width: 1px;
        box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
    }

    .mb-1 {
        margin-bottom: 0.25rem !important;
    }

    .text-muted {
        --bs-text-opacity: 1;
        color: #6c757d !important;
    }

    p {
        margin-top: 0;
        margin-bottom: 1rem;
    }

    .my-4 {
        margin-top: 1.5rem !important;
        margin-bottom: 1.5rem !important;
    }

    hr {
        margin: 1rem 0;
        color: inherit;
        border: 0;
        border-top: 1px solid;
        opacity: .25;
    }

    .col-sm-6 {
        flex: 0 0 auto;
        width: 50%;
    }


    .mb-3 {
        margin-bottom: 1rem !important;
    }

    .mb-2 {
        margin-bottom: 0.5rem !important;
    }

    .text-sm-end {
        text-align: right !important;
    }

    .mt-4 {
        margin-top: 1.5rem !important;
    }


    .mb-1 {
        margin-bottom: 0.25rem !important;
    }

    .m-0 {
        margin: 0px;
    }

    .p-0 {
        padding: 0px;
    }

    .pt-5 {
        padding-top: 5px;
    }

    .mt-10 {
        margin-top: 10px;
    }

    .text-center {
        text-align: center !important;
    }

    .w-100 {
        width: 100% !important;
    }

    .w-50 {
        width: 50%;
    }

    .w-85 {
        width: 85%;
    }

    .w-15 {
        width: 15%;
    }

    header {
        padding: 10px 0;
        margin-bottom: 20px;
        border-bottom: 1px solid #0d6efd
    }

    footer {
        margin-top: 50px !important;
        border-top: 1px solid #0d6efd
    }

    .logo img {
        width: 45px;
        height: 45px;
        padding-top: 30px;
    }

    .logo span {
        margin-left: 8px;
        top: 80px;
        position: absolute;
        font-weight: bold;
        font-size: 25px;
    }

    .gray-color {
        color: #5D5D5D;
    }

    .text-bold {
        font-weight: bold;
    }

    .border {
        border: 1px solid black;
    }

    table tr,
    th,
    td {
        border: 1px solid #d2d2d2;
        border-collapse: collapse;
        padding: 7px 8px;
    }

    table tr th {
        background: #F4F4F4;
        font-size: 15px;
    }

    table tr td {
        font-size: 13px;
    }

    table {
        border-collapse: collapse;
    }

    .box-text p {
        line-height: 10px;
    }

    .float-left {
        float: left;
    }

    .total-part {
        font-size: 16px;
        line-height: 12px;
    }

    .total-right p {
        padding-right: 20px;
    }

    .text {
        margin-left: 60px !important;
        margin-top: -40px !important;
    }

    .invoice-to {
        text-align: left !important;
    }

    .invoice-details {
        text-align: right !important;
        margin-top: -120px !important;
    }

    footer {
        width: 100%;
        text-align: center;
        color: #777;
        border-top: 1px solid #aaa;
        padding: 8px 0
    }

    .signature {
        text-align: right !important;
        margin-top: -120px !important;
    }

    .details {
        border-top: 1px solid #5D5D5D
    }

    .right {
        float: right !important;
    }

    .invoice {
        margin-top: -150px !important;
        float: right !important;
    }

    .invoice table .no {
        color: #fff;
        font-size: 1.6em;
        background: rgb(65, 83, 179)
    }
</style>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="invoice-title">

                            <div class="mb-4">
                                <h2 class="mb-1 text-muted">Tamilan Jobs</h2>
                                <h6 class="mb-1 text-muted">No 1 Jobs Post Platform</h6>
                            </div>
                            <div class="text-muted">
                                <h5 class="mb-1 text-muted">Eagleminds Technologies Pvt Ltd</h6>
                                    <p class="mb-1">Pattalamman Street, Adiyur(po),</p>
                                    <p class="mb-1">Tirupattur (tk & district), 635602.</p>
                                    <p><i class="uil uil-phone me-1"></i>{{$data->helpline_number}}</p>

                                    <h5 class="mb-1">{{__('GST No')}} :</h5>
                                    <h5 class="mb-1">{{__('HSN Code')}} :</h5>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="text-muted">
                                    <h5 class="font-size-16 mb-3">{{__('messages.Billed_To')}}:</h5>
                                    <h5 class="mb-1">{{$bookingdata->company_name ?? '-'}}</h5>
                                    <p class="mb-1">{{ optional($bookingdata->district)->name ?? '-' }}</p>
                                    <p class="mb-1">{{optional($bookingdata->city)->name ?? '-' }}</p>
                                    <p class="mb-1">{{$bookingdata->company_name ?? '-' }}</p>
                                    <p class="mb-1">{{$bookingdata->contact_number ?? '-' }}</p>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-sm-6 invoice">
                                <div class="text-muted text-sm-end">
                                    <div>
                                        <h5 class="font-size-15 mb-1">{{__('messages.Invoice_No')}}:</h5>
                                        <p>{{ '#' . $bookingdata->id ?? '-'}}</p>

                                    </div>


                                </div>
                            </div>
                        </div><br>
                        <div class="table-section bill-tbl w-100 mt-10">
                            <table class="table w-100 mt-10">
                                <tr>

                                    <th class="w-50">{{__('#')}}</th>
                                    <th class="w-50">{{__('messages.Product_Name')}}</th>
                                    <th class="w-50">{{__('messages.Price')}}</th>


                                </tr>
                                <tr>
                                    <td class="no">1</td>
                                    <td class="text-wrap ps-lg-3 text-left">
                                        <p>1 Job Post Displayed</p>
                                        <p>
                                            {{'Validity : '.optional($bookingdata->jobsPlans)->trial_period.' Days Only' ?? '-' }}
                                        </p>
                                        <p> {{'Geographic Scope :  1 Districts Allowed'}}</p>
                                    </td>
                                    <td>
                                        <p style="font-family: 'DejaVu Sans';">{{ getPriceFormat(optional($bookingdata->jobsPlans)->amount) ?? 0}}</p>
                                    </td>
                                </tr>


                                <tr align="center">
                                    <td colspan="7">
                                        <div class="total-part">
                                            <div class="total-left w-85 float-left" align="right">


                                                <p>{{__('CGST')}} (9%)</p>
                                                <p>{{__('SGST')}} (9%)</p>



                                            </div>
                                            <div class="total-right w-15 float-left text-bold" align="right">

                                                @php
                                                $amount = optional($bookingdata->jobsPlans)->amount;
                                                $totalAmount = optional($bookingdata->jobsPlans)->total_amount;
                                                $gst = $amount * (18 / 100);
                                                $sgstAmount = $amount * (9 / 100);
                                                $cgstAmount = $amount * (9 / 100);

                                                @endphp

                                                <p style="font-family: 'DejaVu Sans';font-size: 14px;">{{getPriceFormat($cgstAmount)}}</p>
                                                <p style="font-family: 'DejaVu Sans';font-size: 14px;">{{getPriceFormat($sgstAmount)}}</p>

                                                @php
                                                $sub_total = $gst + $amount;


                                                $total_amount = $sub_total;
                                                @endphp

                                            </div>

                                            <div style="clear: both;"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr align="center">
                                    <td colspan="7">

                                        <div class="total-part">
                                            <div style="clear: both;"></div>
                                            <div class="total-left w-85 float-left" align="right">
                                                <p class="mb-2">{{__('messages.Total_Payable')}}</p>
                                            </div>
                                            <div class="total-right w-15 float-left text-bold" align="right">
                                                <p style="font-family: 'DejaVu Sans'; font-size: 14px;">{{ !empty($total_amount) ? getPriceFormat(round($total_amount)) : '0' }}</p>
                                            </div>

                                            <div style="clear: both;"></div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <!-- <footer>© 2022 All Rights Reserved by IQONIC Design</footer> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>