/**
 * ownCloud - password
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Patrick Paysant / CNRS <ppaysant@linagora.com>
 * @copyright Patrick Paysant / CNRS 2016
 */

$(document).ready(function() {
    $('#password_policy input').change(function() {
        var value = $(this).val();

        if ($(this).attr('type') == 'checkbox') {
            value = 'no';
            if (this.checked) {
                value = 'yes';
            }
        }

        OC.AppConfig.setValue('password_policy', $(this).attr('name'), value);
    });
});
