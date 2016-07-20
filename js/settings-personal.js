$(document).ready(function() {
    var myId = t('password_policy', 'Password Policy Enforcement');
    myId = myId.toLowerCase().replace(/ /g, '-');

    // In OC 9.1.RC1 section's anchor (in left column) and id are created in /settings/personal.php with the translated sectionName
    // PR is pushed to fix that (https://github.com/owncloud/core/pull/25528)

    $('#passwordform').after($('#'+myId).detach());
    $("#passwordbutton").bindFirst('click',function(e){
        check_password_policy(e);
    });
});

function check_password_policy(e) {
    // $('#password-error').hide();
    var password = $('#pass2').val();

    $.ajax({
        type: 'POST',
        url: OC.generateUrl('/apps/password_policy/policy/set_password'),
        data: {password: password},
        async: false /* needed to wait before triggering the next 'click' handlers */
    })
    .done(function(data) {
        if (data.status == 'success') {

            return true;
        }
        else {
            $('#password-error').html(t('password_policy', 'Password does not comply with the Password Policy.'));
            // $('#password-error').show();

            $('#password-changed').removeClass('inlineblock').addClass('hidden');
            $('#password-error').removeClass('hidden').addClass('inlineblock');

            $('#pass1').val('');
            $('#pass2').val('').change();
            // $('#passwordform').trigger('scroll'); // needed to redraw the tooltip (=> erase it)

            e.stopPropagation();
            e.preventDefault();
            e.stopImmediatePropagation();
            return false;
        }
    })
    .fail(function() {
        return false;
    });
}

$.fn.bindFirst = function(name, fn) {
    this.on(name, fn);

    this.each(function() {
        var handlers = $._data(this, 'events')[name.split('.')[0]];
        var handler = handlers.pop();

        handlers.splice(0, 0, handler);
    });
};
