$(document).ready(function (){
    $("input[name='dt']").on("change",function (){
        let type = $("input[name='dt']:checked").val();
        let msg = "";
        switch (type){
            case "boxOffice":
                msg = "날짜를 입력하세요"; break;
            case "movieInfo":
                msg = "영화제목을 입력하세요"; break;
            case "actor":
                msg = "배우이름을 입력하세요"; break;
        }
        $("#inputValue").attr("placeholder", msg);
        return false;
    });
    $("#inputValue").on("keyup",function (){
        if( $(this).val() == 0 ) $("#searchBtn").addClass("disabled");
        else  $("#searchBtn").removeClass("disabled");
        return false;
    })
})
function search(){
    $("#result").html("<div class=\"spinner-border\" role=\"status\">\n" +
        "  <span class=\"visually-hidden\">Loading...</span>\n" +
        "</div>");
    let type = $("input[name='dt']:checked").val();
    let inputValue = $("#inputValue").val();
    if(!type){
        alert("검색 타입을 설정하세요");
        return false;
    }
    if(!inputValue){
        alert("값을 입력하세요");
        $("#inputValue").addClass("is_invalid");
        return false;
    }
    let url = "";
    let key = "fe595fd3f0a5b3d337d3d0ba2e30d810";
    let param = "";
    switch (type){
        case "boxOffice":
            url = " http://www.kobis.or.kr/kobisopenapi/webservice/rest/boxoffice/searchDailyBoxOfficeList.json?targetDt="+inputValue+"&key="+key;
            break;
        case "movieInfo":
            url = "http://www.kobis.or.kr/kobisopenapi/webservice/rest/movie/searchMovieList.json?movieNm="+inputValue+"&key="+key;
            break;
        case "actor":
            url = "http://www.kobis.or.kr/kobisopenapi/webservice/rest/people/searchPeopleList.json?peopleNm="+inputValue+"&key="+key;
            break;
    }
    $.ajax({
        url: url,
        type: "GET",
        success:function (d){
            console.log(d);
            if(type = "actor"){
                let data = d.peopleListResult.peopleList;
                printResult(data);
            }
        },
        error:function (e){
            alert("error");
        }
    });
}
function printResult(data){
    let html = "";
    for(let i = 0; i < data.length; i++){
        let t = "<div class='card mt-3'>" +
            "<div class = 'card-header'>"+ data[i].peopleNm +"</div>" +
            "<div class = 'card-body'>"+data[i].filmoNames+"</div>" +
            "</div>";
        html = html + t;
    }
    $("#result").html(html);
}