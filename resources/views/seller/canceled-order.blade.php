@extends('layout/app')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/sidebar.css')}}">
<link rel="stylesheet" href="{{ asset('assets/css/canceled-order.css')}}">
@endsection

@section('content')
@include('components.sidebar')
<div class="contents">
    <div class="sub-content">
        <a href="{{ route('upcoming') }}">Upcoming Orders</a>
        <a href="{{ route('processed') }}">Processed Orders</a>
        <a href="{{ route('completed') }}">Completed Orders</a>
        <a href="{{ route('canceled') }}">Canceled Orders</a>
    </div>

    <div class="content-tabs">
        <table border="1px solid black">
            <tr>
                <th style="width: 70px;">No</th>
                <th style="text-align: start;">Product</th>
                <th >Order ID</th>
                <th>Customer Name</th>
                <th style="width: 100px;">Quantity</th>
                <th>Type</th>
                <th></th>
            </tr>
            <tr>
                <td  style="width: 100px;">1</td>
                <td style="display: flex; gap:20px; text-align: start; width: 250px;">
                    <img src="assets/web3.jpg" alt="">
                    <div class="prod-details" style="line-height: 14px;">
                        <p>Product Name</p>
                        <p>19 - 11 - 22</p>
                        <p>Rp.999.999</p>
                    </div>
                </td>
                <td style="width: 110px;">001</td>
                <td style="width: 250px;">User Agus</td>
                <td style="width: 120px;">2</td>
                <td style="width: 100px;"><p id="label-order"  style="margin-top: 10px;">Software</p></td>
                <td style="width: 180px;">
                    <button  onclick="On_klik(this.id)" id="refund" style="font-weight:600;" >Refund</button>
                </td>
            </tr>
             <tr>
                <td  style="width: 90px;">1</td>
                <td style="display: flex; gap:20px; text-align: start; width: 250px;">
                    <img src="assets/web3.jpg" alt="">
                    <div class="prod-details" style="line-height: 14px;">
                        <p>Product Name</p>
                        <p>19 - 11 - 22</p>
                        <p>Rp.999.999</p>
                    </div>
                </td>
                <td style="width: 70px;">001</td>
                <td style="width: 180px;">User Agus</td>
                <td style="width: 100px;">2</td>
                <td style="width: 70px;"><p id="label-order" style="margin-top: 10px;">Software</p></td>
                <td style="width: 150px;">
                  <button  onclick="On_klik(this.id)" id="refund" style="font-weight:600;">Refund</button>
                </td>
            </tr>
            <tr>
                <td  style="width: 90px;">1</td>
                <td style="display: flex; gap:20px; text-align: start; width: 250px;">
                    <img src="assets/web3.jpg" alt="">
                    <div class="prod-details" style="line-height: 14px;">
                        <p>Product Name</p>
                        <p>19 - 11 - 22</p>
                        <p>Rp.999.999</p>
                    </div>
                </td>
                <td style="width: 70px;">001</td>
                <td style="width: 180px;">User Agus</td>
                <td style="width: 100px;">2</td>
                <td style="width: 70px;"><p id="label-order" style="margin-top: 10px;">Software</p></td>
                <td style="width: 150px;">
                  <button  onclick="On_klik(this.id)" id="refund" style="font-weight:600;">Refund</button>
                </td>
            </tr>
            <tr>
                <td  style="width: 90px;">1</td>
                <td style="display: flex; gap:20px; text-align: start; width: 250px;">
                    <img src="assets/web3.jpg" alt="">
                    <div class="prod-details" style="line-height: 14px;">
                        <p>Product Name</p>
                        <p>19 - 11 - 22</p>
                        <p>Rp.999.999</p>
                    </div>
                </td>
                <td style="width: 70px;">001</td>
                <td style="width: 180px;">User Agus</td>
                <td style="width: 100px;">2</td>
                <td style="width: 70px;"><p id="label-order" style="margin-top: 10px;">Software</p></td>
                <td style="width: 150px;">
                    <button  onclick="On_klik(this.id)" id="refund" style="font-weight:600;">Refund</button>
                </td>
            </tr>
        </table>
    </div>
</div>
<div id="myForm" class="modalform">
    <div class="modalform-content">
        <div class="header">
            <span class="close close-form">&times;</span>
        </div>
        <div class="refund-content">
            <div class="warning-alert">
                <iconify-icon icon="material-symbols:info-rounded" style="font-size: 20px; color: #233874;"></iconify-icon>
                <p>Your money will not necessarily return with this refund, it needs approval in accordance with the applicable rules and conditions.</p>
            </div>
            <div class="form-refund">
                <form action="">
                    <div class="name">
                        <p>1. Full Name</p>
                        <div class="full-name">
                            <div class="first-name">
                                <label for="firstname">First Name</label>
                                <input type="text" placeholder="First Name">
                            </div>
                            <div class="last-name">
                                <label for="lastname">Last Name</label>
                                <input type="text" placeholder="Last Name">
                            </div>    
                        </div>
                    </div>
                    <div class="email">
                        <p>2. Email</p>
                        <input type="text" placeholder="Email">
                        <p>This email will recieve refund status</p>
                    </div>
                    <div class="product-name">
                        <p>3. Product Name</p>
                        <input type="text" placeholder="Product Name">
                    </div>
                    <div class="product-id">
                        <p>4. Product Id</p>
                        <input type="text" placeholder="Product Id">
                    </div>
                    <div class="invoice-number">
                        <p>5. Invoice Number</p>
                        <input type="text" placeholder="Invoice Number">
                    </div>
                    <div class="product-pict">
                        <p>6. Product Image</p>
                        <input type="file" name="" id="">
                        <p>*if Your product is an hardware type</p>
                    </div>
                    <div class="massage">
                        <p>Additional Notes</p>
                        <textarea name="" id="" cols="30" rows="10"></textarea>
                    </div>
                    <div class="checked">
                        <input type="checkbox" name="check" id="check">
                        <label for="check">I agree the refunded money to be sent back to the account that I previously paid</label>
                    </div>
                    <div class="btn-form">
                        <button>submit</button>
                    </div>
                </form>    
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/form-review.js')}}"></script>

@endsection