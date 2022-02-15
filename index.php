<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Data</title>
</head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia&effect=neon|outline|emboss|shadow-multiple">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia&effect=fire">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai+Looped:wght@300&display=swap" rel="stylesheet">
<style>
    *{
        box-sizing: border-box;
    }
    .container{
        display:flex;
        text-align: center;
        font-family: 'IBM Plex Sans Thai Looped', sans-serif;
    }
    h1 {text-align: center;
        font-family: 'IBM Plex Sans Thai Looped', sans-serif;
        margin-top: 50px;
    }
    .temp{
        border: #b3ff00;
    }
    body{
        font-family: 'Poppins', sans-serif;
    }
    .column{
        float: left;
        width: 33.33%;
        padding: 100px;
        height: 100px;
    }
    .card{
        max-width: 400px;
        margin: auto;
        height: 200px;
        width: 100%;
        margin-bottom: 20px;
        margin-top: 20px;
        text-align: center;
        background-color: rgb(255, 255, 255);
        
    }
    .row{
        font-family: 'IBM Plex Sans Thai Looped', sans-serif;
        font-size: larger;
        border: forestgreen;
        background-color: rgb(255, 255, 255);
        margin-bottom: 20px;
        margin-top: 50px;
    }

</style>
<body>
    <h1>ข้อมูลสภาพอากาศ</h1>

    <div class="row">
        <div class="col-sm-4">
                <div class="card">
                    <span style="margin-top: 20px;">อุณหภูมิ</span>
                    <span id="temp"></span>
                </div>
                
        </div>
        <div class="col-sm-4" >
                <div class="card">
                    <span style="margin-top: 20px;">ความชื้น</span>
                    <span id="hum"></span>
                </div>
        </div>
        <div class="col-sm-4" >
                <div class="card">
                    <span style="margin-top: 20px;">สถานะไฟ</span>
                    <span id="LED"></span>
                </div>
        </div>
    </div>


    <div class="container">
        <div class="temp">
            <h4 >อุณหภูมิ</h4>
            <iframe width="450" height="260" style="border: 4px solid #000000;" src="https://thingspeak.com/channels/1648395/charts/1?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&title=TEMP&type=line"></iframe>
    
        </div>
        <div class="hum">
            <h4>ความชื้น</h4>
            <iframe width="450" height="260" style="border: 4px solid #000000;" src="https://thingspeak.com/channels/1648395/charts/2?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&title=Humidity&type=line"></iframe>
        
        </div>
        <div class="LED">
            <h4>LED</h4>
            <iframe width="450" height="260" style="border: 4px solid #000000;" src="https://thingspeak.com/channels/1648395/charts/4?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&type=line&update=15"></iframe>
        </div>
    </div>
</body>

<script>
    function loadData(){
        var status;
        var url = "https://api.thingspeak.com/channels/1648395/feeds.json?results=2"

        $.getJSON(url)
            .done((data)=>{
                console.log(data)

                var hum = data.feeds[0].field2;
                var floathum = parseFloat(hum).toFixed(2);

                var temp = data.feeds[0].field1;
                var floattemp = parseFloat(temp).toFixed(2);
                    console.log(floattemp)

                var LED = data.feeds[0].field4; 

                if(LED == 0){
                    status = "OFF"
                }else if (LED == 1){
                    status = "ON"
                }

                $("#temp").text(floattemp);
                $("#hum").text(floathum);
                $("#LED").text(status);
            }).fail((xhr, status, err)=>{
                console.log("ERROR")
            })
    }
    $(()=>{
        loadData();
    })

</script>
</html>