$(document).ready(function() {
  initNotificationRead();
});

function initNotificationRead() {
  $('.notification_mark_read').click(function() {
    $(this).hide();
    //mudar de cor
    //$(this).parent().removeClass("notification_not_read").addClass("notification_read");
    $(this).parent().hide();
  });
}
