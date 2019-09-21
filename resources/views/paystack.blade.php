@extends('layouts.app')


@section('content')


<form>
<div class="text-center p-4">
<button type="button" class="btn btn-primary btn-lg" onclick="payWithPaystack()"> Pay Now</button>
</div>

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
Toast.fire({
type: 'success',
title: 'Transaction successful'
})

setTimeout(() => {
location.assign('/pay/verify?reference=' +response.reference);
}, 3000);

},
onClose: function(){
Toast.fire({
type: 'warning',
title: 'Transaction Terminated'
})
}
});
handler.openIframe();
}
</script>

@endpush

@endsection
