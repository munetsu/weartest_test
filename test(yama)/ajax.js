$('#btn').on('click',function(){
    $.ajax({
        url:'user.php',
        type:'POST',
    })
    .done((data) => {
        $('#describe').html(data);
    })
    .fail((data) => {
        $('#describe').html('エラー');
    })
})