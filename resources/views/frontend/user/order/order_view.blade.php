@extends('frontend.main_master')
@section('content')
<div class="body-content">
    <div class="container">
        <div class="row">
            @include('frontend.common.user_sidebar')
            {{-- end col --}}
            <div class="col-md-2"></div>
            {{-- end col --}}
            <div class="col-md-10 mt-1">
               <div class="table-responsive">
                   <table class="table">
                       <tbody>
                           <tr style="background-color: #e2e2e2;">
                               <td class="col-md-1">
                                   <label for="">Date</label>
                               </td>
                               <td class="col-md-3">
                                    <label for="">Total</label>
                                </td>

                                <td class="col-md-3">
                                    <label for="">Payment Method</label>
                                </td>
                                <td class="col-md-2">
                                    <label for="">Invoice</label>
                                </td>

                                <td class="col-md-2">
                                    <label for="">Order</label>
                                </td>


                                <td class="col-md-1">
                                    <label for="">Actions</label>
                                </td>

                           </tr>

                           @foreach($orders as $order)
                           <tr>
                            <td class="col-md-3">
                                <label for="">{{$order->order_date}}</label>
                            </td>
                            <td class="col-md-1">
                                 <label for="">${{$order->amount}}</label>
                             </td>

                             <td class="col-md-1">
                                <label for="">{{$order->payment_method}}</label>
                            </td>

                             <td class="col-md-2">
                                 <label for="">{{$order->invoice_no}}</label>
                             </td>

                             <td class="col-md-1">
                                 <span class='badge badge-pill badge-warning' style='background: #418DB9;'>
                                  {{$order->status}}
                                 </span>
                
                            </td>

                             <td class="col-md-3">
                                 <div class="row">
                                        <a href="{{url('user/order_details/'.$order->id)}}" class='btn btn-sm btn-primary'><i class="fa fa-eye"></i></a>
                                        <a href="" class='btn btn-sm btn-danger'><i class="fa fa-download"></i></a>
                                 </div>
            
                             </td>

                        </tr>
                        @endforeach
                       </tbody>
                   </table>
               </div>


            </div>
            {{-- end col --}}
        </div>  
        {{-- end row --}}
    </div>
</div>

@endsection