(function(){
    const trList = document.querySelectorAll('tbody > tr');

    // 예 dataset 사용법 알기
    const tr1 = trList[1];
    console.log(tr1.dataset.i_board);

    trList.forEach(item => {
        item.addEventListener('click', function(){
            location.href=`detail?i_board=${this.dataset.i_board}`;
        })
    })
})();