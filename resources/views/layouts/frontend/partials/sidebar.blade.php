<div class="col-lg-4 sidebar-area">
    <div class="single_widget search_widget">
      <div id="imaginary_container">
          <form action="{{route('search')}}" method="GET">
        <div class="input-group stylish-input-group">
                <input
                type="text"
                class="form-control"
                placeholder="Search"
                name="search"
              />
              <span class="input-group-addon">
                <button type="submit">
                  <span class="lnr lnr-magnifier"></span>
                </button>
            </span>
        </div>
    </form>
      </div>
    </div>
    <div class="single_widget cat_widget">
      <h4 class="text-uppercase pb-20">post categories</h4>
      <ul>
        @foreach ($categories as $category)
        <li>
            <a href="{{route('category.post', $category->slug)}}">{{$category->name}} <span>{{$category->posts->count()}}</span></a>
          </li>
        @endforeach
      </ul>
    </div>

     </div>