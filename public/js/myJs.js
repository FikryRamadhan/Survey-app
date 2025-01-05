/**
 *       Helper Function JS
 *
 */

/**
 *       Menyelipkan csrf token pada setup ajax
 *
 */
const ajaxSetup = () => {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content"),
        },
    });
};

/**
 *       Config Toastr
 *
 */
const toastrAlert = () => {
    toastr.options = {
        closeButton: true,
        progressBar: true,
        showMethod: "slideDown",
        timeOut: 4000,
    };
};

/**
 *       Clear invalid class pada form
 *
 */
const clearInvalid = () => {
    $(".is-invalid").removeClass("is-invalid");
    $(".has-invalid").removeClass("has-invalid");
    $(".invalid-feedback").html("");
};

/**
 *       Format number
 *       @param Int num
 *
 */
const numberFormat = (num) => {
    if ($.isNumeric(num)) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    } else {
        return num;
    }
};

/**
 *       Pengecekan variable kosong atau tidak
 *       @param data
 *
 */
const isEmpty = (data) => {
    if (data == null || data == "" || data == undefined) {
        return true;
    } else {
        return false;
    }
};

/**
 *       Formatting date
 *       @require moment js
 *       @param String date
 *       @param String format
 *       @param String toFormat
 *
 */
const formatDate = (date, format, toFormat) => {
    return moment(date, format).format(toFormat);
};

/**
 *       Huruf depan kapital
 *       @param String text
 *
 */
const ucfirst = (text) => {
    return text.charAt(0).toUpperCase() + text.slice(1);
};

/**
 *       Tombol process
 *       @param jQueryHtmlDomElement element
 *       @param String html (optional)
 *
 */
const processingButton = (element, html = null) => {
    element.attr("disabled", "");
    if (isEmpty(html)) {
        element.html(`<i class="mdi mdi-loading mdi-spin"></i> Memproses..`);
    } else {
        element.html(html);
    }
};

/**
 *       Tombol process selesai
 *       @param jQueryHtmlDomElement element
 *       @param String html (optional)
 *
 */
const processingButtonDone = (element, html = null) => {
    element.removeAttr("disabled");
    if (isEmpty(html)) {
        element.html(`<i class="mdi mdi-check"></i> Simpan`);
    } else {
        element.html(html);
    }
};

/**
 *       Menampilkan invalid response
 *       @param jQueryHtmlDomElement elem
 *       @param Array response
 *
 */
const invalidResponse = (elem, response) => {
    $.each(response, (i, d) => {
        elem.find(`[name="${i}"]`).addClass("is-invalid");
        elem.find(`[name="${i}"]`)
            .parents(".form-group")
            .find(".invalid-feedback")
            .html(d);
        elem.find(`[name="${i}"]`)
            .parents(".form-group")
            .find(".invalid-feedback")
            .show();
        // $(`[name="${i}"]`).siblings('.invalid-feedback').show();
    });
};

/**
 *       Menghapus class warna
 *       @param jQueryHtmlDomElement elem
 *       @param String except
 *
 */
const clearColorText = (elem, except = null) => {
    let classList = ["text-danger", "text-success"];
    $.each(classList, (i, theClass) => {
        if (except != null && theClass != `text-${except}`) {
            elem.removeClass(theClass);
        } else if (except == null) {
            elem.removeClass(theClass);
        }
    });
};

const setInvalidFeedback = (inputElement, message) => {
    $(inputElement).addClass("is-invalid");
    $(inputElement)
        .parents(".form-group")
        .find(".invalid-feedback")
        .html(message);
};

const infoNotification = (title, message) => {
    iziToast.show({
        title: title,
        message: message,
        position: "topRight",
    });
};

const successNotification = (title, message) => {
    iziToast.success({
        title: title,
        message: message,
        position: "topRight",
    });
};

const warningNotification = (title, message) => {
    iziToast.warning({
        title: title,
        message: message,
        position: "topRight",
    });
};

const errorNotification = (title, message) => {
    iziToast.error({
        title: title,
        message: message,
        position: "topRight",
    });
};

const ajaxSuccessHandling = (response) => {
    let { message } = response;
    successNotification("Berhasil", message);
};

const ajaxErrorHandling = (error, $form = null) => {
    let { status, responseJSON } = error;
    let { message } = responseJSON;

    if (status == 422) {
        if ($form) {
            let { errors } = responseJSON;
            invalidResponse($form, errors);
        }

        if (message == "The given data was invalid.") {
            message = "Harap cek kembali form isian";
        }
    }

    message = message == "" ? "XHR Invalid" : message;

    warningNotification("Peringatan", message);
};

const confirmation = (message, yesAction = null, cancelAction = null) => {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-danger ml-2",
            cancelButton: "btn btn-primary mr-2",
        },
        buttonsStyling: false,
    });
    swalWithBootstrapButtons
        .fire({
            text: 'Yakin ingin menghapus data ini',
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Tidask!",
            reverseButtons: true,
			preConfirm: async () => {
				yesAction()
			}
        })
};

// reload window (5000)
function windowReload(delayTime) {
    setTimeout(function () {
        window.location.reload(true);
    }, delayTime);
}

// redirect to url (5000, route('home'))
function redirectUrlTo(delayTime, url) {
    setTimeout(function () {
        window.location.href = url;
    }, delayTime);
}

// window close automatic
function windowClose(delayTime) {
    setTimeout(function () {
        window.close();
    }, delayTime);
}
