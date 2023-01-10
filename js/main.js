// main site javascript file

function after_spa () {
  $('.mobile-menu--open').removeClass('.mobile-menu--open')
  $('.privacy')
    .find('h1, h2, h3, h4, h5, h6')
    .addClass('sz-caption wt-black text-uppercase padding-top-2')
  customIntersection('[data-bg-color]', 'change_bg')

  var current_page = document.getElementById('current_page').value
  if (current_page == 'home') {
    $(`.product-feature__text-column h1`).addClass(
      'sz-h3 wt-black product-feature__title'
    )
    $('.product-feature__text-column li').addClass('product-feature__list-item')
    // $(
    //   '.product-feature__text-column ul, .product-feature__text-column ol'
    // ).addClass('product-feature__list padding-bottom-1')

    // $('.home__register li').addClass('register__list-item')
    // $('.home__register ul, .home__register ol').addClass('register__list')

    $('.pricing-card ul, .pricing-card ol').addClass('pricing-card__list')
    shapeEls = document.querySelectorAll('.shape')
    triangleEl = document.querySelector('.layered-animations polygon')
    trianglePoints = triangleEl.getAttribute('points').split(' ')
    easings = ['easeInOutQuad', 'easeInOutCirc', 'easeInOutSine', 'spring']

    for (var i = 0; i < shapeEls.length; i++) {
      animateShape(shapeEls[i])
    }
  } else if (current_page == 'new_document') {
    new_document()
  }

  // dashboard adjusting
  setTimeout(() => {
    let h1 = $('.main-nav:first').prop('scrollHeight')
    let h2 = $(window).height()
    let h = (h1 > h2 ? h1 : h2) + 'px'

    $('.dashbard').css('height', h)
  }, 600)

  if (current_page == 'home') {
    $('.relocator').fadeIn()
  } else {
    $('.relocator').fadeOut()
  }


  
  // sqare payments
  if ($('#_square_').attr('id') !== undefined) {
    loadJS(
      $('#base_path').val() + 'plugins/square/index.js',
      (callback = 'loadSDK();'),
      (attributes = {
        type: 'text/javascript',
        async: false
      })
    )
  }
}

function before_spa () {
  $('body .mobile-menu--open').removeClass('.mobile-menu--open')
}

function change_bg (element) {
  element.style.backgroundColor = element.getAttribute('data-bg-color')
}

$(function () {
  // activate all modules after sap
  after_spa()

  $('body').on('submit', 'form.search', function (event) {
    event.preventDefault()
    $('body').find('.search_link').remove()
    $('body').append(
      `<a href="` +
        $('#base_path').val() +
        ($(this).hasClass('trash') ? 'trash/' : 'documents/') +
        `search/` +
        $('#search').val() +
        `" class="search_link"></a>`
    )
    $('.search_link:first').trigger('click')
    return false
  })

  $('body').on('click', '.butns', function () {
    var clss = $(this).hasClass('delete') ? 'form.delete' : 'form.restore'
    $(this).parents('button').find(clss).trigger('submit')
  })

  //submiting subscription form
  $('body').on('click', '.subs', function () {
    if (confirm('Subscribe to this plan?')) {
      $(this).parent().find('form:first').trigger('submit')
    }
  })

  $('body').on('click', '.relocator, .relocator2', function () {
    $('body .mobile-menu--open').removeClass('.mobile-menu--open')
    $('html,body').animate(
      {
        scrollTop: $($(this).attr('href')).offset().top
      },
      500
    )
  })
})
