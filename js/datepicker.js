$(document).ready(function () {
  var d = new Date().toISOString();
  d = d.replace(/\.\d+/, '');
  var minDate = d.substring(0, d.length - 1);

  $('.datetimepick').attr({
    value: minDate,
    min: minDate,
  });
});
