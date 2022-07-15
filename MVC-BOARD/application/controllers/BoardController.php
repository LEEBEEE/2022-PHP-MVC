<?php
namespace application\controllers;
// use application\controllers\Controller;
use application\models\BoardModel;

class BoardController extends Controller {
    
    // write mod 합치기
    public function edit() {
        $model = new BoardModel();
        if(!empty($_GET["i_board"])){
            $i_board = $_GET["i_board"];
            $param = ["i_board" => $i_board];
            $this->addAttribute("data", $model->selBoard($param));
        }
        $this->addAttribute(_TITLE, "편집");
        $this->addAttribute(_HEADER, $this->getView("template/header.php"));
        $this->addAttribute(_MAIN, $this->getView("board/edit.php"));
        $this->addAttribute(_FOOTER, $this->getView("template/footer.php"));
        return "template/t1.php";
    }
    
    public function editProc() {
        $model = new BoardModel();
        $title = $_POST["title"];
        $ctnt = $_POST["ctnt"];
        $param = [
            "title" => $title,
            "ctnt" => $ctnt
        ];
        
        if($_POST['i_board'] != "" && isset($_SESSION[_LOGINUSER]) && $_SESSION[_LOGINUSER]->i_user == $_POST['i_user']){
            $i_board = $_POST["i_board"];
            $param["i_board"] = $i_board;
            $model->updBoard($param);
            return "redirect:/board/detail?i_board=$i_board";
        }
        else if($_POST['i_board'] == "" && isset($_SESSION[_LOGINUSER])){
            $param["i_user"] = $_SESSION[_LOGINUSER]->i_user;
            $model->insBoard($param);
            return "redirect:list";
        }
        else {
            echo "<script>if(!alert('권한이없습니다.')){
                location.href = '/board/list';
            }</script>";
        }
    }

    public function list() {
        $model = new BoardModel();
        $this->addAttribute(_TITLE, "리스트");
        // $this->list = $model->selBoardList(); ==
        $this->addAttribute("list", $model->selBoardList());
        $this->addAttribute("js", ["board/list"]); // ["", ... ""] 여러개 import는 이렇게
        // return "board/list.php"; // view 파일명
        $this->addAttribute(_HEADER, $this->getView("template/header.php"));
        $this->addAttribute(_MAIN, $this->getView("board/list.php"));
        $this->addAttribute(_FOOTER, $this->getView("template/footer.php"));
        return "template/t1.php";
    }
    
    public function detail() {
        $i_board = $_GET["i_board"];
        $model = new BoardModel();
        $param = ["i_board" => $i_board];
        $this->addAttribute(_TITLE, "디테일");
        $this->addAttribute("data", $model->selBoard($param));
        $this->addAttribute("js", ["board/detail"]);
        $this->addAttribute(_HEADER, $this->getView("template/header.php"));
        $this->addAttribute(_MAIN, $this->getView("board/detail.php"));
        $this->addAttribute(_FOOTER, $this->getView("template/footer.php"));
        return "template/t1.php";
    }
    
    public function del() {
        $i_board = $_GET["i_board"];
        $model = new BoardModel();
        $param = ["i_board" => $i_board];
        $model->delBoard($param);
        return "redirect:/board/list";
    }
}

/* --------- 구버전 write / mod
class BoardController extends Controller { 
    public function write() {
        $this->addAttribute(_TITLE, "글쓰기");
        $this->addAttribute(_HEADER, $this->getView("template/header.php"));
        $this->addAttribute(_MAIN, $this->getView("board/write.php"));
        $this->addAttribute(_FOOTER, $this->getView("template/footer.php"));
        return "template/t1.php";
    }
    
    public function mod() {
        $i_board = $_GET["i_board"];
        $model = new BoardModel();
        $param = ["i_board" => $i_board];
        $this->addAttribute("data", $model->selBoard($param));
        $this->addAttribute(_TITLE, "수정");
        $this->addAttribute(_HEADER, $this->getView("template/header.php"));
        $this->addAttribute(_MAIN, $this->getView("board/mod.php"));
        $this->addAttribute(_FOOTER, $this->getView("template/footer.php"));
        return "template/t1.php";
    }
        
    public function writeProc() {
        $model = new BoardModel();
        $title = $_POST["title"];
        $ctnt = $_POST["ctnt"];
        $loginUser = $_SESSION[_LOGINUSER];
        $param = [
            "title" => $title,
            "ctnt" => $ctnt,
            "i_user" => $loginUser->i_user
        ];
        $model->insBoard($param);
        return "redirect:list";
    }

    public function modProc() {
        $i_board = $_POST["i_board"];
        $title = $_POST["title"];
        $ctnt = $_POST["ctnt"];
        $param = [
            "i_board" => $i_board,
            "title" => $title,
            "ctnt" => $ctnt
        ];
        $model = new BoardModel();
        $model->updBoard($param);
        return "redirect:/board/detail?i_board=$i_board";
    }
}
--------- */