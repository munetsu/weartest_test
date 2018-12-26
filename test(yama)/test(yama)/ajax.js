
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

// ユーザー検索
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
        $('#describe').text('エラー');
    })
})

// ユーザー表示
$(document).on('click','#look', function(){
    $.ajax({
        url:'user_info.php',
        type:'POST',
        data:{
            id:$(this).text(),
        }
    })
    .done((data) =>{
        $('#describe').html(data);
    })
    .fail((data) => {
        $('#describe').text('エラー');
    })
})

// オファー通知
$(document).on('click','#offer', function(){
    $.ajax({
        url:'offer.php',
        type:'POST',
        data:{
            id:$(this).attr('class'),
        }
    })
    .done((data) =>{
        $('#describe').html(data);
    })
    .fail((data) => {
        $('#describe').text('エラー');
    })
})
