$(window).on('load', function(){
  $('#loader').fadeOut("slow",function(){
    $('#app').fadeIn(400, function(){
      $('footer').fadeIn();
    });
  });
});

$(window).on('load', function(){
  $('#loader').fadeOut("slow");
});

//Function for generating stars from rating
//Used as: document.getElementById("stars").innerHTML = getStars({{$recipe->rating}});
function getStars(rating) {

  rating = Math.round(rating * 2) / 2;
  let output = [];
  
  for (var i = rating; i >= 1; i--)
    output.push('<i class="fa fa-star" aria-hidden="true" style="color: gold;"></i>&nbsp;');
    
  if (i == .5) output.push('<i class="fa fa-star-half-o" aria-hidden="true" style="color: gold;"></i>&nbsp;');
  
  for (let i = (5 - rating); i >= 1; i--)
    output.push('<i class="fa fa-star-o" aria-hidden="true" style="color: gold;"></i>&nbsp;');

  return output.join('');

}