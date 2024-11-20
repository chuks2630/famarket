

(function ($) {

    /*------------------
        Preloader
    --------------------*/
    $(window).on('load', function () {
        $(".loader").fadeOut();
        $("#preloder").delay(200).fadeOut("slow");
    });

    /*------------------
        Background Set
    --------------------*/
    $('.set-bg').each(function () {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });

    //checking logged in status before calling setInterval
    const isLoggedIn = document.querySelector('meta[name="user-logged-in"]').content === 'true';
    if(isLoggedIn){
        setInterval(getUnreadCount(), 10000);
    }

    //logout
    $('#logoutBtn').click(function(e){
        e.preventDefault();
        $('#logoutForm').submit();
      });

      
    $('#start-message').on('input',function(){
       let value = $(this).val();
        if(value.length > 0){
            $('#subbtn').removeAttr('disabled');
        }else{
            $('#subbtn').attr('disabled', 'disabled');
        }
        
    });

    $('#conversation').click(()=>{
        $('#convo').removeClass('d-none');
        $('#start-chat').addClass('d-none');
    });
    $('#closebtn').click(()=>{
        $('#convo').addClass('d-none');
        $('#start-chat').removeClass('d-none');
    });


    $('.bookmark').hover(function(){
        $(this).addClass('hovereffect')
    }, function(){
        $(this).removeClass('hovereffect')
    });


    $('.bookmark').click(function(e){
        e.preventDefault();
        const product_id = $(this).data('value');
        const csrfToken = $('meta[name="csrf-token"]').attr('content');
       const data = {product_id: product_id, _token: csrfToken };
       $.post('/saved-ads', data).done(function(response){
        if(response){
            Swal.fire({
                title: 'Success!',
                text: response.message,
                icon: 'success',
                confirmButtonText: 'OK',
                timer: 3000
            });
        }
       }).fail( function(xhr, status,error){
        console.error("Error:", xhr.responseText);
            Swal.fire({
                title: 'Error!',
                text: "Please Ensure that you're logged in",
                icon: 'error',
                confirmButtonText: 'OK',
                timer: 3000
            });
       
       });
    })


    $('#start-conversation').submit((e)=>{
        e.preventDefault();
        const participant = $('#participant').val();
        const message =$('#start-message').val();
        let csrfToken = $('meta[name="csrf-token"]').attr('content');
        const url = '/api/conversation';
       
        const sendOptions = {
            method: 'POST',
            headers: { 
                'Accept' : 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({'participant': participant, 'message': message})
        };

        fetch(url, sendOptions)
        .then(response => response.json())
        .then(data => {
            // console.log(data)
            $('#start-message').val('');
        }).catch(error => console.error('Error fetching conversations:', error));
    });


    $('#message-box').submit((e)=>{
        e.preventDefault();
        const message = $('#messageInput').val();
        const conversationId = $('#conversationId').val();
        let csrfToken = $('meta[name="csrf-token"]').attr('content');
        const url = '/api/messages';

        const sendOptions = {
            method: 'POST',
            headers: { 
                'Accept' : 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({'conversation_id': conversationId, 'message': message})
        };
        fetch(url, sendOptions)
        .then(response => response.json())
        .then(data => {
            // console.log(data)
            const newMessage = "<div class='message-container sender-message-container'><div class='message-bubble sender-message-bubble'>"+data.message+"</div></div>";
            $('#messages').append(newMessage);
            $('#messageInput').val('');
        }).catch(error => console.error('Error fetching conversations:', error));

        markAsRead(conversationId);
    });


    function markAsRead(conversation){
        const url = '/api/messages';
        let csrfToken = $('meta[name="csrf-token"]').attr('content');

        const sendOptions = {
        method: 'PATCH',
        headers: { 
            'Accept' : 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({'conversation_id': conversation})
    };
    fetch(url, sendOptions)
    .then(response => response.json())
    .then(data => {
        if(data.status == 200){
          $('#messageBadge').removeAttr('data-badge');
        }
    }).catch(error => console.error('Error fetching conversations:', error));
      };


      function getUnreadCount() {
        
        $.ajax({
            url: '/api/unread-message',
            method: 'GET',
            success: function(response) {
              // Display the count
              if(response.unreadCount > 0){
                $('#messageBadge').attr('data-badge',response.unreadCount);
              }
                 
            },
            error: function(error) {
                console.error("Error fetching unread count", error);
            }
        });
    }

    //category price range filter
    $('#priceRange').submit(function(e){
        e.preventDefault();
        const url = window.location.href;
        const parameter = url.split('/')
       console.log(parameter[4]);
        const minPrice = $('#minPrice').val();
        const maxPrice = $('#maxPrice').val();
        let csrfToken = $('meta[name="csrf-token"]').attr('content');
        const data = {maxPrice: maxPrice, minPrice: minPrice, catId: parameter[4], _token: csrfToken }
        
        //making a request to the server
        $.post('/filter-price', data).done(function(response){
            // console.log(response);

            $('#productContainer').empty();

            //looping through products
            if(response.products != ''){
            response.products.forEach(prod => {
                $('#productContainer').append(`
                    <div class="col-md-4">
                        <div class=" m-2 ad">
                            <a href="/detail/${prod.id}" class="pro_link">
                            <div><img src="/storage/${prod.filename}" alt="" class="img-fluid"></div>
                            <div class="p-2">
                                <div class="bookmark" data-value="${prod.id}"><i class="fa-regular fa-bookmark"></i></div>
                                <p class="my-1"><b>&#8358; ${Number(prod.price).toFixed(2)}</b></p>
                                <p class="my-1" style="font-size: large">${prod.title}</p>
                                <p  class="text-muted" style="font-size: small">${prod.description.substring(0,100)}</p>
                                <p style="font-size: x-small" class="text-muted mb-0"><i class="fa-solid fa-location-dot"></i> ${prod.lga.name+' '+prod.lga.state.name}</p>
                            </div>
                            </a>
                        </div>
                    </div>
                `)
            });
        }else{

            $('#productContainer').html(`<p style="font-size: large" class="text-muted text-center mt-5">Sorry no ads Matches this Criteria</p>`)
        }
        }).fail( function(xhr, status,error){
            console.error("Error:", xhr.responseText);
        });
    });

})(jQuery);

