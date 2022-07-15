<div>
    <h1>편집</h1>
    <form action="editProc" method="post">
        <input type="hidden" name="i_board" value="<?=!empty($_GET['i_board']) ? $_GET['i_board'] : ''?>">
        <input type="hidden" name="i_user" value="<?=!empty($_GET['i_board']) ? $this->data->i_user : ''?>">
        <div><input type="text" name="title" value="<?=!empty($_GET['i_board']) ? $this->data->title : ''?>"></div>
        <div><textarea name="ctnt"><?=!empty($_GET['i_board']) ? $this->data->ctnt : ''?></textarea></div>
        <div>
            <input type="submit" value="저장">
        </div>
    </form>
</div>