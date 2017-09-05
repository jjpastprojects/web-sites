$(window).load(function(){
    var overlay_html = '<div id="overlay" class="overlay">' +
        '<div id="my_awesome_iframe_container">' +
        '<iframe id="1click_iframe" width=100% height=100% frameborder=0></iframe>' +
        '</div>' +
        '</div>';

//need to get the name of the extension


    function clickHandler(e){
        var plugin_name = this.parentNode.dataset.name;
        e.preventDefault();

        var iframe = document.querySelector('#my_awesome_iframe_container iframe');

        var email_sections = document.querySelectorAll('.vN.Y7BVp.a3q');
        var emails = [];

        for (var i = 0; i < email_sections.length; i++) {
            var email_section = email_sections[i];

            if (email_section.getAttribute('email')){
                emails.push(email_section.getAttribute('email'));
            }

        }

        iframe.src = chrome.extension.getURL('src/page_action/page_action.html') + '?emails=' + emails.join()+ "#buttons";
//	setts.child = new_win(url + "/plugin-install.php?tab=plugin-information&plugin=" + plugin_name +"&TB_iframe=true&width=600&height=550",'new_win',600,550);

        document.querySelector('#overlay').classList.add('show');
        document.querySelector('#overlay').onclick = removeOverlay;
//	window.onfocus = removeOverlay;


    }
    function removeOverlay(){

        document.getElementById("overlay").classList.remove('show');
        var iframe = document.querySelector('#my_awesome_iframe_container iframe');
        iframe.src = '';
    }

    document.addEventListener("DOMNodeInserted", function(event){

        var emoticon_sections = document.querySelectorAll('td.ZGHj2e');

        //return if emoticon_section is not there
        if ((!emoticon_sections.length) || (emoticon_sections.length<1))
          return;


        if(emoticon_sections.length){

          for (var i = 0; i < emoticon_sections.length; i++) {
              var emoticon_section = emoticon_sections[i];

              //if not fully loaded
              if (!emoticon_section.firstChild)
                continue

              var gift_icons = emoticon_section.querySelector('div.gift');

              //skip if gift icon is
              if (gift_icons )
                continue;

              //add gift icon

              //plugin_name = link.href.split('/').pop().split('.')[0];
              var gift_icon = document.createElement('div');
              gift_icon.className = 'gift';

              var imgURL = chrome.extension.getURL("icons/gift.png");
              gift_icon.style.backgroundImage = "url('"+imgURL+"')";

              gift_icon.innerHTML = ' ';
//
//  p.className = "button special-plugin-button";
              emoticon_section.firstChild.appendChild(gift_icon);

              //p.dataset.name = plugin_name;
              gift_icon.addEventListener('click',clickHandler,true);
              document.querySelector('body').insertAdjacentHTML('beforeend',overlay_html);
          }

}
    });

});


