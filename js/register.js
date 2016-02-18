$( document ).ready(function() {
    $('input[name="email"]').blur(function() {
        var email = $('input[name="email"]');
        if(email.val() !== '') {
            var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
            if(pattern.test(email.val())){
                //если поле заполнено верно - проверяем email надубли
                checkEMail(email, email.parent().children().last());
            } else {
                // email не соответствует маске выводим предупреждающее сообщение
                email.attr('class', 'error');
                getMessage('errors_email_incorrect', email); 
            }
        } else {
            // Поле email пустое, выводим предупреждающее сообщение
            email.attr('class', 'error');
            getMessage('errors_email_empty', email); 
            
        }    
    });
    
    $('input[name="password"]').blur(function() {
        var pass = $(this);
        var c_pass = $('input[name="password"]');
        checkPass(pass, c_pass); 
    });
    
    $('input[name="check_password"]').blur(function() {
        var pass = $('input[name="user_password"]');
        var c_pass = $(this);
        checkPass(pass, c_pass); 

    });
    
    $('.btn-submit').click(function(event){
        
        event.preventDefault(); // отменяем поведение формы по умолчанию
        var ok = true;
        //если все элементы формы заполнены правильно -отправляем форму
        $('input, select, textarea').each( function(){
            if($(this).attr('required') == 'required' && ($(this).val() == '' || $(this).hasClass('error'))){
                $(this).change();
                ok = false;
            }
        });
        if (ok){
            $(this).closest('form').trigger('submit');
        }else{
            return ok;
        }
    });    
    
    function checkPass(pass, c_pass){
        
        if (pass.val() == ''){
            pass.attr('class', 'error');
            getMessage('errors_password_empty', pass);
        }else {
            pass.parent().children().last().text('');
        }
        if (c_pass.val() == ''){
            c_pass.attr('class', 'error');
            getMessage('errors_password_empty', pass);
        }else {
            pass.parent().children().last().text('');
        }
        
        if(pass.val() !== c_pass.val()) {
            pass.addClass('error');
            c_pass.addClass('error');
            pass.removeClass('success');
            c_pass.removeClass('success');
            getMessage('errors_password_check', pass);
        } else {
            pass.removeClass('error');
            c_pass.removeClass('error');
            pass.addClass('success');
            c_pass.addClass('success');
            pass.parent().children().last().text('');
        }
    }

    function checkEMail(email, msg){
        $.ajax({
        url: path + '/auth/register/',
        type: 'POST',
        data: email,
        success: function(data){
            var res = JSON.parse(data);
            email.attr('class', res['status']);
            msg.text(res['msg']);
        } ,
        dataType: 'text'
      });
    }
    
    function getMessage(msg, obj){
        $.ajax({
        url: path + '?ctrl=index&act=getStr',
        type: 'POST',
        data: {'msg': msg},
        success: function(msg){
            obj.parent().children().last().text(msg)
        } ,
        dataType: 'text'
      });
    }
});
