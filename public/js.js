function errors(jqXHR, exception, container, pre_data = null, callback = null) {
    var msg = "";
    if (jqXHR.status === 0) {
        msg = 'Connection Problem';
        $("#app").html("<h3 align='center'>Internet connection lost</h3>");
    } else if (jqXHR.status == 404) {
        msg = 'Requested page not found. [404]';
    } else if (jqXHR.status == 500) {
        /*msg = 'Internal Server Error [500].';*/
        var responseText2 = jQuery.parseJSON(jqXHR.responseText);
        msg = 'Error (500): ' + responseText2.message + "<br>";
        msg += 'Line: ' + responseText2.line + "<br>";
        $.each(responseText2.errors, function (value, index) {
            var errorarray = eval('responseText.errors.' + value);
            $.each(errorarray, function (value1, index1) {
                msg += value + ": " + index1 + "<br>";
                $('input[name="' + value + '"], select[name="' + value + '"], textarea[name="' + value + '"]').css('border', '1px solid red').parent('.input-field').find('.helper-text').attr('data-error', index1);
            })
        });
    } else if (exception === 'parsererror') {
        msg = 'Requested JSON parse failed.';
    } else if (exception === 'timeout') {
        msg = 'Time out error.';
    } else if (exception === 'abort') {
        msg = 'Ajax request aborted.';
    } else {
        var responseText = jQuery.parseJSON(jqXHR.responseText);
        var num = 1;
        $.each(responseText.errors, function (value, index) {
            var errorarray = eval('responseText.errors.' + value);
            $.each(errorarray, function (value1, index1) {
                msg += num++ + " . " + index1 + "\n";
                $('input[name="' + value + '"]').addClass('invalid').parent('.input-parent').find('.validation-message').html('<small class="text-danger">' + index1 + '</small>');
            })
        });
    }
    if (pre_data != null) {
        $(container).html(pre_data).removeAttr('disabled');
    }
    if (callback != null) {
        callback(msg);
    }
    return msg;
}

document.addEventListener("turbolinks:load", function () {
    $('#scroll').height(screen.height+'px');
    $(".aem-sidebar-items").find('.active').parent('ul').show();
    var paretns = $('.aem-sidebar-items .active').parents('ul');
    var paretns2 = $('.active').parents('li').find('.parent').addClass('lactive');
    $.map(paretns, function (one, two) {
        $(one).show();
    }); $('#loading').html(aem.loading());
});
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#image').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}

