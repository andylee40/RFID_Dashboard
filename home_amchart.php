<!DOCTYPE html> <!--這個用來改NAV-->
<html>
    <head>
    <meta charset="utf-8">
	<!--link rel="shortcut icon" type="image/ico" href="http://www.datatables.net/favicon.ico"-->
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, user-scalable=no">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" />
    <!--link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"-->
	<title>RFID豬隻行為圖表</title>
    <style>
    body{ width: 80%; 
          margin:0 10% 0 10%;}
    .form_col{background-color:Gainsboro;font-size:16pt;}
//     form{margin-left:10%}
    </style>
    <script> 
    function SubmitForm()
    {
        document.forms['theForm'].action='amchart1.php';
        document.forms['theForm'].target='frame_result1';
        document.forms['theForm'].submit();

        document.forms['theForm'].action='amchart2.php';
        document.forms['theForm'].target='frame_result2';
        document.forms['theForm'].submit();
    
        document.forms['theForm'].action='amchart3.php';
        document.forms['theForm'].target='frame_result3';
        document.forms['theForm'].submit();
        return true;
    }
    </script>
    <script src="./echo.js" ></script>
    </head>
    
    <body>
        <div  style="margin-top:2em;"></div>
        <form name='theForm' action='#' method="post">
          <div class="form-row" >
            <div class="form-group col-md-4">
              <label for="start">開始日期</label>
              <input type="date" class="form-control"  name="start" id="start" value="2022-10-01" min="2022-10-01" max="2024-12-31">
            </div>
            <div class="form-group col-md-4">
              <label for="end">結束日期</label>
              <input type="date" class="form-control"  name="end" id="end" value="2022-10-02" min="2022-10-02" max="2024-12-31">
            </div>
             <div class="form-group col-md-4">
              <label for="idd">豬隻編號</label>
              <input type="text" class="form-control"  name="idd" id="idd">
            </div>
          </div>
          
          <br>
                  
             <div class="form-group" style='margin-left:15px'>
                   <input type="submit"  value="查詢" onclick='javascript: return SubmitForm()' />
            <div>
          
        </form>
    <br>          
    <iframe name='frame_result1' width='500px' height='600px'  style="border: 1px solid black;"></iframe>
    <iframe name='frame_result2' width='500px' height='600px' style="border: 1px solid black;"></iframe>
    <iframe name='frame_result3' width='500px' height='600px' style="border: 1px solid black;"></iframe>
 
                                        


                

 </body>
</html>