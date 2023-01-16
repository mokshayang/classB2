<style>
    .full{
        display: none;
    }
    .news-title{
        cursor: pointer;
        background-color: #eee;
    }
</style>
<fieldset>
    <legend 目前位置:首頁>人氣文章區</legend>
    <table>
        <tr>
            <td width="30%">標題</td>
            <td width="50%">內容</td>
            <td>人氣</td>
        </tr>
        <?php
        $all = $News->count(['sh' => 1]);
        $div = 5;
        $pages = ceil($all / $div);
        $now = $_GET['p'] ?? 1;
        $start = ($now - 1) * $div;
        $rows = $News->all(['sh' => 1], "order by `good` desc limit $start,$div"); //由大到小
        foreach ($rows as $row) {

        ?>
            <tr>
                <td class="news-title"><?= $row['title'] ?></td>
                <td>
                    <div class="short"><?= mb_substr($row['text'], 0, 20) ?>...</div>
                    <div class="full"><?=nl2br( ($row['text'])) ?>...</div>
                </td>
                <td></td>
            </tr>
        <?php } ?>
    </table>
</fieldset>

<div style="text-align:center;">
    <?php

    if (($now - 1) > 0) {
        echo "<a href='?do=$do&p=" . ($now - 1) . "'> < </a>";
    }

    for ($i = 1; $i <= $pages; $i++) {
        $size = ($now == $i) ? "24px" : "20px";
        echo "<a href='?do=$do&p=$i' style='font-size:$size;'> &nbsp;&nbsp;$i&nbsp;&nbsp; </a>";
    }


    if (($now + 1) <= $pages) {
        echo "<a href='?do=$do&p=" . ($now + 1) . "'> > </a>";
    }
    ?>
</div>
<script>
  
    $('.news-title').on('click',function(){
  
        // $(this).next().children('.short,.full').toggle( );
        // $(this).next().children('.short').toggle( );
        $(this).next().children('.full').toggle( );
    })
</script>