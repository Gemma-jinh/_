// Check if a new cache is available on page load.
window.addEventListener('load', function(e) {

  window.applicationCache.addEventListener('updateready', function(e) {
    if (window.applicationCache.status == window.applicationCache.UPDATEREADY) {
      // Browser downloaded a new app cache.
      // Swap it in and reload the page to get the new hotness.
       window.applicationCache.swapCache();
      if (confirm('이 사이트의 새로운 버전이 업데이트 되었습니다. 원활한 이용을 위해 새로고침을 해야합니다. 지금 하시겠습니까?')) {
        window.location.reload();
      }
    } else {
      // Manifest didn't changed. Nothing new to server.
    }
  }, false);

}, false);