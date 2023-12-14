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
                <span></span> My Referral
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
                                    <h1 class="h3 mb-0 text-gray-800">Referral Program</h1>

                                </div>

                                <div class="row">

                                    <div class="col-md-12 mb-4">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div
                                                            class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                            Total Referral</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                            {{ !empty(count($linkChild)) ? count($linkChild) : '0' }} Users
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="col-xl-6 col-md-6 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                        Pending</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">0 Users</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}


                                </div>


                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Your Referall Link</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="text-center">
                                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                                src="img/undraw_posting_photo.svg" alt="...">
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control"
                                                value=" {{ !empty($linkReff) ? $linkReff : 'menunggu proses pembuatan link' }}"
                                                id="clipCopy" readonly>
                                            <span class="input-group-text" id="basic-addon2" onclick="clipCopyFunction()"><i
                                                    class="fi-rs-clip"></i></span>
                                        </div>


                                        <p>Share Link Referal anda dan dapatkan bonus poin sebesar 500 poin setiap user yang
                                            mendaftar dan terverifikasi</p>
                                        <a target="_blank" rel="nofollow" href="#">Syarat & Ketentuan&rarr;</a>
                                    </div>
                                </div>

                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">History Share</h6>
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
                                                                <th>Email </th>
                                                                <th>Tanggal Register </th>
                                                                <th>Verified</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>


                                                            @if ($linkChild->count() > 0)
                                                                @if (isset($linkChild) && !empty($linkChild))
                                                                    @foreach ($linkChild as $key => $item)
                                                                        @php
                                                                            $ids = Auth::user();
                                                                            $referralChild = App\Models\User::where('id', $item->referal_user_id)->get();
                                                                            //dd($referralChild);
                                                                        @endphp

                                                                        @foreach ($referralChild as $keys => $items)
                                                                            <tr>
                                                                                <td> {{ $key + 1 }} </td>
                                                                                <td>{{ Str::mask($items->email, '*', -99, 10) }}
                                                                                </td>
                                                                                <td>{{ $items->last_seen }}</td>
                                                                                <td>{{ $items->verified_at }}</td>

                                                                            </tr>
                                                                        @endforeach
                                                                    @endforeach
                                                                @endif
                                                            @else
                                                                <div class="d-flex bd-highlight">
                                                                    <div class="p-2 flex-grow-1 bd-highlight">
                                                                        <h4>Share Lebih Banyak Link Referral Anda,</h4>
                                                                    </div>

                                                                </div>
                                                            @endif

                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Email </th>
                                                                <th>Tanggal Register </th>
                                                                <th>Verified</th>
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
