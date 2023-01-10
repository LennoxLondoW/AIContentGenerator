// ai js
var steps = []
var object
$(function () {
  $('body').on('submit', 'form.user_path', function (event) {
    event.preventDefault()
    steps.push($('#_option').val())
    loop_json(object)
    return false
  })

  $('body').on('click', '.ai_path .back', function (event) {
    event.preventDefault()
    if (!$(this).hasClass('non_pop')) {
      steps.pop()
    }
    loop_json(object)
    return false
  })

  $("body").on("contextmenu", ".ctx", function(e) {
    e.preventDefault();
    $(this).find(".cover").fadeIn();
    return false;
  })

  // here this is the final submit to generate data
  $('body').on('submit', 'form.generate', function (event) {
    event.preventDefault()
    var array = JSON.parse($(this).find("[name='generator_input']:first").val())
    var output = ''
    for (var a in array) {
      // current posted value
      var val = $(this)
        .find('[name="' + a + '"]:first')
        .val()
      if (val !== '') {
        // concatinate this value to string
        output += array[a] + ' '
        // replace the placeholder with its value
        output = output.replaceAll('{' + a + '}', val)
      }
    }

    //this will generate content from the API given
    output =
      `  <div class='output'>
                            <h2>Requested Content</h2>
                            <p>` +
      output +
      ` </p>
                            <div class='nav'>
                                <form method='post' class='ai_path ajax' action=''>
                                    <textarea style='display:none;' name='genetator_instructions'>` +
      output +
      `</textarea> 
                                    <label>Enter the name to save this document(only alphabets and white space)</label>
                                    <input pattern="[a-zA-Z0-9 ]*" type='text' required name='document_name' style='background:inherit; color:inherit;border:solid .25px var(--site-primary-color);'>
                                    <label>Enter the max number of tokens to be used (Less tokens may be used)</label>
                                    <input type='number' min='0'  required name='tokens' style='background:inherit; color:inherit;border:solid .25px var(--site-primary-color);'>
                                    <a href='#' class='back non_pop'>Back</a>
                                    <input type="hidden" value="` +
      $('[name="csrf_token"]:first').val() +
      `" name="csrf_token">
                                    <input type='submit' value='Generate' name='generate'>
                                </form>
                            </div>
                        </div>`

    //loop through array to generate generator text
    $('#ai_div').html(output)

    //we need to send the request to the api using a post method
    return false
  })
})
// ai js

// AI functions
// start new document
function new_document () {
  steps = []

  try {
    object = JSON.parse($('#document_rules').html())
    loop_json(object)
  } catch (error) {
    console.log(error)
  }
}
// this function creates form based on the supplied json rules
function loop_json (object) {
  // if no path already established use the provided object else take array of that path
  // object[x][y][z] sample path
  try {
    var l = steps.length
    var current = l == 0 ? object : eval('object["' + steps.join('"]["') + '"]')
    var form =
      current.title === undefined
        ? create_form(current.form_data, l)
        : track_path(current, l)
    $('#ai_div').hide().html(form).fadeIn('slow')
  } catch (error) {
    //pop the current step on stack
    steps.pop()
    // $("#ai_div").html(error);
  }
}

// track user key inputs
function track_path (current, l) {
  var form =
    "<form method='post' class='ai_path user_path' action=''><label>" +
    current.title +
    "</label><select name='option' id='_option'>"

  for (var j in current) {
    if (j !== 'title') {
      form +=
        '<option value="' + j + '">' + j.replaceAll('_', ' ') + '</option>'
    }
  }
  form +=
    '</select>' +
    (l === 0 ? '' : "<a href='#' class='back'>Back</a>") +
    "<input type='submit' value='Submit'></form>"

  return form
}

// download txt
function download_txt (id) {
  var name = (x = prompt('Enter document name')) ? x : 'sample'
  var link = document.createElement('a')
  var content = document.getElementById(id).value
  var file = new Blob([content], {
    type: 'text/plain'
  })
  link.href = URL.createObjectURL(file)
  link.download = name + '.txt'
  link.click()
  URL.revokeObjectURL(link.href)
}

