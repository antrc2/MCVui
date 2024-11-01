<?php
    class homeModel{
        public $home;
        function __construct(){
            $this->home = database("home");
        }
        function getInformationOfServer($ip,$port = 25565){
            return serverInfo($ip,$port);
        }
        function getDiscordLinkInvite($url = 'https://discord.com/api/guilds/1229643390438608927/widget.json?fbclid=IwY2xjawFaD5xleHRuA2FlbQIxMAABHSMib3DETrqfRtdXPn74biuvSKPQmugha-Xd0bY9staoUB_2MvVG3VU8bg_aem_S45ecs3Tnom5W8FYreI2Gw'){
        

        // Khởi tạo một session cURL mới
        $ch = curl_init();

        // Thiết lập các tùy chọn cho session cURL
        curl_setopt($ch, CURLOPT_URL, $url); // Thiết lập URL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Yêu cầu trả về kết quả của yêu cầu

        // Thực hiện yêu cầu và lấy kết quả
        $response = curl_exec($ch);
        return json_decode($response);
    }
    }
?>