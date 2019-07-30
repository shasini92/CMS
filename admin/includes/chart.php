<?php
$post_count = recordCount('posts');
$draft_post_count = checkStatus('posts','post_status','draft');
$comment_count = recordCount('comments');
$unapproved_comment_count = checkStatus('comments','comment_status','Unapproved');
$user_count = recordCount('users');
$subscriber_user_count = checkStatus('users','user_role','Subscriber');
$categories_count = recordCount('categories');

$elements_text = ['Active Posts','Draft Posts', 'Comments','Unapproved Comments', 'Users', 'Subscribers', 'Categories'];
$elements_count = [$post_count, $draft_post_count, $comment_count, $unapproved_comment_count, $user_count, $subscriber_user_count, $categories_count];
?>
<script type="text/javascript">
    google.charts.load('current', {'packages': ['bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Data', 'Count'],

            <?php
            for ($i = 0; $i < 7; $i++) {

                echo "['{$elements_text[$i]}' , {$elements_count[$i]}],";

            }
            ?>
        ]);

        var options = {
            chart: {
                title: '',
                subtitle: '',
            }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
</script>
