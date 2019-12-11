$(document).ready(function() {
  $('input[type=radio][name=vehicles_filter1]').change(function() {
      $('input[type=submit][name=vehicles_submit]').click();
  });
  $('input[type=radio][name=vehicles_filter2]').change(function() {
      $('input[type=submit][name=vehicles_submit]').click();
  });
  $('input[type=radio][name=vehicles_filter3]').change(function() {
      $('input[type=submit][name=vehicles_submit]').click();
  });
});
