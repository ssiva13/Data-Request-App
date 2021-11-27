$(function() {
    showHide($('#applicationlist-assign_mode').val());
    $('#applicationlist-assign_mode').on('change', function() {
        showHide($(this).val());
    });

    $('#authitem-fk_app_list').on('change', function() {
        var vUrl = $(this).data('url');
        getAppPermissions($(this).val(), vUrl, 'authitem-children');
    });

    $("#tab-nav li a").click(function() {

        $("#ajax-content").empty().append('<div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');
        $("#tab-nav li a").removeClass('active');
        $(this).addClass('active');
        console.log(this.href)
        $.ajax({
            url: this.href,
            success: function(html) {
                // console.log(html)
                $("#ajax-content").empty().append(html);
            }
        });
        return false;
    });

    /**
     * Simulate clicking of the active tab in all tabs.
     * @returns {undefined}
     */
    setTimeout(function() {
        $("#tab-nav").find("a.active").click();
    }, 1);

    /**
     * Loads Application Configuration settings
     */
    $('#config-load').on('click', function() {
        var element = $('#select-app-input');
        console.log(element);
        var url = $(this).attr('value');
        var id = element.val();
        $("#config-content").empty().append('<div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');

        $.ajax({
            url: url,
            data: {
                id: id
            },
            success: function(html) {
                $("#config-content").empty().html(html);
            }
        });

    });
});

function showHide(selected) {
    if (selected == 1) {
        $('.assignments-users').show();
        $('.assignments-ad_group').hide();
    } else if (selected == 2) {
        $('.assignments-users').hide();
        $('.assignments-ad_group').show();
    } else {
        $('.assignments-users').hide();
        $('.assignments-ad_group').hide();
    }
}


function getAppPermissions(app, vUrl = null, selectField) {
    let url = `${window.location.origin}${vUrl}?app=${app}`;
    console.log(url);
    $.ajax({
        url: url,
        type: 'GET',
    }).done(function(resp) {
        $(`#${selectField}`).empty();
        $.each(resp, function( key, value ) {
            $(`#${selectField}`).append(`<option value="${key}"> ${value} </option>`);
        });
    }).fail(function(err) {
        console.log(err);
        console.log(url)
    });
}