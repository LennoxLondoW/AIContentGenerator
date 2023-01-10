var shapeEls, triangleEl, trianglePoints, easings

function animateShape (el) {
  var circleEl = el.querySelector('circle')
  var rectEl = el.querySelector('rect')
  var polyEl = el.querySelector('polygon')

  function createKeyframes (total, min, max, unit) {
    var keyframes = []
    var unit = unit || 0
    for (var i = 0; i < total; i++)
      keyframes.push({
        value: function () {
          return anime.random(min, max) + unit
        }
      })
    return keyframes
  }

  function createKeyframes (value) {
    var keyframes = []
    for (var i = 0; i < 30; i++)
      keyframes.push({
        value: value
      })
    return keyframes
  }

  var animation = anime
    .timeline({
      targets: el,
      duration: function () {
        return anime.random(800, 2000)
      },
      easing: function () {
        return easings[anime.random(0, easings.length - 1)]
      },
      complete: function (anim) {
        animateShape(anim.animatables[0].target)
      }
    })
    .add(
      {
        translateX: createKeyframes(function () {
          return anime.random(-4, 4) + 'rem'
        }),
        translateY: createKeyframes(function () {
          return anime.random(-4, 4) + 'rem'
        }),
        rotate: createKeyframes(function () {
          return anime.random(-180, 180)
        })
      },
      0
    )
  if (circleEl) {
    animation.add(
      {
        targets: circleEl,
        r: createKeyframes(function () {
          return anime.random(12, 28)
        })
      },
      0
    )
  }
  if (rectEl) {
    animation.add(
      {
        targets: rectEl,
        width: createKeyframes(function () {
          return anime.random(28, 48)
        }),
        height: createKeyframes(function () {
          return anime.random(28, 48)
        })
      },
      0
    )
  }
  if (polyEl) {
    animation.add(
      {
        targets: polyEl,
        points: createKeyframes(function () {
          var scale = anime.random(32, 74) / 100
          return trianglePoints
            .map(function (p) {
              return p * scale
            })
            .join(' ')
        })
      },
      0
    )
  }
}
