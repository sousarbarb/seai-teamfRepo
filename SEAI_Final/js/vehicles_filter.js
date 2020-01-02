$(document).ready(function() {
  $('input[type=checkbox][id=approvals_filter]').change(function() {
      $('input[type=submit][name=vehicles_submit]').click();
  });
  $('input[type=checkbox][id=service_providers_filter]').change(function() {
      $('input[type=submit][name=vehicles_submit]').click();
  });

  $('input[type=checkbox][id=specifications_filter]').change(function() {
      $('input[type=submit][name=vehicles_submit]').click();
  });
  $('input[type=checkbox][id=communications_filter]').change(function() {
      $('input[type=submit][name=vehicles_submit]').click();
  });
  $('input[type=checkbox][id=sensors_filter]').change(function() {
      $('input[type=submit][name=vehicles_submit]').click();
  });
  $('input[type=checkbox][id=resolutions_filter]').change(function() {
      $('input[type=submit][name=vehicles_submit]').click();
  });

  //Vehicles Page
  $(".button_form_cancel").click(function() {
    $('.form_cancel').submit();
  });
});
