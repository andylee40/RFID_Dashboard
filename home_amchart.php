<!DOCTYPE html> <!--這個用來改NAV-->
<html>
    <head>
    <meta charset="utf-8">
	<!--link rel="shortcut icon" type="image/ico" href="http://www.datatables.net/favicon.ico"-->
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, user-scalable=no">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
    
       <!--div>
        <!style='background-color:white;border-width:3px;border-style:dashed;border-color:#FFAC55;padding:5px;'>
        <form name='theForm' action='#' method="post">
            <p>開始日期:</p>
            <p><input class='form_col'  type="date" name="start" value="2022-10-01" min="2022-10-01" max="2024-12-31"></p>
            <p>結束日期:</p>
            <p><input class='form_col' type="date" name="end"  value="2022-10-02" min="2022-10-02" max="2024-12-31"></p>
            <p>豬隻編號:</p>
            <p><input class='form_col' type="text" name="idd"></p>
            <p><input class='form_col' type="submit" value="查詢" onclick='javascript: return SubmitForm()' /></p>
        </form>
    </div-->
        <div class="container-fluid" style="margin-top:1em;">
                <div class="row" >
                      <div class="col-4" style="font-size:25px;">
                            <style='background-color:white;border-width:3px;border-style:dashed;border-color:#FFAC55;padding:5px;'>
                            <form name='theForm' action='#' method="post">
                                <p>開始日期:</p>
                                <p><input class='form_col'  type="date" name="start" value="2022-10-01" min="2022-10-01" max="2024-12-31"></p>
                                <p>結束日期:</p>
                                <p><input class='form_col' type="date" name="end"  value="2022-10-02" min="2022-10-02" max="2024-12-31"></p>
                                <p>豬隻編號:</p>
                                <p><input class='form_col' type="text" name="idd"></p>
                                <p><input class='form_col' type="submit" value="查詢" onclick='javascript: return SubmitForm()' /></p>
                            </form>
                      </div>
                        <div class="col-3" style="margin-top:5em;"> 
                               <div style="font-size:25px;border:2px solid black;border-radius:10%;height:150px;padding:.3em;"><span>
                                    <script> document.write(new Date().toLocaleDateString()); </script></span> 問題豬隻編號
                                   <h2 id="error2" style="margin-top:20px;"></h2>
                               </div>
                        </div>
                          <div class="col-3" style="margin-top:5em;"> 
                               <div style="font-size:25px;border:2px solid black;border-radius:10%;height:150px;padding:.3em;"> 本日問題豬隻數量與比例
                                   <h2 id="" style="margin-top:20px;">5%</h2>
                               </div>
                        </div>
                </div>
    </div>    
    <iframe name='frame_result1' width='450px' height='600px'  style="border: 1px solid black;"></iframe>
    <iframe name='frame_result2' width='450px' height='600px' style="border: 1px solid black;"></iframe>
    <iframe name='frame_result3' width='550px' height='600px' style="border: 1px solid black;"></iframe>
 
                                        


                

 </body>
</html>