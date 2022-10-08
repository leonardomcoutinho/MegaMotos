$(function (){
    $('.produtos').on('click', function(e){
        e.preventDefault();
        $.ajax({
            url: "products",
            success: function(result){
                $('.section-dash').html(result);
            },
            error: function(result){
                $('.section-dash').html("error");
            }
        });
    });
    $('.categoria').on('click', function(e){
        e.preventDefault();
        $.ajax({
            url: "categories",
            success: function(result){
                $('.section-dash').html(result);
            },
            error: function(result){
                $('.section-dash').html("error");
            }
        });
    });
    $('.estoque').on('click', function(e){
        e.preventDefault();
        $.ajax({
            url: "inventory",
            success: function(result){
                $('.section-dash').html(result);
            },
            error: function(result){
                $('.section-dash').html("error");
            }
        });
    });
});