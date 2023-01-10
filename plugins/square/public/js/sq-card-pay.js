async function CardPay (fieldEl, buttonEl) {
  // Create a card payment object and attach to page
  let _____card____ = await window.payments.card({
    style: {
      '.input-container.is-focus': {
        borderColor: '#006AFF'
      },
      '.message-text.is-error': {
        color: '#BF0020'
      }
    }
  })

  fieldEl.innerHTML = ''
  await _____card____.attach(fieldEl)

  async function eventHandler (event) {
    // Clear any existing messages
    window.paymentFlowMessageEl.innerText = ''

    try {
      let ____result___ = await _____card____.tokenize()
      if (____result___.status === 'OK') {
        // Use global method from sq-payment-flow.js
        window.createPayment(____result___.token)
      }
    } catch (e) {
      if (e.message) {
        window.showError(`Error: ${e.message}`)
      } else {
        window.showError('Something went wrong')
      }
    }
  }
  window.paymentFlowMessageEl = document.getElementById('payment-flow-message')
  buttonEl.addEventListener('click', eventHandler)
}


