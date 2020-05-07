
let book = $ (".book");
//box[0].style.background =  "red";// в красный перекрасить квадрат

$(book).click(() => {
  $(book).hide()
        .show(4000)// при нажатии квадрат исчезнет и появится через 4000 мили сек//
        .fadeOut(1000)//спрятать
        .delay(1000)//пропадает
        .fadeIn(300)
        .delay(1000)//пропадает
         .animate({
           "min-width" : "250px",//
           "min-height" : "10px",//
           "opacity" : "50px",//прозрачность // расширяется
        }, 400,  callback); 
});


function callback() {
   $(book).css({
           "background" : "transparent",//цвет transparent
           "book-shadow" : "25px 25px 25px rgba(0,0,0,0,8)",
           "opacity" : "20px",
          }) 
          .attr({
            "src" : "somewhere.com",
            "href" : "anotherlink.com",
            "cost" : "150",
          })
          .addClass("one withborder")
          .html("<img src='http://y95327t3.beget.tech/1/img/п.gif'>")// картинка
  
}
 
