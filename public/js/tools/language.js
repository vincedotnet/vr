function setLanguage(language) {
    localStorage.setItem("language", language);

    url = location.href;

    if (language == "en") {
        url = url.replace("?language=cn", "?language=en");

        if (url.indexOf("?language=en") < 0) {
            url = url + "?language=en";
        }
    }
    else {
        url = url.replace("?language=en", "");
    }

    location.href = url;
}


// JavaScript Document
function loadjscssfile(filename,filetype){
    if(filetype == "js"){
        var fileref = document.createElement('script');
        fileref.setAttribute("type","text/javascript");
        fileref.setAttribute("src",filename);
    }else if(filetype == "css"){
        var fileref = document.createElement('link');
        fileref.setAttribute("rel","stylesheet");
        fileref.setAttribute("type","text/css");
        fileref.setAttribute("href",filename);
    }
    if(typeof fileref != "undefined"){
        document.getElementsByTagName("head")[0].appendChild(fileref);
    }
}

$(document).ready(function() {
    var language = localStorage.getItem("language");

    var url = location.href;

    if (url.indexOf("?language=en") > -1) {
        language = "en";
    }
    else {
        language = "cn";
    }

    localStorage.setItem("language", language);

    if (language == "en") {
        $(".cn").hide();
        $(".en").show();
        $(".en-select").addClass("selected");

        loadjscssfile("/css/py_global_en.css","css");
    }
    else {
        $(".en").hide();
        $(".cn").show();
        $(".cn-select").addClass("selected");
    }
});