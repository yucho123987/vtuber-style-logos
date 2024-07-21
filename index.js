$=mdui.$;
$('#open-drawer-btn').on('click',function() {
  $('#left-drawer')[0].open=true;
});
$('#about-btn').on('click',function() {
  $('#left-drawer')[0].open=false;
  mdui.alert({
    headline: 'About',
    description: 'This is a non-profit website that shows vtuber style logos made by Sawaratsuki. Every one is free to download and share all the logos non-profit in the absence of profits.',
    confirmText: 'OK'
  });
});
function generateList() {
  $('#logos').css('display','none');
  $('#logos').html('');
  $('#loading-logos').css('display','block');
  $('#loading-logos-failed').css('display','none');
  $.ajax({
    method: 'GET',
    url:'manifest.json?timestamp='+Date.now(),
    complete: function () {
      $('#loading-logos').css('display','none');
    },
    success: function (result) {
      $('#logos').css('display','block');
      result.items.forEach(function (item) {
        var logo_html='';
        item.logos.forEach(function (logo) {
          logo_html+='<img src="'+encodeURIComponent(logo.path)+'" title="Logo: '+logo.name+'">';
        });
        $('#logos').append('<mdui-card class="logo-list-item"><h3>'+item.type+'</h3>'+logo_html+'</mdui-card>');
      })
    },
    error: function () {
      $('#loading-logos-failed').css('display','block');
    }
  })
}
generateList();
$('#try-again-btn').on('click',function() {
  generateList();
});
$('#refresh-btn').on('click',function() {
  $('#left-drawer')[0].open=false;
  generateList();
});