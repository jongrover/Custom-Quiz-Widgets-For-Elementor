jQuery(function () {
  var url = window.location.href,
      $nav = jQuery('.elementor-nav-menu--main'),
      $activeLink = $nav.find('a[href="'+url+'"]'),
      $prevButton = jQuery('.prevButton'),
      $nextButton = jQuery('.nextButton');
  //console.log(url, $nav, $prevButton, $nextButton);
  if ($activeLink.length === 0) {
    var $prevLink = $nav.find('a').first(),
        $nextLink = $nav.find('a').first();
    //console.log('no link match', $prevLink, $nextLink);
  } else {
    var $prevLink = $activeLink.parent().prev().find('a'),
        $nextLink = $activeLink.parent().next().find('a');
    //console.log('found link match', $prevLink, $nextLink);
  }
  var prevUrl = $prevLink.attr('href'),
      nextUrl = $nextLink.attr('href');
  console.log(prevUrl, nextUrl);
  $prevButton.attr('href', prevUrl);
  $nextButton.attr('href', nextUrl);
});
