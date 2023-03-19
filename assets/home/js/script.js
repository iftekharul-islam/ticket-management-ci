/*!
 * Simple Blog js
 * Copyright 2019 M Fazle Rabby Khan netrubby@gmail.com
 */

$(document).ready(function(){
    $('.lni-chevron-down-circle, .lni-chevron-up-circle').click(function(){
        if($(this).hasClass("lni-chevron-down-circle")) $(this).removeClass("lni-chevron-down-circle").addClass("lni-chevron-up-circle");
        else $(this).removeClass("lni-chevron-up-circle").addClass("lni-chevron-down-circle");
    });
    
    $('.overlay').click(function(){
        $(this).removeClass("active");
    });
    
    $('.navbar-nav .nav-item').on({
        mouseenter: function(){
            $('.overlay').addClass("active");
            $(this).addClass("active");
        },
        mouseleave: function(){
            $('.overlay').removeClass("active");
            $(this).removeClass("active");
        }
    });
    
    if($('.post-content h2').length > 1){
        var currentUrl = window.location.href.replace(location.hash, "");
        var i = 0, j = 0, listItem = "";
        $('.post-content h2, .post-content h3').each(function(){
            var id = $(this).text().replace(/[^a-zA-Z0-9 ]/g, '').replace(/\s/g, '-');
            $(this).attr('id', id);
            if($(this).is("h2")){
                i++;
                j = 0;
                listItem = '<li>' + i + '. <a href="' + currentUrl + '#' + id + '" data-section="#' + id + '" class="ml-1">' + $(this).text() + '</a></li>';
            }else{
                j++;
                listItem = '<li class="pl-4">' + j + '. <a href="' + currentUrl + '#' + id + '" data-section="#' + id + '" class="ml-1">' + $(this).text() + '</a></li>';
            }
            $('#h2s').append(listItem);
        });
        $('.post-headings-list').removeClass("d-none");
        $('.post-headings-list a').click(function(event){
            event.preventDefault();
            $('html, body').animate({
                scrollTop: $($(this).data("section")).offset().top
            }, 500);
        });
    }
    
    $(".newsletter-signup .btn").click(function(){
        var mail = $(".newsletter-signup input").val();
        if(mail == ''){
            alert('Enter an email address');
            return false;
        }
        $.post("home/newsletter_signup", {email: mail}, function(result){
            alert(result);
            $(".newsletter-signup input").val('');
        });
    });
    
    $(".filter").on("keyup", function(){
        var value = $(this).val().toLowerCase();
        $(".contents-to-filter div").filter(function(){
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    if($('#rendering-time').length) $( "#rendering-time" ).append("<br>DOM loaded in " + ((Date.now()-timerStart)/1000) + " seconds");
    
});

$(window).on("load", function() {
    if($('#rendering-time').length) $( "#rendering-time" ).append("<br>Everything loaded in " + ((Date.now()-timerStart)/1000) + " seconds");
});
