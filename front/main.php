<?php

$type = $_GET['type'] ?? 0;
$nav = '';
$goods = null;
// 如果type 為0，全部商品，依據送來的type判斷，如果big_id為0是大分類，good資料表big是大分類的id，當big=大分類的id列出大分類的所有中分類
// 否則透過目前點的id，找那一筆的big_id，會得到大分類的id，得到大分類的名稱，
if ($type == 0) {
    $nav = "全部商品";
    $goods = $Goods->all(['sh' => 1]);
} else {
    $t = $Type->find($type);
    if ($t['big_id'] == 0) {
        $nav = $t['name'];
        $goods = $Goods->all(['sh' => 1, 'big' => $t['id']]);
    } else {
        $b = $Type->find($t['big_id']);
        $nav = $b['name'] . " > " . $t['name'];
        $goods = $Goods->all(['sh' => 1, 'mid' => $t['id']]);
    }
}


?>
<h2><?= $nav; ?></h2>
<style>
    .item{
        width:80%;
        height:160px;
        background-color: #f4c591;
        margin:5px auto;
        display: flex;        
        
    }
    .item .img{
        width: 33%;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 1px solid #999;
    }
    .item .info{
        width:67%;
        display: flex;
        flex-direction: column;
    }
    .info div{
        border: 1px solid #999;
        border-left:0px;
        border-top:0px;
        flex-grow: 1;
    }
  
</style>

<?php
foreach ($goods as $good) {
?>
    <div class="item">
        <div class="img">
            <img src="./img/<?=$good['img'];?>" style="width:80%;height:110px;">
        </div>
        <div class="info">
            <div class="ct tt"><?=$good['name'];?></div>
            <div>價錢:<?=$good['price'];?></div>
            <div>規格:<?=$good['spec'];?></div>
            <div>簡介:<?=mb_substr($good['intro'],0,25);?>...</div>

        </div>
    </div>
<?php
}
?>