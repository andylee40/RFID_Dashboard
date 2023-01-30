$(function(){
 setInterval(getalarm,100)
//  setInterval(getcheck,100)
 
})

function getalarm (){
 $.ajax({
   type: 'GET',                     //GET or POST
   url: "./read_mysql2.php",  //請求的頁面
   cache: false,   //是否使用快取
   dataType : 'json',
   success: function(result){   //處理回傳成功事件，當請求成功後此事件會被呼叫
  //alert(result);
  //$('#title').text(result);
  $('#error2').text(result.error2);
   },
   error: function(result){   //處理回傳錯誤事件，當請求失敗後此事件會被呼叫
  //your code here
  alert("發生錯誤");
  console.log(result);
   },
       });
}


// function getcheck (){
//  $.ajax({
//    type: 'GET',                     //GET or POST
//    url: "./read_mysql.php",  //請求的頁面
//    cache: false,   //是否使用快取
//    dataType : 'text',
//    success: function(result2){   //處理回傳成功事件，當請求成功後此事件會被呼叫
//   //alert(result);
//   //$('#title').text(result);
//   $('#ab').text(result2);
//    },
//    error: function(result2){   //處理回傳錯誤事件，當請求失敗後此事件會被呼叫
//   //your code here
//   alert("發生錯誤");
//   console.log(result2);
//    },
//        });
// }