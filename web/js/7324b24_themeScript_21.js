$(document).ready(function(){var
    _window=$(window);$('.toTopBtn').on('click',function(){$('#back-top-wrapper a').click();})
    _window.on("resize",function(){resizeFunction();})
    resizeFunction();function resizeFunction(){var
        newWidth=_window.width(),marginHalf=_window.width()/-2;
        ;$('.home .google-map-api').css({width:newWidth,"margin-left":marginHalf,left:'50%'});}});$(function(){var
    menuWrap=$('.header .nav__primary'),offsetArray=[],offsetValueArray=[],_document=$(document),currHash='',isAnim=false,isHomePage=$('body').hasClass('home')?true:false;$('#topnav > li',menuWrap).each(function(){if($(this).hasClass('menu-item-type-custom')){var newUrl=$('header .logo a').attr('href');newUrl+=$('>a',this).attr('href');if(!isHomePage){$('>a',this).attr({'href':newUrl});}}})
    $('.select-menu > option',menuWrap).each(function(){var optionVal=$(this).attr('value');if(optionVal.indexOf('#')!=-1){var newVal=optionVal.substring(optionVal.indexOf('#'),optionVal.length);var newUrl=$('header .logo_h').attr('href');newUrl+=newVal;if(!isHomePage){$(this).attr('value',newUrl);}}})
    getPageOffset();function getPageOffset(){offsetArray=[];offsetValueArray=[];$('.hashAncor').each(function(){var _item=new Object();_item.hashVal="#"+$(this).attr('id');_item.offsetVal=$(this).offset().top;offsetArray.push(_item);offsetValueArray.push(_item.offsetVal);})}
    function offsetListener(scrollTopValue,anim){if(isHomePage){scrolledValue=scrollTopValue;var nearIndex=0;nearIndex=findNearIndex(offsetValueArray,scrolledValue)
        currHash=offsetArray[nearIndex].hashVal;if(window.location.hash!=currHash){if(anim){isAnim=true;$('html, body').stop().animate({'scrollTop':scrolledValue},900,function(){isAnim=false;window.location.hash=currHash;$('html, body').stop().animate({'scrollTop':scrolledValue},0);return false;});}else{window.location.hash=currHash;$('html, body').stop().animate({'scrollTop':scrolledValue},0);return false;}}}}
    function findNearIndex(array,targetNumber){var
        currDelta,nearDelta,nearIndex=-1,i=array.length;while(i--){currDelta=Math.abs(targetNumber- array[i]);if(nearIndex<0||currDelta<nearDelta)
    {nearIndex=i;nearDelta=currDelta;}}
        return nearIndex;}
    $(window).on('mousedown',function(){isAnim=true;})
    $(window).on('mouseup',function(){isAnim=false;offsetListener(_document.scrollTop(),false);})
    $(window).on('mousewheel',function(event,delta){offsetListener(_document.scrollTop(),false);})
    $(window).on('resize',function(){getPageOffset();})
    $('#topnav > li a[href^="#"]').on('click',function(e){e.preventDefault();var target=this.hash,$target=$(target);if($target.length!=0){offsetListener($target.offset().top,true);}
        return false;});$(window).on('hashchange',function(){var target=window.location.hash?window.location.hash:offsetArray[0].hashVal;$('.active-menu-item').removeClass('active-menu-item');$('#topnav > li a[href="'+ target+'"]',menuWrap).parent().addClass('active-menu-item');}).trigger('hashchange');});function RandomOfRange(min,max,isRound){var res;if(isRound){res=Math.round(Math.random()*(max-min)+min);}else{res=Math.random()*(max-min)+min;}
    return res;}