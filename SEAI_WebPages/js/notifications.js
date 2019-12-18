$(document).ready(function() {
  initMessageClosers();
});

function initMessageClosers() {
  $('.notification_mark_read').click(function() {
    $(this).hide();
    //mudar de cor
    $(this).parent().removeClass("notification_not_read").addClass("notification_read");
  });
}
