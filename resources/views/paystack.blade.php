@extends('layouts.app')


@section('content')


<form>
    <button type="button" onclick="payWithPaystack()"> Pay </button>
  </form>
@push('script')
<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
    function payWithPaystack(){
      var handler = PaystackPop.setup({
        key: '{{env('PAYSTACK_PUBLIC_KEY')}}',
        email: 'bencoderus@gmail.com',
        amount: 10000,
        currency: "NGN",
        ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
        metadata: {
           custom_fields: [
              {
                  display_name: "Mobile Number",
                  variable_name: "mobile_number",
                  value: "+2348012345678"
              }
           ]
        },
        callback: function(response){
          location.assign('/pay/verify?reference=' +response.reference);
        },
        onClose: function(){
            alert('window closed');
        }
      });
      handler.openIframe();
    }
  </script>

@endpush

@endsection
