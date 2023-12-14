@extends('dashboard')
@section('user')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        #basic-addon2 {
            cursor: pointer;
            background: #f1bb3a;
        }
    </style>

    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> My Reward
            </div>
        </div>
    </div>

    <section id="profile-page-sec">
        <div class="page-content pt-20 pb-20">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 m-auto">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                    <h1 class="h3 mb-0 text-gray-800">Reward Collection</h1>

                                </div>

                                <div class="row">
                                    <div class="col-xl-6 col-md-6 mb-4">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div
                                                            class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                            Avaliable Poin</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                            {{ !empty($userPoint) ? $userPoint : '0' }} Poin</div>

                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-md-6 mb-4">
                                        <div class="card border-left-success shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div
                                                            class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                            Uses Poin</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                            {{ !empty($rewardItem[0]['point_use']) ? $rewardItem[0]['point_use'] : '0' }}
                                                            Poin</div>

                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">History Rendeem Poin</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="text-center">
                                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                                src="img/undraw_posting_photo.svg" alt="...">
                                        </div>

                                        <div class="card">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table id="example" class="table table-striped table-bordered"
                                                        style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Name </th>
                                                                <th>Poin Uses </th>
                                                                <th>Qty</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            @if ($rewardItem->count() > 0)
                                                                @if (isset($rewardItem) && !empty($rewardItem))
                                                                    @foreach ($rewardItem as $key => $item)
                                                                        <tr>
                                                                            <td> {{ $key + 1 }} </td>
                                                                            <td>{{ $item->reward_name }}</td>
                                                                            <td>{{ $item->point_use }}</td>
                                                                            <td>{{ $item->quantity }}</td>
                                                                            <td>status</td>

                                                                        </tr>
                                                                    @endforeach
                                                                @endif
                                                            @else
                                                                <div class="d-flex bd-highlight">
                                                                    <div class="p-2 flex-grow-1 bd-highlight">
                                                                        <h4>Anda Belum Menukarkan Point,</h4>
                                                                    </div>
                                                                    <div class="p-2 bd-highlight"><a
                                                                            href="{{ URL::previous() }}"
                                                                            class="btn btn-info btn-sm">Tukar Point</a>
                                                                    </div>
                                                                </div>
                                                            @endif

                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Name </th>
                                                                <th>Poin Amount </th>
                                                                <th>Qty</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            @include('frontend.body.dashboard_widgetbar_menu')

                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('frontend.body.dashboard_navigation_menu')
    </section>

    <script>
        function clipCopyFunction() {
            // Get the text field
            let copyText = document.getElementById("clipCopy");

            // Select the text field
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices

            // Copy the text inside the text field
            navigator.clipboard.writeText(copyText.value);

            // Alert the copied text
            alert("Copied the text: " + copyText.value);
        }
    </script>
@endsection
