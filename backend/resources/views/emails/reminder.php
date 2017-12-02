<html>
    <body>
        <div class="head">Hello, <?php echo $username; ?></div>
        <p style="font-size: 24px;margin-bottom: 50px">Below are some hot activities in recent days:</p>
        <div class="wrapper">
        <?php 
        for($i=0;$i<count($activity);++$i){ 
           echo 
            '<div class="content">'.
                '<div class="title">'.  $activity[$i]->title.'</div>'.
                // echo $activity[$i]->title.'<br />   '; 
                '<div class="time">' .  $activity[$i]->time .'</div>'.
                '<div class="place">' .  $activity[$i]->place .'</div>'.
            '</div>';
        }; 
        ?> 
        </div>
    </body>
</html>


<style type="text/css">
    .head {
       color: #202020;
       font-size: 30px;
       text-align: center;
       margin-bottom: 50px;
    }
    .wrapper{
        display: flex;
    }
    .content{   
        flex: 1;
                display: inline-block;
                vertical-align: top;
                margin-left: 10px;
                font-size: 14px;
                color: #999;
        }
        .content .title{
                    font-size: 20px;
                    width: 200px;
                    color: #333;
                    margin-bottom: 15px;
                    cursor: pointer;
                }
               .content .time{
                    margin-bottom: 5px;
               }
    </style>
<!-- <div class="activity-item" v-for="activity in activityArr">
            <div class="poster" @click="showDetail(activity.id)" :style="{ backgroundImage: 'url(' + activity.poster+ ')' }"></div>
            <div class="content">
                <div class="title" @click="showDetail(activity.id)" target="_blank">{{activity.title}}</div>
                <div class="time">时间：{{activity.time}}</div>
                <div class="place">城市：{{activity.place}}</div>
            </div>   
        </div> -->