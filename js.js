"use strict";

// ЗАДАЧА #3 (JQUERY)
//     1. Написать функцию перехвата нажатия клавиш left arrow, right arrow, up arrow, down arrow
//     2. При нажатии на любую из клавиш появляется alert с названием нажатой клавиши
//     3. Запрещается использовать любые плагины, которые осуществляют перехват нажатых клавиш
//     4. Необходимо продолжать результат действия этих клавиш после закрытия alert

$(function () {
  $(document).on("keydown", function (event) {
    let key = event.key;
    switch (key) {
      case "ArrowUp":
      case "ArrowDown":
      case "ArrowLeft":
      case "ArrowRight":
        alert(key);
        break;
    }
  });
});

//     4. Необходимо продолжать результат действия этих клавиш после закрытия alert
// Если имелось в виду, что каждая стрелка должна вызывать алерт только один раз:

// $(function () {

//   let pressed = {
//     ArrowUp: false,
//     ArrowDown: false,
//     ArrowLeft: false,
//     ArrowRight: false,
//   };

//   $(document).on("keydown", function (event) {
//     let key = event.key;
//     switch (key) {
//       case "ArrowUp":
//       case "ArrowDown":
//       case "ArrowLeft":
//       case "ArrowRight":
//         if (!pressed[key]) {
//           alert(key);
//           pressed[key] = true;
//         };
//         break;
//     }
//   });
// });
