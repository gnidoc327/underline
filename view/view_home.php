<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2/13/2016 013
 * Time: 5:36 PM
 */


?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=320, initial-scale=1">
    <!-- Stylesheets
    ============================================= -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />

    <!--    <link rel="stylesheet" href="/css/font-icons.css" type="text/css" />-->

    <link rel="stylesheet" href="assets/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="assets/css/login.css" type="text/css" />
    <link rel="stylesheet" href="assets/css/user.css" type="text/css" />
    <link rel="stylesheet" href="assets/css/home.css" type="text/css" />
    <link rel="stylesheet" href="assets/css/font.css" type="text/css" />
    <!--[if lt IE 9]>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>

    <![endif]-->

    <!-- External JavaScripts
    ============================================= -->
<!--    <script type="text/javascript" src="/js/jquery.js"></script>-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <!-- Document Title
    ============================================= -->
    <title>UNDERLINE</title>

</head>

<body id="body" class="">
<div id="box">
    <div id="header">
        <div id="header-left">
            <a href="#openModal" class="header-setting"><span class="icon-cog"></span></a>
            <div id="openModal" class="modalDialog">
                <div><a href="#close" title="Close" class="close"><img src=".././assets/img/close-btn.png" alt=""></a>
                    <p>닉네임 수정</p>
                    <div class="modal-field">
                        <img src=".././assets/img/profile.png" alt=""> <!-- src="<%= user.profileUrl %>" -->
                        <input id="fileupload" class="image-file-upload-btn hided-input-file-btn is-edit-mode" type="file" name="files[]" data-url="/file">
                        <input class="input-nickname" type="text" placeholder="닉네임을 입력하세요">
                        <div class="modal-save-btn">저장하기</div>
                    </div>
                </div>
            </div>
        </div>
        <div id="title">
            <p>LINE</p>
        </div>
        <div id="header-right">
            <div id="header-min">
                <span class="icon-minus"></span>
            </div>
            <div id="header-max">
                <span class="icon-checkbox-unchecked"></span>
            </div>
            <div id="header-close">
                <a href="/logout"><span class="icon-cross"></span></a>
            </div>
        </div>
        <div id="header-bottom">
            <div>
                <span class="icon-users"></span>
            </div>
            <div>
                <span class="icon-bubble"></span>
            </div>
            <div class="header-showroom">
                <span class="icon-bubbles3"></span>
            </div>
            <div>
                <span class="icon-user-plus"></span>
            </div>
        </div>
    </div>

    <!-------- content
    -------------------------- -->
    <div id="content">

        <!-------- roomlist
        -------------------------- -->
        <div id="roomlist">
            <div class="roomlist-header">
                <form action="" class="roomlist-search">
                    <div class="roomlist-search-left">
                        <div class="roomlist-search-icon">
                            <span class="icon-search"></span>
                        </div>
                        <input type="text" placeholder="대화방, 메시지 입력">
                    </div>
                    <div class="roomlist-search-right">
                        <div>
                            <span class="icon-menu3"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="roomlist-body">
                <ul>
            <?php
                $result = Model::get_all_room();

                foreach ($result as $row) {
            ?>
                    <li class="roomlist-entry room_id<?= $row['room_id']?>" onclick="to_room(this,'<?= $row['room_id']?>')" >
                        <div class="roomlist-entry-photo">
                            <p style="background: <? //$row['img'] ?>"></p>
                        </div>
                        <div class="roomlist-entry-info">
                            <div class="roomlist-entry-title">
                                <p>
                                    <?php
                                        echo $row['name'];
                                    ?>
                                </p>
                            </div>
                            <div class="roomlist-entry-time">
                                <p>2016.02.14</p>
                            </div>
                        </div>
                    </li>
                    <?php
                }
            ?>
                </ul>
            </div>

        </div>

        <div id="room-inside">
            <div id="room-inside-header">
                <p>방에 들어오신 것을 환영합니다. <span>(5명)</span></p>
            </div>
            <div id="room-inside-body">
                <ul class="room-inside-talk">
<!--                    <li class="room-inside-talk-entry">-->
<!--                        <div class="room-inside-talk-photo">-->
<!--                            <p>i</p>-->
<!--                        </div>-->
<!--                        <div class="room-inside-talk-text">-->
<!--                            <p class="chat-msg"></p>-->
<!--                        </div>-->
<!--                    </li>-->
                </ul>
                <!-- repeat part-->

            </div>
            <div id="room-inside-bottom">
                <div id="room-inside-bottom-left">
                    <div class="">
                        <span class="icon-plus"></span>
                    </div>
                    <div>
                        <span class="icon-smile"></span>
                    </div>
                    <div>
                        <input type="text" id="chat-user-input">
                    </div>
                </div>
                <div id="room-inside-bottom-right">
                    <div>
                        <span class="icon-phone"></span>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

</body>
</html>


<script>
    $(document).ready(function () {

        /**
         *
         * */
        $("#chat-user-input").keydown(function(key) {
            if(key.keyCode == 13) {
                var user_input = $("#chat-user-input").val();

                $("#chat-user-input").val("");
                $.post("/chat",
                    {
                        user: "<?php $_SESSION['user_id']?>",
                        //room: room_id,
                        msg: user_input,
                        type: "send"
                    },
                    function(data, status){
                        //alert("Data: " + data + "\nStatus: " + status);
                    });
            }
        });


        /**
         *
         * @type {string}
         */
        var chat_recent = "";
        var lodding = 0;
        setInterval(function() {
                $.post(
                    "/chat",
                    {
                        type: "receive"
                    },
                function(data) {

                    var redata = data.substring(1,data.length-1);
                    //alert(data);
                    var obj = jQuery.parseJSON(data);
                    if(lodding < obj.length) {
                        for (var i = lodding; i < obj.length; i++) {
                            //$(".chat-msg").append("<div class=\"chat_id\">" + obj[i].msg + "</div>");

                            //  if(chat_recent == obj[obj.length-1].chat_id)
                            //    break;

                            $(".room-inside-talk").append("<li class=\"room-inside-talk-entry\" chat_id=\"" + obj[i].chat_id + "\">"
                                + "<div class = \"room-inside-talk-photo\">"
                                + "<p>i</p>"
                                + "</div>"
                                + "<div class=\"room-inside-talk-text\">"
                                + "<p class=\"chat-msg\">" + obj[i].msg + "</p>"
                                + "</div>"
                                + "</li>");
                            chat_recent = obj[i].chat_id;

                        }
                        lodding = obj.length;
                    }
                }
                )
        }, 2000);


        /**
         *
         */
//        $(".roomlist-entry").click(function(){
//            var x = $(".roomlist-entry").attr("room_id");
//            alert(x);
//        })



    });


    function to_room(obj, room_id) {

        $.post(
            "/chat",
            {
                user_id: "<?php $_SESSION['user_id']?>",
                room_id: room_id,
                type: "enter"
            },
            function(data, status) {
                $("#room-inside").css("display", "block");
                $("#roomlist").css("display", "none");
            }
        );
    }





</script>