$(window).load(function () {
    $('#pre-loader').delay(250).fadeOut(function () {
        $('#pre-loader').remove();
    });
});

$(document).ready(function () {
    $.ajaxSetup({cache: false});

    //expand or collapse sidebar menu 
    $("#sidebar-toggle-md").click(function () {
        $("#sidebar").toggleClass('collapsed');
        if ($("#sidebar").hasClass("collapsed")) {
            $(this).find(".fa").removeClass("fa-dedent");
            $(this).find(".fa").addClass("fa-indent");
        } else {
            $(this).find(".fa").addClass("fa-dedent");
            $(this).find(".fa").removeClass("fa-indent");
        }
    });

    $("#sidebar-collapse").click(function () {
        $("#sidebar").addClass('collapsed');
    });

    //expand or collaps sidebar menu items
    $("#sidebar-menu > .expand > a").click(function () {
        var $target = $(this).parent();
        if ($target.hasClass('main')) {
            if ($target.hasClass('open')) {
                $target.removeClass('open');
            } else {
                $("#sidebar-menu >.expand").removeClass('open');
                $target.addClass('open');
            }
            if (!$(this).closest(".collapsed").length) {
                return false;
            }
        }
    });


    $("#sidebar-toggle").click(function () {
        $("body").toggleClass("off-screen");
        $("#sidebar").removeClass("collapsed");
    });

    //set custom scrollbar
    setPageScrollable();
    setMenuScrollable();
    $(window).resize(function () {
        setPageScrollable();
        setMenuScrollable();
    });

    $('body').on('click', '.timeline-images a', function () {
        var $gallery = $(this).closest(".timeline-images");
        $gallery.magnificPopup({
            delegate: 'a',
            type: 'image',
            closeOnContentClick: false,
            closeBtnInside: false,
            mainClass: 'mfp-with-zoom mfp-img-mobile',
            gallery: {
                enabled: true
            },
            image: {
                titleSrc: 'data-title'
            },
            callbacks: {
                change: function (item) {

                    var itemData = $(item.el).data();
                    setTimeout(function () {
                        if (itemData && itemData.viewer === 'google') {
                            $(".mfp-content").addClass("full-width-mfp-content");
                        } else {
                            $(".mfp-content").removeClass("full-width-mfp-content");
                        }
                    });

                }
            }
        });
        $gallery.magnificPopup('open');
        return false;
    });


});

//set scrollbar on page
setPageScrollable = function () {
    if ($.fn.mCustomScrollbar) {
        if ($(window).width() <= 640) {
            $('html').css({"overflow": "auto"});
            $('body').css({"overflow": "auto"});
        } else {
            initScrollbar('.scrollable-page', {
                setHeight: $(window).height() - 45
            });
        }
    }
};

//set scrollbar on left menu
setMenuScrollable = function () {
    initScrollbar('#sidebar-scroll', {
        setHeight: $(window).height() - 45
    });
};

initScrollbar = function (selector, options) {
    if (!options) {
        options = {};
    }

    var defaults = {
        theme: "minimal-dark",
        autoExpandScrollbar: true,
        keyboard: {
            enable: true,
            scrollType: "stepless",
            scrollAmount: 40
        },
        mouseWheelPixels: 300,
        scrollInertia: 60,
        mouseWheel: {scrollAmount: 188, normalizeDelta: true}
    },
    settings = $.extend({}, defaults, options);

    if (AppHelper.settings.scrollbar == "native") {
        $(selector).css({"height": settings.setHeight + "px", "overflow-y": "scroll"});
    } else {
        if ($.fn.mCustomScrollbar) {
            $(selector).mCustomScrollbar(settings);
        }
    }

};

// generate reandom string 
getRndomString = function (length) {
    var result = '',
            chars = '!-().0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    for (var i = length; i > 0; --i)
        result += chars[Math.round(Math.random() * (chars.length - 1))];
    return result;
};


// getnerat random small alphabet 
getRandomAlphabet = function (length) {
    var result = '',
            chars = 'abcdefghijklmnopqrstuvwxyz';
    for (var i = length; i > 0; --i)
        result += chars[Math.round(Math.random() * (chars.length - 1))];
    return result;
};


