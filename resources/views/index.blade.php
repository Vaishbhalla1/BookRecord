@extends('layouts.frontend.app')

@section('content')

<!-- start banner Area -->
<section
  class="banner-area relative"
  id="home"
  data-parallax="scroll"
  data-image-src="https://png.pngtree.com/thumb_back/fh260/background/20191106/pngtree-back-to-school-rectangular-blackboard-education-book-pen-holder-image_321417.jpg"
>
  <div class="overlay-bg overlay"></div>
  <div class="container">
    <div class="row fullscreen">
      <div
        class="banner-content d-flex align-items-center col-lg-12 col-md-12"
      >
        <h1>
          Greetings from BookRecord !!<br />
          <p>
            R<span style="font-size: 0.7em">ead</span> &nbspL<span
              style="font-size: 0.7em"
              >earn</span
            >
            &nbspE<span style="font-size: 0.7em">ngage</span>
          </p>
        </h1>
      </div>

      <div
        class="head-bottom-meta d-flex justify-content-between align-items-end col-lg-12"
      >
        
        <div
          class="col-lg-6 flex-row d-flex meta-right no-padding justify-content-end"
        >
          <div class="user-meta">
            <h4 class="text-white">Vaishali Bhalla</h4>
            <p><script>let t = new Date;document.write(t.toDateString());</script></p>
          </div>
          <img class="img-fluid user-img" src="img/user.jpg" alt="" />
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End banner Area -->

<!-- Start category Area -->
<section class="category-area section-gap" id="news">
  <div class="container">
    <div class="row d-flex justify-content-center">
      <div class="menu-content pb-70 col-lg-8">
        <div class="title text-center">
          <h1 class="mb-10">Posts from all categories</h1>
          <p>Here, you will find the Latest Post from all category.</p>
        </div>
      </div>
    </div>
    <div class="active-cat-carusel">
        @foreach ($posts as $post)
      <div class="item single-cat">
        <img src="{{asset('storage/post/'.$post->image)}}" alt="{{$post->image}}" />
        <p class="date">{{$post->created_at->diffForHumans()}}</p>
        <h4><a href="{{route('post', $post->slug)}}">{{$post->title}}</a></h4>
      </div>
      @endforeach
    </div>
  </div>
</section>
<!-- End category Area -->

<section class="travel-area section-gap" id="travel">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-70 col-lg-8">
                <div class="title text-center">
                    <h1 class="mb-10">This Week's Edition.</h1>
                    <p>views in this week.</p>
                </div>
            </div>
        </div>
            <div class="container">
            <div class="row justify-content-center">
                @foreach ($posts as $post)
                <div class="single-posts col-lg-4 col-sm-4 mb-3">
                    <img class="img-fluid" src="{{asset('storage/post/'.$post->image)}}" alt="{{$post->image}}">
                    <div class="date mt-20 mb-20">{{$post->created_at->diffForHumans()}}</div>
                    <div class="detail">
                        <a href="{{route('post', $post->slug)}}"><h4 class="pb-20">{{$post->title}}</h4></a>
                        <p>
                           {!! Str::limit($post->body, 400) !!}
                        </p>
                        <p class=" footer"="">
                            <br>
                            </p><ul class="d-flex space-around">
                                <li><a href="javascript:void(0);" onclick=" toastr.info('To add to your favorite list you have to login first.', 'Info', { closeButton: true, progressBar: true, })"><i class="fa fa-heart-o" aria-hidden="true"></i><span> {{$post->likedUsers->count()}}</span></a></li>


                            <li><i class="fa fa-comment-o" aria-hidden="true"></i><span> {{$post->comments->count()}}</span></li>
                                <li><i class="fa fa-eye" aria-hidden="true"></i> <span>{{$post->view_count}}</span></li>
                            </ul>

                    <p></p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Start team Area -->
<section class="team-area section-gap" id="about">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-70 col-lg-8">
                <div class="title text-center">
                    <h1 class="mb-10">About This Site</h1>
                    <p>This is blogging site related to the Website Application Development &amp; includes different Languages.</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center d-flex align-items-center">
            <div class="col-lg-6 team-left">
                <p>
                    Blogs related to Web Designe, Web Development, Handling data and  more.
                </p>
                <p>
                    This site is made with laravel framework. The theme is <a href="">BookRecord</a> </p>
                    <br>
     
                <h4>About the Author</h4>
                <br>
                <p>I am <span class="c1">a student in Swansea University</span> pursuing <span class="c1">Master's</span> - in Advance Computer Science <span class="c1">This is the assignment for Website application development</span>. </p>
                <br>
                <h4>Email: <span style="font-size: medium; font-weight: lighter;">vaishbhalla1@gmail.com</span></h4>
                <br>
                
            </div>
            <div class="col-lg-6 team-right d-flex justify-content-center">
                <div class="row">
                    <div class="single-team">
                        <div class="thumb">
                            <img class="img-fluid w-75 mx-auto" src="https://media-exp1.licdn.com/dms/image/C5603AQHHmaWlhqkphA/profile-displayphoto-shrink_200_200/0/1637374204241?e=1643241600&v=beta&t=NKGOPkL47hEmrzLmi51pQ_lFnMOJUaWHbPZwGbznE4c" alt="admin">
                            <div class="align-items-center justify-content-center d-flex">
                                <a href="#"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                                <a href="#"><i class="fab fa-youtube" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="meta-text mt-30 text-center">
                            <h4>Vaishali Bhalla</h4>
                            <p>Creator</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End team Area -->

@endsection