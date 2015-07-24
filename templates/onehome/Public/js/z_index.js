$(function(){
        /*Ê×Ò³ÂÖ²¥Í¼*/
        var liLen=$('#z_back li').length,eleLis=$('#z_back li'),iNow=0,timer=null;
        var autoTurn=function(index){
          timer=setInterval(function(){
            if(index==liLen-1){
              iNow=index=0;
            }else{
              iNow+=1,index+=1;
            }
            eleLis.stop(true).css({'opacity':0,'z-index':10}).eq(iNow).css('z-index',100).animate({'opacity':1},{duration:800,easing:'easeInOutQuad'});
          },3200);
        }
        autoTurn(iNow);
        $('#z_back').hover(function(){
          clearInterval(timer);
        },function(){
          console.log(iNow);
          autoTurn(iNow);
        })
        var timep1=setTimeout(function(){
          $('#z_like_p2').text('万一哪天不小心真的会实现').addClass('animated rotateInDownRight');
            $('#z_like_p2').hover(function(){
              $(this).removeClass('rotateInDownRight').addClass('swing');
            },function(){
              $(this).removeClass('swing');
            })
        },800);
        var timep2=setTimeout(function(){
          $('#z_like_p3').text('It Only 携你共勉，将是你完美的选择。').addClass('animated swing');
            $('#z_like_p3').hover(function(){
              $(this).removeClass('swing').addClass('swing');
            },function(){
              $(this).removeClass('swing');
            })
        },1600);
        $('#z_like_p1').hover(function(){
          $(this).removeClass('rotateInDownLeft').addClass('swing');
        },function(){
          $(this).removeClass('swing');
        })
        $('#wechat').hover(function(){
          $(this).find('.z_weixin').show();
        },function(){
          $(this).find('.z_weixin').hide();
        })
      })