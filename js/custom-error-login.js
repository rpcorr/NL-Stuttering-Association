jQuery(document).ready(async function () {

    await new Promise(r => setTimeout(r, 200));

    jQuery("input#user_pass").val("").blur();

    jQuery("input#user_login").val("").focus();

});