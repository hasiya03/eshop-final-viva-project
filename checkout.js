// This is your test publishable API key.
const stripe = Stripe("pk_test_51PLVTDFCE9FRCBdhY6l5nfYBceTnqv7OYaowCUQVUmyQvzBNia7v18237FIDAt3joZgBeRYakFWVpOsSS79eIwNP00xHpgK9RP");

document.getElementById('checkout-form').addEventListener('submit', async (event) => {
    event.preventDefault();

    const form = event.target;
    const shipping_option = form.querySelector('select[name="shipping_option"]').value;
    const code = form.querySelector('input[name="code"]').value;

    const response = await fetch("create_checkout_session.php", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            shipping_option: shipping_option,
            code: code
        })
    });

    const session = await response.json();

    if (session.error) {
        console.error(session.error);
        alert('Error creating Stripe Checkout session: ' + session.error);
        return;
    }

    const { sessionId } = session;
    stripe.redirectToCheckout({ sessionId });
});