attachDropzoneWithForm = function (dropzoneTarget, uploadUrl, validationUrl, options) {
    var $dropzonePreviewArea = $(dropzoneTarget),
            $dropzonePreviewScrollbar = $dropzonePreviewArea.find(".post-file-dropzone-scrollbar"),
            $previews = $dropzonePreviewArea.find(".post-file-previews"),
            $postFileUploadRow = $dropzonePreviewArea.find(".post-file-upload-row"),
            $uploadFileButton = $dropzonePreviewArea.find(".upload-file-button"),
            $submitButton = $dropzonePreviewArea.find("button[type=submit]"),
            previewsContainer = getRandomAlphabet(15),
            postFileUploadRowId = getRandomAlphabet(15),
            uploadFileButtonId = getRandomAlphabet(15);

    //set random id with the previws 
    $previews.attr("id", previewsContainer);
    $postFileUploadRow.attr("id", postFileUploadRowId);
    $uploadFileButton.attr("id", uploadFileButtonId);


    //get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
    var previewNode = document.querySelector("#" + postFileUploadRowId);
    previewNode.id = "";
    var previewTemplate = previewNode.parentNode.innerHTML;
    previewNode.parentNode.removeChild(previewNode);

    if (!options)
        options = {};

    var postFilesDropzone = new Dropzone(dropzoneTarget, {
        url: uploadUrl,
        thumbnailWidth: 80,
        thumbnailHeight: 80,
        parallelUploads: 20,
        maxFilesize: 3000,
        previewTemplate: previewTemplate,
        dictDefaultMessage: AppLanugage.fileUploadInstruction,
        autoQueue: true,
        previewsContainer: "#" + previewsContainer,
        clickable: "#" + uploadFileButtonId,
        maxFiles: options.maxFiles ? options.maxFiles : 1000,
        init: function () {
            this.on("maxfilesexceeded", function (file) {
                this.removeAllFiles();
                this.addFile(file);
            });
        },
        accept: function (file, done) {
            if (file.name.length > 200) {
                done(AppLanugage.fileNameTooLong);
            }

            $dropzonePreviewScrollbar.removeClass("hide");
            initScrollbar($dropzonePreviewScrollbar, {setHeight: 90});

            $dropzonePreviewScrollbar.parent().removeClass("hide");
            $dropzonePreviewArea.find("textarea").focus();
            //validate the file
            $.ajax({
                url: validationUrl,
                data: {file_name: file.name, file_size: file.size},
                cache: false,
                type: 'POST',
                dataType: "json",
                success: function (response) {
                    if (response.success) {

                        $(file.previewTemplate).append("<input type='hidden' name='file_names[]' value='" + file.name + "' />\n\
                                 <input type='hidden' name='file_sizes[]' value='" + file.size + "' />");
                        done();
                    } else {
                        appAlert.error(response.message);
                        $(file.previewTemplate).find("input").remove();
                        done(response.message);

                    }
                }
            });
        },
        processing: function () {
            $submitButton.prop("disabled", true);
        },
        queuecomplete: function () {
            $submitButton.prop("disabled", false);
        },
        reset: function (file) {
            $dropzonePreviewScrollbar.addClass("hide");
        },
        fallback: function () {
            //add custom fallback;
            $("body").addClass("dropzone-disabled");

            $uploadFileButton.click(function () {
                //fallback for old browser
                $(this).html("<i class='fa fa-camera'></i> Add more");

                $dropzonePreviewScrollbar.removeClass("hide");
                initScrollbar($dropzonePreviewScrollbar, {setHeight: 90});

                $dropzonePreviewScrollbar.parent().removeClass("hide");
                $previews.prepend("<div class='clearfix p5 file-row'><button type='button' class='btn btn-xs btn-danger pull-left mr10 remove-file'><i class='fa fa-times'></i></button> <input class='pull-left' type='file' name='manualFiles[]' /></div>");

            });
            $previews.on("click", ".remove-file", function () {
                $(this).parent().remove();
            });
        },
        success: function (file) {
            setTimeout(function () {
                $(file.previewElement).find(".progress-striped").removeClass("progress-striped").addClass("progress-bar-success");
            }, 1000);
        }
    });

    return postFilesDropzone;
};

teamAndMemberSelect2Format = function (option) {
    if (option.type === "team") {
        return "<i class='fa fa-users info'></i> " + option.text;
    } else {
        return "<i class='fa fa-user'></i> " + option.text;
    }
};

setDatePicker = function (element, options) {
    if (!options) {
        options = {};
    }
    var settings = $.extend({}, {
        autoclose: true,
        language: "custom",
        todayHighlight: true,
        weekStart: AppHelper.settings.firstDayOfWeek,
        format: "yyyy-mm-dd"
    }, options);

    $(element).datepicker(settings);
};

setTimePicker = function (element, options) {
    if (!options) {
        options = {};
    }

    var showMeridian = AppHelper.settings.timeFormat == "24_hours" ? false : true;

    var settings = $.extend({}, {
        minuteStep: 5,
        defaultTime: "",
        appendWidgetTo: "#ajaxModal",
        showMeridian: showMeridian
    }, options);

    $(element).timepicker(settings);
};


initWYSIWYGEditor = function (element, options) {
    if (!options) {
        options = {};
    }

    var settings = $.extend({}, {
        height: 250,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['hr']],
            ['view', ['fullscreen', 'codeview']]
        ],
        disableDragAndDrop: true
    }, options);

    $(element).summernote(settings);
};

getWYSIWYGEditorHTML = function (element) {
    return $(element).summernote('code');
};

combineCustomFieldsColumns = function (defaultFields, customFieldString) {
    if (defaultFields && customFieldString) {

        var startAfter = defaultFields.slice(-1)[0];
        //count no of custom fields
        var noOfCustomFields = customFieldString.split(',').length;
        if (noOfCustomFields) {
            for (var i = 1; i <= noOfCustomFields; i++) {
                defaultFields.push(i + startAfter);
                startAfter++;
            }
        }
    }
    return defaultFields;
};