

    $('.delete').click(function(e){
        
        if(!confirm('Eminmisiniz ?')){
            e.preventDefault();
            return false;
        }else{
            return true;
        };
    })

    $('#search_cat').keyup(function(){
      var txt = $(this).val();
      
        $.ajax({
          method:"POST",
          url:'http://localhost/projects/market/categories/search',
          data:{search:txt},
          dataType:"text",
          success:function(data){
            $(".searched").html(data);
          }
        })
      
    });


    $('#search_pro').keyup(function(){
      var txt = $(this).val();
      
        $.ajax({
          method:"POST",
          url:'http://localhost/projects/market/products/search',
          data:{search:txt},
          dataType:"text",
          success:function(data){
            $(".searched").html(data);
          }
        })
    });

    $('#search_man').keyup(function(){
      var txt = $(this).val();
      
        $.ajax({
          method:"POST",
          url:'http://localhost/projects/market/manufactures/search',
          data:{search:txt},
          dataType:"text",
          success:function(data){
            $(".searched").html(data);
          }
        })
    });
    

   /* $('.buying').click(function(e){
        
      if(!confirm('Are you sure to buy?')){
          e.preventDefault();
          return false;
      }else{
          return true;
      };
  }) 

// $(document).ready(function(){
//     $('.messages').hide(7000);


      
// })
    
$('.buy').click(function(){
  $('.checkout').css({
    'display':'block'
  })
}) */



