let auth_key;
$.get("key.txt",function (data){
    auth_key = data;
});
console.log(auth_key);
function getLine(){
    $('#train_line').find('option:not(:first)').remove();
    $('#origin').find('option:not(:first)').remove();
    $('#destination').find('option:not(:first)').remove();
    var operator = $('#operator').val();

    const url = "https://api-tokyochallenge.odpt.org/api/v4/odpt:Railway?odpt:operator=odpt.Operator:"+operator+"&acl:consumerKey="+auth_key;
    // console.log(url);
    $.getJSON(url,(data)=>{
        $(data).each((i)=>{
            var option_value = data[i]['owl:sameAs'];
            var title = data[i]['odpt:railwayTitle']['en'];
            if(data[i]['odpt:stationOrder'].length > 0)
                $('#train_line').append(`<option value="${option_value}">${title}</option>`);
            // else
            //     $('#train_line').append(`<option value="${option_value}" disabled style="color: lightcoral">${title} - 選択不可</option>`);
        });
    });

}

function getStation(){
    $('#origin').find('option:not(:first)').remove();
    $('#destination').find('option:not(:first)').remove();
    var line = $('#train_line').val();
    const station_url = "https://api-tokyochallenge.odpt.org/api/v4/datapoints/"+line+"?acl:consumerKey="+auth_key;
    $.getJSON(station_url,(data)=>{
        $(data[0]['odpt:stationOrder']).each((i)=>{
            var option_value = data[0]['odpt:stationOrder'][i]['odpt:station'];
            var title = data[0]['odpt:stationOrder'][i]['odpt:stationTitle']['en'];
            $('#origin').append(`<option value="${option_value}">${title}</option>`);
            $('#destination').append(`<option value="${option_value}">${title}</option>`);
        });
    });
}

function resetValue(){
    $('#train_line').find('option:not(:first)').remove();
    $('#origin').find('option:not(:first)').remove();
    $('#destination').find('option:not(:first)').remove();
    $('#error').remove();
}

