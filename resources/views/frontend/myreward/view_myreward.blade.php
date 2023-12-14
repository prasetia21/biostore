@extends('frontend.master_dashboard')
@section('main')
@section('title')
    MyReward Page
@endsection

<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> Reward
        </div>
    </div>
</div>
<div class="container mb-80 mt-50">
    <div class="row">
        <div class="col-lg-8 mb-40">
            <h4 class="heading-2 mb-10">Your Reward</h4>
            <div class="d-flex justify-content-between">
                <h6 class="text-body">There are rewards to rendeem</h6>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive shopping-summery">
                <table class="table table-wishlist">
                    <thead>
                        <tr class="main-heading">
                            <th class="custome-checkbox start pl-30">

                            </th>
                            <th scope="col" colspan="2">Reward</th>
                            <th scope="col">Rendeem Point</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">My BioPoint</th>
                            <th scope="col" class="end">Remove</th>
                        </tr>
                    </thead>
                    <tbody id="rendeemPage">


                    </tbody>
                </table>
            </div>


            <div class="row mt-50">
                <div class="col-lg-7">
                    <div class="divider-2 mb-30"></div>



                    <div class="border p-md-4 cart-totals ml-30">
                        <div class="table-responsive">
                            <table class="table no-border">
                                <tbody id="couponCalField">



                                </tbody>
                            </table>
                        </div>
                        <a href="{{ route('checkout-rendeem') }}" class="btn mb-20 w-100">Proceed To CheckOut<i
                                class="fi-rs-sign-out ml-15"></i></a>
                    </div>
                </div>



            </div>
        </div>

    </div>
</div>




@endsection
