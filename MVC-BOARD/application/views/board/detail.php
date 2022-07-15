<!DOCTYPE html>
<html lang="en">

<?php include_once "application/views/template/head.php"; ?>

<body>
    <h1>디테일</h1>
    <div>
        <div>
            <!-- <button id="btnList">리스트</button> -->
            <?php
                if(isset($_SESSION[_LOGINUSER]) && $_SESSION[_LOGINUSER]->nm === $this->data->nm){
            ?>
            <a href="edit?i_board=<?=$_GET["i_board"]?>" tabindex="-1"><button>수정</button></a>
            <button id="btnDel" data-i_board="<?=$_GET['i_board']?>">삭제</button>
            <?php } ?>
        </div>
        <div><?=$_GET["i_board"]?></div>
        <div><?=$this->data->title?></div>
        <div><?=$this->data->nm?></div>
        <div><?=$this->data->create_at?></div>
        <div><?=$this->data->update_at?></div>
        <div><?=nl2br($this->data->ctnt)?></div>
    </div>
    </body>
</html>