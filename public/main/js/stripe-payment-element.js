let public_key=$("#payment-form").data('public')
let stripe = Stripe(public_key);
let elements = stripe.elements();
const cardButton = document.getElementById('card-button');
const clientSecret = cardButton.dataset.secret;
const url = cardButton.dataset.url;

const form=new FormData();


let card = elements.create('cardNumber');
let exp = elements.create('cardExpiry');
let cvc = elements.create('cardCvc');

card.mount("#cardNumber");
exp.mount("#cardExp")
cvc.mount("#cardCVC");
cardButton.addEventListener('click', async (e) => {
    e.preventDefault();
    const is_default=$('.default_payment_method').val();

    const { setupIntent, error } = await stripe.confirmCardSetup(
        clientSecret, {
            payment_method: {
                card,
            }
        }
    );
    $("#payment-error").text("");
    if (error) {
        console.log(error)
        $("#payment-error").text(error.message)
    } else {
        form.append('payment_method',setupIntent.payment_method)
        form.append('is_default',is_default);

        $.ajax({
            url: url,
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
            }
        });
        // The card has been verified successfully...
    }
});
