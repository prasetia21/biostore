@extends('frontend.guest_dashboard')
@section('main')

@section('title')
    Track Order
@endsection

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ url('/guest/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span>Track Your Order
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
                                <div class="tab-content account dashboard-content">
                                    <div class="tab-pane fade active show" id="dashboard" role="tabpanel"
                                        aria-labelledby="dashboard-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Track Your Order</h5>
                                            </div>
                                            <div class="card-body">



                                                <form method="post" action="{{ route('order.tracking.guest') }}">
                                                    @csrf

                                                    <div class="row">

                                                        <div class="form-group col-md-12">
                                                            <label>Invoice Code <span class="required">*</span></label>
                                                            <input class="form-control" name="code" type="text"
                                                                placeholder="Your Order Invoice Number" required="" />

                                                        </div>



                                                        <div class="col-md-12">
                                                            <button type="submit"
                                                                class="btn btn-fill-out submit font-weight-bold"
                                                                name="submit" value="Submit">Track Order</button>
                                                        </div>
                                                    </div>
                                                </form>
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
    </section>
@endsection
