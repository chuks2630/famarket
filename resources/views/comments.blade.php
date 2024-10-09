@extends('layout.famarket')

@section('content')


<div class="row my-5 justify-content-around">
    <div class="col-md-8 catmenu p-4" style="height: 100%">
        <h4>Rate and Comment</h4>
        <form id="ratingForm" class="comment-form" method="POST">
            <div class="rating-stars">
                <input type="radio" id="star5" name="rating" value="5"><label for="star5" class="fa fa-star"></label>
                <input type="radio" id="star4" name="rating" value="4"><label for="star4" class="fa fa-star"></label>
                <input type="radio" id="star3" name="rating" value="3"><label for="star3" class="fa fa-star"></label>
                <input type="radio" id="star2" name="rating" value="2"><label for="star2" class="fa fa-star"></label>
                <input type="radio" id="star1" name="rating" value="1"><label for="star1" class="fa fa-star"></label>
            </div>

            <textarea name="comment"  class="form-control" id="comment" rows="4" placeholder="Write your comment..." style="width:100%;" required></textarea><br>
            <input type="hidden" value="{{$id}} " id="adtype">
            <button type="submit" class="btn action_btn col-12">Submit</button>
        </form>

        <!-- Display Average Rating -->
        <div class="average-rating" id="averageRating">
            Average Rating: <span id="averageRatingValue">{{$averageRating}}</span> <span class="fa fa-star" style="color: #f39c12;"></span>
        </div>

        <!-- Display Comments -->
        <div class="comments-section" id="commentsSection">
            <h4>Comments</h4>

            @foreach($feedbacks as $feed)
            <div class="comment-box">
                <strong>{{$feed->user->firstname.' '.$feed->user->lastname}}</strong> <br>
                <span class="rating"><i class="fa fa-star" style="color: #f39c12;"></i> {{$feed->rating}}</span>
                <p> {{$feed->comment}}</p>
            </div>
            @endforeach
            {{-- <div class="comment-box">
                <strong>Omotolani fabayo</strong> <br>
                <span class="rating"><i class="fa fa-star" style="color: #f39c12;"></i> 5</span>
                <p> This is a great product!</p>
            </div> --}}

            <!-- More comments will be dynamically appended here -->
        </div>
       
    </div>
    <div class="col-md-3 catmenu p-4 text-center" style="height: 100%">
        <i class="fa-regular fa-comment-dots" style="font-size: 4rem"></i>
        <p>Your feedback is very important for the seller review. Please, leave the honest review to help other buyers and the seller in the customer attraction.</p>
        
    </div>
</div>

@endsection