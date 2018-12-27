
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
        url:'ajax_class.php',
        type:'POST',
        data:{
            action:'get_user_list_from_company',
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
        url:'ajax_class.php',
        type:'POST',
        data:{
            action:'user_describe',
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
        url:'ajax_class.php',
        type:'POST',
        data:{
            action:'offer_from_company',
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
