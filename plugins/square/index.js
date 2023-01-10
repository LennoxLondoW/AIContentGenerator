// here we determine which module to be loaded
function squareFunctions () {
  if (document.getElementById('card_validate') !== null) {
    // load the validate card module
    loadJS(
      $('#base_path').val() + 'plugins/square/public/js/card_validate.js',
      (callback = 'editCard();'),
      (attributes = {
        type: 'text/javascript',
        async: false
      })
    )

    return
  }

  window_functions()

  // apple payment
  if (document.getElementById('apple-pay-button') !== null) {
    // load the validate card module
    loadJS(
      $('#base_path').val() + 'plugins/square/public/js/sq-apple-pay.js',
      (callback = 'loadFlowFile("apple");'),
      (attributes = {
        type: 'text/javascript',
        async: false
      })
    )
  }
  // google payment
  if (document.getElementById('google-pay-button') !== null) {
    // load the validate card module
    loadJS(
      $('#base_path').val() + 'plugins/square/public/js/sq-google-pay.js',
      (callback = 'loadFlowFile("google");'),
      (attributes = {
        type: 'text/javascript',
        async: false
      })
    )
  }

  // ach payment
  if (document.getElementById('ach-account-holder-name') !== null) {
    // load the validate card module
    loadJS(
      $('#base_path').val() + 'plugins/square/public/js/sq-ach.js',
      (callback = 'loadFlowFile("ach");'),
      (attributes = {
        type: 'text/javascript',
        async: false
      })
    )
  }

  // card payment
  if (document.getElementById('card-button') !== null) {
    // load the validate card module
    loadJS(
      $('#base_path').val() + 'plugins/square/public/js/sq-card-pay.js',
      (callback = `
        CardPay(
          document.getElementById('card-container'),
          document.getElementById('card-button')
        )
      `),
      (attributes = {
        type: 'text/javascript',
        async: false
      })
    )
  }
}

function loadFlowFile (file) {
  // console.log(file)
  loadJS(
    $('#base_path').val() + 'plugins/square/public/js/sq-payment-flow.js',
    (callback = 'SquarePaymentFlow("' + file + '");'),
    (attributes = {
      type: 'text/javascript',
      async: false
    })
  )
}

//load the sdk url
function loadSDK () {
  // swt the global variables from the env file
  window.applicationId = $('#applicationId').val()
  window.locationId = $('#locationId').val()
  window.currency = $('#currency').val()
  window.country = $('#country').val()
  window.idempotencyKey = $('#idempotencyKey').val()
  window.applicationId = $('#applicationId').val()
  // we load the sdk // either sand box or live url
  loadJS(
    $('#web_payment_sdk_url').val(),
    (callback = 'squareFunctions();'),
    (attributes = {
      type: 'text/javascript',
      async: false
    })
  )
}

function window_functions () {
  // window variables
  window.payments = Square.payments(window.applicationId, window.locationId)
  window.showSuccess = function (message) {
    window.paymentFlowMessageEl.classList.add('success')
    window.paymentFlowMessageEl.classList.remove('error')
    window.paymentFlowMessageEl.innerText = message
  }

  window.showError = function (message) {
    window.paymentFlowMessageEl.classList.add('error')
    window.paymentFlowMessageEl.classList.remove('success')
    window.paymentFlowMessageEl.innerText = message
  }

  window.createPayment = async function (token) {
    let dataJsonString = JSON.stringify({
      token,
      idempotencyKey: window.idempotencyKey,
      amount: $('#card_amount').val(),
      account_id: $('#account_id').val()
    })

    try {
      let SVG = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 4335 4335" width="100" height="100">
      <path fill="#008DD2" d="M3346 1077c41,0 75,34 75,75 0,41 -34,75 -75,75 -41,0 -75,-34 -75,-75 0,-41 34,-75 75,-75zm-1198 -824c193,0 349,156 349,349 0,193 -156,349 -349,349 -193,0 -349,-156 -349,-349 0,-193 156,-349 349,-349zm-1116 546c151,0 274,123 274,274 0,151 -123,274 -274,274 -151,0 -274,-123 -274,-274 0,-151 123,-274 274,-274zm-500 1189c134,0 243,109 243,243 0,134 -109,243 -243,243 -134,0 -243,-109 -243,-243 0,-134 109,-243 243,-243zm500 1223c121,0 218,98 218,218 0,121 -98,218 -218,218 -121,0 -218,-98 -218,-218 0,-121 98,-218 218,-218zm1116 434c110,0 200,89 200,200 0,110 -89,200 -200,200 -110,0 -200,-89 -200,-200 0,-110 89,-200 200,-200zm1145 -434c81,0 147,66 147,147 0,81 -66,147 -147,147 -81,0 -147,-66 -147,-147 0,-81 66,-147 147,-147zm459 -1098c65,0 119,53 119,119 0,65 -53,119 -119,119 -65,0 -119,-53 -119,-119 0,-65 53,-119 119,-119z" />
    </svg>`

      window.paymentFlowMessageEl.innerHTML = SVG
      let response = await fetch(
        $('#base_path').val() + 'plugins/square/process-payment.php',
        {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: dataJsonString
        }
      )

      // console.log(response)

      let data = await response.json()
      // console.log(data)

      if (data.errors && data.errors.length > 0) {
        if (data.errors[0].detail) {
          window.showError(data.errors[0].detail)
        } else {
          window.showError('Payment Failed.')
        }
      } else {
        window.showSuccess('Payment Successful!')
      }
    } catch (error) {
      console.error('Error:', error)
    }
  }
}

// Hardcoded for testing purpose, only used for Apple Pay and Google Pay
window.getPaymentRequest = function () {
  return {
    countryCode: window.country,
    currencyCode: window.currency,
    lineItems: [
      { amount: '1.23', label: 'Cat', pending: false },
      { amount: '4.56', label: 'Dog', pending: false }
    ],
    requestBillingContact: false,
    requestShippingContact: true,
    shippingContact: {
      addressLines: ['123 Test St', ''],
      city: 'San Francisco',
      countryCode: 'US',
      email: 'test@test.com',
      familyName: 'Last Name',
      givenName: 'First Name',
      phone: '1111111111',
      postalCode: '94109',
      state: 'CA'
    },
    shippingOptions: [
      { amount: '0.00', id: 'FREE', label: 'Free' },
      { amount: '9.99', id: 'XP', label: 'Express' }
    ],
    total: { amount: '1.00', label: 'Total', pending: false }
  }
}
