async function editCard () {
  // Initialize the Square Payments object with your application ID and the ID of the seller location where the payment is taken.
  let _payments = Square.payments(window.applicationId, window.locationId)
  // Get a new Card object
  // This creates a new Card instance with all of the behaviors and properties needed to take a card payment.
  let _card = await _payments.card()
  // Attach the Card instance to a DOM element
  // Attach the Card instance to an empty DOM element on your page. The payment card form renders into the empty element, turning it into a secure payment card form.
  //take svg
  let cont = document.getElementById('card-container')
  let svg = cont.innerHTML
  cont.innerHTML = ''
  await _card.attach('#card-container')
  // Get the payment token
  // Get the payment form token from the Card instance when the buyer completes the form by calling the tokenize method.
  async function eventHandler (event) {
    event.preventDefault()
    let statusContainer = document.getElementById('payment-status-container')

    try {
      let result = await _card.tokenize()
      //   console.log(result)

      if (result.status === 'OK') {
        // console.log(`Payment token is ${result.token}`)
        statusContainer.innerHTML = svg
        //here we use ajax to send data to the backend
        // console.log(result)
        let data = {
          response: JSON.stringify(result),
          add_cards: true
        }

        $.ajax({
          url: $('#base_path').val() + 'plugins/square/card_validation.php',
          type: 'POST',
          timeout: 30000,
          data: data,
          success: function (site_response) {
            // console.log(site_response)
            eval(site_response)
          },
          error: function (a, b, c) {
            alert('Something is not right')
          }
        })
      } else {
        statusContainer.innerHTML = 'Payment Failed'
      }
    } catch (e) {
      //   console.error(e)
      statusContainer.innerHTML = 'Payment Failed'
    }
  }

  let cardButton = document.getElementById('_card-button')
  cardButton.addEventListener('click', eventHandler)
}