$("#img_input").change(function () {
    readURL(this);
    $("#update_btn").slideDown();
});
var aem = {
    showElement: function (element) {
        $(element).slideDown();
    },
    hideElement: function (element) {
        $(element).slideUp();
    },
    toggleElemnt: function (event, element) {
        typeof ($(event.target).attr('class')) != "undefined" ? $(event.target).toggleClass('lactive') : $(event.target).find('i').toggleClass('lactive');
        $(element).slideToggle();
    },
    collapseSidebar: function () {
        $('.aem-sidebar').toggleClass('aem-collapse').show();
        $('#content').toggleClass('pl-0');
    },
    _delete: function (event,message=null) {
        event.preventDefault();
        swal({
            icon: 'info',
            title: 'Are you sure',
            text: message,
            buttons: true
        }).then((result) => {
            if (result) {
                window.location.href =  $(event.target).attr('href')  ;
            }
        });
    },
    loading: function () {
        return `
            <div class="center">
                <div class="preloader-wrapper small active">
                <div class="spinner-layer spinner-green-only">
                  <div class="circle-clipper left">
                    <div class="circle"></div>
                  </div><div class="gap-patch">
                    <div class="circle"></div>
                  </div><div class="circle-clipper right">
                    <div class="circle"></div>
                  </div>
                </div>
            </div>
        `;
    },
    modal: function (event,route) {
        var models = $('.modal');
        $.map(models, function (one, two) {
            $(one).remove();
        });
        var url = route != null?route:$(event.target).data('url');
        var modal = document.createElement("div");
        modal.setAttribute('class', 'modal');
        modal.setAttribute('id', 'ajax_modal');
        modal.innerHTML = `
            <div class="modal-content" id="ajax_modal_content">
                ${aem.loading()}
            </div>
        `;
        $('body').append(modal);
        $('.modal').modal();
        var instance = M.Modal.getInstance($('#ajax_modal'));
        instance.open();

        $.ajax({
            url: url,
            method: 'GET',
            cache: false,
            contentType: "application/json; charset=utf-8",
            datatype: "json",
            success: function (data) {
                $("#ajax_modal").html(data);
                M.updateTextFields();
                $('select').formSelect();
            },
            error: function () {
                instance.close();
                M.toast({
                    html: 'Someting went wrong please try again',
                    classes: 'red rounded'
                });
            }
        });


    },
    confirmForm: function (event, message = null, form=true) {
        event.preventDefault()
        swal({
            icon: 'info',
            title: 'Are you sure',
            text: message,
            buttons: true
        }).then((result) => {
            if (result) {
                if (form) {
                    $(event.target).parent('form').submit();
                } else {
                    window.location.href = $(event.target).attr('href');

                }
            }
        });
    },
    request: function (loading_area, url, method, data, target, type = "ajax", callback = null) {
        var default_loading_area = $(loading_area).html();
        $(loading_area).html(aem.loading()).prop('disabled', true);
        $('input').removeClass('invalid');
        $('.validation-message').html('');
        $.ajax({
            url: url,
            method: method,
            data: data,
            success: function (response) {
                $(target).html(response);
            },
            error: function (one, two) {
                swal({
                    title: 'Something went wrong',
                    text: errors(one, two),
                    icon: 'error'
                });
                $(loading_area).html(default_loading_area).removeAttr('disabled');
            }
        });
    },
    spinner: function(){
        `<span class="spinner-border spinner-border-sm"></span>`;
    },
    loading2: function (size,margin_top=0) {
        var sizeing = size+"px";
        return '<div style="text-align: center;"><div class="spinner2" style="width: '+sizeing+'; margin-top: '+margin_top+'">\n' +
            '\t  <svg viewBox="0 0 100 100">\n' +
            '\t    <circle cx="50" cy="50" r="20" />\n' +
            '\t  </svg>\n' +
            '\t</div></div>';
    },
    exportTableToExcel: function (tableID, filename = ''){
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var tableSelect = document.getElementById(tableID);
        var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

        // Specify file name
        filename = filename?filename+'.xls':'excel_data.xls';

        // Create download link element
        downloadLink = document.createElement("a");

        document.body.appendChild(downloadLink);

        if(navigator.msSaveOrOpenBlob){
            var blob = new Blob(['\ufeff', tableHTML], {
                type: dataType
            });
            navigator.msSaveOrOpenBlob( blob, filename);
        }else{
            // Create a link to the file
            downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

            // Setting the file name
            downloadLink.download = filename;

            //triggering the function
            downloadLink.click();
        }
    },
    createPDF: function(id){
        var sTable = document.getElementById(id).innerHTML;

        var style = "<style>";
        style = style + "table {width: 100%;font: 17px Calibri;}";
        style = style + "table, th, td {border: solid 1px #DDD; border-collapse: collapse;";
        style = style + "padding: 2px 3px;text-align: center;}";
        style = style + "</style>";

        // CREATE A WINDOW OBJECT.
        var win = window.open('', '', 'height=700,width=700');

        win.document.write('<html><head>');
        win.document.write('<title>Profile</title>');   // <title> FOR PDF HEADER.
        win.document.write(style);          // ADD STYLE INSIDE THE HEAD TAG.
        win.document.write('</head>');
        win.document.write('<body>');
        win.document.write(sTable);         // THE TABLE CONTENTS INSIDE THE BODY TAG.
        win.document.write('</body></html>');

        win.document.close(); 	// CLOSE THE CURRENT WINDOW.

        win.print();    // PRINT THE CONTENTS.
    }
}
$('body').on('notify', function (e) {
    M.toast({
        html: e.detail.message,
        classes: e.detail.classes
    })
});
