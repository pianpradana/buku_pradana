var clientHeight = document.documentElement.clientHeight;
    $(window).on('resize', function () {
      var nowClientHeight = document.documentElement.clientHeight;
      if (clientHeight > nowClientHeight) {
        $(".editor-options").css("bottom", "0px");

      } else {
        $(".editor-options").css("bottom", "0px");
      }
    });
    $(function () {
      resizeHeight();
      $(".editor-textStyle-item div").click(function () {
        var target = this;
        if ($(target).hasClass("editor-textStyle-color")) { //editor-textStyle-color--------------------------------------------------------------------------------------------------------------
          var styleArr = ["#232323", "#2196F3", "#795548", "#00BCD4", "#4CAF50", "#E666E5", "#FF9800", "#FF5722", "#ff2a1a", "#ff2a1a", "#FFEB3B", "#fff"];
          var Str = "", borderStr = "";
          for (e in styleArr) {
            if (styleArr[e] == "#fff") {
              borderStr = "border:1px solid #e4e4e4;"
            }
            Str += "<li><span class='textStyle-color-span' style='background-color:" + styleArr[e] + ";" + borderStr + "'></span></li>";
          }
          $(".editor-options").fadeIn(100).html("<div class='optsHead' style='margin: 10px 13px;border-bottom: 1px solid #ccc;padding-bottom: 10px;'>Text Color<span class='removeOpts' style='float:right;'>Reset</span></div><ul>" + Str + "<li style='clear:both;'></li></ul>");
          $(".textStyle-color-span").click(function (i, n) {
            $(".editor-options").fadeOut(100);
            $(target).attr("dataStyleRS", $(this).css('background-color'));
            $(target).addClass("editor-active");
            userInput();
          })
          $(".removeOpts").click(function () {
            $(".editor-options").fadeOut(100);
            $(target).attr("dataStyleRS", "#232323");
            $(target).removeClass("editor-active");
            userInput();
          })
        } else if ($(target).hasClass("editor-textStyle-linedecoration")) {
          var styleArr = ["overline", "line-through", "underline"];
          var Str = "";
          for (e in styleArr) {
            Str += "<li class='textStyle-linedecoration-li' style='width:100%;padding-bottom: 20px;border-bottom: 1px solid #ccc;text-decoration-line:" + styleArr[e] + ";'>Underline</li>";
          }
          $(".editor-options").fadeIn(100).html("<div style='margin: 10px 13px;border-bottom: 1px solid #ccc;padding-bottom: 10px;'>Underline<span class='removeOpts' style='float:right;'>Reset</span></div><ul>" + Str + "<li style='clear:both;'></li></ul>");
          $(".textStyle-linedecoration-li").click(function (i, n) {
            $(".editor-options").fadeOut(100);
            $(target).attr("dataStyleRS", $(this).css('text-decoration-line'));
            $(target).addClass("editor-active");
            userInput();
          })
          $(".removeOpts").click(function () {
            $(".editor-options").fadeOut(100);
            $(target).attr("dataStyleRS", "none");
            $(target).removeClass("editor-active");
            userInput();
          })
        } else if ($(target).hasClass("editor-textStyle-bgColor")) {
          var styleArr = ["#232323", "#2196F3", "#795548", "#00BCD4", "#4CAF50", "#E666E5", "#FF9800", "#FF5722", "#ff2a1a", "#ff2a1a", "#FFEB3B", "#fff"];
          var Str = "", borderStr = "";
          for (e in styleArr) {
            if (styleArr[e] == "#fff") {
              borderStr = "border:1px solid #e4e4e4;"
            }
            Str += "<li><span class='textStyle-color-span' style='background-color:" + styleArr[e] + ";" + borderStr + "'></span></li>";
          }
          $(".editor-options").fadeIn(100).html("<div class='optsHead' style='margin: 10px 13px;border-bottom: 1px solid #ccc;padding-bottom: 10px;'>BG Color<span class='removeOpts' style='float:right;'>Reset</span></div><ul>" + Str + "<li style='clear:both;'></li></ul>");
          $(".textStyle-color-span").click(function (i, n) {
            $(".editor-options").fadeOut(100);
            $(target).attr("dataStyleRS", $(this).css('background-color'));
            $(target).addClass("editor-active");
            userInput();
          })
          $(".removeOpts").click(function () {
            $(".editor-options").fadeOut(100);
            $(target).attr("dataStyleRS", "white");
            $(target).removeClass("editor-active");
            userInput();
          })
        } else if ($(target).hasClass("editor-textStyle-fontSize")) {
          var styleArr = ["12px", "14px", "16px", "18px", "20px", "25px", "30px"];
          var Str = "";
          for (e in styleArr) {
            Str += "<li class='textStyle-linedecoration-li' style='width:100%;padding-top: 20px;padding-bottom: 20px;border-bottom: 1px solid #ccc;font-size:" + styleArr[e] + ";'>" + styleArr[e] + "</li>";
          }
          //打开
          $(".editor-options").fadeIn(100).html("<div style='margin: 10px 13px;border-bottom: 1px solid #ccc;padding-bottom: 10px;'>Font Size<span class='removeOpts' style='float:right;'>Reset</span></div><ul style='margin: 0 13px;'>" + Str + "<li style='clear:both;'></li></ul>");
          $(".textStyle-linedecoration-li").click(function (i, n) {
            $(".editor-options").fadeOut(100);
            $(target).attr("dataStyleRS", $(this).text());
            $(target).addClass("editor-active");
            userInput();
          })
          $(".removeOpts").click(function () {
            $(".editor-options").fadeOut(100);
            $(target).attr("dataStyleRS", "14px");
            $(target).removeClass("editor-active");
            userInput();
          })
        } else if ($(target).hasClass("editor-textStyle-lineHeight")) {
          var styleArr = ["20px", "25px", "30px", "35px", "45px"];
          var Str = "";
          for (e in styleArr) {
            Str += "<li class='textStyle-linedecoration-li' style='width:100%;padding-bottom: 20px;border-bottom: 1px solid #ccc;'>" + styleArr[e] + "</li>";
          }
          $(".editor-options").fadeIn(100).html("<div style='margin: 10px 13px;border-bottom: 1px solid #ccc;padding-bottom: 10px;'>Line Height<span class='removeOpts' style='float:right;'>Reset</span></div><ul>" + Str + "<li style='clear:both;'></li></ul>");
          $(".textStyle-linedecoration-li").click(function (i, n) {
            $(".editor-options").fadeOut(100);
            $(target).attr("dataStyleRS", $(this).text());
            $(target).addClass("editor-active");
            userInput();
          })
          $(".removeOpts").click(function () {
            $(".editor-options").fadeOut(100);
            $(target).attr("dataStyleRS", "14px");
            $(target).removeClass("editor-active");
            userInput();
          })
        } else if ($(target).hasClass("editor-textStyle-align")) {
          $(".editor-textStyle-align").removeClass("editor-active");
          $(this).addClass("editor-active");
          userInput();
        } else {
          $(target).toggleClass("editor-active");
          userInput();
        }
      })
    })
    function resizeHeight() {
      var h = $(window).height() / 2;
      $("#textStyle-container1").css("height", h + "px");
      $("#textStyle-container2").css("height", h + "px");;
      $("#editor-textarea").height(h - $(".editor-textStyle").height() + "px");
      $(".editor-options").css("bottom", "0px");
    }
    function userInput(e) {
      var obj = {};
      $(".editor-textStyle-item div").each(function () {
        if ($(this).hasClass("editor-textStyle-align")) { //editor-textStyle-align水平
          if ($(this).hasClass("editor-active")) {
            obj["text-align"] = $(this).attr("dataStyleRS");
          }
        } else if ($(this).hasClass("editor-textStyle-bold")) { //editor-textStyle-bold水平
          if ($(this).hasClass("editor-active")) {
            obj["font-weight"] = $(this).attr("dataStyleRS");
          } else {
            obj["font-weight"] = 400;
          }
        } else {
          obj[$(this).attr("dataStyle")] = $(this).attr("dataStyleRS");
        }
      })
      console.log(obj);
      if (e == "1") {
        return obj;
      } else {
        $("#editor-textarea").css(obj);
      }
    }
    function clearEditor() {
      $('#editor-textarea').empty();
      $('#editor-textarea').css("background-color", "#fff");
    }
    function OKEditor() {
      var length = $(".editorpart").length;
      if (userInput(1)["text-align"] != undefined && userInput(1)["text-align"] != "left") {
        if($("#textStyle-container1 .editor-active").length>0){
          $("#textStyle-container1 .editor-active").after("<p style='display:none;'   class='editorpart'>" + $('#editor-textarea').html() + "</p>");
        }else{
          $("#textStyle-container1").append("<p style='display:none;' class='editorpart'>" + $('#editor-textarea').html() + "</p>");
          $(".editorpart").eq(length).css(userInput(1)).fadeIn();
        }
      } else {
        if($("#textStyle-container1 .editor-active").length>0){
          $("#textStyle-container1 .editor-active").after("<span style='display:none;'   class='editorpart'>" + $('#editor-textarea').html() + "</span>");
          $("#textStyle-container1 .editor-active").next().css(userInput(1)).fadeIn();
          $(".editorpart").removeClass("editor-active");
        }else{
          $("#textStyle-container1").append("<span style='display:none;'  class='editorpart'>" + $('#editor-textarea').html() + "</span>");
          $(".editorpart").eq(length).css(userInput(1)).fadeIn();
        }
      }
      reNumber();
      clearEditor();
      $(".editorpart").click(function () {
        $('.editorpartOpts').fadeOut().remove();
        $(".editorpart").removeClass("editor-active");
        $(this).addClass("editor-active");
        $(this).append("<ul class='editorpartOpts'><li>after</li><li>line</li><li>delete</li><li>cancel</li></ul>");
        $(".editorpartOpts li").click(function () {
          event.stopPropagation();
          if ($(this).text() == "after") {
            $("#editor-textarea").empty().focus();
          }else if ($(this).text() == "line") {
            $("#textStyle-container1 .editor-active").after("<hr />");
            $(".editorpart").removeClass("editor-active");
          } else if ($(this).text() == "delete") {
            $(this).parent().parent().remove();
            reNumber();
          }else{
            $(this).parent().parent().removeClass("editor-active");
          }
          $(this).parent().remove();
        })
      })

    }
    function reNumber(){
      for(var i=0;i<$(".editorpart").length;i++){
        $(".editorpart").eq(i).attr("id","editorpart"+i);
      }
    }
