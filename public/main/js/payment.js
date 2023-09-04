let public_key=$("#payment-form").data('public')
let stripe = Stripe(public_key);
let elements = stripe.elements();
const cardButton = document.getElementById('card-button');
const clientSecret = cardButton.dataset.secret;
const selected_payment_method=$(".payment_method_id");

let card = elements.create('cardNumber');
let exp = elements.create('cardExpiry');
let cvc = elements.create('cardCvc');

card.mount("#cardNumber");
exp.mount("#cardExp")
cvc.mount("#cardCVC");


cardButton.addEventListener('click', async (e) => {
    e.preventDefault();
    if ($(selected_payment_method).val().length>0){
        createPaymentIntent($(selected_payment_method).val())
    }else{
        const { setupIntent, error } = await stripe.confirmCardSetup(
            clientSecret, {
                payment_method: {
                    card,
                }
            }
        );

        if (error) {
            console.log(error,'error')
            if(error.message === "Номер карты неполон.") error.message = "Card number is incomplete."

            $("#error-message").text(error.message)
            
            // Display "error.message" to the user...
        } else {
            createPaymentIntent(setupIntent.payment_method)
            // The card has been verified successfully...
        }
    }

    function createPaymentIntent(payment_method){
        const form=new FormData();
        form.append('payment_method',payment_method)


        $.ajax({
            url: window.location.href,
            method: 'POST',
            data: form,
            dataType: 'JSON',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            contentType: false,
            cache: false,
            processData: false,
            success:function(response)
            {
                window.location.href=response.data.url;
            },
            error: function(response) {
                console.log(response,'error')
            }
        });
    }
});
