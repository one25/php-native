$(document).ready(function() {
   $("body").on("change", ".upload_field", function(){$(".upload_submit").click();});
   $("body").on("click", ".buttonsearch", function(){BaseRecord.search($(".textsearch").val());});
   $("body").on("keydown", ".textsearch", function(){if(event.which==13) {BaseRecord.search($(".textsearch").val());return false;}});
   $("body").on("click", "[name='sort_bottom']", function(){BaseRecord.sort('asc');});
   $("body").on("click", "[name='sort_top']", function(){BaseRecord.sort('desc');});
   $("body").on("click", ".order", function(){BaseRecord.order($(this).attr('value'));});
   BaseRecord.currency();
});
var BaseRecord={

search:function(search_marka) {
  var ajaxSetting={
     method:"post",
     url:"index.php",
     data:"hook=AjaxSearch/"+search_marka,
     success:function(data) {
        //alert(data);
        var data_json=JSON.parse(data);
        var str_json="";
        for(var i in data_json) {
           str_json+='<tr><td class="center"><button type="button" class="order" value="'+data_json[i]['id']+'">order</button></td><td><a href="?page=cart&hook=Cart/'+data_json[i]['id']+'">'+data_json[i]['marka']+'</a></td><td>'+data_json[i]['model']+'</td><td>'+data_json[i]['price']+'</td><td><img src="'+data_json[i]['image']+'" alt /></td><td class="center"><button name="hook" value="Remove/'+data_json[i]['id']+'">remove</button></td></tr>';
        }
        $(".tbody").html(str_json);
     },
  };
  $.ajax(ajaxSetting);
},

sort:function(sort_way) {
  var ajaxSetting={
     method:"post",
     url:"index.php",
     data:"hook=AjaxSort/"+sort_way,
     success:function(data) {
        //alert(data);
        var data_json=JSON.parse(data);
        var str_json="";
        for(var i in data_json) {
           str_json+='<tr><td class="center"><button type="button" class="order" value="'+data_json[i]['id']+'">order</button></td><td><a href="?page=cart&hook=Cart/'+data_json[i]['id']+'">'+data_json[i]['marka']+'</a></td><td>'+data_json[i]['model']+'</td><td>'+data_json[i]['price']+'</td><td><img src="'+data_json[i]['image']+'" alt /></td><td class="center"><button name="hook" value="Remove/'+data_json[i]['id']+'">remove</button></td></tr>';
        }
        $(".tbody").html(str_json);
     },
  };
  $.ajax(ajaxSetting);
},

order:function(id) {
  var ajaxSetting={
     method:"post",
     url:"index.php",
     data:"hook=AjaxOrder/"+id,
     success:function(data) {
        //alert(data);
        var data_json=JSON.parse(data);
        for(var i in data_json) {
         if(i == 'success') {
           if(data_json[i]['mail'] && data_json[i]['request']) {
              alert('Your message was sended...');
           }
         }
         if(i == 'error') {
            alert(data_json[i]);
         }
        }
     },
  };
  $.ajax(ajaxSetting);
},

currency: function() {
  var ajaxSetting={
     method:"post",
     url:"index.php",
     data:"hook=AjaxCurrency",
     success:function(data) {
        //alert(data);
         var data_json=JSON.parse(data);
         for(var i in data_json) {
            if(data_json[i]['Cur_ID'] == 145) $('.currency_usd_value').html(data_json[i]['Cur_OfficialRate']);
            if(data_json[i]['Cur_ID'] == 292) $('.currency_eur_value').html(data_json[i]['Cur_OfficialRate']);
         }
     },
  };
  $.ajax(ajaxSetting);
},

};
