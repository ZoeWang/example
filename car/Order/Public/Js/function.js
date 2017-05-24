
$(document).ready(function(){
    $("#anniu_h").click(function(){
        $(".left").hide();
        $("#anniu_h").hide();
        $(".right").css("width","100%");
        $("#anniu_p").show();
    });
    $("#anniu_p").click(function(){
        $(".left").show();
        $("#anniu_p").hide();
        $(".right").css("width","86%");
        $("#anniu_h").show();
    });
    var win_h=$(window).height()-105;
    $(".middle").css("height",win_h+"px");
});

function guanbi(i){
   $("#hid_"+i).hide();
   $("#lm_1_"+i).hide();
   $("#lm_2_"+i).show();
}
function dakai(i){
   $("#hid_"+i).show();
   $("#lm_1_"+i).show();
   $("#lm_2_"+i).hide();
}