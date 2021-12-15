<script>
    const paymentForm = document.getElementById('paymentForm');
    paymentForm.addEventListener("submit", payWithPaystack, false);

    const paymentForm2 = document.getElementById('paymentForm2');
    paymentForm2.addEventListener("submit", payWithPaystack2, false);

    function payWithPaystack(e) {
        e.preventDefault();
        var book_id = document.getElementById("book_id").value
        let handler = PaystackPop.setup({
            key: '{{ env("PAYSTACK_KEY") }}', // Replace with your public key
            email:  '{{ Auth::user()->email }}',
            amount: document.getElementById("amount").value * 100,
            ref: '' + Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
            // label: "Optional string that replaces customer email"
            onClose: function() {
                alert('Window closed.');
            },
            callback: function(response) {
                let message = 'Payment complete! Reference: ' + response.reference;
                // alert(message);
                save(response.reference, amount.value, document.getElementById("type").value, book_id)
                window.location.href = "{{ route('user.payment.history') }}"
            }
        });
        handler.openIframe();
    }

    function payWithPaystack2(e) {
        e.preventDefault();
        var amount = '{{ env("BOOKRENT") }}'
        var book_id = document.getElementById("book_id").value
        let handler = PaystackPop.setup({
            key: '{{ env("PAYSTACK_KEY") }}', // Replace with your public key
            email: '{{ Auth::user()->email }}',
            amount: amount * 100,
            ref: '' + Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
            // label: "Optional string that replaces customer email"
            onClose: function() {
                alert('Window closed.');
            },
            callback: function(response) {
                let message = 'Payment complete! Reference: ' + response.reference;
                // alert(message);
                save(response.reference, amount, 'Rent', book_id)
                window.location.href = "{{ route('user.payment.history') }}"
            }
        });
        handler.openIframe();
    }

    function save(ref, amount, type, book_id) {
        console.log(ref)
        var url = "{{ route('user.save.payment') }}"
        var datas = {
            '_token': "{{ csrf_token() }}",
            'ref': ref,
            'amount': amount,
            'book_id': book_id,
            'type': type
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