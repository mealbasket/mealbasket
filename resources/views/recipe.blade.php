@extends('layouts.app') 
@section('content')
<div class="container" style="margin-top: 100px;">
  <div class="row" style="border-bottom-color: black;padding-top: 15px;border-bottom-width: unset; padding-bottom: 25px;border-bottom-style: double;">
    <div class="col-md-1">
    </div>
    <div class="col-md-5">
      <div class="jumbotron">
        <h2>
          Chicken Tikka Masala
        </h2>
        <p>
          This is an easy recipe for Chicken Tikka Masala--chicken marinated in yogurt and spices and then served in a tomato cream
          sauce. Serve with rice or warm pita bread.
        </p>
        <p>
          <a href=""><button class="btn btn-success" type="button">Buy Now</button></a>
          <a href=""><button class="btn btn-outline-primary" type="button">Add to Cart</button></a>
        </p>
      </div>
    </div>
    <div class="col-md-5">
      <div class="carousel slide" id="carousel-983258">
        <ol class="carousel-indicators">
          <li data-slide-to="0" data-target="#carousel-983258" class="active">
          </li>
          <li data-slide-to="1" data-target="#carousel-983258">
          </li>
          <li data-slide-to="2" data-target="#carousel-983258">
          </li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="https://images.media-allrecipes.com/userphotos/720x405/39905.jpg">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="https://images.media-allrecipes.com/userphotos/720x405/5735314.jpg">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="https://images.media-allrecipes.com/userphotos/720x405/5388890.jpg">
          </div>
        </div> <a class="carousel-control-prev" href="#carousel-983258" data-slide="prev"><span class="carousel-control-prev-icon"></span> <span class="sr-only">Previous</span></a>        <a class="carousel-control-next" href="#carousel-983258" data-slide="next"><span class="carousel-control-next-icon"></span> <span class="sr-only">Next</span></a>
      </div>
    </div>
    <div class="col-md-1">
    </div>
  </div>
  <div class="row" style="padding-top: 25px;">
    <div class="col-md-1">
    </div>
    <div class="col-md-10">
      <h2>Ingredients</h2>
      <ul>
        <li class="list-item">
          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" value="">1 cup Yogurt
            </label>
          </div>
        </li>
        <li class="list-item">
          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" value="">1 clove garlic, minced
            </label>
          </div>
        </li>
        <li class="list-item">
          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" value="">1 jalepeno, finely chopped
            </label>
          </div>
        </li>
        <li class="list-item">
          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" value="">1 (8 ounce) can tomato sauce
            </label>
          </div>
        </li>
        <li class="list-item">
          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" value="">4 long skewers
            </label>
          </div>
        </li>
        <li class="list-item">
          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" value="">1 cup Heavy cream
            </label>
          </div>
        </li>
        <li class="list-item">
          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" value="">1 tbsp butter
            </label>
          </div>
        </li>
        <li class="list-item">
          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" value="">1 tbsp minced fresh ginger
            </label>
          </div>
        </li>
        <li class="list-item">
          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" value="">1 tsp ground cinnamon
            </label>
          </div>
        </li>
        <li class="list-item">
          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" value="">Chicken
            </label>
          </div>
        </li>
        <li class="list-item">
          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" value="">1 tbsp lemon juice
            </label>
          </div>
        </li>
        <li class="list-item">
          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" value="">1 tsp ground cumin
            </label>
          </div>
        </li>
        <li class="list-item">
          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" value="">2 tsp Paprika
            </label>
          </div>
        </li>
        <li class="list-item">
          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" value="">Chopped cilantro
            </label>
          </div>
        </li>
        <li class="list-item">
          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" value="">Salt to taste
            </label>
          </div>
        </li>
      </ul>
    </div>
    <div class="col-md-1">
    </div>
  </div>
  <div class="row">
    <div class="col-md-1">
    </div>
    <div class="col-md-10">
      <h2>
        Method
      </h2>
      <p>
        In a large bowl, combine yogurt, lemon juice, 2 teaspoonscumin,cinnamon, black pepper, ginger and salt. Stir in chicekn,
        cover, and refrigerate for 1 hour.
        <br><br>Preheat a grill for high heat.
        <br><br>Lightly oil the grill grate. Thread chicken onto skewers, and discard marinade. Grill until juices run claer,
        about 5 mins on each side.
        <br><br>Melt butter in a large heavy skillet over medium heat. Sauce garlic and jalopeno for 1 min. Season with 2
        teasponns cumin, paprika, nad 3 teaspoons salt.
        <br><br>Stir in tomato sauce and cream. Simmer on low heat until sauce thickens, about 20 mins. Add grilled chicken,
        and simmer for 10 mins. Transfer to a serving platter, and garnish with fresh cilanto.
      </p>
    </div>
    <div class="col-md-1">
    </div>
  </div>
</div>
@endsection