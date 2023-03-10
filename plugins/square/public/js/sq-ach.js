async function ACHPay(buttonEl) {
  let accountHolderNameEl = document.getElementById('ach-account-holder-name');
  let achMessageEl = document.getElementById('ach-message');
  let achWrapperEl = document.getElementById('ach-wrapper');

  let ach;
  try {
    ach = await window.payments.ach();
    achWrapperEl.style.display = 'block';
  } catch (e) {
    // If the ACH payment method is not supported by your account then
    // do not enable the #ach-account-holder-name input field
    if (e.name === 'PaymentMethodUnsupportedError') {
      achMessageEl.innerText = 'ACH payment is not supported by your account';
      accountHolderNameEl.disabled = true;
    }

    // if we can't load ACH, we shouldn't bind events for the button
    return;
  }

  async function eventHandler(event) {
    let accountHolderName = accountHolderNameEl.value.trim()
    if (accountHolderName === '') {
      achMessageEl.innerText = 'Please input full name';
      return;
    }

    // Clear any existing messages
    window.paymentFlowMessageEl.innerText = '';

    try {
      let __result = await ach.tokenize({
        accountHolderName,
      });
      if (__result.status === 'OK') {
        // Use global method from sq-payment-flow.js
        window.createPayment(__result.token);
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