// download js
function download_pdf (id) {
  var divContents = document.getElementById(id).value.replaceAll('\n', '<br>')
  var printWindow = window.open('', '', 'height=400,width=800')
  printWindow.document.write('<html><head><title>PDF-Document</title>')
  printWindow.document.write('</head><body >')
  printWindow.document.write(divContents)
  printWindow.document.write('</body></html>')
  printWindow.document.close()
  printWindow.print()
  printWindow.document.close()

}

// this form creates a final form that will be used to generate AI content
function create_form (form_data, l) {
  var final_form = "<form method='post' class='ai_path generate' action=''>"
  for (var i in form_data) {
    // input field label
    final_form +=
      form_data[i]['label'] === ''
        ? ''
        : '<label>' + form_data[i]['label'] + '</label>'
    //form input type select
    if (form_data[i]['name'] === 'generator_input') {
      //special input for generator
      final_form +=
        "<textarea name='generator_input' style='display:none;' >" +
        JSON.stringify(form_data[i]['generator_data']) +
        '</textarea>'
    } else if (form_data[i]['type'] === 'select') {
      final_form +=
        "<select name='" +
        form_data[i]['name'] +
        "'  " +
        (form_data[i]['required']
          ? ' required="' + form_data[i]['required'] + '"'
          : '') +
        '>'
      for (var k in form_data[i]['options']) {
        final_form +=
          '<option value="' +
          form_data[i]['options'][k]['value'] +
          '">' +
          form_data[i]['options'][k]['option'] +
          '</option>'
      }

      final_form += '</select>'
    } else if (form_data[i]['type'] === 'range') {
      final_form +=
        '<div><p>' +
        form_data[i]['range'][0] +
        "</p><input onchange='$(this).parent().find(`p`).html($(this).val())' value='" +
        form_data[i]['range'][0] +
        "' min='" +
        form_data[i]['range'][0] +
        "' max='" +
        form_data[i]['range'][1] +
        "' type='range' name='" +
        form_data[i]['name'] +
        "' " +
        (form_data[i]['required']
          ? ' required="' + form_data[i]['required'] + '"'
          : '') +
        ' ></div>'
    } else {
      final_form +=
        "<input type='" +
        form_data[i]['type'] +
        "' name='" +
        form_data[i]['name'] +
        "' " +
        (form_data[i]['required']
          ? ' required="' + form_data[i]['required'] + '"'
          : '') +
        ' >'
    }
  }
  final_form +=
    (l === 0 ? '' : "<a href='#' class='back'>Back</a>") +
    "<input type='submit' value='Continue'></form>"

  return final_form
}

function copy_text () {
  // get the textarea element
  var copy = document.getElementById('document_content')

  // select the content inside the textarea
  copy.select()
  copy.focus()
  copy.setSelectionRange(0, 99999)

  // copy to the clipboard
  document.execCommand('copy')

  // alert
  document.getElementById('copy_button').innerHTML =
    'Copied <i class="fa fa-check"></i>'
}

function download_ms (element) {
  var filename = (x = prompt('Enter document name')) ? x : 'sample'
  var preHtml =
    "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Export HTML To Doc</title></head><body>"
  var postHtml = '</body></html>'
  var html =
    preHtml +
    document.getElementById(element).value.replaceAll('\n', '<br>') +
    postHtml

  var blob = new Blob(['\ufeff', html], {
    type: 'application/msword'
  })

  // Specify link url
  var url =
    'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html)

  // Specify file name
  filename = filename ? filename + '.doc' : 'document.doc'

  // Create download link element
  var downloadLink = document.createElement('a')

  document.body.appendChild(downloadLink)

  if (navigator.msSaveOrOpenBlob) {
    navigator.msSaveOrOpenBlob(blob, filename)
  } else {
    // Create a link to the file
    downloadLink.href = url
    downloadLink.setAttribute('class', 'non_spa')

    // Setting the file name
    downloadLink.download = filename

    //triggering the function
    downloadLink.click()
  }

  document.body.removeChild(downloadLink)
}
