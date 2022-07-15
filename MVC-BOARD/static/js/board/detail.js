(function(){
    const delBtn = document.querySelector('#btnDel');

    delBtn.addEventListener('click', function(){
        if(confirm('삭제하시겠습니까?')){
            location.href=`del?i_board=${this.dataset.i_board}`;
        }
    })
})();