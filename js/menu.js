$( document ).ready(function() {
    if($.cookie('sidebar') === 'off'){
        $('div#sidebar').attr('class', '');
    }
    $('#sidebar_toggle').click(function() {
            if($('div#sidebar').attr('class')==='on'){
                $('div#sidebar_inner').animate({"margin-left": '-=200'}, 'slow');
                $('div#sidebar').toggleClass('on');
                $('div#sidebar').animate({width:'0px'}, 'slow');
                displaySideBar('off');
            }else{
                $('div#sidebar').animate({width:'200px'},"slow");
                $('div#sidebar').toggleClass('on');
                $('div#sidebar_inner').animate({"margin-left": '+=200'}, 'slow');
                displaySideBar('on');
            }
    });
    
    function getTopOffset(e) { 
	var y = 0;
	do { y += e.offsetTop; } while (e = e.offsetParent);
	return y;
    }
    var block = document.getElementById('menu'); /* fixblock - значение атрибута id блока */
    if ( null != block ) {
            var topPos = getTopOffset( block );

            window.onscroll = function() {
                    var scrollHeight = Math.max( document.documentElement.scrollHeight, document.documentElement.clientHeight),

                        // определяем высоту рекламного блока
                        blockHeight = block.offsetHeight,

                        // вычисляем высоту подвала, footer заменить на значение атрибута id подвала
                        footerHeight = document.getElementById('footer').offsetHeight, 	    

                        // считаем позицию, до которой блок будет зафиксирован 
                        stopPos = scrollHeight - blockHeight - footerHeight; 

                    var newcss = (topPos < window.pageYOffset) ? 
                            'top:20px; position: fixed; z-index:5;' : 'position:static;';

                    if ( window.pageYOffset > stopPos ) 
                            newcss = 'position:static;';

                    block.setAttribute( 'style', newcss );
            }
    }   
        
        
});

function displaySideBar(sidebar) {
    
    $.cookie('sidebar',sidebar,{expires: 24*60*60, path: '/'});
    
}

