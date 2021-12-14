<script>
    const paymentForm = document.getElementById('paymentForm');
    paymentForm.addEventListener("submit", payWithPaystack, false);

    function payWithPaystack(e) {
        e.preventDefault();
        let handler = PaystackPop.setup({
            key: '{{ env("PAYSTACK_KEY") }}', // Replace with your public key
            email: document.getElementById("email-address").value,
            amount: document.getElementById("amount").value * 100,
            ref: '' + Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
            // label: "Optional string that replaces customer email"
            onClose: function() {
                alert('Window closed.');
            },
            callback: function(response) {
                let message = 'Payment complete! Reference: ' + response.reference;
                // alert(message);
                save(response.reference, amount.value)
                window.location.href = "{{ route('user.payment.history') }}"
            }
        });
        handler.openIframe();
    }

    function save(ref, amount) {
        console.log(ref)
        var url = "{{ route('user.save.payment') }}"
        var datas = {
            '_token': "{{ csrf_token() }}",
            'ref': ref,
            'amount': amount
        }
        $.ajax({
            type: "POST",
            url: url,
            data: datas, // serializes the form's elements.
            success: function(data) {
                console.log(data); // show response from the php script.
            }
        });
    }
</script>