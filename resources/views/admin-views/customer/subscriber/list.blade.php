@extends('layouts.admin.app')
@section('title', translate('messages.subscriber_list'))
@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title text-capitalize">
                <div class="card-header-icon d-inline-flex mr-2 img">
                    <img src="{{asset('/public/assets/admin/img/mail.png')}}" alt="public">
                </div>
                <span>
                    {{ translate('messages.subscribed_mail_list') }}
                        <span class="badge badge-soft-dark ml-2">{{ $subscribers->total() }}</span>
                </span>
            </h1>
        </div>
        <!-- End Page Header -->
        <!-- Card -->
        <div class="card">
            <!-- Header -->
            <div class="card-header flex-wrap justify-content-end">
                <form >
                    <div class="input--group input-group input-group-merge input-group-flush">
                        <input id="datatableSearch_" type="search" name="search" class="form-control"
                            value="{{ request()->get('search') }}" placeholder="{{ translate('Ex:_Search_for_emails') }}"
                            aria-label="Search">
                        <button type="submit" class="btn btn--secondary">
                                <i class="tio-search"></i>
                        </button>
                        @if (request()->get('search'))
                            <button type="reset" class="btn btn--primary btn-sm mx-1"
                                onclick="location.href = '{{ route('admin.customer.subscribed') }}'">{{ translate('messages.reset') }}</button>
                        @endif
                    </div>
                    <!-- End Search -->
                </form>
                 <!-- Unfold -->
                 <div class="hs-unfold mr-2 ml-2">
                    <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle min-height-40" href="javascript:;"
                        data-hs-unfold-options='{
                                "target": "#usersExportDropdown",
                                "type": "css-animation"
                            }'>
                        <i class="tio-download-to mr-1"></i> {{ translate('messages.export') }}
                    </a>

                    <div id="usersExportDropdown"
                        class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right">
                        <span class="dropdown-header">{{ translate('messages.download_options') }}</span>
                        <a id="export-excel" class="dropdown-item" href="{{route('admin.customer.subscriber-export',  ['type'=>'excel',request()->getQueryString()])}}">
                            <img class="avatar avatar-xss avatar-4by3 mr-2"
                                src="{{ asset('public/assets/admin') }}/svg/components/excel.svg"
                                alt="Image Description">
                            {{ translate('messages.excel') }}
                        </a>
                        <a id="export-csv" class="dropdown-item" href="{{route('admin.customer.subscriber-export', ['type'=>'csv',request()->getQueryString()])}}">
                            <img class="avatar avatar-xss avatar-4by3 mr-2"
                                src="{{ asset('public/assets/admin') }}/svg/components/placeholder-csv-format.svg"
                                alt="Image Description">
                            .{{ translate('messages.csv') }}
                        </a>
                    </div>
                </div>
                <!-- End Unfold -->

            </div>
            <!-- End Header -->
            <!-- Table -->
            <div class="table-responsive datatable-custom">
                <table id="datatable"
                    class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table generalData"
                    data-hs-datatables-options='{
                                                             "columnDefs": [{
                                                                "targets": [0],
                                                                "orderable": false
                                                              }],
                                                             "order": [],
                                                             "info": {
                                                               "totalQty": "#datatableWithPaginationInfoTotalQty"
                                                             },
                                                             "search": "#datatableSearch",
                                                             "entries": "#datatableEntries",
                                                             "pageLength": 25,
                                                             "isResponsive": false,
                                                             "isShowPaging": false,
                                                             "paging":false
                                                           }'>
                    <thead class="thead-light">
                        <tr>
                            <th class="">
                                {{ translate('messages.sl') }}
                            </th>
                            <th>{{ translate('messages.email') }}</th>
                            <th>{{ translate('messages.created_at') }}</th>
                        </tr>
                    </thead>
                    <tbody id="set-rows">
                            @foreach ($subscribers as $key => $customer)
                                <tr>
                                    <td>
                                        {{ $key+$subscribers->firstItem() }}
                                    </td>
                                    <td>
                                        {{ $customer->email }}
                                    </td>
                                    <td>{{ date('Y-m-d', strtotime($customer->created_at)) }}</td>
                                </tr>
                            @endforeach
                    </tbody>

                </table>
                @if(count($subscribers) === 0)
                <div class="empty--data">
                    <img src="{{asset('/public/assets/admin/img/empty.png')}}" alt="public">
                    <h5>
                        {{translate('no_data_found')}}
                    </h5>
                </div>
                @endif
            </div>
            <!-- End Table -->
            <!-- Footer -->
            <div class="card-footer">
                <!-- Pagination -->
                <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                    <div class="col-sm-auto">
                        <div class="d-flex justify-content-center justify-content-sm-end">
                            <!-- Pagination -->
                            {!! $subscribers->links() !!}
                        </div>
                    </div>
                </div>
                <!-- End Pagination -->
            </div>
            <!-- End Footer -->
        </div>
        <!-- End Card -->
    </div>
@endsection
@push('script_2')

@endpush
