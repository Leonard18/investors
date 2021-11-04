
document.addEventListener('DOMContentLoaded', function(){

  //Grab the side nav element...
  const sidenav = document.querySelector(".sidenav");
  M.Sidenav.init(sidenav, {
    edge: 'left',
    draggable: true,
  });

  // Deposits dropdowm section...
  const deposits = document.querySelectorAll(".deposits");
  M.Dropdown.init(deposits, {
    closeOnClick: true,
    hover: true,
    alignment: 'bottom',
    inDuration: 1100,
    outDuration: 500,
    contstainWidth: true,
    coverTrigger: false,

  });


});
