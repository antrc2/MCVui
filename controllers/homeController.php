<?php
    class homeController{
        public $home;
        function __construct(){
            $this->home = new homeModel;
        }
        function home(){
            $server = $this->home->getInformationOfServer("mcvui.net");
            // $server = "fail";
            if($server === "fail" || $server === false){
                $classStatus = "offline";
                $status = "Ngoại tuyến";
                $online = 0;
            } else {
                $classStatus = "online";
                $status = "Trực tuyến";
                $online = $server['players']['online'];
            }
            $discordInformation = $this->home->getDiscordLinkInvite();
            $discordInviteLink = $discordInformation->instant_invite;
            // var_dump($discordInviteLink->instant_invite);
            require_once "views/user/home/home.php";
        }

        function discord(){
            $discordInformation = $this->home->getDiscordLinkInvite();
            $discordInviteLink = $discordInformation->instant_invite;
            header("Location: $discordInviteLink");
        }
    }
?>