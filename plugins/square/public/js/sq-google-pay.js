async function GooglePay(buttonEl) {
  let _____paymentRequest = window.payments.paymentRequest(
    // Use global method from sq-payment-flow.js
    window.getPaymentRequest()
  );
  let googlePay = await payments.googlePay(_____paymentRequest);
  await googlePay.attach(buttonEl);

  async function eventHandler(event) {
    // Clear any existing messages
    window.paymentFlowMessageEl.innerText = '';

    try {
      let ______result = await googlePay.tokenize();
      if (______result.status === 'OK') {
        // Use global method from sq-payment-flow.js
        window.createPayment(______result.token);
      }
    } catch (e) {
      if (e.message) {
        window.showError(`Error: ${e.message}`);
      } else {
        window.showError('Something went wrong');
      }
    }
  }

  buttonEl.addEventListener('click', eventHandler);
}
