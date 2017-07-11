/**
 * Created by BERM-PC on 25/4/2559.
 */



$(document).ready(function () {
    $.fn.serializefiles = function() {
        var obj = $(this);
        /* ADD FILE TO PARAM AJAX */
        var formData = new FormData();
        $.each($(obj).find("input[type='file']"), function(i, tag) {
            $.each($(tag)[0].files, function(i, file) {
                formData.append(tag.name, file);
            });
        });
        var params = $(obj).serializeArray();
        $.each(params, function (i, val) {
            formData.append(val.name, val.value);
        });
        return formData;
    };


    jQuery.fn.preventDoubleSubmission = function () {
        $(this).on('submit', function (e) {
            var $form = $(this);

            if ($form.data('submitted') === true) {
                // Previously submitted - don't submit again
                e.preventDefault();
            } else {
                // Mark it so that the next submit can be ignored
                $form.data('submitted', true);
            }
        });

        // Keep chainability
        return this;
    };

    jQuery.validator.addMethod("letterEnglishOnly", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9_]+$/i.test(value);
    }, "Letters is only English please");

    $('form').preventDoubleSubmission();
    
});

function showSpinner(){
    $('.loading-spinner').show();
}

function hideSpinner(){
    $('.loading-spinner').hide();
}

function clearValidation(){
    $('.form-group').removeClass('has-error')
        .removeClass('has-success');
    $('.text-danger').remove();
}


function alertSuccessMessageDialog( title ,message, callback) {
    BootstrapDialog.show({
        title: title,
        size: BootstrapDialog.SIZE_SMALL,
        closable: false,
        message: message,
        buttons: [{
            id: 'btn-ok',
            icon: 'glyphicon glyphicon-check',
            label: 'OK',
            cssClass: 'btn-primary',
            autospin: false,
            action: function (dialogRef) {
                dialogRef.close();
                if (typeof callback == "function")callback();
            }
        }]
    });
}

function alertWarningMessageDialog( title ,message, callback) {
    BootstrapDialog.show({
        title: title,
        size: BootstrapDialog.SIZE_SMALL,
        closable: false,
        message: message,
        buttons: [{
            id: 'btn-ok',
            icon: 'glyphicon glyphicon-check',
            label: 'OK',
            cssClass: 'btn-warning',
            autospin: false,
            action: function (dialogRef) {
                dialogRef.close();
                if (typeof callback == "function")callback();
            }
        }]
    });
}

function generateUUID() {
    var d = new Date().getTime();
    if(window.performance && typeof window.performance.now === "function"){
        d += performance.now();; //use high-precision timer if available
    }
    var uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
        var r = (d + Math.random()*16)%16 | 0;
        d = Math.floor(d/16);
        return (c=='x' ? r : (r&0x3|0x8)).toString(16);
    });
    return uuid;
};

function getFileExtension(filename) {
   return filename.split('.').pop().toLocaleLowerCase();
}

Array.prototype.remove = function() {
    var what, a = arguments, L = a.length, ax;
    while (L && this.length) {
        what = a[--L];
        while ((ax = this.indexOf(what)) !== -1) {
            this.splice(ax, 1);
        }
    }
    return this;
};

var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
};

