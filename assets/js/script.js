$(function(){
  $(document).mousemove(function(){
    function isEveryInputEmpty() {
      var allEmpty = true;
      $(':input').each(function() {
        if ($(this).val() !== '') {
          allEmpty = false;
          return false; // we've found a non-empty one, so stop iterating
        }
      });
      return allEmpty;
    }
    console.log(allEmpty);
  })
});
