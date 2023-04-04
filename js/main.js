// 화면 전환하기
const pages = document.querySelectorAll('#main>div');
const gnbBtns = document.querySelectorAll('#gnb>li');

for (let i = 0; i < gnbBtns.length; i++) {
    gnbBtns[i].addEventListener("click", function () {
        for (let j = 0; j < pages.length; j++) {
            if (pages[j].hidden === false) {
                pages[j].classList.add('hidden');
                gnbBtns[j].classList.remove('liClick');
                gnbBtns[j].querySelector('a').classList.remove('aClick');
                gnbBtns[j].querySelector('span').classList.remove('spanClick');
            }
        }
        pages[i].classList.toggle('hidden');
        gnbBtns[i].classList.add('liClick');
        gnbBtns[i].querySelector('a').classList.add('aClick');
        gnbBtns[i].querySelector('span').classList.add('spanClick');
    })
}