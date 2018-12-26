
for(let i =0;i<100;i++){
    if(i == 30){
        let view = ''
        view += '<option selected>'+i+'</option>';
        $('#ageS').append(view);
        $('#ageE').append(view);    
    } else {
        let view = ''
        view += '<option>'+i+'</option>';
        $('#ageS').append(view);
        $('#ageE').append(view); 
    }
};


$('#btn').on('click',function(){
    $.ajax({
        url:'user.php',
        type:'POST',
        data:{
            ageS:$('#ageS').val(),
            ageE:$('#ageE').val()
        }
    })
    .done((data) => {
        $('#describe').html(data);
    })
    .fail((data) => {
        $('#describe').html('エラー');
    })
})