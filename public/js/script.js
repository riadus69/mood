$("#success-alert").hide();
$("#warning-alert").hide();
$("#danger-alert").hide();


$('.board-item-content').click(function () {

    //get code zone since twig template
   // var data = $(this).data();
   // console.log(data.id);

    var res =  $(this).attr('value');
   // console.log(res);

});