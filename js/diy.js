/**
 * Created by 路佳 on 14-6-17.
 */
$('.style-list')
  .on('click', 'label', function (event) {
    if ($(this).hasClass('disabled')) {
      event.preventDefault();
    }
    var className = /top/.test(this.className) ? 'top' : 'pants';
    $(this).addClass('active')
      .siblings('.' + className).removeClass('active');
  })
  .on('submit', function (event) {
    var cloth = [];
    $('.tab-pane.active input:checked').each(function () {
      cloth.push(this.value);
    })
    var flashvars = {
      cloth: cloth.join(',')
    };
    var params = {
      menu: "false",
      scale: "noScale",
      allowFullscreen: "true",
      allowScriptAccess: "always",
      bgcolor: "010101",
      wmode: "direct" // can cause issues with FP settings & webcam
    };
    var attributes = {
      id:"DIY"
    };
    $(this).hide();
    $('.diy-container').removeClass('hide');
    swfobject.embedSWF(
      "/wp-content/themes/line/swf/DIY.swf",
      "diy-flash", "100%", "100%", "11.0.0",
      "../swf/expressInstall.swf",
      flashvars, params, attributes);

    event.preventDefault();
    return false;
  });