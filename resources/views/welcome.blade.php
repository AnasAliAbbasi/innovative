@extends('front_layout')

@section('content')

<div class="container">

    <div class="row mt-16">
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-12">
                   <a href="{{url('create-film')}}" id="#add_film"> <button class="btn btn-warning" >Add Film</button></a>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-md-12">
                    <h1 style="font-size: 22px;font-weight: bold;">Movies Listing</h1>
                </div>
            </div>
            <div id="item-lists">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Release&nbsp;Date</th>
                            <th>Rating</th>
                            <th>Ticket&nbsp;Price</th>
                            <th>Country</th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($status == 'success')

                            @foreach ($films as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->release_date }}</td>
                                    <td>{{ $item->rating }}</td>
                                    <td>{{ $item->ticket_price }}</td>
                                    <td>{{ $item->country }}</td>
                                    <td><img src="{{ asset('film-images/'.$item->image) }}"  alt=""></td>
                                    <td><a href="{{ url('film/'.Crypt::encrypt($item->id)) }}"><button class="btn btn-primary">Details</button></a></td>

                                </tr>
                            @endforeach

                            @else

                                <tr>
                                    <td> No Data Found </td>
                                </tr>
                            @endif
                    </tbody>
                    </table>



            </div>
        </div>
    </div>

</div>


<script>


$(window).on('hashchange', function() {
    if (window.location.hash) {
        var page = window.location.hash.replace('#', '');
        if (page == Number.NaN || page <= 0) {
            return false;
        }else{
            getData(page);
        }
    }
});

$(document).ready(function()
{
    $(document).on('click', '.pagination a',function(event)
    {
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        event.preventDefault();

        var myurl = $(this).attr('href');
        var page=$(this).attr('href').split('page=')[1];

        getData(page);
    });
});

function getData(page){
    $.ajax({
        url: '?page=' + page,
        type: "get",
        datatype: "html",
    })
    .done(function(data){
        alert(data);

        $("#item-lists").html(data);
        location.hash = page;
    })
    .fail(function(jqXHR, ajaxOptions, thrownError){
          alert('No response from server');
    });
}
</script>
@endsection
